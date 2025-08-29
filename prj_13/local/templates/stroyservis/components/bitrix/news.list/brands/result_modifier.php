<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */


// Картинки -->
$width = 250;
$height = 250;
foreach ($arResult["ITEMS"] as &$arItem) {
	if ($arItem["DETAIL_PICTURE"]["ID"] > 0/* && is_file($_SERVER["DOCUMENT_ROOT"] . $arItem["DETAIL_PICTURE"]["SRC"])*/) {
		$file = CFile::ResizeImageGet(
			$arItem["DETAIL_PICTURE"]["ID"],
			array('width' => $width, 'height' => $height),
			BX_RESIZE_IMAGE_PROPORTIONAL,
			true
		);
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
	} else if ($arItem["PREVIEW_PICTURE"]["ID"] > 0/* && is_file($_SERVER["DOCUMENT_ROOT"] . $arItem["PREVIEW_PICTURE"]["SRC"])*/) {
		$file = CFile::ResizeImageGet(
			$arItem["PREVIEW_PICTURE"]["ID"],
			array('width' => $width, 'height' => $height),
			BX_RESIZE_IMAGE_PROPORTIONAL,
			true
		);
		$arItem['PICTURE'] = array(
			'SRC' => $file['src'],
			'ALT' => ('' != $arItem["PREVIEW_PICTURE"]["ALT"]
				? $arItem["PREVIEW_PICTURE"]["ALT"]
				: $arItem["NAME"]
			),
			'TITLE' => ('' != $arItem["PREVIEW_PICTURE"]["TITLE"]
				? $arItem["PREVIEW_PICTURE"]["TITLE"]
				: $arItem["NAME"]
			),
		);
	} else {
		$file_path = $this->GetFolder() . '/images/tile-empty.png';
		$arItem['PICTURE'] = array(
			'SRC' => $file_path,
			'ALT' => $arItem["NAME"],
			'TITLE' => $arItem["NAME"],
			"WIDTH" => $width,
			"HEIGHT" => $height,
		);
	}
}
// <-- Картинки

foreach ($arResult["ITEMS"] as &$arItem) {
	// Название -->
	$arName = array();
	$s = $arItem["DISPLAY_PROPERTIES"]["ORIGINAL_NAME"]["VALUE"];
	if (strlen($s) > 0) {
		$arName[] = $s;
	}
	$arName[] = $arItem["NAME"];
	$arItem["DISPLAY_NAME"] = implode('/', $arName);
	// <-- Название
}

// Страны -->
foreach ($arResult["ITEMS"] as &$arItem) {
	//$arValues = $arItem["DISPLAY_PROPERTIES"]["COUNTRIES"]["VALUE"];
	$arValues = [];
	if (intval($arItem["DISPLAY_PROPERTIES"]["COUNTRY_HOME"]["VALUE"]) > 0) {
		$arValues[] = $arItem["DISPLAY_PROPERTIES"]["COUNTRY_HOME"]["VALUE"];
	}
	if (intval($arItem["DISPLAY_PROPERTIES"]["COUNTRY_MADE"]["VALUE"])) {
		$arValues[] = $arItem["DISPLAY_PROPERTIES"]["COUNTRY_MADE"]["VALUE"];
	}
	$IBLOCK_ID = Indexis::getIblockId('countries');
	if (!empty($arValues) && intval($IBLOCK_ID) > 0) {
		$arSelect = array("ID", "NAME", "PREVIEW_PICTURE", "DETAIL_PICTURE");
		$arFilter = array(
			"IBLOCK_ID" => IntVal($IBLOCK_ID),
			"ACTIVE_DATE" => "Y",
			"ACTIVE" => "Y",
			"ID" => $arValues,
		);
		$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
		while ($ob = $res->GetNextElement()) {
			$arFields = $ob->GetFields();

			// Картинка -->
			$PICTURE = array();
			$width = 16;
			$height = 16;
			$arFields["DETAIL_PICTURE"] = CFile::GetFileArray($arFields["DETAIL_PICTURE"]);
			$arFields["PREVIEW_PICTURE"] = CFile::GetFileArray($arFields["PREVIEW_PICTURE"]);
			if ($arFields["DETAIL_PICTURE"]["ID"] > 0/* && is_file($_SERVER["DOCUMENT_ROOT"] . $arFields["DETAIL_PICTURE"]["SRC"])*/) {
				$file = CFile::ResizeImageGet(
					$arFields["DETAIL_PICTURE"]["ID"],
					array('width' => $width, 'height' => $height),
					BX_RESIZE_IMAGE_PROPORTIONAL,
					true
				);
				$PICTURE = array(
					'SRC' => $file['src'],
					'ALT' => ('' != $arFields["DETAIL_PICTURE"]["ALT"]
						? $arFields["DETAIL_PICTURE"]["ALT"]
						: $arFields["NAME"]
					),
					'TITLE' => ('' != $arFields["DETAIL_PICTURE"]["TITLE"]
						? $arFields["DETAIL_PICTURE"]["TITLE"]
						: $arFields["NAME"]
					),
				);
			} else if ($arFields["PREVIEW_PICTURE"]["ID"] > 0/* && is_file($_SERVER["DOCUMENT_ROOT"] . $arFields["PREVIEW_PICTURE"]["SRC"])*/) {
				$file = CFile::ResizeImageGet(
					$arFields["PREVIEW_PICTURE"]["ID"],
					array('width' => $width, 'height' => $height),
					BX_RESIZE_IMAGE_PROPORTIONAL,
					true
				);
				$PICTURE = array(
					'SRC' => $file['src'],
					'ALT' => ('' != $arFields["DETAIL_PICTURE"]["ALT"]
						? $arFields["DETAIL_PICTURE"]["ALT"]
						: $arFields["NAME"]
					),
					'TITLE' => ('' != $arFields["DETAIL_PICTURE"]["TITLE"]
						? $arFields["DETAIL_PICTURE"]["TITLE"]
						: $arFields["NAME"]
					),
				);
			} else {
				$file_path = $this->GetFolder() . '/images/tile-empty.png';

				$PICTURE = array(
					'SRC' => $file_path,
					'ALT' => $arFields["NAME"],
					'TITLE' => $arFields["NAME"],
					"WIDTH" => $width,
					"HEIGHT" => $height,
				);
			}
			// <-- Картинка

			$arItem["arCountries"][$arFields["ID"]] = array(
				"NAME" => $arFields["NAME"],
				"PICTURE" => $PICTURE,
			);
		}
	}
}
// <-- Страны
