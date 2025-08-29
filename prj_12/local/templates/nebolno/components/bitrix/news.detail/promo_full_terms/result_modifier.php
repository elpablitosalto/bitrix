<?
// Цены -->
$arResult["price_before_format"] = Indexis::getPriceFormatted(
    $arResult['PROPERTIES']['PRICE_BEFORE']['VALUE'],
    'RUB', 'N', 'N'
);
$arResult["price_after_format"] = Indexis::getPriceFormatted(
    $arResult['PROPERTIES']['PRICE_AFTER']['VALUE'],
    'RUB', 'N', 'N'
);
// <-- Цены

// Дата -->
$arResult["before_date"] = Indexis::getDateFormatted(
    $arResult['ACTIVE_TO']
);
// <-- Дата

// Картинка -->
$arPicture = CFile::ResizeImageGet(
    $arResult['DETAIL_PICTURE']['ID'],
    array('width' => 854, 'height' => 650),
    BX_RESIZE_IMAGE_EXACT,
    true
);
$arResult["img_src"] = $arPicture["src"];
//$arResult["img_src"] = SITE_TEMPLATE_PATH . "/img/content/banner/promotions/slide1.png";
// <--

// Цвет блока -->
//vardump($arItem);
//$code_color = $arResult['PROPERTIES']['BACKG_CLR']['VALUE_XML_ID'];
$arResult["code_color"] = "#E98D86";
if (strlen($arResult['PROPERTIES']['DETAIL_COLOR']['VALUE']) > 0) {
    $arResult["code_color"] = $arResult['PROPERTIES']['DETAIL_COLOR']['VALUE'];
}
// <--

// Клиники -->
$arResult["arClinics"] = array();
$arResult["arClinicsNames"] = array();
$arClinicsIds = $arResult['PROPERTIES']['CLINICS']['VALUE'];
$IBLOCK_CODE = $GLOBALS["arSiteConfig"]["arIblocksCodes"]["ADDRESSES"];
if (is_array($arClinicsIds) && !empty($arClinicsIds) && strlen($IBLOCK_CODE) > 0) {
    //$arSelect = array("ID", "IBLOCK_ID", "NAME", "DETAIL_PAGE_URL"); //IBLOCK_ID и ID обязательно должны быть указаны, см. описание arSelectFields выше
    $arSelect = false;
    $arFilter = array(
        "IBLOCK_CODE" => $IBLOCK_CODE,
        "ACTIVE_DATE" => "Y",
        "ACTIVE" => "Y",
        "ID" => $arClinicsIds,
    );
    $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $arFields["PROPERTIES"] = $ob->GetProperties();

        $arResult["arClinics"][$arFields["ID"]] = array(
            "NAME" => $arFields["NAME"],
            "SCD_NAME" => $arFields["PROPERTIES"]["SCD_NAME"]["VALUE"],
        );
        $arResult["arClinicsNames"][] = $arFields["PROPERTIES"]["SCD_NAME"]["VALUE"];
    }
}
// <-- 
