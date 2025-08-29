<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
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

use Bitrix\Main\Localization\Loc;

$currentTabCode = $arParams['CURRENT_TAB_CODE'];
if (!isset($arResult['TAB'][$currentTabCode]))
	$currentTabCode = 'all';

$APPLICATION->SetTitle('По запросу “' . $arResult['REQUEST']['QUERY'] . '” найдено ' . Indexis::num2word($arResult['NAV_RESULT']->NavRecordCount, ['результат', 'результата', 'результатов']));
?>

<?$this->SetViewTarget("content_after_h1");?>
	<?if (count($arResult['SEARCH']) > 0):?>
		<div class="ml-tab-btn-nav ">
			<div class="ml-tab-btn-nav__container">
				<ul class="ml-tab-btn-nav__list">
					<li class="ml-tab-btn-nav__item"><a class="ml-tab-btn-nav__link<?if ($currentTabCode == 'all'):?> ml-tab-btn-nav__link_active<?endif;?>" href="<?=$APPLICATION->GetCurDir()?>?q=<?=$arResult['REQUEST']['QUERY']?>"><?=Loc::getMessage('SECTION_TITLE_ALL')?></a></li>
					<?foreach($arResult['TAB'] as $sectionCode => $arItem):?>
						<?if (count($arResult['TAB'][$sectionCode]) > 0):?>
							<li class="ml-tab-btn-nav__item">
								<a class="ml-tab-btn-nav__link<?if ($currentTabCode == $sectionCode):?> ml-tab-btn-nav__link_active<?endif;?>" href="<?=$APPLICATION->GetCurDir()?>?q=<?=$arResult['REQUEST']['QUERY']?>&tab=<?=$sectionCode?>">
									<?=Loc::getMessage('SECTION_TITLE_' . toUpper($sectionCode))?>
								</a>
							</li>
						<?endif;?>
					<?endforeach;?>
				</ul>
			</div>
		</div>
	<?endif;?>
<?$this->EndViewTarget();?>
<div class="container">
	<?if (in_array($currentTabCode, ['all', 'movies']) && count($arResult['TAB']['movies']) > 0):?>
		<?
		$GLOBALS['arMoviesFilter'] = ['ID' => $arResult['TAB']['movies']];
		$APPLICATION->IncludeComponent(
			"bitrix:catalog.section",
			"movies",
			array(
				"IBLOCK_TYPE" => "movies",
				"IBLOCK_ID" => Indexis::getIblockId('movies', 'movies'),
				"ELEMENT_SORT_FIELD" => "ID",
				"ELEMENT_SORT_ORDER" => $arResult['TAB']['movies'],
				"ELEMENT_SORT_FIELD2" => "name",
				"ELEMENT_SORT_ORDER2" => "asc",
				"PROPERTY_CODE" => "Array",
				"PROPERTY_CODE_MOBILE" => "Array",
				"META_KEYWORDS" => "-",
				"META_DESCRIPTION" => "-",
				"BROWSER_TITLE" => "-",
				"SET_LAST_MODIFIED" => "N",
				"INCLUDE_SUBSECTIONS" => "Y",
				"BASKET_URL" => "/personal/basket.php",
				"ACTION_VARIABLE" => "action",
				"PRODUCT_ID_VARIABLE" => "id",
				"SECTION_ID_VARIABLE" => "SECTION_ID",
				"PRODUCT_QUANTITY_VARIABLE" => "quantity",
				"PRODUCT_PROPS_VARIABLE" => "prop",
				"FILTER_NAME" => "arMoviesFilter",
				"CACHE_TYPE" => "A",
				"CACHE_TIME" => "36000000",
				"CACHE_FILTER" => "N",
				"CACHE_GROUPS" => "Y",
				"SET_TITLE" => "Y",
				"MESSAGE_404" => "",
				"SET_STATUS_404" => "Y",
				"SHOW_404" => "Y",
				"FILE_404" => "",
				"DISPLAY_COMPARE" => "N",
				"PAGE_ELEMENT_COUNT" => ($currentTabCode == "all" ? "8" : "16"),
				"LINE_ELEMENT_COUNT" => "3",
				"PRICE_CODE" => "Array",
				"USE_PRICE_COUNT" => "N",
				"SHOW_PRICE_COUNT" => "1",
				"PRICE_VAT_INCLUDE" => "Y",
				"USE_PRODUCT_QUANTITY" => "N",
				"ADD_PROPERTIES_TO_BASKET" => "Y",
				"PARTIAL_PRODUCT_PROPERTIES" => "N",
				"PRODUCT_PROPERTIES" => "Array",
				"DISPLAY_TOP_PAGER" => "N",
				"DISPLAY_BOTTOM_PAGER" => ($currentTabCode == "all" ? "N" : "Y"),
				"PAGER_TITLE" => "Товары",
				"PAGER_SHOW_ALWAYS" => "N",
				"PAGER_TEMPLATE" => ".default",
				"PAGER_DESC_NUMBERING" => "N",
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
				"PAGER_SHOW_ALL" => "N",
				"PAGER_BASE_LINK_ENABLE" => "N",
				"PAGER_BASE_LINK" => "",
				"PAGER_PARAMS_NAME" => "",
				"LAZY_LOAD" => "N",
				"MESS_BTN_LAZY_LOAD" => "Показать ещё",
				"LOAD_ON_SCROLL" => "N",
				"OFFERS_CART_PROPERTIES" => "Array",
				"OFFERS_FIELD_CODE" => "",
				"OFFERS_PROPERTY_CODE" => "Array",
				"OFFERS_SORT_FIELD" => "",
				"OFFERS_SORT_ORDER" => "",
				"OFFERS_SORT_FIELD2" => "",
				"OFFERS_SORT_ORDER2" => "",
				"OFFERS_LIMIT" => "0",
				"SECTION_ID" => "",
				"SECTION_CODE" => "",
				"SECTION_URL" => "/movies/",
				"DETAIL_URL" => "/movies/#ELEMENT_CODE#/",
				"USE_MAIN_ELEMENT_SECTION" => "N",
				"CONVERT_CURRENCY" => "",
				"CURRENCY_ID" => "",
				"HIDE_NOT_AVAILABLE" => "",
				"HIDE_NOT_AVAILABLE_OFFERS" => "",
				"LABEL_PROP" => array(
					0 => "VOZRAST",
				),
				"LABEL_PROP_MOBILE" => array(
					0 => "VOZRAST",
				),
				"LABEL_PROP_POSITION" => "top-left",
				"ADD_PICT_PROP" => "-",
				"PRODUCT_DISPLAY_MODE" => "",
				"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
				"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
				"ENLARGE_PRODUCT" => "STRICT",
				"ENLARGE_PROP" => "",
				"SHOW_SLIDER" => "N",
				"SLIDER_INTERVAL" => "3000",
				"SLIDER_PROGRESS" => "N",
				"OFFER_ADD_PICT_PROP" => "",
				"OFFER_TREE_PROPS" => "",
				"PRODUCT_SUBSCRIPTION" => "",
				"SHOW_DISCOUNT_PERCENT" => "",
				"DISCOUNT_PERCENT_POSITION" => "",
				"SHOW_OLD_PRICE" => "",
				"SHOW_MAX_QUANTITY" => "",
				"MESS_SHOW_MAX_QUANTITY" => "",
				"RELATIVE_QUANTITY_FACTOR" => "",
				"MESS_RELATIVE_QUANTITY_MANY" => "",
				"MESS_RELATIVE_QUANTITY_FEW" => "",
				"MESS_BTN_BUY" => "Купить",
				"MESS_BTN_ADD_TO_BASKET" => "В корзину",
				"MESS_BTN_SUBSCRIBE" => "Подписаться",
				"MESS_BTN_DETAIL" => "Подробнее",
				"MESS_NOT_AVAILABLE" => "Нет в наличии",
				"MESS_BTN_COMPARE" => "Сравнение",
				"USE_ENHANCED_ECOMMERCE" => "N",
				"DATA_LAYER_NAME" => "",
				"BRAND_PROPERTY" => "",
				"TEMPLATE_THEME" => "blue",
				"ADD_SECTIONS_CHAIN" => "N",
				"ADD_TO_BASKET_ACTION" => "",
				"SHOW_CLOSE_POPUP" => "",
				"COMPARE_PATH" => "/movies/compare.php?action=#ACTION_CODE#",
				"COMPARE_NAME" => "",
				"USE_COMPARE_LIST" => "Y",
				"BACKGROUND_IMAGE" => "-",
				"COMPATIBLE_MODE" => "Y",
				"DISABLE_INIT_JS_IN_COMPONENT" => "N",
				"SHOW_ALL_WO_SECTION" => "Y",
				"WRAPPER_CLASS" => "anim-list",
				"ITEM_CLASS" => "col-6 col-md-4 col-lg-3",
				"SHOW_ALL_RESULT_LINK" => ($currentTabCode == "all" ? "Y" : "N"),
				"ALL_RESULT_LINK" => $APPLICATION->GetCurPageParam("tab=movies", array("tab"))
			),
			false
		);
		?>
	<?endif;?>

	<?if (in_array($currentTabCode, ['all', 'contests']) && count($arResult['TAB']['contests']) > 0):?>
		<?
		$GLOBALS['arContestsFilter'] = ['ID' => $arResult['TAB']['contests']];
		$APPLICATION->IncludeComponent(
			"bitrix:catalog.section",
			"search-contests",
			array(
				"IBLOCK_TYPE" => "contests",
				"IBLOCK_ID" => Indexis::getIblockId('contests', 'contests'),
				"ELEMENT_SORT_FIELD" => "ID",
				"ELEMENT_SORT_ORDER" => $arResult['TAB']['contests'],
				"ELEMENT_SORT_FIELD2" => "name",
				"ELEMENT_SORT_ORDER2" => "asc",
				"PROPERTY_CODE" => "",
				"PROPERTY_CODE_MOBILE" => "",
				"META_KEYWORDS" => "-",
				"META_DESCRIPTION" => "-",
				"BROWSER_TITLE" => "-",
				"SET_LAST_MODIFIED" => "N",
				"INCLUDE_SUBSECTIONS" => "Y",
				"BASKET_URL" => "/personal/basket.php",
				"ACTION_VARIABLE" => "action",
				"PRODUCT_ID_VARIABLE" => "id",
				"SECTION_ID_VARIABLE" => "SECTION_ID",
				"PRODUCT_QUANTITY_VARIABLE" => "quantity",
				"PRODUCT_PROPS_VARIABLE" => "prop",
				"FILTER_NAME" => "arContestsFilter",
				"CACHE_TYPE" => "A",
				"CACHE_TIME" => "36000000",
				"CACHE_FILTER" => "N",
				"CACHE_GROUPS" => "Y",
				"SET_TITLE" => "Y",
				"MESSAGE_404" => "",
				"SET_STATUS_404" => "Y",
				"SHOW_404" => "Y",
				"FILE_404" => "",
				"DISPLAY_COMPARE" => "N",
				"PAGE_ELEMENT_COUNT" => ($currentTabCode == "all" ? "8" : "16"),
				"LINE_ELEMENT_COUNT" => "3",
				"PRICE_CODE" => "Array",
				"USE_PRICE_COUNT" => "N",
				"SHOW_PRICE_COUNT" => "1",
				"PRICE_VAT_INCLUDE" => "Y",
				"USE_PRODUCT_QUANTITY" => "N",
				"ADD_PROPERTIES_TO_BASKET" => "Y",
				"PARTIAL_PRODUCT_PROPERTIES" => "N",
				"PRODUCT_PROPERTIES" => "Array",
				"DISPLAY_TOP_PAGER" => "N",
				"DISPLAY_BOTTOM_PAGER" => ($currentTabCode == "all" ? "N" : "Y"),
				"PAGER_TITLE" => "Товары",
				"PAGER_SHOW_ALWAYS" => "N",
				"PAGER_TEMPLATE" => ".default",
				"PAGER_DESC_NUMBERING" => "N",
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
				"PAGER_SHOW_ALL" => "N",
				"PAGER_BASE_LINK_ENABLE" => "N",
				"PAGER_BASE_LINK" => "",
				"PAGER_PARAMS_NAME" => "",
				"LAZY_LOAD" => "N",
				"MESS_BTN_LAZY_LOAD" => "Показать ещё",
				"LOAD_ON_SCROLL" => "N",
				"OFFERS_CART_PROPERTIES" => "Array",
				"OFFERS_FIELD_CODE" => "",
				"OFFERS_PROPERTY_CODE" => "Array",
				"OFFERS_SORT_FIELD" => "",
				"OFFERS_SORT_ORDER" => "",
				"OFFERS_SORT_FIELD2" => "",
				"OFFERS_SORT_ORDER2" => "",
				"OFFERS_LIMIT" => "0",
				"SECTION_ID" => "",
				"SECTION_CODE" => "",
				"SECTION_URL" => "/contests/",
				"DETAIL_URL" => "/contests/#ELEMENT_CODE#/",
				"USE_MAIN_ELEMENT_SECTION" => "N",
				"CONVERT_CURRENCY" => "",
				"CURRENCY_ID" => "",
				"HIDE_NOT_AVAILABLE" => "",
				"HIDE_NOT_AVAILABLE_OFFERS" => "",
				"LABEL_PROP" => array(),
				"LABEL_PROP_MOBILE" => array(),
				"LABEL_PROP_POSITION" => "top-left",
				"ADD_PICT_PROP" => "-",
				"PRODUCT_DISPLAY_MODE" => "",
				"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
				"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
				"ENLARGE_PRODUCT" => "STRICT",
				"ENLARGE_PROP" => "",
				"SHOW_SLIDER" => "N",
				"SLIDER_INTERVAL" => "3000",
				"SLIDER_PROGRESS" => "N",
				"OFFER_ADD_PICT_PROP" => "",
				"OFFER_TREE_PROPS" => "",
				"PRODUCT_SUBSCRIPTION" => "",
				"SHOW_DISCOUNT_PERCENT" => "",
				"DISCOUNT_PERCENT_POSITION" => "",
				"SHOW_OLD_PRICE" => "",
				"SHOW_MAX_QUANTITY" => "",
				"MESS_SHOW_MAX_QUANTITY" => "",
				"RELATIVE_QUANTITY_FACTOR" => "",
				"MESS_RELATIVE_QUANTITY_MANY" => "",
				"MESS_RELATIVE_QUANTITY_FEW" => "",
				"MESS_BTN_BUY" => "Купить",
				"MESS_BTN_ADD_TO_BASKET" => "В корзину",
				"MESS_BTN_SUBSCRIBE" => "Подписаться",
				"MESS_BTN_DETAIL" => "Подробнее",
				"MESS_NOT_AVAILABLE" => "Нет в наличии",
				"MESS_BTN_COMPARE" => "Сравнение",
				"USE_ENHANCED_ECOMMERCE" => "N",
				"DATA_LAYER_NAME" => "",
				"BRAND_PROPERTY" => "",
				"TEMPLATE_THEME" => "blue",
				"ADD_SECTIONS_CHAIN" => "N",
				"ADD_TO_BASKET_ACTION" => "",
				"SHOW_CLOSE_POPUP" => "",
				"COMPARE_PATH" => "/contests/compare.php?action=#ACTION_CODE#",
				"COMPARE_NAME" => "",
				"USE_COMPARE_LIST" => "Y",
				"BACKGROUND_IMAGE" => "-",
				"COMPATIBLE_MODE" => "Y",
				"DISABLE_INIT_JS_IN_COMPONENT" => "N",
				"SHOW_ALL_WO_SECTION" => "Y",
				"WRAPPER_CLASS" => "anim-list",
				"ITEM_CLASS" => "col-6 col-md-4 col-lg-3",
				"HIDE_TITLE" => ($currentTabCode == "all" ? "N" : "Y")
			),
			false
		);
		?>
	<?endif;?>

	<?if (count($arResult['SEARCH']) > 0):?>
		<?foreach(['about', 'partners'] as $sectionCode):?>
			<?if (($currentTabCode == 'all' || $currentTabCode == $sectionCode) && count($arResult['TAB'][$sectionCode]) > 0):?>
				<section class="ml-section ml-search-section">
					<div class="ml-section-header">
						<h2 class="ml-section-subtitle"><?=Loc::getMessage("SECTION_TITLE_" . toUpper($sectionCode))?></h2>
					</div>
					<div class="ml-section-body">
						<div class="row">
							<div class="col-lg-10 col-xl-9">
								<?foreach($arResult['TAB'][$sectionCode] as $index => $arItem):?>
									<?
									if ($index == 3)
										break;
									?>
									<div class="text-item">
										<a class="text-item__link" href="<?=$arItem['URL']?>">
											<p class="text-item__title"><?=$arItem['TITLE_FORMATED']?></p>
											<p class="text-item__desc"><?=$arItem['BODY_FORMATED']?></p>
										</a>
									</div>
								<?endforeach;?>
							</div>
						</div>
					</div>
				</section>
			<?endif;?>
		<?endforeach;?>
	<?else:?>
		<form class="ml-search-form" action="" method="get">
			<input class="ml-search-form__input" type="text" name="q" value="<?=$arResult["REQUEST"]["QUERY"]?>" placeholder="Поиск">
			<button class="ml-search-form__submit" type="submit">
				<svg class="icon icon-search ">
					<use xlink:href="#search"></use>
				</svg>
			</button>
		</form>
		<div class="ml-search-result">
			<p>Ничего не найдено</p>
		</div>
	<?endif;?>
</div>