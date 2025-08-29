<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

$arParntersId = [];
foreach ($arResult["ITEMS"] as &$item) {
    if ($item["PREVIEW_PICTURE"]["ID"] > 0) {
        $file = CFile::ResizeImageGet($item["PREVIEW_PICTURE"]["ID"], array('width' => 550, 'height' => 360), BX_RESIZE_IMAGE_PROPORTIONAL, true);
        $item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"] = $file['src'];
    }
    foreach ($item["PROPERTIES"]["PARTNERS"]["VALUE"] as $partnerId) {
        if ($partnerId > 0 && !in_array($partnerId, $arParntersId))
            $arParntersId[] = $partnerId;
    }
}

if (!empty($arParntersId)) {
    $arResult["PARTNERS"] = [];
    $res = CIBlockElement::GetList(
        ['ID' => 'ASC'],
        ['IBLOCK_ID' => Indexis::getIblockId("partners", "content", "s1"), 'ACTIVE' => 'Y', "!PREVIEW_PICTURE" => false, "ID" => $arParntersId],
        false,
        ['nTopCount' => count($arParntersId)],
        ['ID', 'PREVIEW_PICTURE', 'NAME']
    );
    while ($row = $res->GetNext()) {
        $partnerImage = CFile::ResizeImageGet($row["PREVIEW_PICTURE"], array('width' => 90, 'height' => 30), BX_RESIZE_IMAGE_PROPORTIONAL);
        $row["PREVIEW_PICTURE_RESIZED"] = $partnerImage["src"];
        $arResult["PARTNERS"][$row["ID"]] = $row;
    }
}

// Ссылка на Больше новостей -->
if (strlen($arParams["MORE_URL"]) > 0) {
    $arResult["MORE_URL"] = $arParams["MORE_URL"];
} else {
    $arResult["MORE_URL"] = str_replace("#SITE_DIR#", SITE_DIR, $arResult["LIST_PAGE_URL"]);
}
// <--

// Тип отображения -->
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

foreach($arResult["ITEMS"] as &$item){
    if($item["PREVIEW_PICTURE"]["ID"] > 0){
        $file = CFile::ResizeImageGet($item["PREVIEW_PICTURE"]["ID"], array('width'=>507, 'height'=>370), BX_RESIZE_IMAGE_PROPORTIONAL, true);
        $item["PREVIEW_PICTURE"]["SRC"] = $file['src'];
    }
}

