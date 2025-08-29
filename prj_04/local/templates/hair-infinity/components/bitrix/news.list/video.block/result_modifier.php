<?

// Обрезка изображений -->
foreach ($arResult["ITEMS"] as &$arItem) {
	$arFile = CFile::GetFileArray($arItem['PROPERTIES']['VIDEO_PREVIEW']['VALUE']);
    $arResultLocal = BitrixTools::getImageFormatted(array(
		'RESIZE' => 'Y',
		'FILE_VALUE' => $arFile,
		'NO_IMAGE_DEFAULT' => SITE_TEMPLATE_PATH . '/images/no_photo_medium.png',
		'WIDTH' => 1440,
		'HEIGHT' => 1440,
		'DEFAULT_ALT_TITLE' => $arItem['NAME']
	));
	$arItem['PICTURE']['DESKTOP'] = $arResultLocal['PICTURE'];
}
// <-- Обрезка изображений