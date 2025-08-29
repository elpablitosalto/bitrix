<?php

if(!function_exists('getPromoImage')) {
	function getPromoImage($arItem) {
		$image = [];
		$imageSizes = Array('width' => 360, 'height' => 240);

		$imageID = !empty($arItem['PREVIEW_PICTURE']['ID']) ? $arItem['PREVIEW_PICTURE']['ID'] : null;

		if(!empty($imageID)) {
			$resize = CFile::ResizeImageGet($imageID,
			$imageSizes,
			BX_RESIZE_IMAGE_EXACT, false);

			if(!empty($resize['src'])) {
				$image['SRC'] = $resize['src'];
			}
		}

		return $image;
	}
}

if(!function_exists('getPromoLabel')) {
	function getPromoLabel($arItem) {
		$result = null;

		if(!empty($arItem['PROPERTIES']['NOTE']['VALUE'])) {
			$result = $arItem['PROPERTIES']['NOTE']['VALUE'];
		}

		return $result;
	}
}

if(!function_exists('getPromoValue')) {
	function getPromoValue($arItem) {
		$result = null;

		if(!empty($arItem['PROPERTIES']['VALUE']['VALUE'])) {
			$result = $arItem['PROPERTIES']['VALUE']['VALUE'];
		}

		return $result;
	}
}

foreach($arResult['ITEMS'] as &$arItem) {
	$arItem['IMAGE'] = getPromoImage($arItem);
	$arItem['DISCOUNT_LABEL'] = getPromoLabel($arItem);
	$arItem['DISCOUNT_VALUE'] = getPromoValue($arItem);
}