<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

// Разметка OG -->
//vardump($arResult['OG']);
//vardump($arParams['OG']);
if ($arParams['OG']['SET'] == 'Y') {
    //if (!empty($arResult['OG']['OG_IMAGE'])) {
        $arResultFunc = CMarkingOG::getSetGlobalData(array(
            "ELEMENT_CODE" => $arParams['OG']['LIST_ELEMENT_CODE'],
            "OG_IMAGE" => $arResult['OG']['OG_IMAGE'],
        ));
    //}
}
// <-- Разметка OG
