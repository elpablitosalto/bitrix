<?php
$arResult["GALLERY"] = Array();


if(!empty($arResult["PROPERTIES"]["GALLERY"]["VALUE"])) {
	foreach($arResult["PROPERTIES"]["GALLERY"]["VALUE"] as $imageId) {
		$preview = CFile::ResizeImageGet(
			$imageId,
			Array("width" => 520, "height" => 756),
			BX_RESIZE_IMAGE_PROPORTIONAL_ALT , true
		);
		$detail = CFile::ResizeImageGet(
			$imageId,
			Array("width" => 1040, "height" => 1512),
			BX_RESIZE_IMAGE_PROPORTIONAL_ALT , true
		);
		$arResult["GALLERY"][] = Array(
			"PREVIEW" => $preview,
			"DETAIL" => $detail
		);
	}
}
