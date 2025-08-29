<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */


foreach ($arResult["ITEMS"] as &$arItem) {
	$fileValues = (isset($arItem['DISPLAY_PROPERTIES']['CERTIFICATE']['FILE_VALUE']['ID']) ?
		array(0 => $arItem['DISPLAY_PROPERTIES']['CERTIFICATE']['FILE_VALUE']) :
		$arItem['DISPLAY_PROPERTIES']['CERTIFICATE']['FILE_VALUE']
	);
	foreach ($fileValues as $key => $photo) {
		$arResultLocal = Indexis::getImageFormatted(array(
			'RESIZE' => 'Y',
			'FILE_VALUE' => $photo,
			'WIDTH' => 160,
			'HEIGHT' => 220,
			'DEFAULT_ALT_TITLE' => $arItem['NAME']
		));
		$arItem['PICTURES'][] = $arResultLocal['PICTURE'];
	}
}