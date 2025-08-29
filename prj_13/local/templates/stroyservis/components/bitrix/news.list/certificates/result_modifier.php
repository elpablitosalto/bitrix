<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */


foreach($arResult["ITEMS"] as &$item){
	if($item["DETAIL_PICTURE"]["ID"] > 0){
        $file = CFile::ResizeImageGet(
			$item["DETAIL_PICTURE"]["ID"], 
			array('width'=>165, 'height'=>229), 
			BX_RESIZE_IMAGE_PROPORTIONAL, 
			true
		);
        $item["DETAIL_PICTURE"]["DETAIL_PICTURE_RESIZED"] = $file['src'];
    }
}