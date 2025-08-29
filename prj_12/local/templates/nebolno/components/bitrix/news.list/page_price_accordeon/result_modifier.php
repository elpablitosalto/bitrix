<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arSectionIds = [];
$arItems = [];
foreach ($arResult['ITEMS'] as $arItem) {
    $arSectionIds[$arItem['IBLOCK_SECTION_ID']] = $arItem['IBLOCK_SECTION_ID'];
    $arItems[$arItem['IBLOCK_SECTION_ID']][] = $arItem;
}
$arResult['ITEMS'] = $arItems;
unset($arItems);

$arResult['ACCORDEON_DATA'] = [];
if (count($arSectionIds) > 0) {
    $rsSect = CIBlockSection::GetList(
        array('SORT' => 'ASC', 'ID' => 'ASC'),
        array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'ID' => array_values($arSectionIds)),
        false,
        array('ID', 'NAME')
    );
    while ($arSect = $rsSect->GetNext()) {
        $arResult['ACCORDEON_DATA'][$arSect['ID']] = [
            'ID' => $arSect['ID'],
            'NAME' => $arSect['NAME']
        ];
    }
}