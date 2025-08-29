<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

if( empty( $GLOBALS['FIRST_SHOW_CLIENTS_REVIEWS'] ) )
{
    foreach ($arResult["ITEMS"] as &$arItem) {
        $GLOBALS['FIRST_SHOW_CLIENTS_REVIEWS'][] = $arItem['ID'];
    }
}
?>