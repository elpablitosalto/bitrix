<?php

function getPromoImage($arItem) {
	$image = [];
	$imageSizes = Array('width' => 360, 'height' => 240);

	$imageID = !empty($arItem['PREVIEW_PICTURE']['ID']) ? $arItem['PREVIEW_PICTURE']['ID'] : null;

	if(!empty($imageID)) {
		$resize = CFile::ResizeImageGet($imageID,
		$imageSizes,
		BX_RESIZE_IMAGE_PROPORTIONAL, true);

		if(!empty($resize['src'])) {
			$image['SRC'] = $resize['src'];
		}
	}

	return $image;
}

foreach($arResult['ITEMS'] as &$arItem) {
	$arItem['IMAGE'] = getPromoImage($arItem);
}