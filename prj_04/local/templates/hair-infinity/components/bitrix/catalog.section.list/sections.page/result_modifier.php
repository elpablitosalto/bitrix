<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach($arResult['SECTIONS'] as &$arSection):
    $arFilter = array(
        'IBLOCK_ID' => $arSection['IBLOCK_ID'],
        'ACTIVE' => "Y",
        '>LEFT_MARGIN' => $arSection['LEFT_MARGIN'],
        '<RIGHT_MARGIN' => $arSection['RIGHT_MARGIN'],
        '>DEPTH_LEVEL' => $arSection['DEPTH_LEVEL'],
        '<=DEPTH_LEVEL' => 2
    ); // выберет потомков без учета активности
    $rsSect = CIBlockSection::GetList(array('left_margin' => 'asc'),$arFilter);
    while ($arSect = $rsSect->GetNext()) {
        $arSection['ITEMS'][] = $arSect;
    }
endforeach;