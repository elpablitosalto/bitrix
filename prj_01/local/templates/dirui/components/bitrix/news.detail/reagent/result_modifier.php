<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<?
// Свойства для вывода -->
$arResult['arDsiplayProperties'] = array();
foreach ($arResult['DISPLAY_PROPERTIES'] as $code => $arProp) {
    if (is_string($arProp['DISPLAY_VALUE'])) {
        if (strlen($arProp['DISPLAY_VALUE']) > 0) {
            $arResult['arDsiplayProperties'][$code] = $arProp;
        }
    }
}
// <-- Свойства для вывода

// Изображение -->
if (is_array($arResult["PREVIEW_PICTURE"])) {
    $arFile = $arResult["PREVIEW_PICTURE"];
} else {
    $arFile = CFile::GetFileArray($arResult["PREVIEW_PICTURE"]);
}
$arResultLocal = Indexis::getImageFormatted(array(
    'RESIZE' => 'N',
    'FILE_VALUE' => $arFile,
    'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/reviewer-thumb.png',
    //'WIDTH' => 205,
    //'HEIGHT' => 116,
    'DEFAULT_ALT_TITLE' => $arResult['NAME']
));
$arResult['PICTURE'] = $arResultLocal['PICTURE'];
// <-- Изображение

// Документация -->
if (!empty($arResult)) {
    $arResult['arDocs'] = [];
    $arFiles = $arResult['PROPERTIES']['DOCS']['VALUE'];
    foreach ($arFiles as $key => $fileId) {
        $arFile = CFile::GetFileArray($fileId);

        $fileName = $arFile['DESCRIPTION'];
        if (strlen($fileName) <= 0) {
            $fileName = $arFile['ORIGINAL_NAME'];
        }

        $arResult['arDocs'][] = array(
            'SRC' => $arFile['SRC'],
            'NAME' => $fileName,
            'SIZE_FORMAT' => Indexis::formatSizeUnits($arFile['FILE_SIZE']),
            'TYPE_FORMAT' => Indexis::getExtension($arFile['SRC'], false, true),
        );
    }
}
// <-- Документация

// Оборудование -->
if (!empty($arResult['DISPLAY_PROPERTIES']['EQUIPMENT']['VALUE'])) {
    $arResult['arEquipment'] = array();
    $arSelect = array("ID", "NAME", "PREVIEW_PICTURE", "DETAIL_PAGE_URL");
    $arFilter = array(
        //"IBLOCK_ID" => IntVal($yvalue), 
        "ACTIVE_DATE" => "Y",
        "ACTIVE" => "Y",
        'ID' => $arResult['DISPLAY_PROPERTIES']['EQUIPMENT']['VALUE'],
    );
    $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
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
        //$arResult['PICTURE'] = $arResultLocal['PICTURE'];

        $arResult['arEquipment'][$arFields['ID']] = array(
            'ID' => $arFields['ID'],
            'NAME' => $arFields['NAME'],
            'PICTURE' => $arResultLocal['PICTURE'],
            'DETAIL_PAGE_URL' => $arFields['DETAIL_PAGE_URL'],
        );
    }
}
// <-- Оборудование
?>