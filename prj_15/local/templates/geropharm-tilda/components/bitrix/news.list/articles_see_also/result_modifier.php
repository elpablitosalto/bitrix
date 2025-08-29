<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach ($arResult["ITEMS"] as &$arItem) {

    if (!empty($arItem['DISPLAY_PROPERTIES']['THEME']['DISPLAY_VALUE'])) {
        if (is_string($arItem['DISPLAY_PROPERTIES']['THEME']['DISPLAY_VALUE'])) {
            $arItem['DISPLAY_PROPERTIES']['THEME']['DISPLAY_VALUE'] = array($arItem['DISPLAY_PROPERTIES']['THEME']['DISPLAY_VALUE']);
        }
    }

    // Изображение -->
    $arResultLocal = Indexis::getImageFormatted(array(
        'RESIZE' => 'N',
        'FILE_VALUE' => $arItem['PREVIEW_PICTURE'],
        'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/reviewer-thumb.png',
        //'WIDTH' => 205,
        //'HEIGHT' => 116,
        'DEFAULT_ALT_TITLE' => $arItem['NAME']
    ));
    $arItem['PICTURE'] = $arResultLocal['PICTURE'];
    // <-- Изображение
}
