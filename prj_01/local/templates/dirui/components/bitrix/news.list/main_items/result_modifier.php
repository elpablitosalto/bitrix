<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

$arReviewID = $arResult["REVIEWS"] = [];
foreach($arResult["ITEMS"] as &$item){
    if($item["PREVIEW_PICTURE"]["ID"] > 0){
        $file = CFile::ResizeImageGet($item["PREVIEW_PICTURE"]["ID"], array('width'=>800, 'height'=>456), BX_RESIZE_IMAGE_PROPORTIONAL, true);
        $item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"] = $file['src'];
    }
    if($item["PROPERTIES"]["REVIEW"]["VALUE"] > 0 && !in_array($item["PROPERTIES"]["REVIEW"]["VALUE"], $arReviewID)){
        $arReviewID[] = $item["PROPERTIES"]["REVIEW"]["VALUE"];
    }
}

if(!empty($arReviewID)){
    $arSelect = Array("ID", "NAME", "PREVIEW_TEXT", "PREVIEW_PICTURE");
    $arFilter = Array("IBLOCK_ID"=>Indexis::getIblockId("reviews", "1c_catalog", "s1"), "ACTIVE" => "Y", "ID"=>$arReviewID);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>count($arReviewID)), $arSelect);
    while($arElement = $res->Fetch())
    {
        if($arElement["PREVIEW_PICTURE"] > 0){
            $arElement["PREVIEW_PICTURE_LINK"] = CFile::GetPath($arElement["PREVIEW_PICTURE"]);
        }
        $arResult["REVIEWS"][$arElement["ID"]] = $arElement;
    }
}

?>