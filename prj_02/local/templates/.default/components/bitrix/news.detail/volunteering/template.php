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
?>
<div class="page-head">
	<div class="container">
		<? $APPLICATION->IncludeComponent(
			"bitrix:breadcrumb",
			"",
			array(),
			false
		); ?>
		<h1 class="page-title">
			<?= $arResult["DISPLAY_PROPERTIES"]["H1_1"]["VALUE"]; ?><span data-animate-to-text="<?= $arResult["DISPLAY_PROPERTIES"]["H1_3"]["VALUE"]; ?>"><?= $arResult["DISPLAY_PROPERTIES"]["H1_2"]["VALUE"]; ?></span>
		</h1>
	</div>
</div>
<div class="page-content volunteerism-page">
	<section class="page-desc">
		<div class="container">
			<div class="section__content">
				<div class="row">
					<div class="col-lg-6">
						<p class="text-size-lg">
							<?= $arResult["DISPLAY_PROPERTIES"]["TEXT_LEFT"]["DISPLAY_VALUE"]; ?>
						</p>
					</div>
					<div class="col-lg-6">
						<p class="text-size-lg">
							<?= $arResult["DISPLAY_PROPERTIES"]["TEXT_RIGHT"]["DISPLAY_VALUE"]; ?>
						</p>
					</div>
				</div>
			</div>
			<div class="section__nav"><a href="#site-callback" data-scroll-to="#site-callback" class="btn">Хочу быть
					добровольцем</a></div>
		</div>
	</section>
	<?
	//vardump($arResult["DISPLAY_PROPERTIES"]["PHOTOS"]);
	?>
	<section class="volunteerism-gallery">
		<div class="container">
			<div class="section__content">
				<div class="items-list">
					<div class="row">
						<div class="col-6">
							<div class="volunteerism-gallery__left">
								<div class="row">
									<div class="col-6 align-self-end"><a href="<?= $arResult["DISPLAY_PROPERTIES"]["PHOTOS"]["FILE_VALUE"][0]["SRC"]; ?>" data-fancybox="volunteerism-gallery" class="list-item volunteerism-gallery-item">
											<picture><img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= $arResult["DISPLAY_PROPERTIES"]["PHOTOS"]["FILE_VALUE"][0]["RESIZE_SRC"]; ?>" loading="lazy" alt="" title="" />
											</picture>
										</a></div>
									<div class="col-6"><a href="<?= $arResult["DISPLAY_PROPERTIES"]["PHOTOS"]["FILE_VALUE"][1]["SRC"]; ?>" data-fancybox="volunteerism-gallery" class="list-item volunteerism-gallery-item">
											<picture><img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= $arResult["DISPLAY_PROPERTIES"]["PHOTOS"]["FILE_VALUE"][1]["RESIZE_SRC"]; ?>" loading="lazy" alt="" title="" />
											</picture>
										</a></div>
									<div class="col-12"><a href="<?= $arResult["DISPLAY_PROPERTIES"]["PHOTOS"]["FILE_VALUE"][2]["SRC"]; ?>" data-fancybox="volunteerism-gallery" class="list-item volunteerism-gallery-item">
											<picture><img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= $arResult["DISPLAY_PROPERTIES"]["PHOTOS"]["FILE_VALUE"][2]["RESIZE_SRC"]; ?>" loading="lazy" alt="" title="" />
											</picture>
										</a></div>
								</div>
							</div>
						</div>
						<div class="col-6">
							<div class="volunteerism-gallery__right">
								<div class="row">
									<div class="col-12"><a href="<?= $arResult["DISPLAY_PROPERTIES"]["PHOTOS"]["FILE_VALUE"][3]["SRC"]; ?>" data-fancybox="volunteerism-gallery" class="list-item volunteerism-gallery-item">
											<picture>
												<img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= $arResult["DISPLAY_PROPERTIES"]["PHOTOS"]["FILE_VALUE"][3]["RESIZE_SRC"]; ?>" loading="lazy" alt="" title="" />
											</picture>
										</a>
									</div>
									<div class="col-9 col-lg-7"><a href="<?= $arResult["DISPLAY_PROPERTIES"]["PHOTOS"]["FILE_VALUE"][4]["SRC"]; ?>" data-fancybox="volunteerism-gallery" class="list-item volunteerism-gallery-item">
											<picture>
												<img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= $arResult["DISPLAY_PROPERTIES"]["PHOTOS"]["FILE_VALUE"][4]["RESIZE_SRC"]; ?>" loading="lazy" alt="" title="" />
											</picture>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<? if (strlen($arResult["DISPLAY_PROPERTIES"]["PICTURE"]["FILE_VALUE"]["SRC"]) > 0) { ?>
					<picture class="volunteerism-gallery__pattern">
						<img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= $arResult["DISPLAY_PROPERTIES"]["PICTURE"]["FILE_VALUE"]["SRC"]; ?>" loading="lazy" alt="" title="" />
					</picture>
				<? } ?>
			</div>
		</div>
	</section>
	<? if (!empty($arResult["DISPLAY_PROPERTIES"]["STEPS_HOW_TOBE"]["VALUE"])) { ?>
		<section id="volunteerism-how-to" class="volunteerism-how-to">
			<div class="container">
				<h3 class="section__title">Как стать добровольцем?</h3>
				<ol class="text-size-lg items-list">
					<? foreach ($arResult["DISPLAY_PROPERTIES"]["STEPS_HOW_TOBE"]["VALUE"] as $key => $val) { ?>
						<li class="list-item"><?= htmlspecialchars_decode($val); ?></li>
					<? } ?>
				</ol>
				<picture class="volunteerism-how-to__pattern"><img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= SITE_TEMPLATE_PATH ?>/images/volunteerism-how-to-pattern.svg" loading="lazy" alt="" title="" />
				</picture>
			</div>
		</section>
	<? } ?>
	<? if (!empty($arResult["DISPLAY_PROPERTIES"]["ITEMS_COL"]["VALUE"])) { ?>
		<section class="volunteerism-duties">
			<div class="container">
				<h3 class="section__title">Социальное добровольчество не&nbsp;требует от&nbsp;человека профессиональных
					навыков и&nbsp;умений</h3>
				<ul class="text-size-lg items-list">
					<? foreach ($arResult["DISPLAY_PROPERTIES"]["ITEMS_COL"]["VALUE"] as $key => $val) { ?>
						<li class="list-item"><?= $val; ?></li>
					<? } ?>
				</ul>
			</div>
		</section>
	<? } ?>
	<? if (!empty($arResult["DISPLAY_PROPERTIES"]["PHOTOS_BLOCK_2"]["FILE_VALUE"])) { ?>
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
							<? foreach ($arResult["DISPLAY_PROPERTIES"]["PHOTOS_BLOCK_2"]["FILE_VALUE"] as $key => $val) { ?>
								<div class="swiper-slide">
									<a href="<?= $val["SRC"]; ?>" data-fancybox="for-parents-gallery" class="list-item for-parents-gallery-item">
										<picture>
											<img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= $val["SRC"]; ?>" loading="lazy" alt="" title="" />
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
	<? if (!empty($arResult["DISPLAY_PROPERTIES"]["REVIEWS"]["VALUE"])) {
		$GLOBALS["arrFilter_vr"]["ID"] = $arResult["DISPLAY_PROPERTIES"]["REVIEWS"]["VALUE"];
	?>
		<? $APPLICATION->IncludeComponent(
			"bitrix:news.list",
			"volunteer_reviews",
			array(
				"DISPLAY_DATE" => "Y",
				"DISPLAY_NAME" => "Y",
				"DISPLAY_PICTURE" => "Y",
				"DISPLAY_PREVIEW_TEXT" => "Y",
				"AJAX_MODE" => "N",
				"IBLOCK_TYPE" => "content",
				"IBLOCK_ID" => Indexis::getIblockId("volunteer_reviews", "content"),
				"NEWS_COUNT" => "20",
				"SORT_BY1" => "ACTIVE_FROM",
				"SORT_ORDER1" => "DESC",
				"SORT_BY2" => "SORT",
				"SORT_ORDER2" => "ASC",
				"FILTER_NAME" => "arrFilter_vr",
				"FIELD_CODE" => array("ID"),
				"PROPERTY_CODE" => array(""),
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
				"DISPLAY_TOP_PAGER" => "Y",
				"DISPLAY_BOTTOM_PAGER" => "Y",
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
	<? } ?>
	<? if (!empty($arResult["DISPLAY_PROPERTIES"]["FAQ"]["VALUE"])) {
		$GLOBALS["arrFilter_faq"]["ID"] = $arResult["DISPLAY_PROPERTIES"]["FAQ"]["VALUE"];
	?>
		<? $APPLICATION->IncludeComponent(
			"bitrix:news.list",
			"volunteer_faq",
			array(
				"DISPLAY_DATE" => "Y",
				"DISPLAY_NAME" => "Y",
				"DISPLAY_PICTURE" => "Y",
				"DISPLAY_PREVIEW_TEXT" => "Y",
				"AJAX_MODE" => "N",
				"IBLOCK_TYPE" => "content",
				"IBLOCK_ID" => Indexis::getIblockId("faq", "content"),
				"NEWS_COUNT" => "20",
				"SORT_BY1" => "ACTIVE_FROM",
				"SORT_ORDER1" => "DESC",
				"SORT_BY2" => "SORT",
				"SORT_ORDER2" => "ASC",
				"FILTER_NAME" => "arrFilter_faq",
				"FIELD_CODE" => array("ID"),
				"PROPERTY_CODE" => array(""),
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
				"DISPLAY_TOP_PAGER" => "Y",
				"DISPLAY_BOTTOM_PAGER" => "Y",
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
	<? } ?>
	<? $APPLICATION->IncludeComponent(
		"indexis:ajax.form",
		"want_help_too",
		array(
			"IBLOCK_ID" => Indexis::getIblockId("want_help_too", "requests", SITE_ID),
            "CREATE_LEAD" => "Хочу помочь",
			"IBLOCK_TYPE" => "requests",
            "CHECK_CAPTCHA" => "Y",
			"FIELDS" => [
				"NAME" => ["CLEAR", "NOT_EMPTY", "TEXT"],
				"PROPERTY_EMAIL" => ["CLEAR", "NOT_EMPTY", "TEXT", "EMAIL"],
				"PROPERTY_PHONE" => ["CLEAR", "NOT_EMPTY", "PHONE"],
				"PREVIEW_TEXT" => ["CLEAR", "NOT_EMPTY", "TEXT"],
				//"PROPERTY_TYPE" => ["NOT_EMPTY", "LIST"]
			],
			"SEND_MESSAGE" => "WANT_HELP_TOO_CALLBACK",
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
	<?/* $APPLICATION->IncludeComponent(
		"bitrix:main.include",
		".default",
		array(
			"AREA_FILE_SHOW" => "file",
			"AREA_FILE_SUFFIX" => "",
			"AREA_FILE_RECURSIVE" => "Y",
			"EDIT_TEMPLATE" => "standard.php",
			"COMPONENT_TEMPLATE" => ".default",
			"PATH" => SITE_TEMPLATE_PATH . "/include/blocks/how_to_help/want_help_too.php"
		),
		false
	); */ ?>
</div>