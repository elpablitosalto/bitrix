<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

foreach ($arResult['ITEMS'] as &$arItem) {
    $arResultLocal = getImageFormatted(array(
        'RESIZE' => 'Y',
        'FILE_VALUE' => $arItem['DISPLAY_PROPERTIES']['DESKTOP_IMAGE']['FILE_VALUE'],
        'WIDTH' => 1440,
        'HEIGHT' => 5000,
        'DEFAULT_ALT_TITLE' => $arItem['NAME']
    ));
    $arItem['DETAIL_PICTURE_SLIDER'] = $arResultLocal['PICTURE'];

    $arResultLocal = getImageFormatted(array(
        'RESIZE' => 'Y',
        'FILE_VALUE' => $arItem['DISPLAY_PROPERTIES']['MOBILE_IMAGE']['FILE_VALUE'],
        'WIDTH' => 576,
        'HEIGHT' => 5000,
        'DEFAULT_ALT_TITLE' => $arItem['NAME']
    ));
    $arItem['PREVIEW_PICTURE_SLIDER'] = $arResultLocal['PICTURE'];
}
