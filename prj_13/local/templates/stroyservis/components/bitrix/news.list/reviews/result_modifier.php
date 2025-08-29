<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

// Средний рейтинг -->
$arResult['AVERAGE_RATING'] = 0;
$arReitings = array();
/*
foreach ($arResult["ITEMS"] as &$arItem) {
	if (intval($arItem['PROPERTIES']['RATING']['VALUE']) > 0) {
		$arReitings[] = $arItem['PROPERTIES']['RATING']['VALUE'];
	}
}
*/
if (intval($arParams['PRODUCT_ID']) > 0 && intval($arParams['IBLOCK_ID']) > 0) {
	$arSelect = array("ID", "NAME", "PROPERTY_RATING");
	$arFilter = array(
		"IBLOCK_ID" => $arParams['IBLOCK_ID'], 
		"ACTIVE_DATE" => "Y", 
		"ACTIVE" => "Y", 
		"PROPERTY_HIDDEN_PRODUCT" => $arParams['PRODUCT_ID']
	);
	$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
	while ($ob = $res->GetNextElement()) {
		$arFields = $ob->GetFields();
		if (intval($arFields['PROPERTY_RATING_VALUE']) > 0) {
			$arReitings[] = $arFields['PROPERTY_RATING_VALUE'];
		}
	}
}
if (!empty($arReitings)) {
	$arResult['AVERAGE_RATING'] = round((array_sum($arReitings) / count($arReitings)), 1);
}
// <-- Средний рейтинг

// Количество отзывов -->
//vardump($arResult);
//echo 'NAV_RESULT = '.$arResult["NAV_RESULT"]->NavRecordCount.'<br>';
$arResult['ELEMENTS_COUNT'] = $arResult["NAV_RESULT"]->NavRecordCount;
// <-- 

// Картинки -->
if (!empty($arResult["ITEMS"])) {
	$width = $GLOBALS["arSiteConfig"]['REVIEWS_PRODUCT_DETAIL']['IMG_WIDTH'];
	$height = $GLOBALS["arSiteConfig"]['REVIEWS_PRODUCT_DETAIL']['IMG_HEIGHT'];

	foreach ($arResult["ITEMS"] as &$arItem) {
		$arResult['PICTURES'] = [];

		$arPhotoIds = array();
		if (!empty($arItem['PROPERTIES']['IMAGES']['VALUE'])) {
			$arPhotoIds = $arItem['PROPERTIES']['IMAGES']['VALUE'];
		}

		foreach ($arPhotoIds as $key => $file_id) {
			$file = CFile::ResizeImageGet(
				$file_id,
				array('width' => $width, 'height' => $height),
				BX_RESIZE_IMAGE_PROPORTIONAL,
				true
			);
			$ar_file = CFile::GetFileArray($file_id);
			$arPicture = array();
			if (is_file($_SERVER["DOCUMENT_ROOT"] . $file["src"])) {
				$arPicture = array(
					'SRC' => $file['src'],
					'SRC_SLIDE' => $file_slide['src'],
					'ALT' => ('' != $ar_file["ALT"]
						? $ar_file["ALT"]
						: $arItem["NAME"]
					),
					'TITLE' => ('' != $ar_file["TITLE"]
						? $ar_file["TITLE"]
						: $arItem["NAME"]
					),
					'SOURCE_PICTURE' => $ar_file,
				);
				//$morePhotoTmp[$key] = $arPicture;
			} else {
				$file_path = $this->GetFolder() . '/images/no_photo.png';

				$arPicture = array(
					'SRC' => $file_path,
					'SRC_SLIDE' => $file_path,
					'ALT' => $arItem["NAME"],
					'TITLE' => $arItem["NAME"],
					"WIDTH" => $width,
					"HEIGHT" => $height,
					"WIDTH_SLIDE" => $width_slide,
					"HEIGHT_SLIDE" => $height_slide,
					'SOURCE_PICTURE' => $ar_file,
				);
			}
			$arItem['PICTURES'][] = $arPicture;
		}
		/*
		if (count($arItem['PICTURES']) <= 0) {
			$file_path = $this->GetFolder() . '/images/no_photo.png';

			$arPicture = array(
				'SRC' => $file_path,
				'SRC_SLIDE' => $file_path,
				'ALT' => $arItem["NAME"],
				'TITLE' => $arItem["NAME"],
				"WIDTH" => $width,
				"HEIGHT" => $height,
				"WIDTH_SLIDE" => $width_slide,
				"HEIGHT_SLIDE" => $height_slide,
				'SOURCE_PICTURE' => $ar_file,
			);

			$arItem['PICTURES'][] = $arPicture;
		}
		*/
	}
}
// <-- 


/*
foreach($arResult["ITEMS"] as &$arItem){
	if($arItem["DETAIL_PICTURE"]["ID"] > 0){
        $file = CFile::ResizeImageGet(
			$arItem["DETAIL_PICTURE"]["ID"], 
			array('width'=>165, 'height'=>229), 
			BX_RESIZE_IMAGE_PROPORTIONAL, 
			true
		);
        $arItem["DETAIL_PICTURE"]["DETAIL_PICTURE_RESIZED"] = $file['src'];
    }
}
*/
