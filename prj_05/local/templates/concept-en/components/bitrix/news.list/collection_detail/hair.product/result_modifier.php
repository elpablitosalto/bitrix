<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
CModule::IncludeModule('highloadblock');

function marketplaceMatchesSort($a, $b) {
    return $b['LENGTH'] - $a['LENGTH'];
}

// Получение нужных данных из highload блока Color
$colorHLid = 6;
$colorHLdata = Bitrix\Highloadblock\HighloadBlockTable::getById($colorHLid)->fetch();
$colorHLentity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($colorHLdata);
$colorHLDataClass = $colorHLdata['NAME'].'Table';
$colorHLresult = $colorHLDataClass::getList(array(
    'select' => array('ID', 'UF_NAME', 'UF_XML_ID', 'UF_COLOR_CODE'),
    'order' => array('UF_NAME' =>'ASC'),
));
$colorData = array();

while($res = $colorHLresult->fetch()) {
    $colorData[$res['ID']] = array(
        'ID' => $res['ID'],
        'VALUE' => $res['UF_NAME'],
        'CODE' => $res['UF_COLOR_CODE']
    );
}

$arFilter = [
    'IBLOCK_ID' => CATALOG_SKU,
    'PROPERTY_PARENT_PRODUCT' => $arResult['ID'],
    'ACTIVE' => 'Y'
];
$obj = CIBlockElement::GetList(Array("SORT"=>"ASC"),$arFilter,false,false); //44272 false -> Array("SORT"=>"ASC") сортировка объемов в карточке 
$arResult['SKU_PROPS'] = [];
while($res = $obj->GetNextElement()) {
    $arFields = $res->GetFields();
    $arProps = $res->GetProperties();
    foreach($arProps as $prop):
        if($prop['CODE'] == 'VOLUME' || $prop['CODE'] == 'COLOR' || $prop['CODE'] == 'LINK' || $prop['CODE'] == 'MARKETPLACE_OZON' || $prop['CODE'] == 'MARKETPLACE_GOLDAPPLE') {
            $arDisplayProp = CIBlockFormatProperties::GetDisplayValue($arFields,$prop);
            if($arDisplayProp['VALUE']) {
                $arResult['SKU_PROPS'][$arDisplayProp['CODE']][$arDisplayProp['VALUE']] = $arDisplayProp['DISPLAY_VALUE'];
            }
        }
    endforeach;
}

$obj = CIBlockElement::GetList(false,$arFilter,false,false);
while($res = $obj->GetNextElement()) {
    $current_res = $res->GetProperties();
    $arResult['SKU_PROPS']['SELECT_VALUE']['COLOR_'.$current_res['COLOR']['VALUE'].'_VOLUME_'.$current_res['VOLUME']['VALUE']] = array(
        'LINK_WILDBERRIES' => !empty($current_res['LINK']['VALUE']) ? $current_res['LINK']['VALUE'] : '',
        'LINK_OZON' => !empty($current_res['MARKETPLACE_OZON']['VALUE']) ? $current_res['MARKETPLACE_OZON']['VALUE'] : '',
        'LINK_GOLDAPPLE' => !empty($current_res['MARKETPLACE_GOLDAPPLE']['VALUE']) ? $current_res['MARKETPLACE_GOLDAPPLE']['VALUE'] : ''
    );
}

// Получение цвета секции
$arFilter = [
    'IBLOCK_ID' => 2,
    'ID' => $arResult['IBLOCK_SECTION_ID'],
    'ACTIVE' => 'Y'
];
$obj = CIBlockSection::GetList(false,$arFilter,false,['UF_COLOR']);
while($res = $obj->GetNext()) {
    if (!empty($colorData[$res['UF_COLOR']])) {
        $arResult['SECTION_COLOR'] = $colorData[$res['UF_COLOR']];
    }
}

//foreach($arResult['SKU_PROPS'] as $item){
//    foreach($item['VOLUME'] as $item_v){
//        $arResult['SKU_PROPS']['SELECT_VALUE'][] = 'VOLUME_'.$item_v.'_COLOR_'.$item
//    }
//}
if(!empty($arResult['PROPERTIES']['VIDEO_MATERIALS']['VALUE'])):
    $arFilter = [
        'IBLOCK_ID' => VIDEO,
        'ACTIVE' => 'Y',
        'ID' => $arResult['PROPERTIES']['VIDEO_MATERIALS']['VALUE']
    ];
    $arResult['VIDEO_MATERIALS'] = [];
    $obj = CIBlockElement::GetList(false,$arFilter,false,false);
    while($res = $obj->GetNextElement()){
        $arFields = $res->GetFields();
        $arProps = $res->GetProperties();
        $arResult['VIDEO_MATERIALS'][$arFields['ID']]['PREVIEW_PICTURE'] = CFile::ResizeImageGet($arProps['VIDEO_PREVIEW']['VALUE'], array('width'=>380, 'height'=>238), BX_RESIZE_IMAGE_PROPORTIONAL, true);
        $arResult['VIDEO_MATERIALS'][$arFields['ID']]['LINK'] = $arProps['VIDEO_LINK']['VALUE'];
        $arResult['VIDEO_MATERIALS'][$arFields['ID']]['NAME'] = $arFields['NAME'];

    }
endif;

if (
        !empty($arResult['SKU_PROPS'])
        || !empty($arResult['PROPERTIES']['COMMON_LINK']['VALUE'])
        // || !empty($arResult['PROPERTIES']['MARKETPLACE_WILDBERRIES']['VALUE'])
        || !empty($arResult['PROPERTIES']['MARKETPLACE_OZON']['VALUE'])
        || !empty($arResult['PROPERTIES']['MARKETPLACE_GOLDAPPLE']['VALUE'])
        // || !empty($arResult['PROPERTIES']['MARKETPLACES']['VALUE'])
    ) {
    $marketplaces = CIBlockElement::GetList(
        array(),
        array(
            "IBLOCK_ID" => 43,
            "ACTIVE" => "Y",
        ),
        false,
        array()
    );
    $marketplaceArray = [];
    $arResult['MARKETPLACE_LINKS'] = [];

    while($marketplace = $marketplaces->GetNextElement()) {
        $marketplaceFields = $marketplace->GetFields();
        $marketplaceProperties = $marketplace->GetProperties();
        $marketplaceArray[$marketplaceFields["CODE"]] = array(
            "ID" => $marketplaceFields["ID"],
            "NAME" => $marketplaceFields["NAME"],
            "CODE" => $marketplaceFields["CODE"],
            "LOGO" => CFile::ResizeImageGet($marketplaceFields["DETAIL_PICTURE"], array('width'=>126, 'height'=>70), BX_RESIZE_IMAGE_PROPORTIONAL, true),
            "URL" => $marketplaceProperties["URL"]["VALUE"],
            "URL_MATCH" => $marketplaceProperties["URL_MATCH"]["VALUE"],
        );
    }

    // Code for a single field with multiple inputs
    // $links = !empty($arResult['PROPERTIES']['MARKETPLACES']['VALUE']) ? $arResult['PROPERTIES']['MARKETPLACES']['VALUE'] : [];
    // if (!empty($arResult['PROPERTIES']['COMMON_LINK']['VALUE'])) {
    //     $links[] = $arResult['PROPERTIES']['COMMON_LINK']['VALUE'];
    // }

    // foreach($links as $link) {
    //     $matches = [];

    //     foreach($marketplaceArray as $marketplace) {
    //         if (strpos($link, $marketplace["URL_MATCH"]) !== false) {
    //             $matches[] = array(
    //                 'LENGTH' => strlen($marketplace["URL_MATCH"]),
    //                 'TARGET' => $marketplace
    //             );
    //         }
    //     }

    //     uasort($matches, 'marketplaceMatchesSort');

    //     $finalMatch = !empty($matches[0]) ? $matches[0]['TARGET'] : array(
    //         "NAME" => "",
    //         "LOGO" => array(
    //             "src" => ""
    //         )
    //     );

    //     $arResult['MARKETPLACE_LINKS'][] = array(
    //         "URL" => $link,
    //         "NAME" => $finalMatch['NAME'],
    //         "IMAGE_URL" => $finalMatch['LOGO']['src'],
    //     );
    // }

    // Code for multiple specific fields with single input
    function addMarketplaceLink($link, $marketplace) {
        return array(
            "URL" => $link,
            "NAME" => $marketplace['NAME'],
            "CODE" => $marketplace['CODE'],
            "IMAGE_URL" => $marketplace['LOGO']['src']
        );
    }

    // if links are provided in SKU, those links are used
    // if SKU has no link for a specific marketplace, the url provided here is used
    // if url provided ends up being a #, then the link is hidden
    $arResult['MARKETPLACE_LINKS'][] = addMarketplaceLink(($arResult['PROPERTIES']['COMMON_LINK']['VALUE'] ?: '#'), $marketplaceArray["wildberries"]);
    $arResult['MARKETPLACE_LINKS'][] = addMarketplaceLink(($arResult['PROPERTIES']['MARKETPLACE_OZON']['VALUE'] ?: '#'), $marketplaceArray["ozon"]);
    $arResult['MARKETPLACE_LINKS'][] = addMarketplaceLink(($arResult['PROPERTIES']['MARKETPLACE_GOLDAPPLE']['VALUE'] ?: '#'), $marketplaceArray["gold-apple"]);
}