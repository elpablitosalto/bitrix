<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();


foreach ($arResult["ITEMS"] as &$arItem) {

    if (!empty($arItem['DISPLAY_PROPERTIES']['HOME_PICTURES']['FILE_VALUE'])) {

        if (!is_array($arItem['DISPLAY_PROPERTIES']['HOME_PICTURES']['FILE_VALUE'])) {
            $arItem['DISPLAY_PROPERTIES']['HOME_PICTURES']['FILE_VALUE'] = array($arItem['DISPLAY_PROPERTIES']['HOME_PICTURES']['FILE_VALUE']);
        }

        foreach ($arItem['DISPLAY_PROPERTIES']['HOME_PICTURES']['FILE_VALUE'] as $val) {
            $arResultLocal = Indexis::getImageFormatted(array(
                'RESIZE' => 'N',
                'FILE_VALUE' => $val,
                'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/reviewer-thumb.png',
                //'WIDTH' => 205,
                //'HEIGHT' => 116,
                'DEFAULT_ALT_TITLE' => $arItem['NAME']
            ));
            $arItem['PICTURES'][] = $arResultLocal['PICTURE'];
        }
    }

    //$arItem['VIDEO']
}
