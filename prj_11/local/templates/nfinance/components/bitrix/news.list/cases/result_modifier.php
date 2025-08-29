<?php
if (!empty($arResult["ITEMS"])){
    foreach ($arResult["ITEMS"] as &$arItem){
        if (!empty($arItem["PROPERTIES"]["AUTHORS"]["VALUE"]) && !empty($arItem["PROPERTIES"]["AUTHORS"]["LINK_IBLOCK_ID"])){
            $arItem["AUTHOR_DATA"] = [];
            foreach ($arItem["PROPERTIES"]["AUTHORS"]["VALUE"] as $authorId){
                $rsAuthor = \Bitrix\Iblock\ElementTable::getById(intval($authorId));
                if($arAuthor = $rsAuthor->fetch()){
                    $arItem["AUTHOR_DATA"] = $arAuthor;
                    break;
                }
            }
        }
    }
}