<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

// Элементы разделов -->
$arResult['arElements'] = [];
if (intval($arParams['IBLOCK_ID']) > 0) {
    $arSelect = array("ID", "NAME", "DETAIL_TEXT", "IBLOCK_SECTION_ID");
    $arFilter = array("IBLOCK_ID" => $arParams['IBLOCK_ID'], "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
    $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();

        $arResult['arElements'][$arFields['IBLOCK_SECTION_ID']][$arFields['ID']] = $arFields;
    }
}
// <-- Элементы разделов
