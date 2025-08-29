<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

foreach ($arResult['SECTIONS'] as &$arSection) {
	if (false === $arSection['PICTURE'] || !is_file($_SERVER["DOCUMENT_ROOT"] . $arSection['PICTURE']['SRC'])) {
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

	//vardump($arSection['PICTURE']);

	$arFileCustom = $arSection['PICTURE'];
	$size = 'S';
	if ($arFileCustom['HEIGHT'] >= $arFileCustom['WIDTH'] && intval($arFileCustom['HEIGHT']) > 285) {
		$size = 'L';
	} else if ($arFileCustom['HEIGHT'] < $arFileCustom['WIDTH'] && intval($arFileCustom['WIDTH']) > 285) {
		$size = 'M';
	}
	$arSection['PICTURE']['SIZE'] = $size;

	// -->
	$arSection["SECTION_PAGE_URL"] = str_replace(
		array('/catalog/tekhnologiya-color-mix/', '/catalog/tekhnologiya-stone-top/'),
		array('/tekhnologiya-color-mix/', '/tekhnologiya-stone-top/'),
		$arSection["SECTION_PAGE_URL"]
	);

	if (strpos($arSection['SECTION_PAGE_URL'], '/tekhnologiya-color-mix/') !== false) {
		$arSection['EDIT_ID'] = 604;
		$arSelect = array("ID");
		$arFilter = array("IBLOCK_ID" => 56, "ID" => $arSection['EDIT_ID']);
		$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
		if ($ob = $res->GetNextElement()) {
		} else {
			$arSection['EDIT_ID'] = 630;
		}
	} else if (strpos($arSection['SECTION_PAGE_URL'], '/tekhnologiya-stone-top/') !== false) {
		$arSection['EDIT_ID'] = 605;
		$arSelect = array("ID");
		$arFilter = array("IBLOCK_ID" => 56, "ID" => $arSection['EDIT_ID']);
		$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
		if ($ob = $res->GetNextElement()) {
		} else {
			$arSection['EDIT_ID'] = 631;
		}
	}
	if (!empty($arSection['EDIT_ID'])) {
		$arItem = array();
		$arButtons = CIBlock::GetPanelButtons(
			56,
			$arSection['EDIT_ID'],
			0,
			array("SECTION_BUTTONS" => false, "SESSID" => false)
		);
		//echo '<pre>', print_r($arButtons), '</pre>';
		$arItem["ADD_LINK"] = $arButtons["edit"]["add_element"]["ACTION_URL"];
		$arItem["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
		$arItem["DELETE_LINK"] = $arButtons["edit"]["delete_element"]["ACTION_URL"];

		$arItem["ADD_LINK_TEXT"] = $arButtons["edit"]["add_element"]["TEXT"];
		$arItem["EDIT_LINK_TEXT"] = $arButtons["edit"]["edit_element"]["TEXT"];
		$arItem["DELETE_LINK_TEXT"] = $arButtons["edit"]["delete_element"]["TEXT"];

		$arSection['EDIT_ITEM'] = $arItem;
	}
	// <--
}

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
