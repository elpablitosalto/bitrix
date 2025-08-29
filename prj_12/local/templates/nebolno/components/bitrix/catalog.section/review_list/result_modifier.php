<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

$arDoctorIds = [];
foreach ($arResult['ITEMS'] as $item) {
    if (is_array($item['PROPERTIES']['DOCTORS']['VALUE']) && count($item['PROPERTIES']['DOCTORS']['VALUE']) > 0)
        $arDoctorIds = array_merge($arDoctorIds, $item['PROPERTIES']['DOCTORS']['VALUE']);
}

$arDoctorIds = array_unique($arDoctorIds);
$arResult['DOCTOR_SPECIALIZATIONS'] = [];

if (count($arDoctorIds) > 0) {
    $res = CIBlockElement::GetList(['SORT' => 'ASC'], [
        'IBLOCK_ID' => Indexis::getIblockId('our_doctors', 'our_doctors'),
        'ACTIVE_DATE' => 'Y',
        'ACTIVE' => 'Y',
        'ID' => $arDoctorIds,
    ], false, false, [
        'ID', 'PROPERTY_SPECIALIZATIONS'
    ]);

    while($ob = $res->GetNextElement())
    {
        $arFields = $ob->GetFields();

        if (mb_strlen($arFields['PROPERTY_SPECIALIZATIONS_VALUE']) > 0)
            $arResult['DOCTOR_SPECIALIZATIONS'][$arFields['ID']][] = $arFields['PROPERTY_SPECIALIZATIONS_VALUE'];
    }
}

foreach ($arResult["ITEMS"] as &$arItem) {
	$arResultLocal = Indexis::getImageFormatted(array(
		'RESIZE' => 'Y',
		'FILE_VALUE' => $arItem['PREVIEW_PICTURE'],
		'WIDTH' => 368,
		'HEIGHT' => 368,
		'DEFAULT_ALT_TITLE' => $arItem['NAME'],
		'RESIZE_TYPE' => BX_RESIZE_IMAGE_EXACT
	));
	$arItem['PICTURE'] = $arResultLocal['PICTURE'];
	if (!empty($item['PROPERTIES']['PICTURE_BEFORE']['VALUE'])) {
		$arResultLocalBefore = Indexis::getImageFormatted(array(
			'RESIZE' => 'Y',
			'FILE_VALUE' => $item['PROPERTIES']['PICTURE_BEFORE']['VALUE'],
			'WIDTH' => 368,
			'HEIGHT' => 368,
			'DEFAULT_ALT_TITLE' => '',
			'RESIZE_TYPE' => BX_RESIZE_IMAGE_EXACT
		));
		$arItem['PICTURE_BEFORE'] = $arResultLocalBefore['PICTURE'];
	}
	if (!empty($item['PROPERTIES']['PICTURE_AFTER']['VALUE'])) {
		$arResultLocalAfter = Indexis::getImageFormatted(array(
			'RESIZE' => 'Y',
			'FILE_VALUE' => $item['PROPERTIES']['PICTURE_AFTER']['VALUE'],
			'WIDTH' => 368,
			'HEIGHT' => 368,
			'DEFAULT_ALT_TITLE' => '',
			'RESIZE_TYPE' => BX_RESIZE_IMAGE_EXACT
		));
		$arItem['PICTURE_AFTER'] = $arResultLocalAfter['PICTURE'];
	}
}

// Выясним минимальную длину отзыва -->
// <-- 
?>