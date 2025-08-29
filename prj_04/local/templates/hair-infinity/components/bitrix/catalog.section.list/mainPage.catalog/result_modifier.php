<?
if(!empty($arResult["SECTIONS"]) && \Bitrix\Main\Loader::includeModule("iblock")){
    $arSectionUserFields = $GLOBALS["USER_FIELD_MANAGER"]->GetUserFields("IBLOCK_".$arParams["IBLOCK_ID"]."_SECTION");
    if(!empty($arSectionUserFields["UF_MAIN_SECTIONS_DESC"]["SETTINGS"]["IBLOCK_ID"])) {
        foreach ($arResult["SECTIONS"] as &$arSection) {
            if (!empty($arSection["UF_MAIN_SECTIONS_DESC"])) {
                $rsSectionDesc = \CIBlockElement::GetList(
                    ["SORT" => "ASC"],
                    [
                        "IBLOCK_ID" => intval($arSectionUserFields["UF_MAIN_SECTIONS_DESC"]["SETTINGS"]["IBLOCK_ID"]),
                        "ID" => $arSection["UF_MAIN_SECTIONS_DESC"]
                    ],
                    false,
                    false,
                    [
                        "*",
                        "PROPERTY_BLOCK_VOLUME",
                        "PROPERTY_BLOCK_RANGE",
                        "PROPERTY_BLOCK_PECULIARITIES",
                        "PROPERTY_BLOCK_LINK",
                    ]
                );
                while ($arSectionDesc = $rsSectionDesc->GetNext()){
                    $arSection["DESC_BLOCKS"][] = $arSectionDesc;
                }
            }
        }
    }
}