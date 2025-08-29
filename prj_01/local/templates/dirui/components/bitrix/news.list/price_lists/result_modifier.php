<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

//$arItemsTmp = array();
foreach ($arResult["ITEMS"] as &$item) {
    if (!empty($item["DISPLAY_PROPERTIES"]["FILE"]["FILE_VALUE"])) {
        $arFile = $item["DISPLAY_PROPERTIES"]["FILE"]["FILE_VALUE"];
        $src = $arFile['SRC'];
        if ($arParams['CHECK_PARTNER'] == 'Y') {
            if ($arResult['SHOW_DETAIL_PAGE_URL'] == 'N') {
                $src = $GLOBALS['arSiteConfig']['LINKS']['REG_PARTNER'];
            }
        }
        $item['FILE'] = array(
            'SRC' => $src,
            'NAME' => $item['NAME'],
            'DATE' => FormatDate("d.m.Y", MakeTimeStamp($item["ACTIVE_FROM"])),
            'SIZE_FORMAT' => Indexis::formatSizeUnits($arFile['FILE_SIZE']),
            'TYPE_FORMAT' => Indexis::getExtension($arFile['SRC'], false, true),
        );
        //$item["BANNER"] = CFile::GetPath($item["PROPERTIES"]["FILE"]["VALUE"]);
    }
}

// Разделы -->
$arResult['SECTIONS'] = array();
$arFilter = array(
    'IBLOCK_ID' => $arParams['IBLOCK_ID'],
    'GLOBAL_ACTIVE' => 'Y',
);
$db_list = CIBlockSection::GetList(array('sort' => 'asc'), $arFilter, true);
while ($ar_result = $db_list->GetNext()) {
    $arResult['SECTIONS'][$ar_result['ID']] = array(
        'NAME' => $ar_result['NAME'],
        'CODE' => $ar_result['CODE'],
        'ITEMS' => array()
    );
}
//vardump($arResult['SECTIONS']);
//vardump($arResult["ITEMS"]);
// <-- Разделы

if (!empty($arResult['SECTIONS'])) {
    foreach ($arResult["ITEMS"] as &$item) {
        //echo 'IBLOCK_SECTION_ID = '.$item['IBLOCK_SECTION_ID'].'<br />';
        if (intval($item['IBLOCK_SECTION_ID']) > 0) {
            $arResult['SECTIONS'][$item['IBLOCK_SECTION_ID']]['ITEMS'][$item['ID']] = $item;
        }
    }
} else {
    foreach ($arResult["ITEMS"] as &$item) {
        $arResult['SECTIONS']['ONE']['ITEMS'][$item['ID']] = $item;
    }
}
