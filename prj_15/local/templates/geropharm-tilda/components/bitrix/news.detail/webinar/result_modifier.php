<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<?
if (!is_array($arResult["DISPLAY_PROPERTIES"]['THEME']['DISPLAY_VALUE'])) {
    if (strlen($arResult["DISPLAY_PROPERTIES"]['THEME']['DISPLAY_VALUE']) > 0) {
        $arResult["DISPLAY_PROPERTIES"]['THEME']['DISPLAY_VALUE'] = array($arResult["DISPLAY_PROPERTIES"]['THEME']['DISPLAY_VALUE']);
    }
}

// Изображение -->
if (!empty($arResult['DETAIL_PICTURE'])) {
    $arResultLocal = Indexis::getImageFormatted(array(
        'RESIZE' => 'N',
        'FILE_VALUE' => $arResult['DETAIL_PICTURE'],
        'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/reviewer-thumb.png',
        //'WIDTH' => 205,
        //'HEIGHT' => 116,
        'DEFAULT_ALT_TITLE' => $arResult['NAME']
    ));
    $arResult['PICTURE'] = $arResultLocal['PICTURE'];
}
// <-- Изображение

// Фильтр по темам -->
//vardump($arResult["DISPLAY_PROPERTIES"]['THEME']);
foreach ($arResult["DISPLAY_PROPERTIES"]['THEME']['~VALUE'] as $key => $val) {
    $arResult['arFilterResult']['PROPERTY_THEME'][] = $val;
}
// <-- Фильтр по темам

// Текст -->
if ($arParams['USER_AUTHORIZED'] == 'N') {
    $str = $arResult['DETAIL_TEXT'];
    $str = strip_tags($str);
    $arResult['DETAIL_TEXT'] = TruncateText($str, 500);
}
// <-- Текст

$arResult["EX_ID"] = $arResult["PROPERTIES"]["EVENTSESSION_ID"]["VALUE"];

?>

<?
$this->__component->SetResultCacheKeys(array("ID", "EX_ID", "NAME", "arFilterResult"));
?>