<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->__component->SetResultCacheKeys(array("NAME", "DETAIL_PICTURE", "DETAIL_TEXT", "~DETAIL_TEXT", "DISPLAY_PROPERTIES"));


// Изображения для слайдера -->
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
        );
        $arResult['PICTURES'][] = $arPicture;
    }
}
// <-- Изображения для слайдера 

// Изображения для галереи -->
if (intval($arResult['ID']) > 0) {
    $arResult['GALLERY_PICTURES'] = [];
    $width = 500;
    $height = 500;
    //vardump($arResult['DISPLAY_PROPERTIES']['GALLERY_IMAGES']);
    $arFiles = $arResult['DISPLAY_PROPERTIES']['GALLERY_IMAGES']['FILE_VALUE'];
    foreach ($arFiles as $key => $arFile) {
        $arFileResize = CFile::ResizeImageGet(
            $arFile["ID"],
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

        $arResult['GALLERY_PICTURES'][] = $arPicture;
    }
}
//vardump($arResult['GALLERY_PICTURES']);
// <-- Изображения для галереи

// Большие изображения в теле страницы -->
for ($i = 1; $i <= 4; $i++) {
    $arFile = $arResult['DISPLAY_PROPERTIES']['IMAGE_' . $i]['FILE_VALUE'];
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
    $arResult['IMAGE_' . $i] = $arPicture;
}
// <--

// Особенности продукта -->
$arResult['arFeatures'] = array();
foreach ($arResult['PROPERTIES']['FEATURES']['VALUE'] as $key => $ar) {
    $arFeature = array();
    if (intval($ar['SUB_VALUES']['FEATURES_ICON']['VALUE']) > 0) {
        //vardump($ar['SUB_VALUES']['FEATURES_ICON']);
        $arFile = CFile::GetFileArray($ar['SUB_VALUES']['FEATURES_ICON']['VALUE']);
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
        $arFeature['PICTURE'] = $arPicture;
    }
    if (strlen($ar['SUB_VALUES']['FEATURES_TEXT']['VALUE']['TEXT']) > 0) {
        $arFeature['TEXT'] = $ar['SUB_VALUES']['FEATURES_TEXT']['VALUE']['TEXT'];
    }
    if (strlen($arFeature['TEXT'])) {
        $arResult['arFeatures'][] = $arFeature;
    }
}
// <-- Особенности продукта

//vardump($arResult['DISPLAY_PROPERTIES']['FEATURES']);
//vardump($arResult['PROPERTIES']['FEATURES']);
