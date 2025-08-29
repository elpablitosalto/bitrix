<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

foreach ($arResult["ITEMS"] as &$item) {
    if ($item["PREVIEW_PICTURE"]["ID"] > 0) {
        $file = CFile::ResizeImageGet($item["PREVIEW_PICTURE"]["ID"], array('width' => 306, 'height' => 240), BX_RESIZE_IMAGE_PROPORTIONAL, true);
        $item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"] = $file['src'];
    }
}

// Тип отображения -->
//vardump($arResult["ITEMS"]);
foreach ($arResult["ITEMS"] as $key => $arItem) {
    $arResult["ITEMS"][$key]["SHOW_TYPE"] = 4;
    if (strlen($arItem["PREVIEW_PICTURE"]["SRC"]) > 0) {
        $arResult["ITEMS"][$key]["SHOW_TYPE"] = 1;

        $SLIDER_SHOW_TYPE = $arItem["DISPLAY_PROPERTIES"]["SHOW_TYPE"]["VALUE_XML_ID"];
        if (intval($SLIDER_SHOW_TYPE) > 0) {
            $arResult["ITEMS"][$key]["SHOW_TYPE"] = $SLIDER_SHOW_TYPE;
        }
    } else {
        $BACKG_COLOR = $arItem["DISPLAY_PROPERTIES"]["BACKG_COLOR"]["VALUE_XML_ID"];
        $arResult["ITEMS"][$key]["SHOW_TYPE"] = 4;
        if (strlen($BACKG_COLOR) <= 0) {
            $BACKG_COLOR = "gray";
        }
        if ($BACKG_COLOR == "orange") {
            $arResult["ITEMS"][$key]["SHOW_TYPE"] = 5;
        }
    }
}
// <-- Тип отображения

// Дата новости -->
foreach ($arResult["ITEMS"] as $key => $arItem) {
    //echo "PUBLIC_DATE = " . $arItem["DISPLAY_PROPERTIES"]["PUBLIC_DATE"]["VALUE"] . "<br />";
}
// <-- Дата новости
