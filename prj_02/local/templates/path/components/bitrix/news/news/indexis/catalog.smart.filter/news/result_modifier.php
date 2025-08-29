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

//$bUnsetSetFilter = true;
// Ссылки на удаление выбранных фильтров -->
if (!empty($arResult["ITEMS"])) {
	$current_url = $_SERVER['REQUEST_URI'];
	$parse = parse_url($current_url);
	parse_str($parse['query'], $ar_query);
	//vardump($ar_query);
	foreach ($arResult["ITEMS"] as $key => $arItem) {
		foreach ($arItem["VALUES"] as $val => $ar) {
			$ar_query_unset = $ar_query;
			unset($ar_query_unset[$ar["CONTROL_NAME"]]);
			$query = http_build_query($ar_query_unset);
			$parse['query'] = $query;
			$unset_url = Indexis::reverse_parse_url($parse);

			$arResult["ITEMS"][$key]["VALUES"][$val]["URL_UNSET"] = $unset_url;
		}
	}
}
// <--

// Ссылка "Очистить фильтр" -->
if (!empty($arResult["ITEMS"])) {
	$current_url = $_SERVER['REQUEST_URI'];
	$parse = parse_url($current_url);
	parse_str($parse['query'], $ar_query);
	foreach ($arResult["ITEMS"] as $key => $arItem) {
		foreach ($arItem["VALUES"] as $val => $ar) {
			//$ar_query_unset = $ar_query;
			unset($ar_query[$ar["CONTROL_NAME"]]);
		}
	}
	unset($ar_query["set_filter"]);
	unset($ar_query["q"]);
	unset($ar_query["bxajaxid"]);
	$query = http_build_query($ar_query);
	$parse['query'] = $query;
	$unset_all_url = Indexis::reverse_parse_url($parse);

	$arResult["URL_UNSET_ALL"] = $unset_all_url;
}
// <--

// Показывать ли кнопку "Очистить фильтр" -->
$bShowUnsetAll = false;
foreach ($arResult["ITEMS"] as $key => $arItem) {
	foreach ($arItem["VALUES"] as $keyItem => $arValue) {
		$bShow = false;
		$display_value = "";
		if ($arItem["DISPLAY_TYPE"] == "P") {
			if ($arValue["CHECKED"]) {
				$bShow = true;
				$display_value = $arValue["VALUE"];
			}
		} else if ($arItem["DISPLAY_TYPE"] == "U") {
			if (strlen($arValue["HTML_VALUE"]) > 0) {
				$bShow = true;
				$s = "с ";
				if ($keyItem == "MAX") {
					$s = "по ";
				}
				$display_value = $s . $arValue["HTML_VALUE"];
			}
		}
		if ($bShow) {
			$bShowUnsetAll = true;
		}
	}
}
$arResult["bShowUnsetAll"] = $bShowUnsetAll;
// <-- Показывать ли кнопку "Очистить фильтр"



// Ссылка на удаление поискового запроса -->
if (strlen($_GET["q"]) > 0) {
	$arResult["arSearch"] = array(
		"q" => urldecode($_GET["q"]),
		"UNSET_URL" => "",
	);
	$current_url = $_SERVER['REQUEST_URI'];
	$parse = parse_url($current_url);
	parse_str($parse['query'], $ar_query);
	unset($ar_query["q"]);
	$query = http_build_query($ar_query);
	$parse['query'] = $query;
	$arResult["arSearch"]["UNSET_URL"] = Indexis::reverse_parse_url($parse);
}		
// <--