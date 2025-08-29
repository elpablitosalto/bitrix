<div class="seminars-list__wrapper news-list__wrapper" itemscope itemtype="https://schema.org/Article">
    <link itemprop="mainEntityOfPage" href="https://hair.ru<?= $_SERVER['REQUEST_URI'] ?>" />
    <meta itemprop="headline name" content="<?= $arResult['NAME'] ?>">
    <meta itemprop="description" content="<?= $arResult['NAME'] ?> - блог компании CONCEPT, статьи и новости о профессиональной косметике для волос.">

    <section class="content">
        <div class="container _inside-page">
            <? $APPLICATION->IncludeComponent(
                "bitrix:breadcrumb",
                "hair.crumbs",
                array(
                    "START_FROM" => "0",
                    "PATH" => "",
                    "SITE_ID" => "s1"
                )
            ); ?>
            <? if ($arResult['PROPERTIES']['TITLE']['VALUE']): ?>
                <h1 class="blog-h1"><?= $arResult['PROPERTIES']['TITLE']['VALUE'] ?></h1>
            <? endif; ?>
            <!-- <? print_r($arResult['PROPERTIES']['RECOM_ARTICL_PROD']['VALUE_XML_ID']); ?> -->
            <img class="detail-picture-blog" src="<?= $arResult['DETAIL_PICTURE']['SRC'] ?>" alt="<?= $arResult['DETAIL_PICTURE']['ALT'] ?>">
            <section class="content-text">
                <?= $arResult['~DETAIL_TEXT'] ?>
            </section>
            <? if (isset($arResult['PROPERTIES']['HIDDEN_SEO_TEXT']) && !empty($arResult['PROPERTIES']['HIDDEN_SEO_TEXT']['VALUE']['TEXT'])): ?>
                <div class="visually-hidden"><?= $arResult['PROPERTIES']['HIDDEN_SEO_TEXT']['~VALUE']['TEXT'] ?></div>
            <? endif; ?>

            <? if (!empty($arResult['PROPERTIES']['RELATED_PRODUCTS_CONCEPT']['VALUE']) || !empty($arResult['PROPERTIES']['RELATED_PRODUCTS_INFINITY']['VALUE'])) : ?>
                <section class="novelties">
                    <div class="container">
                        <h2>Продукты по теме</h2>
                    </div>
                    <?
                    if (!empty($arResult['PROPERTIES']['RELATED_PRODUCTS_CONCEPT']['VALUE'])) {
                        global $arRelatedProductsFilterConcept;
                        $arRelatedProductsFilterConcept['ID'] = $arResult['PROPERTIES']['RELATED_PRODUCTS_CONCEPT']['VALUE'];

                        global $arrNoveltiesFilter;
                        $arrNoveltiesFilter['ID'] = false;
                        $APPLICATION->IncludeComponent(
                            "bitrix:news.list",
                            "novelties",
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
                                "FILTER_NAME" => "arRelatedProductsFilterConcept",
                                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                "IBLOCK_ID" => "2",
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
                                "SORT_BY1" => "ACTIVE_FROM",
                                "SORT_BY2" => "SORT",
                                "SORT_ORDER1" => "DESC",
                                "SORT_ORDER2" => "ASC",
                                "STRICT_SECTION_CHECK" => "N",
                                "COMPONENT_TEMPLATE" => "novelties"
                            ),
                            false
                        );
                    } ?>
                    <?
                    if (!empty($arResult['PROPERTIES']['RELATED_PRODUCTS_INFINITY']['VALUE'])) {
                        global $arRelatedProductsFilterInfinity;
                        $arRelatedProductsFilterInfinity['ID'] = $arResult['PROPERTIES']['RELATED_PRODUCTS_INFINITY']['VALUE'];

                        global $arrNoveltiesFilter;
                        $arrNoveltiesFilter['ID'] = false;
                        $APPLICATION->IncludeComponent(
                            "bitrix:news.list",
                            "novelties",
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
                                "FILTER_NAME" => "arRelatedProductsFilterInfinity",
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
                                "SORT_BY1" => "ACTIVE_FROM",
                                "SORT_BY2" => "SORT",
                                "SORT_ORDER1" => "DESC",
                                "SORT_ORDER2" => "ASC",
                                "STRICT_SECTION_CHECK" => "N",
                                "COMPONENT_TEMPLATE" => "novelties"
                            ),
                            false
                        );
                    } ?>
                </section>
            <? endif; ?>

            <? if ($arResult['PROPERTIES']['RECOM_ARTICL_PROD']['VALUE_XML_ID']) { ?>
                <?
                $GLOBALS['arrFilterRec'] = array("SECTION_ID" => $arResult['PROPERTIES']['RECOM_ARTICL_PROD']['VALUE_XML_ID']);
                $APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "recom-articl-prod",
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
                        "FILTER_NAME" => "arrFilterRec",
                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                        "IBLOCK_ID" => "2",
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
                        "STRICT_SECTION_CHECK" => "N",
                        "COMPONENT_TEMPLATE" => "recom-articl-prod"
                    ),
                    false
                ); ?>
            <? } ?>
            <div class="video-blog">
                <?php if ($arResult['PROPERTIES']['VIDEO_FILE']['VALUE'] != '') {
                    foreach ($arResult['PROPERTIES']['VIDEO_FILE']['VALUE'] as $arrItem) {
                        echo '<video class="video-blog-page" width="50%" height="350" controls><source src="' . CFile::GetPath($arrItem) . '" type="video/webm"></video>';
                    }
                } ?>
            </div>
            <? if ($arResult['PROPERTIES']['SORT_BY_BRANDS']['~VALUE']) { ?>
                <section class="article-slides">
                    <?
                    $GLOBALS['arrFilterArticl'] = array(
                        "=PROPERTY_SORT_BY_BRANDS_VALUE" => $arResult['PROPERTIES']['SORT_BY_BRANDS']['~VALUE'],
                        "!ID" => $arResult['ID'],
                    );
                    $APPLICATION->IncludeComponent(
                        "bitrix:news.list",
                        "articleRecom",
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
                            "FILTER_NAME" => "arrFilterArticl",
                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                            "IBLOCK_ID" => "30",
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
                            "STRICT_SECTION_CHECK" => "N",

                        ),
                        false
                    ); ?>
                </section>

            <? } ?>
            <section class="article-slides">
                <h2>Читайте также</h2>
                <?
                $GLOBALS['arrFilterArticlAll'] = array(
                    "!ID" => $arResult['ID']
                );
                $APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "articleslides",
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
                        "FILTER_NAME" => "arrFilterArticlAll",
                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                        "IBLOCK_ID" => "30",
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
                        "SORT_ORDER1" => "RAND",
                        "SORT_BY2" => "RAND",
                        "SORT_ORDER2" => "RAND",
                        "STRICT_SECTION_CHECK" => "N",

                    ),
                    false
                ); ?>
            </section>
        </div>
        <section id="fullPageSlider-1" data-full-page-slider class="full-page-slider swiper-container">
            <?
            $APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "fullPage.slider",
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
                    "FILTER_NAME" => "arrSliderFilter",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "IBLOCK_ID" => "7",
                    "IBLOCK_TYPE" => "banners",
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
                    "SET_STATUS_404" => "Y",
                    "SET_TITLE" => "N",
                    "SHOW_404" => "Y",
                    "SORT_BY1" => "ACTIVE_FROM",
                    "SORT_BY2" => "SORT",
                    "SORT_ORDER1" => "DESC",
                    "SORT_ORDER2" => "ASC",
                    "STRICT_SECTION_CHECK" => "N",
                    "COMPONENT_TEMPLATE" => "fullPage.slider"
                ),
                false
            ); ?>
        </section>
        <section class="ask-question">
            <div class="container">
                <div class="ask-question__text">
                    <p>У вас есть вопросы? Задайте их нашим специалистам. Для этого заполните форму и отправьте её. Мы ответим вам в течении 24 часов.</p>
                </div>
                <div class="ask-question__button"><a href="#" class="button _big">Задать вопрос</a></div>
            </div>
        </section>
    </section>
</div>