<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$parentSectionId = [];
foreach ($arResult['SECTIONS'] as &$arSection){

    $arResultLocal = Indexis::getImageFormatted(array(
        'RESIZE' => 'N',
        'FILE_VALUE' => $arSection['PICTURE'],
        'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/line-empty.png',
        //'WIDTH' => 205,
        //'HEIGHT' => 116,
        'DEFAULT_ALT_TITLE' => $arSection['NAME']
    ));
    $arSection['PICTURE'] = $arResultLocal['PICTURE'];
    if($arSection["IBLOCK_SECTION_ID"] > 0 && !in_array($arSection["IBLOCK_SECTION_ID"], $parentSectionId))
        $parentSectionId[] = $arSection["IBLOCK_SECTION_ID"];

    $arFilter = array('IBLOCK_ID' => $arParams["IBLOCK_ID"], 'ID' => $parentSectionId);
    $rsSections = CIBlockSection::GetList(array('LEFT_MARGIN' => 'ASC'), $arFilter);
    while ($arSction = $rsSections->Fetch())
    {
        $arResult["PARENTS"][$arSction["ID"]] = $arSction;
    }
}

