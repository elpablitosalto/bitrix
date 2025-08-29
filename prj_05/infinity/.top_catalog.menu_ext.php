<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
global $APPLICATION;
$aMenuLinksExt = $APPLICATION->IncludeComponent(
	"bitrix:menu.sections",
	"",
	array(
		"IBLOCK_TYPE" => "catalog_en",
		"IBLOCK_ID" => INFINITY_CATALOG_EN_IB_ID,
		"DEPTH_LEVEL" => "2",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"IS_SEF" => "N",
		"ID" => $_REQUEST["ID"],
		"SECTION_URL" => ""
	),
	false
);
//var_dump($aMenuLinksExt);
// Вставить пункт меню Collaboration -->
$ar_result = \Hair\General::insMenuItemCollaborations(array(
	"aMenuLinksExt" => $aMenuLinksExt
));
if (!empty($ar_result['aMenuLinksExt']) && is_array($ar_result['aMenuLinksExt'])) {
	$aMenuLinksExt = $ar_result['aMenuLinksExt'];
}
// <-- Вставить пункт меню Collaboration
$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
?>