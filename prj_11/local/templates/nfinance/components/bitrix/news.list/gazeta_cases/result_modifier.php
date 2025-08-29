<?php
if (!empty($arResult["ITEMS"])) {
    foreach ($arResult["ITEMS"] as &$arItem) {
        if (!empty($arItem["IBLOCK_SECTION_ID"])) {
            $rsSection = \Bitrix\Iblock\SectionTable::getById(intval($arItem["IBLOCK_SECTION_ID"]));
            if ($arSection = $rsSection->fetch()) {
                $arItem["SECTION_NAME"] = $arSection["NAME"];
            }
        }

        // Дата -->
        if (!empty($arItem['ACTIVE_FROM'])) {
            $dateStr = $arItem['ACTIVE_FROM'];
        } else if (!empty($arItem['TIMESTAMP_X'])) {
            $dateStr = $arItem['TIMESTAMP_X'];
        }
        $arItem['DATE'] = date($GLOBALS["DB"]->DateFormatToPHP(CSite::GetDateFormat("SHORT")), strtotime($dateStr));
        // <-- Дата
    }
    $arResult["INDUSTRY"] = [];
    $rsAllItems = \CIBlockElement::GetList(
        [],
        [
            "ACTIVE" => "Y",
            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
            "SECTION_ID" => $arParams["PARENT_SECTION"],
        ],
        false,
        false,
        ["PROPERTY_INDUSTRY"]
    );
    while ($item = $rsAllItems->GetNext()) {
        if (!empty($item["PROPERTY_INDUSTRY_VALUE"])) {
            $arResult["INDUSTRY"][$item["PROPERTY_INDUSTRY_ENUM_ID"]] = $item["PROPERTY_INDUSTRY_VALUE"];
        }
    }
}
