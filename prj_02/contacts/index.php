<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Контакты и реквизиты");
?>
<div class="page-content contacts-page" itemscope itemtype="http://schema.org/Organization">
	<? $APPLICATION->IncludeComponent(
		"bitrix:main.include",
		"",
		array(
			"AREA_FILE_SHOW" => "sect",
			"AREA_FILE_SUFFIX" => "inc",
			"AREA_FILE_RECURSIVE" => "Y",
			"EDIT_TEMPLATE" => ""
		)
	); ?>
	<? $APPLICATION->IncludeComponent(
		"bitrix:news.detail",
		"contacts_detail",
		array(
			"ACTIVE_DATE_FORMAT" => "d.m.Y",
			"ADD_ELEMENT_CHAIN" => "N",
			"ADD_SECTIONS_CHAIN" => "N",
			"AJAX_MODE" => "N",
			"AJAX_OPTION_ADDITIONAL" => "",
			"AJAX_OPTION_HISTORY" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"BROWSER_TITLE" => "-",
			"CACHE_GROUPS" => "Y",
			"CACHE_TIME" => "36000000",
			"CACHE_TYPE" => "A",
			"CHECK_DATES" => "Y",
			"DETAIL_URL" => "",
			"DISPLAY_BOTTOM_PAGER" => "Y",
			"DISPLAY_DATE" => "Y",
			"DISPLAY_NAME" => "Y",
			"DISPLAY_PICTURE" => "Y",
			"DISPLAY_PREVIEW_TEXT" => "Y",
			"DISPLAY_TOP_PAGER" => "N",
			"ELEMENT_CODE" => "contacts",
			"ELEMENT_ID" => "",
			"FIELD_CODE" => array("", ""),
			"IBLOCK_ID" => Indexis::getIblockId("contacts", "content", "s1"),
			"IBLOCK_TYPE" => "content",
			"IBLOCK_URL" => "",
			"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
			"MESSAGE_404" => "",
			"META_DESCRIPTION" => "-",
			"META_KEYWORDS" => "-",
			"PAGER_BASE_LINK_ENABLE" => "N",
			"PAGER_SHOW_ALL" => "N",
			"PAGER_TEMPLATE" => ".default",
			"PAGER_TITLE" => "Страница",
			"PROPERTY_CODE" => array("LONGITUDE", "BALLOON_HEADER", "LATITUDE", "ADDRESS", "PHONE_911", "PHONE_INFO", "EMAIL", "VK_LINK", "YOUTUBE_LINK"),
			"SET_BROWSER_TITLE" => "N",
			"SET_CANONICAL_URL" => "N",
			"SET_LAST_MODIFIED" => "N",
			"SET_META_DESCRIPTION" => "N",
			"SET_META_KEYWORDS" => "Y",
			"SET_STATUS_404" => "N",
			"SET_TITLE" => "N",
			"SHOW_404" => "N",
			"STRICT_SECTION_CHECK" => "N",
			"USE_PERMISSIONS" => "N",
			"USE_SHARE" => "N"
		)
	); ?>
	<? $APPLICATION->IncludeComponent(
		"indexis:ajax.form",
		"contacts_callback",
		array(
			"IBLOCK_ID" => Indexis::getIblockId("contacts_callback", "requests", "s1"),
			"IBLOCK_TYPE" => "requests",
			"CREATE_LEAD" => "Связаться с фондом (контакты)",
			"CHECK_CAPTCHA" => "Y",
			"FIELDS" => [
				"NAME" => ["CLEAR", "NOT_EMPTY", "TEXT"],
				"PREVIEW_TEXT" => ["CLEAR", "NOT_EMPTY", "TEXT"],
				"PROPERTY_EMAIL" => ["CLEAR", "NOT_EMPTY", "TEXT", "EMAIL"],
				"PROPERTY_PHONE" => ["CLEAR", "NOT_EMPTY", "PHONE"],
			],
			"SEND_MESSAGE" => "CONTACTS_CALLBACK",
			"HANDLERS" => [
				"AGREE" => [
					"method_name" => "check_value",
					"method_params" => [
						"VALUE" => "y",
						"TO" => "MAIN",
						"ERROR" => "Необходимо принять условия политики конфидициальности",
					]
				]
			],
		)
	); ?>
</div>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>