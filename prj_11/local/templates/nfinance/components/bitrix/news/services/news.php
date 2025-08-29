<?
$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
?>
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
<div class="page__section">
    <div class="page__holder">
        <!-- begin .section-->
        <div class="section section_space_top-close">
            <div class="section__header section__header_type_inline section__header_gap_l">
                <div class="section__title">
                    <!-- begin .title-->
                    <div class="title title_size_h2 title_style_primary">
                        <?$APPLICATION->ShowTitle()?>
                    </div>
                    <!-- end .title-->
                    <!-- begin .title-->
                    <h2 class="title title_size_h2">
                        для бизнеса
                    </h2>
                    <!-- end .title-->
                </div>
                <div class="section__meta">
                    <div class="section__subtitle">
                        Мы постоянно совершенствуем наш подход<br> и&nbsp;расширяем способы работы с бизнесом
                    </div>
                    <div class="section__description">
                        <!-- begin .info-panel-->
                        <div class="info-panel">
                            <svg class="info-panel__icon">
                                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/icon.svg#icon_tick"></use>
                            </svg>
                            Консультации, ведение проектов,<br> курсы, вебинары, мероприятия и книги
                        </div>
                        <!-- end .info-panel-->
                    </div>
                </div>
            </div>
            <?
            if($request->isAjaxRequest() && !empty($request->get("category"))){
                $GLOBALS["servicesSectionFilter"] = [
                    "=PROPERTY_CATEGORY" => intval($request->get("category"))
                ];
            }
            $APPLICATION->IncludeComponent("bitrix:news.list", "services_section", array(
                "IBLOCK_TYPE" => "content",
                "IBLOCK_ID" => "12",
                "NEWS_COUNT" => "30",
                "SORT_BY1" => "SORT",
                "SORT_ORDER1" => "ASC",
                "SORT_BY2" => "ID",
                "SORT_ORDER2" => "ASC",
                "FILTER_NAME" => "servicesSectionFilter",
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
                "AJAX_MODE" => "Y",
                "AJAX_OPTION_SHADOW" => "Y",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "AJAX_OPTION_HISTORY" => "N",
                "CACHE_TYPE" => "N",
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
                            <? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/text_carousel/main.php",
                                Array(),
                                Array("MODE" => "html", "NAME" => "TEXT_CAROUSEL")
                            ); ?>
                        </div>
                    </div>
                </div>
                <!-- end .following-->
            </div>
        </div>
    </div>
    <!-- end .section-->
</div>