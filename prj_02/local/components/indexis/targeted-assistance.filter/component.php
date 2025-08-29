<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */


use \Bitrix\Main\Loader;

if(!isset($arParams["CACHE_TIME"]))
	$arParams["CACHE_TIME"] = 36000000;

$arParams["ID"] = intval(($arParams["ID"] ?? 0));
$arParams["IBLOCK_ID"] = intval($arParams["IBLOCK_ID"]);


if($this->StartResultCache())
{

	$arResult = [];
	if(!CModule::IncludeModule("iblock"))
	{
		$this->AbortResultCache();
	}
	else
	{
		$arResult['ALL_NEEDCATEGORY'] = [];
		$arResult['ALL_THCATEGORY'] = [];

		if (\Bitrix\Main\Loader::IncludeModule("highloadblock")) {
			$result = \Bitrix\Highloadblock\HighloadBlockTable::getList(array('filter'=>array('=NAME'=>"Needcategory")));
			if($row = $result->fetch())
			{
    			$cities_HLBLOCK_ID = $row["ID"];
				$cities_hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getById($cities_HLBLOCK_ID)->fetch();
				$cities_entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($cities_hlblock);
				$cities_entityDataClass = $cities_entity->getDataClass();
				$result = $cities_entityDataClass::getList(array(
					"select" => ["ID","UF_NAME","UF_XML_ID"],
					"order" => []
				));
				while ($arRow = $result->Fetch())
				{
					$arResult['ALL_NEEDCATEGORY'][$arRow["UF_XML_ID"]] = ["ID" => $arRow["ID"], "NAME" => $arRow["UF_NAME"]];
				}
			}

			$result = \Bitrix\Highloadblock\HighloadBlockTable::getList(array('filter'=>array('=NAME'=>"Thcategory")));
			if($row = $result->fetch())
			{
    			$cities_HLBLOCK_ID = $row["ID"];
				$cities_hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getById($cities_HLBLOCK_ID)->fetch();
				$cities_entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($cities_hlblock);
				$cities_entityDataClass = $cities_entity->getDataClass();
				$result = $cities_entityDataClass::getList(array(
					"select" => ["ID","UF_NAME","UF_XML_ID"],
					"order" => []
				));
				while ($arRow = $result->Fetch())
				{
					$arResult['ALL_THCATEGORY'][$arRow["UF_XML_ID"]] = ["ID" => $arRow["ID"], "NAME" => $arRow["UF_NAME"]];
				}
			}
		}

		$arResult['NEEDCATEGORY'] = [];
		$arResult['THCATEGORY'] = [];
	    $arFilter = [
		    "IBLOCK_ID"=> Indexis::getIblockId("targeted-assistance", "content", "s1"),
	    ];

	    $arSelect = [
		    "ID", 
	        "PROPERTY_NEED_CATEGORY", "PROPERTY_ITEM_CATEGORY" 
    	];

	    $res = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);

		while($item = $res->fetch()) {
             $arResult['NEEDCATEGORY'][$item['PROPERTY_NEED_CATEGORY_VALUE']] = $item['PROPERTY_NEED_CATEGORY_VALUE'];
             $arResult['THCATEGORY'][$item['PROPERTY_ITEM_CATEGORY_VALUE']] = $item['PROPERTY_ITEM_CATEGORY_VALUE'];
		}

		$this->EndResultCache();
	}
}

if ($arParams["DISABLE_TEMPLATE"] == "Y") {
	return($arResult);
} else {
	$this->IncludeComponentTemplate();
}
?>
