<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

use \Bitrix\Main\Loader;

if (\Bitrix\Main\Loader::IncludeModule("highloadblock")) {

	// Thcategory
	$result = \Bitrix\Highloadblock\HighloadBlockTable::getList(array('filter'=>array('=NAME'=>"Thcategory")));
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
					$arResult['THCATEGORY']['LEGEND'][$arRow["UF_XML_ID"]] = ["ID" => $arRow["ID"], "NAME" => $arRow["UF_NAME"], "ICON" => $arRow["UF_DESCRIPTION"]];
				}
		}
}

/*foreach($arResult["ITEMS"] as &$item){
//
}
*/
