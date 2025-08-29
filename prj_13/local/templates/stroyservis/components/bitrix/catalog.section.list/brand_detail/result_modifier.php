<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

// Изображения -->
$arResult['arSectionsIds'] = [];
foreach ($arResult['SECTIONS'] as &$arSection) {
	$arResult['arSectionsIds'][] = $arSection['ID'];

	if (false === $arSection['PICTURE']/* || !is_file($_SERVER["DOCUMENT_ROOT"] . $arSection['PICTURE']['SRC'])*/) {
		$arSection['PICTURE'] = array(
			'SRC' => $this->GetFolder() . '/images/tile-empty.png',
			'ALT' => ('' != $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
				? $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
				: $arSection["NAME"]
			),
			'TITLE' => ('' != $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
				? $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
				: $arSection["NAME"]
			)
		);
	}

    if (!empty($arParams['BRAND_ID'])) {
        $res = CIBlockElement::GetList(
            ['PROPERTY_PRICE_HIDE' => 'ASC', 'SORT' => 'ASC'], [
            'IBLOCK_ID' => $arParams['IBLOCK_ID'],
            'ACTIVE_DATE' => 'Y',
            'ACTIVE' => 'Y',
            'IBLOCK_SECTION_ID' => $arSection['ID'],
            array(
				'LOGIC' => 'OR',
				array('!DETAIL_PICTURE' => false),
				array('!PREVIEW_PICTURE' => false),
			),
            'PROPERTY_PROIZVODITEL_EL' => $arParams['BRAND_ID']
        ], false, ['nPageSize' => 1], [
            'ID', 'DETAIL_PICTURE', 'PREVIEW_PICTURE'
        ]);

        if ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            $sectionPictureId = ($arFields['PREVIEW_PICTURE'] ? $arFields['PREVIEW_PICTURE'] : $arFields['DETAIL_PICTURE']);
            $arSectionPicture = CFile::ResizeImageGet($sectionPictureId, array('width'=>80, 'height'=>80), BX_RESIZE_IMAGE_PROPORTIONAL, true);
            $arSection['PICTURE']['SRC'] = $arSectionPicture['src'];
        }
    }
}
// <-- Изображения

// URL'ы на фильтры -->
foreach ($arResult['SECTIONS'] as &$arSection) {
	$arSection['SECTION_PAGE_URL_FILTER'] = $arSection['SECTION_PAGE_URL'] . $arParams['SUFFIX_FILTER'];
}
// <-- URL'ы на фильтры



/*
$arViewModeList = array('LIST', 'LINE', 'TEXT', 'TILE');

$arDefaultParams = array(
	'VIEW_MODE' => 'LIST',
	'SHOW_PARENT_NAME' => 'Y',
	'HIDE_SECTION_NAME' => 'N'
);

$arParams = array_merge($arDefaultParams, $arParams);

if (!in_array($arParams['VIEW_MODE'], $arViewModeList))
	$arParams['VIEW_MODE'] = 'LIST';
if ('N' != $arParams['SHOW_PARENT_NAME'])
	$arParams['SHOW_PARENT_NAME'] = 'Y';
if ('Y' != $arParams['HIDE_SECTION_NAME'])
	$arParams['HIDE_SECTION_NAME'] = 'N';

$arResult['VIEW_MODE_LIST'] = $arViewModeList;

if (0 < $arResult['SECTIONS_COUNT'])
{
	if ('LIST' != $arParams['VIEW_MODE'])
	{
		$boolClear = false;
		$arNewSections = array();
		foreach ($arResult['SECTIONS'] as &$arOneSection)
		{
			if (1 < $arOneSection['RELATIVE_DEPTH_LEVEL'])
			{
				$boolClear = true;
				continue;
			}
			$arNewSections[] = $arOneSection;
		}
		unset($arOneSection);
		if ($boolClear)
		{
			$arResult['SECTIONS'] = $arNewSections;
			$arResult['SECTIONS_COUNT'] = count($arNewSections);
		}
		unset($arNewSections);
	}
}

if (0 < $arResult['SECTIONS_COUNT'])
{
	$boolPicture = false;
	$boolDescr = false;
	$arSelect = array('ID');
	$arMap = array();
	if ('LINE' == $arParams['VIEW_MODE'] || 'TILE' == $arParams['VIEW_MODE'])
	{
		reset($arResult['SECTIONS']);
		$arCurrent = current($arResult['SECTIONS']);
		if (!isset($arCurrent['PICTURE']))
		{
			$boolPicture = true;
			$arSelect[] = 'PICTURE';
		}
		if ('LINE' == $arParams['VIEW_MODE'] && !array_key_exists('DESCRIPTION', $arCurrent))
		{
			$boolDescr = true;
			$arSelect[] = 'DESCRIPTION';
			$arSelect[] = 'DESCRIPTION_TYPE';
		}
	}
	if ($boolPicture || $boolDescr)
	{
		foreach ($arResult['SECTIONS'] as $key => $arSection)
		{
			$arMap[$arSection['ID']] = $key;
		}
		$rsSections = CIBlockSection::GetList(array(), array('ID' => array_keys($arMap)), false, $arSelect);
		while ($arSection = $rsSections->GetNext())
		{
			if (!isset($arMap[$arSection['ID']]))
				continue;
			$key = $arMap[$arSection['ID']];
			if ($boolPicture)
			{
				$arSection['PICTURE'] = intval($arSection['PICTURE']);
				$arSection['PICTURE'] = (0 < $arSection['PICTURE'] ? CFile::GetFileArray($arSection['PICTURE']) : false);
				$arResult['SECTIONS'][$key]['PICTURE'] = $arSection['PICTURE'];
				$arResult['SECTIONS'][$key]['~PICTURE'] = $arSection['~PICTURE'];
			}
			if ($boolDescr)
			{
				$arResult['SECTIONS'][$key]['DESCRIPTION'] = $arSection['DESCRIPTION'];
				$arResult['SECTIONS'][$key]['~DESCRIPTION'] = $arSection['~DESCRIPTION'];
				$arResult['SECTIONS'][$key]['DESCRIPTION_TYPE'] = $arSection['DESCRIPTION_TYPE'];
				$arResult['SECTIONS'][$key]['~DESCRIPTION_TYPE'] = $arSection['~DESCRIPTION_TYPE'];
			}
		}
	}
}
*/
