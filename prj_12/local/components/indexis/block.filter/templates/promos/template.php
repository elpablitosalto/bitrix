<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>

<? if ($arParams['SHOW_FILTER'] == 'Y') { ?>

	<?/* if ($arParams['HIDE_TOP_BANNER_ON_MOBILE'] == "Y") : ?>
		<div class="nb-stocks-filter">
			<? $APPLICATION->IncludeComponent(
				"bitrix:breadcrumb",
				"",
				array(
					"START_FROM" => "0",
					"PATH" => "",
					"SITE_ID" => SITE_ID
				)
			); ?>
			<? if (mb_strlen($arParams["H_FST_PART_M"]) > 0) : ?>
				<p class="nb-section__title">
					<?= $arParams["H_FST_PART_M"] ?>
					<? if (mb_strlen($arParams["H_SEC_PART_M"]) > 0) : ?>
						<span class="font-weight_regular"><?= $arParams["H_SEC_PART_M"] ?></span>
					<? endif; ?>
				</p>
			<? endif; ?>
	<? endif; */?>
		<?
		$APPLICATION->IncludeComponent(
			"bitrix:catalog.smart.filter",
			//"promos_filter",
			"doctor_filter",
			array(
				"AJAX_MODE" => $arParams['AJAX_MODE'],
				"AJAX_OPTION_ADDITIONAL" => $arParams['AJAX_OPTION_ADDITIONAL'],
				"AJAX_OPTION_HISTORY" => $arParams['AJAX_OPTION_HISTORY'],
				"AJAX_OPTION_JUMP" => $arParams['AJAX_OPTION_JUMP'],
				"AJAX_OPTION_STYLE" => $arParams['AJAX_OPTION_STYLE'],
				"COMPONENT_TEMPLATE" => ".default",
				"IBLOCK_ID" => $arParams['IBLOCK_ID'],
				"IBLOCK_TYPE" => $arParams['IBLOCK_TYPE'],
				"SECTION_ID" => "",
				"SECTION_CODE" => "",
				"PREFILTER_NAME" => $arParams['PREFILTER_NAME'],
				"FILTER_NAME" => $arParams['FILTER_NAME'],
				"HIDE_NOT_AVAILABLE" => "N",
				"TEMPLATE_THEME" => "blue",
				"FILTER_VIEW_MODE" => "horizontal",
				"DISPLAY_ELEMENT_COUNT" => "Y",
				"SEF_MODE" => "N",
				"CACHE_TYPE" => "A",
				"CACHE_TIME" => "36000000",
				"CACHE_GROUPS" => "Y",
				"SAVE_IN_SESSION" => "N",
				"INSTANT_RELOAD" => "Y",
				"PAGER_PARAMS_NAME" => "arrPager",
				"PRICE_CODE" => array(
					0 => "BASE",
				),
				"CONVERT_CURRENCY" => "Y",
				"XML_EXPORT" => "N",
				"SECTION_TITLE" => "-",
				"SECTION_DESCRIPTION" => "-",
				"POPUP_POSITION" => "left",
				"SEF_RULE" => "",
				"SECTION_CODE_PATH" => "",
				"SMART_FILTER_PATH" => $_REQUEST["SMART_FILTER_PATH"],
				"CURRENCY_ID" => "RUB",
				//"DEFAULT_SPECIALIZATIONS" => $arParams["DEFAULT_SPECIALIZATIONS"]
				"TYPE_FILTER" => "promos",
				//"BLOCK_ID" => $arParams['BLOCK_ID'],
				"SYNC_CONTENT_CLINIC" => $arParams['SYNC_CONTENT_CLINIC']
			),
			$component
		);
		?>
	<?/* if ($arParams['HIDE_TOP_BANNER_ON_MOBILE'] == "Y") : ?>
		</div><? // .nb-stocks-filter ?>
	<? endif; */?>

    <?

    if (empty($GLOBALS[$arParams['FILTER_NAME']]) && !empty($arParams["DEFAULT_SERVICE"])) {
        $GLOBALS[$arParams['FILTER_NAME']] = [
            'PROPERTY_SHOW_SERVICES' => $arParams["DEFAULT_SERVICE"]
        ];
    }
    ?>
<? } else {
    if (!empty($arParams["DEFAULT_SERVICE"])) {
        $GLOBALS[$arParams['FILTER_NAME']] = [
            'PROPERTY_SHOW_SERVICES' => $arParams["DEFAULT_SERVICE"]
        ];
    }
} ?>

<?
// Фильтр по выбранной клинике в Контактах -->
if ($_REQUEST['set_filter'] != 'y' && $arParams['SYNC_CONTENT_CLINIC'] == 'Y') {
    if (intval($_COOKIE['chosenAddressId']) > 0) {
        $bSetChosenAddress = true;

        foreach ($GLOBALS["arSiteConfig"]['PROPERTY_IDS']['CLINICS'] as $key => $val) {
            foreach ($GLOBALS[$arParams['FILTER_NAME']] as $key_2 => $val_2) {
                if (intval($key_2 == '=PROPERTY_' . $val)) {
                    $bSetChosenAddress = false;
                }
            }
        }
        if ($bSetChosenAddress) {
            $GLOBALS[$arParams['FILTER_NAME']]['PROPERTY_CLINICS'] = $_COOKIE['chosenAddressId'];
            if (isset($GLOBALS[$arParams['FILTER_NAME']]['PROPERTY_SHOW_SERVICES'])) {
                unset($GLOBALS[$arParams['FILTER_NAME']]['PROPERTY_SHOW_SERVICES']);
            }
        }
    }
}
// <-- Фильтр по выбранной клинике в Контактах
?>

<? $APPLICATION->IncludeComponent(
    "bitrix:catalog.section",
    "promos_list",
    array(
        "ACTION_VARIABLE" => "action",
        "ADD_PICT_PROP" => "MORE_PHOTO",
        "ADD_PROPERTIES_TO_BASKET" => "Y",
        "ADD_SECTIONS_CHAIN" => "N",
        "ADD_TO_BASKET_ACTION" => "ADD",
        "AJAX_MODE" => $arParams['AJAX_MODE'],
        "AJAX_OPTION_ADDITIONAL" => $arParams['AJAX_OPTION_ADDITIONAL'],
        "AJAX_OPTION_HISTORY" => $arParams['AJAX_OPTION_HISTORY'],
        "AJAX_OPTION_JUMP" => $arParams['AJAX_OPTION_JUMP'],
        "AJAX_OPTION_STYLE" => $arParams['AJAX_OPTION_STYLE'],
        "BACKGROUND_IMAGE" => "UF_BACKGROUND_IMAGE",
        "BASKET_URL" => "",
        "BRAND_PROPERTY" => "-",
        "BROWSER_TITLE" => "-",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "COMPATIBLE_MODE" => "Y",
        "CONVERT_CURRENCY" => "Y",
        "CURRENCY_ID" => "RUB",
        "CUSTOM_FILTER" => "",
        "DATA_LAYER_NAME" => "dataLayer",
        "DETAIL_URL" => "",
        "DISABLE_INIT_JS_IN_COMPONENT" => "N",
        "DISCOUNT_PERCENT_POSITION" => "bottom-right",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "DISPLAY_TOP_PAGER" => "N",
        "ELEMENT_SORT_FIELD" => "sort",
        "ELEMENT_SORT_FIELD2" => "id",
        "ELEMENT_SORT_ORDER" => "asc",
        "ELEMENT_SORT_ORDER2" => "desc",
        "ENLARGE_PRODUCT" => "PROP",
        "ENLARGE_PROP" => "NEWPRODUCT",
        "FILTER_NAME" => $arParams['FILTER_NAME'],
        "HIDE_NOT_AVAILABLE" => "N",
        "HIDE_NOT_AVAILABLE_OFFERS" => "N",
        "IBLOCK_ID" => $arParams['IBLOCK_ID'],
        "IBLOCK_TYPE" => $arParams['IBLOCK_TYPE'],
        "INCLUDE_SUBSECTIONS" => "Y",
        "LABEL_PROP" => array(
            0 => "NEWPRODUCT",
        ),
        "LABEL_PROP_MOBILE" => "",
        "LABEL_PROP_POSITION" => "top-left",
        "LAZY_LOAD" => "Y",
        "LINE_ELEMENT_COUNT" => "2",
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
        "OFFERS_CART_PROPERTIES" => array(),
        "OFFERS_FIELD_CODE" => array(
            0 => "",
            1 => "",
        ),
        "OFFERS_LIMIT" => "5",
        "OFFERS_PROPERTY_CODE" => array(),
        "OFFERS_SORT_FIELD" => "sort",
        "OFFERS_SORT_FIELD2" => "id",
        "OFFERS_SORT_ORDER" => "asc",
        "OFFERS_SORT_ORDER2" => "desc",
        "OFFER_ADD_PICT_PROP" => "MORE_PHOTO",
        "OFFER_TREE_PROPS" => array(),
        "PAGER_BASE_LINK_ENABLE" => "N",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => "counter",
        "PAGER_TITLE" => "",
        "PAGE_ELEMENT_COUNT" => "4",
        "PARTIAL_PRODUCT_PROPERTIES" => "N",
        "PRICE_CODE" => array(),
        "PRICE_VAT_INCLUDE" => "Y",
        "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",
        "PRODUCT_DISPLAY_MODE" => "Y",
        "PRODUCT_ID_VARIABLE" => "id",
        "PRODUCT_PROPERTIES" => array(),
        "PRODUCT_PROPS_VARIABLE" => "prop",
        "PRODUCT_QUANTITY_VARIABLE" => "",
        "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'4','BIG_DATA':false}]",
        "PRODUCT_SUBSCRIPTION" => "Y",
        "PROPERTY_CODE" => array("PRICE_BEFORE"),
        "LIST_PROPERTY_CODE" => array("PRICE_BEFORE"),
        "PROPERTY_CODE_MOBILE" => "",
        "RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
        "RCM_TYPE" => "personal",
        "SECTION_CODE" => "",
        "SECTION_ID" => "",
        "SECTION_ID_VARIABLE" => "SECTION_ID",
        "SECTION_URL" => "",
        "SECTION_USER_FIELDS" => array(
            0 => "",
            1 => "",
        ),
        "SEF_MODE" => "N",
        "SET_BROWSER_TITLE" => "N",
        "SET_LAST_MODIFIED" => "N",
        "SET_META_DESCRIPTION" => "N",
        "SET_META_KEYWORDS" => "N",
        "SET_STATUS_404" => "N",
        "SET_TITLE" => "Y",
        "SHOW_404" => "N",
        "SHOW_ALL_WO_SECTION" => "Y",
        "SHOW_CLOSE_POPUP" => "N",
        "SHOW_DISCOUNT_PERCENT" => "Y",
        "SHOW_FROM_SECTION" => "N",
        "SHOW_MAX_QUANTITY" => "N",
        "SHOW_OLD_PRICE" => "N",
        "SHOW_PRICE_COUNT" => "1",
        "SHOW_SLIDER" => "N",
        "SLIDER_INTERVAL" => "3000",
        "SLIDER_PROGRESS" => "N",
        "TEMPLATE_THEME" => "blue",
        "USE_ENHANCED_ECOMMERCE" => "Y",
        "USE_MAIN_ELEMENT_SECTION" => "N",
        "USE_PRICE_COUNT" => "N",
        "USE_PRODUCT_QUANTITY" => "N",
        "COMPONENT_TEMPLATE" => "promos_list",
        "MESS_NOT_AVAILABLE_SERVICE" => "Недоступно",
        "DISPLAY_COMPARE" => "N"
    ),
    $component
);
?>