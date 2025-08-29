<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use \Bitrix\Main\Loader; 

use Hair\General;
use Hair\Geo;

Loader::includeModule("iblock");
$geo = new Geo();


function baloonContent($arFields,$arProps) {
    if(!empty($arProps['PHOTOS']['VALUE']))
        $salonImg = CFile::ResizeImageGet($arProps['PHOTOS']['VALUE'][0], array('width'=>464, 'height'=>110), BX_RESIZE_IMAGE_PROPORTIONAL, true);
    else
        $salonImg = CFile::ResizeImageGet($arFields['PREVIEW_PICTURE'], array('width'=>464, 'height'=>110), BX_RESIZE_IMAGE_PROPORTIONAL, true);
        
    $salonLogo = CFile::ResizeImageGet($arProps['LOGO']['VALUE'], array('width'=>9999, 'height'=>30), BX_RESIZE_IMAGE_PROPORTIONAL, true);

    $socials = '';
    $socialsVocabulary = General::getSocials();
    foreach($arProps['SOCIALS']['VALUE'] as $k => $val):
        $code = General::getSocialCode($val);
        $socialIcon = CFile::GetPath($socialsVocabulary[$code]['UF_ICON']);
        $socials .= '<a href="'.$val.'" class="salon-map-popup__socials-item"><img src="'.$socialIcon.'" alt=""></a>';
    endforeach;
    $coords = explode(',',$arProps['COORDS']['VALUE']);
    $site = explode('/',$arProps['SITE']['VALUE']);
    $site = ($site[0] == 'https' || $site[0] == 'http') ? $arProps['SITE']['VALUE'] : 'https://'.$arProps['SITE']['VALUE'];
    $visibleSite = str_replace('https://', '', $site);
    $visibleSite = str_replace('http://', '', $visibleSite);
    return '
        <div class="salon-map-popup">
            '.($salonImg['src'] ? '<div class="salon-map-popup__photo"><img src="'.$salonImg['src'].'"></div>' : '').'
            <div class="salon-map-popup__logo-title">
                <img src="'.$salonLogo['src'].'">
                <p>'.$arFields['NAME'].'</p>
            </div>
            <p class="location-link">'.$arProps['ADDRESS']['VALUE'].'</p>
            '.(!empty($arProps['PHONE']['VALUE']) ? '<div class="phone-block">
                <p>Показать телефон</p>
                <a href="tel:'.General::formatPhone($arProps['PHONE']['VALUE']).'">'.$arProps['PHONE']['VALUE'].'</a>
            </div>' : '').'
            <div class="salon-map-popup__footer">
                <div class="salon-map-popup__footer-left">
                    <a href="'.$site.'" target="_blank">'.$visibleSite.'</a>
                    <div class="salon-map-popup__socials">'.$socials.'</div>
                </div>
                <div class="salon-map-popup__footer-right">
                    <a href="/find-salon/salon/'.$arFields['ID'].'/">Посмотреть изображения салона</a>
                    <a target="_blank" href="https://yandex.ru/maps/?ll='.$coords[1].','.$coords[0].'&rtext=~'.$arProps['COORDS']['VALUE'].'&z=13">Проложить маршрут</a>
                    </div>
                </div>
            </div>
        </div>
    ';
}

$arFilter = [
    'IBLOCK_ID' => SALONS,
    'ACTIVE' => 'Y',
    'DEPTH_LEVEL' => 2,
    'CODE' => $_REQUEST['city']
];
$obj = CIBlockSection::GetList(false,$arFilter,false,['ID','CODE','UF_COORDS']);
if($sec = $obj->GetNext()):
    $sectionID = $sec['ID'];
    $filter = [
        'IBLOCK_ID' => SALONS,
        'ACTIVE' => 'Y',
        'IBLOCK_SECTION_ID' => $sectionID,
        '!PROPERTY_COORDS' => false,
    ];
    $ob = CIBlockElement::GetList(false,$filter);

    $socialsVocabulary = General::getSocials();
    $centerCoords = explode(',',$sec['UF_COORDS']);
    $arResult = [
        "totalCnt" => 0,
        "type" =>  "FeatureCollection",
        "center" =>  [$centerCoords[0],$centerCoords[1]],
    ];
    $i=0;
    while($res = $ob->GetNextElement()) {
        $arFields = $res->GetFields();
        $arProps = $res->GetProperties();
        $coords = explode(',',$arProps['COORDS']['VALUE']);
        if($coords[0] && $coords[1])
        {
            $arResult['totalCnt'] += 1;
            $baloon = baloonContent($arFields,$arProps);
            $arResult["features"][] = [
                "type" =>  "Feature",
                "id" => $arFields['ID'],
                "geometry" =>  [
                    "type" =>  "Point",
                    "coordinates" =>  [$coords[0],$coords[1]]
                ],
                "properties" =>  [
                    "balloonContent" =>  $baloon,
                ],
                'options' =>  [
                    'city' =>  $sec['CODE'],
                    'type' => $arProps['SALON_TYPE']['VALUE_XML_ID']
                ]
            ];
        }
    }

    echo json_encode($arResult);
endif;