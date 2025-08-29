<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
?>
<section class="benefit" id="form-wholesale-purchase">
	<div class="benefit__content">
		<?$APPLICATION->ShowViewContent("form_intro_" . $GLOBALS["arSiteConfig"]["WEB_FORM_ID_WHOLESALE_PURCHASE"])?>
	</div>
	<?
	$APPLICATION->IncludeComponent(
		"bitrix:form.result.new",
		"meeting",
		array(
			"SEF_MODE" => "N",
			"WEB_FORM_ID" => $GLOBALS["arSiteConfig"]["WEB_FORM_ID_WHOLESALE_PURCHASE"],
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
			"AJAX_MODE" => "N",
		)
	);
	?>
</section>
