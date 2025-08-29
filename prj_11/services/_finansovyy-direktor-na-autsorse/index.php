<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Финансовый директор на аутсорсе");
?>
<script type='application/ld+json'>
<?
$arr = array(
  "@context" => "https://schema.org",
  "@type" => "Article",
  "headline" => "Финансовый директор на аутсорсе",
  "datePublished" => '05.04.2024 16:29:09',
  "image" => "https://{$_SERVER["SERVER_NAME"]}/upload/iblock/ef8/6kdsddtxo2m0gns5yc4m0k4631e6r10a.png",
  "keywords" => "Отчеты, дашборды и графики помогуть принимать прибыльные решения. Вместо цифр вы будете видеть деньги",
  "description" => "Поможет понять за какие рычаги можно дернуть, чтобы сделать ваш бизнес более прибыльным и системным",
  "author" => 'Нескуные финансы',
  "mainEntityOfPage" => "https://{$_SERVER["SERVER_NAME"]}/services/finansovyy-direktor-na-autsorse/",
  "publisher" =>
    [
      "@type" => "Organization",
      "name" => "Нескучные финансы",
    ],
);

echo json_encode($arr, JSON_UNESCAPED_UNICODE);
?>

</script>
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
<div class="page__section page__section_no_overflow">
    <div class="page__holder page__holder_mobile-gutter_s">
        <!-- begin .section-->
        <? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/services/finansovyy-direktor-na-autsorse/top_banner.php",
            Array(),
            Array("MODE" => "html", "NAME" => "TOP_BANNER")
        ); ?>
        <!-- end .section-->
    </div>
</div>
<div class="page__section">
    <div class="page__holder">
        <!-- begin .section-->
        <div class="section section_space_top-close">
            <div class="section__header section__header_type_inline">
                <? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/services/finansovyy-direktor-na-autsorse/title_desc.php",
                    Array(),
                    Array("MODE" => "html", "NAME" => "TITLE_DESC")
                ); ?>
            </div>
            <div class="section__content">
                <div class="section__description-panel">
                    <!-- begin .description-panel-->
                    <div class="description-panel description-panel_layout_s">
                        <div class="description-panel__container">
                            <div class="description-panel__wrapper">
                                <? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/services/finansovyy-direktor-na-autsorse/advantages.php",
                                    Array(),
                                    Array("MODE" => "html", "NAME" => "ADVANTAGES")
                                ); ?>
                            </div>
                        </div>
                    </div>
                    <!-- end .description-panel-->
                </div>
            </div>
        </div>
        <!-- end .section-->
    </div>
</div>
<div class="page__section page__section_style_secondary page__section_role_sticky">
    <div class="page__holder">
        <!-- begin .section-->
        <div class="section section_role_sticky">
            <div class="section__content">
                <div class="section__stiky-panel">
                    <!-- begin .sticky-info-->
                    <div class="sticky-info sticky-info_size_s sticky-info_space_l">
                        <div class="sticky-info__container">
                            <div class="sticky-info__wrapper">
                                <? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/services/finansovyy-direktor-na-autsorse/outsourcing.php",
                                    Array(),
                                    Array("MODE" => "html", "NAME" => "OUTSOURCING")
                                ); ?>
                            </div>
                        </div>
                    </div>
                    <!-- end .sticky-info-->
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
<div class="page__section page__section_no_overflow">
    <!-- begin .section-->
    <div class="section section_space_close">
        <div class="section__content">
            <div class="section__media-panel">
                <!-- begin .main-banner-->
                <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/include/services/finansovyy-direktor-na-autsorse/middle_banner.php",
                    Array(),
                    Array("MODE" => "html", "NAME" => "MIDDLE_BANNER")
                );?>
                <!-- end .main-banner-->
            </div>
        </div>
    </div>
    <!-- end .section-->
</div>
<div class="page__section">
    <div class="page__holder">
        <!-- begin .section-->
        <?$APPLICATION->IncludeComponent("bitrix:news.list", "cases", array(
            "IBLOCK_TYPE" => "newspaper",
            "IBLOCK_ID" => "4",
            "NEWS_COUNT" => "6",
            "SORT_BY1" => "SORT",
            "SORT_ORDER1" => "ASC",
            "SORT_BY2" => "ID",
            "SORT_ORDER2" => "ASC",
            "FILTER_NAME" => "",
            "FIELD_CODE" => array(
                "NAME",
                "PREVIEW_PICTURE",
                "DETAIL_PICTURE",
                "PREVIEW_TEXT",
                "CODE",
            ),
            "PROPERTY_CODE" => array(
                "AUTHORS",
                "EDITOR",
                "FORMAT",
                "FAVORITE",
                "VERTICAL_BG",
                "HORIZONTAL_BG",
                "POST_IMG",
                "POST_IMG_MOB",
                "INDUSTRY"
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
            "PARENT_SECTION" => "5",
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
        );?>
        <!-- end .section-->
    </div>
</div>
<div class="page__section">
    <div class="page__holder">
        <!-- begin .section-->
        <div class="section">
            <div class="section__header section__header_type_inline">
                <div class="section__title">
                    <!-- begin .title-->
                    <h2 class="title title_size_h2">Наши преимущества
                    </h2>
                    <!-- end .title-->
                </div>
            </div>
            <div class="section__content">
                <div class="section__cards-panel">
                    <!-- no modifiers - panels take all available width, divinging equally up to three in one row-->
                    <!-- promo-group_layout_l - one panel per row-->
                    <!-- promo-group_layout_m - two panels per row-->
                    <!-- promo-group_layout_s - three panels per row-->
                    <!-- promo-group_layout_mixed - three panels every odd row, two panels every even row-->
                    <!-- begin .cards-panel-->
                    <?
                    $GLOBALS["advantagesFilter"] = [
                        "PROPERTY_PAGE_CATEGORY_VALUE" => "Услуги"
                    ];
                    $APPLICATION->IncludeComponent("bitrix:news.list", "advantages", array(
                        "IBLOCK_TYPE" => "content",
                        "IBLOCK_ID" => "11",
                        "NEWS_COUNT" => "4",
                        "SORT_BY1" => "SORT",
                        "SORT_ORDER1" => "ASC",
                        "SORT_BY2" => "ID",
                        "SORT_ORDER2" => "ASC",
                        "FILTER_NAME" => "advantagesFilter",
                        "FIELD_CODE" => array(
                            "NAME",
                            "PREVIEW_TEXT",
                        ),
                        "PROPERTY_CODE" => array(
                            "LINK"
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
                    );?>
                    <!-- end .cards-panel-->
                </div>
            </div>
        </div>
        <!-- end .section-->
    </div>
</div>
<div class="page__section">
    <div class="page__holder page__holder_mobile-gutter_s">
        <!-- begin .section-->
        <?
        $GLOBALS["excursionBannersFilter"] = [
            "PROPERTY_TYPE_VALUE" => "Баннер-панель с заливкой"
        ];
        $APPLICATION->IncludeComponent("bitrix:news.list", "excursion_banners", array(
            "IBLOCK_TYPE" => "content",
            "IBLOCK_ID" => "27",
            "NEWS_COUNT" => "30",
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