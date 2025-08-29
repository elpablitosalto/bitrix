<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();


foreach ($arResult["ITEMS"] as &$arItem) {
    $arFile = array();
    if (!empty($arItem['DISPLAY_PROPERTIES']['FILE']['FILE_VALUE'])) {
        $arItem['TYPE'] = 'FILE';
        $arFile = $arItem['DISPLAY_PROPERTIES']['FILE']['FILE_VALUE'];
    } else if (!empty($arItem['DISPLAY_PROPERTIES']['IMAGE']['FILE_VALUE'])) {
        $arItem['TYPE'] = 'IMAGE';
        $arFile = $arItem['DISPLAY_PROPERTIES']['IMAGE']['FILE_VALUE'];
    }

    $arItem['FILE'] = $arFile;
    $arItem['FILE']['SIZE_FORMAT'] = Indexis::formatSizeUnits($arFile['FILE_SIZE']);
    $arItem['FILE']['TYPE_FORMAT'] = Indexis::getExtension($arFile['SRC']);
    if (strlen($arFile['DESCRIPTION']) > 0) {
        $arItem['HEADER'] = $arFile['DESCRIPTION'];
    } else {
        $arItem['HEADER'] = $arItem['NAME'];
    }

    $arResultLocal = Indexis::getImageFormatted(array(
        'RESIZE' => 'Y',
        'FILE_VALUE' => $arItem['PREVIEW_PICTURE'],
        'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/no_photo.png',
        'WIDTH' => 336,
        'HEIGHT' => 463,
        'DEFAULT_ALT_TITLE' => $arItem['HEADER']
    ));
    $arItem['PICTURE'] = $arResultLocal['PICTURE'];
}
