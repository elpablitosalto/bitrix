<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

// Картинки -->
if (intval($arResult['DISPLAY_PROPERTIES']['IMAGE_MOB']['FILE_VALUE']['ID']) > 0) {

    $arResultLocal = Indexis::getImageFormatted(array(
        'RESIZE' => 'N',
        'FILE_VALUE' => $arResult['DISPLAY_PROPERTIES']['IMAGE_MOB']['FILE_VALUE'],
        'WIDTH' => 656,
        'HEIGHT' => 481,
        'DEFAULT_ALT_TITLE' => $arResult['NAME']
    ));
    $arResult['IMAGE_MOB'] = $arResultLocal['PICTURE'];
}
if (intval($arResult['DISPLAY_PROPERTIES']['IMAGE_LAP']['FILE_VALUE']['ID']) > 0) {
    $arResultLocal = Indexis::getImageFormatted(array(
        'RESIZE' => 'N',
        'FILE_VALUE' => $arResult['DISPLAY_PROPERTIES']['IMAGE_LAP']['FILE_VALUE'],
        'WIDTH' => 660,
        'HEIGHT' => 300,
        'DEFAULT_ALT_TITLE' => $arResult['NAME']
    ));
    $arResult['IMAGE_LAP'] = $arResultLocal['PICTURE'];
}
if (intval($arResult['DISPLAY_PROPERTIES']['IMAGE_DESK']['FILE_VALUE']['ID']) > 0) {
    $arResultLocal = Indexis::getImageFormatted(array(
        'RESIZE' => 'N',
        'FILE_VALUE' => $arResult['DISPLAY_PROPERTIES']['IMAGE_DESK']['FILE_VALUE'],
        'WIDTH' => 1200,
        'HEIGHT' => 340,
        'DEFAULT_ALT_TITLE' => $arResult['NAME']
    ));
    $arResult['IMAGE_DESK'] = $arResultLocal['PICTURE'];
}
// <-- Картинки
