<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arResult['SORTED_ITEMS'] = [];
foreach($arResult['ITEMS'] as $arItem):
    $sectionsObj = CIBlockSection::GetNavChain(CATALOG,$arItem['IBLOCK_SECTION_ID'],['ID','CODE','NAME']);
    while($sectionsArr = $sectionsObj->GetNext()){
        if($sectionsArr['IBLOCK_SECTION_ID'] > 0):
            $parentSectionID = $sectionsArr['ID'];
            $parentSectionName = $sectionsArr['NAME'];
        else:
            $topLevelID = $sectionsArr['ID'];
            $topLevelName = $sectionsArr['NAME'];
        endif;
    }
    $arResult['SORTED_ITEMS'][$topLevelID]['NAME'] = $topLevelName;
    $arResult['SORTED_ITEMS'][$topLevelID]['SECTIONS'][$parentSectionID]['NAME'] = $parentSectionName;
    $arResult['SORTED_ITEMS'][$topLevelID]['SECTIONS'][$parentSectionID]['ITEMS'][] = $arItem;

endforeach;
?>