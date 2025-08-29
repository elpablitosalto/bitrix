<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @global array $arParams */

$arResult["SPECIALITY"] = [];
global $USER_FIELD_MANAGER;
$arFields = $USER_FIELD_MANAGER->GetUserFields("USER");
$obEnum = new CUserFieldEnum;
$rsEnum = $obEnum->GetList(array(), array("USER_FIELD_ID" => 1));
while($arEnum = $rsEnum->GetNext()){
    $arResult["SPECIALITY"][] = $arEnum;
}
