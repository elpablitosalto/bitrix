<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

use Bitrix\Main\Loader;

$this->setFrameMode(true);
if (mb_strlen($_REQUEST['q']) > 0) {
    $APPLICATION->SetTitle('Результаты поиска: «' . htmlspecialcharsbx($_REQUEST['q']) . '»');
}

global $searchFilter;

$elementOrder = [];
if ($arParams['USE_SEARCH_RESULT_ORDER'] === 'N')
{
	$elementOrder = [
		"ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
		"ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
		"ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
		"ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
	];
}

// Сортировка -->
$ELEMENT_SORT_FIELD = $arParams['ELEMENT_SORT_FIELD'];
$ELEMENT_SORT_ORDER = $arParams['ELEMENT_SORT_ORDER'];
if (strlen($_COOKIE['ELEMENT_SORT_FIELD']) > 0) {
    $ELEMENT_SORT_FIELD = $_COOKIE['ELEMENT_SORT_FIELD'];
}
if (strlen($_COOKIE['ELEMENT_SORT_ORDER']) > 0) {
    $ELEMENT_SORT_ORDER = $_COOKIE['ELEMENT_SORT_ORDER'];
}

$elementOrder['ELEMENT_SORT_FIELD'] = $ELEMENT_SORT_FIELD;
$elementOrder['ELEMENT_SORT_ORDER'] = $ELEMENT_SORT_ORDER;
// <-- Сортировка
?>
<section class="page-title page-title__search">
    <?
    $APPLICATION->IncludeComponent(
        "bitrix:breadcrumb",
        "stroyservis",
        array(
            "START_FROM" => "0",
            "PATH" => "",
            "SITE_ID" => SITE_ID
        )
    );
    ?>
    <h1>Результаты поиска<?if (mb_strlen($_REQUEST['q']) > 0):?>: <span class="page-title__search-title">«<?=htmlspecialcharsbx($_REQUEST['q'])?>»</span><?endif;?></h1>
    <?$APPLICATION->ShowViewContent("search_result")?>
</section>

<?if (mb_strlen($_REQUEST['q']) == 0):?>
    <div class="search-text">
        <p>Пожалуйста введите корректный поисковый запрос.</p>
    </div>
<?endif;?>

    <?php

    if (Loader::includeModule('search'))
    {
        $arElements = $APPLICATION->IncludeComponent(
            "bitrix:search.page",
            ".default",
            [
                "RESTART" => $arParams["RESTART"],
                "NO_WORD_LOGIC" => $arParams["NO_WORD_LOGIC"],
                "USE_LANGUAGE_GUESS" => $arParams["USE_LANGUAGE_GUESS"],
                "CHECK_DATES" => $arParams["CHECK_DATES"],
                "arrFILTER" => [
                    "iblock_".$arParams["IBLOCK_TYPE"],
                ],
                "arrFILTER_iblock_".$arParams["IBLOCK_TYPE"] => [
                    $arParams["IBLOCK_ID"],
                ]	,
                "USE_TITLE_RANK" => $arParams['USE_TITLE_RANK'],
                "DEFAULT_SORT" => "rank",
                "FILTER_NAME" => "",
                "SHOW_WHERE" => "N",
                "arrWHERE" => [],
                "SHOW_WHEN" => "N",
                "PAGE_RESULT_COUNT" => ($arParams["PAGE_RESULT_COUNT"] ?? 50),
                "DISPLAY_TOP_PAGER" => "N",
                "DISPLAY_BOTTOM_PAGER" => "N",
                "PAGER_TITLE" => "",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => "N",
            ],
            $component,
            [
                'HIDE_ICONS' => 'Y',
            ]
        );

        if (!empty($arElements) && is_array($arElements))
        {
            $searchFilter = [
                "ID" => $arElements,
            ];
//            if ($arParams['USE_SEARCH_RESULT_ORDER'] === 'Y')
//            {
//                $elementOrder = [
//                    "ELEMENT_SORT_FIELD" => "ID",
//                    "ELEMENT_SORT_ORDER" => $arElements,
//                ];
//            }
            ?>

            <?$APPLICATION->ShowViewContent("category_result")?>

            <?
        }
        else
        {
            if (is_array($arElements))
            {
                ?>
                <div class="search-text">
                    <?
                    echo GetMessage("CT_BCSE_NOT_FOUND");
                    ?>
                </div>
                <?php
                return;
            }
        }
    }
    else
    {
        $searchQuery = '';
        if (isset($_REQUEST['q']) && is_string($_REQUEST['q']))
            $searchQuery = trim($_REQUEST['q']);
        if ($searchQuery !== '')
        {
            $searchFilter = [
                '*SEARCHABLE_CONTENT' => $searchQuery
            ];
        }
        unset($searchQuery);
    }

    if (!empty($searchFilter) && is_array($searchFilter))
    {
        ?>
    <section class="page-main">
        <div class="page-main__control">
            <div class="page-main__control-filter">
                <h2>Фильтр</h2>
                <svg width="21" height="16">
                    <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons/sprite/svg-sprite.svg#filter"></use>
                </svg>
            </div>
            <select id="jsSortCatalog">
                <option value="SORT:ASC" <? if ($elementOrder['ELEMENT_SORT_FIELD'] == 'SORT') {
                    echo 'selected';
                } ?>>По популярности</option>
                <option value="catalog_PRICE_1:ASC" <? if ($elementOrder['ELEMENT_SORT_FIELD'] == 'catalog_PRICE_1' && $elementOrder['ELEMENT_SORT_ORDER'] == 'ASC') {
                    echo 'selected';
                } ?>>Сначала дешевле</option>
                <option value="catalog_PRICE_1:DESC" <? if ($elementOrder['ELEMENT_SORT_FIELD'] == 'catalog_PRICE_1' && $elementOrder['ELEMENT_SORT_ORDER'] == 'DESC') {
                    echo 'selected';
                } ?>>Сначала дороже</option>
                <option value="PROPERTY_RAITING_VAL:DESC" <? if ($elementOrder['ELEMENT_SORT_FIELD'] == 'PROPERTY_RAITING_VAL') {
                    echo 'selected';
                } ?>>По рейтингу</option>
                <option value="NAME:ASC" <? if ($elementOrder['ELEMENT_SORT_FIELD'] == 'NAME') {
                    echo 'selected';
                } ?>>По названию</option>
            </select>
        </div>
        <div class="page-main__wrapper">
            <div class="page-main__filter">
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:catalog.smart.filter",
                    "stroyservis",
                    array(
                        "FILTER_NAME" => $arParams["FILTER_NAME"],
                        'PREFILTER_NAME' => $arParams["FILTER_NAME"],
                        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                        "SHOW_ALL_WO_SECTION" => 'Y',
                        "PRICE_CODE" => $arParams["PRICE_CODE"],
                        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                        "CACHE_TIME" => $arParams["CACHE_TIME"],
                        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                        "SAVE_IN_SESSION" => "N",
                        "FILTER_VIEW_MODE" => $arParams["FILTER_VIEW_MODE"],
                        "XML_EXPORT" => "N",
                        "SECTION_TITLE" => "NAME",
                        "SECTION_DESCRIPTION" => "DESCRIPTION",
                        'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
                        "TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
                        'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                        'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                        "SEF_MODE" => $arParams["SEF_MODE"],
                        "SEF_RULE" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["smart_filter"],
                        "SMART_FILTER_PATH" => $arResult["VARIABLES"]["SMART_FILTER_PATH"],
                        "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
                        "INSTANT_RELOAD" => $arParams["INSTANT_RELOAD"],
                        'SECTION_CODE_CATALOG' => "/".$arResult['VARIABLES']['SECTION_CODE'],
                        "AJAX_MODE" => $arParams["AJAX_MODE"],
                        "AJAX_OPTION_JUMP" => $arParams["AJAX_OPTION_JUMP"],
                        "AJAX_OPTION_STYLE" => $arParams["AJAX_OPTION_STYLE"],
                        "AJAX_OPTION_HISTORY" => $arParams["AJAX_OPTION_HISTORY"],
                    ),
                    $component,
                    []
                );
                ?>
            </div>
            <?
            $arParams['LINE_ELEMENT_COUNT'] = (int)($arParams['LINE_ELEMENT_COUNT'] ?? 3);
            if ($arParams['LINE_ELEMENT_COUNT'] < 2)
            {
                $arParams['LINE_ELEMENT_COUNT'] = 2;
            }
            elseif ($arParams['LINE_ELEMENT_COUNT'] > 4)
            {
                $arParams['LINE_ELEMENT_COUNT'] = 4;
            }

            $componentParams = [
                "HIDE_FAST_FILTER" => "Y",
                "AJAX_MODE" => $arParams["AJAX_MODE"],
                "AJAX_OPTION_JUMP" => $arParams["AJAX_OPTION_JUMP"],
                "AJAX_OPTION_STYLE" => $arParams["AJAX_OPTION_STYLE"],
                "AJAX_OPTION_HISTORY" => $arParams["AJAX_OPTION_HISTORY"],
                "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                "PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
                "LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
                "PROPERTY_CODE" => $arParams["PROPERTY_CODE"],
                "PROPERTY_CODE_MOBILE" => ($arParams["PROPERTY_CODE_MOBILE"] ?? []),
                "OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
                "OFFERS_FIELD_CODE" => $arParams["OFFERS_FIELD_CODE"],
                "OFFERS_PROPERTY_CODE" => $arParams["OFFERS_PROPERTY_CODE"],
                "OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
                "OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
                "OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
                "OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
                "OFFERS_LIMIT" => $arParams["OFFERS_LIMIT"],
                "SECTION_URL" => $arParams["SECTION_URL"],
                "DETAIL_URL" => $arParams["DETAIL_URL"],
                "BASKET_URL" => $arParams["BASKET_URL"],
                "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
                "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
                "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
                "PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
                "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
                "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                "CACHE_TIME" => $arParams["CACHE_TIME"],
                "DISPLAY_COMPARE" => $arParams["DISPLAY_COMPARE"],
                "PRICE_CODE" => $arParams["~PRICE_CODE"],
                "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
                "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
                "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
                "PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],
                "USE_PRODUCT_QUANTITY" => $arParams["USE_PRODUCT_QUANTITY"],
                "ADD_PROPERTIES_TO_BASKET" => ($arParams["ADD_PROPERTIES_TO_BASKET"] ?? ''),
                "PARTIAL_PRODUCT_PROPERTIES" => ($arParams["PARTIAL_PRODUCT_PROPERTIES"] ?? ''),
                "CONVERT_CURRENCY" => $arParams["CONVERT_CURRENCY"],
                "CURRENCY_ID" => $arParams["CURRENCY_ID"],
                "HIDE_NOT_AVAILABLE" => $arParams["HIDE_NOT_AVAILABLE"],
                "HIDE_NOT_AVAILABLE_OFFERS" => $arParams["HIDE_NOT_AVAILABLE_OFFERS"],
                "DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
                "DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
                "PAGER_TITLE" => $arParams["PAGER_TITLE"],
                "PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
                "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
                "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
                "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
                "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
                "LAZY_LOAD" => ($arParams["LAZY_LOAD"] ?? 'N'),
                "MESS_BTN_LAZY_LOAD" => ($arParams["~MESS_BTN_LAZY_LOAD"] ?? ''),
                "LOAD_ON_SCROLL" => ($arParams["LOAD_ON_SCROLL"] ?? 'N'),
                "FILTER_NAME" => "searchFilter",
                "SECTION_ID" => "",
                "SECTION_CODE" => "",
                "SECTION_USER_FIELDS" => [],
                "INCLUDE_SUBSECTIONS" => "Y",
                "SHOW_ALL_WO_SECTION" => "Y",
                "META_KEYWORDS" => "",
                "META_DESCRIPTION" => "",
                "BROWSER_TITLE" => "",
                "ADD_SECTIONS_CHAIN" => "N",
                "SET_TITLE" => "N",
                "SET_STATUS_404" => "N",
                "CACHE_FILTER" => "N",
                "CACHE_GROUPS" => "N",

                'LABEL_PROP' => ($arParams['LABEL_PROP'] ?? ''),
                'LABEL_PROP_MOBILE' => ($arParams['LABEL_PROP_MOBILE'] ?? ''),
                'LABEL_PROP_POSITION' => ($arParams['LABEL_PROP_POSITION'] ?? ''),
                'ADD_PICT_PROP' => ($arParams['ADD_PICT_PROP'] ?? ''),
                'PRODUCT_DISPLAY_MODE' => ($arParams['PRODUCT_DISPLAY_MODE'] ?? ''),
                'PRODUCT_BLOCKS_ORDER' => ($arParams['PRODUCT_BLOCKS_ORDER'] ?? ''),
                'PRODUCT_ROW_VARIANTS' => ($arParams['PRODUCT_ROW_VARIANTS'] ?? ''),
                'ENLARGE_PRODUCT' => ($arParams['ENLARGE_PRODUCT'] ?? ''),
                'ENLARGE_PROP' => ($arParams['ENLARGE_PROP'] ?? ''),
                'SHOW_SLIDER' => ($arParams['SHOW_SLIDER'] ?? 'Y'),
                'SLIDER_INTERVAL' => ($arParams['SLIDER_INTERVAL'] ?? '3000'),
                'SLIDER_PROGRESS' => ($arParams['SLIDER_PROGRESS'] ?? 'N'),

                'OFFER_ADD_PICT_PROP' => ($arParams['OFFER_ADD_PICT_PROP'] ?? ''),
                'OFFER_TREE_PROPS' => ($arParams['OFFER_TREE_PROPS'] ?? []),
                'PRODUCT_SUBSCRIPTION' => ($arParams['PRODUCT_SUBSCRIPTION'] ?? ''),
                'SHOW_DISCOUNT_PERCENT' => ($arParams['SHOW_DISCOUNT_PERCENT'] ?? ''),
                'SHOW_OLD_PRICE' => ($arParams['SHOW_OLD_PRICE'] ?? ''),
                'SHOW_MAX_QUANTITY' => ($arParams['SHOW_MAX_QUANTITY'] ?? ''),
                'MESS_SHOW_MAX_QUANTITY' => ($arParams['~MESS_SHOW_MAX_QUANTITY'] ?? ''),
                'RELATIVE_QUANTITY_FACTOR' => ($arParams['RELATIVE_QUANTITY_FACTOR'] ?? ''),
                'MESS_RELATIVE_QUANTITY_MANY' => ($arParams['~MESS_RELATIVE_QUANTITY_MANY'] ?? ''),
                'MESS_RELATIVE_QUANTITY_FEW' => ($arParams['~MESS_RELATIVE_QUANTITY_FEW'] ?? ''),
                'MESS_BTN_BUY' => ($arParams['~MESS_BTN_BUY'] ?? ''),
                'MESS_BTN_ADD_TO_BASKET' => ($arParams['~MESS_BTN_ADD_TO_BASKET'] ?? ''),
                'MESS_BTN_SUBSCRIBE' => ($arParams['~MESS_BTN_SUBSCRIBE'] ?? ''),
                'MESS_BTN_DETAIL' => ($arParams['~MESS_BTN_DETAIL'] ?? ''),
                'MESS_NOT_AVAILABLE' => ($arParams['~MESS_NOT_AVAILABLE'] ?? ''),
                'MESS_BTN_COMPARE' => ($arParams['~MESS_BTN_COMPARE'] ?? ''),

                'USE_ENHANCED_ECOMMERCE' => ($arParams['USE_ENHANCED_ECOMMERCE'] ?? ''),
                'DATA_LAYER_NAME' => ($arParams['DATA_LAYER_NAME'] ?? ''),
                'BRAND_PROPERTY' => ($arParams['BRAND_PROPERTY'] ?? ''),

                'TEMPLATE_THEME' => ($arParams['TEMPLATE_THEME'] ?? ''),
                'ADD_TO_BASKET_ACTION' => ($arParams['ADD_TO_BASKET_ACTION'] ?? ''),
                'SHOW_CLOSE_POPUP' => ($arParams['SHOW_CLOSE_POPUP'] ?? ''),
                'COMPARE_PATH' => ($arParams['COMPARE_PATH'] ?? ''),
                'COMPARE_NAME' => ($arParams['COMPARE_NAME'] ?? ''),
                'USE_COMPARE_LIST' => ($arParams['USE_COMPARE_LIST'] ?? ''),
                'PAGER_BASE_LINK' => $APPLICATION->GetCurPageParam("", array("bxajaxid", "PAGEN_1", "PAGEN_2", "PAGEN_3")),
                'PAGER_BASE_LINK_ENABLE' => 'Y'
            ] + $elementOrder;

            if (isset($GLOBALS[$arParams["FILTER_NAME"]]["FACET_OPTIONS"]))
                unset($GLOBALS[$arParams["FILTER_NAME"]]["FACET_OPTIONS"]);

            $APPLICATION->IncludeComponent(
                "bitrix:catalog.section",
                "stroyservis",
                $componentParams,
                $arResult["THEME_COMPONENT"],
                [
                    'HIDE_ICONS' => 'Y',
                ]
            );

            if (!isset($GLOBALS[$arParams['FILTER_NAME']]))
                $GLOBALS[$arParams['FILTER_NAME']] = [];

            $res = CIBlockElement::GetList(
                ['SORT' => 'ASC'],
                array_merge($GLOBALS[$arParams['FILTER_NAME']], [
                    'IBLOCK_ID' => $arParams['IBLOCK_ID'],
                    'ACTIVE_DATE' => 'Y',
                    'ACTIVE' => 'Y',
                ]),
                false,
                false, [
                'ID', 'IBLOCK_SECTION_ID'
            ]);

            $arSectionIds = [];
            $arProductIds = [];
            $productCount = $res->SelectedRowsCount();

            while($ob = $res->GetNextElement()) {
                $arFields = $ob->GetFields();
                // $arSectionIds[$arFields['IBLOCK_SECTION_ID']] = $arFields['IBLOCK_SECTION_ID'];
                $arProductIds[] = $arFields['ID'];
            }

            if (count($arProductIds) > 0) {
                $dbGroups = CIBlockElement::GetElementGroups($arProductIds, false, ['ID']);
                while ($arGroup = $dbGroups->GetNext()) {
                    $arSectionIds[$arGroup['ID']] = $arGroup['ID'];
                }
            }
            ?>

            <?$this->SetViewTarget("search_result");?>
                <p class="page-title__search-numbers">Найдено товаров: <?=Indexis::num2word($productCount, ['#NUM# товар', '#NUM# товара', '#NUM# товаров'])?> в <?=Indexis::num2word(count($arSectionIds), ['#NUM# категории', '#NUM# категориях', '#NUM# категориях'])?></p>
            <?$this->EndViewTarget();?>

            <?$this->SetViewTarget("category_result");?>
                <section class="category-grouts">
                    <ul class="category__list">
                        <?
                        if (count($arSectionIds) > 0) {
                            $rsSect = CIBlockSection::GetList(
                                array('SORT' => 'ASC'),
                                array(
                                    'IBLOCK_ID' => $arParams['IBLOCK_ID'],
                                    'ID' => $arSectionIds
                                ),
                                true,
                                array('ID', 'NAME', 'SECTION_PAGE_URL', 'PICTURE')
                            );

                            while ($arSection = $rsSect->GetNext()) {
                                ?>
                                <li class="category__item">
                                    <a class="category__link" href="<?=$arSection['SECTION_PAGE_URL']?>">
                                        <p class="category__title"><?=$arSection['NAME']?> <span>(<?=$arSection['ELEMENT_CNT']?>)</span></p>
                                        <div class="category__image">
                                            <img src="<?if (!empty($arSection['PICTURE'])):?><?=CFile::GetPath($arSection['PICTURE'])?><?else:?><?=SITE_TEMPLATE_PATH?>/components/bitrix/catalog.section/stroyservis/images/no_photo.png<?endif;?>" alt="<?=$arSection['NAME']?>">
                                        </div>
                                    </a>
                                </li>
                                <?
                            }
                        }
                        ?>
                    </ul>
                </section>
            <?$this->EndViewTarget();?>

        </div>
    </section><div></div>
        <?
    }
    ?>
