<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

// Параметры ИБ -->
if (intval($arParams['IBLOCK_ID']) > 0) {
	$res = CIBlock::GetList(
		array(),
		array(
			'ID' => $arParams['IBLOCK_ID'],
		),
		true
	);
	if ($ar_res = $res->Fetch()) {
		$h2 = $ar_res['DESCRIPTION'];
		if (strlen($h2) <= 0) {
			$h2 = $ar_res['NAME'];
		}

		$arFile = CFile::GetFileArray($ar_res["PICTURE"]);
		$arResultLocal = Indexis::getImageFormatted(array(
			'RESIZE' => 'N',
			'FILE_VALUE' => $arFile,
			'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/reviewer-thumb.png',
			//'WIDTH' => 205,
			//'HEIGHT' => 116,
			'DEFAULT_ALT_TITLE' => $ar_res['NAME']
		));
		$arResult['IBLOCK'] = array(
			'PICTURE' => $arResultLocal['PICTURE'],
			'H2' => $h2,
		);
	}
}
// <-- Параметры ИБ

// Элементы -->
if (!empty($arResult['SECTIONS'])) {
	$arSectionsIds = array();
	$arSections = array();
	foreach ($arResult['SECTIONS'] as &$arSection) {
		$arSectionsIds[] = $arSection['ID'];

		//$arFile = CFile::GetFileArray($arSection['PICTURE']);
		//vardump( $arSection['PICTURE'] );
		$arResultLocal = Indexis::getImageFormatted(array(
			'RESIZE' => 'N',
			'FILE_VALUE' => $arSection['PICTURE'],
			'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/reviewer-thumb.png',
			//'WIDTH' => 205,
			//'HEIGHT' => 116,
			'DEFAULT_ALT_TITLE' => $arSection['NAME']
		));
		$arSection['PICTURE_ALT'] = $arResultLocal['PICTURE'];

		$arSections[$arSection['ID']] = $arSection;
	}
	$arResult['SECTIONS'] = $arSections;

	if (!empty($arSectionsIds) && intval($arParams['IBLOCK_ID']) > 0) {
		$arSelect = array("ID", "NAME", "IBLOCK_ID", "DETAIL_PAGE_URL", 'IBLOCK_SECTION_ID', 'PREVIEW_PICTURE');
		$arFilter = array(
			"IBLOCK_ID" => $arParams['IBLOCK_ID'],
			"ACTIVE_DATE" => "Y",
			"ACTIVE" => "Y",
			'SECTION_ID' => $arSectionsIds
		);
		$res = CIBlockElement::GetList(array('sort' => 'asc'), $arFilter, false, false, $arSelect);
		while ($ob = $res->GetNextElement()) {
			$arFields = $ob->GetFields();

			$arFile = CFile::GetFileArray($arFields["PREVIEW_PICTURE"]);
			$arResultLocal = Indexis::getImageFormatted(array(
				'RESIZE' => 'N',
				'FILE_VALUE' => $arFile,
				'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/reviewer-thumb.png',
				//'WIDTH' => 205,
				//'HEIGHT' => 116,
				'DEFAULT_ALT_TITLE' => $arFields['NAME']
			));
			$arFields['PICTURE'] = $arResultLocal['PICTURE'];

			$arResult['SECTIONS'][$arFields['IBLOCK_SECTION_ID']]['ELEMENTS'][$arFields['ID']] = $arFields;
			$arResult['SECTIONS'][$arFields['IBLOCK_SECTION_ID']]['arElementsIds'][] = $arFields['ID'];
		}
	}
}
// <-- Элементы
