<?
global $APPLICATION;
global $USER;



$main_section = CIBlockSection::GetNavChain(11, $arResult['IBLOCK_SECTION_ID'], array(), false);
//ID - 1 LEVEL
$region_name = '';
if ($ar_res_section = $main_section->GetNext()) {
    $region_name = $ar_res_section['NAME'];
}
$city_name = '';
$section_city = CIBlockSection::GetByID($arResult['IBLOCK_SECTION_ID']);
if ($ar_res_final = $section_city->GetNext()) {
    $city_name = $ar_res_final['NAME'];
}
$curent_title = $region_name.' | '.$city_name.' | '.$arResult['NAME'];
if(isset($arResult["META_TAGS"]["DESCRIPTION"])) {
    $arResult["META_TAGS"]["DESCRIPTION"] = $curent_title;
    $arResult["META_TAGS"]["BROWSER_TITLE"] = $curent_title;
} else {
    $APPLICATION->SetPageProperty("description",$curent_title);
    $APPLICATION->SetPageProperty("title",$curent_title);
}
$arResult['LEADER'] = [];
$obj = CIBlockElement::GetList(false,['IBLOCK_ID' => OUR_TEAM, 'ID' => $arResult['PROPERTIES']['LEADER']['VALUE']]);
if($res = $obj->GetNextElement()) {
    $arResult['LEADER']['FIELDS'] = $res->GetFields();
    $arResult['LEADER']['PROPERTIES'] = $res->GetProperties();
    $arResult['LEADER']['PROPERTIES']['LOCATION']['DISPLAY_ARRAY'] = CIBlockSection::GetByID($arResult['LEADER']['PROPERTIES']['LOCATION']['VALUE'])->GetNext();;
}
