<?

use Hair\General;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
CModule::IncludeModule('highloadblock');

$arResult["VARIANTS"] = false;
if (!empty($arResult["PROPERTIES"]["ACTIVE_SUBSTANCE"]["VALUE"])) {
    $arResult["VARIANTS"] = General::infinityGetProductVariants($arResult["ID"], "ACTIVE_SUBSTANCE");
} elseif (!empty($arResult["PROPERTIES"]["PACK_VOLUME"]["VALUE"])) {
    $arResult["VARIANTS"] = General::infinityGetProductVariants($arResult["ID"], "PACK_VOLUME");
} elseif (!empty($arResult["PROPERTIES"]["FIXATION_STRENGTH"]["VALUE"])) {
    $arResult["VARIANTS"] = General::infinityGetProductVariants($arResult["ID"], "FIXATION_STRENGTH");
}
// Слайдер
$arResult["PRODUCT_GALLERY"] = [];
if(!empty($arResult['DETAIL_PICTURE'])){
    $arResult["PRODUCT_GALLERY"][] = CFile::ResizeImageGet($arResult['DETAIL_PICTURE'], array('width'=> 1000 , 'height' => 1000), BX_RESIZE_IMAGE_PROPORTIONAL, true);
}
if(!empty($arResult['PROPERTIES']['PRODUCT_PHOTOS']['VALUE'])){
    foreach ($arResult['PROPERTIES']['PRODUCT_PHOTOS']['VALUE'] as $image){
        $arResult["PRODUCT_GALLERY"][] = CFile::ResizeImageGet($image, array('width'=> 1000 , 'height' => 1000), BX_RESIZE_IMAGE_PROPORTIONAL, true);
    }
}
// Маркетплейсы
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
    $arResult['MARKETPLACE_LINKS'][$marketplaceFields["CODE"]] = array(
        "ID" => $marketplaceFields["ID"],
        "NAME" => $marketplaceFields["NAME"],
        "CODE" => $marketplaceFields["CODE"],
        "LOGO" => CFile::ResizeImageGet($marketplaceFields["DETAIL_PICTURE"], array('width'=>126, 'height'=>70), BX_RESIZE_IMAGE_PROPORTIONAL, true),
        "URL" => $marketplaceProperties["URL"]["VALUE"],
        "URL_MATCH" => $marketplaceProperties["URL_MATCH"]["VALUE"],
    );
}
// Основной раздел
$arResult["ROOT_SECTION"] = [];
$rsRootSection = \CIBlockSection::GetNavChain($arResult["IBLOCK_ID"], $arResult['IBLOCK_SECTION_ID']);
if($arRootSection = $rsRootSection->Fetch()){
    $arResult["ROOT_SECTION"] = \CIBlockSection::GetList(
        ["ID" => "ASC"],
        ["IBLOCK_ID" => $arRootSection["IBLOCK_ID"], "ID" => $arRootSection['ID']],
        false,
        ["*", "UF_*"]
    )->Fetch();
}