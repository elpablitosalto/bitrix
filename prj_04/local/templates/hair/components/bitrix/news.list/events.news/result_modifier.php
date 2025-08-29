<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

// Заменить URL -->
foreach ($arResult['ITEMS'] as $k => &$arItem) {
    if (!empty($arItem['PROPERTIES']['EXT_LINK']['VALUE'])) {
        $arItem['DETAIL_PAGE_URL'] = $arItem['PROPERTIES']['EXT_LINK']['VALUE'];
    }
}
// <--