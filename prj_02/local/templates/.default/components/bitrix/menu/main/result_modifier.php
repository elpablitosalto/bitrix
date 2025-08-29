<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @global array $arParams */

$newItems = [];
foreach($arResult as $item){
    if($item["DEPTH_LEVEL"] == 2){
        $item["CHILD"] = [];
        $column = $item["PARAMS"]["UF_COLUMN"];
        $newItems[$column][] = $item;
        $last = array_key_last($newItems[$column]);
    } else {
        $newItems[$column][$last]["CHILD"][] = $item;
    }
}

ksort($newItems);
$arResult = $newItems;