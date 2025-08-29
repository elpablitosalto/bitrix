<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

$arParntersId = [];
foreach ($arResult["ITEMS"] as &$item) {
    //ссылки должны формироваться через текущий раздел, т.к. может принадлежать нескольким раздклам
    if (mb_strlen($arParams["PARENT_SECTION_CODE"])) {
        $item["DETAIL_PAGE_URL"] = str_replace(["#SECTION_CODE#", "#ELEMENT_CODE#"], [$arParams["PARENT_SECTION_CODE"], $item["CODE"]], $arParams["DETAIL_URL"]);
    }
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
        /*
        $width = 90;
        $height = 30;
        */
        $width = 178;
        $height = 111;
        $partnerImage = CFile::ResizeImageGet(
            $row["PREVIEW_PICTURE"], 
            array('width' => $width, 'height' => $height), 
            BX_RESIZE_IMAGE_PROPORTIONAL
        );
        $row["PREVIEW_PICTURE_RESIZED"] = $partnerImage["src"];
        $arResult["PARTNERS"][$row["ID"]] = $row;
    }
}

foreach ($arResult["ITEMS"] as $key => &$item) {
    if (!is_array($item["DISPLAY_PROPERTIES"]["BENEFICIARY_TYPE"]["DISPLAY_VALUE"])) {
        $item["DISPLAY_PROPERTIES"]["BENEFICIARY_TYPE"]["DISPLAY_VALUE"]
            = array($item["DISPLAY_PROPERTIES"]["BENEFICIARY_TYPE"]["DISPLAY_VALUE"]);
    }
}

// Сортировка по результатам поиска -->
if ($GLOBALS['SORT_BY_SEARCH_RESULT'] == 'Y' && !empty($GLOBALS[$arParams["FILTER_NAME"]]["=ID"])) {
    //vardump($GLOBALS[$arParams["FILTER_NAME"]]["=ID"]);
    $arItemsNew = array();
    $arItemsSource = array();
    foreach ($arResult["ITEMS"] as $key => &$item) {
        $arItemsSource[$item['ID']] = $item;
    }
    foreach ($GLOBALS[$arParams["FILTER_NAME"]]["=ID"] as $key => $elId) {
        if (!empty($arItemsSource[$elId])) {
            $arItemsNew[$elId] = $arItemsSource[$elId];
        }
    }
    //vardump($arItemsNew);
    //vardump($arResult["ITEMS"]);
    if (!empty($arItemsNew)) {
        $arResult["ITEMS"] = $arItemsNew;
    }
}
// <-- Сортировка по результатам поиска
