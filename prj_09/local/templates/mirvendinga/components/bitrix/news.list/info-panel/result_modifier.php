<?php

if(!function_exists('getInfoPanelImage')) {
	function getInfoPanelImage($arItem) {
		$image = [];
		$imageSizes = Array('width' => 692, 'height' => 440);

		if(!empty($arItem['PREVIEW_PICTURE']['ID'])) {
			$imageID = $arItem['PREVIEW_PICTURE']['ID'];
		} elseif(!empty($arItem['DETAIL_PICTURE']['ID'])) {
			$imageID = $arItem['DETAIL_PICTURE']['ID'];
		}

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

if(!function_exists('getInfoPanelButton')) {
	function getInfoPanelButton($arItem) {
		$arButton = [];

		$arButton['TEXT'] = !empty($arItem['PROPERTIES']['BUTTON_TEXT']['VALUE']) ? $arItem['PROPERTIES']['BUTTON_TEXT']['VALUE'] : null;
		$arButton['HREF'] = !empty($arItem['PROPERTIES']['BUTTON_HREF']['VALUE']) ? $arItem['PROPERTIES']['BUTTON_HREF']['VALUE'] : null;

		if(!empty($arItem['PROPERTIES']['MODAL_FORM']['VALUE'])) {
			$arButton['CLASS'] = 'js-modal';
			$arButton['HREF'] = '#' . $arItem['PROPERTIES']['MODAL_FORM']['VALUE_XML_ID'];
		}

		return $arButton;
	}
}

if(!function_exists('getInfoPanelClasses')) {
	function getInfoPanelClasses($arItem) {
		$classes = [];

		if(!empty($arItem['PROPERTIES']['LAYOUT_TYPE']['VALUE_XML_ID'])) {
			$type = $arItem['PROPERTIES']['LAYOUT_TYPE']['VALUE_XML_ID'];

			if($type === 'REGULAR') $classes[] = 'info-panel_type_simple';
			$classes[] = $type;
		}

		if(!empty($arItem['PROPERTIES']['LAYOUT_RTL']['VALUE'])) $classes[] = 'info-panel_content_reversed';

		return $classes;
	}
}

foreach($arResult['ITEMS'] as &$arItem) {
	$arItem['IMAGE'] = getInfoPanelImage($arItem);
	$arItem['BUTTON'] = getInfoPanelButton($arItem);
	$arItem['SNIPPET_CLASS'] = implode(' ', getInfoPanelClasses($arItem));
	$arItem['BUTTON_HIDE'] = !empty($arItem['PROPERTIES']['BUTTON_HIDE']['VALUE']) ? true : false;

	if(!empty($arItem['PROPERTIES']['LAYOUT_TYPE']['VALUE_XML_ID'])) {
		$arItem['IS_MINIMAL'] = ($arItem['PROPERTIES']['LAYOUT_TYPE']['VALUE_XML_ID'] === 'MINIMAL') ? true : false;
	}

	$arItem['TEMPLATE_AREA'] = (!empty($arItem['PROPERTIES']['TEMPLATE_AREA']['VALUE_XML_ID'])) ? $arItem['PROPERTIES']['TEMPLATE_AREA']['VALUE_XML_ID'] : null;

	if($arItem['TEMPLATE_AREA'] === $arParams['TEMPLATE_AREA']) $arResult['DISPLAY_ITEMS'][] = $arItem;
}
