<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();



foreach ($arResult["ITEMS"] as &$arItem) {

    // Телефон для ссылки Связаться в WhatsApp -->
    if (strlen($arItem['DISPLAY_PROPERTIES']['WHATSAPP']['VALUE']) > 0) {
        $arItem['WHATSAPP_PHONE_FOR_LINK'] = preg_replace('![^0-9]+!', '', $arItem['DISPLAY_PROPERTIES']['WHATSAPP']['VALUE']);
    }
    // <-- 

    //vardump($arItem['DISPLAY_PROPERTIES']['SERIES']);
}
