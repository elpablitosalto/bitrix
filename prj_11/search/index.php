<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
$query = !empty($request->get('tags')) ? '#' . $request->get('tags') :  $request->get('q');
$APPLICATION->SetTitle("Поиск: " . $query);
?>
	<div class="page__content-top">
		<div class="page__holder">
			<div class="page__top-wrapper">
				<div class="page__breadcrumbs">
					<!-- begin .breadcrumbs-->
					<? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "main",
						Array(
							"START_FROM" => "0",
							"SITE_ID" => "s1"
						)
					); ?>
					<!-- end .breadcrumbs-->
				</div>
				<div class="page__search">
					<!-- begin .search-panel-->
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:search.title",
                        "gazeta",
                        Array(
                            "CATEGORY_0" => array("iblock_newspaper"),
                            "CATEGORY_0_TITLE" => "Новости",
                            "CATEGORY_0_iblock_content" => array(0=>"all",),
                            "CATEGORY_0_iblock_news" => array(0=>"all",),
                            "CATEGORY_0_iblock_newspaper" => array("4"),
                            "CATEGORY_OTHERS_TITLE" => "Прочее",
                            "CHECK_DATES" => "Y",
                            "CONTAINER_ID" => "gazeta-body-search",
                            "CONVERT_CURRENCY" => "Y",
                            "CURRENCY_ID" => "RUB",
                            "INPUT_ID" => "gazeta-body-search-input",
                            "NUM_CATEGORIES" => "1",
                            "ORDER" => "date",
                            "PAGE" => "#SITE_DIR#search/",
                            "PREVIEW_HEIGHT" => "75",
                            "PREVIEW_TRUNCATE_LEN" => "150",
                            "PREVIEW_WIDTH" => "75",
                            "PRICE_VAT_INCLUDE" => "Y",
                            "SHOW_INPUT" => "Y",
                            "SHOW_OTHERS" => "Y",
                            "SHOW_PREVIEW" => "Y",
                            "TOP_COUNT" => "10",
                            "USE_LANGUAGE_GUESS" => "N"
                        )
                    );?>
					<!-- end .search-panel-->
				</div>
			</div>
		</div>
	</div>
	<div class="page__section">
		<div class="page__holder">
			<!-- begin .section-->
			<div class="section section_space_top-close">
				<div class="section__header section__header_type_inline">
					<div class="section__title">
						<!-- begin .title-->
						<h2 class="title title_size_h2">
							<?$APPLICATION->ShowTitle()?>
						</h2>
						<!-- end .title-->
					</div>
				</div>
				<div class="section__content">
					<?
						$GLOBALS["PAGEN_LM_DEFAULT_COUNT_1"] = !empty($arParams["NEWS_COUNT"]) ? intval($arParams["NEWS_COUNT"]) : 8;
						$newsDefaultCount = $GLOBALS["PAGEN_LM_DEFAULT_COUNT_1"];
						if($request->isAjaxRequest() && !empty($request->get("PAGEN_LM_1"))){
								$newsDefaultCount *= intval($request->get("PAGEN_LM_1"));
						}
					?>
					<? $APPLICATION->IncludeComponent(
	"bitrix:search.page",
	"main",
	array(
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "main",
		"DEFAULT_SORT" => "rank",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FILTER_NAME" => "",
		"NO_WORD_LOGIC" => "Y",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_TEMPLATE" => "load_more",
		"PAGER_TITLE" => "Результаты поиска",
		"PAGE_RESULT_COUNT" => $newsDefaultCount,
		"RESTART" => "Y",
		"SHOW_WHEN" => "N",
		"SHOW_WHERE" => "N",
		"USE_LANGUAGE_GUESS" => "N",
		"USE_SUGGEST" => "N",
		"USE_TITLE_RANK" => "Y",
		"arrFILTER" => array(
			0 => "iblock_newspaper",
		),
		"arrWHERE" => "",
		"arrFILTER_iblock_newspaper" => array(
			0 => "4",
		)
	),
	false
);?>
				</div>
			</div>
			<!-- end .section-->
		</div>
	</div>
	<div class="page__section page__section_style_secondary">
		<div class="page__holder">
				<!-- begin .section-->
				<?
				$GLOBALS["gazetaFavoriteFilter"] = [
						"!PROPERTY_FAVORITE_VALUE" => false,
						"!ID" => $arResult["ID"]
				];
				$APPLICATION->IncludeComponent("bitrix:news.list", "gazeta_favorite", array(
						"IBLOCK_TYPE" => "newspaper",
						"IBLOCK_ID" => "4",
						"NEWS_COUNT" => "4",
						"SORT_BY1" => "SORT",
						"SORT_ORDER1" => "ASC",
						"SORT_BY2" => "ID",
						"SORT_ORDER2" => "ASC",
						"FILTER_NAME" => "gazetaFavoriteFilter",
						"FIELD_CODE" => array(
								"NAME",
								"PREVIEW_PICTURE",
								"PREVIEW_TEXT",
						),
						"PROPERTY_CODE" => array(
								"FORMAT",
								"FAVORITE_IMAGE",
						),
						"CHECK_DATES" => "Y",
						"DETAIL_URL" => "",
						"AJAX_MODE" => "N",
						"AJAX_OPTION_SHADOW" => "Y",
						"AJAX_OPTION_JUMP" => "N",
						"AJAX_OPTION_STYLE" => "Y",
						"AJAX_OPTION_HISTORY" => "N",
						"CACHE_TYPE" => "A",
						"CACHE_TIME" => "36000000",
						"CACHE_FILTER" => "N",
						"CACHE_GROUPS" => "Y",
						"ACTIVE_DATE_FORMAT" => "M j, Y",
						"DISPLAY_PANEL" => "N",
						"SET_TITLE" => "N",
						"SET_STATUS_404" => "N",
						"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
						"ADD_SECTIONS_CHAIN" => "N",
						"HIDE_LINK_WHEN_NO_DETAIL" => "N",
						"PARENT_SECTION" => "",
						"PARENT_SECTION_CODE" => "",
						"DISPLAY_TOP_PAGER" => "N",
						"DISPLAY_BOTTOM_PAGER" => "N",
						"PAGER_TITLE" => "News",
						"PAGER_SHOW_ALWAYS" => "N",
						"PAGER_TEMPLATE" => "",
						"PAGER_DESC_NUMBERING" => "N",
						"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000000",
						"PAGER_SHOW_ALL" => "N",
						"AJAX_OPTION_ADDITIONAL" => ""
				),
						false
				); ?>
				<!-- end .section-->
		</div>
	</div>
	<div class="page__section">
		<div class="page__holder page_holder_mobile-gutter_s">
			<!-- begin .section-->
			<?
			$GLOBALS["excursionBannersFilter"] = [
				"PROPERTY_TYPE_VALUE" => "Баннер-панель с заливкой"
			];
			$APPLICATION->IncludeComponent("bitrix:news.list", "excursion_banners", array(
				"IBLOCK_TYPE" => "content",
				"IBLOCK_ID" => "27",
				"NEWS_COUNT" => "10",
				"SORT_BY1" => "SORT",
				"SORT_ORDER1" => "ASC",
				"SORT_BY2" => "ID",
				"SORT_ORDER2" => "ASC",
				"FILTER_NAME" => "excursionBannersFilter",
				"FIELD_CODE" => array(),
				"PROPERTY_CODE" => array(
					0 => "TYPE",
				),
				"CHECK_DATES" => "Y",
				"DETAIL_URL" => "",
				"AJAX_MODE" => "N",
				"AJAX_OPTION_SHADOW" => "Y",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"AJAX_OPTION_HISTORY" => "N",
				"CACHE_TYPE" => "A",
				"CACHE_TIME" => "36000000",
				"CACHE_FILTER" => "N",
				"CACHE_GROUPS" => "Y",
				"ACTIVE_DATE_FORMAT" => "M j, Y",
				"DISPLAY_PANEL" => "N",
				"SET_TITLE" => "N",
				"SET_STATUS_404" => "N",
				"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
				"ADD_SECTIONS_CHAIN" => "N",
				"HIDE_LINK_WHEN_NO_DETAIL" => "N",
				"PARENT_SECTION" => "",
				"PARENT_SECTION_CODE" => "",
				"DISPLAY_TOP_PAGER" => "N",
				"DISPLAY_BOTTOM_PAGER" => "N",
				"PAGER_TITLE" => "News",
				"PAGER_SHOW_ALWAYS" => "N",
				"PAGER_TEMPLATE" => "",
				"PAGER_DESC_NUMBERING" => "N",
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000000",
				"PAGER_SHOW_ALL" => "N",
				"AJAX_OPTION_ADDITIONAL" => "",
				"SECTION_MODIF_CLASS" => ""
			),
				false
			);
			?>
			<!-- end .section-->
		</div>
	</div>
	<div class="page__section">
		<div class="page__holder">
			<!-- begin .section-->
			<div class="section section_space_close">
				<div class="section__content">
					<!-- begin .subscribe-panel-->
					<div class="subscribe-panel">
						<? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/form/subscribe.php",
							Array(),
							Array("MODE" => "html", "NAME" => "SUBSCRIBE")
						); ?>
						<? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/gazeta/telegram.php",
							Array(),
							Array("MODE" => "html", "NAME" => "TELEGRAM")
						); ?>
					</div>
					<!-- end .subscribe-panel-->
				</div>
			</div>
			<!-- end .section-->
		</div>
	</div>
	<div class="page__section">
		<div class="page__holder">
			<div class="section section_space_top-close"></div>
			<!-- begin .section-->
			<?
			$GLOBALS["freeServices"] = [
				"PROPERTY_CATEGORY_VALUE" => "Бесплатно"
			];
			$APPLICATION->IncludeComponent("bitrix:news.list", "free_services_gazeta", array(
				"IBLOCK_TYPE" => "content",
				"IBLOCK_ID" => "12",
				"NEWS_COUNT" => "4",
				"SORT_BY1" => "SORT",
				"SORT_ORDER1" => "ASC",
				"SORT_BY2" => "ID",
				"SORT_ORDER2" => "ASC",
				"FILTER_NAME" => "freeServices",
				"FIELD_CODE" => array(
					"NAME",
					"PREVIEW_PICTURE",
				),
				"PROPERTY_CODE" => array(
					"ICON",
										"LINK",
				),
				"CHECK_DATES" => "Y",
				"DETAIL_URL" => "",
				"AJAX_MODE" => "N",
				"AJAX_OPTION_SHADOW" => "Y",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"AJAX_OPTION_HISTORY" => "N",
				"CACHE_TYPE" => "A",
				"CACHE_TIME" => "36000000",
				"CACHE_FILTER" => "N",
				"CACHE_GROUPS" => "Y",
				"ACTIVE_DATE_FORMAT" => "M j, Y",
				"DISPLAY_PANEL" => "N",
				"SET_TITLE" => "N",
				"SET_STATUS_404" => "N",
				"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
				"ADD_SECTIONS_CHAIN" => "N",
				"HIDE_LINK_WHEN_NO_DETAIL" => "N",
				"PARENT_SECTION" => "",
				"PARENT_SECTION_CODE" => "",
				"DISPLAY_TOP_PAGER" => "N",
				"DISPLAY_BOTTOM_PAGER" => "N",
				"PAGER_TITLE" => "News",
				"PAGER_SHOW_ALWAYS" => "N",
				"PAGER_TEMPLATE" => "",
				"PAGER_DESC_NUMBERING" => "N",
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000000",
				"PAGER_SHOW_ALL" => "N",
				"AJAX_OPTION_ADDITIONAL" => ""
			),
				false
			);
			?>
			<!-- end .section-->
		</div>
	</div>
	<div class="page__section page__section_decoration_bottom">
		<!-- begin .section-->
		<div class="section section_space_close">
			<div class="section__content">
				<div class="section__following">
					<!-- begin .following-->
					<div class="following">
						<div class="following__container swiper js-following-carousel">
							<div class="following__wrapper swiper-wrapper">
								<? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/text_carousel/gazeta.php",
									Array(),
									Array("MODE" => "html", "NAME" => "TEXT_CAROUSEL")
								); ?>
							</div>
						</div>
					</div>
					<!-- end .following-->
				</div>
			</div>
		</div>
		<!-- end .section-->
	</div>

<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>