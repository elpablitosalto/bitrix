<?

foreach ($arResult as $key => &$arItem) {

    $arFile = CFile::GetFileArray($arItem["PARAMS"]['UF_ICON']);

    $arResultLocal = Indexis::getImageFormatted(array(
        'RESIZE' => 'N',
        'FILE_VALUE' => $arFile,
        //'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/reviewer-thumb.png',
        //'WIDTH' => 205,
        //'HEIGHT' => 116,
        'DEFAULT_ALT_TITLE' => $arItem['TEXT']
    ));
    $arItem['PICTURE'] = $arResultLocal['PICTURE'];
}    

/*
$previousLevel = 0;
$curFirstLevel = 0;
//vardump($arResult);
foreach ($arResult as $key => $arItem) {
    $previousLevel = 0;
    if ($arItem["DEPTH_LEVEL"] == 1) {
        $curFirstLevel = $key;
    }
    if ($arItem["DEPTH_LEVEL"] == 2 && $arItem["IS_PARENT"] && $curFirstLevel > 0) {
        $arResult[$curFirstLevel]['NUM_COLS'] = 2;
        $curFirstLevel = 0;
    }
}
*/
