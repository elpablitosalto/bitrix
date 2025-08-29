<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

foreach ($arResult['ITEMS'] as &$arItem) {
    if (is_array($arItem['DISPLAY_PROPERTIES']['IMG_MAIN']['FILE_VALUE'])) {
        $arFile = $arItem['DISPLAY_PROPERTIES']['IMG_MAIN']['FILE_VALUE'];
    } else {
        $arFile = CFile::GetFileArray($arItem['DISPLAY_PROPERTIES']['IMG_MAIN']['FILE_VALUE']);
    }
    $arResultLocal = getImageFormatted(array(
        'RESIZE' => 'Y',
        'FILE_VALUE' => $arFile,
        'WIDTH' => 430,
        'HEIGHT' => 370,
        'DEFAULT_ALT_TITLE' => $arItem['NAME']
    ));
    $arItem['IMG_MAIN'] = $arResultLocal['PICTURE'];

    // Преимущества -->
    if (!empty($arItem['DISPLAY_PROPERTIES']['FEATURES_MAIN']['VALUE'])) {
        foreach ($arItem['DISPLAY_PROPERTIES']['FEATURES_MAIN']['VALUE'] as $key => $arFeature) {
            if (is_array($arFeature['SUB_VALUES']['FEATURES_MAIN_IMG']['VALUE'])) {
                $arFile = $arFeature['SUB_VALUES']['FEATURES_MAIN_IMG']['VALUE'];
            } else {
                $arFile = CFile::GetFileArray($arFeature['SUB_VALUES']['FEATURES_MAIN_IMG']['VALUE']);
            }
            $arResultLocal = getImageFormatted(array(
                'RESIZE' => 'Y',
                'FILE_VALUE' => $arFile,
                'WIDTH' => 50,
                'HEIGHT' => 50,
                'DEFAULT_ALT_TITLE' => $arItem['NAME']
            ));
            $arItem['DISPLAY_PROPERTIES']['FEATURES_MAIN']['VALUE'][$key]['SUB_VALUES']['FEATURES_MAIN_IMG']['PICTURE']
                = $arResultLocal['PICTURE'];
        }
    }
    // <--
}

//vardump($arItem);
