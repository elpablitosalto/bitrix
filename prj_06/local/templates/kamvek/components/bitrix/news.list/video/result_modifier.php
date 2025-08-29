<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();


foreach ($arResult["ITEMS"] as &$arItem) {
    $arResultLocal = Indexis::getImageFormatted(array(
        'RESIZE' => 'Y',
        'FILE_VALUE' => $arItem['PREVIEW_PICTURE'],
        'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/no_photo.png',
        'WIDTH' => 600,
        'HEIGHT' => 600,
        'DEFAULT_ALT_TITLE' => $arItem['NAME']
    ));
    $arItem['PICTURE'] = $arResultLocal['PICTURE'];
}
