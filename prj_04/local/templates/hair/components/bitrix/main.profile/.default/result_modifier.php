<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $USER;
if(!$USER->IsAuthorized()) {
    LocalRedirect("auth/");
    die();
}

$arResult['USER_GROUP'] = end($USER->GetUserGroupArray());
if($arResult['USER_GROUP'] == MASTER):
    $arResult['SALON'] = [];
    $obj = CIBlockElement::GetList(false,['IBLOCK_ID' => SALONS,'PROPERTY_SALON_USER' => $arResult['ID']]);
    if($res = $obj->GetNextElement()) {
        $arResult['SALON']['FIELDS'] = $res->GetFields();
        $arResult['SALON']['PROPS'] = $res->GetProperties();
    }
endif;


//Маркетинговые материалы
$arFilter = [
    'IBLOCK_ID' => MARKETING_MATERIALS
];
$obj = CIBlockElement::GetList(false,$arFilter,false,false,['ID','NAME','PROPERTY_FILE','PROPERTY_MATERIAL_FORMAT']);
while($res = $obj->GetNext()) {
    $arResult['MARKETING_MATERIALS'][] = $res;
}

//Собираем скачиваемые материалы
$arResult['DOWNLOADS'] = [];
$arFilesVocabulary = [];
$arFilter = [
    'IBLOCK_ID' => MATERIALS
];
$obj = CIBlockElement::GetList(false,$arFilter,false,false,['ID','NAME','PROPERTY_MATERIAL_TYPE']);

//Создаем словарь материалов
while($res = $obj->GetNext()) {
    $arFilesVocabulary[$res['ID']] = $res['PROPERTY_MATERIAL_TYPE_VALUE'];
}

//Собираем массив для вывода в ЛК
$arFilter = [
    'IBLOCK_ID' => MATERIALS
];
$obj = CIBlockElement::GetList(false,$arFilter);    
while($res = $obj->GetNextElement()) {
    $arFields = $res->GetFields();
    $arProps = $res->GetProperties();

    $prodID = $arProps['PRODUCT']['VALUE'];

    $prodArr = CIBlockElement::GetByID($prodID)->GetNext();
    $sectionsObj = CIBlockSection::GetNavChain(CATALOG,$prodArr['IBLOCK_SECTION_ID'],['ID','CODE','NAME']);
    while($sectionsArr = $sectionsObj->GetNext()){
        if($sectionsArr['IBLOCK_SECTION_ID'] > 0):
            $arResult['DOWNLOADS'][$sectionsArr['IBLOCK_SECTION_ID']]['SECTIONS'][$sectionsArr['ID']]['NAME'] = $sectionsArr['NAME'];
            $arResult['DOWNLOADS'][$sectionsArr['IBLOCK_SECTION_ID']]['SECTIONS'][$sectionsArr['ID']]['PRODUCTS'][$prodArr['ID']]['NAME'] = $prodArr['NAME'];
            $arResult['DOWNLOADS'][$sectionsArr['IBLOCK_SECTION_ID']]['SECTIONS'][$sectionsArr['ID']]['PRODUCTS'][$prodArr['ID']]['FILES'][$arProps['FILE']['VALUE']]['NAME'] = $arProps['MATERIAL_TYPE']['VALUE'];
            $arResult['DOWNLOADS'][$sectionsArr['IBLOCK_SECTION_ID']]['SECTIONS'][$sectionsArr['ID']]['PRODUCTS'][$prodArr['ID']]['FILES'][$arProps['FILE']['VALUE']]['PATH'] = CFile::GetPath($arProps['FILE']['VALUE']);
            $sArrFilter = [
                'IBLOCK_ID' => CATALOG,
                'ID' => $sectionsArr['ID']
            ];
            $sObj=CIBlockSection::GetList(false, $sArrFilter, false, array('ID','UF_MATERIALS')); 
            if($sArr = $sObj->GetNext()){
                foreach($sArr['UF_MATERIALS'] as $file):
                    $arResult['DOWNLOADS'][$sectionsArr['IBLOCK_SECTION_ID']]['SECTIONS'][$sectionsArr['ID']]['FILES'][$file]['NAME'] = $arFilesVocabulary[$file];
                    $arResult['DOWNLOADS'][$sectionsArr['IBLOCK_SECTION_ID']]['SECTIONS'][$sectionsArr['ID']]['FILES'][$file]['PATH'] = CFile::GetPath($file);
                endforeach;
            };
        else:
            $arResult['DOWNLOADS'][$sectionsArr['ID']]['NAME'] = $sectionsArr['NAME'];
        endif;
    }
}
//ID региона
$sectionID = 0;
if(isset($arResult['SALON']['FIELDS']['IBLOCK_SECTION_ID']))
    $sectionID = $arResult['SALON']['FIELDS']['IBLOCK_SECTION_ID'];
else if(!empty($arResult['arUser']['UF_REGION'])){
    $sectionID = $arResult['arUser']['UF_REGION'];
}
else{
    $obj2 = CIBlockSection::GetList(false,['IBLOCK_ID' => SALONS, 'ACTIVE' => 'Y', 'NAME'=>$arResult['arUser']['PERSONAL_CITY']],false,['ID','CODE','NAME','IBLOCK_SECTION_ID']);
    if($res = $obj2->GetNext()) {
        $sectionID = $res['ID'];
    }
}
//Найдем технолога города, а так же технологов региона
$regionID = '';
$citiesID = [];
$region_array = [];
$obj2 = CIBlockSection::GetList(false,['IBLOCK_ID' => SALONS, 'ACTIVE' => 'Y', 'DEPTH_LEVEL' => 2],false,['ID','CODE','NAME','IBLOCK_SECTION_ID']);
while($res = $obj2->GetNext()) {
    $region_array[$res['ID']] = $res['IBLOCK_SECTION_ID'];
}
if(!empty($sectionID) && is_array($sectionID)){
    $sectionID = current($sectionID);
}
$regionID = $region_array[$sectionID];

$arFilter = [
    'IBLOCK_ID' => SALONS,
    'SECTION_ID' => $regionID
];
$obj = CIBlockSection::GetList(false,$arFilter,false,['ID']);
while($res = $obj->GetNext()){
    $citiesID[] = $res['ID'];
}
$citiesID[] = $regionID;

if($arResult['USER_GROUP'] == MASTER):
    $arFilter = [
        'IBLOCK_ID' => OUR_TEAM,
        'PROPERTY_LOCATION' => $citiesID,
        'IBLOCK_SECTION_ID' => OUR_TEAM_TECH
    ];

    $obj = CIBlockElement::GetList(false,$arFilter);
    $arResult['TECH']['ERROR'] = 'N';
    if($obj->SelectedRowsCount())
    {
        while($res = $obj->GetNextElement()){
            $arFields = $res->GetFields();
            $arProps = $res->GetProperties();
            if(in_array($sectionID,$arProps['LOCATION']['VALUE'])){
                $arResult['TECH']['CITY'][$arFields['ID']]['FIELDS'] = $arFields;
                $arResult['TECH']['CITY'][$arFields['ID']]['PROPS'] = $arProps;
            }
            else if(array_diff($citiesID, $arProps['LOCATION']['VALUE']) > 0){
                $resultios = array_diff($citiesID, $arProps['LOCATION']['VALUE']);
                $arResult['TECH']['REGION'][$arFields['ID']]['FIELDS'] = $arFields;
                $arResult['TECH']['REGION'][$arFields['ID']]['PROPS'] = $arProps;
            }
        }
//        p($resultios);
    }

//    $moskowID = 48;
//
//    if(empty($arResult['TECH']['CITY'])){
//        $arFilter = [
//            'IBLOCK_ID' => OUR_TEAM,
//            'PROPERTY_LOCATION' => $moskowID,
//            'IBLOCK_SECTION_ID' => OUR_TEAM_TECH
//        ];
//        $obj = CIBlockElement::GetList(false, $arFilter);
//        if($obj->SelectedRowsCount()){
//            while($res = $obj->GetNextElement()){
//                $arFields = $res->GetFields();
//                $arProps = $res->GetProperties();
//                $arResult['TECH']['CITY'][$arFields['ID']]['FIELDS'] = $arFields;
//                $arResult['TECH']['CITY'][$arFields['ID']]['PROPS'] = $arProps;
//            }
//        }
//    }
//
//    if(empty($arResult['TECH']['REGION'])){
//
//        $moskowRegionID = 47;
//        $moskowRegionCities = [
//            $moskowRegionID
//        ];
//
//        $arFilter = [
//            'IBLOCK_ID' => SALONS,
//            'SECTION_ID' => $moskowRegionID,
//            '!ID' => $moskowID
//        ];
//        $obj = CIBlockSection::GetList(false,$arFilter,false,['ID']);
//        while($res = $obj->GetNext()){
//            $moskowRegionCities[] = $res['ID'];
//        }
//
//        $arFilter = [
//            'IBLOCK_ID' => OUR_TEAM,
//            'PROPERTY_LOCATION' => $moskowRegionCities,
//            'IBLOCK_SECTION_ID' => OUR_TEAM_TECH
//        ];
//        $obj = CIBlockElement::GetList(false, $arFilter);
//        if($obj->SelectedRowsCount()){
//            while($res = $obj->GetNextElement()){
//                $arFields = $res->GetFields();
//                $arProps = $res->GetProperties();
//
//                $arResult['TECH']['REGION'][$arFields['ID']]['FIELDS'] = $arFields;
//                $arResult['TECH']['REGION'][$arFields['ID']]['PROPS'] = $arProps;
//            }
//        }
//    }

    /*$arFilterMoskow = [
        'IBLOCK_ID' => OUR_TEAM,
        'PROPERTY_LOCATION' => [47, 48],
        'IBLOCK_SECTION_ID' => OUR_TEAM_TECH
    ];
    $obj = CIBlockElement::GetList(false,$arFilterMoskow);
    if($obj->SelectedRowsCount())
    {
        while($res = $obj->GetNextElement()){
            $arFields = $res->GetFields();
            $arProps = $res->GetProperties();
            if(array_diff([47, 48], $arProps['LOCATION']['VALUE']) > 0):
                $arResult['TECH']['MOSKOW'][$arFields['ID']]['FIELDS'] = $arFields;
                $arResult['TECH']['MOSKOW'][$arFields['ID']]['PROPS'] = $arProps;
            endif;
        }
    }*/

endif;

//Поиск новостей и событий региона

$arFilter = [
    'IBLOCK_ID' => EVENTS,
    'PROPERTY_LOCATION' => $citiesID,
];
$arSelect = [
    'ID',
    'NAME',
    'DETAIL_PAGE_URL',
    'PREVIEW_PICTURE',
    'DATE_CREATE',
    'ACTIVE_FROM',
    'PREVIEW_TEXT'
];

$eventsIDs = [];
$arResult['EVENTS'] = [];
$obj = CIBlockElement::GetList(['date_create' => 'desc'],$arFilter,false,['nTopCount' => 2],$arSelect);
while($res = $obj->GetNext()) {
    $arResult['EVENTS'][] = $res;
    $eventsIDs[] = $res['ID'];
}

$arFilter = [
    'IBLOCK_ID' => [EVENTS,NEWS],
    '!ID' => $eventsIDs,
    'PROPERTY_LOCATION' => $citiesID,
    'PROPERTY_USER_GROUP_ID' => $arResult['USER_GROUP']
];

$arResult['NEWS'] = [];
$obj = CIBlockElement::GetList(['date_create' => 'desc'],$arFilter,false,['nTopCount' => 5],$arSelect);
while($res = $obj->GetNext()) {
    $arResult['NEWS'][] = $res;
}
?>