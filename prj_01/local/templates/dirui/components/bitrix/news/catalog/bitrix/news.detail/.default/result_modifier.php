<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

$arrayProps = ["FEATURES_TOP","METHODS","CHARACTERISTICS","MATERIALS"];
foreach($arrayProps as $prop){
    if (isset($arResult["DISPLAY_PROPERTIES"][$prop]["DISPLAY_VALUE"]) && !is_array($arResult["DISPLAY_PROPERTIES"][$prop]["DISPLAY_VALUE"]))
        $arResult["DISPLAY_PROPERTIES"][$prop]["DISPLAY_VALUE"] = [$arResult["DISPLAY_PROPERTIES"][$prop]["DISPLAY_VALUE"]];
}

$arrayFilesProps = ["DOCS_VIDEO","DOCS","IMAGES"];
foreach($arrayFilesProps as $prop){
    if (isset($arResult["DISPLAY_PROPERTIES"][$prop]["FILE_VALUE"]["ID"]))
        $arResult["DISPLAY_PROPERTIES"][$prop]["FILE_VALUE"] = [$arResult["DISPLAY_PROPERTIES"][$prop]["FILE_VALUE"]];
}

if(isset($arResult["PROPERTIES"]["REVIEW"]["VALUE"]) && $arResult["PROPERTIES"]["REVIEW"]["VALUE"] > 0){
    $arSelect = Array("ID", "NAME", "PREVIEW_TEXT", "PREVIEW_PICTURE");
    $arFilter = Array("IBLOCK_ID"=>Indexis::getIblockId("reviews", "1c_catalog", "s1"), "ACTIVE" => "Y", "ID"=>$arResult["PROPERTIES"]["REVIEW"]["VALUE"]);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>1), $arSelect);
    while($arElement = $res->Fetch())
    {
        if($arElement["PREVIEW_PICTURE"] > 0){
            $arElement["PREVIEW_PICTURE_LINK"] = CFile::GetPath($arElement["PREVIEW_PICTURE"]);
        }
        $arResult["REVIEW"] = $arElement;
    }
}

if(isset($arResult["PROPERTIES"]["OFFERS"]["VALUE"]) && !empty($arResult["PROPERTIES"]["OFFERS"]["VALUE"])){
    $arSelect = Array("ID", "NAME", "PREVIEW_TEXT", "DETAIL_TEXT", "PREVIEW_PICTURE","PROPERTY_LINK");
    $arFilter = Array("IBLOCK_ID"=>Indexis::getIblockId("offers", "1c_catalog", "s1"), "ACTIVE" => "Y", "ID"=>$arResult["PROPERTIES"]["OFFERS"]["VALUE"]);
    $res = CIBlockElement::GetList(Array("SORT" => "ASC"), $arFilter, false, Array("nPageSize"=>count($arResult["PROPERTIES"]["OFFERS"]["VALUE"])), $arSelect);
    while($arElement = $res->Fetch())
    {
        if($arElement["PREVIEW_PICTURE"] > 0){
            $arElement["PREVIEW_PICTURE_LINK"] = CFile::GetPath($arElement["PREVIEW_PICTURE"]);
        }
        $arResult["OFFERS"][] = $arElement;
    }
}