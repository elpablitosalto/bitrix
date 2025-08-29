<?
$arResult['PROPERTIES'] = [];
$arResult['PROPERTIES'] = [];
$arResult['STORE'] = null;

foreach($arResult['ORDER_PROPS'] as $property) {
	$arResult['PROPERTIES'][$property['CODE']] = $property['VALUE'];
}

foreach ($arResult['SHIPMENT'] as $shipment) {
	$arResult['STORE'] = $arResult['DELIVERY']['STORE_LIST'][$shipment["STORE_ID"]];
}