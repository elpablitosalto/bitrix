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
		$arResult['ALL_CITIES'] = [];
		if (\Bitrix\Main\Loader::IncludeModule("highloadblock")) {
			$result = \Bitrix\Highloadblock\HighloadBlockTable::getList(array('filter'=>array('=NAME'=>"Cities")));
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
					$arResult['ALL_CITIES'][$arRow["UF_XML_ID"]] = ["ID" => $arRow["ID"], "NAME" => $arRow["UF_NAME"]];
				}
			}
		}

	    $arFilter = [
		    "IBLOCK_ID"=> Indexis::getIblockId("projects", "content", "s1"),
	    ];
		if(isset($arParams['arFilter']['CITY'])) {
	    	$arFilter['PROPERTY_CITY'] = $arParams['arFilter']['CITY'];
		}

	    $arSelect = [
		    "ID", "NAME", "CODE",
	        "PROPERTY_CITY",
    	];

	    $res = CIBlockElement::GetList(["SORT"=>"ASC", "NAME"=>"ASC"], $arFilter, false, false, $arSelect);

		while($item = $res->fetch()) {

			foreach($item["PROPERTY_CITY_VALUE"] as $city) {

				if (isset($arResult["ALL_CITIES"][$city]))  {
					$arResult["CITIES"][$city]['NAME'] = $arResult["ALL_CITIES"][$city]['NAME'];
				} else {
					$arResult["CITIES"][$city]['NAME'] = $city;
				}
			}

			$arResult["PROJECTS"][$item["ID"]] = $item["NAME"];
			$arResult["CITIES"][$city]["PROJECTS"][$item["ID"]] = $item["NAME"];
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
