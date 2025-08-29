<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (!empty($arParams['INCLUDE_EXTRA_SLIDES']) && $arParams['INCLUDE_EXTRA_SLIDES'] === 'Y') {
    // дополнительные баннеры
    $arSelect = ["ID", "IBLOCK_ID", "NAME", "SORT", "CODE", "PREVIEW_PICTURE", "PREVIEW_TEXT", "PROPERTY_LINK"];
    $arFilter = ["IBLOCK_ID" => 29, "ACTIVE" => "Y"];
    $rsElements = CIBlockElement::GetList(["ID" => "ASC"], $arFilter, false, false, $arSelect);
    if($rsElements->SelectedRowsCount() > 0){
        while ($arElement = $rsElements->GetNext()) {
            $arResult['SECTIONS'][] = [
                "NAME" => $arElement["NAME"],
                "SORT" => $arElement["SORT"],
                "DETAIL_PICTURE" => $arElement["PREVIEW_PICTURE"],
                "~UF_SLIDER_TEXT" => htmlspecialchars_decode($arElement["PREVIEW_TEXT"]),
                "SECTION_PAGE_URL" => $arElement["PROPERTY_LINK_VALUE"],
            ];
        }
        uasort($arResult['SECTIONS'], function($a, $b){
            if($a["SORT"] > $b["SORT"]) return 1;
            if($a["SORT"] < $b["SORT"]) return -1;
            if($a["SORT"] == $b["SORT"]) return 0;
        });
    }
}