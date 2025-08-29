<?

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arResult['MENU'] = [];

//проверка на админа
$isAdmin_hair = false;
global $USER;
if ($USER->IsAdmin()){
	$isAdmin_hair = true;	
}
///

foreach($arResult as $k => $arItem):
		if (!$isAdmin_hair && $arItem['TEXT'] == "Biotin Secrets test") continue;  //выкидываем из меню тестовый раздел  задача 36560  - удалить после тестирования
    if(isset($arItem['PARAMS']['PARENT_SECTION_ID']) && !empty($arItem['PARAMS']['PARENT_SECTION_ID'])) {
		$arResult['MENU'][$arItem['PARAMS']['PARENT_SECTION_ID']]['ITEMS'][$k] = $arItem;
    }
    else {
        $arResult['MENU'][$arItem['PARAMS']['ITEM_ID']] = $arItem;
    }
endforeach;