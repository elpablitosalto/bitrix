<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

foreach($arResult["ITEMS"] as &$item){
    if($item["PREVIEW_PICTURE"]["ID"] > 0){
        $file = CFile::ResizeImageGet($item["PREVIEW_PICTURE"]["ID"], array('width'=>125, 'height'=>125), BX_RESIZE_IMAGE_PROPORTIONAL, true);
        $item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"] = $file['src'];
    }
}


?>