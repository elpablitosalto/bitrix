<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

// Слайдер -->
if (intval($arResult['ID']) > 0) {
    $arResult['PICTURES'] = array();
    $arFiles = array();
    //vardump($arResult['DISPLAY_PROPERTIES']['IMAGES']);
    if (intval($arResult['DISPLAY_PROPERTIES']['IMAGES']['FILE_VALUE']['ID']) <= 0) {
        foreach ($arResult['DISPLAY_PROPERTIES']['IMAGES']['FILE_VALUE'] as $key => $arFileCustom) {
            $arFiles[] = $arFileCustom;
        }
    } else {
        $arFiles[] = $arResult['DISPLAY_PROPERTIES']['IMAGES']['FILE_VALUE'];
    }

    //vardump($arResult['DISPLAY_PROPERTIES']['IMAGES']);

    foreach ($arFiles as $key => $arFileCustom) {
        $arPicture = array(
            'SRC' => $arFileCustom['SRC'],
            'ALT' => ('' != $arFileCustom["ALT"]
                ? $arFileCustom["ALT"]
                : $arResult["NAME"]
            ),
            'TITLE' => ('' != $arFileCustom["TITLE"]
                ? $arFileCustom["TITLE"]
                : $arResult["NAME"]
            ),
            'HEIGHT' => $arFileCustom['HEIGHT'],
            'WIDTH' => $arFileCustom['WIDTH'],
            'SOURCE_PICTURE' => $arFileCustom,
            'DESCRIPTION' => $arFileCustom['DESCRIPTION'],
        );
        $arResult['PICTURES'][] = $arPicture;
    }
}
// <-- Слайдер

// Галерея -->
if (intval($arResult['ID']) > 0) {
    $arResult['PICTURES_GALLERY'] = array();

    $arFiles = array();
    //vardump($arResult['DISPLAY_PROPERTIES']['IMAGES']);
    if (intval($arResult['DISPLAY_PROPERTIES']['IMAGES_GALLERY']['FILE_VALUE']['ID']) <= 0) {
        foreach ($arResult['DISPLAY_PROPERTIES']['IMAGES_GALLERY']['FILE_VALUE'] as $key => $arFileCustom) {
            $arFiles[] = $arFileCustom;
        }
    } else {
        $arFiles[] = $arResult['DISPLAY_PROPERTIES']['IMAGES_GALLERY']['FILE_VALUE'];
    }

    $width = 600;
    $height = 600;
    foreach ($arFiles as $key => $arFile) {
        $arFileResize = CFile::ResizeImageGet(
            $arFile['ID'],
            array('width' => $width, 'height' => $height),
            BX_RESIZE_IMAGE_PROPORTIONAL,
            true
        );
        $arPicture = array(
            'SRC' => $arFileResize['src'],
            'ALT' => ('' != $arFile["ALT"]
                ? $arFile["ALT"]
                : $arResult["NAME"]
            ),
            'TITLE' => ('' != $arFile["TITLE"]
                ? $arFile["TITLE"]
                : $arResult["NAME"]
            ),
            'HEIGHT' => $arFileResize['height'],
            'WIDTH' => $arFileResize['width'],
            'SOURCE_PICTURE' => $arFile,
        );
        $arResult['PICTURES_GALLERY'][] = $arPicture;
    }
}
// <-- Галерея

// Особенности продукта -->
$arResult['arAdvantages'] = array();
foreach ($arResult['PROPERTIES']['ADVANTAGES']['VALUE'] as $key => $ar) {
    $arAdvantage = array();
    if (intval($ar['SUB_VALUES']['ADVANTAGES_ICON']['VALUE']) > 0) {
        //vardump($ar['SUB_VALUES']['ADVANTAGES_ICON']);
        $arFile = CFile::GetFileArray($ar['SUB_VALUES']['ADVANTAGES_ICON']['VALUE']);
        $arPicture = array(
            'SRC' => $arFile['SRC'],
            'ALT' => ('' != $arFile["ALT"]
                ? $arFile["ALT"]
                : $arResult["NAME"]
            ),
            'TITLE' => ('' != $arFile["TITLE"]
                ? $arFile["TITLE"]
                : $arResult["NAME"]
            ),
            'HEIGHT' => $arFile['HEIGHT'],
            'WIDTH' => $arFile['WIDTH'],
            'SOURCE_PICTURE' => $arFile,
        );
        $arAdvantage['PICTURE'] = $arPicture;
    }
    if (strlen($ar['SUB_VALUES']['ADVANTAGES_HEADER']['VALUE']) > 0) {
        $arAdvantage['HEADER'] = $ar['SUB_VALUES']['ADVANTAGES_HEADER']['VALUE'];
    }
    if (strlen($ar['SUB_VALUES']['ADVANTAGES_TEXT']['VALUE']['TEXT']) > 0) {
        $arAdvantage['TEXT'] = $ar['SUB_VALUES']['ADVANTAGES_TEXT']['VALUE']['TEXT'];
    }
    if (strlen($arAdvantage['TEXT'])) {
        $arResult['arAdvantages'][] = $arAdvantage;
    }
}
// <-- Особенности продукта

// Разметка OG -->
//vardump($arResult['PICTURES_GALLERY']);
$arResultFunc = CMarkingOG::getGlobalData(array(
    "ELEMENT_ID" => $arResult['ID'],
    "DESCRIPTION" => $arResult['~DETAIL_TEXT'],
    "TEXT_MAX_LEN" => 256,
    "PICTURE" => $arResult['PICTURES'][0]['SRC'],
));
$arResult['OG_DESCRIPTION'] = $arResultFunc['OG_DESCRIPTION'];
$arResult['OG_IMAGE'] = $arResultFunc['OG_IMAGE'];
// <-- Разметка OG

$this->__component->SetResultCacheKeys(array("NAME", "DETAIL_PICTURE", "DETAIL_TEXT", "~DETAIL_TEXT", "DISPLAY_PROPERTIES", "OG_DESCRIPTION", "OG_IMAGE"));
