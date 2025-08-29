<?

$arResult['LEADER'] = [];
$obj = CIBlockElement::GetList(false, ['IBLOCK_ID' => OUR_TEAM, 'ID' => $arResult['PROPERTIES']['LEADER']['VALUE']]);
if ($res = $obj->GetNextElement()) {
    $arResult['LEADER']['FIELDS'] = $res->GetFields();
    $arResult['LEADER']['PROPERTIES'] = $res->GetProperties();
    $arResult['LEADER']['PROPERTIES']['LOCATION']['DISPLAY_ARRAY'] = CIBlockSection::GetByID($arResult['LEADER']['PROPERTIES']['LOCATION']['VALUE'])->GetNext();;
}


/*
// Связанные товары -->
$arResult['RELATED_PRODUCTS'] = array();
if (!empty($arResult['PROPERTIES']['RELATED_PRODUCTS_CONCEPT']['VALUE'])) {
    $arResult['RELATED_PRODUCTS'] = array_merge($arResult['RELATED_PRODUCTS'], $arResult['PROPERTIES']['RELATED_PRODUCTS_CONCEPT']['VALUE']);
}
if (!empty($arResult['PROPERTIES']['RELATED_PRODUCTS_INFINITY']['VALUE'])) {
    $arResult['RELATED_PRODUCTS'] = array_merge($arResult['RELATED_PRODUCTS'], $arResult['PROPERTIES']['RELATED_PRODUCTS_INFINITY']['VALUE']);
}
// <-- Связанные товары
*/