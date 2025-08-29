<?php
if(!function_exists('getPromoProductsBySection')) {
	function getPromoProductsBySection($arItem) {
		$arProducts = Array();

		if(!empty($arItem['PROPERTIES']['SECTIONS']['VALUE'])) {
			$arFilterSections = $arItem['PROPERTIES']['SECTIONS']['VALUE'];
			$arFilter = Array('IBLOCK_ID'=>CATALOG_IB_ID, 'GLOBAL_ACTIVE'=>'Y', 'SECTION_ID'=>$arFilterSections);
			$db_elemens = CIblockElement::GetList(Array(), $arFilter, false, false, Array('ID'));

			while($obElement = $db_elemens->GetNextElement()) {
				$el = $obElement->GetFields();
				$arProducts[] = $el['ID'];
			}
		}

		return $arProducts;
	}
}

if(!function_exists('getPromoProducts')) {
	function getPromoProducts($arItem) {
		$idBySections = getPromoProductsBySection($arItem);
		$idByProp = !empty($arItem['PROPERTIES']['PRODUCTS']['VALUE']) ? $arItem['PROPERTIES']['PRODUCTS']['VALUE'] : Array();
		$result = array_merge($idBySections, $idByProp);

		return array_unique($result);
	}
}

if(!function_exists('getPromoImage')) {
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

if(!function_exists('getPromoBrands')) {
	function getPromoBrands($arItem) {
		$result = [];

		if(!empty($arItem['DISCOUNT_PRODUCTS'])) {
			$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM","PROPERTY_*");
			$arFilter = Array('IBLOCK_ID'=>CATALOG_IB_ID, 'GLOBAL_ACTIVE'=>'Y', 'ID'=>$arItem['DISCOUNT_PRODUCTS']);
			$db_elemens = CIblockElement::GetList(Array(), $arFilter, false, false, $arSelect);

			while($obElement = $db_elemens->GetNextElement()) {
				$el = $obElement->GetFields();
				$arProps = $obElement->GetProperties();

				if(!empty($arProps['BRAND']['VALUE'])) {
					$result[] = $arProps['BRAND']['VALUE'];
				}
			}
		}

		return array_unique($result);
	}
}

$arResult['IMAGE'] = getPromoImage($arResult);
$arResult['DISCOUNT_LABEL'] = getPromoLabel($arResult);
$arResult['DISCOUNT_VALUE'] = getPromoValue($arResult);
$arResult['DISCOUNT_PRODUCTS'] = getPromoProducts($arResult);
$arResult['DISCOUNT_BRANDS'] = getPromoBrands($arResult);
