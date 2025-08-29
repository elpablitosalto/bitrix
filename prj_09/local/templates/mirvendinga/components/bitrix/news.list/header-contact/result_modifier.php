<?php

$arResult['GROUPS'] = [];

if($arResult['ITEMS']) {
	foreach($arResult['ITEMS'] as $arItem) {
		if(!empty($arItem['PROPERTIES']['TYPE']['VALUE_XML_ID'])) {
			$type = $arItem['PROPERTIES']['TYPE']['VALUE_XML_ID'];

			$arResult['GROUPS'][$type][] = $arItem;
		}
	}
}