<?php
$arResult["PROPS"] = [];
$arResult["BUTTONS"] = [];
$arResult["CONTACTS"] = [];
$arResult["IMAGES"] = [
	"DEFAULT" => [],
	"BREAKPOINTS" => [],
	"TIPPY" => ["LEFT" => [
		"LABEL" => "",
		"VALUE" => "",
	], "RIGHT" => [
		"LABEL" => "",
		"VALUE" => "",
	]]
];

foreach($arResult["PROPERTIES"] as $propertyCode => $arProperty) {
	$value = $arProperty["VALUE"];

	if($propertyCode === "TYPE") {
		$value = $arProperty["VALUE_XML_ID"];
	}

	if($propertyCode === "MULTIPLE_TEXT") {
		$arValues = $arProperty["VALUE"];
		$value = [];

		foreach($arValues as $arValue) {
			$arString = explode("|", $arValue["TEXT"]);
			$value[] = [
				"LABEL" => $arString[0],
				"VALUE" => !empty($arString[1]) ? $arString[1] : ''
			];
		}
	}

	if(is_array($value) && !empty($value["TEXT"])) {
		$value = $value["TEXT"];
	}

	$arResult["PROPS"][$propertyCode] = $value;
}

$arResult["TYPE"] = !empty($arResult["PROPS"]["TYPE"]) ? $arResult["PROPS"]["TYPE"] : "MAIN";

if(!empty($arResult["PROPS"]["PRIMARY_BUTTON_TEXT"]) && !empty($arResult["PROPS"]["PRIMARY_BUTTON_LINK"])) {
	$arResult["BUTTONS"]["PRIMARY"] = [
		"TEXT" => $arResult["PROPS"]["PRIMARY_BUTTON_TEXT"],
		"LINK" => $arResult["PROPS"]["PRIMARY_BUTTON_LINK"],
		"MODAL" => substr($arResult["PROPS"]["PRIMARY_BUTTON_LINK"], 0, 1) === "#" ? true : false
	];
}

if(!empty($arResult["PROPS"]["SECONDARY_BUTTON_TEXT"]) && !empty($arResult["PROPS"]["SECONDARY_BUTTON_LINK"])) {
	$arResult["BUTTONS"]["SECONDARY"] = [
		"TEXT" => $arResult["PROPS"]["SECONDARY_BUTTON_TEXT"],
		"LINK" => $arResult["PROPS"]["SECONDARY_BUTTON_LINK"],
		"MODAL" => substr($arResult["PROPS"]["SECONDARY_BUTTON_LINK"], 0, 1) === "#" ? true : false
	];
}

if(!empty($arResult["PROPS"]["TELEGRAM"])) {
	$arResult["CONTACTS"]["TELEGRAM"] = [
		"TEXT" => $arResult["PROPS"]["TELEGRAM"],
		"LINK" => "https://t.me/" . str_replace("@", "", $arResult["PROPS"]["TELEGRAM"])
	];
}

if(!empty($arResult["PROPS"]["WHATSAPP"])) {
	$arResult["CONTACTS"]["WHATSAPP"] = [
		"TEXT" => $arResult["PROPS"]["WHATSAPP"],
		"LINK" => "https://wa.me/" . filter_var($arResult["PROPS"]["WHATSAPP"], FILTER_SANITIZE_NUMBER_INT)
	];
}

if(!empty($arResult["PROPS"]["EMAIL"])) {
	$arResult["CONTACTS"]["EMAIL"] = [
		"TEXT" => $arResult["PROPS"]["EMAIL"],
		"LINK" => "mailto:" . $arResult["PROPS"]["EMAIL"]
	];
}

$arImageProps = ["SRC"];

if(!empty($arResult["PROPS"]["IMAGE_XS"])) {
	$arImage = CFile::GetFileArray($arResult["PROPS"]["IMAGE_XS"]);
	$arResult["IMAGES"]["BREAKPOINTS"]["XS"] = array_intersect_key($arImage, array_flip($arImageProps));
}

if(!empty($arResult["PROPS"]["IMAGE_S"])) {
	$arImage = CFile::GetFileArray($arResult["PROPS"]["IMAGE_S"]);
	$arResult["IMAGES"]["BREAKPOINTS"]["S"] = array_intersect_key($arImage, array_flip($arImageProps));
}

if(!empty($arResult["PROPS"]["IMAGE_M"])) {
	$arImage = CFile::GetFileArray($arResult["PROPS"]["IMAGE_M"]);
	$arResult["IMAGES"]["BREAKPOINTS"]["M"] = array_intersect_key($arImage, array_flip($arImageProps));
}

if(!empty($arResult["PROPS"]["IMAGE_L"])) {
	$arImage = CFile::GetFileArray($arResult["PROPS"]["IMAGE_L"]);
	$arResult["IMAGES"]["BREAKPOINTS"]["L"] = array_intersect_key($arImage, array_flip($arImageProps));
}

if(!empty($arResult["PROPS"]["IMAGE_XL"])) {
	$arImage = CFile::GetFileArray($arResult["PROPS"]["IMAGE_XL"]);
	$arResult["IMAGES"]["BREAKPOINTS"]["XL"] = array_intersect_key($arImage, array_flip($arImageProps));
}

if(!empty($arResult["PROPS"]["IMAGE"])) {
	$arImage = CFile::GetFileArray($arResult["PROPS"]["IMAGE"]);
	$arResult["IMAGES"]["DEFAULT"] = array_intersect_key($arImage, array_flip($arImageProps));
}

if(!empty($arResult["PROPS"]["TIPPY_LEFT"]) ) {
	$arString = explode("|", $arResult["PROPS"]["TIPPY_LEFT"]);
	$arResult["IMAGES"]["TIPPY"]["LEFT"]  = [
		"LABEL" => $arString[0],
		"VALUE" => !empty($arString[1]) ? $arString[1] : ''
	];
}
if(!empty($arResult["PROPS"]["TIPPY_RIGHT"]) ) {
	$arString = explode("|", $arResult["PROPS"]["TIPPY_RIGHT"]);
	$arResult["IMAGES"]["TIPPY"]["RIGHT"]  = [
		"LABEL" => $arString[0],
		"VALUE" => !empty($arString[1]) ? $arString[1] : ''
	];
}