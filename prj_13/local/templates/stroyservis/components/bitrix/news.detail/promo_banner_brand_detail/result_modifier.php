<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

// URL на детальную страницу с учетом токена -->
$arResult['DETAIL_URL_TOKEN'] = $arResult['DETAIL_PAGE_URL'] . '?erid='.$arResult['DISPLAY_PROPERTIES']['BANNER_TOKEN']['VALUE'];
// <--

// Картинка баннера -->
if ($arResult['ID']) {

    $arResultLocal = Indexis::getImageFormatted(array(
        'RESIZE' => 'Y',
        'FILE_VALUE' => $arResult['DISPLAY_PROPERTIES']['BANNER_IMAGE']['FILE_VALUE'],
        'WIDTH' => 318,
        'HEIGHT' => 228,
        'DEFAULT_ALT_TITLE' => $arResult['NAME']
    ));
    $arResult['PICTURE'] = $arResultLocal['PICTURE'];
}
// <-- Картинка баннера