<div class="page__section">
    <!-- begin .section-->
    <div class="section">
        <div class="page__container">
            <!-- begin .not-found-->
            <div class="not-found section__not-found">
                <div class="not-found__content">
                    <div class="not-found__label">404</div>
                    <div class="not-found__title">
                        <!-- begin .title-->
                        <h1 class="title title_size_h1">Страница не найдена</h1>
                        <!-- end .title-->
                    </div>
                    <div class="not-found__text">
                        Запрашиваемая страница не существует или была перемещена по другому адресу.
                    </div>
                    <div class="not-found__controls">
                        <div class="not-found__control">
                            <!-- begin .button-->
                            <a class="button button_width_full" href="/infinity/">
                                <span class="button__holder">На главную</span>
                            </a>
                            <!-- end .button-->
                        </div>
                    </div>
                </div>
            </div>
            <!-- end .not-found-->
        </div>
    </div>
    <!-- end .section-->
</div>
<div class="page__section">
    <!-- begin .section-->
    <div class="section">
        <div class="section__header">
            <div class="section__container page__container">
                <div class="section__title">
                    <!-- begin .title-->
                    <h2 class="title title_size_h3 title_case_upper">Продукция Infinity</h2>
                    <!-- end .title-->
                </div>
            </div>
        </div>
        <div class="page__container">
                <!-- begin .product-carousel-->
            <?
            global $arrNoveltiesFilter;
            //$arrNoveltiesFilter['!PROPERTY_NEW'] = false;
            $APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "product-carousel",
                array(
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "ADD_SECTIONS_CHAIN" => "N",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "CACHE_FILTER" => "N",
                    "CACHE_GROUPS" => "Y",
                    "CACHE_TIME" => "36000000",
                    "CACHE_TYPE" => "A",
                    "CHECK_DATES" => "Y",
                    "DETAIL_URL" => "",
                    "DISPLAY_BOTTOM_PAGER" => "N",
                    "DISPLAY_DATE" => "Y",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "DISPLAY_TOP_PAGER" => "N",
                    "FIELD_CODE" => array(
                        0 => "ID",
                        1 => "CODE",
                        2 => "PREVIEW_PICTURE",
                        3 => "DETAIL_PICTURE",
                        4 => "",
                    ),
                    "FILTER_NAME" => "arrNoveltiesFilter",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "IBLOCK_ID" => "45",
                    "IBLOCK_TYPE" => "catalog",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    "INCLUDE_SUBSECTIONS" => "Y",
                    "MESSAGE_404" => "",
                    "NEWS_COUNT" => "20",
                    "PAGER_BASE_LINK_ENABLE" => "N",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_TEMPLATE" => ".default",
                    "PAGER_TITLE" => "Новости",
                    "PARENT_SECTION" => "",
                    "PARENT_SECTION_CODE" => "",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "PROPERTY_CODE" => array(
                        0 => "PRODUCT_FEATURE",
                        1 => "PRODUCT_PROPS",
                        2 => "PRODUCT_COMPOSITION",
                        3 => "PRODUCT_TYPE",
                        4 => "",
                    ),
                    "SET_BROWSER_TITLE" => "N",
                    "SET_LAST_MODIFIED" => "N",
                    "SET_META_DESCRIPTION" => "N",
                    "SET_META_KEYWORDS" => "N",
                    "SET_STATUS_404" => "N",
                    "SET_TITLE" => "N",
                    "SHOW_404" => "N",
                    "SORT_BY1" => "RAND",
                    "SORT_BY2" => "SORT",
                    "SORT_ORDER1" => "DESC",
                    "SORT_ORDER2" => "ASC",
                    "STRICT_SECTION_CHECK" => "N",
                    "COMPONENT_TEMPLATE" => "product-carousel",
                    "BLOCK_CLASS" => "section__product-carousel"
                ),
                false
            ); ?>
        </div>
    </div>
    <!-- end .section-->
</div>