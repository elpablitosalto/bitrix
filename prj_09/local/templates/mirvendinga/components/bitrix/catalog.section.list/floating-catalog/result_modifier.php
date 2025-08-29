<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$arResult['GROUP_SECTIONS'] = [];

// Подсчет количества элементов в разделах -->
if (!empty($arResult['SECTIONS'])) {
	$arSectionsBuffer = array();
	$arSectionsIds = array();
	foreach ($arResult['SECTIONS'] as $arSection) {
		$arSectionsIds[] = $arSection['ID'];
	}
	//echo 'count = ' . count($arSectionsIds) . '<br />';

	if (!empty($arSectionsIds)) {
		$arFilter = array(
			'ID' => $arSectionsIds,
			'CNT_ACTIVE' => 'Y',
			'ELEMENT_SUBSECTIONS' => 'Y',
		);
		$db_list = CIBlockSection::GetList(array($by => $order), $arFilter, true);
		while ($ar_result = $db_list->GetNext()) {
			if ($ar_result['ELEMENT_CNT'] > 0) {
				$arSectionsBuffer[$ar_result['ID']]['ELEMENT_CNT'] = $ar_result['ELEMENT_CNT'];
				//$arResult['SECTIONS'][$ar_result['ID']]['ELEMENT_CNT'] = $ar_result['ELEMENT_CNT'];
			}
		}
	}

	foreach ($arResult['SECTIONS'] as &$arSection) {
		if (!empty($arSectionsBuffer[$arSection['ID']]['ELEMENT_CNT'])) {
			$arSection['ELEMENT_CNT'] = $arSectionsBuffer[$arSection['ID']]['ELEMENT_CNT'];
		}
	}
}
// <-- Подсчет количества элементов в разделах

foreach ($arResult['SECTIONS'] as &$arSection) {
	$arSection['HAS_CHILD'] = false;
	foreach ($arResult['SECTIONS'] as $arSubSection) {
		if (intVal($arSection['ID']) === intVal($arSubSection['IBLOCK_SECTION_ID'])) {
			$arSection['HAS_CHILD'] = true;
		}
	}
	if ($arSection['ELEMENT_CNT'] > 0) {
		$arResult['GROUP_SECTIONS'][] = $arSection;
	}
}
