<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
use Hair\General;
//vardump($arResult['ITEMS']);

foreach ($arResult['ITEMS'] as &$arItem) {
    if (is_array($arItem["DETAIL_PICTURE"])) {
        $arFile = $arItem["DETAIL_PICTURE"];
    } else {
        $arFile = CFile::GetFileArray($arItem["DETAIL_PICTURE"]);
    }
    $arResultLocal = getImageFormatted(array(
        'RESIZE' => 'Y',
        'FILE_VALUE' => $arFile,
        'WIDTH' => 1440,
        'HEIGHT' => 5000,
        'DEFAULT_ALT_TITLE' => $arItem['NAME']
    ));
    $arItem['DETAIL_PICTURE_SLIDER'] = $arResultLocal['PICTURE'];

    if (is_array($arItem["PREVIEW_PICTURE"])) {
        $arFile = $arItem["PREVIEW_PICTURE"];
    } else {
        $arFile = CFile::GetFileArray($arItem["PREVIEW_PICTURE"]);
    }
    $arResultLocal = getImageFormatted(array(
        'RESIZE' => 'Y',
        'FILE_VALUE' => $arFile,
        'WIDTH' => 576,
        'HEIGHT' => 5000,
        'DEFAULT_ALT_TITLE' => $arItem['NAME']
    ));
    $arItem['PREVIEW_PICTURE_SLIDER'] = $arResultLocal['PICTURE'];

    // -->
    if (is_array($arItem["DISPLAY_PROPERTIES"]['VIDEO_PREVIEW']['FILE_VALUE'])) {
        $arFile = $arItem["DISPLAY_PROPERTIES"]['VIDEO_PREVIEW']['FILE_VALUE'];
    } else {
        $arFile = CFile::GetFileArray($arItem["DISPLAY_PROPERTIES"]['VIDEO_PREVIEW']['FILE_VALUE']);
    }
    $arResultLocal = getImageFormatted(array(
        'RESIZE' => 'Y',
        'FILE_VALUE' => $arFile,
        'WIDTH' => 430,
        'HEIGHT' => 260,
        'DEFAULT_ALT_TITLE' => $arItem['NAME']
    ));
    $arItem['VIDEO_PREVIEW_SLIDER'] = $arResultLocal['PICTURE'];
    // <--


    // Ссылка на видео -->
    $arItem['VIDEO_LINK'] = $arItem['PROPERTIES']['VIDEO_LINK']['VALUE'];
    $arItem['VIDEO_LINK'] = General::ParseShortYouTubeLink($arItem['VIDEO_LINK']);
    // <--
}
