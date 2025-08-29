<?php
$arResult["ITEMS"] = Array();
$arItems= Array();
$filter = array_column($arResult["SEARCH"], "ITEM_ID");

if(count($arResult["SEARCH"]) > 0) {
	$arSelect = Array("ID", "IBLOCK_ID", "CODE", "NAME");
	$arFilter = Array("ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "ID" => $filter);
	$res = CIblockElement::GetList(Array("DATE_CREATE" => "DESC"), $arFilter, false, Array("nPageSize"=>count($filter)), $arSelect);

	while($ob = $res->GetNextElement()) {
		$arItem = $ob->GetFields();
		$arItem['PROPERTIES'] = $ob->GetProperties();
		$arItems[$arItem["ID"]] = $arItem;
	}

	foreach($arResult["SEARCH"] as $key => $arItem) {
		if(!empty($arItems[$arItem["ITEM_ID"]])) {
			$arResult["ITEMS"][$key] = $arItems[$arItem["ITEM_ID"]];
			$arResult["ITEMS"][$key]["DETAIL_PAGE_URL"] = $arItem["URL"];
			$groups = CIBlockElement::GetElementGroups($arItem["ITEM_ID"], false);

			while($arGroup = $groups->GetNext()) {
				$arResult["ITEMS"][$key]["SECTIONS"][] = $arGroup;
			}
		}
	}
}