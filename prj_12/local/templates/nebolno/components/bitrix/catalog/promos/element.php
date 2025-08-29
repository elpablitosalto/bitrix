<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;

$this->setFrameMode(true);

$arFilter = array(
    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
    "ACTIVE" => "Y",
);
if (0 < intval($arResult["VARIABLES"]["ELEMENT_ID"]))
    $arFilter["ID"] = $arResult["VARIABLES"]["ELEMENT_ID"];
elseif ('' != $arResult["VARIABLES"]["ELEMENT_CODE"])
    $arFilter["=CODE"] = $arResult["VARIABLES"]["ELEMENT_CODE"];

$obCache = new CPHPCache();
if ($obCache->InitCache(36000, serialize($arFilter), "/iblock/catalog"))
{
    $arCurElement = $obCache->GetVars();
}
elseif ($obCache->StartDataCache())
{
    $arCurElement = array();
    if (Loader::includeModule("iblock"))
    {
        $dbRes = CIBlockElement::GetList(array(), $arFilter, false, false, array("ID", "XML_ID"));

        if(defined("BX_COMP_MANAGED_CACHE"))
        {
            global $CACHE_MANAGER;
            $CACHE_MANAGER->StartTagCache("/iblock/catalog");

            if ($arCurElement = $dbRes->Fetch())
                $CACHE_MANAGER->RegisterTag("iblock_id_".$arParams["IBLOCK_ID"]);

            $CACHE_MANAGER->EndTagCache();
        }
        else
        {
            if(!$arCurElement = $dbRes->Fetch())
                $arCurElement = array();
        }
    }
    $obCache->EndDataCache($arCurElement);
}
if (!isset($arCurElement))
    $arCurElement = array();
?>
<?
$APPLICATION->IncludeComponent(
	"indexis:page.constructor",
	"",
	Array(
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"SECTION_ID" => $arCurElement['XML_ID'],
        "PROMO_CODE" => $arResult['VARIABLES']['ELEMENT_CODE']
	)
);
?>