<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$newStructureArray = [];
foreach ($arResult['SECTIONS'] as $arSection){

    $arResultLocal = Indexis::getImageFormatted(array(
        'RESIZE' => 'N',
        'FILE_VALUE' => $arSection['PICTURE'],
        'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/line-empty.png',
        //'WIDTH' => 205,
        //'HEIGHT' => 116,
        'DEFAULT_ALT_TITLE' => $arSection['NAME']
    ));
    $arSection['PICTURE'] = $arResultLocal['PICTURE'];

    if($arSection["DEPTH_LEVEL"] > 1){
        $newStructureArray["CHILDRENS"][$arSection["IBLOCK_SECTION_ID"]][] = $arSection;
    } else $newStructureArray["PARENTS"][] = $arSection;
}
$arResult['SECTIONS'] = $newStructureArray;
