<?php
foreach($arResult["ITEMS"] as $index => &$arItem) {
	$arItem["NAME"] = htmlspecialcharsbx($arItem["NAME"]);
	$arItem["DESCRIPTION"] = !empty($arItem["PROPERTIES"]["DESCRIPTION"]["VALUE"]) ? $arItem["PROPERTIES"]["DESCRIPTION"]["VALUE"] : "";
	$arItem["SHOW_FORM_BUTTON"] = $arItem["PROPERTIES"]["SHOW_FORM_BUTTON"]["VALUE_XML_ID"] === "Y" ? true : false;
	$arItem["CLASS_LIST"] = "";

	$arResult["IMAGE"] = [];

	if(!empty($arItem["PROPERTIES"]["IMAGE"]["VALUE"])) {
		$renderImage = CFile::ResizeImageGet(
			$arItem["PROPERTIES"]["IMAGE"]["VALUE"],
			Array("width" => 1160),
			BX_RESIZE_IMAGE_PROPORTIONAL_ALT , true
		);
		$arItem["IMAGE"]["DEFAULT"] = [
			"SRC" => $renderImage["src"],
			"ALT" => strip_tags($arItem["NAME"])
		];

		$arItem["IMAGE"]["SOURCES"] = [];
		$arMedia = [
			"IMAGE_XS" => "(max-width: 379px)",
			"IMAGE_S" => "(max-width: 767px)",
			"IMAGE_M" => "(max-width: 1024px)"
		];

		$arSources = [
			"IMAGE_XS" => $arItem["PROPERTIES"]["IMAGE_XS"]["VALUE"],
			"IMAGE_S" => $arItem["PROPERTIES"]["IMAGE_S"]["VALUE"],
			"IMAGE_M" => $arItem["PROPERTIES"]["IMAGE_M"]["VALUE"],
		];

		foreach($arSources as $key => $imageId) {
			if(!empty($imageId)) {
				$renderImage = CFile::ResizeImageGet(
					$arItem["PROPERTIES"]["IMAGE"]["VALUE"],
					Array("width" => 1160),
					BX_RESIZE_IMAGE_PROPORTIONAL_ALT , true
				);

				$arItem["IMAGE"]["SOURCES"][] = [
					"MEDIA" => $arMedia[$key],
					"SRC" => $renderImage["src"]
				];

			}
		}
	}

	$arItem["LIST"] = [];
	if(!empty($arItem["PROPERTIES"]["LIST"]["VALUE"])) {
		$arItem["LIST"] = $arItem["PROPERTIES"]["LIST"]["VALUE"];

	}
	if ($index !== 4 && $index !== 5) {
		$arItem["CLASS_LIST"] = !empty($arItem["LIST"]) ? "list-panel_image-position_m-static" : "list-panel_image-role_decoration";
	}
}