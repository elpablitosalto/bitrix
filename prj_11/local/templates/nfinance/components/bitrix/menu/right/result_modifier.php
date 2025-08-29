<?php
if (!empty($arResult)){
    $arItems = $arItemsMore = [];
    foreach($arResult as $index => $arMenuItem){
        if(empty($arMenuItem["PARAMS"]["MORE"]) || $arMenuItem["PARAMS"]["MORE"] != "Y"){
            $arItems[] = $arMenuItem;
        }else{
            $arItemsMore[] = $arMenuItem;
        }
        unset($arResult[$index]);
    }
    $arResult["ITEMS"] = $arItems;
    $arResult["ITEMS_MORE"] = $arItemsMore;
}