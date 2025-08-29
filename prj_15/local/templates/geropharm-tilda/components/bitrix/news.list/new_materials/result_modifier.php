<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach($arResult["ITEMS"] as &$item){
    if(!is_array($item["DISPLAY_PROPERTIES"]["SPECIALITY"]["DISPLAY_VALUE"])){
        $item["DISPLAY_PROPERTIES"]["SPECIALITY"]["DISPLAY_VALUE"] = [$item["DISPLAY_PROPERTIES"]["SPECIALITY"]["DISPLAY_VALUE"]];
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

    // Картинки -->
    $item['PICTURE'] = array();
    if (!empty($item['PREVIEW_PICTURE'])) {
        $arResultLocal = Indexis::getImageFormatted(array(
            'RESIZE' => 'N',
            'FILE_VALUE' => $item['PREVIEW_PICTURE'],
            'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/reviewer-thumb.png',
            //'WIDTH' => 205,
            //'HEIGHT' => 116,
            'DEFAULT_ALT_TITLE' => $item['NAME']
        ));
        $item['PICTURE'] = $arResultLocal['PICTURE'];
    }
    // <-- Картинки
}
