<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Sale;

$arProductIds = [];
$arResult['PRODUCT_DATA'] = [];

foreach ($arResult['ORDERS'] as $key => &$order)
{
    foreach ($order['BASKET_ITEMS'] as $arBasketItem)
        $arProductIds[$arBasketItem['PRODUCT_ID']] = $arBasketItem['PRODUCT_ID'];

    $orderData = Sale\Order::load($order['ORDER']['ID']);

    $arOrderProps = [];
    $propertyCollection = $orderData->getPropertyCollection();

    foreach ($propertyCollection as $prop)
    {
        $data = $prop->getFieldValues();
        $order['PROPERTIES'][$data['CODE']] = $data;
    }
}

if (count($arProductIds) > 0)
{
    $res = CIBlockElement::GetList(['SORT' => 'ASC'], [
        'IBLOCK_ID' => Indexis::getIblockId("catalog", "catalog"),
        'ID' => array_values($arProductIds),
    ], false, false, [
        'ID', 'PREVIEW_PICTURE', 'DETAIL_PICTURE', 'IBLOCK_ID'
    ]);

    while($ob = $res->GetNextElement())
    {
        $arFields = $ob->GetFields();
        $arProps = $ob->GetProperties();
        $pictureId = 0;

        foreach ($arProps as $key => $arProp)
        {
            if (!in_array($arProp['CODE'], ['VES_ATTR_S']))
                continue;

            $arDisplayProp = CIBlockFormatProperties::GetDisplayValue($arFields, $arProp);

            if (mb_strlen($arDisplayProp['DISPLAY_VALUE']) > 0)
                $arResult['PRODUCT_DATA'][$arFields['ID']]['DISPLAY_PROPERTIES'][$arProp['CODE']] = $arProps[$key] = $arDisplayProp;
        }

        if (!empty($arFields['PREVIEW_PICTURE'])) {
            $pictureId = $arFields['PREVIEW_PICTURE'];
        } else if (!empty($arFields['DETAIL_PICTURE'])) {
            $pictureId = $arFields['DETAIL_PICTURE'];
        }

        if ($pictureId)
            $arResult['PRODUCT_DATA'][$arFields['ID']]['PICTURE'] = CFile::GetPath($pictureId);
    }
}

$arResult['PERSON_TYPE_LIST'] = [];
$db_ptype = CSalePersonType::GetList(Array("SORT" => "ASC"), Array("LID"=>SITE_ID));
while ($arPersonType = $db_ptype->Fetch())
{
    $arResult['PERSON_TYPE_LIST'][$arPersonType['ID']] = $arPersonType;
}

/*
// Статусы -->
$arResult['arStatuses'] = array();
$arSelect = array();
$arFilter = array();
$res = CSaleStatus::GetList(array(), $arFilter, false, false, $arSelect);
//while ($ob = $res->GetNextElement()) {
while ($arFields = $res->Fetch()) {
	//$arFields = $ob->GetFields();

	$arResult['arStatuses'][$arFields['ID']] = $arFields;
}
//vardump($arStatuses);
// <-- Статусы
*/