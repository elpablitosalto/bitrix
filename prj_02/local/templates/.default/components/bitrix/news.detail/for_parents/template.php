<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
//CJSCore::Init(array('clipboard'));
//$this->AddEditAction($arResult['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
//$this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

?>
<div class="page-content for-parents-page" id="<?= $this->GetEditAreaId($arResult['ID']); ?>">
	<div class="page-head">
		<div class="container">
			<div class="section__head-block">
				<? $APPLICATION->IncludeComponent(
					"bitrix:breadcrumb",
					"",
					array(),
					false
				); ?>
				<h1 class="page-title"><? $APPLICATION->ShowTitle(false) ?></h1>
				<p class="h5 section__desc"><?= $arResult["DISPLAY_PROPERTIES"]["TEXT"]["DISPLAY_VALUE"]; ?></p>
				<? if (strlen($arResult["DISPLAY_PROPERTIES"]["PICTURE"]["FILE_VALUE"]["SRC"]) > 0) { ?>
					<picture class="section__head-pattern">
						<img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= $arResult["DISPLAY_PROPERTIES"]["PICTURE"]["FILE_VALUE"]["SRC"]; ?>" loading="lazy" alt="parents" title="parents" />
					</picture>
				<? } ?>
			</div>
		</div>
	</div>
	<section class="for-parents-we-do">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-xxl-6">
					<div class="for-parents-we-do__left">
						<h3 class="section__title"><?= $arResult["DISPLAY_PROPERTIES"]["HEADER_LEFT"]["DISPLAY_VALUE"]; ?>:</h3>
						<ul class="text-size-lg">
							<? foreach ($arResult["DISPLAY_PROPERTIES"]["LIST_LEFT"]["VALUE"] as $key => $val) { ?>
								<li><?= htmlspecialchars_decode($val); ?></li>
							<? } ?>
						</ul>
					</div>
				</div>
				<div class="col-lg-4 col-xxl-6">
					<div class="for-parents-we-do__right">
						<h3 class="section__title"><?= $arResult["DISPLAY_PROPERTIES"]["HEADER_RIGHT"]["DISPLAY_VALUE"]; ?>:</h3>
						<ul class="text-size-lg">
							<? foreach ($arResult["DISPLAY_PROPERTIES"]["LIST_RIGHT"]["VALUE"] as $key => $val) { ?>
								<li><?= htmlspecialchars_decode($val); ?></li>
							<? } ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
	<? if (!empty($arResult["DISPLAY_PROPERTIES"]["PHOTOS"]["FILE_VALUE"])) { ?>
		<section class="for-parents-gallery">
			<div class="container">
				<div class="for-parents-gallery-slider">
					<div class="section__head">
						<div class="section__nav">
							<div class="swiper-nav lg">
								<button type="button" class="swiper-button prev">
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-drop-light">
										<use xlink:href="#drop-light"></use>
									</svg>
								</button>
								<button type="button" class="swiper-button next">
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-drop-light">
										<use xlink:href="#drop-light"></use>
									</svg>
								</button>
							</div>
							<div class="swiper-nav">
								<button type="button" class="swiper-button prev">
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-drop">
										<use xlink:href="#drop"></use>
									</svg>
								</button>
								<button type="button" class="swiper-button next">
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-drop">
										<use xlink:href="#drop"></use>
									</svg>
								</button>
							</div>
						</div>
					</div>
					<div class="items-list swiper-container">
						<div class="swiper-wrapper">
							<? foreach ($arResult["DISPLAY_PROPERTIES"]["PHOTOS"]["FILE_VALUE"] as $key => $val) { ?>
								<div class="swiper-slide">
									<a href="<?= $val["SRC"]; ?>" data-fancybox="for-parents-gallery" class="list-item for-parents-gallery-item">
										<picture>
											<img class="lazyload" src="images/loader.svg" data-src="<?= $val["SRC"]; ?>" loading="lazy" alt="" title="" />
										</picture>
									</a>
								</div>
							<? } ?>
						</div>
					</div>
				</div>
			</div>
		</section>
	<? } ?>
	<?
	// Фильтр для списка мероприятий -->
	$obj = CIBlockPropertyEnum::GetList(
		array(),
		array(
			"IBLOCK_ID" => Indexis::getIblockId("news", "content"),
			"XML_ID" => "ANNOUNCEMENTS"
		)
	);
	$ar = $obj->GetNext();
	$val = $ar["ID"];
	//echo "val = ".$val."<br />";
	if (intval($val) > 0) {
		$GLOBALS["arrFillter_for_parents_news"]["PROPERTY_PUBLICATION_TYPE"] = $val;
	}

	$GLOBALS["arrFillter_for_parents_news"]["PROPERTY_AUDIENCE_TYPE"] = "family";

	$GLOBALS["arrFillter_for_parents_news"][">=PROPERTY_EVENT_DATE"] = date( "Y-m-d" );

	//vardump($GLOBALS["arrFillter_for_parents_news"]);
	// <--
	?>
	<? $APPLICATION->IncludeComponent(
		"bitrix:news.list",
		"for_parents_news",
		array(
			"DISPLAY_DATE" => "Y",
			"DISPLAY_NAME" => "Y",
			"DISPLAY_PICTURE" => "Y",
			"DISPLAY_PREVIEW_TEXT" => "Y",
			"AJAX_MODE" => "N",
			"IBLOCK_TYPE" => "content",
			"IBLOCK_ID" => Indexis::getIblockId("news", "content"),
			"NEWS_COUNT" => "100",
			"SORT_BY1" => "PROPERTY_EVENT_DATE",
			"SORT_ORDER1" => "ASC",
			"SORT_BY2" => "SORT",
			"SORT_ORDER2" => "ASC",
			"FILTER_NAME" => "arrFillter_for_parents_news",
			"FIELD_CODE" => array("TAGS"),
			"PROPERTY_CODE" => array("EVENT_DATE", "EVENT_TIME"),
			"CHECK_DATES" => "Y",
			"DETAIL_URL" => "",
			"PREVIEW_TRUNCATE_LEN" => "",
			"ACTIVE_DATE_FORMAT" => "d.m.Y",
			"SET_TITLE" => "N",
			"SET_BROWSER_TITLE" => "N",
			"SET_META_KEYWORDS" => "N",
			"SET_META_DESCRIPTION" => "N",
			"SET_LAST_MODIFIED" => "N",
			"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
			"ADD_SECTIONS_CHAIN" => "N",
			"HIDE_LINK_WHEN_NO_DETAIL" => "Y",
			"PARENT_SECTION" => "",
			"PARENT_SECTION_CODE" => "",
			"INCLUDE_SUBSECTIONS" => "Y",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "3600",
			"CACHE_FILTER" => "Y",
			"CACHE_GROUPS" => "Y",
			"DISPLAY_TOP_PAGER" => "N",
			"DISPLAY_BOTTOM_PAGER" => "N",
			"PAGER_TITLE" => "Новости",
			"PAGER_SHOW_ALWAYS" => "Y",
			"PAGER_TEMPLATE" => "",
			"PAGER_DESC_NUMBERING" => "Y",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
			"PAGER_SHOW_ALL" => "Y",
			"PAGER_BASE_LINK_ENABLE" => "Y",
			"SET_STATUS_404" => "Y",
			"SHOW_404" => "Y",
			"MESSAGE_404" => "",
			"PAGER_BASE_LINK" => "",
			"PAGER_PARAMS_NAME" => "arrPager",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"AJAX_OPTION_HISTORY" => "N",
			"AJAX_OPTION_ADDITIONAL" => ""
		)
	); ?>
	<section class="for-parents-media">
		<div class="container">
			<div class="section__head-block">
				<div class="row">
					<div class="col-lg-4 col-xxl-6">
						<h3 class="section__title">Материалы для родителей</h3>
					</div>
					<div class="col-lg-8 col-xxl-6">
						<div class="text-size-lg section__desc">
							<?= $arResult["DISPLAY_PROPERTIES"]["TEXT_MEDIA"]["DISPLAY_VALUE"]; ?>
						</div>
					</div>
				</div>
			</div>
			<? if (!empty($arResult["arMediaThemes"])) { ?>
				<div class="section-tags">
					<div class="text-size-lg title">Темы для родителей:</div>
					<div class="tags-container tags-slider">
						<div class="buttons-line">
							<? foreach ($arResult["arMediaThemes"] as $key => $val) { ?>
								<a href="<?= $val["LINK"]; ?>" class="btn btn-transparent tag">#<?= $val["NAME"]; ?></a>
							<? } ?>
						</div>
					</div>
				</div>
			<? } ?>

			<?
			$GLOBALS["arrFillter_for_parents_media"]["SECTION_CODE"] = "parents";
			?>
			<?
			$news = $APPLICATION->IncludeComponent(
				"bitrix:news.list",
				"news_slider",
				array(
					"DISPLAY_DATE" => "Y",
					"DISPLAY_NAME" => "Y",
					"DISPLAY_PICTURE" => "Y",
					"DISPLAY_PREVIEW_TEXT" => "Y",
					"AJAX_MODE" => "N",
					"ALL_NAME" => "Все новости",
					"BLOCK_NAME" => "Новости проекта",
					"IBLOCK_TYPE" => "content",
					"IBLOCK_ID" => Indexis::getIblockId("materials", "content"),
					"NEWS_COUNT" => "100",
					"SORT_BY1" => "ACTIVE_FROM",
					"SORT_ORDER1" => "DESC",
					"SORT_BY2" => "SORT",
					"SORT_ORDER2" => "ASC",
					"FILTER_NAME" => "arrFillter_for_parents_media",
					"FIELD_CODE" => array("PREVIEW_PICTURE"),
					"PROPERTY_CODE" => array("PUBLIC_DATE", "PUBLICATION_TYPE", "SHOW_TYPE", "BACKG_COLOR"),
					"CHECK_DATES" => "Y",
					"DETAIL_URL" => "",
					"PREVIEW_TRUNCATE_LEN" => "",
					"ACTIVE_DATE_FORMAT" => "d F Y",
					"SET_TITLE" => "N",
					"SET_BROWSER_TITLE" => "N",
					"SET_META_KEYWORDS" => "N",
					"SET_META_DESCRIPTION" => "N",
					"SET_LAST_MODIFIED" => "N",
					"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
					"ADD_SECTIONS_CHAIN" => "N",
					"HIDE_LINK_WHEN_NO_DETAIL" => "Y",
					"PARENT_SECTION" => "",
					"PARENT_SECTION_CODE" => "",
					"INCLUDE_SUBSECTIONS" => "Y",
					"CACHE_TYPE" => "A",
					"CACHE_TIME" => "360000",
					"CACHE_FILTER" => "Y",
					"CACHE_GROUPS" => "Y",
					"DISPLAY_TOP_PAGER" => "N",
					"DISPLAY_BOTTOM_PAGER" => "N",
					"PAGER_TITLE" => "Новости",
					"PAGER_SHOW_ALWAYS" => "N",
					"PAGER_TEMPLATE" => "",
					"PAGER_DESC_NUMBERING" => "Y",
					"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
					"PAGER_SHOW_ALL" => "N",
					"PAGER_BASE_LINK_ENABLE" => "Y",
					"SET_STATUS_404" => "N",
					"SHOW_404" => "N",
					"MESSAGE_404" => "",
					"PAGER_BASE_LINK" => "",
					"PAGER_PARAMS_NAME" => "",
					"AJAX_OPTION_JUMP" => "N",
					"AJAX_OPTION_STYLE" => "Y",
					"AJAX_OPTION_HISTORY" => "N",
					"AJAX_OPTION_ADDITIONAL" => "",
					"HEADER" => "",
					"MORE_LINK_TITLE" => "Больше медиа",
					"MORE_URL" => "/media/parents/",
				)
			);
			?>
		</div>
	</section>
	<? $APPLICATION->IncludeComponent(
		"indexis:ajax.form",
		"good_man_callback",
		array(
			"IBLOCK_ID" => Indexis::getIblockId("good_man_callback", "requests", "s1"),
			"IBLOCK_TYPE" => "requests",
			"CREATE_LEAD" => "Как вырастить хорошего человека",
			"FIELDS" => [
				"NAME" => ["CLEAR", "NOT_EMPTY", "EMAIL"],
			],
			"CHECK_CAPTCHA" => "Y",
			"SEND_MESSAGE" => "GOOD_MAN_CALLBACK",
		)
	); ?>
	<section class="for-parents-projects">
		<?
		// Сопоставляться должны значения свойства “Тип аудитории” и значения свойства “Тип благополучателей” у проекта. -->
		$obj = CIBlockPropertyEnum::GetList(
			array(),
			array(
				"IBLOCK_ID" => Indexis::getIblockId("projects", "content"),
				"XML_ID" => "family"
			)
		);
		$ar = $obj->GetNext();
		$val = $ar["ID"];
		if (intval($val) > 0) {
			$GLOBALS["arrFillter_for_parents_projects"]["PROPERTY_BENEFICIARY_TYPE"] = $val;
		}
		// <--
		?>
		<? $news = $APPLICATION->IncludeComponent(
			"bitrix:news.list",
			"news_detail_projects",
			array(
				"DISPLAY_DATE" => "Y",
				"DISPLAY_NAME" => "Y",
				"DISPLAY_PICTURE" => "Y",
				"DISPLAY_PREVIEW_TEXT" => "Y",
				"AJAX_MODE" => "N",
				"ALL_NAME" => "Все новости",
				"BLOCK_NAME" => "Новости проекта",
				"IBLOCK_TYPE" => "content",
				"IBLOCK_ID" => Indexis::getIblockId("projects", "content", "s1"),
				"NEWS_COUNT" => "3",
				"SORT_BY1" => "RAND",
				"SORT_ORDER1" => "DESC",
				"SORT_BY2" => "SORT",
				"SORT_ORDER2" => "ASC",
				"FILTER_NAME" => "arrFillter_for_parents_projects",
				"FIELD_CODE" => array("PREVIEW_PICTURE"),
				"PROPERTY_CODE" => array("CITY", "BENEFICIARY_TYPE"),
				"CHECK_DATES" => "Y",
				"DETAIL_URL" => "",
				"PREVIEW_TRUNCATE_LEN" => "",
				"ACTIVE_DATE_FORMAT" => "d F Y",
				"SET_TITLE" => "N",
				"SET_BROWSER_TITLE" => "N",
				"SET_META_KEYWORDS" => "N",
				"SET_META_DESCRIPTION" => "N",
				"SET_LAST_MODIFIED" => "N",
				"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
				"ADD_SECTIONS_CHAIN" => "N",
				"HIDE_LINK_WHEN_NO_DETAIL" => "Y",
				"PARENT_SECTION" => "",
				"PARENT_SECTION_CODE" => "",
				"INCLUDE_SUBSECTIONS" => "Y",
				"CACHE_TYPE" => "A",
				"CACHE_TIME" => "360000",
				"CACHE_FILTER" => "Y",
				"CACHE_GROUPS" => "Y",
				"DISPLAY_TOP_PAGER" => "N",
				"DISPLAY_BOTTOM_PAGER" => "N",
				"PAGER_TITLE" => "Новости",
				"PAGER_SHOW_ALWAYS" => "N",
				"PAGER_TEMPLATE" => "",
				"PAGER_DESC_NUMBERING" => "Y",
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
				"PAGER_SHOW_ALL" => "N",
				"PAGER_BASE_LINK_ENABLE" => "Y",
				"SET_STATUS_404" => "N",
				"SHOW_404" => "N",
				"MESSAGE_404" => "",
				"PAGER_BASE_LINK" => "",
				"PAGER_PARAMS_NAME" => "",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"AJAX_OPTION_HISTORY" => "N",
				"AJAX_OPTION_ADDITIONAL" => "",
				"URL_ALL_PROJECTS" => "/projects/",
			)
		);
		?>
	</section>

	<?
	$APPLICATION->IncludeComponent(
		"indexis:ajax.form",
		"cloudpayments_pay_form_news",
		array(
			"IBLOCK_ID" => Indexis::getIblockId("pay_form", "requests", "s1"),
			"IBLOCK_TYPE" => "requests",
			"FIELDS" => [
				"PROPERTY_SUM" => ["CLEAR", "NOT_EMPTY", "NUMBER"],
			],
            "CHECK_CAPTCHA" => "Y",
			"RETURN_FIELDS" => ["PROPERTY_SUM","PROPERTY_TYPE"],
			"HANDLERS" => [
				"ACTIVE" => "N",
				"NAME" => htmlspecialcharsbx($APPLICATION->GetCurPage()),
				"AGREEMENT" => [
					"method_name" => "check_value",
					"method_params" => [
						"VALUE" => "y",
						"TO" => "MAIN",
						"ERROR" => "Необходимо принять условия политики конфидициальности",
					]
				]
			],
		)
	);
	?>
	<? $APPLICATION->IncludeComponent(
		"indexis:ajax.form",
		"contacts_callback",
		array(
			"IBLOCK_ID" => Indexis::getIblockId("contacts_callback", "requests", "s1"),
			"IBLOCK_TYPE" => "requests",
            "CREATE_LEAD" => "Связаться с фондом (для родителей)",
			"FIELDS" => [
				"NAME" => ["CLEAR", "NOT_EMPTY", "TEXT"],
				"PREVIEW_TEXT" => ["CLEAR", "NOT_EMPTY", "TEXT"],
				"PROPERTY_EMAIL" => ["CLEAR", "NOT_EMPTY", "TEXT", "EMAIL"],
				"PROPERTY_PHONE" => ["CLEAR", "NOT_EMPTY", "PHONE"],
			],
            "CHECK_CAPTCHA" => "Y",
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

	<? $APPLICATION->IncludeComponent(
		"indexis:ajax.form",
		"event_reg",
		array(
			"IBLOCK_ID" => Indexis::getIblockId("event_reg", "requests", SITE_ID),
			"IBLOCK_TYPE" => "requests",
            "CREATE_LEAD" => "Зарегистрироваться на мероприятие",
			"FIELDS" => [
				"NAME" => ["CLEAR", "NOT_EMPTY", "TEXT"],
				"PROPERTY_EMAIL" => ["CLEAR", "NOT_EMPTY", "TEXT", "EMAIL"],
				"PROPERTY_PHONE" => ["CLEAR", "NOT_EMPTY", "PHONE"],
				"PROPERTY_EVENT" => ["CLEAR", "NOT_EMPTY", "TEXT"],
				"PROPERTY_EVENT_NAME" => ["CLEAR", "NOT_EMPTY", "TEXT"],
				//"PROPERTY_TYPE" => ["NOT_EMPTY", "LIST"]
			],
            "CHECK_CAPTCHA" => "Y",
			"SEND_MESSAGE" => "REG_EVENT_CALLBACK",
			"HANDLERS" => [
				//"PROPERTY_PROJECT" => $arResult["NAME"],
				"AGREEMENT" => [
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