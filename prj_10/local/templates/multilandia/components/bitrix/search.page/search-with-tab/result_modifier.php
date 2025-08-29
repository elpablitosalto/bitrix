<?
if(!CModule::IncludeModule("iblock"))
    return;

$strUrlGetParams = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
parse_str($strUrlGetParams, $arGetParamsUrl);

foreach ($arGetParamsUrl as $keyParams => &$valuePrams) {
    if ( $keyParams === 'iblock_code' )  {
        unset($arGetParamsUrl[$keyParams]);
        continue;
    }

    if ( stristr($keyParams, 'SIZEN') )  {
        unset($arGetParamsUrl[$keyParams]);
        continue;
    }

    if ( stristr($keyParams, 'PAGEN') )  {
        unset($arGetParamsUrl[$keyParams]);
        continue;
    }

    if ( $keyParams === 'main_code' )  {
        unset($arGetParamsUrl[$keyParams]);
        continue;
    }

    $finalUrlToFilterSort .= '&'.$keyParams.'='.$valuePrams;
}

$arResult['IBLOCK_TO_SEARCH'] = [
    'movies',
    //'guide',
    'contests'
];

//vardump( $arResult['SEARCH'] );

//if(!empty($arResult['SEARCH']))
{
    $arIblockCode[] = [
        'ID' => 0,
        'CODE' => '',
        'URL' => $finalUrlToFilterSort,
        'NAME' => 'Все',
    ];
}    
$arResult['FINAL_URL_TO_FILTER_SORT'] = $finalUrlToFilterSort;

foreach ($arResult['IBLOCK_TO_SEARCH'] as $keyParamSearch => $valueSearch) {
    if(!empty($valueSearch)) {
        $objectIblock = CIBlock::GetByID(Indexis::getIblockId($valueSearch));

        if($arResIblock = $objectIblock->GetNext()) {
            $arIblockCode[$valueSearch] = [
                'ID' => Indexis::getIblockId($valueSearch),
                'CODE' => $valueSearch,
                'URL' => $finalUrlToFilterSort,
                'NAME' =>  $arResIblock['NAME'],
                'TEMPLATE_NAME' => $valueSearch.'-search',
            ];
            $arResult['IBLOCK_AR_CODE_FIND'][] = $valueSearch;
        }
    }
}


$arResult['IBLOCK_DATA_FIND'] = $arIblockCode;

foreach ($arResult['SEARCH'] as $keySearchItem => $valueSearchItem) {
    if(!empty($valueSearchItem['PARAM1'])) {
        $arResult['TABS_LINK'][] = $valueSearchItem['PARAM1'];
        $arResult['ALL_DATA_BY_IBLOCK_ELEMENT'][$valueSearchItem['PARAM1']]['IDS_ELEMENT'][$valueSearchItem['ITEM_ID']] = $valueSearchItem['ITEM_ID'];
        $arResult['ALL_DATA_BY_IBLOCK_ELEMENT'][$valueSearchItem['PARAM1']]['CODE_IBLOCK'] = $valueSearchItem['PARAM1'];
        $arResult['ALL_DATA_BY_IBLOCK_ELEMENT'][$valueSearchItem['PARAM1']]['NAME'] = $arIblockCode[$valueSearchItem['PARAM1']]['NAME'];
    } else if($valueSearchItem['MODULE_ID'] == 'main') {
        foreach($arParams["arrFILTER_main"] as $code) {
            $pos = strpos($valueSearchItem['URL_WO_PARAMS'], $code);
            if ($pos !== false) {
                $code = preg_replace ("~/~", "", $code);
                $arResult['TABS_LINK'][] = $code;
                $valueSearchItem['URL'] = str_replace ("content.php", "", $valueSearchItem['URL']);
                $arResult['ALL_DATA_BY_MAIN'][$code][] = array(
                    'ITEM_ID'           => $valueSearchItem['ITEM_ID'],
                    'NAME'              => $valueSearchItem['TITLE'],
                    'TITLE_FORMATED'    => $valueSearchItem['TITLE_FORMATED'],
                    'URL'               => $valueSearchItem['URL'],
                    'BODY_FORMATED'     => $valueSearchItem['BODY_FORMATED']
                );
            }
        }
    }
}

$arResult['TABS_LINK'] = array_unique($arResult['TABS_LINK']);
