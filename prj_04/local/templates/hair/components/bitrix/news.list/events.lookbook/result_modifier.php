<?

foreach($arResult['ITEMS'] as &$arItem):
    $obj = CIBlockElement::GetList(false,['IBLOCK_ID' => OUR_TEAM,'ID' => $arItem['PROPERTIES']['LEADER']['VALUE']],false,false,['ID','NAME','PROPERTY_POSITION','PROPERTY_LOCATION']);
    while($res = $obj->GetNext()) {
        $arItem['LEADER']['NAME'] = $res['NAME'];
        $arItem['LEADER']['POSITION'] = strtolower($res['PROPERTY_POSITION_VALUE']);
        $location = CIBlockSection::GetByID($res['PROPERTY_LOCATION_VALUE'])->GetNext();
        $arItem['LEADER']['LOCATION'] = $location['NAME'];
    }
endforeach;