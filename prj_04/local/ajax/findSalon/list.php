<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use \Bitrix\Main\Loader; 

use Hair\General;

Loader::includeModule("iblock");

$arFilter = [
    'IBLOCK_ID' => SALONS,
    'ACTIVE' => 'Y',
    'CODE' => $_REQUEST['city']
];
$obj = CIBlockSection::GetList(false,$arFilter,false,['ID','CODE']);
$arResult = [];
if($sec = $obj->GetNext()):
    $sectionID = $sec['ID'];
    $filter = [
        'IBLOCK_ID' => SALONS,
        'ACTIVE' => 'Y',
        'DEPTH_LEVEL' => 2,
        'IBLOCK_SECTION_ID' => $sectionID
    ];
    $ob = CIBlockElement::GetList(false,$filter);

    $socialsVocabulary = General::getSocials();
    $arResult['STATUS'] = 'Y';
    $arResult['CNT'] = $ob->SelectedRowsCount();
    $arResult['HTML'] = '';
    $i=0;
    $types = [
        'salon' => 0,
        'store' => 0
    ];
    while($res = $ob->GetNextElement()) {
        $arFields = $res->GetFields();
        $arProps = $res->GetProperties();
        $file = $_SERVER["DOCUMENT_ROOT"].'/salontest.txt';
        if($arProps['SALON_TYPE']['VALUE_XML_ID']){
            $types[$arProps['SALON_TYPE']['VALUE_XML_ID']]++;
        }
        if(!empty($arProps['PHOTOS']['VALUE']))
            $salonImg = CFile::ResizeImageGet($arProps['PHOTOS']['VALUE'][0], array('width'=>416, 'height'=>100), BX_RESIZE_IMAGE_PROPORTIONAL, true);
        else
            $salonImg = CFile::ResizeImageGet($arFields['PREVIEW_PICTURE'], array('width'=>416, 'height'=>100), BX_RESIZE_IMAGE_PROPORTIONAL, true);
        $salonLogo = CFile::ResizeImageGet($arProps['LOGO']['VALUE'], array('width'=>9999, 'height'=>26), BX_RESIZE_IMAGE_PROPORTIONAL, true);

        $socials = '';
        foreach($arProps['SOCIALS']['VALUE'] as $k => $val):
            $code = General::getSocialCode($val);
            $socialIcon = CFile::GetPath($socialsVocabulary[$code]['UF_ICON']);
            $socials .= '<a href="'.$val.'" class="salon-map-popup__socials-item"><img src="'.$socialIcon.'" alt=""></a>';
        endforeach;
        $coords = explode(',',$arProps['COORDS']['VALUE']);
        $sSite = "";
        if(!empty($arProps['SITE']['VALUE'])){
            $arSite = explode('/', $arProps['SITE']['VALUE']);
            $sSite = ($arSite[0] == 'https' || $arSite[0] == 'http') ? $arProps['SITE']['VALUE'] : 'https://'.$arProps['SITE']['VALUE'];
        }
        $arResult['HTML'] .= '
            <div class="placemarks-list__item" data-type="'.$arProps['SALON_TYPE']['VALUE_XML_ID'].'">
                <div class="placemarks-list__item-photo">
                    <img src="'.$salonImg['src'].'" alt="'.$salonImg['ALT'].'" title="'.$salonImg['TITLE'].'" />
                </div>
                <div class="placemarks-list__item-content">
                    <div class="placemarks-list__item-row placemarks-list__item-row--title">
                        <img src="'.$salonLogo['src'].'">
                        <p>'.$arFields['NAME'].'</p>
                    </div>
                    <div class="placemarks-list__item-row">
                        <a href="#" class="location-link">'.$arProps['ADDRESS']['VALUE'].'</a>
                        <a href="https://yandex.ru/maps/?ll='.$coords[1].','.$coords[0].'&rtext=~'.$arProps['COORDS']['VALUE'].'&z=13" target="_blank" class="show-desktop get-route">Проложить маршрут</a>
                    </div>
                    '.(!empty($arProps['PHONE']['VALUE']) ? '<div class="placemarks-list__item-row">
                        <div class="phone-block"><p>Показать телефон</p><a href="tel:'.General::formatPhone($arProps['PHONE']['VALUE']).'">'.$arProps['PHONE']['VALUE'].'</a></div>
                    </div>' : "").'
                    <div class="placemarks-list__item-content--footer">
                        <div class="placemarks-list__item-row placemarks-list__item-row--contacts">
                            '.(!empty($sSite) ?'<a href="'.$sSite.'" class="_blue" target="_blank">'.$sSite.'</a>' : '').'
                            <div class="placemarks-list__item-socials">'.$socials.'</div>
                        </div>
                        <div class="placemarks-list__item-row placemarks-list__item-row--action-links">
                            <a href="/find-salon/salon/'.$arFields['ID'].'/">Посмотреть изображения салона</a>
                            <a href="https://yandex.ru/maps/?ll='.$coords[1].','.$coords[0].'&rtext=~'.$arProps['COORDS']['VALUE'].'&z=13" target="_blank" class="show-mobile get-route">Проложить маршрут</a>
                        </div>
                    </div>
                </div>
            </div>
        ';
    }
    $arResult['TYPES'] = $types;
endif;

echo json_encode($arResult);