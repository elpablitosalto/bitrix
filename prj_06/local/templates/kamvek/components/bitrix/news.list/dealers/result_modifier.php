<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

// Id регионов -->
$arRegionsIds = array();
foreach ($arResult["ITEMS"] as $arItem) {
    if (intval($arItem['DISPLAY_PROPERTIES']['REGION']['VALUE']) > 0) {
        $arRegionsIds[] = $arItem['DISPLAY_PROPERTIES']['REGION']['VALUE'];
    }
}
// <-- Id регионов

// Регионы -->
$arResult['REGIONS'] = [];
if (!empty($arRegionsIds)) {
    $arSelect = array("ID", "NAME", 'PROPERTY_LATITUDE', 'PROPERTY_LONGITUDE', 'PROPERTY_MAP_ZOOM');
    $arFilter = array(
        "IBLOCK_ID" => Indexis::getIblockId('regions'),
        "ACTIVE_DATE" => "Y",
        "ACTIVE" => "Y",
        'ID' => $arRegionsIds,
    );
    $res = CIBlockElement::GetList(array(), $arFilter, false, array("nPageSize" => 50), $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $arResult['REGIONS'][] = $arFields;
    }
}
// <-- Регионы

// -->
foreach ($arResult["ITEMS"] as &$arItem) {
    $arItem['DISPLAY_PROPERTIES']['WEB']['VALUE_HREF'] = $arItem['DISPLAY_PROPERTIES']['WEB']['VALUE'];
    if (strpos($arItem['DISPLAY_PROPERTIES']['WEB']['VALUE'], 'http://') === false) {
        $arItem['DISPLAY_PROPERTIES']['WEB']['VALUE_HREF'] = 'http://' . $arItem['DISPLAY_PROPERTIES']['WEB']['VALUE'];
    }
}
// <--