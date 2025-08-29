<?

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arResult['MENU'] = [];
foreach($arResult as $k => $arItem):
    if(isset($arItem['PARAMS']['PARENT_SECTION_ID']) && !empty($arItem['PARAMS']['PARENT_SECTION_ID'])) {
		$arResult['MENU'][$arItem['PARAMS']['PARENT_SECTION_ID']]['ITEMS'][$k] = $arItem;
    }
    else {
        $arResult['MENU'][$arItem['PARAMS']['ITEM_ID']] = $arItem;
    }
endforeach;