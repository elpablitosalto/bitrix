<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arResult['ALL_ELEMENTS_COUNT'] = 0;
foreach ($arResult["SECTIONS"] as $section) {
    //vardump($section);
    $arResult['ALL_ELEMENTS_COUNT'] += $section["ELEMENT_CNT"];
}

?>