<?
define('PAGE_TYPE', 4);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
//$APPLICATION->SetTitle("Документация и обучение по оборудованию");
//$APPLICATION->SetPageProperty("PAGE_SECTION_CLASS", 'equipment');
//$APPLICATION->SetPageProperty("PAGE_H1", 'Документация и обучение по оборудованию Dirui');
?>

<?
if ($GLOBALS['arUser']['isPartner'] || $GLOBALS['arUser']['isAdmin']) {
?>

<? $APPLICATION->IncludeComponent(
		"bitrix:news.detail",
		"equipment_doc",
		array(
			"DISPLAY_DATE" => "N",
			"DISPLAY_NAME" => "N",
			"DISPLAY_PICTURE" => "Y",
			"DISPLAY_PREVIEW_TEXT" => "N",
			"USE_SHARE" => "N",
			"SHARE_HIDE" => "Y",
			"SHARE_TEMPLATE" => "",
			"SHARE_HANDLERS" => array("delicious"),
			"SHARE_SHORTEN_URL_LOGIN" => "",
			"SHARE_SHORTEN_URL_KEY" => "",
			"AJAX_MODE" => "N",
			"IBLOCK_TYPE" => '1c_catalog',
			"IBLOCK_ID" => Indexis::getIblockId("catalog", "1c_catalog", "s1"),
			"ELEMENT_ID" => $_GET['ELEMENT_ID'],
			"ELEMENT_CODE" => "",
			"CHECK_DATES" => "Y",
			"FIELD_CODE" => array("ID", 'NAME', 'DETAIL_PICTURE', 'DETAIL_TEXT', 'IBLOCK_SECTION_ID', 'DETAIL_PAGE_URL'),
			"PROPERTY_CODE" => array(),
			"IBLOCK_URL" => "news.php?ID=#IBLOCK_ID#\"",
			"DETAIL_URL" => "",
			"SET_TITLE" => "Y",
			"SET_CANONICAL_URL" => "Y",
			"SET_BROWSER_TITLE" => "Y",
			"BROWSER_TITLE" => "-",
			"SET_META_KEYWORDS" => "Y",
			"META_KEYWORDS" => "-",
			"SET_META_DESCRIPTION" => "Y",
			"META_DESCRIPTION" => "-",
			"SET_STATUS_404" => "N",
			"SET_LAST_MODIFIED" => "N",
			"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
			"ADD_SECTIONS_CHAIN" => "N",
			"ADD_ELEMENT_CHAIN" => "Y",
			"ACTIVE_DATE_FORMAT" => "d.m.Y",
			"USE_PERMISSIONS" => "N",
			"GROUP_PERMISSIONS" => array("1"),
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "3600",
			"CACHE_GROUPS" => "Y",
			"DISPLAY_TOP_PAGER" => "N",
			"DISPLAY_BOTTOM_PAGER" => "N",
			"PAGER_TITLE" => "Страница",
			"PAGER_TEMPLATE" => "",
			"PAGER_SHOW_ALL" => "N",
			"PAGER_BASE_LINK_ENABLE" => "Y",
			"SHOW_404" => "N",
			"MESSAGE_404" => "",
			"STRICT_SECTION_CHECK" => "Y",
			"PAGER_BASE_LINK" => "",
			"PAGER_PARAMS_NAME" => "arrPager",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"AJAX_OPTION_HISTORY" => "N",

			// Мои параметры -->
			'LIST_URL' => '/materials/',
			// <-- Мои параметры
		)
	); ?>

<? $APPLICATION->IncludeComponent(
		"bitrix:form.result.new",
		"callback",
		array(
			"SEF_MODE" => "N",
			"WEB_FORM_ID" => 1,
			"LIST_URL" => "",
			"EDIT_URL" => "",
			"SUCCESS_URL" => "",
			"CHAIN_ITEM_TEXT" => "",
			"CHAIN_ITEM_LINK" => "",
			"IGNORE_CUSTOM_TEMPLATE" => "Y",
			"USE_EXTENDED_ERRORS" => "Y",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "3600",
			"VARIABLE_ALIASES" => array(),
			"AJAX_MODE" => "Y",
			"AJAX_OPTION_SHADOW" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"AJAX_OPTION_HISTORY" => "N",
		)
	); ?>

<? } else { ?>
    <? if (!$GLOBALS['arUser']['isAuthorized']) { ?>
        <? $APPLICATION->IncludeComponent(
			"bitrix:system.auth.form",
			"popup",
			array(
				"REGISTER_URL" => "register.php",
				"FORGOT_PASSWORD_URL" => "",
				"PROFILE_URL" => "profile.php",
				"SHOW_ERRORS" => "Y",
				"CHECK_AUTH" => "Y",
			)
		); ?>
    <? } else {
	?>
        <? $APPLICATION->IncludeComponent(
			"bitrix:main.include",
			"",
			array(
				"AREA_FILE_SHOW" => "file",
				"PATH" => SITE_TEMPLATE_PATH . "/include/blocks/common/reg_partner.php"
			)
		); ?>
        <?
	} ?>
<? } ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>