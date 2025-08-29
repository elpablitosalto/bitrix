<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Партнерская программа");
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
		</div>
	</div>
</div>

<?$APPLICATION->IncludeComponent(
	"waim:partnership.intro", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"TITLE" => "Партнерская программа",
		"SUBTITLE" => "Нескучные финансы",
		"IMAGE" => "/upload/medialibrary/d1e/zq5w8kcsv1vid40mxkwyfy90xmm9u0fc.png",
		"IMAGE_XS" => "/upload/medialibrary/acd/8zu06ctpfucm7h7l4oai9o2winzo5y1x.png",
		"IMAGE_S" => "/upload/medialibrary/3dc/opny282mronp67asjc3v43v79a5w107e.png",
		"IMAGE_M" => "/upload/medialibrary/53b/jtz6aia1otafx0hjv3dsxjvuotxg6gt2.png"
	),
	false
);?>

<div class="page__section page__section_decoration_bottom">
		<!-- begin .section-->
		<div class="section section_space_close">
				<div class="section__content">
						<div class="section__following">
								<!-- begin .following-->
								<div class="following">
										<div class="following__container swiper js-following-carousel">
												<div class="following__wrapper swiper-wrapper">
														<?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/include/text_carousel/main.php",
																Array(),
																Array("MODE" => "html", "NAME" => "TEXT_CAROUSEL")
														);?>
												</div>
										</div>
								</div>
								<!-- end .following-->
						</div>
				</div>
		</div>
		<!-- end .section-->
</div>

<?$APPLICATION->IncludeComponent(
	"waim:partnership.conditions", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"VALUE_1" => "В счет оплаты услуг «НФ» | 50 000 ₽",
		"VALUE_2" => "Деньгами на счет | 50 000 ₽",
		"VALUE_3" => "Каждый месяц на счёт пока клиент <br>от вас находится на обслуживании НФ | 10 000 ₽",
		"TITLE" => "Выбирайте бонус за успешную рекомендацию финансового директора В счет оплаты услуг «НФ»",
		"FORM_TITLE" => "Получить больше информации об условиях",
		"WEB_FORM_ID" => "8"
	),
	false
);?>

<?$APPLICATION->IncludeComponent(
	"waim:partnership.steps",
	".default",
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"TITLE" => "Как стать участником",
		"COUNT" => "6",
		"IBLOCK_ID" => "24"
	),
	false
);?>

<?$APPLICATION->IncludeComponent(
	"waim:partnership.faq",
	".default",
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"TITLE" => "Частые вопросы",
		"COUNT" => "6",
		"IBLOCK_ID" => "25"
	),
	false
);?>

<div class="page__section">
	<div class="page__holder">
		<!-- begin .section-->
		<div class="section section_space_top-close">
			<div class="section__content">
				<div class="section__banner">
					<?
						$APPLICATION->IncludeComponent(
	"bitrix:news.detail",
	"common_banner",
	array(
		"IBLOCK_ID" => "27",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_ELEMENT_CHAIN" => "N",
		"FIELD_CODE" => [
			"NAME",
			"PREVIEW_TEXT",
			"PREVIEW_PICTURE",
			"DETAIL_PICTURE",
		],
		"PROPERTY_CODE" => [
			"TYPE",
			"TITLE",
			"DESCRIPTION",
			"MULTIPLE_TEXT",
			"TELEGRAM",
			"WHATSAPP",
			"EMAIL",
			"PRIMARY_BUTTON_TEXT",
			"PRIMARY_BUTTON_LINK",
			"BUTTONS_DESC",
			"SECONDARY_BUTTON_TEXT",
			"SECONDARY_BUTTON_LINK",
			"IMAGE",
			"IMAGE_XL",
			"IMAGE_L",
			"IMAGE_M",
			"IMAGE_S",
			"IMAGE_XS",
			"TIPPY_RIGHT",
			"TIPPY_LEFT"
		],
		"ELEMENT_ID" => "1142",
		"COMPONENT_TEMPLATE" => "contact",
		"IBLOCK_TYPE" => "content",
		"ELEMENT_CODE" => "",
		"CHECK_DATES" => "Y",
		"IBLOCK_URL" => "",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		"SET_TITLE" => "Y",
		"SET_CANONICAL_URL" => "N",
		"SET_BROWSER_TITLE" => "Y",
		"BROWSER_TITLE" => "-",
		"SET_META_KEYWORDS" => "Y",
		"META_KEYWORDS" => "-",
		"SET_META_DESCRIPTION" => "Y",
		"META_DESCRIPTION" => "-",
		"SET_LAST_MODIFIED" => "N",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"USE_PERMISSIONS" => "N",
		"STRICT_SECTION_CHECK" => "N",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Страница",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => ""
	),
	$component
);
					?>
				</div>
			</div>
		</div>
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
														<?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/include/text_carousel/main.php",
																Array(),
																Array("MODE" => "html", "NAME" => "TEXT_CAROUSEL")
														);?>
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