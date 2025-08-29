<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);

use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;

CModule::IncludeModule("iblock");
global $TEMPLATE_OPTIONS, $MShopSectionID;
$arParams["ADD_ELEMENT_CHAIN"] = (isset($arParams["ADD_ELEMENT_CHAIN"]) ? $arParams["ADD_ELEMENT_CHAIN"] : "N");
$bFastViewMode = (isset($_REQUEST['FAST_VIEW']) && $_REQUEST['FAST_VIEW'] == 'Y');
// get current section ID

if($arResult["VARIABLES"]["SECTION_ID"] > 0){
	$arSections = CMshopCache::CIBlockSection_GetList(array('CACHE' => array("MULTI" =>"Y", "TAG" => CMshopCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]))), array('GLOBAL_ACTIVE' => 'Y', "ID" => $arResult["VARIABLES"]["SECTION_ID"], "IBLOCK_ID" => $arParams["IBLOCK_ID"]), false, array("ID", "IBLOCK_ID", "UF_TIZERS", "SECTION_PAGE_URL", "NAME", "IBLOCK_SECTION_ID", "DEPTH_LEVEL", "LEFT_MARGIN", "RIGHT_MARGIN", "UF_OFFERS_TYPE", "UF_ELEMENT_DETAIL"));
}
elseif(strlen(trim($arResult["VARIABLES"]["SECTION_CODE"])) > 0){
	$arSections = CMshopCache::CIBlockSection_GetList(array('CACHE' => array("MULTI" =>"Y", "TAG" => CMshopCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]))), array('GLOBAL_ACTIVE' => 'Y', "=CODE" => $arResult["VARIABLES"]["SECTION_CODE"], "IBLOCK_ID" => $arParams["IBLOCK_ID"]), false, array("ID", "IBLOCK_ID", "UF_TIZERS", "SECTION_PAGE_URL", "NAME", "IBLOCK_SECTION_ID", "DEPTH_LEVEL", "LEFT_MARGIN", "RIGHT_MARGIN", "UF_OFFERS_TYPE", "UF_ELEMENT_DETAIL"));
}

if(count($arSections) > 1)
{
	foreach($arSections as $key => $arTmpSection)
	{
		if(str_replace($arParams['SEF_FOLDER'], '', $arTmpSection['SECTION_PAGE_URL']) == $arResult['VARIABLES']['SECTION_CODE_PATH'].'/')
		{
			$section = $arTmpSection;
		}
		
	}
}
else
{
	$section = current($arSections);
}

if($arResult["VARIABLES"]["ELEMENT_ID"] > 0){
	$arElement = CMshopCache::CIBLockElement_GetList(array('CACHE' => array("MULTI" =>"N", "TAG" => CMshopCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]))), array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ACTIVE"=>"Y", "ID" => $arResult["VARIABLES"]["ELEMENT_ID"]), false, false, array("ID", "IBLOCK_SECTION_ID", "IBLOCK_ID", "PREVIEW_TEXT", "PREVIEW_PICTURE", "DETAIL_PICTURE", "PROPERTY_TIP_IZDELIYA", "PROPERTY_POL", "PROPERTY_TSVET_OSNOVNOY", "PROPERTY_TSVET_OTDELKI", "PROPERTY_IMYA_KOMPLEKTA", "PROPERTY_IMYA_KOMPLEKTA_2", "PROPERTY_IMYA_KOMPLEKTA_3", "PROPERTY_MATERIAL", "PROPERTY_SEZON", "PROPERTY_IMYA_KOMPLEKTAM"));
}
elseif(strlen(trim($arResult["VARIABLES"]["ELEMENT_CODE"])) > 0){
	$arElement = CMshopCache::CIBLockElement_GetList(array('CACHE' => array("MULTI" =>"N", "TAG" => CMshopCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]))), array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ACTIVE"=>"Y", "=CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"]), false, false, array("ID", "IBLOCK_SECTION_ID", "IBLOCK_ID", "PREVIEW_TEXT", "PREVIEW_PICTURE", "DETAIL_PICTURE", "PROPERTY_TIP_IZDELIYA", "PROPERTY_POL", "PROPERTY_TSVET_OSNOVNOY", "PROPERTY_TSVET_OTDELKI", "PROPERTY_IMYA_KOMPLEKTA", "PROPERTY_IMYA_KOMPLEKTA_2", "PROPERTY_IMYA_KOMPLEKTA_3", "PROPERTY_MATERIAL", "PROPERTY_SEZON", "PROPERTY_IMYA_KOMPLEKTAM"));
}
if(!$section["ID"]){
	if($arElement["IBLOCK_SECTION_ID"] && !$section){
		$section=CMshopCache::CIBlockSection_GetList(array('CACHE' => array("MULTI" =>"N", "TAG" => CMshopCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]))), array('GLOBAL_ACTIVE' => 'Y', "ID" => $arElement["IBLOCK_SECTION_ID"]), false, array("ID"));
	}
}
$MShopSectionID = $section["ID"];
$arResult["HAS_OFFERS"] = !empty(CCatalogSKU::getOffersList($arElement["ID"], $arElement["IBLOCK_ID"]));
global $TEMPLATE_OPTIONS;

$typeSKU = '';
//set offer view type
$typeTmpSKU = 0;
if($section['UF_OFFERS_TYPE'])
	$typeTmpSKU = $section['UF_OFFERS_TYPE'];
else
{
	if($section["DEPTH_LEVEL"] > 2)
	{
		$arSectionParent = CMshopCache::CIBlockSection_GetList(array('CACHE' => array("MULTI" =>"N", "TAG" => CMshopCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]))), array('GLOBAL_ACTIVE' => 'Y', "ID" => $section["IBLOCK_SECTION_ID"], "IBLOCK_ID" => $arParams["IBLOCK_ID"]), false, array("ID", "IBLOCK_ID", "NAME", "UF_OFFERS_TYPE"));
		if($arSectionParent['UF_OFFERS_TYPE'] && !$typeTmpSKU)
			$typeTmpSKU = $arSectionParent['UF_OFFERS_TYPE'];

		if(!$typeTmpSKU)
		{
			$arSectionRoot = CMshopCache::CIBlockSection_GetList(array('CACHE' => array("MULTI" =>"N", "TAG" => CMshopCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]))), array('GLOBAL_ACTIVE' => 'Y', "<=LEFT_BORDER" => $section["LEFT_MARGIN"], ">=RIGHT_BORDER" => $section["RIGHT_MARGIN"], "DEPTH_LEVEL" => 1, "IBLOCK_ID" => $arParams["IBLOCK_ID"]), false, array("ID", "IBLOCK_ID", "NAME", "UF_OFFERS_TYPE"));
			if($arSectionRoot['UF_OFFERS_TYPE'] && !$typeTmpSKU)
				$typeTmpSKU = $arSectionRoot['UF_OFFERS_TYPE'];
		}
	}
	else
	{
		$arSectionRoot = CMshopCache::CIBlockSection_GetList(array('CACHE' => array("MULTI" =>"N", "TAG" => CMshopCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]))), array('GLOBAL_ACTIVE' => 'Y', "<=LEFT_BORDER" => $section["LEFT_MARGIN"], ">=RIGHT_BORDER" => $section["RIGHT_MARGIN"], "DEPTH_LEVEL" => 1, "IBLOCK_ID" => $arParams["IBLOCK_ID"]), false, array("ID", "IBLOCK_ID", "NAME", "UF_OFFERS_TYPE"));
		if($arSectionRoot['UF_OFFERS_TYPE'] && !$typeTmpSKU)
			$typeTmpSKU = $arSectionRoot['UF_OFFERS_TYPE'];
	}
}
if($typeTmpSKU)
{
	$rsTypes = CUserFieldEnum::GetList(array(), array("ID" => $typeTmpSKU));
	if($arType = $rsTypes->GetNext())
	{
		$typeSKU = $arType['XML_ID'];
		$TEMPLATE_OPTIONS["TYPE_SKU"]["CURRENT_VALUE"] = $typeSKU;
	}
}
?>
<?CMShop::AddMeta(
	array(
		'og:description' => $arElement['PREVIEW_TEXT'],
		'og:image' => (($arElement['PREVIEW_PICTURE'] || $arElement['DETAIL_PICTURE']) ? CFile::GetPath(($arElement['PREVIEW_PICTURE'] ? $arElement['PREVIEW_PICTURE'] : $arElement['DETAIL_PICTURE'])) : false),
	)
);
// Рекоммендации 29825
$arRecommendationsFilter = [
    "IBLOCK_ID" => $arParams["IBLOCK_ID"], "!ID" => $arElement["ID"],
    "ACTIVE" => "Y",
    "!PROPERTY_RASPRODAT_VALUE" => "Да"
];
if(!empty($arElement["PROPERTY_SEZON_ENUM_ID"])){
    $arRecommendationsFilter["PROPERTY_SEZON"] = $arElement["PROPERTY_SEZON_ENUM_ID"];
}
$arRecommendationsFilter[0] = ["LOGIC" => "OR"];
if(!empty($arElement["PROPERTY_TSVET_OSNOVNOY_ENUM_ID"])){
    $arRecommendationsFilter[0][] = ["PROPERTY_TSVET_OSNOVNOY" => $arElement["PROPERTY_TSVET_OSNOVNOY_ENUM_ID"]];
}
if(!empty($arElement["PROPERTY_TSVET_OSNOVNOY_ENUM_ID"])){
    $arRecommendationsFilter[0][] = ["PROPERTY_TSVET_OTDELKI_VALUE" => str_replace(["чёрный"], ["черный"], $arElement["PROPERTY_TSVET_OSNOVNOY_VALUE"])];
}
if(!empty($arElement["PROPERTY_TSVET_OTDELKI_VALUE"])){
    $arRecommendationsFilter[0][] = ["PROPERTY_TSVET_OSNOVNOY_VALUE" => str_replace(["черный"], ["чёрный"], $arElement["PROPERTY_TSVET_OTDELKI_VALUE"])];
}
// Имена комплектов
if(!empty($arElement["PROPERTY_IMYA_KOMPLEKTAM_ENUM_ID"]) && is_array($arElement["PROPERTY_IMYA_KOMPLEKTAM_ENUM_ID"])){
    $arElement["PROPERTY_IMYA_KOMPLEKTAM_ENUM_ID"] = array_filter($arElement["PROPERTY_IMYA_KOMPLEKTAM_ENUM_ID"]);
    $arElement["PROPERTY_IMYA_KOMPLEKTAM_VALUE"] = array_filter($arElement["PROPERTY_IMYA_KOMPLEKTAM_VALUE"]);
}elseif(!empty($arElement["PROPERTY_IMYA_KOMPLEKTAM_ENUM_ID"])){
    $arElement["PROPERTY_IMYA_KOMPLEKTAM_ENUM_ID"] = array($arElement["PROPERTY_IMYA_KOMPLEKTAM_ENUM_ID"]);
    $arElement["PROPERTY_IMYA_KOMPLEKTAM_VALUE"] = array($arElement["PROPERTY_IMYA_KOMPLEKTAM_VALUE"]);
}
if(!empty($arElement["PROPERTY_IMYA_KOMPLEKTAM_ENUM_ID"])){
    $arRecommendationsFilter[1] = ["LOGIC" => "OR"];
    $arRecommendationsFilter[1][] = ["PROPERTY_IMYA_KOMPLEKTAM" => $arElement["PROPERTY_IMYA_KOMPLEKTAM_ENUM_ID"]];
    $arNames = $arElement["PROPERTY_IMYA_KOMPLEKTAM_VALUE"];
    if(!empty($arNames)) {
        $arQueryNames = [];
        foreach ($arNames as $name){
            $arQueryNames[] = '"'.$name.'"';
        }
        $arRecommendationsFilter[1][] = ["%NAME" => $arQueryNames];
    }
}
if(
    (
        !empty($arElement["PROPERTY_SEZON_ENUM_ID"]) ||
        !empty($arElement["PROPERTY_TSVET_OSNOVNOY_ENUM_ID"]) ||
        !empty($arElement["PROPERTY_TSVET_OTDELKI_VALUE"])
    ) &&
    !empty($arElement["PROPERTY_IMYA_KOMPLEKTAM_ENUM_ID"])
) {
    $arResult["RECOMMENDATIONS"] = CMshopCache::CIBLockElement_GetList(array('CACHE' => array("MULTI" => "Y", "TAG" => CMshopCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]))), $arRecommendationsFilter, false, ['nTopCount' => 20], ["ID", "NAME", "PROPERTY_TIP_IZDELIYA", "PROPERTY_POL", "PROPERTY_TSVET_OSNOVNOY", "PROPERTY_TSVET_OTDELKI", "PROPERTY_IMYA_KOMPLEKTA", "PROPERTY_IMYA_KOMPLEKTA_2", "PROPERTY_IMYA_KOMPLEKTA_3", "PROPERTY_MATERIAL", "PROPERTY_SEZON", "PROPERTY_IMYA_KOMPLEKTAM"]);
    $arResult["RECOMMENDATIONS_ELEMENT"] = $arElement;
}
// Рекоммендации END
// 31559 Аналоги товара
if(!empty($arElement["ID"])){
	$arResult['ANALOG_PRODUCTS'] = \CrossSales::getAnalogs($arElement["ID"], $arParams);
}
// 31559 Аналоги товара END
?>

<?
$arParams["GRUPPER_PROPS"] = COption::GetOptionString('aspro.mshop', "GRUPPER_PROPS", 'NOT', SITE_ID); 

if($arParams["GRUPPER_PROPS"] != "NOT") 
{ 
    $arParams["PROPERTIES_DISPLAY_TYPE"] = "TABLE"; 

    if($arParams["GRUPPER_PROPS"] == "GRUPPER" && !\Bitrix\Main\Loader::includeModule("redsign.grupper")) 
        $arParams["GRUPPER_PROPS"] = "NOT"; 
    if($arParams["GRUPPER_PROPS"] == "WEBDEBUG" && !\Bitrix\Main\Loader::includeModule("webdebug.utilities")) 
        $arParams["GRUPPER_PROPS"] = "NOT"; 
    if($arParams["GRUPPER_PROPS"] == "YENISITE_GRUPPER" && !\Bitrix\Main\Loader::includeModule("yenisite.infoblockpropsplus")) 
        $arParams["GRUPPER_PROPS"] = "NOT"; 
}
?>

<?if($bFastViewMode):?>
	<?include_once('element_fast_view.php');?>
<?else:?>
	<?include_once('element_normal.php');?>
<?endif;?>