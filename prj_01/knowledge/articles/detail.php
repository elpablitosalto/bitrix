<?
define('PAGE_TYPE', 3);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Статья");
$APPLICATION->SetPageProperty("PAGE_BODY_CLASS", 'dp-page-card');
$APPLICATION->SetPageProperty("PAGE_SECTION_CLASS", 'card');
?>
<?
if ($GLOBALS['arUser']['isPartner'] || $GLOBALS['arUser']['isAdmin']) {
?>
<? $APPLICATION->IncludeComponent(
		"bitrix:news.detail",
		"knowledge_articles",
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
			"IBLOCK_TYPE" => 'knowledge',
			"IBLOCK_ID" => Indexis::getIblockId('articles', 'knowledge'),
			"ELEMENT_ID" => "",
			"ELEMENT_CODE" => $_GET['ELEMENT_CODE'],
			"CHECK_DATES" => "Y",
			"FIELD_CODE" => array("ID", 'NAME', 'DETAIL_PICTURE', 'DETAIL_TEXT', 'IBLOCK_SECTION_ID', 'ACTIVE_FROM'),
			"PROPERTY_CODE" => array('SUB_HEADER'),
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