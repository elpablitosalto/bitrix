<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @global array $arParams */

$newItems = [];
foreach($arResult as $item){
    if($item["DEPTH_LEVEL"] == 2){
        $item["CHILD"] = [];
        $newItems[] = $item;
        $last = array_key_last($newItems);
    } else {
        $newItems[$last]["CHILD"][] = $item;
    }
}

$arResult = $newItems;