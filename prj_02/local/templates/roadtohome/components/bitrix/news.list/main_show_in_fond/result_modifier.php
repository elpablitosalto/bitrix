<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

$arIds = [];
foreach($arResult["ITEMS"] as &$item){
    $arIds[] = $item["ID"];
    if($item["PREVIEW_PICTURE"]["ID"] > 0){
        $file = CFile::ResizeImageGet($item["PREVIEW_PICTURE"]["ID"], array('width'=>507, 'height'=>360), BX_RESIZE_IMAGE_PROPORTIONAL, true);
        $item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"] = $file['src'];
    }
}

$arResult["ITEMS2"] = [];
$arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL", "ACTIVE_FROM", "IBLOCK_ID");
$arFilter = Array("IBLOCK_ID"=>$arParams["IBLOCK_ID"], "!ID" => $arIds, "ACTIVE"=>"Y", "!ACTIVE_FROM" => false);
$res = CIBlockElement::GetList(Array("ACTIVE_FROM" => "DESC"), $arFilter, false, Array("nPageSize"=>3), $arSelect);
while($arElement = $res->GetNext())
{
    $stmp = MakeTimeStamp($arElement["ACTIVE_FROM"]);
    $arElement["ACTIVE_FROM"] = FormatDate("d F Y", $stmp);
    $arResult["ITEMS2"][] = $arElement;
}

// Тип отображения -->
foreach ($arResult["ITEMS"] as $key => $arItem) {
    $arResult["ITEMS"][$key]["SHOW_TYPE"] = 4;
    if (strlen($arItem["PREVIEW_PICTURE"]["SRC"]) > 0) {
        $arResult["ITEMS"][$key]["SHOW_TYPE"] = 1;

        $SLIDER_SHOW_TYPE = $arItem["DISPLAY_PROPERTIES"]["SHOW_TYPE"]["VALUE_XML_ID"];
        if (intval($SLIDER_SHOW_TYPE) > 0) {
            $arResult["ITEMS"][$key]["SHOW_TYPE"] = $SLIDER_SHOW_TYPE;
        }
    } else {
        $BACKG_COLOR = $arItem["DISPLAY_PROPERTIES"]["BACKG_COLOR"]["VALUE_XML_ID"];
        $arResult["ITEMS"][$key]["SHOW_TYPE"] = 4;
        if (strlen($BACKG_COLOR) <= 0) {
            $BACKG_COLOR = "gray";
        }
        if ($BACKG_COLOR == "orange") {
            $arResult["ITEMS"][$key]["SHOW_TYPE"] = 5;
        }
    }
}
// <-- Тип отображения
?>