<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

foreach ($arResult["ITEMS"] as &$arItem) {
    $arItem['PICTURES_PLUS'] = array();
    $arFiles = array();
    if (intval($arItem['DISPLAY_PROPERTIES']['PICTURES_PLUS']['FILE_VALUE']['ID']) <= 0) {
        foreach ($arItem['DISPLAY_PROPERTIES']['PICTURES_PLUS']['FILE_VALUE'] as $key => $arFileCustom) {
            $arFiles[] = $arFileCustom;
        }
    } else {
        $arFiles[] = $arItem['DISPLAY_PROPERTIES']['PICTURES_PLUS']['FILE_VALUE'];
    }
    foreach ($arFiles as $key => $arFileCustom) {
        $arResultLocal = Indexis::getImageFormatted(array(
            'RESIZE' => 'N',
            'FILE_VALUE' => $arItem['PREVIEW_PICTURE'],
            'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/reviewer-thumb.png',
            //'WIDTH' => 205,
            //'HEIGHT' => 116,
            'DEFAULT_ALT_TITLE' => $arItem['NAME']
        ));
        $arItem['PICTURES_PLUS'][] = $arResultLocal['PICTURE'];
    }

    $arItem['PICTURES_MINUS'] = array();
    $arFiles = array();
    if (intval($arItem['DISPLAY_PROPERTIES']['PICTURES_MINUS']['FILE_VALUE']['ID']) <= 0) {
        foreach ($arItem['DISPLAY_PROPERTIES']['PICTURES_MINUS']['FILE_VALUE'] as $key => $arFileCustom) {
            $arFiles[] = $arFileCustom;
        }
    } else {
        $arFiles[] = $arItem['DISPLAY_PROPERTIES']['PICTURES_MINUS']['FILE_VALUE'];
    }
    foreach ($arFiles as $key => $arFileCustom) {
        $arResultLocal = Indexis::getImageFormatted(array(
            'RESIZE' => 'N',
            'FILE_VALUE' => $arItem['PREVIEW_PICTURE'],
            'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/reviewer-thumb.png',
            //'WIDTH' => 205,
            //'HEIGHT' => 116,
            'DEFAULT_ALT_TITLE' => $arItem['NAME']
        ));
        $arItem['PICTURES_MINUS'][] = $arResultLocal['PICTURE'];
    }

    if (!is_array($arItem['DISPLAY_PROPERTIES']['TEXTS_PLUS']['DISPLAY_VALUE'])) {
        if (strlen($arItem['DISPLAY_PROPERTIES']['TEXTS_PLUS']['DISPLAY_VALUE']) > 0) {
            $arItem['DISPLAY_PROPERTIES']['TEXTS_PLUS']['DISPLAY_VALUE'] = array($arItem['DISPLAY_PROPERTIES']['TEXTS_PLUS']['DISPLAY_VALUE']);
        }
    }
}
