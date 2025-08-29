<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();


$rowsByIblock = [];
$arItemsIds = array();
$arItemsTmp = array();
foreach ($arResult["ITEMS"] as &$item) {
    $rowsByIblock[$item["IBLOCK_ID"]][$item["ID"]] = $item;
    $arItemsIds[] = $item["ID"];
    $arItemsTmp[$item["ID"]] = $item;
}
$arResult["ITEMS"] = $arItemsTmp;

// -->
if (!empty($arItemsIds)) {
    //$arSelect = array("ID", "NAME", "DATE_ACTIVE_FROM");
    $arSelect = false;
    $arFilter = array(
        "ID" => $arItemsIds,
    );
    $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $arFields['PROPERTIES'] = $ob->GetProperties();
        //$item["URL"] = $item["DETAIL_PAGE_URL"];
        $arResult["ITEMS"][$arFields['ID']]['URL'] = $arFields['PROPERTIES']['BUY_LINK']['VALUE'];
    }
}
// <--

$arResult["PROPS"] = [];
foreach ($rowsByIblock as $iblock => $arItems) {
    CIBlockElement::GetPropertyValuesArray($arItems, $iblock, [], ["CODE" => $arParams["PROPERTY_CODE"]]);
    foreach ($arItems as $id => $props) {

        if (isset($props["DATE_START"]["VALUE"]) && !empty($props["DATE_START"]["VALUE"])) {
            $props["DATE_START"]["VALUE"] = FormatDate("d F", MakeTimeStamp($props["DATE_START"]["VALUE"]));
        }
        if (isset($props["DATE_END"]["VALUE"]) && !empty($props["DATE_END"]["VALUE"])) {
            $props["DATE_END"]["VALUE"] = FormatDate("d F", MakeTimeStamp($props["DATE_END"]["VALUE"]));
        }

        $arResult["PROPS"][$id] = $props;
    }
}
