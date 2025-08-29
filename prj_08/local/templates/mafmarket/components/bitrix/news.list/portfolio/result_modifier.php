<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

foreach ($arResult["ITEMS"] as &$arItem) {
    //if (!empty($arItem['PREVIEW_PICTURE'])) {
    if (true) {
        $arResultLocal = Indexis::getImageFormatted(array(
            'RESIZE' => 'N',
            'FILE_VALUE' => $arItem['PREVIEW_PICTURE'],
            'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/reviewer-thumb.png',
            //'WIDTH' => 205,
            //'HEIGHT' => 116,
            'DEFAULT_ALT_TITLE' => $arItem['NAME']
        ));
        $arItem['PICTURE'] = $arResultLocal['PICTURE'];
        //vardump($arItem['PICTURE']);
    }

    if (!is_array($arItem['DISPLAY_PROPERTIES']['OBJECT_TYPE']['DISPLAY_VALUE'])) {
        if (strlen($arItem['DISPLAY_PROPERTIES']['OBJECT_TYPE']['DISPLAY_VALUE']) > 0) {
            $arItem['DISPLAY_PROPERTIES']['OBJECT_TYPE']['DISPLAY_VALUE'] = array($arItem['DISPLAY_PROPERTIES']['OBJECT_TYPE']['DISPLAY_VALUE']);
        }
    }
}
