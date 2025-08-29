<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

foreach($arResult["ITEMS"] as &$item){
    if($item["PREVIEW_PICTURE"]["ID"] > 0){
        $file = CFile::ResizeImageGet($item["PREVIEW_PICTURE"]["ID"], array('width'=>310, 'height'=>248), BX_RESIZE_IMAGE_PROPORTIONAL, true);
        $item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"] = $file['src'];
    }
    if($item["DISPLAY_PROPERTIES"]["BIRTH_DATE"]["VALUE"]){
        $item["DISPLAY_PROPERTIES"]["BIRTH_DATE"]["DISPLAY_VALUE"] = intdiv (time() - MakeTimeStamp($item["DISPLAY_PROPERTIES"]["BIRTH_DATE"]["VALUE"]), (60*60*24*365));
    }
}

?>