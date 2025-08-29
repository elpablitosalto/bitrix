<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?
    $arResult['MENU'] = [];
    $parent = 0;
    foreach ($arResult as $k => $arItem):
        if($arItem['PARAMS']["NO_LINK"] == "Y"){
            $arItem['LINK'] = "";
        }

        if($arItem['IS_PARENT'])
            $parent = $k;
    
        if($arItem['DEPTH_LEVEL'] == 2)
            $arResult['MENU'][$parent]['ITEMS'][$k] = $arItem;
        else            
            $arResult['MENU'][$k] = $arItem;
    endforeach;
?>