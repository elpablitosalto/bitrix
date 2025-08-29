<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

foreach ($arResult["ITEMS"] as $key => &$arItem) {
	// Телефоны -->
	$arItem['PHONES']['arSources'] = (is_string($arItem['DISPLAY_PROPERTIES']['PHONE']['VALUE']) ?
		array(0 => $arItem['DISPLAY_PROPERTIES']['PHONE']['VALUE']) :
		$arItem['DISPLAY_PROPERTIES']['PHONE']['VALUE']
	);
	foreach ($arItem['PHONES']['arSources'] as $k => $phone) {
		$arItem['PHONES']['arValuesForLink'][$k] = preg_replace('![^0-9]+!', '', $phone);
	}
	// <-- Телефоны

	// Телефон для ссылки Связаться в WhatsApp -->
	if (strlen($arItem['DISPLAY_PROPERTIES']['PHONE_WHATSAPP']['VALUE']) > 0) {
		$arItem['WHATSAPP_PHONE_FOR_LINK'] = preg_replace('![^0-9]+!', '', $arItem['DISPLAY_PROPERTIES']['PHONE_WHATSAPP']['VALUE']);
	}
	// <-- 

	// Фото менеджера -->
	if (intval($arItem['DISPLAY_PROPERTIES']['MANAGER_PHOTO']['FILE_VALUE']['ID']) > 0) {

		$arResultLocal = Indexis::getImageFormatted( array(
			'RESIZE' => 'Y',
			'FILE_VALUE' => $arItem['DISPLAY_PROPERTIES']['MANAGER_PHOTO']['FILE_VALUE'],
			'WIDTH' => 80,
			'HEIGHT' => 80,
			'DEFAULT_ALT_TITLE' => $arItem['DISPLAY_PROPERTIES']['MANAGER']['VALUE']
		));
		$arItem['MANAGER_PHOTO'] = $arResultLocal['PICTURE'];
	}
	// <-- Фото менеджера
}