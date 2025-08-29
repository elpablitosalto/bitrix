<?
foreach($arResult['ITEMS'] as $key => &$arItem) {
	$fields = [
		'TITLE' => !empty($arItem['PROPERTIES']['TITLE']['VALUE']) ? $arItem['PROPERTIES']['TITLE']['VALUE'] : $arItem['NAME'],
		'DESCRIPTION' => !empty($arItem['PROPERTIES']['DESCRIPTION']['VALUE']) ? $arItem['PROPERTIES']['DESCRIPTION']['VALUE'] : null,
		'VIDEO_PREVIEW_PICTURE' => [],
		'VIDEO_PREVIEW_PICTURE_ORIGINAL' => [],
		'VIDEO_YOUTUBE_LINK' => !empty($arItem['PROPERTIES']['VIDEO_YOUTUBE_LINK']['VALUE']) ? $arItem['PROPERTIES']['VIDEO_YOUTUBE_LINK']['VALUE'] : null,
		'PRIMARY_BUTTON' => [
			'TEXT' => !empty($arItem['PROPERTIES']['PRIMARY_BUTTON_TEXT']['VALUE']) ? $arItem['PROPERTIES']['PRIMARY_BUTTON_TEXT']['VALUE'] : null,
			'HREF' => !empty($arItem['PROPERTIES']['PRIMARY_BUTTON_LINK']['VALUE']) ? $arItem['PROPERTIES']['PRIMARY_BUTTON_LINK']['VALUE'] : null,
			'CLASS' => null
		],
		'SECONDARY_BUTTON' => [
			'TEXT' => !empty($arItem['PROPERTIES']['SECONDARY_BUTTON_TEXT']['VALUE']) ? $arItem['PROPERTIES']['SECONDARY_BUTTON_TEXT']['VALUE'] : null,
			'HREF' => !empty($arItem['PROPERTIES']['SECONDARY_BUTTON_LINK']['VALUE']) ? $arItem['PROPERTIES']['SECONDARY_BUTTON_LINK']['VALUE'] : null,
			'CLASS' => null
		],
	];

	if(!empty($arItem['PROPERTIES']['VIDEO_PREVIEW_PICTURE']['VALUE'])) {
		$fields['VIDEO_PREVIEW_PICTURE'] = CFile::ResizeImageGet($arItem['PROPERTIES']['VIDEO_PREVIEW_PICTURE']['VALUE'],
		Array('width' => 886, 'height' => 600),
		BX_RESIZE_IMAGE_PROPORTIONAL, false);

		$fields['VIDEO_PREVIEW_PICTURE_ORIGINAL'] = CFile::GetFileArray($arItem['PROPERTIES']['VIDEO_PREVIEW_PICTURE']['VALUE']);
	}

	if (!empty($fields['VIDEO_YOUTUBE_LINK'])) {
		$videoSrc = $fields['VIDEO_YOUTUBE_LINK'];
		$codeQuery = '/(video\/(private\/)?|embed\/)(.+?)$/';

		preg_match($codeQuery, $videoSrc, $codeMatches);

		$fields['VIDEO_YOUTUBE_LINK'] = !empty($codeMatches[3]) ? 'https://rutube.ru/play/embed/'.$codeMatches[3] : $videoSrc;
	}

	$arItem = array_merge($arItem, $fields);

}