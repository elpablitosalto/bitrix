<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

$width = 80;
$height = 81;
foreach($arResult["ITEMS"] as &$arItem){
	if ($arItem["DETAIL_PICTURE"]["ID"] > 0) {
		$file = CFile::ResizeImageGet(
			$arItem["DETAIL_PICTURE"]["ID"],
			array('width' => $width, 'height' => $height),
			BX_RESIZE_IMAGE_PROPORTIONAL,
			true
		);
		//$arItem["DETAIL_PICTURE"]["DETAIL_PICTURE_RESIZED"] = $file['src'];

		$arItem['PICTURE'] = array(
			'SRC' => $file['src'],
			'ALT' => ('' != $arItem["DETAIL_PICTURE"]["ALT"]
				? $arItem["DETAIL_PICTURE"]["ALT"]
				: $arItem["NAME"]
			),
			'TITLE' => ('' != $arItem["DETAIL_PICTURE"]["TITLE"]
				? $arItem["DETAIL_PICTURE"]["TITLE"]
				: $arItem["NAME"]
			),
		);
	} else if ($arItem["PREVIEW_PICTURE"]["ID"] > 0) {
		$file = CFile::ResizeImageGet(
			$arItem["PREVIEW_PICTURE"]["ID"],
			array('width' => $width, 'height' => $height),
			BX_RESIZE_IMAGE_PROPORTIONAL,
			true
		);
		//$arItem["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"] = $file['src'];

		$arItem['PICTURE'] = array(
			'SRC' => $file['src'],
			'ALT' => ('' != $arItem["DETAIL_PICTURE"]["ALT"]
				? $arItem["DETAIL_PICTURE"]["ALT"]
				: $arItem["NAME"]
			),
			'TITLE' => ('' != $arItem["DETAIL_PICTURE"]["TITLE"]
				? $arItem["DETAIL_PICTURE"]["TITLE"]
				: $arItem["NAME"]
			),
		);
	} else {
		$file_path = $this->GetFolder().'/images/tile-empty.png';

		$arItem['PICTURE'] = array(
			'SRC' => $file_path,
			'ALT' => $arItem["NAME"],
			'TITLE' => $arItem["NAME"],
			"WIDTH" => $width,
			"HEIGHT" => $height,
		);
	}
}
