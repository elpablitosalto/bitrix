<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

$arResult["DOCTOR_PHOTO"] = CFile::ResizeImageGet(
	$arResult['PREVIEW_PICTURE']['ID'],
	array('width' => 640, 'height' => 640),
	BX_RESIZE_IMAGE_PROPORTIONAL,
	true
);

$arResult['DOCTOR_METRO'] = [];
if (is_array($arResult['PROPERTIES']['CLINICS']['VALUE']) && count($arResult['PROPERTIES']['CLINICS']['VALUE']) > 0) {
    $res = CIBlockElement::GetList(['SORT' => 'ASC'], [
        'IBLOCK_ID' => Indexis::getIblockId('addresses', 'contacts'),
        'ACTIVE_DATE' => 'Y',
        'ACTIVE' => 'Y',
        'ID' => $arResult['PROPERTIES']['CLINICS']['VALUE'],
    ], false, false, [
        'ID', 'PROPERTY_METRO'
    ]);

    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $arResult['DOCTOR_METRO'][$arFields['PROPERTY_METRO_ENUM_ID']] = $arFields['PROPERTY_METRO_VALUE'];
    }
}

// Сертификаты -->
$arResult["arSertificates"] = array();
if (!empty($arResult['PROPERTIES']['SERTIFICATES_COMP']['VALUE'])) {
    foreach ($arResult['PROPERTIES']['SERTIFICATES_COMP']['VALUE'] as $key => $val) {
        $file_id = $val["SUB_VALUES"]["SERTIFICATES_FILE"]["VALUE"];
        if (intval($file_id) > 0) {
            $source_img_path = CFile::GetPath($file_id);
        }
        $desc = $val["SUB_VALUES"]["SERTIFICATES_DESC"]["VALUE"]["TEXT"];
        $arPicture = CFile::ResizeImageGet(
            $file_id,
            array('width' => 322, 'height' => 322),
            BX_RESIZE_IMAGE_PROPORTIONAL,
            true
        );
        $thumb_img_path = $arPicture["src"];

        if (strlen($source_img_path) > 0 && strlen($thumb_img_path) > 0) {
            $arResult["arSertificates"][] = array(
                "SOURCE_IMG_PATH" => $source_img_path,
                "THUMB_IMG_PATH" => $thumb_img_path,
                "DESC" => $desc,
            );
        }
    }
} else if (!empty($arResult['PROPERTIES']['SERTIFICATES']['VALUE'])) {
    foreach ($arResult['PROPERTIES']['SERTIFICATES']['VALUE'] as $key => $val) {
        $source_img_path = CFile::GetPath($val);
        $desc = $arResult['PROPERTIES']['SERTIFICATES']['DESCRIPTION'][$key];
        $arPicture = CFile::ResizeImageGet(
            $val,
            array('width' => 322, 'height' => 322),
			BX_RESIZE_IMAGE_PROPORTIONAL,
            true
        );
        $thumb_img_path = $arPicture["src"];
        if (strlen($source_img_path) > 0 && strlen($thumb_img_path) > 0) {
            $arResult["arSertificates"][] = array(
                "SOURCE_IMG_PATH" => $source_img_path,
                "THUMB_IMG_PATH" => $thumb_img_path,
                "DESC" => $desc,
            );
        }
    }
}
// <-- Сертификаты