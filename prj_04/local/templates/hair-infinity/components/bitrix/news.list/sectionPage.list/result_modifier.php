<?
use Hair\General;

if(!empty($arResult['ITEMS'])) {
    foreach ($arResult['ITEMS'] as &$arProduct) {
        $arProduct["PRODUCT_VARIANTS"] = false;
        if (!empty($arProduct["PROPERTIES"]["ACTIVE_SUBSTANCE"]["VALUE"])) {
            $arProduct["PRODUCT_VARIANTS"] = General::infinityGetProductVariants($arProduct["ID"], "ACTIVE_SUBSTANCE");
        } elseif (!empty($arProduct["PROPERTIES"]["PACK_VOLUME"]["VALUE"])) {
            $arProduct["PRODUCT_VARIANTS"] = General::infinityGetProductVariants($arProduct["ID"], "PACK_VOLUME");
        } elseif (!empty($arProduct["PROPERTIES"]["FIXATION_STRENGTH"]["VALUE"])) {
            $arProduct["PRODUCT_VARIANTS"] = General::infinityGetProductVariants($arProduct["ID"], "FIXATION_STRENGTH");
        }
    }
}
