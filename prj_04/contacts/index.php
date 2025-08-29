<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");

use Hair\Geo;
use Hair\General;
use Hair\HL;

$geo = new Geo();
$geoArr = $geo->getArray();
$regionName = $geoArr->cityName;

$regionArr = CIBlockSection::GetList(false,['IBLOCK_ID' => SALONS, 'NAME' => $regionName],false,['ID','IBLOCK_SECTION_ID', 'CODE'])->GetNext();
$obj = CIBlockSection::GetList(false,['IBLOCK_ID' => SALONS, 'ID' => $regionArr['IBLOCK_SECTION_ID']],false,['ID', 'CODE']);

$citiesID = [];
while($res = $obj->GetNext()){
    $citiesID[$res['ID']] = $res['CODE'];
}

// Infinity
if(SITE_TEMPLATE_ID == "hair-infinity"){
    include_once($_SERVER["DOCUMENT_ROOT"]."/infinity/contacts/index.php");
}else{
    include_once("contacts.php");
}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");