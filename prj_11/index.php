<?
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetPageProperty("description", "Нескучные Финансы - услуги финансового аутсорсинга для бизнеса. Наводим порядок в финансах, помогаем предпринимателям по всей стране принимать решения по развитию своей компании на основе твердых цифр");
$APPLICATION->SetTitle("Нескучные Финансы - финансовый аутсорсинг для бизнеса");
?>
<script type='application/ld+json'>
<?
$arr = array(
  "@context" => "https://schema.org",
  "@type" => "Organization",
  "name"=> "Нескучные финансы",
  "url" => "http://noboring-finance.com",
  "logo" => "https://{$_SERVER["SERVER_NAME"]}/local/templates/nfinance/assets/blocks/logo/images/main.svg",
  "contactPoint" =>
    [
      "@type" => "ContactPoint",
      "contactType" => "customer support",
      "telephone" => "+7 (800) 551-85-81",
      "email" => "hello@noboring-finance.ru"
    ]

);

echo json_encode($arr, JSON_UNESCAPED_UNICODE);
?>

</script>
    <div class="page__section page__section_no_overflow">
        <div class="page__holder">
            <!-- begin .section-->
            <div class="section section_space_much">
                <div class="section__content">
                    <div class="section__media-panel">
                        <!-- begin .banner-carousel-->
                        <?
                        $GLOBALS["bannersFilter"] = [
                            "PROPERTY_TYPE_VALUE" => "Основной баннер"
                        ];
                        $APPLICATION->IncludeComponent("bitrix:news.list", "main_banners", array(
                            "IBLOCK_TYPE" => "content",
                            "IBLOCK_ID" => "27",
                            "NEWS_COUNT" => "30",
                            "SORT_BY1" => "SORT",
                            "SORT_ORDER1" => "ASC",
                            "SORT_BY2" => "ID",
                            "SORT_ORDER2" => "ASC",
                            "FILTER_NAME" => "bannersFilter",
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
                        <!-- end .banner-carousel-->
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
    <div class="page__section page__section_style_secondary page__section_role_sticky">
        <div class="page__holder">
            <!-- begin .section-->
            <div class="section section_role_sticky">
                <div class="section__content">
                    <div class="section__stiky-panel">
                        <!-- begin .sticky-info-->
                        <div class="sticky-info">
                            <div class="sticky-info__container">
                                <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/include/mainpage/what_we_doing.php",
                                    Array(),
                                    Array("MODE" => "html", "NAME" => "WHAT_WE_DOING")
                                );?>
                            </div>
                        </div>
                        <!-- end .sticky-info-->
                    </div>
                </div>
            </div>
            <!-- end .section-->
        </div>
    </div>
    <div class="page__section">
        <div class="page__holder">
            <!-- begin .section-->
            <div class="section">
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
                            "PROPERTY_PAGE_CATEGORY_VALUE" => "Главная"
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
    <div class="page__section page__section_style_borderless">
        <div class="page__holder">
            <!-- begin .section-->
                <?$APPLICATION->IncludeComponent("bitrix:news.list", "partners", array(
                    "IBLOCK_TYPE" => "content",
                    "IBLOCK_ID" => "9",
                    "NEWS_COUNT" => "20",
                    "SORT_BY1" => "SORT",
                    "SORT_ORDER1" => "ASC",
                    "SORT_BY2" => "ID",
                    "SORT_ORDER2" => "ASC",
                    "FILTER_NAME" => "",
                    "FIELD_CODE" => array(
                        "NAME",
                        "PREVIEW_PICTURE",
                    ),
                    "PROPERTY_CODE" => array(),
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
            <!-- end .section-->
        </div>
    </div>
    <div class="page__section page__section_decoration_bottom">
        <div class="page__holder page__holder_mobile-gutter_s">
            <!-- begin .section-->
            <div class="section">
                <div class="section__content">
                    <div class="section__banner">
                        <!-- begin .banner-->
                        <div class="banner">
                            <div class="banner__wrapper">
                                <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/include/mainpage/advantage_banner.php",
                                    Array(),
                                    Array("MODE" => "html", "NAME" => "ADVANTAGE_BANNER")
                                );?>
                            </div>
                        </div>
                        <!-- end .banner-->
                    </div>
                </div>
            </div>
            <!-- end .section-->
        </div>
    </div>
    <div class="page__section page__section_style_secondary page__section_role_sticky">
        <div class="page__holder">
            <!-- begin .section-->
            <div class="section section_role_sticky-secondary">
                <div class="section__content">
                    <div class="section__sticky-panel">
                        <!-- begin .sticky-info-->
                        <div class="sticky-info sticky-info_style_secondary">
                            <div class="sticky-info__container">
                                <div class="sticky-info__wrapper">
                                    <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/include/mainpage/outsourcing.php",
                                        Array(),
                                        Array("MODE" => "html", "NAME" => "OUTSOURCING")
                                    );?>
                                </div>
                                <div class="sticky-info__controls">
                                    <div class="sticky-info__control">
                                        <!-- begin .button-->
                                        <button class="button js-modal" href="#modalCounseling">
                                            <span class="button__holder">
                                                <span class="button__text">Записаться на консультацию</span>
                                            </span>
                                        </button>
                                        <!-- end .button-->
                                    </div>
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
                    "INDUSTRY",
                    "BANNER_LINK"
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
    <div class="page__section page__section_decoration_bottom">
        <div class="page__holder">
            <!-- begin .section-->
            <?
            $GLOBALS["freeServices"] = [
                "PROPERTY_CATEGORY_VALUE" => "Бесплатно"
            ];
            $APPLICATION->IncludeComponent("bitrix:news.list", "free_services", array(
                "IBLOCK_TYPE" => "content",
                "IBLOCK_ID" => "12",
                "NEWS_COUNT" => "3",
                "SORT_BY1" => "SORT",
                "SORT_ORDER1" => "ASC",
                "SORT_BY2" => "ID",
                "SORT_ORDER2" => "ASC",
                "FILTER_NAME" => "freeServices",
                "FIELD_CODE" => array(
                    "NAME",
                    "PREVIEW_PICTURE",
                ),
                "PROPERTY_CODE" => array(
                    "ICON",
                    "LINK",
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
            <!-- end .section-->
        </div>
    </div>
    <div class="page__section page__section_style_secondary">
        <div class="page__holder">
            <!-- begin .section-->
            <?
            $APPLICATION->IncludeComponent("bitrix:news.list", "services", array(
                "IBLOCK_TYPE" => "content",
                "IBLOCK_ID" => "12",
                "NEWS_COUNT" => "30",
                "SORT_BY1" => "SORT",
                "SORT_ORDER1" => "ASC",
                "SORT_BY2" => "ID",
                "SORT_ORDER2" => "ASC",
                "FILTER_NAME" => "",
                "FIELD_CODE" => array(
                    "NAME",
                    "PREVIEW_PICTURE",
                ),
                "PROPERTY_CODE" => array(
                    "ICON",
                    "CATEGORY",
                    "LINK",
                    "BACKGROUND_IMG",
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
    <div class="page__section page__section_style_secondary">
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

    <div class="page__section page__section_no_overflow">
        <div class="page__holder">
            <!-- begin .section-->
            <?
            $APPLICATION->IncludeComponent("bitrix:news.list", "reviews_carousel", array(
                "IBLOCK_TYPE" => "content",
                "IBLOCK_ID" => "13",
                "NEWS_COUNT" => "30",
                "SORT_BY1" => "SORT",
                "SORT_ORDER1" => "ASC",
                "SORT_BY2" => "ID",
                "SORT_ORDER2" => "ASC",
                "FILTER_NAME" => "",
                "FIELD_CODE" => array(
                    "NAME",
                    "PREVIEW_PICTURE",
                ),
                "PROPERTY_CODE" => array(
                    "YOUTUBE_LINK",
                    "TITLE",
                    "FIO",
                    "INDUSTRY",
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

    <!-- begin .section-->
    <?
    $APPLICATION->IncludeComponent("bitrix:news.list", "news_main", array(
        "IBLOCK_TYPE" => "news",
        "IBLOCK_ID" => "14",
        "NEWS_COUNT" => "3",
        "SORT_BY1" => "ACTIVE_FROM",
        "SORT_ORDER1" => "DESC",
        "SORT_BY2" => "SORT",
        "SORT_ORDER2" => "ASC",
        "FILTER_NAME" => "",
        "FIELD_CODE" => array(
            "NAME",
            "DATE_CREATE",
            "PREVIEW_PICTURE",
            "PREVIEW_TEXT",
        ),
        "PROPERTY_CODE" => array(
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

    <!-- begin .section-->
    <?
    $APPLICATION->IncludeComponent("bitrix:news.list", "events_main", array(
        "IBLOCK_TYPE" => "news",
        "IBLOCK_ID" => "15",
        "NEWS_COUNT" => "4",
        "SORT_BY1" => "ACTIVE_FROM",
        "SORT_ORDER1" => "DESC",
        "SORT_BY2" => "SORT",
        "SORT_ORDER2" => "ASC",
        "FILTER_NAME" => "",
        "FIELD_CODE" => array(
            "NAME",
            "DATE_CREATE",
            "PREVIEW_PICTURE",
            "PREVIEW_TEXT",
        ),
        "PROPERTY_CODE" => array(
            "DETAIL_BUTTON_LINK"
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

    <div class="page__section page__section_style_secondary page__section_no_overflow">
        <div class="page__holder">
            <!-- begin .section-->
            <?
            $APPLICATION->IncludeComponent("waim:our.events", "", array(
                    "IBLOCK_ID" => "17",
                    "AJAX_MODE" => "Y",
                    "AJAX_OPTION_SHADOW" => "Y",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "N",
                    "AJAX_OPTION_HISTORY" => "N",
               )
            );
            ?>
            <!-- end .section-->
        </div>
    </div>
    <div class="page__section page__section_no_overflow">
        <div class="page__holder">
            <!-- begin .section-->
            <?
            $APPLICATION->IncludeComponent("bitrix:news.list", "smi", array(
                "IBLOCK_TYPE" => "news",
                "IBLOCK_ID" => "16",
                "NEWS_COUNT" => "30",
                "SORT_BY1" => "ACTIVE_FROM",
                "SORT_ORDER1" => "DESC",
                "SORT_BY2" => "SORT",
                "SORT_ORDER2" => "ASC",
                "FILTER_NAME" => "",
                "FIELD_CODE" => array(
                    "NAME",
                    "DATE_CREATE",
                    "PREVIEW_PICTURE",
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
<?
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
?>