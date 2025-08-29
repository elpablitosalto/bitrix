<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
$pictureID = 0;
if($arResult["DETAIL_PICTURE"]["ID"] > 0){
	$pictureID = $arResult["DETAIL_PICTURE"]["ID"];
} elseif ($arResult["PREVIEW_PICTURE"]["ID"] > 0) {
	$pictureID = $arResult["PREVIEW_PICTURE"]["ID"];
	$arResult["DETAIL_PICTURE"]["ALT"] = $arResult["PREVIEW_PICTURE"]["ALT"];
	$arResult["DETAIL_PICTURE"]["TITLE"] = $arResult["PREVIEW_PICTURE"]["TITLE"];

}
if($pictureID > 0){
	$file = CFile::ResizeImageGet($pictureID, array('width'=>438, 'height'=>560), BX_RESIZE_IMAGE_PROPORTIONAL, true);
    $arResult["DETAIL_PICTURE"]["DETAIL_PICTURE_RESIZED"] = $file['src'];
}
if($arResult["DISPLAY_PROPERTIES"]["BIRTH_DATE"]["VALUE"]){
	$arResult["DISPLAY_PROPERTIES"]["BIRTH_DATE"]["DISPLAY_VALUE"] = intdiv (time() - MakeTimeStamp($arResult["DISPLAY_PROPERTIES"]["BIRTH_DATE"]["VALUE"]), (60*60*24*365));
}

\Bitrix\Main\Loader::includeModule('dev2fun.opengraph');
\Dev2fun\Module\OpenGraph::Show($arResult['ID'],'element');

?>