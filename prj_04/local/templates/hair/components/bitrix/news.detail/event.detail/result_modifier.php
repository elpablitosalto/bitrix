<?

$arResult['LEADER'] = [];
$obj = CIBlockElement::GetList(false,['IBLOCK_ID' => OUR_TEAM, 'ID' => $arResult['PROPERTIES']['LEADER']['VALUE']]);
if($res = $obj->GetNextElement()) {
    $arResult['LEADER']['FIELDS'] = $res->GetFields();
    $arResult['LEADER']['PROPERTIES'] = $res->GetProperties();
    $arResult['LEADER']['PROPERTIES']['LOCATION']['DISPLAY_ARRAY'] = CIBlockSection::GetByID($arResult['LEADER']['PROPERTIES']['LOCATION']['VALUE'])->GetNext();;
}
$arResult['LEADER_TEST'] = [];
foreach ($arResult['PROPERTIES']['LEADER']['VALUE'] as $curr_id) {
    $obj = CIBlockElement::GetList(false, ['IBLOCK_ID' => OUR_TEAM, 'ID' => $curr_id]);
    if($res = $obj->GetNextElement()) {
        $arResult['LEADER_TEST'][$curr_id]['FIELDS'] = $res->GetFields();
        $arResult['LEADER_TEST'][$curr_id]['PROPERTIES'] = $res->GetProperties();
        $arResult['LEADER_TEST'][$curr_id]['PROPERTIES']['LOCATION']['DISPLAY_ARRAY']= CIBlockSection::GetByID($arResult['LEADER_TEST'][$curr_id]['PROPERTIES']['LOCATION']['VALUE'])->GetNext();
    }
}