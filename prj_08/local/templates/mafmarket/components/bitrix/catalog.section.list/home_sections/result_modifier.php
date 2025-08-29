<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

foreach ($arResult['SECTIONS'] as &$arSection) {

    $arFile = CFile::GetFileArray($arSection["DETAIL_PICTURE"]);
    $arResultLocal = Indexis::getImageFormatted(array(
        'RESIZE' => 'N',
        'FILE_VALUE' => $arFile,
        'NO_IMAGE_DEFAULT' => $this->GetFolder().'/images/reviewer-thumb.png',
        //'WIDTH' => 205,
        //'HEIGHT' => 116,
        'DEFAULT_ALT_TITLE' => $arSection['NAME']
    ));
    $arSection['DETAIL_PICTURE'] = $arResultLocal['PICTURE'];

    //vardump($arSection);

    //$arFile = CFile::GetFileArray($arSection["PICTURE"]);
    $arFile = $arSection["PICTURE"];
    $arResultLocal = Indexis::getImageFormatted(array(
        'RESIZE' => 'N',
        'FILE_VALUE' => $arFile,
        'NO_IMAGE_DEFAULT' => $this->GetFolder().'/images/reviewer-thumb.png',
        //'WIDTH' => 205,
        //'HEIGHT' => 116,
        'DEFAULT_ALT_TITLE' => $arSection['NAME']
    ));
    $arSection['PICTURE'] = $arResultLocal['PICTURE'];
}

/*
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
*/