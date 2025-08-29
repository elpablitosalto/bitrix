<?php

function getPromoImage($arItem) {
	$image = [];
	$imageSizes = Array('width' => 1200, 'height' => 480);

	$imageID = !empty($arItem['DETAIL_PICTURE']['ID']) ? $arItem['DETAIL_PICTURE']['ID'] : null;
	// if(empty($imageID)) $imageID = !empty($arItem['PREVIEW_PICTURE']['ID']) ? $arItem['PREVIEW_PICTURE']['ID'] : null;

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

if(!function_exists('getBrandProducts')) {
	function getBrandProducts($arItem) {
		$result = [];

		$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_*");
		$arFilter = Array('IBLOCK_ID' => CATALOG_IB_ID, 'GLOBAL_ACTIVE'=>'Y', 'PROPERTY_BRAND_VALUE' => $arItem['ID']);
		$db_elemens = CIblockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while($obElement = $db_elemens->GetNextElement()) {
			$el = $obElement->GetFields();
			$arProps = $obElement->GetProperties();

			if(!empty($arProps['BRAND']['VALUE'])) {
				if ($arProps['BRAND']['VALUE'] == $arItem['ID']) {
					$result[] = $el['ID'];
				}
			}
		}

		return array_unique($result);
	}
}

$arResult['SHOW_MORE_CONTROL'] = 'N';
$arResult['IMAGE'] = getPromoImage($arResult);
$arResult['BRAND_PRODUCTS'] = getBrandProducts($arResult);
if (count($arResult['BRAND_PRODUCTS']) >= 8) {
	$arResult['SHOW_MORE_CONTROL'] = 'Y';
}