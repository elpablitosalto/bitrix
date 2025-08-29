<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

//$APPLICATION->SetPageProperty("PAGE_H1", $arResult['NAME']);
//$APPLICATION->SetPageProperty("PAGE_H2", $arResult['DISPLAY_PROPERTIES']['H_2']['VALUE']);
//$APPLICATION->SetPageProperty("PAGE_DESCRIPTION", $arResult['~DETAIL_TEXT']);

$arResultFunc = CMarkingOG::setGlobalData(array(
    "OG_DESCRIPTION" => $arResult['OG_DESCRIPTION'],
    "OG_IMAGE" => $arResult['OG_IMAGE'],
));
