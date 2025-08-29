<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(strpos($arResult['DETAIL_TEXT'],'#VIDEO#') !== false) {
    $videos = '<div class="videos-container _flex-start">';
    $arFilter = [
        'IBLOCK_ID' => VIDEO,
        'ACTIVE' => 'Y',
        'ID' => $arResult['PROPERTIES']['VIDEO']['VALUE']
    ];
    $arResult['VIDEO_MATERIALS'] = [];
    $obj = CIBlockElement::GetList(false,$arFilter,false,false);
    while($res = $obj->GetNextElement()){
        $arFields = $res->GetFields();
        $arProps = $res->GetProperties();
        $pic = CFile::ResizeImageGet($arProps['VIDEO_PREVIEW']['VALUE'], array('width'=>380, 'height'=>238), BX_RESIZE_IMAGE_PROPORTIONAL, true);
        $videos .= '
            <a class="videos-container__item" data-youtube href="'.$arProps['VIDEO_LINK']['VALUE'].'">
                <div class="videos-container__illustration">
                    <img src="'.$pic['src'].'" alt role="presentation" class="videos-container__image">
                </div>
            </a>';
    }
    $videos .= '</div>';

    $arResult['DETAIL_TEXT'] = str_replace('#VIDEO#',$videos,$arResult['DETAIL_TEXT']);
    $arResult['~DETAIL_TEXT'] = str_replace('#VIDEO#',$videos,$arResult['~DETAIL_TEXT']);
}

if(!empty($arResult['PROPERTIES']['INSTRUCTION']['VALUE'])) {
    $fileArr = CIBlockElement::GetProperty(MATERIALS, $arResult['PROPERTIES']['INSTRUCTION']['VALUE'], false, Array("CODE"=>"FILE"))->GetNext();
    $arResult['MATERIALS'] = CFile::GetPath($fileArr['VALUE']);
}

/*if(!empty($arResult['PROPERTIES']['LEARNING_COURSES']['VALUE'])) {
    $obj = CIBlockElement::GetList(false,['IBLOCK_ID' => EVENTS,'ID' => $arResult['PROPERTIES']['LEARNING_COURSES']['VALUE']],false,false)
}*/