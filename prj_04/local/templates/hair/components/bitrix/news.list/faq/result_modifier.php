<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arResult['GROUPS'] = [];
foreach($arResult['ITEMS'] as $k => $arItem):
    $arResult['GROUPS'][$arItem['IBLOCK_SECTION_ID']]['SECTION'] = CIBlockSection::GetByID($arItem['IBLOCK_SECTION_ID'])->GetNext();
    $arResult['GROUPS'][$arItem['IBLOCK_SECTION_ID']]['ITEMS'][] = $arItem;
endforeach;
?>