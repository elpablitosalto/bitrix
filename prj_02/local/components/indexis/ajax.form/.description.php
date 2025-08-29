<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Loader;

Loc::loadMessages(__FILE__);
Loader::includeModule("iblock");

$arIBlockType = [];
$iblockTypes = Bitrix\Iblock\TypeTable::getList([
        'filter'=>['!IBLOCK_TYPE_LANG_MESSAGE_NAME'=>''],
        'select' => ['*', 'LANG_MESSAGE']
    ]
);
while($arRes = $iblockTypes->fetch()){
    $arIBlockType[$arRes["ID"]] = "[".$arRes["ID"]."] ".$arRes["IBLOCK_TYPE_LANG_MESSAGE_NAME"];
}

$arIBlock=array();
$rsIBlock = CIBlock::GetList(Array("SORT" => "ASC"), Array("TYPE" => $arCurrentValues["IBLOCK_TYPE"], "ACTIVE"=>"Y"));
$rsIBlock = Bitrix\Iblock\IblockTable::getList(
    [
        'filter'=>['IBLOCK_TYPE_ID'=>$arCurrentValues["IBLOCK_TYPE"], "ACTIVE"=>"Y" ]
    ]
);
while($arr=$rsIBlock->fetch()) {
    $arIBlock[$arr["CODE"]] = "[".$arr["CODE"]."] ".$arr["NAME"];
}

$arComponentParameters = array(
    'GROUPS' => array(),
    'PARAMETERS' => array(
        "IBLOCK_TYPE" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("BN_P_IBLOCK_TYPE"),
            "TYPE" => "LIST",
            "VALUES" => $arIBlockType,
            "REFRESH" => "Y",
        ),
        "IBLOCK_CODE" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("BN_P_IBLOCK"),
            "TYPE" => "LIST",
            "VALUES" => $arIBlock,
            "REFRESH" => "Y",
        ),
    ),
);