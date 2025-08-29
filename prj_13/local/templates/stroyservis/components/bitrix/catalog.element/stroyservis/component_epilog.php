<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
	die();
}

use Bitrix\Main\Loader;

/**
 * @var array $templateData
 * @var array $arParams
 * @var string $templateFolder
 * @global CMain $APPLICATION
 */

global $APPLICATION;

$GLOBALS['PRODUCT_NAME'] = $arResult['NAME'];
?>

<? if ($arResult['CAN_ORDER_CUSTOM'] == 'Y') {
	$GLOBALS['SHOW_FORM_PRODUCT_ON_ORDER'] = 'Y';
?>
	<?/*?>
	<? $APPLICATION->IncludeComponent(
		"bitrix:form.result.new",
		"product_on_order",
		array(
			"SEF_MODE" => "N",
			"WEB_FORM_ID" => $GLOBALS["arSiteConfig"]["WEB_FORM_ID_PRODUCT_ON_ORDER"],
			//"LIST_URL" => "result_list.php",
			"LIST_URL" => "",
			//"EDIT_URL" => "result_edit.php",
			"EDIT_URL" => "",
			"SUCCESS_URL" => "",
			"CHAIN_ITEM_TEXT" => "",
			"CHAIN_ITEM_LINK" => "",
			"IGNORE_CUSTOM_TEMPLATE" => "Y",
			"USE_EXTENDED_ERRORS" => "Y",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "3600",
			"SEF_FOLDER" => "/",
			"VARIABLE_ALIASES" => array(),
			'PRODUCT_NAME' => array(
				'VALUE' => $arResult['NAME'],
				'AUTOCOMPLETE' => 'Y'
			),
			"AJAX_MODE" => "N",
		)
	); ?>
	<?*/ ?>
<? } ?>
<? if ($arResult['CAN_BUY_ORDER_CUSTOM'] == 'Y') {
	$GLOBALS['SHOW_FORM_REQUEST_WHOLESALE_PRICE'] = 'Y';
?>
	<?/*?>
	<? $APPLICATION->IncludeComponent(
		"bitrix:form.result.new",
		"request_wholesale_price",
		array(
			"SEF_MODE" => "N",
			"WEB_FORM_ID" => $GLOBALS["arSiteConfig"]["WEB_FORM_ID_REQUEST_WHOLESALE_PRICE"],
			//"LIST_URL" => "result_list.php",
			"LIST_URL" => "",
			//"EDIT_URL" => "result_edit.php",
			"EDIT_URL" => "",
			"SUCCESS_URL" => "",
			"CHAIN_ITEM_TEXT" => "",
			"CHAIN_ITEM_LINK" => "",
			"IGNORE_CUSTOM_TEMPLATE" => "Y",
			"USE_EXTENDED_ERRORS" => "Y",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "3600",
			"SEF_FOLDER" => "/",
			"VARIABLE_ALIASES" => array(),
			'PRODUCT_NAME' => array(
				'VALUE' => $arResult['NAME'],
				'AUTOCOMPLETE' => 'Y'
			),
			"AJAX_MODE" => "N",
		)
	); ?>
	<?*/ ?>
<? } ?>
<? if ($arResult['OUT_OF_PRODUCTION'] == 'Y' || $arResult['NOT_AVAILABLE'] == 'Y') {

	$GLOBALS['SHOW_FORM_CHOOSE_ANALOGUE'] = 'Y';
?>
	<?/*?>
	<? $APPLICATION->IncludeComponent(
		"bitrix:form.result.new",
		"choose_analogue",
		array(
			"SEF_MODE" => "N",
			"WEB_FORM_ID" => $GLOBALS["arSiteConfig"]["WEB_FORM_ID_CHOOSE_ANALOGUE"],
			//"LIST_URL" => "result_list.php",
			"LIST_URL" => "",
			//"EDIT_URL" => "result_edit.php",
			"EDIT_URL" => "",
			"SUCCESS_URL" => "",
			"CHAIN_ITEM_TEXT" => "",
			"CHAIN_ITEM_LINK" => "",
			"IGNORE_CUSTOM_TEMPLATE" => "Y",
			"USE_EXTENDED_ERRORS" => "Y",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "3600",
			"SEF_FOLDER" => "/",
			"VARIABLE_ALIASES" => array(),
			'PRODUCT_NAME' => array(
				'VALUE' => $arResult['NAME'],
				'AUTOCOMPLETE' => 'Y'
			),
			"AJAX_MODE" => "N",
		)
	); ?>
	<?*/ ?>
<? } ?>

<?
if (!isset($arResult["arProductsGroup"]) || !is_array($arResult["arProductsGroup"]))
	$arResult["arProductsGroup"] = [];
?>

<script>
	window.arProductsGroup = <?=json_encode($arResult["arProductsGroup"])?>
</script>
