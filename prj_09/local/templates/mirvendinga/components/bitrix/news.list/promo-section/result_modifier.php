<?
$total = count($arResult['ITEMS']);
$i = 0;

if (!function_exists('getGridClasses')) {
	function getGridClasses($total ) {
		$classes = '';

		if(!empty($total)) {
			switch ($total) {
				case 1:
					$classes = 'promo-group_layout_l';
					break;
				case 2:
					$classes = 'promo-group_layout_m';
					break;
				case 3:
					$classes = 'promo-group_layout_s';
					break;
				case 4:
					$classes = 'promo-group_layout_mixed';
					break;
				case 5:
					$classes = 'promo-group_layout_mixed';
					break;
			}
		}

		return $classes;
	}
}

if (!function_exists('getSectionImage')) {
	function getSectionImage($arItem) {
		$image = [];
		$imageSizes = Array('width' => 387, 'height' => 200);

		if($total === 1) {
			$imageSizes = Array('width' => 692, 'height' => 400);
		}

		$previewImage = $arItem['PREVIEW_PICTURE'];
		$imageID = !empty($arItem['PREVIEW_PICTURE']['ID']) ? $arItem['PREVIEW_PICTURE']['ID'] : null;

		if(!empty($arItem['PROPERTIES']['SECTION_IMAGE']['VALUE'])) {
			$imageID = $arItem['PROPERTIES']['SECTION_IMAGE']['VALUE'];
		}

		if(!empty($imageID)) {
			$resize = CFile::ResizeImageGet($imageID,
			$imageSizes,
			BX_RESIZE_IMAGE_PROPORTIONAL, false);

			if(!empty($resize['src'])) {
				$image['SRC'] = $resize['src'];
			}
		}

		return $image;
	}
}

if (!function_exists('getSnippetName')) {
	function getSnippetName($arItem) {
		$name = $arItem['NAME'];

		if(!empty($arItem['PROPERTIES']['SECTION_NAME']['VALUE'])) {
			$name = $arItem['PROPERTIES']['SECTION_NAME']['VALUE'];
		}

		return TruncateText($name, 50);
	}
}

if (!function_exists('getSnippetPreviewText')) {
	function getSnippetPreviewText($arItem) {
		$text = $arItem['PREVIEW_TEXT'];

		if(!empty($arItem['PROPERTIES']['SECTION_TEXT']['VALUE'])) {
			$text = $arItem['PROPERTIES']['SECTION_TEXT']['VALUE'];
		}

		return TruncateText($text, 60);
	}
}

foreach($arResult['ITEMS'] as &$arItem) {
	$classes = [];

	if(!empty($arItem['PROPERTIES']['LAYOUT_TYPE']['VALUE'])) {
		$classes[] = "promo-panel_layout_".$arItem['PROPERTIES']['LAYOUT_TYPE']['VALUE_XML_ID'];
	}

	if(!empty($arItem['PROPERTIES']['DISPLAYED_CONTENT']['VALUE'])) {
		$classes[] = "promo-panel_layout_".$arItem['PROPERTIES']['DISPLAYED_CONTENT']['VALUE_XML_ID'];
	}

	if(!empty($arItem['PROPERTIES']['STYLE_TYPE']['VALUE'])) {
		$classes[] = "promo-panel_style_".$arItem['PROPERTIES']['STYLE_TYPE']['VALUE_XML_ID'];
	}

	$arItem['SECTION_SNIPPET_CLASS'] = implode(' ', $classes);
	$i++;

	$arItem['SECTION_IMAGE'] = getSectionImage($arItem);
	$arItem['NAME'] = getSnippetName($arItem);
	$arItem['PREVIEW_TEXT'] = getSnippetPreviewText($arItem);
}

$arResult['GRID_CLASS'] = getGridClasses($total);
$arResult['MORE_LINK_URL'] = !empty($arParams['MORE_LINK_URL']) ? $arParams['MORE_LINK_URL'] : null;
$arResult['MORE_LINK_TEXT'] =  !empty($arParams['MORE_LINK_TEXT']) ? $arParams['MORE_LINK_TEXT'] :'Все акции';
