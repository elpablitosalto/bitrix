<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

foreach ($arResult["ITEMS"] as &$arItem) {
    $arResultLocal = Indexis::getImageFormatted(array(
        'RESIZE' => 'Y',
        'FILE_VALUE' => $arItem['PREVIEW_PICTURE'],
        'WIDTH' => 370,
        'HEIGHT' => 439,
        'DEFAULT_ALT_TITLE' => $arItem['NAME']
    ));
    $arItem['PICTURE'] = $arResultLocal['PICTURE'];
}