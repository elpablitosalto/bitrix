<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();



foreach ($arResult["ITEMS"] as &$arItem) {
    // Телефоны -->
    $arItem['PHONES']['arSources'] = (is_string($arItem['DISPLAY_PROPERTIES']['PHONE']['VALUE']) ?
        array(0 => $arItem['DISPLAY_PROPERTIES']['PHONE']['VALUE']) :
        $arItem['DISPLAY_PROPERTIES']['PHONE']['VALUE']
    );
    foreach ($arItem['PHONES']['arSources'] as $k => $phone) {
        $arItem['PHONES']['arValuesForLink'][$k] = preg_replace('![^0-9]+!', '', $phone);
    }
    //vardump($arItem['PHONES']['arValuesForLink']);
    // <-- Телефоны

    // Телефон для ссылки Связаться в WhatsApp -->
    if (strlen($arItem['DISPLAY_PROPERTIES']['WHATSAPP']['VALUE']) > 0) {
        $arItem['WHATSAPP_PHONE_FOR_LINK'] = preg_replace('![^0-9]+!', '', $arItem['DISPLAY_PROPERTIES']['WHATSAPP']['VALUE']);
    }
    // <-- 

    //vardump($arItem['DISPLAY_PROPERTIES']['SERIES']);
}
