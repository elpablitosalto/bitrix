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

// Цвета -->
if (CModule::IncludeModule('highloadblock')) {

	foreach ($arResult["ITEMS"] as $key => &$arItem) {
		if (
			$arItem['USER_TYPE'] == 'directory'
			&& ( $arItem['CODE'] == 'COLOR_REF' || $arItem['CODE'] == 'TSVET' )
		) {
			$arXmlIds = array();
			foreach ($arItem['VALUES'] as $xml_id => $arValue) {
				if (strlen($xml_id) > 0) {
					$arXmlIds[] = $xml_id;
				}
			}

			// colors
			if (!empty($arXmlIds)) {
				$arHLBlock = Bitrix\Highloadblock\HighloadBlockTable::getById($GLOBALS["arSiteConfig"]['HL']['COLORS']['ID'])->fetch();
				$obEntity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arHLBlock);
				$strEntityDataClass = $obEntity->getDataClass();
				$filter = array('UF_XML_ID' => $arXmlIds);
				$resData = $strEntityDataClass::getList(array(
					'select' => array('ID', 'UF_NAME', 'UF_XML_ID', 'UF_COLOR'),
					'filter' => $filter,
					//'filter' => array('UF_NAME' => [$color, $next_color, $module]),
					'order'  => array('ID' => 'ASC'),
					//'limit'  => 3,
				));
				while ($ar_item = $resData->Fetch()) {
					foreach ($arItem['VALUES'] as $xml_id => $arValue) {
						if ($xml_id == $ar_item['UF_XML_ID']) {
							$arItem['VALUES'][$xml_id]['PROPS'] = $ar_item;
						}
					}
				}
			}
		}
	}
}
// <-- Цвета

// Единицы измерения -->
foreach ($arResult["ITEMS"] as $key => &$arItem) {
	foreach ($arItem["VALUES"] as $val => &$ar_val) {
		$ar_val['VALUE_SHOW'] = $ar_val['VALUE'];
		$postfix = '';
		if ($arItem['CODE'] == 'VES_ATTR_S') {
			$postfix = 'кг';
		} else if ($arItem['CODE'] == 'DLINA') {
			$postfix = 'см';
		} else if ($arItem['CODE'] == 'SHIRINA') {
			$postfix = 'см';
		} else if ($arItem['CODE'] == 'VISOTA') {
			$postfix = 'см';
		} else if ($arItem['CODE'] == 'FASOVKA_L_L') {
			$postfix = 'л';
		} else if ($arItem['CODE'] == 'RAZMER_SHVA_MIN_MM') {
			$postfix = 'мм';
		} else if ($arItem['CODE'] == 'RAZMER_SHVA_MAKS_MM') {
			$postfix = 'мм';
		} else if ($arItem['CODE'] == 'MIN_TEMPERATURA_EKSPLUATATSII_S') {
			$postfix = 'C';
		} else if ($arItem['CODE'] == 'MIN_TEMPERATURA_PRIMENENIYA_S') {
			$postfix = 'C';
		} else if ($arItem['CODE'] == 'OPEN_TIME') {
			$postfix = 'ч';
		} else if ($arItem['CODE'] == 'ZHIZNESPOSOBNOST_RASTVORA_MAKS_CH') {
			$postfix = 'ч';
		} else if ($arItem['CODE'] == 'VREMYA_TVERDENIYA_CH') {
			$postfix = 'ч';
		} else if ($arItem['CODE'] == 'MAKS_TEMPERATURA_EKSPLUATATSII_S') {
			$postfix = 'С';
		} else if ($arItem['CODE'] == 'MAKS_TEMPERATURA_PRIMENENIYA_S') {
			$postfix = 'С';
		} else if ($arItem['CODE'] == 'RASKHOD_VODY_NA_1_KG_SMESI_L') {
			$postfix = 'л';
		} else if ($arItem['CODE'] == 'MIN_RASKHOD_KG_M2') {
			$postfix = 'кг/м2';
		} else if ($arItem['CODE'] == 'MIN_RASKHOD_PO_OBEMU_L_M2') {
			$postfix = 'л/м2';
		} else if ($arItem['CODE'] == 'MAKS_RASKHOD_KG_M2') {
			$postfix = 'кг/м2';
		} else if ($arItem['CODE'] == 'MAKS_RASKHOD_PO_OBEMU_L_M2') {
			$postfix = 'л/м2';
		} else if ($arItem['CODE'] == 'PLOTNOST_G_SM3') {
			$postfix = 'г/см3';
		}
		if (strlen($postfix) > 0) {
			$ar_val['VALUE_SHOW'] = $ar_val['VALUE'] . ' ' . $postfix;
		}
	}
}
// <-- Единицы измерения

// Обрезка -->
foreach ($arResult["ITEMS"] as $key => &$arItem) {
	foreach ($arItem["VALUES"] as $val => &$ar_val) {
		$ar_val['VALUE_SHOW'] = str_replace( array('<br>'), array(''), $ar_val['VALUE_SHOW'] );
	}
}
// <-- Обрезка