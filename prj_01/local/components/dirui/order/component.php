<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

// Список товаров в корзине -->
$arResultFunc = COrder::getBasketItems(array(
    'IBLOCK_ID_BASKET' => $arParams['IBLOCK_ID_BASKET'],
    'USER_ID' => $arParams['USER_ID'],
));
$arResult['BASKET_ITEMS'] = $arResultFunc['BASKET_ITEMS'];
$arProductsIds = $arResultFunc['arProductsIds'];
// <-- Список товаров в корзине

// Направления -->
$arResultFunc = COrder::getIblocksDirections();
$arResult['DIRECTIONS'] = $arResultFunc['DIRECTIONS'];
// <-- Направления

// Товары -->
$arResultFunc = COrder::getProducts(array(
    'arProductsIds' => $arProductsIds,
    'CUR_DIRECTION' => $arParams['CUR_DIRECTION'],
    'CUR_PRODUCT_TYPE' => $arParams['CUR_PRODUCT_TYPE'],
    'BASKET_ITEMS' => $arResult['BASKET_ITEMS'],
));
$arResult['PRODUCTS'] = $arResultFunc['PRODUCTS'];
$arResult['arFilter'] = $arResultFunc['arFilter'];
// <-- Товары

// Элементы для вывода -->
$arResultFunc = COrder::getProductsOutput(array(
    'DIRECTIONS' => $arResult['DIRECTIONS'],
    'PRODUCTS' => $arResult['PRODUCTS'],
));
$arResult['ITEMS'] = $arResultFunc['ITEMS'];
//vardump($arResultFunc);
//vardump($arResult['ITEMS']);
// <-- Элементы для вывода

// Количество артикулов -->
//$arResult['COUNT_NUMBERS'] = count($arResult['BASKET_ITEMS']);
$arResult['COUNT_NUMBERS'] = count($arResult['PRODUCTS']);
// <-- Количество артикулов

// Умный фильтр -->
if (!empty($arProductsIds)) {
    $arResultFunc = COrder::getSmartFilter(array(
        'arProductsIds' => $arProductsIds,
        'DIRECTIONS' => $arResult['DIRECTIONS'],
    ));
    $arResult['DIRECTIONS'] = $arResultFunc['DIRECTIONS'];
    $arResult['PRODUCT_TYPES'] = $arResultFunc['PRODUCT_TYPES'];
}
// <-- Умный фильтр

// Пользователь -->
$filter = array('ID' => $arParams['USER_ID']);
$rsUsers = CUser::GetList(($by = "personal_country"), ($order = "desc"), $filter);
while ($arUser = $rsUsers->Fetch()) {
    $arResult['USER'] = $arUser;
}
// <-- Пользователь


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
