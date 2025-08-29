<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arResult['arSections'] = array();
$arFilter = array(
    'IBLOCK_ID' => $arParams['IBLOCK_ID'],
    'GLOBAL_ACTIVE' => 'Y',
    'CNT_ALL' => 'N',
    'CNT_ACTIVE' => 'Y',
);
$db_list = CIBlockSection::GetList(array('sort' => 'asc'), $arFilter, true);
while ($ar_result = $db_list->GetNext()) {
    if (intval($ar_result['ELEMENT_CNT']) > 0) {
        $arResult['arSections'][$ar_result['ID']] = $ar_result;
    }
}
