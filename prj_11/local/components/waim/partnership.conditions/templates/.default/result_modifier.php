<?php
$arResult["VALUES"] = [
	$arParams["VALUE_1"],
	$arParams["VALUE_2"],
	$arParams["VALUE_3"]
];

$arResult["ITEMS"] = [];

foreach($arResult["VALUES"] as $valueStr) {
	$arStr = explode("|", $valueStr);
	$arResult["ITEMS"][] = [
		"TEXT" => !empty($arStr[0]) ? $arStr[0] : "",
		"PRICE" => !empty($arStr[1]) ? $arStr[1] : ""
	];
}