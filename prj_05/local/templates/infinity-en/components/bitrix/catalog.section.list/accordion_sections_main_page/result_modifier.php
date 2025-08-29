<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if(!empty($arResult["SECTIONS"]) && \Bitrix\Main\Loader::includeModule("iblock")){
    $arSectionUserFields = $GLOBALS["USER_FIELD_MANAGER"]->GetUserFields("IBLOCK_".$arParams["IBLOCK_ID"]."_SECTION");
    if(!empty($arSectionUserFields["UF_MAIN_SECTIONS_DESC"]["SETTINGS"]["IBLOCK_ID"])) {
        foreach ($arResult["SECTIONS"] as &$arSection) {
            if (!empty($arSection["UF_MAIN_SECTIONS_DESC"])) {
                //echo 'IB_ID = '.$arSectionUserFields["UF_MAIN_SECTIONS_DESC"]["SETTINGS"]["IBLOCK_ID"].'<br />';
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
                    //vardump($arSectionDesc);
                    $arSection["DESC_BLOCKS"][] = $arSectionDesc;
                }
            }
        }
    }
}

foreach($arResult['SECTIONS'] as &$arSection){
    if (is_array($arSection["DETAIL_PICTURE"])) {
        $arFile = $arSection["DETAIL_PICTURE"];
    } else {
        $arFile = CFile::GetFileArray($arSection["DETAIL_PICTURE"]);
    }
    $arResultLocal = getImageFormatted(array(
        'RESIZE' => 'Y',
        'FILE_VALUE' => $arFile,
        'WIDTH' => 999999,
        'HEIGHT' => 360,
        'DEFAULT_ALT_TITLE' => $arSection['NAME']
    ));
    $arSection['DETAIL_PICTURE_SLIDER'] = $arResultLocal['PICTURE'];

    if (is_array($arSection["PICTURE"])) {
        $arFile = $arSection["PICTURE"];
    } else {
        $arFile = CFile::GetFileArray($arSection["PICTURE"]);
    }
    $arResultLocal = getImageFormatted(array(
        'RESIZE' => 'Y',
        'FILE_VALUE' => $arFile,
        'WIDTH' => 999999,
        'HEIGHT' => 360,
        'DEFAULT_ALT_TITLE' => $arSection['NAME']
    ));
    $arSection['PICTURE_SLIDER'] = $arResultLocal['PICTURE'];
}