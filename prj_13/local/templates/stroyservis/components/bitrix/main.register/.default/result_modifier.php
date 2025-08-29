<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
    die();

$arResult["SHOW_FIELDS"] = array_merge(
    $arParams['SHOW_FIELDS'],
    array_diff($arResult["SHOW_FIELDS"], $arParams['SHOW_FIELDS'])
);
?>