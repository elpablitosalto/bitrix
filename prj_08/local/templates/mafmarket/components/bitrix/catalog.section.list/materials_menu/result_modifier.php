<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arSectionsIds = array();
$arSections = array();
foreach ($arResult['SECTIONS'] as &$arSection) {
    $arSectionsIds[] = $arSection['ID'];
    $arSections[$arSection['ID']] = $arSection;
}
$arResult['SECTIONS'] = $arSections;

if (!empty($arSectionsIds) && intval($arParams['IBLOCK_ID']) > 0) {
    $arSelect = array("ID", "NAME", "DETAIL_PAGE_URL", 'IBLOCK_SECTION_ID', 'CODE');
    $arFilter = array(
        "IBLOCK_ID" => $arParams['IBLOCK_ID'],
        "ACTIVE_DATE" => "Y",
        "ACTIVE" => "Y",
        'SECTION_ID' => $arSectionsIds
    );
    $res = CIBlockElement::GetList(array('sort' => 'asc'), $arFilter, false, false, $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();

        $arResult['SECTIONS'][$arFields['IBLOCK_SECTION_ID']]['ELEMENTS'][$arFields['ID']] = $arFields;
    }
}
