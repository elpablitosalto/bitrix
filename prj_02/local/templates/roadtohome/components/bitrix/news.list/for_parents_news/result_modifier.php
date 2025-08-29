<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
//vardump($arResult["ITEMS"]);
foreach ($arResult["ITEMS"] as $key => $arItem) {
    //echo "TAGS = ".$arItem["TAGS"]."<br />";
    if (strlen($arItem["TAGS"]) > 0) {
        $arTags = explode(",", $arItem["TAGS"]);
        $arResult["ITEMS"][$key]["arTags"] = $arTags;
    }
}
