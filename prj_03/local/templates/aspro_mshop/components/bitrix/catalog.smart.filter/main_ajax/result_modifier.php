<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (isset($arParams["TEMPLATE_THEME"]) && !empty($arParams["TEMPLATE_THEME"])) {
	$arAvailableThemes = array();
	$dir = trim(preg_replace("'[\\\\/]+'", "/", dirname(__FILE__) . "/themes/"));
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
			$theme = COption::GetOptionString("main", "wizard_eshop_adapt_theme_id", "blue", SITE_ID);
			$arParams["TEMPLATE_THEME"] = (in_array($theme, $arAvailableThemes)) ? $theme : "blue";
		}
	} else {
		$arParams["TEMPLATE_THEME"] = (in_array($arParams["TEMPLATE_THEME"], $arAvailableThemes)) ? $arParams["TEMPLATE_THEME"] : "blue";
	}
} else {
	$arParams["TEMPLATE_THEME"] = "blue";
}
$arParams["POPUP_POSITION"] = (isset($arParams["POPUP_POSITION"]) && in_array($arParams["POPUP_POSITION"], array("left", "right"))) ? $arParams["POPUP_POSITION"] : "left";
foreach ($arResult["ITEMS"] as $key => $arItem) {
	if ($arItem["CODE"] == "IN_STOCK") {
		sort($arResult["ITEMS"][$key]["VALUES"]);
		if ($arResult["ITEMS"][$key]["VALUES"])
			$arResult["ITEMS"][$key]["VALUES"][0]["VALUE"] = $arItem["NAME"];
	}
}

/* */
// Сортировка значений фильтра -->
foreach ($arResult["ITEMS"] as $key => $arValue) {
	//if(!($arValue["PROPERTY_TYPE"] == "N" || isset($arValue["PRICE"])) && count($arValue["VALUES"])) {
	//echo 'NAME = ' . $arValue["NAME"] . '<br />';
	//echo 'PROPERTY_TYPE = ' . $arValue["PROPERTY_TYPE"] . '<br />';
	if (($arValue["PROPERTY_TYPE"] == "S" || $arValue["PROPERTY_TYPE"] == "L") && count($arValue["VALUES"])) {
		
		$arValues      = array();
		$arResValues   = Array(); 
		foreach ($arValue["VALUES"] as $keyVal => $value) {
			$arValues[$keyVal] = $value['UPPER'];
		}

		if ($arValue["NAME"] == 'Материал') {
			//vardump($arValue["VALUES"]);
			//echo 'NAME = ' . $arValue["NAME"] . '<br />';
			//vardump($arValues);
		}

		uasort($arValues, 'cmp');

		if ($arValue["NAME"] == 'Материал') {
			//vardump($arValues);
		}

		foreach( $arValues AS $k => $val )
		{
			$arResValues[$k] = $arValue["VALUES"][$k];
		}

		if ($arValue["NAME"] == 'Материал') {
			//vardump($arResValues);
		}

		$arResult["ITEMS"][$key]["VALUES"] = $arResValues;
	}
}
function cmp($a, $b) {
    if ($a == $b) {
        return 0;
    }
    return ($a < $b) ? -1 : 1;
}
// <-- 
/**/
