<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arResult['ALL_ELEMENTS_COUNT'] = 0;
foreach ($arResult["SECTIONS"] as $section) {
    //vardump($section);
    $arResult['ALL_ELEMENTS_COUNT'] += $section["ELEMENT_CNT"];
}

//vardump($arResult["SECTIONS"]);

foreach ($arResult["SECTIONS"] as &$section) {
    //vardump($section);
    if (!is_array($section["PICTURE"])) {
        $arFile = CFile::GetFileArray($section["PICTURE"]);
    } else {
        $arFile = $section["PICTURE"];
    }
    $arResultLocal = Indexis::getImageFormatted(array(
        'RESIZE' => 'N',
        'FILE_VALUE' => $arFile,
        'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/reviewer-thumb.png',
        //'WIDTH' => 205,
        //'HEIGHT' => 116,
        'DEFAULT_ALT_TITLE' => $section['NAME']
    ));
    $section['PICTURE'] = $arResultLocal['PICTURE'];
}
