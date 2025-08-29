<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->__component->SetResultCacheKeys(array("NAME", "DETAIL_PICTURE", "DETAIL_TEXT", "~DETAIL_TEXT", "DISPLAY_PROPERTIES"));


$arResult['PICTURES'] = array();
$arFiles = array();
//vardump($arResult['DISPLAY_PROPERTIES']['IMAGES']);
if (intval($arResult['DISPLAY_PROPERTIES']['IMAGES']['FILE_VALUE']['ID']) <= 0) {
    foreach ($arResult['DISPLAY_PROPERTIES']['IMAGES']['FILE_VALUE'] as $key => $arFileCustom) {
        $arFiles[] = $arFileCustom;
    }
} else {
    $arFiles[] = $arResult['DISPLAY_PROPERTIES']['IMAGES']['FILE_VALUE'];
}

foreach ($arFiles as $key => $arFileCustom) {
    $arPicture = array(
        'SRC' => $arFileCustom['SRC'],
        'ALT' => ('' != $arFileCustom["ALT"]
            ? $arFileCustom["ALT"]
            : $arItem["NAME"]
        ),
        'TITLE' => ('' != $arFileCustom["TITLE"]
            ? $arFileCustom["TITLE"]
            : $arItem["NAME"]
        ),
        'HEIGHT' => $arFileCustom['HEIGHT'],
        'WIDTH' => $arFileCustom['WIDTH'],
        'SOURCE_PICTURE' => $arFileCustom,
    );
    $arResult['PICTURES'][] = $arPicture;
}
