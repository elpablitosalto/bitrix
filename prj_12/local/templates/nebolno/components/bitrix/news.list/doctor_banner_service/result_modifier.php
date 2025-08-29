<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

foreach($arResult["ITEMS"] as $key => $arItem) {
	$arResult["ITEMS"][$key]["DOCTOR_PHOTO"] = CFile::ResizeImageGet(
		$arItem['PREVIEW_PICTURE']['ID'],
		array('width' => 610, 'height' => 610),
		BX_RESIZE_IMAGE_PROPORTIONAL,
		true
	);
}

?>