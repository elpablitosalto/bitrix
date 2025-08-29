<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach ($arResult['ITEMS'] as &$arItem) {
    if (is_array($arItem["DETAIL_PICTURE"])) {
        $arFile = $arItem["DETAIL_PICTURE"];
    } else {
        $arFile = CFile::GetFileArray($arItem["DETAIL_PICTURE"]);
    }
    $arResultLocal = getImageFormatted(array(
        'RESIZE' => 'Y',
        'FILE_VALUE' => $arFile,
        'WIDTH' => 380,
        'HEIGHT' => 300,
        'DEFAULT_ALT_TITLE' => $arItem['NAME']
    ));
    $arItem['DETAIL_PICTURE_SLIDER'] = $arResultLocal['PICTURE'];
}