<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

//$this->__component->SetResultCacheKeys(array("DISPLAY_PROPERTIES"));

foreach ($arResult["ITEMS"] as &$arItem) {
    // Картинки -->
    if (!empty($arItem['PREVIEW_PICTURE'])) {
        $arResultLocal = Indexis::getImageFormatted(array(
            'RESIZE' => 'Y',
            'FILE_VALUE' => $arItem['PREVIEW_PICTURE'],
            'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/reviewer-thumb.png',
            'WIDTH' => 767,
            'HEIGHT' => 5000,
            'DEFAULT_ALT_TITLE' => $arItem['NAME']
        ));
        $arItem['PICTURE_1']['1'] = $arResultLocal['PICTURE'];

        $arResultLocal = Indexis::getImageFormatted(array(
            'RESIZE' => 'Y',
            'FILE_VALUE' => $arItem['PREVIEW_PICTURE'],
            'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/reviewer-thumb.png',
            'WIDTH' => 1199,
            'HEIGHT' => 5000,
            'DEFAULT_ALT_TITLE' => $arItem['NAME']
        ));
        $arItem['PICTURE_1']['2'] = $arResultLocal['PICTURE'];


        $arResultLocal = Indexis::getImageFormatted(array(
            'RESIZE' => 'N',
            'FILE_VALUE' => $arItem['PREVIEW_PICTURE'],
            'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/reviewer-thumb.png',
            //'WIDTH' => 205,
            //'HEIGHT' => 116,
            'DEFAULT_ALT_TITLE' => $arItem['NAME']
        ));
        $arItem['PICTURE_1']['3'] = $arResultLocal['PICTURE'];
    }

    if (!empty($arItem['DETAIL_PICTURE'])) {
        $arResultLocal = Indexis::getImageFormatted(array(
            'RESIZE' => 'Y',
            'FILE_VALUE' => $arItem['DETAIL_PICTURE'],
            'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/reviewer-thumb.png',
            'WIDTH' => 767,
            'HEIGHT' => 5000,
            'DEFAULT_ALT_TITLE' => $arItem['NAME']
        ));
        $arItem['PICTURE_2']['1'] = $arResultLocal['PICTURE'];

        $arResultLocal = Indexis::getImageFormatted(array(
            'RESIZE' => 'Y',
            'FILE_VALUE' => $arItem['DETAIL_PICTURE'],
            'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/reviewer-thumb.png',
            'WIDTH' => 1199,
            'HEIGHT' => 5000,
            'DEFAULT_ALT_TITLE' => $arItem['NAME']
        ));
        $arItem['PICTURE_2']['2'] = $arResultLocal['PICTURE'];

        $arResultLocal = Indexis::getImageFormatted(array(
            'RESIZE' => 'N',
            'FILE_VALUE' => $arItem['DETAIL_PICTURE'],
            'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/reviewer-thumb.png',
            //'WIDTH' => 205,
            //'HEIGHT' => 116,
            'DEFAULT_ALT_TITLE' => $arItem['NAME']
        ));
        $arItem['PICTURE_2']['3'] = $arResultLocal['PICTURE'];
    }
    // <-- Картинки

    /*
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
        $arResultLocal = Indexis::getImageFormatted(array(
            'RESIZE' => 'N',
            'FILE_VALUE' => $arItem['PREVIEW_PICTURE'],
            'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/reviewer-thumb.png',
            //'WIDTH' => 205,
            //'HEIGHT' => 116,
            'DEFAULT_ALT_TITLE' => $arItem['NAME']
        ));
        $arItem['PICTURES'][] = $arResultLocal['PICTURE'];
    }
    */
}
