<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach($arResult['SECTIONS'] as &$arSection):
    $arFilter = array('IBLOCK_ID' => $arSection['IBLOCK_ID'],'>LEFT_MARGIN' => $arSection['LEFT_MARGIN'],'<RIGHT_MARGIN' => $arSection['RIGHT_MARGIN'],'>DEPTH_LEVEL' => $arSection['DEPTH_LEVEL']); // выберет потомков без учета активности
    $rsSect = CIBlockSection::GetList(array('left_margin' => 'asc'),$arFilter);
    while ($arSect = $rsSect->GetNext()) {
        $arSection['ITEMS'][] = $arSect;
    }
endforeach;


foreach($arResult['SECTIONS'] as &$arSection){
    if (is_array($arSection["PICTURE"])) {
        $arFile = $arSection["PICTURE"];
    } else {
        $arFile = CFile::GetFileArray($arSection["PICTURE"]);
    }
    $arResultLocal = getImageFormatted(array(
        'RESIZE' => 'Y',
        'FILE_VALUE' => $arFile,
        'WIDTH' => 708,
        'HEIGHT' => 402,
        'DEFAULT_ALT_TITLE' => $arSection['NAME']
    ));
    $arSection['PICTURE_TILE'] = $arResultLocal['PICTURE'];
}