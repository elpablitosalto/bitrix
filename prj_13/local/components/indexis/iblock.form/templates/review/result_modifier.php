<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/*
$arResult['DOCTOR'] = [];
if (!empty($arParams['DOCTOR_ID'])) {
    $res = CIBlockElement::GetList(['SORT' => 'ASC'], [
        'IBLOCK_ID' => Indexis::getIblockId('our_doctors', 'our_doctors'),
        'ACTIVE_DATE' => 'Y',
        'ACTIVE' => 'Y',
        'ID' => $arParams['DOCTOR_ID'],
    ], false, false, [
        'ID', 'NAME', 'PREVIEW_PICTURE', 'PROPERTY_ALT_PICTURE_2', 'PROPERTY_CLINICS.PROPERTY_METRO', 'PROPERTY_CLINICS.DETAIL_PAGE_URL'
    ]);

    while($ob = $res->GetNextElement())
    {
        $arFields = $ob->GetFields();

        if (count($arResult['DOCTOR']) == 0) {
            $arResult['DOCTOR'] = [
                'ID' => $arFields['ID'],
                'NAME' => $arFields['NAME'],
                'PICTURE_ID' => (!empty($arFields['PROPERTY_ALT_PICTURE_2_VALUE']) ? $arFields['PROPERTY_ALT_PICTURE_2_VALUE'] : $arFields['PREVIEW_PICTURE']),
                'METRO' => []
            ];
        }

        if (mb_strlen($arFields['PROPERTY_CLINICS_PROPERTY_METRO_VALUE']) > 0) {
            $arResult['DOCTOR']['METRO'][] = [
                'NAME' => $arFields['PROPERTY_CLINICS_PROPERTY_METRO_VALUE'],
                'URL' => $arFields['PROPERTY_CLINICS_DETAIL_PAGE_URL']
            ];
        }

		$arResult['DOCTOR']['PICTURE_RESIZED'] = CFile::ResizeImageGet(
			$arResult['DOCTOR']['PICTURE_ID'],
			array('width' => 350, 'height' => 350),
			BX_RESIZE_IMAGE_PROPORTIONAL,
			true
		);

    }
}
*/
?>