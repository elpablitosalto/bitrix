<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();


if (is_array($arResult['ITEM']['DISPLAY_PROPERTIES']['CLINICS']['VALUE']) && count($arResult['ITEM']['DISPLAY_PROPERTIES']['CLINICS']['VALUE']) > 0) {
    $arResult['ITEM']['DISPLAY_PROPERTIES']['CLINICS']['CUSTOM_DISPLAY_VALUE'] = [];
    foreach ($arResult['ITEM']['DISPLAY_PROPERTIES']['CLINICS']['VALUE'] as $clinicId) {
        if (isset($arParams['METRO_LIST'][$clinicId])) {
            $arResult['ITEM']['DISPLAY_PROPERTIES']['CLINICS']['CUSTOM_DISPLAY_VALUE'] = array_merge($arResult['ITEM']['DISPLAY_PROPERTIES']['CLINICS']['CUSTOM_DISPLAY_VALUE'], $arParams['METRO_LIST'][$clinicId]);
        }
    }
    $arResult['ITEM']['DISPLAY_PROPERTIES']['CLINICS']['CUSTOM_DISPLAY_VALUE'] = array_unique($arResult['ITEM']['DISPLAY_PROPERTIES']['CLINICS']['CUSTOM_DISPLAY_VALUE']);
}
?>