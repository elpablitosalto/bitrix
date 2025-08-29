<?php
$arResult["CATEGORIES"] = [];
$rsAllItems = \CIBlockElement::GetList(
    [],
    [
        "ACTIVE" => "Y",
        "IBLOCK_ID" => $arParams["IBLOCK_ID"]
    ],
    false,
    false,
    ["PROPERTY_CATEGORY"]
);
while ($item = $rsAllItems->GetNext()){
    if(!empty($item["PROPERTY_CATEGORY_VALUE"])){
        $arResult["CATEGORIES"][$item["PROPERTY_CATEGORY_ENUM_ID"]] = $item["PROPERTY_CATEGORY_VALUE"];
    }
}