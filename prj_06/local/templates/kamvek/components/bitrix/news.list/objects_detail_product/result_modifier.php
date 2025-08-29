<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

foreach ($arResult["ITEMS"] as &$arItem) {
    $arFile = $arItem['PREVIEW_PICTURE'];
    $arFileDetail = $arItem['DETAIL_PICTURE'];
    $arPicture = array();
    //$width = 285;
    //$height = 285;
    $width = 438;
    $height = 257;
    $size = 'S';
    if ($arFile['HEIGHT'] >= $arFile['WIDTH'] && intval($arFile['HEIGHT']) > $height) {
        $size = 'L';
    } else if ($arFile['HEIGHT'] < $arFile['WIDTH'] && intval($arFile['WIDTH']) > $width) {
        $size = 'M';
    }
    $arResultLocal = Indexis::getImageFormatted(array(
        'RESIZE' => 'Y',
        'FILE_VALUE' => $arFile,
        'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/no_photo.png',
        'WIDTH' => $width,
        'HEIGHT' => $height,
        'DEFAULT_ALT_TITLE' => $arItem['NAME']
    ));
    $arItem['PICTURE'] = $arResultLocal['PICTURE'];
    $arItem['PICTURE']['SIZE'] = $size;
    $arItem['PICTURE']['SOURCE_PICTURE'] = $arFile;
    $arItem['PICTURE']['SOURCE_DETAIL'] = $arFile;
}
