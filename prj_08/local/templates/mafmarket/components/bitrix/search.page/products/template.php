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
?>
<main class="dp-page">
    <section class="dp-section">
        <div class="container">
            <div class="dp-section__body">
                <div class="search__result-wrapper">
                    <?
                    //echo 'SHOW_RESULTS = ' . $arResult['SHOW_RESULTS'] . '<br />';
                    ?>
                    <? if ($arResult['SHOW_RESULTS'] == 'Y') { ?>

                        <?
                        $GLOBALS['arrFilter']['ID'] = $arResult['IDS'];     
                        ?>

                        <? $APPLICATION->IncludeComponent(
                            "bitrix:news.list",
                            'search_products',
                            array(
                                "DISPLAY_DATE" => "N",
                                "DISPLAY_NAME" => "Y",
                                "DISPLAY_PICTURE" => "Y",
                                "DISPLAY_PREVIEW_TEXT" => "Y",
                                "AJAX_MODE" => "N",
                                "IBLOCK_TYPE" => $arParams['PRODUCTS_IBLOCK_TYPE'],
                                "IBLOCK_ID" => $arParams['PRODUCTS_IBLOCK_ID'],
                                "IBLOCK_CODE" => '',
                                "NEWS_COUNT" => "6",
                                "SORT_BY1" => "ACTIVE_FROM",
                                "SORT_ORDER1" => "DESC",
                                "SORT_BY2" => "SORT",
                                "SORT_ORDER2" => "ASC",
                                "FILTER_NAME" => "arrFilter",
                                "FIELD_CODE" => array('ID', 'NAME', 'PREVIEW_TEXT', 'PREVIEW_PICTURE', 'DETAIL_PAGE_URL', 'IBLOCK_SECTION_ID', 'CODE'),
                                "PROPERTY_CODE" => array(),
                                "CHECK_DATES" => "Y",
                                "DETAIL_URL" => "",
                                "PREVIEW_TRUNCATE_LEN" => "",
                                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                                "SET_TITLE" => "Y",
                                "SET_BROWSER_TITLE" => "Y",
                                "SET_META_KEYWORDS" => "Y",
                                "SET_META_DESCRIPTION" => "Y",
                                "SET_LAST_MODIFIED" => "Y",
                                "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                                "ADD_SECTIONS_CHAIN" => "Y",
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
                                "PAGER_SHOW_ALWAYS" => "N",
                                "PAGER_TEMPLATE" => "show_more_search",
                                "PAGER_DESC_NUMBERING" => "N",
                                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                "PAGER_SHOW_ALL" => "N",
                                "PAGER_BASE_LINK_ENABLE" => "Y",
                                "SET_STATUS_404" => "N",
                                "SHOW_404" => "N",
                                "MESSAGE_404" => "",
                                "PAGER_BASE_LINK" => "",
                                "PAGER_PARAMS_NAME" => "arrPager",
                                "AJAX_OPTION_JUMP" => "N",
                                "AJAX_OPTION_STYLE" => "Y",
                                "AJAX_OPTION_HISTORY" => "N",
                                "AJAX_OPTION_ADDITIONAL" => "",

                                // Мои параметры -->
                                'QUERY' => $arResult['QUERY'],
                                'RESULTS_COUNT' => $arResult['RESULTS_COUNT'],
                                // <-- Мои параметры 
                            )
                        ); ?>

                    <? } else { ?>
                        <p class="search__result-main">
                            <? ShowError('Ничего не нашлось.'); ?>
                        </p>
                    <? } ?>
                </div>
            </div>
        </div>
    </section>
</main>