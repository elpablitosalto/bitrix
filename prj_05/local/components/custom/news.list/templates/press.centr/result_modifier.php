<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$idArray = array();
foreach($arResult['ITEMS'] as $k => $arItem) {
    if($arItem['IBLOCK_ID'] == 6 ) {
        array_push($idArray, $arItem['ID']);
    }
}
foreach ($idArray as $id){
    $arFilter= Array("IBLOCK_ID" => 6, "ID" => $id);
    $arSelect = Array("ID", "PROPERTY_EVENT_TIME", "PROPERTY_COST","PROPERTY_TYPE","PROPERTY_START_DATE");
    $res= CIBlockElement::GetList(
        Array(),
        $arFilter,
        false,
        false,
        $arSelect
    );
    if ($ob = $res->GetNext()){;
        $arFields = $ob;
        $arResult['FIELD_LIST'][$arFields['ID']] = $arFields;
    }
}
foreach ($arResult['ITEMS'] as $index => $item){
    if (array_key_exists($item['ID'], $arResult['FIELD_LIST'])){
        $arResult['ITEMS'][$index]["COST"] =  $arResult['FIELD_LIST'][$item['ID']]['PROPERTY_COST_VALUE'];
        $arResult['ITEMS'][$index]["TYPE"] =  $arResult['FIELD_LIST'][$item['ID']]['PROPERTY_TYPE_VALUE'];
        $arResult['ITEMS'][$index]["EVENT_TIME"] =  $arResult['FIELD_LIST'][$item['ID']]['PROPERTY_EVENT_TIME_VALUE'];
        $arResult['ITEMS'][$index]["START_DATE"] =  $arResult['FIELD_LIST'][$item['ID']]['PROPERTY_START_DATE_VALUE'];
    }

}
?>

