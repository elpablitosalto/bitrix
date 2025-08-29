<?
    if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
    $arFilter = [
        'IBLOCK_ID' => CATALOG
    ];
    $arSelect = ['ID','IBOCK_ID','NAME','CODE','SECTION_PAGE_URL','DEPTH_LEVEL','IBLOCK_SECTION_ID'];
    $obj = CIBlockSection::GetList(false,$arFilter,false,$arSelect);
    $aMenuLinksExt = [];
    while($res = $obj->GetNext()) {
        $arParams = [];
        if(!empty($res['IBLOCK_SECTION_ID']))
            $arParams['PARENT_SECTION_ID'] = $res['IBLOCK_SECTION_ID'];
            
        $aMenuLinksExt[] = array(
            $res['NAME'],
            $res['SECTION_PAGE_URL'],
            array(), //массив доп ссылок
            $arParams
        );
    }

    $aMenuLinks = array_merge($aMenuLinksExt, $aMenuLinks);
?>