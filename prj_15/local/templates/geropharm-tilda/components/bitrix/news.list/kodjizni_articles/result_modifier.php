<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach($arResult["ITEMS"] as &$item){
    if(isset($item["DISPLAY_PROPERTIES"]["SPECIALITY"]["DISPLAY_VALUE"]) && !is_array($item["DISPLAY_PROPERTIES"]["SPECIALITY"]["DISPLAY_VALUE"])){
        $item["DISPLAY_PROPERTIES"]["SPECIALITY"]["DISPLAY_VALUE"] = [$item["DISPLAY_PROPERTIES"]["SPECIALITY"]["DISPLAY_VALUE"]];
    }
    if(isset($item["DISPLAY_PROPERTIES"]["THEME"]["DISPLAY_VALUE"]) && !is_array($item["DISPLAY_PROPERTIES"]["THEME"]["DISPLAY_VALUE"])){
        $item["DISPLAY_PROPERTIES"]["THEME"]["DISPLAY_VALUE"] = [$item["DISPLAY_PROPERTIES"]["THEME"]["DISPLAY_VALUE"]];
    }
    if(isset($item["DISPLAY_PROPERTIES"]["LIVE_START"]["VALUE"]) && !empty($item["DISPLAY_PROPERTIES"]["LIVE_START"]["VALUE"])){
        $item["DISPLAY_PROPERTIES"]["LIVE_START"]["VALUE"] = FormatDate("d F G:i", MakeTimeStamp($item["DISPLAY_PROPERTIES"]["LIVE_START"]["VALUE"]));
    }
    if(isset($item["DISPLAY_PROPERTIES"]["DATE_START"]["VALUE"]) && !empty($item["DISPLAY_PROPERTIES"]["DATE_START"]["VALUE"])){
        $item["DISPLAY_PROPERTIES"]["DATE_START"]["VALUE"] = FormatDate("d F", MakeTimeStamp($item["DISPLAY_PROPERTIES"]["DATE_START"]["VALUE"]));
    }
    if(isset($item["DISPLAY_PROPERTIES"]["DATE_END"]["VALUE"]) && !empty($item["DISPLAY_PROPERTIES"]["DATE_END"]["VALUE"])){
        $item["DISPLAY_PROPERTIES"]["DATE_END"]["VALUE"] = FormatDate("d F", MakeTimeStamp($item["DISPLAY_PROPERTIES"]["DATE_END"]["VALUE"]));
    }
}

foreach ($arResult["ITEMS"] as &$arItem) {
    if (!empty($arItem['DISPLAY_PROPERTIES']['THEME']['DISPLAY_VALUE'])) {
        if (is_string($arItem['DISPLAY_PROPERTIES']['THEME']['DISPLAY_VALUE'])) {
            $arItem['DISPLAY_PROPERTIES']['THEME']['DISPLAY_VALUE'] = array($arItem['DISPLAY_PROPERTIES']['THEME']['DISPLAY_VALUE']);
        }
    }

    // Картинки -->
    $arItem['PICTURE'] = array();
    if (!empty($arItem['PREVIEW_PICTURE'])) {
        $arResultLocal = Indexis::getImageFormatted(array(
            'RESIZE' => 'N',
            'FILE_VALUE' => $arItem['PREVIEW_PICTURE'],
            'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/reviewer-thumb.png',
            //'WIDTH' => 205,
            //'HEIGHT' => 116,
            'DEFAULT_ALT_TITLE' => $arItem['NAME']
        ));
        $arItem['PICTURE'] = $arResultLocal['PICTURE'];
    }
    // <-- Картинки
}
