<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

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
}
