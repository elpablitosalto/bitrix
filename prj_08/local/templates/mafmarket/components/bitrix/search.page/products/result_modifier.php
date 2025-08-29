<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();


//vardump($arResult);

$arResult['ITEMS'] = array();
$arResult['ITEMS_IDS'] = array();

// ID элементов, разделов -->
$arElementsIds = array();
$arSectionsIds = array();
if (!empty($arResult['SEARCH'])) {
    foreach ($arResult['SEARCH'] as $key => $arItem) {
        if (strpos($arItem['ITEM_ID'], 'S') !== false) {
            $sId = str_replace('S', '', $arItem['ITEM_ID']);
            if (intval($sId) > 0) {
                $arSectionsIds[] = $sId;
            }
        } else {
            $arElementsIds[] = $arItem['ITEM_ID'];
        }
    }
}
//vardump($arElementsIds);
// <-- ID элементов, разделов

// Подразделы -->
if (!empty($arSectionsIds)) {
    $arFilter = array(
        'ID' => $arSectionsIds, 
    );
    $db_list = CIBlockSection::GetList(array($by => $order), $arFilter, true);
    while ($ar_result = $db_list->GetNext()) {
        $arFilter = array(
            'IBLOCK_ID' => $ar_result['IBLOCK_ID'], 
            '>LEFT_MARGIN' => $ar_result['LEFT_MARGIN'], 
            '<RIGHT_MARGIN' => $ar_result['RIGHT_MARGIN'], 
            '>DEPTH_LEVEL' => $ar_result['DEPTH_LEVEL']
        ); // выберет потомков без учета активности
        $rsSect = CIBlockSection::GetList(array('left_margin' => 'asc'), $arFilter);
        while ($arSect = $rsSect->GetNext()) {
            // получаем подразделы
            if (!in_array($arSect['ID'], $arSectionsIds)) {
                $arSectionsIds[] = $arSect['ID'];
            }
        }
    }
}

// <-- Подразделы

// Элементы в разделах -->
if (!empty($arSectionsIds)) {
    $arSelect = array("ID");
    $arFilter = array(
        //"IBLOCK_ID" => $IBLOCK_ID,
        "ACTIVE_DATE" => "Y",
        "ACTIVE" => "Y",
        "SECTION_ID" => $arSectionsIds,
    );
    $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        //vardump($arFields);
        if (!in_array($arFields['ID'], $arElementsIds)) {
            $arElementsIds[] = $arFields['ID'];
        }
    }
}
// <-- Элементы в разделах

$arResult['IDS'] = $arElementsIds;

/*
// Изделия -->
if (!empty($arElementsIds) && !empty($arParams['PRODUCTS_IBLOCK_ID'])) {

    $arSelect = array("ID", "NAME", "DETAIL_PAGE_URL", 'PREVIEW_PICTURE', 'IBLOCK_SECTION_ID');
    $arFilter = array(
        "IBLOCK_ID" => $arParams['PRODUCTS_IBLOCK_ID'],
        "ACTIVE_DATE" => "Y",
        "ACTIVE" => "Y",
        "ID" => $arElementsIds,
    );
    $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();

        $arFile = CFile::GetFileArray($arFields["PREVIEW_PICTURE"]);
        $arResultLocal = Indexis::getImageFormatted(array(
            'RESIZE' => 'N',
            'FILE_VALUE' => $arFile,
            'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/reviewer-thumb.png',
            //'WIDTH' => 205,
            //'HEIGHT' => 116,
            'DEFAULT_ALT_TITLE' => $arFields['NAME']
        ));

        $arResult['MATERIALS'][$arFields['IBLOCK_SECTION_ID']]['ITEMS'][$arFields['ID']] = array(
            'NAME' => $arFields['NAME'],
            'DETAIL_PAGE_URL' => $arFields['DETAIL_PAGE_URL'],
            'PICTURE' => $arResultLocal['PICTURE'],
            'IBLOCK_SECTION_ID' => $arFields['IBLOCK_SECTION_ID']
        );
    }
}
// <-- Изделия
*/


//vardump($arElementsIds);

// Дополнительно -->
$arResult['SHOW_RESULTS'] = !empty($arElementsIds) ? 'Y' : 'N';

$arResult['RESULTS_COUNT'] = 0;
if ($arResult['SHOW_RESULTS'] == 'Y') {
    $arResult['RESULTS_COUNT'] = count($arElementsIds);
}

$arResult['QUERY'] = $arResult['REQUEST']['QUERY'];
// <-- Дополнительно

$this->__component->SetResultCacheKeys(array("ITEMS_IDS", "SHOW_RESULTS", "RESULTS_COUNT", "QUERY", "IDS"));
?>