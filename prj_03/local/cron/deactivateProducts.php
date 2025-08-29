<?php

if (php_sapi_name() != "cli")
    die();

$_SERVER['DOCUMENT_ROOT'] = realpath(dirname(__FILE__) . '/../..');
require_once $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php';
$IBLOCK_ID = 34;

if(\Bitrix\Main\Loader::includeModule("iblock")) {

    echo sprintf('%s - start'."\n", date('d.m.Y H:i:s'));

    $connection = \Bitrix\Main\Application::getConnection();
    $sqlHelper = $connection->getSqlHelper();
    // выбираем товары
    $rsProducts = \CIBlockElement::GetList(
        ["ID" => "ASC"],
        [
            "IBLOCK_ID" => $IBLOCK_ID,
        ],
        false,
        false,
        ["ID", "NAME", "IBLOCK_ID", "PROPERTY_VYGRUZHAT_NA_SAYT", "XML_ID", "ACTIVE"]
    );

    while ($arProduct = $rsProducts->GetNext()){
        if ($arProduct["PROPERTY_VYGRUZHAT_NA_SAYT_VALUE"] == "Да") {

            if($arProduct['ACTIVE'] == 'Y')
                continue;

            $strUpdate = $sqlHelper->PrepareUpdate(\Bitrix\Iblock\ElementTable::getTableName(), ["ACTIVE" => "Y"]);
            $strUpdateSku = $sqlHelper->PrepareUpdate(\Bitrix\Iblock\ElementTable::getTableName(), ["ACTIVE" => "Y"]);
        } else {

            if($arProduct['ACTIVE'] == 'N')
                continue;

            $strUpdate = $sqlHelper->PrepareUpdate(\Bitrix\Iblock\ElementTable::getTableName(), ["ACTIVE" => "N"]);
            $strUpdateSku = $sqlHelper->PrepareUpdate(\Bitrix\Iblock\ElementTable::getTableName(), ["ACTIVE" => "N"]);
        }
        $query = "UPDATE `" . \Bitrix\Iblock\ElementTable::getTableName() . "` SET {$strUpdate[0]} WHERE (`ID` = '".$sqlHelper->convertToDbInteger($arProduct["ID"])."');";
        $updateResult = $connection->query($query);

        if(strlen($arProduct["XML_ID"]))
        {
            $query = "UPDATE `" . \Bitrix\Iblock\ElementTable::getTableName() . "` SET {$strUpdateSku[0]} WHERE (`XML_ID` LIKE ".$sqlHelper->convertToDbString($arProduct["XML_ID"]."#%").");";
            $connection->query($query);
        }
    }

    // Обрабатываем SCU
    $SCUDeactivatePropertyId = 1511;
    $SCUDeactivatePropertyValue = 56296;
    $rsScuProducts = \Bitrix\Iblock\ElementPropertyTable::getList([
        "filter" => [
            "IBLOCK_PROPERTY_ID" => $SCUDeactivatePropertyId,  // 1511 - PRIZNAK_NALICHIYA
            "VALUE" => $SCUDeactivatePropertyValue, // Не производится/спецзаказ
            "ELEMENT.ACTIVE" => "Y"
        ],
    ]);
    while ($arScu = $rsScuProducts->fetch()){
        if(!empty($arScu["IBLOCK_ELEMENT_ID"])) {
            $strUpdate = $sqlHelper->PrepareUpdate(\Bitrix\Iblock\ElementTable::getTableName(), ["ACTIVE" => "N"]);
            $query = "UPDATE `" . \Bitrix\Iblock\ElementTable::getTableName() . "` SET {$strUpdate[0]} WHERE (`ID` = '".$sqlHelper->convertToDbInteger($arScu["IBLOCK_ELEMENT_ID"])."');";
            $scuUpdateResult = $connection->query($query);
        }
    }

    Bitrix\Iblock\PropertyIndex\Manager::DeleteIndex($IBLOCK_ID);
    Bitrix\Iblock\PropertyIndex\Manager::markAsInvalid($IBLOCK_ID);
    $index = Bitrix\Iblock\PropertyIndex\Manager::createIndexer($IBLOCK_ID);
    $index->startIndex();
    $res = $index->continueIndex();
    $index->endIndex();
    \Bitrix\Iblock\PropertyIndex\Manager::checkAdminNotification();
    CBitrixComponent::clearComponentCache("bitrix:catalog.smart.filter");
    CIBlock::clearIblockTagCache($IBLOCK_ID);

    echo sprintf('%s - end'."\n", date('d.m.Y H:i:s'));
}