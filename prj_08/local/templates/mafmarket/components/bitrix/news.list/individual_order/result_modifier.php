<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

foreach ($arResult["ITEMS"] as &$arItem) {
    $arItem['PICTURES'] = array();
    $arFiles = array();
    if (intval($arItem['DISPLAY_PROPERTIES']['IMAGES']['FILE_VALUE']['ID']) <= 0) {
        foreach ($arItem['DISPLAY_PROPERTIES']['IMAGES']['FILE_VALUE'] as $key => $arFileCustom) {
            $arFiles[] = $arFileCustom;
        }
    } else {
        $arFiles[] = $arItem['DISPLAY_PROPERTIES']['IMAGES']['FILE_VALUE'];
    }

    //vardump($arResult['DISPLAY_PROPERTIES']['IMAGES']);

    foreach ($arFiles as $key => $arFileCustom) {
        //vardump($arFileCustom);
        $arResultLocal = Indexis::getImageFormatted(array(
            'RESIZE' => 'N',
            'FILE_VALUE' => $arFileCustom,
            'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/reviewer-thumb.png',
            //'WIDTH' => 205,
            //'HEIGHT' => 116,
            'DEFAULT_ALT_TITLE' => $arItem['NAME']
        ));
        $arItem['PICTURES'][] = $arResultLocal['PICTURE'];
    }
    //vardump($arItem['PICTURES']);
}
