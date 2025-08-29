<?
if (!function_exists('replaceURLSpaces')) {
	function replaceURLSpaces($url) {
		return preg_replace('/ /', '%20', $url);
	}
}
if (!function_exists('getBannerImages')) {
	function getBannerImages($property, $isDouble) {
		if(empty($property)) {
			return null;
		}

		$arImageOriginal = CFile::GetFileArray($property);

		if ($isDouble === 'Y') {
			$arSizes = ['width' => intval(round($arImageOriginal["WIDTH"] / 2)), 'height' => intval(round($arImageOriginal["HEIGHT"] / 2))];
			$arImageHalved = CFile::ResizeImageGet($property, $arSizes, BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true, false);
		} else {
			$arSizes = ['width' => $arImageOriginal["WIDTH"], 'height' => $arImageOriginal["HEIGHT"]];
		}

		$srcOriginal = replaceURLSpaces($arImageOriginal['SRC']);
		$srcHalved = !empty($arImageHalved) ? replaceURLSpaces($arImageHalved['src']) : null;

		if ($isDouble === 'Y') {
			$srcset = $srcHalved.', '.$srcOriginal.' 2x';
		} else {
			$srcset = $srcOriginal;
		}

		return [
			'SRC' => $srcset,
			'ORIGINAL' => $srcOriginal,
			'HALVED' => $srcHalved,
			'WIDTH' => $arSizes['width'],
			'HEIGHT' => $arSizes['height']
		];
	}
}

$imageBreakpoints = ['S', 'M', 'L', 'XL', 'XXL'];
$breakpointAlias = [
	'L' => 'MOBILE',
	'XXL' => 'DESKTOP'
];

foreach($arResult['ITEMS'] as $key => &$arItem) {

	$fields = [
		'SHOW_TEXT' => (!empty($arItem['NAME']) && !empty($arItem['PREVIEW_TEXT'])) && empty($arItem['PROPERTIES']['ONLY_IMAGE']['VALUE']),
		'BANNER_CLASS' => [],
		'INLINE_STYLE' => [],
		'IMAGE' => ['BREAKPOINTS' => [], 'DEFAULT' => []],
		'BACKGROUND' => ['BREAKPOINTS' => [], 'DEFAULT' => []],
		'BUTTON' => [
			'SHOW' => empty($arItem['PROPERTIES']['BUTTON_HIDE']['VALUE']),
			'TEXT' => !empty($arItem['PROPERTIES']['BUTTON_TEXT']['VALUE']) ? $arItem['PROPERTIES']['BUTTON_TEXT']['VALUE'] : 'Подробнее',
			'HREF' => !empty($arItem['PROPERTIES']['URL']['VALUE']) ? $arItem['PROPERTIES']['URL']['VALUE'] : null,
			'CLASS' => null
		],
		'CAPTION' => !empty($arItem['PROPERTIES']['CAPTION']['VALUE']) ? $arItem['PROPERTIES']['CAPTION']['VALUE'] : null,
		'LABEL' => !empty($arItem['PROPERTIES']['LABEL']['VALUE']) ? $arItem['PROPERTIES']['LABEL']['VALUE'] : null
	];

	if(!empty($arItem['PROPERTIES']['LAYOUT_RTL']['VALUE'])) {
		$fields['BANNER_CLASS'][] = "banner_content-order_".$arItem['PROPERTIES']['LAYOUT_RTL']['VALUE_XML_ID'];
	}

	if(!empty($arItem['PROPERTIES']['IMAGE_POSITION']['VALUE'])) {
		$fields['BANNER_CLASS'][] = "banner_image-align_".$arItem['PROPERTIES']['IMAGE_POSITION']['VALUE_XML_ID'];
	}

	if(!empty($arItem['PROPERTIES']['IMAGE_SHIFT']['VALUE'])) {
		$fields['BANNER_CLASS'][] = "banner_image-shift_".$arItem['PROPERTIES']['IMAGE_SHIFT']['VALUE_XML_ID'];
	}

	if(!empty($arItem['PROPERTIES']['IMAGE_SIZE_INCREASE']['VALUE'])) {
		$fields['BANNER_CLASS'][] = "banner_image-position_absolute";
	}

	if(empty($arItem['PROPERTIES']['DECORATION']['VALUE'])) {
		$fields['BANNER_CLASS'][] = "banner_decoration_none";
	} else if ($arItem['PROPERTIES']['DECORATION']['VALUE'] !== 'Y') {
		$fields['BANNER_CLASS'][] = "banner_decoration_".$arItem['PROPERTIES']['DECORATION']['VALUE_XML_ID'];
	}

	if(!empty($arItem['PROPERTIES']['THEME']['VALUE']) && $arItem['PROPERTIES']['THEME']['VALUE_XML_ID'] !== 'default') {
		$fields['BANNER_CLASS'][] = "banner_style_".$arItem['PROPERTIES']['THEME']['VALUE_XML_ID'];
	}

	if(!empty($arItem['PROPERTIES']['TEXT_COLOR']['VALUE'])) {
		$fields['INLINE_STYLE'][] = "color: ".$arItem['PROPERTIES']['TEXT_COLOR']['VALUE'].";";
	}

	if(!empty($arItem['PROPERTIES']['BACKGROUND_COLOR']['VALUE'])) {
		$fields['INLINE_STYLE'][] = "background-color: ".$arItem['PROPERTIES']['BACKGROUND_COLOR']['VALUE'].";";
	}

	if(!empty($arItem['PROPERTIES']['MODAL_FORM']['VALUE'])) {
		$fields['BUTTON']['HREF'] = '#'.$arItem['PROPERTIES']['MODAL_FORM']['VALUE_XML_ID'];
		$fields['BUTTON']['CLASS'] = 'js-modal';
	}

	// Images
	$lastBreakpoint = null;
	foreach($imageBreakpoints as $i => $breakpoint) {
		$imageIsDouble = !empty($arItem['PROPERTIES']['IMAGE_IS_DOUBLE']['VALUE']) ? $arItem['PROPERTIES']['IMAGE_IS_DOUBLE']['VALUE_XML_ID'] : 'N';
		$imageData = getBannerImages($arItem['PROPERTIES']['IMAGE_'.$breakpoint]['VALUE'], $imageIsDouble);

		if (empty($imageData) && !empty($breakpointAlias[$breakpoint])) {
			$imageData = getBannerImages($arItem['PROPERTIES'][$breakpointAlias[$breakpoint].'_IMAGE']['VALUE'], $imageIsDouble);
		}

		if (!empty($imageData)) {
			$lastBreakpoint = $breakpoint;
			$fields['IMAGE']['BREAKPOINTS'][$breakpoint] = $imageData;
		}
	}

	if(!empty($fields['IMAGE']['BREAKPOINTS'])) {
		$arImage = $fields['IMAGE']['BREAKPOINTS'][$lastBreakpoint];
		$fields['IMAGE']['DEFAULT'] = $arImage;
		unset($fields['IMAGE']['BREAKPOINTS'][$lastBreakpoint]);
	}

	// Backgrounds
	$lastBreakpoint = null;
	foreach($imageBreakpoints as $i => $breakpoint) {
		$imageIsDouble = 'N';
		$imageData = getBannerImages($arItem['PROPERTIES']['BACKGROUND_'.$breakpoint]['VALUE'], $imageIsDouble);

		if (empty($imageData) && !empty($breakpointAlias[$breakpoint])) {
			$imageData = getBannerImages($arItem['PROPERTIES'][$breakpointAlias[$breakpoint].'_BACKGROUND']['VALUE'], $imageIsDouble);
		}

		if (!empty($imageData)) {
			$lastBreakpoint = $breakpoint;
			$fields['BACKGROUND']['BREAKPOINTS'][$breakpoint] = $imageData;
		}
	}

	if(!empty($fields['BACKGROUND']['BREAKPOINTS'])) {
		$arImage = $fields['BACKGROUND']['BREAKPOINTS'][$lastBreakpoint];
		$fields['BACKGROUND']['DEFAULT'] = $arImage;
		unset($fields['BACKGROUND']['BREAKPOINTS'][$lastBreakpoint]);
	}

	$arItem = array_merge($arItem, $fields);
}