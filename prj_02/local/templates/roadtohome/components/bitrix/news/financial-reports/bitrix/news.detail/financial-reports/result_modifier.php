<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

use \Bitrix\Main\Loader;

if (\Bitrix\Main\Loader::IncludeModule("highloadblock")) {

	// Donation
	$result = \Bitrix\Highloadblock\HighloadBlockTable::getList(array('filter'=>array('=NAME'=>"Donation")));
	if($row = $result->fetch())
		{
    			$HLBLOCK_ID = $row["ID"];
				$hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getById($HLBLOCK_ID)->fetch();
				$entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
				$entityDataClass = $entity->getDataClass();
				$result = $entityDataClass::getList(array(
					"select" => ["ID","UF_NAME","UF_XML_ID","UF_DESCRIPTION"],
					"order" => []
				));
				while ($arRow = $result->Fetch())
				{
					$arResult['DONATION']['LEGEND'][$arRow["UF_XML_ID"]] = ["ID" => $arRow["ID"], "NAME" => $arRow["UF_NAME"], "COLOR" => $arRow["UF_DESCRIPTION"]];
				}
		}
	$arResult['DONATION']['CALC_SUM'] = 0;
    foreach($arResult["DISPLAY_PROPERTIES"]["DONATION"]["VALUE"] as $item)  {
		$arResult['DONATION']['CALC_SUM'] = $arResult['DONATION']['CALC_SUM'] + (int)$item["SUB_VALUES"]["DONATION_AMOUNT"]['VALUE'];
	}

	// Spending
	$result = \Bitrix\Highloadblock\HighloadBlockTable::getList(array('filter'=>array('=NAME'=>"Spending")));
	if($row = $result->fetch())
		{
    			$HLBLOCK_ID = $row["ID"];
				$hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getById($HLBLOCK_ID)->fetch();
				$entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
				$entityDataClass = $entity->getDataClass();
				$result = $entityDataClass::getList(array(
					"select" => ["ID","UF_NAME","UF_XML_ID","UF_DESCRIPTION"],
					"order" => []
				));
				while ($arRow = $result->Fetch())
				{
					$arResult['SPENDING']['LEGEND'][$arRow["UF_XML_ID"]] = ["ID" => $arRow["ID"], "NAME" => $arRow["UF_NAME"], "COLOR" => $arRow["UF_DESCRIPTION"]];
				}
		}
	$arResult['SPENDING']['CALC_SUM'] = 0;
    foreach($arResult["DISPLAY_PROPERTIES"]["SPENDING"]["VALUE"] as $item)  {
		$arResult['SPENDING']['CALC_SUM'] = $arResult['SPENDING']['CALC_SUM'] + (int)$item["SUB_VALUES"]["SPENDING_AMOUNT"]['VALUE'];
	}


}

\Bitrix\Main\Loader::includeModule('dev2fun.opengraph');
\Dev2fun\Module\OpenGraph::Show($arResult['ID'],'element');



