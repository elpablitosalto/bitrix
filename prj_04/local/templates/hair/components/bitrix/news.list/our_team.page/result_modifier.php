<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arResult['DEPARTMENTS'] = [];
foreach($arResult['ITEMS'] as $k => $arItem):
    $arResult['DEPARTMENTS'][$arItem['IBLOCK_SECTION_ID']]['SECTION'] = CIBlockSection::GetByID($arItem['IBLOCK_SECTION_ID'])->GetNext();
    $arItem['NAME'] = explode(' ',$arItem['NAME']);
    $arResult['DEPARTMENTS'][$arItem['IBLOCK_SECTION_ID']]['ITEMS'][] = $arItem;
endforeach;
?>