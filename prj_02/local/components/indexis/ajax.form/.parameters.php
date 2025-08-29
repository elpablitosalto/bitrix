<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use \Bitrix\Main\Loader;
use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

if (!Loader::includeModule("iblock")){ return; }

$arIBlockType = CIBlockParameters::GetIBlockTypes();
$arIBlock = array();
$rsIBlock = CIBlock::GetList(Array("sort" => "asc"), Array("TYPE" => $arCurrentValues["IBLOCK_TYPE"], "ACTIVE"=>"Y"));
while($arr = $rsIBlock->Fetch())
{
    $arIBlock[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];
}

$arComponentParameters = array(
    "PARAMETERS" => array(
        "IBLOCK_ID" => array(
        	"PARENT" => "DATA_SOURCE",
        	"NAME" => Loc::getMessage("FNL_IBLOCK_IBLOCK"),
        	"TYPE" => "LIST",
        	"ADDITIONAL_VALUES" => "Y",
        	"VALUES" => $arIBlock,
        	"REFRESH" => "Y",
        )
    )
);	  
?>