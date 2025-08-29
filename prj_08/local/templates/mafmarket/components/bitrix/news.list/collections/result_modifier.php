<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

foreach ($arResult["ITEMS"] as &$arItem) {
    //if (!empty($arItem['PREVIEW_PICTURE'])) {
    if (true) {
        $arResultLocal = Indexis::getImageFormatted(array(
            'RESIZE' => 'N',
            'FILE_VALUE' => $arItem['PREVIEW_PICTURE'],
            'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/reviewer-thumb.png',
            //'WIDTH' => 205,
            //'HEIGHT' => 116,
            'DEFAULT_ALT_TITLE' => $arItem['NAME']
        ));
        $arItem['PICTURE'] = $arResultLocal['PICTURE'];
        //vardump($arItem['PICTURE']);
    }

    /*
    if (!is_array($arItem['DISPLAY_PROPERTIES']['OBJECT_TYPE']['DISPLAY_VALUE'])) {
        if (strlen($arItem['DISPLAY_PROPERTIES']['OBJECT_TYPE']['DISPLAY_VALUE']) > 0) {
            $arItem['DISPLAY_PROPERTIES']['OBJECT_TYPE']['DISPLAY_VALUE'] = array($arItem['DISPLAY_PROPERTIES']['OBJECT_TYPE']['DISPLAY_VALUE']);
        }
    }
    */
}

// Все коллекции -->
$arResult['ITEMS_ALL'] = array();
$arItemsIds = array();
if (!empty($arParams['IBLOCK_ID'])) {
    $arSelect = array("ID", "NAME", "DATE_ACTIVE_FROM");
    $arFilter = array("IBLOCK_ID" => $arParams['IBLOCK_ID'], "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
    $res = CIBlockElement::GetList(array('sort' => 'asc', 'name' => 'asc'), $arFilter, false, false, $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $arResult['ITEMS_ALL'][$arFields['ID']] = array(
            'ID' => $arFields['ID'],
            'NAME' => $arFields['NAME'],
        );
        $arItemsIds[] = $arFields['ID'];
    }
}
// <-- Все коллекции


// Товары -->
$arResult['PRODUCTS'] = array();
if (!empty($arParams['PRODUCTS_IBLOCK_ID']) && !empty( $arItemsIds )) {
    $arSelect = array("ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_COLLECTIONS");
    $arFilter = array(
        "IBLOCK_ID" => $arParams['PRODUCTS_IBLOCK_ID'], 
        "ACTIVE_DATE" => "Y", 
        "ACTIVE" => "Y",
        "PROPERTY_COLLECTIONS" => $arItemsIds,
    );
    $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $arResult['PRODUCTS'][$arFields['ID']] = array(
            'ID' => $arFields['ID'],
            'NAME' => $arFields['NAME'],
            'COLLECTIONS' => serialize($arFields['PROPERTY_COLLECTIONS_VALUE']),
        );
    }
}
// <-- Товары


// Товары, вариант №2 -->
$arSectionsAll = [];
//$arSectionsEquals = [];
$arSectionsNamesAll = [];
$arSectionsEquals = [];
$arSectionsParents = [];
$arResult['SECTIONS'] = [];
if (!empty($arParams['PRODUCTS_IBLOCK_ID'])) {
    $arFilter = array(
        'IBLOCK_ID' => $arParams['PRODUCTS_IBLOCK_ID'],
        'GLOBAL_ACTIVE' => 'Y',
    );
    $db_list = CIBlockSection::GetList(array($by => $order), $arFilter, true);
    while ($ar_result = $db_list->GetNext()) {
        $ar = array(
            'ID' => $ar_result['ID'],
            'NAME' => $ar_result['NAME'],
            'ELEMENT_CNT' => $ar_result['ELEMENT_CNT'],
            'IBLOCK_SECTION_ID' => $ar_result['IBLOCK_SECTION_ID'],
            'CNT' => 0,
        );

        $arSectionsAll[$ar_result['ID']] = $ar;

        $arSectionsNamesAll[$ar_result['ID']] = $ar_result['NAME'];
    }
}
foreach($arResult['ITEMS_ALL'] AS $elId => $arEl)
{
    //if( in_array( $arEl['NAME'], $arSectionsNamesAll ) )

    $sId = array_search($arEl['NAME'], $arSectionsNamesAll);
    if( intval( $sId ) > 0 )
    {
        $parentSId = $arSectionsAll[$sId]['IBLOCK_SECTION_ID'];
        //$arSectionsEquals[$parentSId] = $arSectionsAll[$parentSId];
        $arSectionsParents[$parentSId][] = $arEl['ID'];
        $arSectionsEquals[$sId] = $arSectionsAll[$sId];
    }
}
if (!empty($arSectionsEquals)) {
    foreach ($arSectionsEquals as $sId => $arS) {
        $arResult['SECTIONS'][$arS['IBLOCK_SECTION_ID']] = $arSectionsAll[$arS['IBLOCK_SECTION_ID']];

        if( !empty( $arSectionsParents[$arS['IBLOCK_SECTION_ID']] ) )
        {
            $arResult['SECTIONS'][$arS['IBLOCK_SECTION_ID']]['ELS_IDS'] = serialize($arSectionsParents[$arS['IBLOCK_SECTION_ID']]);
        }
    }
}

// <-- Товары, вариант №2


$arResult['FORM_ACTION'] = $_SERVER['REQUEST_URI'];