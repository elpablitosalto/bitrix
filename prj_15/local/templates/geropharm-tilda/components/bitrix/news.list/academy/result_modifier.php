<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arFilter = array('IBLOCK_ID' => $arParams['IBLOCK_ID'], '=CODE' => $arParams["PARENT_SECTION_CODE"]);
$rsSections = CIBlockSection::GetList(array('ID' => 'ASC'), $arFilter, false, ["NAME","DESCRIPTION","UF_REFRESH_IMAGES"]);
$arResult["SECTION"] = $rsSections->Fetch();

