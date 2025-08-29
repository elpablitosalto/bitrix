<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

foreach ($arResult['ITEMS'] as &$arItem) {

    // -->
    if (is_array($arItem['DISPLAY_PROPERTIES']['IMG_ABOUT_TOP']['FILE_VALUE'])) {
        $arFile = $arItem['DISPLAY_PROPERTIES']['IMG_ABOUT_TOP']['FILE_VALUE'];
    } else {
        $arFile = CFile::GetFileArray($arItem['DISPLAY_PROPERTIES']['IMG_ABOUT_TOP']['FILE_VALUE']);
    }
    $arResultLocal = getImageFormatted(array(
        'RESIZE' => 'Y',
        'FILE_VALUE' => $arFile,
        'WIDTH' => 2880,
        'HEIGHT' => 1140,
        'DEFAULT_ALT_TITLE' => $arItem['NAME']
    ));
    $arItem['IMG_ABOUT_TOP'] = $arResultLocal['PICTURE'];
    // <--

    // -->
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
    // <--

    // -->
    if (is_array($arItem['DISPLAY_PROPERTIES']['TEAM_IMG']['FILE_VALUE'])) {
        $arFile = $arItem['DISPLAY_PROPERTIES']['TEAM_IMG']['FILE_VALUE'];
    } else {
        $arFile = CFile::GetFileArray($arItem['DISPLAY_PROPERTIES']['TEAM_IMG']['FILE_VALUE']);
    }
    $arResultLocal = getImageFormatted(array(
        'RESIZE' => 'Y',
        'FILE_VALUE' => $arFile,
        'WIDTH' => 430,
        'HEIGHT' => 370,
        'DEFAULT_ALT_TITLE' => $arItem['NAME']
    ));
    $arItem['TEAM_IMG'] = $arResultLocal['PICTURE'];
    // <--

    // -->
    if (is_array($arItem['DISPLAY_PROPERTIES']['GROWTH_IMG']['FILE_VALUE'])) {
        $arFile = $arItem['DISPLAY_PROPERTIES']['GROWTH_IMG']['FILE_VALUE'];
    } else {
        $arFile = CFile::GetFileArray($arItem['DISPLAY_PROPERTIES']['GROWTH_IMG']['FILE_VALUE']);
    }
    $arResultLocal = getImageFormatted(array(
        'RESIZE' => 'Y',
        'FILE_VALUE' => $arFile,
        'WIDTH' => 875,
        'HEIGHT' => 420,
        'DEFAULT_ALT_TITLE' => $arItem['NAME']
    ));
    $arItem['GROWTH_IMG'] = $arResultLocal['PICTURE'];
    // <--

    // -->
    if (is_array($arItem['DISPLAY_PROPERTIES']['TRUST_US_IMG']['FILE_VALUE'])) {
        $arFile = $arItem['DISPLAY_PROPERTIES']['TRUST_US_IMG']['FILE_VALUE'];
    } else {
        $arFile = CFile::GetFileArray($arItem['DISPLAY_PROPERTIES']['TRUST_US_IMG']['FILE_VALUE']);
    }
    $arResultLocal = getImageFormatted(array(
        'RESIZE' => 'Y',
        'FILE_VALUE' => $arFile,
        'WIDTH' => 430,
        'HEIGHT' => 370,
        'DEFAULT_ALT_TITLE' => $arItem['NAME']
    ));
    $arItem['TRUST_US_IMG'] = $arResultLocal['PICTURE'];
    // <--


    // Преимущества - На главной -->
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
    // <-- Преимущества - На главной

    // Преимущества - О компании -->
    if (!empty($arItem['DISPLAY_PROPERTIES']['FEATURES_ABOUT']['VALUE'])) {
        foreach ($arItem['DISPLAY_PROPERTIES']['FEATURES_ABOUT']['VALUE'] as $key => $arFeature) {
            if (is_array($arFeature['SUB_VALUES']['FEATURES_ABOUT_IMG']['VALUE'])) {
                $arFile = $arFeature['SUB_VALUES']['FEATURES_ABOUT_IMG']['VALUE'];
            } else {
                $arFile = CFile::GetFileArray($arFeature['SUB_VALUES']['FEATURES_ABOUT_IMG']['VALUE']);
            }
            $arResultLocal = getImageFormatted(array(
                'RESIZE' => 'Y',
                'FILE_VALUE' => $arFile,
                'WIDTH' => 100,
                'HEIGHT' => 100,
                'DEFAULT_ALT_TITLE' => $arItem['NAME']
            ));
            $arItem['DISPLAY_PROPERTIES']['FEATURES_ABOUT']['VALUE'][$key]['SUB_VALUES']['FEATURES_ABOUT_IMG']['PICTURE']
                = $arResultLocal['PICTURE'];
        }
    }
    // <-- Преимущества - О компании
}

//vardump($arItem);
