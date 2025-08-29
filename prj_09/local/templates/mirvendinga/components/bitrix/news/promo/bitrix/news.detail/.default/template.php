<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

<div class="page__section">
	<div class="page__container">
		<div class="page__article">
			<div class="article">
					<?if(!empty($arResult["IMAGE"]["SRC"])):?>
						<div class="article__illustration">
								<picture class="article__picture">
										<img data-src="<?=$arResult["IMAGE"]["SRC"]?>" alt="<?=$arResult["NAME"]?>" class="article__image lazyload">
								</picture>
						</div>
					<?endif?>
					<div class="article__header">
							<div class="article__title">
									<!-- begin .title-->
									<h1 class="title title_size_h1"><?=$arResult["NAME"]?></h1>
									<!-- end .title-->
							</div>
							<?if(!empty($arResult["DISCOUNT_LABEL"])):?>
								<div class="article__note"><?=$arResult["DISCOUNT_LABEL"]?></div>
							<?endif?>
					</div>
					<?if(!empty($arResult["DETAIL_TEXT"])):?>
						<div class="article__text"><?=$arResult["DETAIL_TEXT"]?></div>
					<?elseif(!empty($arResult["PREVIEW_TEXT"])):?>
							<div class="article__text"><?=$arResult["PREVIEW_TEXT"]?></div>
					<?endif?>
			</div>
		</div>
	</div>
</div>

<?
if(!empty($arResult['DISCOUNT_PRODUCTS'])) {
	global $discountProductsFilter;
	$discountProductsFilter = Array('ID' => $arResult['DISCOUNT_PRODUCTS']);
	$APPLICATION->IncludeComponent(
		"bitrix:catalog.section",
		"product-section",
		array(
			"ACTION_VARIABLE" => "action",
			"ADD_PICT_PROP" => "MORE_PHOTO",
			"ADD_PROPERTIES_TO_BASKET" => "Y",
			"ADD_SECTIONS_CHAIN" => "N",
			"ADD_TO_BASKET_ACTION" => "ADD",
			"AJAX_MODE" => "N",
			"AJAX_OPTION_ADDITIONAL" => "",
			"AJAX_OPTION_HISTORY" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"BACKGROUND_IMAGE" => "",
			"BASKET_URL" => "/personal/basket.php",
			"BRAND_PROPERTY" => "CML2_ARTICLE",
			"BROWSER_TITLE" => "-",
			"CACHE_FILTER" => "N",
			"CACHE_GROUPS" => "Y",
			"CACHE_TIME" => "36000000",
			"CACHE_TYPE" => "A",
			"COMPATIBLE_MODE" => "Y",
			"CONVERT_CURRENCY" => "Y",
			"CURRENCY_ID" => "RUB",
			"CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[]}",
			"DATA_LAYER_NAME" => "dataLayer",
			"DETAIL_URL" => "",
			"DISABLE_INIT_JS_IN_COMPONENT" => "N",
			"DISCOUNT_PERCENT_POSITION" => "bottom-right",
			"DISPLAY_BOTTOM_PAGER" => "N",
			"DISPLAY_TOP_PAGER" => "N",
			"ELEMENT_SORT_FIELD" => "sort",
			"ELEMENT_SORT_FIELD2" => "id",
			"ELEMENT_SORT_ORDER" => "asc",
			"ELEMENT_SORT_ORDER2" => "desc",
			"ENLARGE_PRODUCT" => "PROP",
			"ENLARGE_PROP" => "NOVELTY",
			"FILTER_NAME" => "discountProductsFilter",
			"HIDE_NOT_AVAILABLE" => "N",
			"HIDE_NOT_AVAILABLE_OFFERS" => "N",
			"IBLOCK_ID" => "36",
			"IBLOCK_TYPE" => "1c_goods",
			"INCLUDE_SUBSECTIONS" => "Y",
			"LABEL_PROP" => array(
			),
			"LABEL_PROP_MOBILE" => "",
			"LABEL_PROP_POSITION" => "top-left",
			"LAZY_LOAD" => "Y",
			"LINE_ELEMENT_COUNT" => "3",
			"LOAD_ON_SCROLL" => "N",
			"MESSAGE_404" => "",
			"MESS_BTN_ADD_TO_BASKET" => "В корзину",
			"MESS_BTN_BUY" => "Купить",
			"MESS_BTN_DETAIL" => "Подробнее",
			"MESS_BTN_LAZY_LOAD" => "Показать ещё",
			"MESS_BTN_SUBSCRIBE" => "Подписаться",
			"MESS_NOT_AVAILABLE" => "Нет в наличии",
			"META_DESCRIPTION" => "-",
			"META_KEYWORDS" => "-",
			"OFFERS_CART_PROPERTIES" => array(
			),
			"OFFERS_FIELD_CODE" => array(
				0 => "",
				1 => "",
			),
			"OFFERS_LIMIT" => "5",
			"OFFERS_PROPERTY_CODE" => array(
				0 => "",
				1 => "",
				2 => "",
				3 => "",
				4 => "",
			),
			"OFFERS_SORT_FIELD" => "sort",
			"OFFERS_SORT_FIELD2" => "id",
			"OFFERS_SORT_ORDER" => "asc",
			"OFFERS_SORT_ORDER2" => "desc",
			"OFFER_ADD_PICT_PROP" => "",
			"OFFER_TREE_PROPS" => array(
			),
			"PAGER_BASE_LINK_ENABLE" => "N",
			"PAGER_DESC_NUMBERING" => "N",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
			"PAGER_SHOW_ALL" => "N",
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_TEMPLATE" => ".default",
			"PAGER_TITLE" => "Товары",
			"PAGE_ELEMENT_COUNT" => "8",
			"PARTIAL_PRODUCT_PROPERTIES" => "N",
			"PRICE_CODE" => array(
				0 => "STANDARTPRICE",
			),
			"PRICE_VAT_INCLUDE" => "Y",
			"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",
			"PRODUCT_DISPLAY_MODE" => "Y",
			"PRODUCT_ID_VARIABLE" => "id",
			"PRODUCT_PROPERTIES" => array(
			),
			"PRODUCT_PROPS_VARIABLE" => "prop",
			"PRODUCT_QUANTITY_VARIABLE" => "",
			"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
			"PRODUCT_SUBSCRIPTION" => "Y",
			"PROPERTY_CODE" => array(
				0 => "",
				1 => "",
				2 => "",
			),
			"PROPERTY_CODE_MOBILE" => array(
			),
			"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
			"RCM_TYPE" => "personal",
			"SECTION_CODE" => "",
			"SECTION_ID" => "",
			"SECTION_ID_VARIABLE" => "",
			"SECTION_URL" => "",
			"SECTION_USER_FIELDS" => array(
				0 => "",
				1 => "",
			),
			"SEF_MODE" => "N",
			"SET_BROWSER_TITLE" => "Y",
			"SET_LAST_MODIFIED" => "N",
			"SET_META_DESCRIPTION" => "Y",
			"SET_META_KEYWORDS" => "Y",
			"SET_STATUS_404" => "N",
			"SET_TITLE" => "Y",
			"SHOW_404" => "N",
			"SHOW_ALL_WO_SECTION" => "N",
			"SHOW_CLOSE_POPUP" => "N",
			"SHOW_DISCOUNT_PERCENT" => "Y",
			"SHOW_FROM_SECTION" => "N",
			"SHOW_MAX_QUANTITY" => "N",
			"SHOW_OLD_PRICE" => "N",
			"SHOW_PRICE_COUNT" => "1",
			"SHOW_SLIDER" => "Y",
			"SLIDER_INTERVAL" => "3000",
			"SLIDER_PROGRESS" => "N",
			"TEMPLATE_THEME" => "",
			"USE_ENHANCED_ECOMMERCE" => "Y",
			"USE_MAIN_ELEMENT_SECTION" => "N",
			"USE_PRICE_COUNT" => "N",
			"USE_PRODUCT_QUANTITY" => "N",
			"BY_LINK" => "Y",
			"COMPONENT_TEMPLATE" => "product-section",
			"MESS_NOT_AVAILABLE_SERVICE" => "Недоступно",
			"DISPLAY_COMPARE" => "N",
			"TITLE" => "Акционные товары",
			"SHORT_PROPERTIES" => \Mirvendinga\Catalog::getCatalogShortProperties(),
		),
		false
	);
	unset($discountProductsFilter);
}
?>

<?
if(!empty($arResult['DISCOUNT_BRANDS'])) {
	global $discountBrandsFilter;
	$discountBrandsFilter = Array('ID' => $arResult['DISCOUNT_BRANDS']);
	$APPLICATION->IncludeComponent(
		"bitrix:news.list",
		"brands-carousel",
		array(
			"ACTIVE_DATE_FORMAT" => "d.m.Y",
			"ADD_SECTIONS_CHAIN" => "N",
			"AJAX_MODE" => "N",
			"AJAX_OPTION_ADDITIONAL" => "",
			"AJAX_OPTION_HISTORY" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "N",
			"CACHE_FILTER" => "Y",
			"CACHE_GROUPS" => "N",
			"CACHE_TIME" => "3600",
			"CACHE_TYPE" => "A",
			"CHECK_DATES" => "Y",
			"COMPONENT_TEMPLATE" => "brands-carousel",
			"DETAIL_URL" => "",
			"DISPLAY_BOTTOM_PAGER" => "N",
			"DISPLAY_DATE" => "N",
			"DISPLAY_NAME" => "N",
			"DISPLAY_PICTURE" => "N",
			"DISPLAY_PREVIEW_TEXT" => "N",
			"DISPLAY_TOP_PAGER" => "N",
			"FIELD_CODE" => array(
				0 => "ID",
				1 => "NAME",
				2 => "PREVIEW_PICTURE",
				3 => "DETAIL_PICTURE",
			),
			"FILTER_NAME" => "discountBrandsFilter",
			"HIDE_LINK_WHEN_NO_DETAIL" => "N",
			"IBLOCK_ID" => BRANDS_IB_ID,
			"IBLOCK_TYPE" => "data",
			"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
			"INCLUDE_SUBSECTIONS" => "N",
			"MESSAGE_404" => "",
			"NEWS_COUNT" => 5,
			"PAGER_BASE_LINK" => "",
			"PAGER_BASE_LINK_ENABLE" => "N",
			"PAGER_DESC_NUMBERING" => "N",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
			"PAGER_PARAMS_NAME" => "arrPager",
			"PAGER_SHOW_ALL" => "N",
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_TEMPLATE" => "",
			"PAGER_TITLE" => "Новости",
			"PARENT_SECTION" => "",
			"PARENT_SECTION_CODE" => "",
			"PREVIEW_TRUNCATE_LEN" => "",
			"PROPERTY_CODE" => array(
				0 => "",
				1 => "",
				2 => "",
				3 => "",
				4 => "",
			),
			"SET_BROWSER_TITLE" => "N",
			"SET_LAST_MODIFIED" => "N",
			"SET_META_DESCRIPTION" => "N",
			"SET_META_KEYWORDS" => "N",
			"SET_STATUS_404" => "N",
			"SET_TITLE" => "N",
			"SHOW_404" => "N",
			"SORT_BY1" => "SORT",
			"SORT_BY2" => "SORT",
			"SORT_ORDER1" => "ASC",
			"SORT_ORDER2" => "ASC",
			"STRICT_SECTION_CHECK" => "N",
			"TITLE" => "Бренды акционных товаров",
			"MORE_LINK_URL" => "/brands",
			"MORE_LINK_TEXT" => "Все бренды"
		),
		false
	);
	unset($discountBrandsFilter);
}
?>