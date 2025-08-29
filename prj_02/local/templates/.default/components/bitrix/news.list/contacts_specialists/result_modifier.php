<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

if (!empty($arResult["ITEMS"])) {
	$arDepartmentIDs = [];
	foreach ($arResult["ITEMS"] as $item) {
		$arDepartmentIDs[] = $item['ID'];
	}
	$arFilter = [
		"IBLOCK_ID" => Indexis::getIblockId("specialists", "content", "s1"),
		"PROPERTY_DEPARTMENT_VALUE" => $arDepartmentIDs,
		"ACTIVE" => "Y",
	];
	if (!empty($arParams['arrExtFilterSpecs'])) {
		foreach ($arParams['arrExtFilterSpecs'] as $key => $val) {
			$arFilter[$key] = $val;
		}
	}
	$arSelect = [
		"ID", "NAME", "PREVIEW_PICTURE", "PREVIEW_TEXT",
		"PROPERTY_DEPARTMENT",
		"PROPERTY_POSITION",
		"PROPERTY_PHONE",
		"PROPERTY_EMAIL",
	];
	$arResult['SPECIALISTS'] = [];
	$res = CIBlockElement::GetList(["SORT" => "ASC", "NAME" => "ASC"], $arFilter, false, false, $arSelect);
	while ($item = $res->fetch()) {
		$arSpec = [];
		$arSpec["ID"] = $item["ID"];
		$arSpec["NAME"] = $item["NAME"];
		$arSpec["PREVIEW_TEXT"] = $item["PREVIEW_TEXT"];
		$arSpec["POSITION"] = $item["PROPERTY_POSITION_VALUE"];
		$arSpec["EMAIL"] = $item["PROPERTY_EMAIL_VALUE"];
		$arSpec["PHONE"] = $item["PROPERTY_PHONE_VALUE"];
		if ($item["PREVIEW_PICTURE"] > 0) {
			$file = CFile::ResizeImageGet($item["PREVIEW_PICTURE"], array('width' => 370, 'height' => 439), BX_RESIZE_IMAGE_PROPORTIONAL, true);
			$arSpec["PREVIEW_PICTURE"] = $file['src'];
		}
		$arResult['SPECIALISTS'][$item["PROPERTY_DEPARTMENT_VALUE"]][] = $arSpec;
	}
}
