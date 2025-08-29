<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(!empty($arResult['PROPERTIES']['VIDEO']['VALUE'])) {
    $videos = '<div class="videos-container">';
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
        $pic = CFile::ResizeImageGet($arProps['VIDEO_PREVIEW']['VALUE'], array('width'=>1200, 'height'=>580), BX_RESIZE_IMAGE_PROPORTIONAL, true);
        $videos .= '
            <a class="videos-container__item" data-youtube href="'.$arProps['VIDEO_LINK']['VALUE'].'">
                <div class="videos-container__item-image" style="background-image:url('.$pic['src'].')"></div>
            </a>';
    }
    $videos .= '</div>';

    $arResult['VIDEO_STRING'] = $videos;
}

if(!empty($arResult['PROPERTIES']['INSTRUCTION']['VALUE'])) {
    $fileArr = CIBlockElement::GetProperty(MATERIALS, $arResult['PROPERTIES']['INSTRUCTION']['VALUE'], false, Array("CODE"=>"FILE"))->GetNext();
    $arResult['MATERIALS'] = CFile::GetPath($fileArr['VALUE']);
}

/*if(!empty($arResult['PROPERTIES']['LEARNING_COURSES']['VALUE'])) {
    $obj = CIBlockElement::GetList(false,['IBLOCK_ID' => EVENTS,'ID' => $arResult['PROPERTIES']['LEARNING_COURSES']['VALUE']],false,false)
}*/