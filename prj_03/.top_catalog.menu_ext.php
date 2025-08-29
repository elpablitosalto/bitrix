<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
global $APPLICATION;
$aMenuLinksExt = $APPLICATION->IncludeComponent(
	"bitrix:menu.sections",
	"",
	array(
		"IBLOCK_TYPE" => "aspro_mshop_catalog",
		"IBLOCK_ID" => "34",
		"DEPTH_LEVEL" => "5",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"IS_SEF" => "N",
		"ID" => $_REQUEST["ID"],
		"SECTION_URL" => ""
	),
	false
);

/*
// В сопутствующих товарах оставляем только 2 уровень, всё, что ниже не выводим -->
$aMenuLinksExtTmp = array();
$flag = false;
foreach ($aMenuLinksExt as $key => $val) {
	$add = true;
	if ($val[1] == '/katalog/soputstvuyushchie_tovary/') {
		$flag = true;
	}
	if ($flag == true && $val[3]['DEPTH_LEVEL'] == 1 && $val[1] != '/katalog/soputstvuyushchie_tovary/') {
		$flag = false;
	}
	if ($flag == true && $val[1] != '/katalog/soputstvuyushchie_tovary/') {
		if ($val[3]['DEPTH_LEVEL'] == 2) {
			$val[3]['IS_PARENT'] = '';
		} else if ($val[3]['DEPTH_LEVEL'] > 2) {
			$add = false;
		}
	}

	if ($add == true) {
		$aMenuLinksExtTmp[] = $val;
	}
}
$aMenuLinksExt = $aMenuLinksExtTmp;
// <--
*/

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
