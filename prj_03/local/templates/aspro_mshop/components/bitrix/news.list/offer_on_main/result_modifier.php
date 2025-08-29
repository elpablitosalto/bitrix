<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

// Обрезка изображений -->
foreach ($arResult["ITEMS"] as &$arItem) {

	$arFile = array();
	if (!empty($arItem["PREVIEW_PICTURE"])) {
		$arFile = $arItem["PREVIEW_PICTURE"];
		if (!is_array($arFile) && intval($arItem["PREVIEW_PICTURE"]) > 0) {
			$arFile = CFile::GetFileArray($arItem["PREVIEW_PICTURE"]);
		}
	} else if (!empty($arItem["DETAIL_PICTURE"])) {
		$arFile = $arItem["DETAIL_PICTURE"];
		if (!is_array($arFile) && intval($arItem["DETAIL_PICTURE"]) > 0) {
			$arFile = CFile::GetFileArray($arItem["DETAIL_PICTURE"]);
		}
	}

	$arResultLocal = BitrixTools::getImageFormatted(array(
		'RESIZE' => 'Y',
		'FILE_VALUE' => $arFile,
		'NO_IMAGE_DEFAULT' => SITE_TEMPLATE_PATH . '/images/no_photo_medium.png',
		'WIDTH' => 170,
		'HEIGHT' => 170,
		'DEFAULT_ALT_TITLE' => $arItem['NAME']
	));
	$arItem['PICTURE'] = $arResultLocal['PICTURE'];
}
// <-- Обрезка изображений