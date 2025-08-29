<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

// Сортируем элементы в том порядке, в котором они расположены в фильтре
if ($arParams['USER_AUTHORIZED'] == 'Y' && $arParams['SORT_BY_ID'] == 'Y') {
    $arItems = [];
    if (!empty($arParams['FILTER_NAME']) && isset($GLOBALS[$arParams['FILTER_NAME']]['ID']) && is_array($GLOBALS[$arParams['FILTER_NAME']]['ID']))
    {
        foreach ($arResult['ITEMS'] as $arItem)
        {
            if (false !== $k = array_search($arItem['ID'], $GLOBALS[$arParams['FILTER_NAME']]['ID']))
            {
                $arItems[$k] = $arItem;
            }
        }
    }

    if (count($arItems) > 0)
    {
        ksort($arItems);
        $arResult['ITEMS'] = $arItems;
        unset($arItems);
    }
}

foreach ($arResult["ITEMS"] as &$arItem) {

    //vardump($arItem['DISPLAY_PROPERTIES']['THEME']);

    if (!empty($arItem['DISPLAY_PROPERTIES']['THEME']['DISPLAY_VALUE'])) {
        if (is_string($arItem['DISPLAY_PROPERTIES']['THEME']['DISPLAY_VALUE'])) {
            $arItem['DISPLAY_PROPERTIES']['THEME']['DISPLAY_VALUE'] = array($arItem['DISPLAY_PROPERTIES']['THEME']['DISPLAY_VALUE']);
        }
    }

    // Картинки -->
    $arItem['PICTURE'] = array();
    if (!empty($arItem['PREVIEW_PICTURE'])) {
        $arResultLocal = Indexis::getImageFormatted(array(
            'RESIZE' => 'N',
            'FILE_VALUE' => $arItem['PREVIEW_PICTURE'],
            'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/reviewer-thumb.png',
            //'WIDTH' => 205,
            //'HEIGHT' => 116,
            'DEFAULT_ALT_TITLE' => $arItem['NAME']
        ));
        $arItem['PICTURE'] = $arResultLocal['PICTURE'];
    }
    // <-- Картинки
}

// Если показываются сохраненные статьи -->
if (!empty($arParams['SAVED_IDS'])) {
    $arItemsTmp = array();
    foreach ($arResult["ITEMS"] as &$arItem) {
        $arItemsTmp[$arItem['ID']] = $arItem;
    }
    $arResult["ITEMS"] = $arItemsTmp;

    $arItemsTmp = array();
    foreach ($arParams['SAVED_IDS'] as $elId) {
        $arItemsTmp[$elId] = $arResult["ITEMS"][$elId];
    }
    $arResult["ITEMS"] = $arItemsTmp;
}
// <-- Если показываются сохраненные статьи

if ($arParams['USER_AUTHORIZED'] == 'Y') {
    $deal = new Deal();
    $arResult['ORDERS'] = $deal->getMyOrderList('courses');
}
