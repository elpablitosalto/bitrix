<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */


foreach ($arResult["ITEMS"] as &$arItem) {
	//vardump($arItem);
	if ($arItem["DETAIL_PICTURE"]["ID"] > 0) {
		$file = CFile::ResizeImageGet(
			$arItem["DETAIL_PICTURE"]["ID"],
			array('width' => 347, 'height' => 200),
			BX_RESIZE_IMAGE_PROPORTIONAL,
			true
		);
		$arItem["DETAIL_PICTURE"]["DETAIL_PICTURE_RESIZED"] = $file['src'];
	} else if ($arItem["PREVIEW_PICTURE"]["ID"] > 0) {
		$file = CFile::ResizeImageGet(
			$arItem["PREVIEW_PICTURE"]["ID"],
			array('width' => 347, 'height' => 200),
			BX_RESIZE_IMAGE_PROPORTIONAL,
			true
		);
		$arItem["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"] = $file['src'];
	} else {
		//$_SERVER["DOCUMENT_ROOT"]
		$file_path = SITE_TEMPLATE_PATH . "/img/content/news/notfound.png";
		//echo "file_path = " . $file_path . "<br />";

		$arItem["NOT_FOUND_PICTURE_HTML"] = CFile::ShowImage(
			$file_path,
			347,
			200,
			"border=0",
			"",
			false
		);

		//echo "NOT_FOUND_PICTURE_HTML = ".$arItem["NOT_FOUND_PICTURE_HTML"]."<br />";
	}
}
