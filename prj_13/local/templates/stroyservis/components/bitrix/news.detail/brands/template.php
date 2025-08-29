<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
?>

<?
// Блок с названием и описанием --> 
$this->SetViewTarget('BRAND_NAME_DESCRIPTION');
?>
<div class="page-title-mapei__wrapper">
	<div class="page-title-mapei__brand">
		<h1 class="page-title-mapei__title"><?= $arResult['DISPLAY_PROPERTIES']['ORIGINAL_NAME']['VALUE']; ?></h1>
	</div>
	<div class="page-title-mapei__brand">
		<div class="page-title-mapei__img">
			<img src="<?= $arResult['PICTURE']["SRC"] ?>" alt="<?= $arResult['PICTURE']["ALT"] ?>" title="<?= $arResult['PICTURE']["TITLE"] ?>">
		</div>
		<?= $arResult['PREVIEW_TEXT'] ?>
	</div>
</div>
<?
$this->EndViewTarget();
// <-- Блок с названием и описанием 
?>

<?
// Баннер с акцией -->
if (!empty($arResult['PROMO_ID'])) {
	$this->SetViewTarget('PROMO_BANNER');
?>
	<? $APPLICATION->IncludeComponent(
		"bitrix:news.detail",
		"promo_banner_brand_detail",
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
			"IBLOCK_TYPE" => 'catalog',
			"IBLOCK_ID" => Indexis::getIblockId('promos', 'catalog'),
			"ELEMENT_ID" => $arResult['PROMO_ID'],
			"ELEMENT_CODE" => "",
			"CHECK_DATES" => "Y",
			"FIELD_CODE" => array("ID", 'NAME', 'DETAIL_PICTURE', 'DETAIL_TEXT'),
			"PROPERTY_CODE" => array('BRAND', 'BANNER_HEADER', 'BANNER_IMAGE', 'BANNER_TOKEN', 'BANNER_ADV_SIGN'),
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
			"ADD_ELEMENT_CHAIN" => "N",
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
			"AJAX_OPTION_HISTORY" => "N"
		)
	); ?>
<?
	$this->EndViewTarget();
}
// <-- Баннер с акцией
?>

<? if (!empty($arResult['arSectionsIds'])) { ?>
	<?
	/*
		$GLOBALS['additionalCountFilterBrandDetail'] = array(
			'ELEMENT_SUBSECTIONS' => 'N',
			'CNT_ACTIVE' => 'Y'
		);
		*/
	$GLOBALS['arFilterSectionsBrandDetail']['ID'] = $arResult['arSectionsIds'];
	?>
	<? $APPLICATION->IncludeComponent(
		"bitrix:catalog.section.list",
		"brand_detail",
		array(
			"ADDITIONAL_COUNT_ELEMENTS_FILTER" => "additionalCountFilterBrandDetail",
			"VIEW_MODE" => "TEXT",
			"SHOW_PARENT_NAME" => "Y",
			"IBLOCK_TYPE" => "",
			"IBLOCK_ID" => Indexis::getIblockId("catalog"),
			"SECTION_ID" => "",
			"SECTION_CODE" => "",
			"SECTION_URL" => "",
			"COUNT_ELEMENTS" => "N",
			"COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
			"HIDE_SECTIONS_WITH_ZERO_COUNT_ELEMENTS" => "Y",
			"TOP_DEPTH" => "100",
			"SECTION_FIELDS" => "",
			"SECTION_USER_FIELDS" => "",
			"ADD_SECTIONS_CHAIN" => "N",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "36000000",
			"CACHE_NOTES" => "",
			"CACHE_GROUPS" => "Y",
			'FILTER_NAME' => 'arFilterSectionsBrandDetail',

			// Мои параметры --> 
			'BRAND_NAME' => $arResult['DISPLAY_PROPERTIES']['ORIGINAL_NAME']['VALUE'],
			'AR_COUNT_ELEMENTS' => $arResult['arSectionsCnt'],
			'SUFFIX_FILTER' => 'filter/proizvoditel_el-is-' . ToLower($arResult['NAME']) . '/',
			'BRAND_ID' => $arResult['ID']
			// <-- Мои параметры
		)
	); ?>
<? } ?>

<?/*?>
<ul class="goods-grouts__list">
	<li class="goods-grouts__item"><a class="goods-grouts__link" href="#">Затирка MAPEI</a></li>
	<li class="goods-grouts__item"><a class="goods-grouts__link" href="#">Затирка плиточных швов</a></li>
	<li class="goods-grouts__item"><a class="goods-grouts__link" href="#">Затирка акриловая</a></li>
	<li class="goods-grouts__item"><a class="goods-grouts__link" href="#">Затирка металлическая</a></li>
	<li class="goods-grouts__item"><a class="goods-grouts__link" href="#">MAPEI 80 Lvl</a></li>
	<li class="goods-grouts__item"><a class="goods-grouts__link" href="#">Затирка гипсовая</a></li>
	<li class="goods-grouts__item"><a class="goods-grouts__link" href="#">Жасмин 5 кг</a></li>
	<li class="goods-grouts__item"><a class="goods-grouts__link" href="#">MAPEI 260</a></li>
	<li class="goods-grouts__item"><a class="goods-grouts__link" href="#">Краска для швов плитки</a></li>
	<li class="goods-grouts__item"><a class="goods-grouts__link" href="#">MAPEI 80 Lvl</a></li>
	<li class="goods-grouts__item"><a class="goods-grouts__link" href="#">MAPEI 80 Lvl</a></li>
	<li class="goods-grouts__item goods-grouts__item_show goods-grouts__item_hidden">Показать все</li>
</ul>
<?*/ ?>

<?
// Товары MAPEI есть в категориях -->
if ($arResult['ID']) {
?>
	<?
	//$GLOBALS['arrFilterBrandDetail']['ID'] = $arResult['arProductsIds'];
	$GLOBALS['arrFilterBrandDetail']['PROPERTY_PROIZVODITEL_EL'] = $arResult['ID'];
	?>
	<? $APPLICATION->IncludeComponent(
		"bitrix:catalog.section",
		'brand_detail',
		array(
			"TEMPLATE_THEME" => "blue",
			"IBLOCK_TYPE" => "catalog",
			"IBLOCK_ID" => Indexis::getIblockId('catalog', 'catalog'),
			"HIDE_NOT_AVAILABLE" => "L",
			"BASKET_URL" => "/personal/cart/",
			"ACTION_VARIABLE" => "action",
			"PRODUCT_ID_VARIABLE" => "id",
			"SECTION_ID_VARIABLE" => "SECTION_ID",
			"PRODUCT_QUANTITY_VARIABLE" => "quantity",
			"ADD_PROPERTIES_TO_BASKET" => "Y",
			"PRODUCT_PROPS_VARIABLE" => "prop",
			"PARTIAL_PRODUCT_PROPERTIES" => "Y",
			"COMMON_SHOW_CLOSE_POPUP" => "N",
			"SEF_MODE" => "Y",
			"SEF_FOLDER" => "/catalog/",
			"AJAX_MODE" => "Y",
			"AJAX_OPTION_ADDITIONAL" => "",
			"AJAX_OPTION_JUMP" => "Y",
			"AJAX_OPTION_STYLE" => "Y",
			"AJAX_OPTION_HISTORY" => "N",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "36000000",
			"CACHE_FILTER" => "N",
			"CACHE_GROUPS" => "Y",
			"USE_MAIN_ELEMENT_SECTION" => "Y",
			"SET_LAST_MODIFIED" => "N",
			"SET_TITLE" => "Y",
			"ADD_SECTIONS_CHAIN" => "Y",
			"ADD_ELEMENT_CHAIN" => "N",
			"USE_ELEMENT_COUNTER" => "Y",
			"USE_SALE_BESTSELLERS" => "Y",
			"COMPARE_POSITION_FIXED" => "Y",
			"COMPARE_POSITION" => "top left",
			"USE_FILTER" => "Y",
			"FILTER_NAME" => 'arrFilterBrandDetail',
			"FILTER_FIELD_CODE" => array(
				0 => "",
				1 => "",
			),
			"FILTER_HIDE_ON_MOBILE" => "Y",
			"FILTER_PROPERTY_CODE" => array(
				0 => "",
				1 => "",
			),
			"FILTER_PRICE_CODE" => array(
				0 => "BASE",
			),
			"FILTER_OFFERS_FIELD_CODE" => array(
				0 => "PREVIEW_PICTURE",
				1 => "DETAIL_PICTURE",
				2 => "",
			),
			"FILTER_OFFERS_PROPERTY_CODE" => array(
				0 => "",
				1 => "",
			),
			"USE_COMMON_SETTINGS_BASKET_POPUP" => "N",
			"TOP_ADD_TO_BASKET_ACTION" => "ADD",
			"SECTION_ADD_TO_BASKET_ACTION" => "ADD",
			"DETAIL_ADD_TO_BASKET_ACTION" => array("BUY"),
			"DETAIL_SHOW_BASIS_PRICE" => "Y",
			"FILTER_VIEW_MODE" => "VERTICAL",
			"USE_REVIEW" => "Y",
			"MESSAGES_PER_PAGE" => "10",
			"USE_CAPTCHA" => "Y",
			"REVIEW_AJAX_POST" => "Y",
			"PATH_TO_SMILE" => "/bitrix/images/forum/smile/",
			"FORUM_ID" => "1",
			"URL_TEMPLATES_READ" => "",
			"SHOW_LINK_TO_FORUM" => "Y",
			"POST_FIRST_MESSAGE" => "N",
			"USE_COMPARE" => "N",
			"PRICE_CODE" => array(
				0 => "BASE",
			),
			"USE_PRICE_COUNT" => "N",
			"SHOW_PRICE_COUNT" => "1",
			"PRICE_VAT_INCLUDE" => "Y",
			"PRICE_VAT_SHOW_VALUE" => "N",
			"PRODUCT_PROPERTIES" => array(),
			"USE_PRODUCT_QUANTITY" => "N",
			"CONVERT_CURRENCY" => "Y",
			"CURRENCY_ID" => "RUB",
			"OFFERS_CART_PROPERTIES" => array(
				0 => "COLOR_REF",
				1 => "SIZES_SHOES",
				2 => "SIZES_CLOTHES",
			),
			"SHOW_TOP_ELEMENTS" => "N",
			"SECTION_COUNT_ELEMENTS" => "Y",
			"SECTION_TOP_DEPTH" => "1",
			"SECTIONS_VIEW_MODE" => "TEXT",
			"SECTIONS_SHOW_PARENT_NAME" => "Y",
			"PAGE_ELEMENT_COUNT" => "12",
			"LINE_ELEMENT_COUNT" => "3",
			"ELEMENT_SORT_FIELD2" => "sort",
			"ELEMENT_SORT_ORDER2" => "asc",
			"ELEMENT_SORT_FIELD" => "PROPERTY_PRICE_HIDE",
			"ELEMENT_SORT_ORDER" => "asc",
			"LIST_PROPERTY_CODE" => array(
				//"NEWPRODUCT",
				//"SALELEADER",
				//"SPECIALOFFER",
				"RAITING_VAL",
				"RAITING_COUNT",
				"CML2_ARTICLE",
			),
			"INCLUDE_SUBSECTIONS" => "Y",
			"LIST_META_KEYWORDS" => "UF_KEYWORDS",
			"LIST_META_DESCRIPTION" => "UF_META_DESCRIPTION",
			"LIST_BROWSER_TITLE" => "UF_BROWSER_TITLE",
			"LIST_OFFERS_FIELD_CODE" => array(
				"NAME",
				"PREVIEW_PICTURE",
				"DETAIL_PICTURE",
			),
			"LIST_OFFERS_PROPERTY_CODE" => array(
				"ARTNUMBER",
				"COLOR_REF",
				"SIZES_SHOES",
				"SIZES_CLOTHES",
				"MORE_PHOTO",
				"RAITING_VAL",
				"RAITING_COUNT",
			),
			"LIST_OFFERS_LIMIT" => "0",
			"SECTION_BACKGROUND_IMAGE" => "-",
			"DETAIL_DETAIL_PICTURE_MODE" => "IMG",
			"DETAIL_ADD_DETAIL_TO_SLIDER" => "N",
			"DETAIL_DISPLAY_PREVIEW_TEXT_MODE" => "E",
			"DETAIL_PROPERTY_CODE" => array(
				"NEWPRODUCT",
				"MANUFACTURER",
				"MATERIAL",
				"RAITING_VAL",
				"RAITING_COUNT",
			),
			"DETAIL_META_KEYWORDS" => "KEYWORDS",
			"DETAIL_META_DESCRIPTION" => "META_DESCRIPTION",
			"DETAIL_BROWSER_TITLE" => "TITLE",
			"DETAIL_SET_CANONICAL_URL" => "N",
			"DETAIL_CHECK_SECTION_ID_VARIABLE" => "N",
			"SHOW_DEACTIVATED" => "N",
			"DETAIL_OFFERS_FIELD_CODE" => array(
				0 => "NAME",
				1 => "",
			),
			"DETAIL_OFFERS_PROPERTY_CODE" => array(
				0 => "ARTNUMBER",
				1 => "COLOR_REF",
				2 => "SIZES_SHOES",
				3 => "SIZES_CLOTHES",
				4 => "MORE_PHOTO",
				5 => "",
			),
			"DETAIL_BACKGROUND_IMAGE" => "-",
			"DETAIL_STRICT_SECTION_CHECK" => "Y",
			"LINK_IBLOCK_TYPE" => "",
			"LINK_IBLOCK_ID" => "",
			"LINK_PROPERTY_SID" => "",
			"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
			"USE_ALSO_BUY" => "Y",
			"ALSO_BUY_ELEMENT_COUNT" => "3",
			"ALSO_BUY_MIN_BUYES" => "2",
			"DETAIL_SET_VIEWED_IN_COMPONENT" => "N",
			"DISABLE_INIT_JS_IN_COMPONENT" => "N",
			"USE_GIFTS_DETAIL" => "Y",
			"USE_GIFTS_MAIN_PR_SECTION_LIST" => "Y",
			"USE_GIFTS_SECTION" => "Y",
			"GIFTS_DETAIL_BLOCK_TITLE" => "Выберите один из подарков",
			"GIFTS_DETAIL_HIDE_BLOCK_TITLE" => "N",
			"GIFTS_DETAIL_PAGE_ELEMENT_COUNT" => "3",
			"GIFTS_DETAIL_TEXT_LABEL_GIFT" => "Подарок",
			"GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE" => "Выберите один из товаров, чтобы получить подарок",
			"GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE" => "N",
			"GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT" => "3",
			"GIFTS_MESS_BTN_BUY" => "Выбрать",
			"GIFTS_SECTION_LIST_BLOCK_TITLE" => "Подарки к товарам этого раздела",
			"GIFTS_SECTION_LIST_HIDE_BLOCK_TITLE" => "N",
			"GIFTS_SECTION_LIST_PAGE_ELEMENT_COUNT" => "3",
			"GIFTS_SECTION_LIST_TEXT_LABEL_GIFT" => "Подарок",
			"GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
			"GIFTS_SHOW_IMAGE" => "Y",
			"GIFTS_SHOW_NAME" => "Y",
			"GIFTS_SHOW_OLD_PRICE" => "Y",
			"USE_STORE" => "Y",
			"STORES" => array("1"),
			"USE_MIN_AMOUNT" => "N",
			"USER_FIELDS" => array(""),
			"FIELDS" => array("ADDRESS", "PHONE"),
			"SHOW_EMPTY_STORE" => "Y",
			"SHOW_GENERAL_STORE_INFORMATION" => "N",
			"STORE_PATH" => "/store/#store_id#",
			"MAIN_TITLE" => "Наличие на складах",
			"USE_BIG_DATA" => "Y",
			"BIG_DATA_RCM_TYPE" => "bestsell",
			"OFFERS_SORT_FIELD" => "sort",
			"OFFERS_SORT_ORDER" => "asc",
			"OFFERS_SORT_FIELD2" => "id",
			"OFFERS_SORT_ORDER2" => "desc",
			"PAGER_TEMPLATE" => "stroyservis_ajax",
			"DISPLAY_TOP_PAGER" => "N",
			"DISPLAY_BOTTOM_PAGER" => "Y",
			"PAGER_TITLE" => "Товары",
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_DESC_NUMBERING" => "N",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000000",
			"PAGER_SHOW_ALL" => "N",
			"PAGER_BASE_LINK_ENABLE" => "N",
			"PAGER_BASE_LINK" => "",
			"PAGER_PARAMS_NAME" => "arrPager",
			"SET_STATUS_404" => "N",
			"SHOW_404" => "N",
			"MESSAGE_404" => "",
			"ADD_PICT_PROP" => "-",
			"LABEL_PROP" => "NEWPRODUCT",
			"PRODUCT_DISPLAY_MODE" => "Y",
			"OFFER_ADD_PICT_PROP" => "MORE_PHOTO",
			"OFFER_TREE_PROPS" => array(
				0 => "COLOR_REF",
				1 => "SIZES_SHOES",
				2 => "SIZES_CLOTHES",
				3 => "",
			),
			"DETAIL_DISPLAY_NAME" => "Y",
			"DETAIL_ADD_DETAIL_TO_SLIDER" => "N",
			"SHOW_DISCOUNT_PERCENT" => "Y",
			"SHOW_OLD_PRICE" => "Y",
			"DETAIL_SHOW_MAX_QUANTITY" => "N",
			"MESS_BTN_BUY" => "Купить",
			"MESS_BTN_ADD_TO_BASKET" => "В корзину",
			"MESS_BTN_COMPARE" => "Сравнение",
			"MESS_BTN_DETAIL" => "Подробнее",
			"MESS_NOT_AVAILABLE" => "Нет в наличии",
			"TOP_VIEW_MODE" => "SECTION",
			"DETAIL_USE_VOTE_RATING" => "Y",
			"DETAIL_VOTE_DISPLAY_AS_RATING" => "rating",
			"DETAIL_USE_COMMENTS" => "Y",
			"DETAIL_BLOG_USE" => "Y",
			"DETAIL_VK_USE" => "N",
			"DETAIL_FB_USE" => "Y",
			"DETAIL_FB_APP_ID" => "",
			"DETAIL_BRAND_USE" => "N",
			"SIDEBAR_SECTION_SHOW" => "Y",
			"SIDEBAR_DETAIL_SHOW" => "N",
			"SIDEBAR_PATH" => "/examples/index_inc.php",
			"AJAX_OPTION_ADDITIONAL" => "",
			"SEF_URL_TEMPLATES" => array(
				"sections" => "",
				"section" => "#SECTION_CODE#/",
				"element" => "#SECTION_CODE#/#ELEMENT_CODE#/",
				"compare" => "compare/",
			),
		),
		$component
	);
	?>
<? }
// <-- Товары MAPEI есть в категориях
?>

<? if (!empty($arResult['DETAIL_TEXT'])) { ?>
	<section class="description-mapei">
		<div class="description-mapei__wrapper">
			<?= $arResult['DETAIL_TEXT']; ?>
		</div>
	</section>
<? } ?>

<? if (!empty($arResult['arCertificates'])) { ?>
	<section class="distributor">
		<div class="title-section">
			<h2>ООО «Стройсервис» является официальным дистрибьютером <?= $arResult['DISPLAY_PROPERTIES']['ORIGINAL_NAME']['VALUE'] ?></h2>
			<div class="title-link">
				<div class="button-arrow button-arrow_left distributor__prev"></div>
				<div class="button-arrow button-arrow_right distributor__next"></div>
			</div>
		</div>
		<div class="distributor__slider">
			<div class="distributor__wrapper">
				<? foreach ($arResult['arCertificates'] as $key => $arItem) { ?>
					<div class="distributor__slide">
						<div class="distributor__image">
							<a href="<?= $arItem["SOURCE_PICTURE"]["SRC"] ?>" data-fancybox="gallery">
								<img src="<?= $arItem["SRC"] ?>" alt="<?= $arItem["ALT"] ?>" title="<?= $arItem["TITLE"] ?>" />
							</a>
						</div>
					</div>
				<? } ?>
			</div>
			<div class="distributor__pagination"></div>
		</div>
	</section>
<? } ?>