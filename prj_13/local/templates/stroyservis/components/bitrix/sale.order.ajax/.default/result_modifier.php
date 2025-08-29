<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$totalWeight = 0;
foreach($arResult["GRID"]["ROWS"] as $arRow) {
    $totalWeight += ($arRow['data']['PROPERTY_VES_ATTR_S_VALUE'] * $arRow['data']['QUANTITY']);
}

if ($totalWeight > 0)
    $arResult['ORDER_WEIGHT_FORMATED'] = $totalWeight . ' кг';
?>