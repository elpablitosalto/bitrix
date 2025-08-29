<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Infinity");
$APPLICATION->SetTitle("Профессиональная косметика для волос Infinity");
$GLOBALS['APPLICATION']->SetPageProperty("PAGE_HEADER_CLASS", "page__header_position_mobile-absolute");
$GLOBALS['APPLICATION']->SetPageProperty("HEADER_CLASS", "header_style_mobile-transparent");
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_TEMPLATE_PATH."/include/seo/seo.php",
		"AREA_FILE_RECURSIVE" => "N",
		"EDIT_MODE" => "html",
		"SEO_ID" => "4425",
		"TARGET_URI" => "/",
		"TARGET_ROOT" => INFINITY_ROOT,
		"PAGE_URI" => $_SERVER['REQUEST_URI'],
		"PAGE_QUERY" => $_SERVER['QUERY_STRING']
	),
	false,
);?>
<div class="page__intro">
    <!-- begin .image-carousel-->
    <?$APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "mainPage.slider",
        Array(
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
            "COMPONENT_TEMPLATE" => "mainPage.slider",
            "DETAIL_URL" => "",
            "DISPLAY_BOTTOM_PAGER" => "N",
            "DISPLAY_DATE" => "Y",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "DISPLAY_TOP_PAGER" => "N",
            "FIELD_CODE" => array(0=>"ID",1=>"CODE",2=>"PREVIEW_PICTURE",3=>"DETAIL_PICTURE",4=>"",),
            "FILTER_NAME" => "",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "IBLOCK_ID" => INFINITY_MAIN_BANNERS_IB_ID,
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
            "PROPERTY_CODE" => array(0=>"VDEO_URL",1=>"VIDEO_FILE",),
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
            "STRICT_SECTION_CHECK" => "N"
        )
    );?>
    <!-- end .image-carousel-->
</div>
<div class="page__section">
    <!-- begin .section-->
    <div class="section section_style_decorated">

        <div class="section__header">
            <div class="section__container page__container">
                <div class="section__title">
                    <!-- begin .title-->
                    <h1 class="title title_size_h1">
                        <? $APPLICATION->IncludeComponent("bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_TEMPLATE_PATH."/include/main/title.php",
                                "AREA_FILE_RECURSIVE" => "N",
                                "EDIT_MODE" => "html",
                            ), false
                        );
                        ?>
                    </h1>
                    <!-- end .title-->
                </div>
            </div>
        </div>
        <div class="section__content">
            <div class="page__container">
                <div class="section__text">
                    <? $APPLICATION->IncludeComponent("bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_TEMPLATE_PATH."/include/main/description.php",
                            "AREA_FILE_RECURSIVE" => "N",
                            "EDIT_MODE" => "html",
                        ), false
                    );
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- end .section-->
</div>
<div class="page__section">
    <!-- begin .section-->
    <div class="section section_style_filled section_role_features">
        <div class="section__header">
            <div class="section__container page__container">
                <div class="section__title">
                    <!-- begin .title-->
                    <h2 class="title title_size_h3 title_case_upper title_style_dependent">
                        <? $APPLICATION->IncludeComponent("bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_TEMPLATE_PATH."/include/main/features_title.php",
                                "AREA_FILE_RECURSIVE" => "N",
                                "EDIT_MODE" => "html",
                            ), false
                        );
                        ?>

                    </h2>
                    <!-- end .title-->
                </div>
                <div class="section__text">
                    <? $APPLICATION->IncludeComponent("bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_TEMPLATE_PATH."/include/main/features_description.php",
                            "AREA_FILE_RECURSIVE" => "N",
                            "EDIT_MODE" => "html",
                        ), false
                    );
                    ?>
                </div>
            </div>
        </div>
        <div class="section__content">
            <div class="page__container">
                <div class="section__icon-panel-group">
                    <!-- begin .icon-panel-group-->
                    <?
                    $GLOBALS["arMainPageFeaturesFilter"]["PROPERTY_SHOW_ON_MAIN_VALUE"] = "Y";
                    $APPLICATION->IncludeComponent(
                        "bitrix:news.list",
                        "mainPage.features",
                        Array(
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
                            "COMPONENT_TEMPLATE" => "mainPage.features",
                            "DETAIL_URL" => "",
                            "DISPLAY_BOTTOM_PAGER" => "N",
                            "DISPLAY_DATE" => "Y",
                            "DISPLAY_NAME" => "Y",
                            "DISPLAY_PICTURE" => "Y",
                            "DISPLAY_PREVIEW_TEXT" => "Y",
                            "DISPLAY_TOP_PAGER" => "N",
                            "FIELD_CODE" => array(0=>"ID",1=>"CODE",2=>"PREVIEW_PICTURE",3=>"DETAIL_PICTURE",4=>"",),
                            "FILTER_NAME" => "arMainPageFeaturesFilter",
                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                            "IBLOCK_ID" => INFINITY_MAIN_FEATURES_IB_ID,
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
                            "PROPERTY_CODE" => array(),
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
                            "STRICT_SECTION_CHECK" => "N"
                        )
                    );?>
                    <!-- end .icon-panel-group-->
                </div>
            </div>
            <div class="section__panel">
                <!-- begin .skewed-panel-->
                <div class="skewed-panel">
                    <div class="skewed-panel__wrapper">
                        <div class="skewed-panel__title">
                            <!-- begin .title-->
                            <h3
                                class="title title_size_h2 title_weight_light title_case_upper title_style_dependent"
                            >
                                Начни работать с
                                <br class="hide-up-m" />
                                линией Infinity
                            </h3>
                            <!-- end .title-->
                        </div>
                        <div class="skewed-panel__controls">
                            <div class="skewed-panel__control">
                                <!-- begin .button-->
                                <a
                                    class="button button_width_full button_size_s button_style_light button_type_skewed"
                                    href="/about/partnership/"
                                >
                                    <span class="button__holder">
                                        <svg class="button__icon">
                                            <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/mockup/dist/assets/images/icon.svg#icon_infinity"></use>
                                        </svg>
                                        <span class="button__text">Выбрать предложение</span>
                                    </span>
                                </a>
                                <!-- end .button-->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end .skewed-panel-->
            </div>
        </div>
    </div>
    <!-- end .section-->
</div>

<div class="page__section">
    <!-- begin .section-->
    <?
    $APPLICATION->IncludeComponent(
        "bitrix:catalog.section.list",
        "mainPage.catalog",
        array(
            "VIEW_MODE" => "TEXT",
            "SHOW_PARENT_NAME" => "Y",
            "IBLOCK_TYPE" => "catalog",
            "IBLOCK_ID" => INFINITY_CATALOG_IB_ID,
            "SECTION_ID" => "",
            "SECTION_CODE" => "",
            "SECTION_URL" => "",
            "COUNT_ELEMENTS" => "N",
            "TOP_DEPTH" => "1",
            "SECTION_FIELDS" => array(
                0 => "ID",
                1 => "CODE",
                2 => "NAME",
                3 => "DESCRIPTION",
                4 => "PICTURE",
                5 => "SORT",
            ),
            "SECTION_USER_FIELDS" => array(
                "UF_TO_MAIN",
                "UF_MAIN_BLOCK_SMALL_DESC",
                "UF_MAIN_SECTIONS_DESC",
            ),
            "ADD_SECTIONS_CHAIN" => "Y",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "36000000",
            "CACHE_NOTES" => "",
            "CACHE_GROUPS" => "Y",
            "COMPONENT_TEMPLATE" => ".default",
            "COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
            "FILTER_NAME" => "arrSectionListFilter",
            "CACHE_FILTER" => "N",
            "INCLUDE_EXTRA_SLIDES" => "Y"
        ),
        false
    );
    ?>
    <!-- end .section-->
</div>
<div class="page__section">
    <!-- begin .section-->
    <div class="section section_role_banner">
        <div class="section__content">
            <div class="page__container">
                <div class="section__banner">
                    <!-- begin .banner-->
                    <div class="banner">
                        <? $APPLICATION->IncludeComponent("bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_TEMPLATE_PATH."/include/main/bottom_banner.php",
                                "AREA_FILE_RECURSIVE" => "N",
                                "EDIT_MODE" => "html",
                            ), false
                        );
                        ?>
                    </div>
                    <!-- end .banner-->
                </div>
            </div>
        </div>
    </div>
    <!-- end .section-->
</div>
<div class="page__section">
    <!-- begin .section-->
    <div class="section section_role_attention-panel">
        <div class="section__content">
            <div class="page__container">
                <div class="section__banner">
                    <!-- begin .attention-panel-->
                    <? $APPLICATION->IncludeComponent("bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_TEMPLATE_PATH."/include/bottom_form.php",
                            "AREA_FILE_RECURSIVE" => "N",
                            "EDIT_MODE" => "html",
                        ), false
                    );
                    ?>
                    <!-- end .attention-panel-->
                </div>
            </div>
        </div>
    </div>
    <!-- end .section-->
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>