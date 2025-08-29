<?
foreach($arResult['SEARCH'] as $arItem):
    if(!isset($arResult['SEARCH_RESULT'][$arItem['PARAM2']]['NAME'])):
        $iblockID = $arItem['PARAM2'];
        $arResult['SEARCH_RESULT'][$iblockID]['NAME'] = CIBlock::GetByID($iblockID)->GetNext()['NAME'];
    endif;
    $arResult['SEARCH_RESULT'][$iblockID]['ITEMS'][] = $arItem['ITEM_ID'];
endforeach;