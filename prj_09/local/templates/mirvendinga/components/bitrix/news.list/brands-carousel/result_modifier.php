<?
if (!function_exists('getBrandImage')) {
	function getBrandImage($arItem) {
		$image = [];
		$imageSizes = Array('width' => 450, 'height' => 301);

		if(!empty($arItem['PREVIEW_PICTURE'])) {
			$imageID = $arItem['PREVIEW_PICTURE']['ID'];
		} else if(!empty($arItem['DETAIL_PICTURE'])) {
			$imageID = $arItem['DETAIL_PICTURE']['ID'];
		}

		if(!empty($imageID)) {
			$resize = CFile::ResizeImageGet($imageID,
			$imageSizes,
			BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false);

			if(!empty($resize['src'])) {
				$image['SRC'] = $resize['src'];
			}
		}
		//print_r($arItem['PREVIEW_PICTURE']['ID']);

		return $image;
	}
}

foreach($arResult['ITEMS'] as &$arItem) {
	$arItem['BRAND_IMAGE'] = getBrandImage($arItem);
}

$arResult['MORE_LINK_URL'] = !empty($arParams['MORE_LINK_URL']) ? $arParams['MORE_LINK_URL'] : null;
$arResult['MORE_LINK_TEXT'] =  !empty($arParams['MORE_LINK_TEXT']) ? $arParams['MORE_LINK_TEXT'] :'Все бренды';
