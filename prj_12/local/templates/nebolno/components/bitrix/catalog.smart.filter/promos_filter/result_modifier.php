<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (isset($arParams["TEMPLATE_THEME"]) && !empty($arParams["TEMPLATE_THEME"])) {
	$arAvailableThemes = array();
	$dir = trim(preg_replace("'[\\\\/]+'", "/", __DIR__ . "/themes/"));
	if (is_dir($dir) && $directory = opendir($dir)) {
		while (($file = readdir($directory)) !== false) {
			if ($file != "." && $file != ".." && is_dir($dir . $file))
				$arAvailableThemes[] = $file;
		}
		closedir($directory);
	}

	if ($arParams["TEMPLATE_THEME"] == "site") {
		$solution = COption::GetOptionString("main", "wizard_solution", "", SITE_ID);
		if ($solution == "eshop") {
			$templateId = COption::GetOptionString("main", "wizard_template_id", "eshop_bootstrap", SITE_ID);
			$templateId = (preg_match("/^eshop_adapt/", $templateId)) ? "eshop_adapt" : $templateId;
			$theme = COption::GetOptionString("main", "wizard_" . $templateId . "_theme_id", "blue", SITE_ID);
			$arParams["TEMPLATE_THEME"] = (in_array($theme, $arAvailableThemes)) ? $theme : "blue";
		}
	} else {
		$arParams["TEMPLATE_THEME"] = (in_array($arParams["TEMPLATE_THEME"], $arAvailableThemes)) ? $arParams["TEMPLATE_THEME"] : "blue";
	}
} else {
	$arParams["TEMPLATE_THEME"] = "blue";
}

$arParams["FILTER_VIEW_MODE"] = (isset($arParams["FILTER_VIEW_MODE"]) && toUpper($arParams["FILTER_VIEW_MODE"]) == "HORIZONTAL") ? "HORIZONTAL" : "VERTICAL";
$arParams["POPUP_POSITION"] = (isset($arParams["POPUP_POSITION"]) && in_array($arParams["POPUP_POSITION"], array("left", "right"))) ? $arParams["POPUP_POSITION"] : "left";

// -->
global $USER_FIELD_MANAGER;
$IBLOCK_ID = Indexis::getIblockId("services");
// <--

$arResult['SPECIALIZATION_LIST'] = [];
$arFilter = array('IBLOCK_ID' => Indexis::getIblockId('services', 'services'), 'GLOBAL_ACTIVE' => 'Y', 'DEPTH_LEVEL' => 1);
$rsSect = CIBlockSection::GetList(array('sort' => 'asc', 'name' => 'asc'), $arFilter, false, array('ID', 'NAME'));
while ($arSect = $rsSect->GetNext()) {
	$aUserField = $USER_FIELD_MANAGER->GetUserFields('IBLOCK_' . $IBLOCK_ID . '_SECTION', $arSect["ID"]);
	if (strlen($aUserField["UF_SHORT_NAME_FOR_FILTER"]["VALUE"]) > 0) {
		$s = $aUserField["UF_SHORT_NAME_FOR_FILTER"]["VALUE"];
		$arSect["NAME"] = $s;
	}

	$arResult['SPECIALIZATION_LIST'][$arSect['ID']] = $arSect;
}

// Короткое название услуги -->
//vardump($arResult["ITEMS"]);
foreach ($arResult["ITEMS"] as $key => $arItem) {
	if ($arItem["CODE"] == "FILTER_SERVICES") {
		foreach ($arItem["VALUES"] as $section_id => $ar) {
			$aUserField = $USER_FIELD_MANAGER->GetUserFields('IBLOCK_' . $IBLOCK_ID . '_SECTION', $section_id);
			//vardump($aUserField);
			if (strlen($aUserField["UF_SHORT_NAME_FOR_FILTER"]["VALUE"]) > 0) {
				$s = $aUserField["UF_SHORT_NAME_FOR_FILTER"]["VALUE"];
				$arResult["ITEMS"][$key]["VALUES"][$section_id]["NAME"] = $s;
				$arResult["ITEMS"][$key]["VALUES"][$section_id]["VALUE"] = $s;
			}
		}
	}
}
//vardump($arResult["ITEMS"]);
// <--

$arResult['CHECKED_ITEMS'] = [];
$arResult['ALL_ELEMENT_COUNT'] = [];
foreach ($arResult["ITEMS"] as $key => $arItem) {

    if (!isset($arResult['ALL_ELEMENT_COUNT'][$arItem['CODE']]))
        $arResult['ALL_ELEMENT_COUNT'][$arItem['CODE']] = 0;

    foreach ($arItem["VALUES"] as $val => $ar) {
        if ($ar["CHECKED"]) {
            $ar["VALUE"] = ltrim($ar["VALUE"], '.');
            $arResult['CHECKED_ITEMS'][$arItem['CODE']][] = $ar;
        }
        $arResult['ALL_ELEMENT_COUNT'][$arItem['CODE']] += $ar['ELEMENT_COUNT'];
    }
}