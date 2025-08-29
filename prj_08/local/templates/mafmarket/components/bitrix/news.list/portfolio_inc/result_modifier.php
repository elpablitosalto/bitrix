<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

foreach ($arResult["ITEMS"] as &$arItem) {
    //vardump($arItem['DISPLAY_PROPERTIES']['PICTURE_CUSTOM_ORDER']);
    if (!empty($arItem['DISPLAY_PROPERTIES']['PICTURE_CUSTOM_ORDER']['FILE_VALUE'])) {
        $arResultLocal = Indexis::getImageFormatted(array(
            'RESIZE' => 'N',
            'FILE_VALUE' => $arItem['DISPLAY_PROPERTIES']['PICTURE_CUSTOM_ORDER']['FILE_VALUE'],
            'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/reviewer-thumb.png',
            //'WIDTH' => 205,
            //'HEIGHT' => 116,
            'DEFAULT_ALT_TITLE' => $arItem['NAME']
        ));
        $arItem['PICTURE'] = $arResultLocal['PICTURE'];
        //vardump($arItem['PICTURE']);
    }
}
