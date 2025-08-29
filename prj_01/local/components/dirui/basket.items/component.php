<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if ($arParams['IS_PARTNER'] == true) {
    $countBasketItems = 0;
    $countBasketItemsStr = '';
    // Список товаров в корзине -->
    $arResultFunc = COrder::getBasketItems(array(
        'IBLOCK_ID_BASKET' => $arParams['IBLOCK_ID_BASKET'],
        'USER_ID' => $arParams['USER_ID'],
    ));
    $arResult['BASKET_ITEMS'] = $arResultFunc['BASKET_ITEMS'];
    if (!empty($arResult['BASKET_ITEMS'])) {
        $countBasketItems = count($arResult['BASKET_ITEMS']);
        $countBasketItemsStr = $countBasketItems;
        $arResult['COUNT'] = $countBasketItems;
    }
    // <-- Список товаров в корзине
}

// Товары -->
$arResult['ITEMS'] = array();
$arItemsIds = array();
foreach ($arResult['BASKET_ITEMS'] as $key => $val) {
    if (intval($val['REAGENT']) > 0) {
        $arItemsIds[] = $val['REAGENT'];
    }
}
if (!empty($arItemsIds)) {
    $arSelect = array("ID", "NAME", "PREVIEW_PICTURE");
    $arFilter = array(
        "ID" => $arItemsIds, 
        //"ACTIVE_DATE" => "Y", 
        //"ACTIVE" => "Y"
    );
    $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();

        $arFile = CFile::GetFileArray($arFields["PREVIEW_PICTURE"]);

        $arItem = array();

        //$arItem['PICTURE'] = array();

        $arResultLocal = Indexis::getImageFormatted(array(
            'RESIZE' => 'N',
            'FILE_VALUE' => $arFile,
            //'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/reviewer-thumb.png',
            //'WIDTH' => 205,
            //'HEIGHT' => 116,
            'DEFAULT_ALT_TITLE' => $arFields['NAME']
        ));
        $arItem['PICTURE'] = $arResultLocal['PICTURE'];

        $arResult['ITEMS'][$arFields['ID']] = $arItem;
    }
}
//vardump($arResult);
// <-- Товары


/*
$this->setResultCacheKeys(array(
    "ID",
    "IBLOCK_TYPE_ID",
    "LIST_PAGE_URL",
    "NAV_CACHED_DATA",
    "NAME",
    "SECTION",
    "ELEMENTS",
    "IPROPERTY_VALUES",
    "ITEMS_TIMESTAMP_X",
));
*/
$this->includeComponentTemplate();
