<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arViewModeList = array('LIST', 'LINE', 'TEXT', 'TILE');

$arDefaultParams = array(
	'VIEW_MODE' => 'LIST',
	'SHOW_PARENT_NAME' => 'Y',
	'HIDE_SECTION_NAME' => 'N'
);

$arParams = array_merge($arDefaultParams, $arParams);


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

			if(CModule::IncludeModule("iblock")) {
				$items = GetIBlockElementList($arParams['IBLOCK_ID'], $arSection['ID'], Array("SORT"=>"ASC"), 5);
				$arSection['ITEMS'] = [];
				while($arItem = $items->GetNextElement()) {
					$element = $arItem->GetFields();
					$element['PROPERTIES'] = $arItem->GetProperties();

					if(!empty($element['PREVIEW_PICTURE'])) {
						$element['PICTURE_ID'] = $element['PREVIEW_PICTURE'];
					} else if(!empty($element['DETAIL_PICTURE'])) {
						$element['PICTURE_ID'] = $element['DETAIL_PICTURE'];
					}


					if(!empty($element['PROPERTIES'])) {
						$element['DISPLAY_PROPERTIES'] = [];

						if(!empty($element['PROPERTIES']['LINK']['VALUE'])) {
							$element['LINK'] = $element['PROPERTIES']['LINK']['VALUE'];
							$hasProtocol = strpos($element['LINK'], 'http');

							if($hasProtocol > 0 || (!$hasProtocol && $hasProtocol !== 0)) {
								$element['LINK'] = 'https://'.$element['LINK'];
							}
						}

						$displayProperties = [
							'OIL_TYPE',
							'OIL_VOLUME',
							'OIL_VISCOSITY',
							'ANTIFREEZE_TYPE',
							'ANTIFREEZE_VOLUME',
							'ANTIFREEZE_ADDITIVES',
							'LUBRICANT_VOLUME'
						];
						foreach($element['PROPERTIES'] as $propCode => $arProp) {
							if(in_array($propCode, $displayProperties)) {
								if(!empty($arProp['VALUE'])) {
									$element['DISPLAY_PROPERTIES'][$propCode] = $arProp;
								}
							}
						}
					}

					$arSection['ITEMS'][] = $element;
				}

				if(count($arSection['ITEMS'])) {
					$arResult['SECTIONS'][$key]['ITEMS'] = array_slice($arSection['ITEMS'], 0, 6);
				} else {
					unset($arResult['SECTIONS'][$key]);
				}
			}
		}
	}
}
?>