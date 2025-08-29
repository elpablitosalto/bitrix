<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

foreach($arResult['SECTIONS'] as &$arSection){
    if (is_array($arSection["DETAIL_PICTURE"])) {
        $arFile = $arSection["DETAIL_PICTURE"];
    } else {
        $arFile = CFile::GetFileArray($arSection["DETAIL_PICTURE"]);
    }
    $arResultLocal = getImageFormatted(array(
        'RESIZE' => 'Y',
        'FILE_VALUE' => $arFile,
        'WIDTH' => 999999,
        'HEIGHT' => 360,
        'DEFAULT_ALT_TITLE' => $arSection['NAME']
    ));
    $arSection['DETAIL_PICTURE_SLIDER'] = $arResultLocal['PICTURE'];
}