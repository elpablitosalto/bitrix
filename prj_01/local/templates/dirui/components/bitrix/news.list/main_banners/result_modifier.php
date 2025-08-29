<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

foreach($arResult["ITEMS"] as &$item){
    if($item["PROPERTIES"]["FILE"]["VALUE"] > 0){
        $item["BANNER"] = CFile::GetPath($item["PROPERTIES"]["FILE"]["VALUE"]);
    }
}

?>