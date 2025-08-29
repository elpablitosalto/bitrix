<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach ($arResult['ITEMS'] as &$arItem) {
    if (is_array($arItem["PREVIEW_PICTURE"])) {
        $arFile = $arItem["PREVIEW_PICTURE"];
    } else {
        $arFile = CFile::GetFileArray($arItem["PREVIEW_PICTURE"]);
    }
    $arResultLocal = getImageFormatted(array(
        'RESIZE' => 'Y',
        'FILE_VALUE' => $arFile,
        'WIDTH' => 185,
        'HEIGHT' => 75,
        'DEFAULT_ALT_TITLE' => $arItem['NAME']
    ));
    $arItem['PREVIEW_PICTURE_SLIDER'] = $arResultLocal['PICTURE'];
}