<?
use Hair\General;

if(!empty($arResult['ITEMS'])) {
    foreach ($arResult['ITEMS'] as &$arProduct) {
        $arProduct["PRODUCT_VARIANTS"] = false;
        if (!empty($arProduct["PROPERTIES"]["ACTIVE_SUBSTANCE"]["VALUE"])) {
            $arProduct["PRODUCT_VARIANTS"] = General::infinityGetProductVariantsEn($arProduct["ID"], "ACTIVE_SUBSTANCE");
        } elseif (!empty($arProduct["PROPERTIES"]["PACK_VOLUME"]["VALUE"])) {
            $arProduct["PRODUCT_VARIANTS"] = General::infinityGetProductVariantsEn($arProduct["ID"], "PACK_VOLUME");
        } elseif (!empty($arProduct["PROPERTIES"]["FIXATION_STRENGTH"]["VALUE"])) {
            $arProduct["PRODUCT_VARIANTS"] = General::infinityGetProductVariantsEn($arProduct["ID"], "FIXATION_STRENGTH");
        }
    }
}


foreach ($arResult['ITEMS'] as &$arItem) {
    $arResultLocal = getImageFormatted(array(
        'RESIZE' => 'Y',
        'FILE_VALUE' => $arItem['DISPLAY_PROPERTIES']['SECONDARY_IMAGE']['FILE_VALUE'],
        'WIDTH' => 1999,
        'HEIGHT' => 1008,
        'DEFAULT_ALT_TITLE' => $arItem['NAME']
    ));
    $arItem['DETAIL_PICTURE_SLIDER'] = $arResultLocal['PICTURE'];

    $arResultLocal = getImageFormatted(array(
        'RESIZE' => 'Y',
        'FILE_VALUE' => $arItem['DISPLAY_PROPERTIES']['SECONDARY_IMAGE']['FILE_VALUE'],
        'WIDTH' => 425,
        'HEIGHT' => 692,
        'DEFAULT_ALT_TITLE' => $arItem['NAME']
    ));
    $arItem['PREVIEW_PICTURE_SLIDER'] = $arResultLocal['PICTURE'];

    //vardump($arItem);
}
