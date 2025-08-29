<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

// Сортируем элементы в том порядке, в котором они расположены в фильтре
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
