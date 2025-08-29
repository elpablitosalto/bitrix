<?
foreach ($arResult["ITEMS"] as $key => $item) {
    foreach ($item["DISPLAY_PROPERTIES"]["AWARD"]["VALUE"] as $key2 => $arVal) {
        $arResult["ITEMS"][$key]["DISPLAY_PROPERTIES"]["AWARD"]["VALUE"][$key2]["SORT"] =
            $arVal["SUB_VALUES"]["SORT"]["VALUE"];
    }
}

foreach ($arResult["ITEMS"] as $key => $item) {
    $arResult["ITEMS"][$key]["DISPLAY_PROPERTIES"]["AWARD"]["VALUE"] = Indexis::sort_nested_arrays(
        $arResult["ITEMS"][$key]["DISPLAY_PROPERTIES"]["AWARD"]["VALUE"],
        array("SORT" => "asc")
    );
    foreach ($item["DISPLAY_PROPERTIES"]["AWARD"]["VALUE"] as $key2 => $arVal) {
    }
}
