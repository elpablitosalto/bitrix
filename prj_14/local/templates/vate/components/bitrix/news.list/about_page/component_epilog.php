<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
<? if (!empty($arResult["ITEMS"])) { ?>
    <? foreach ($arResult["ITEMS"] as $arItem) { ?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>

        <div class="page__section" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
            <div class="page__container">
                <!-- begin .section-->
                <div class="section section_spacing_top-none">
                    <div class="section__main">
                        <div class="section__content">
                            <div class="section__info-panel">
                                <!-- begin .info-block-->
                                <div class="info-panel">
                                    <div class="info-panel__content">
                                        <div class="info-panel__title">
                                            <!-- begin .title-->
                                            <h2 class="title title_style_gradient title_size_h1 title_case_upper">
                                                <?= $arItem['DISPLAY_PROPERTIES']['HEADER_MAIN']['~VALUE']; ?>
                                            </h2>
                                            <!-- end .title-->
                                        </div>
                                        <div class="info-panel__main">
                                            <div class="info-panel__text">
                                                <?= $arItem['DISPLAY_PROPERTIES']['TEXT_MAIN']['~VALUE']['TEXT']; ?>
                                            </div>
                                            <div class="info-panel__illustration">
                                                <picture class="info-panel__picture">
                                                    <img src="<?= $arItem['IMG_MAIN']['SRC']; ?>" alt="<?= $arItem['IMG_MAIN']["ALT"] ?>" title="<?= $arItem['IMG_MAIN']["TITLE"] ?>" class="info-panel__image" />
                                                </picture>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end .info-block-->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end .section-->
            </div>
        </div>
        <div class="page__section">
            <!-- begin .section-->
            <div class="section section_spacing_top-none section_style_filled">
                <div class="section__main">
                    <div class="section__header page__container">
                        <div class="section__header-container">
                            <div class="section__title">
                                <!-- begin .title-->
                                <h1 class="title title_size_h1 title_case_upper">VATE в цифрах
                                </h1>
                                <!-- end .title-->
                            </div>
                        </div>
                    </div>
                    <div class="page__container">
                        <div class="section__content">
                            <div class="section__info-grid">
                                <!-- begin .info-grid-->
                                <div class="info-grid info-grid_size_secondary">
                                    <div class="info-grid__container">
                                        <?
                                        $i = 0;
                                        foreach ($arItem['DISPLAY_PROPERTIES']['IN_DIGITS']['VALUE'] as $key => $arFeature) {
                                            $sizeClass = 'info-grid__item_size-m_s';
                                            if ($i > 5) {
                                                $i = 0;
                                            }
                                            switch ($i) {
                                                case 0:
                                                    $sizeClass = 'info-grid__item_size-m_s';
                                                    break;
                                                case 1:
                                                    $sizeClass = 'info-grid__item_size_m';
                                                    break;
                                                case 2:
                                                    $sizeClass = 'info-grid__item_size-m_xl';
                                                    break;
                                                case 3:
                                                    $sizeClass = 'info-grid__item_size-m_m';
                                                    break;
                                                case 4:
                                                    $sizeClass = 'info-grid__item_size_xl';
                                                    break;
                                                case 5:
                                                    $sizeClass = 'info-grid__item_size_s';
                                                    break;
                                            }

                                        ?>
                                            <div class="info-grid__item info-grid__item_layout_secondary <?= $sizeClass; ?>">
                                                <div class="info-grid__content">
                                                    <div class="info-grid__value"><?= $arFeature['SUB_VALUES']['IN_DIGITS_DIGIT']['VALUE']; ?>
                                                    </div>
                                                    <div class="info-grid__unit"><?= $arFeature['SUB_VALUES']['IN_DIGITS_UNIT']['VALUE']; ?>
                                                    </div>
                                                </div>
                                                <div class="info-grid__text"><?= $arFeature['SUB_VALUES']['IN_DIGITS_TEXT']['~VALUE']['TEXT']; ?>
                                                </div>
                                            </div>
                                        <?
                                            $i++;
                                        } ?>
                                    </div>
                                </div>
                                <!-- end .info-grid-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end .section-->
        </div>

        <? $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "our_stores_about_page",
            array(
                "IBLOCK_ID" => STORES_IB_ID,
                "IBLOCK_TYPE" => "content",
                "DISPLAY_DATE" => "Y",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "Y",
                "AJAX_MODE" => "N",
                "NEWS_COUNT" => "20",
                "SORT_BY2" => "ACTIVE_FROM",
                "SORT_ORDER2" => "DESC",
                "SORT_BY1" => "SORT",
                "SORT_ORDER1" => "ASC",
                "FILTER_NAME" => "",
                "FIELD_CODE" => array("ID", "PREVIEW_TEXT", "PREVIEW_PICTURE"),
                "PROPERTY_CODE" => array("HEADER", "ADDRESS", "X_POINT_MAP", "Y_POINT_MAP"),
                "CHECK_DATES" => "Y",
                "DETAIL_URL" => "",
                "PREVIEW_TRUNCATE_LEN" => "",
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "SET_TITLE" => "N",
                "SET_BROWSER_TITLE" => "Y",
                "SET_META_KEYWORDS" => "Y",
                "SET_META_DESCRIPTION" => "Y",
                "SET_LAST_MODIFIED" => "Y",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "ADD_SECTIONS_CHAIN" => "N",
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
                "PAGER_SHOW_ALWAYS" => "Y",
                "PAGER_TEMPLATE" => "",
                "PAGER_DESC_NUMBERING" => "Y",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "Y",
                "PAGER_BASE_LINK_ENABLE" => "Y",
                "SET_STATUS_404" => "Y",
                "SHOW_404" => "Y",
                "MESSAGE_404" => "",
                "PAGER_BASE_LINK" => "",
                "PAGER_PARAMS_NAME" => "arrPager",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_ADDITIONAL" => ""
            )
        ); ?>


        <div class="page__section">
            <div class="page__container">
                <!-- begin .section-->
                <div class="section section_spacing_top-none">
                    <div class="section__main">
                        <div class="section__content">
                            <div class="section__info-panel">
                                <!-- begin .info-block-->
                                <div class="info-panel info-panel_direction_reverse">
                                    <div class="info-panel__content">
                                        <div class="info-panel__title">
                                            <!-- begin .title-->
                                            <h2 class="title title_style_gradient title_size_h1">
                                                <?= $arItem['DISPLAY_PROPERTIES']['TRUST_US_HEADER']['~VALUE']; ?>
                                            </h2>
                                            <!-- end .title-->
                                        </div>
                                        <div class="info-panel__main">
                                            <div class="info-panel__text">
                                                <?= $arItem['DISPLAY_PROPERTIES']['TRUST_US_TEXT']['~VALUE']['TEXT']; ?>
                                            </div>
                                            <div class="info-panel__illustration">
                                                <picture class="info-panel__picture">
                                                    <img src="<?= $arItem['TRUST_US_IMG']['SRC']; ?>" alt="<?= $arItem['TRUST_US_IMG']["ALT"] ?>" title="<?= $arItem['TRUST_US_IMG']["TITLE"] ?>" class="info-panel__image" />
                                                </picture>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end .info-block-->
                            </div>
                            <div class="section__info-grid">
                                <!-- begin .info-grid-->
                                <div class="info-grid">
                                    <div class="info-grid__container">
                                        <? if (!empty($arItem['DISPLAY_PROPERTIES']['FEATURES_MAIN']['VALUE'])) { ?>
                                            <?
                                            $i = 0;
                                            foreach ($arItem['DISPLAY_PROPERTIES']['FEATURES_MAIN']['VALUE'] as $key => $arFeature) { ?>
                                                <?
                                                $addClass = '';
                                                if ($i == 0) {
                                                    $addClass = 'info-grid__item_style_filled';
                                                }
                                                ?>
                                                <div class="info-grid__item <?= $addClass; ?>">
                                                    <div class="info-grid__content">

                                                        <picture class="info-grid__picture">
                                                            <source srcset="<?= $arFeature['SUB_VALUES']['FEATURES_MAIN_IMG']['PICTURE']['SRC'] ?>" type="image/svg+xml" media="(max-width: 1439px)" class="info-grid__source" />
                                                            <img src="<?= $arFeature['SUB_VALUES']['FEATURES_MAIN_IMG']['PICTURE']['SRC']; ?>" alt="<?= $arFeature['SUB_VALUES']['FEATURES_MAIN_IMG']['PICTURE']["ALT"] ?>" title="<?= $arFeature['SUB_VALUES']['FEATURES_MAIN_IMG']['PICTURE']["TITLE"] ?>" class="info-grid__image" />
                                                        </picture>
                                                    </div>
                                                    <div class="info-grid__text"><?= $arFeature['SUB_VALUES']['FEATURES_MAIN_TEXT']['VALUE']['TEXT']; ?>
                                                    </div>
                                                </div>
                                            <?
                                                $i++;
                                            } ?>
                                        <? } ?>
                                    </div>
                                </div>
                                <!-- end .info-grid-->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end .section-->
            </div>
        </div>
        <? $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "partners_slider_about",
            array(
                "IBLOCK_ID" => PARTNERS_IB_ID,
                "IBLOCK_TYPE" => "content",
                "DISPLAY_DATE" => "Y",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "Y",
                "AJAX_MODE" => "N",
                "NEWS_COUNT" => "20",
                "SORT_BY2" => "ACTIVE_FROM",
                "SORT_ORDER2" => "DESC",
                "SORT_BY1" => "SORT",
                "SORT_ORDER1" => "ASC",
                "FILTER_NAME" => "",
                "FIELD_CODE" => array("ID", "NAME", "DETAIL_PAGE_URL", "PREVIEW_PICTURE"),
                "PROPERTY_CODE" => array(""),
                "CHECK_DATES" => "Y",
                "DETAIL_URL" => "",
                "PREVIEW_TRUNCATE_LEN" => "",
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "SET_TITLE" => "N",
                "SET_BROWSER_TITLE" => "Y",
                "SET_META_KEYWORDS" => "Y",
                "SET_META_DESCRIPTION" => "Y",
                "SET_LAST_MODIFIED" => "Y",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "ADD_SECTIONS_CHAIN" => "N",
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
                "PAGER_SHOW_ALWAYS" => "Y",
                "PAGER_TEMPLATE" => "",
                "PAGER_DESC_NUMBERING" => "Y",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "Y",
                "PAGER_BASE_LINK_ENABLE" => "Y",
                "SET_STATUS_404" => "Y",
                "SHOW_404" => "Y",
                "MESSAGE_404" => "",
                "PAGER_BASE_LINK" => "",
                "PAGER_PARAMS_NAME" => "arrPager",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_ADDITIONAL" => ""
            )
        ); ?>


        <? $APPLICATION->IncludeComponent(
            "bitrix:form.result.new",
            "become_partner",
            array(
                "SEF_MODE" => "N",
                "WEB_FORM_ID" => 1,
                "LIST_URL" => "",
                "EDIT_URL" => "",
                "SUCCESS_URL" => "",
                "CHAIN_ITEM_TEXT" => "",
                "CHAIN_ITEM_LINK" => "",
                "IGNORE_CUSTOM_TEMPLATE" => "Y",
                "USE_EXTENDED_ERRORS" => "Y",
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "3600",
                "SEF_FOLDER" => "/",
                "VARIABLE_ALIASES" => array(),

                // Мои параметры -->
                "OK_MESSAGE" => "Спасибо! Ваша заявка успешно отправлена. Мы ответим Вам в ближайшее время."
                // <--
            )
        ); ?>

        <div class="page__section">
            <div class="page__container">
                <!-- begin .section-->
                <div class="section section_spacing_top-none">
                    <div class="section__main">
                        <div class="section__content">
                            <div class="section__info-panel">
                                <!-- begin .info-block-->
                                <div class="info-panel">
                                    <div class="info-panel__content">
                                        <div class="info-panel__title">
                                            <!-- begin .title-->
                                            <h2 class="title title_style_gradient title_size_h1"><?= $arItem['DISPLAY_PROPERTIES']['TEAM_HEADER']['VALUE'] ?>
                                            </h2>
                                            <!-- end .title-->
                                        </div>
                                        <div class="info-panel__main">
                                            <div class="info-panel__text">
                                                <?= $arItem['DISPLAY_PROPERTIES']['TEAM_TEXT']['~VALUE']['TEXT'] ?>
                                            </div>
                                            <div class="info-panel__illustration">
                                                <picture class="info-panel__picture">
                                                    <img src="<?= $arItem['TEAM_IMG']['SRC']; ?>" alt="<?= $arItem['TEAM_IMG']["ALT"] ?>" title="<?= $arItem['TEAM_IMG']["TITLE"] ?>" class="info-panel__image" />
                                                </picture>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end .info-block-->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end .section-->
            </div>
        </div>
        <div class="page__section">
            <!-- begin .section-->
            <div class="section section_spacing_top-none section_style_filled">
                <div class="section__main">
                    <div class="section__header page__container">
                        <div class="section__header-container">
                            <div class="section__title">
                                <!-- begin .title-->
                                <h2 class="title title_size_h1 title_case_upper">
                                    <?= $arItem['DISPLAY_PROPERTIES']['GROWTH_HEADER']['VALUE'] ?>
                                </h2>
                                <!-- end .title-->
                            </div>
                        </div>
                    </div>
                    <div class="section__content page__container">
                        <p class="section__description">
                            <?= $arItem['DISPLAY_PROPERTIES']['GROWTH_TEXT']['~VALUE']['TEXT'] ?>
                        </p>
                    </div>
                    <div class="section__illustration page__container">
                        <picture class="section__picture">
                            <img src="<?= $arItem['GROWTH_IMG']['SRC']; ?>" alt="<?= $arItem['GROWTH_IMG']["ALT"] ?>" title="<?= $arItem['GROWTH_IMG']["TITLE"] ?>" class="section__image" />
                        </picture>
                    </div>
                </div>
            </div>
            <!-- end .section-->
        </div>
        <div class="page__section">
            <div class="page__container">
                <!-- begin .section-->
                <div class="section section_spacing_top-none">
                    <div class="section__main">
                        <div class="section__header">
                            <div class="section__header-container">
                                <div class="section__title">
                                    <!-- begin .title-->
                                    <h2 class="title title_size_h2 title_style_gradient">Преимущества
                                    </h2>
                                    <!-- end .title-->
                                </div>
                                <div class="section__carousel-nav">
                                    <!-- begin .carousel-nav-->
                                    <div class="carousel-nav carousel-nav_layout_horizontal js-carousel-nav" data-nav-scope=".section" data-nav-target=".swiper">
                                        <div class="carousel-nav__control">
                                            <!-- begin .button-->
                                            <button class="button js-carousel-nav-prev button button_style_secondary button button_size_xs" type="button"><span class="button__holder"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M14 18L8 12L14 6L15.4 7.4L10.8 12L15.4 16.6L14 18Z" fill="currentColor" />
                                                    </svg></span>
                                            </button>
                                            <!-- end .button-->
                                        </div>
                                        <div class="carousel-nav__control">
                                            <!-- begin .button-->
                                            <button class="button js-carousel-nav-next button button_style_secondary button button_size_xs" type="button"><span class="button__holder"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M12.6 12L8 7.4L9.4 6L15.4 12L9.4 18L8 16.6L12.6 12Z" fill="currentColor" />
                                                    </svg></span>
                                            </button>
                                            <!-- end .button-->
                                        </div>
                                    </div>
                                    <!-- end .carousel-nav-->
                                </div>
                            </div>
                        </div>
                        <div class="section__content">
                            <!-- begin .advantages-carousel-->
                            <div class="advantages-carousel">
                                <div class="advantages-carousel__container swiper js-advantages-carousel">
                                    <div class="advantages-carousel__wrapper swiper-wrapper">
                                        <? foreach ($arItem['DISPLAY_PROPERTIES']['FEATURES_ABOUT']['VALUE'] as $key => $arFeature) { ?>
                                            <div class="advantages-carousel__slide swiper-slide">
                                                <div class="advantages-carousel__item">
                                                    <!-- begin .advantage-card-->
                                                    <div class="advantage-card">
                                                        <div class="advantage-card__wrapper">
                                                            <div class="advantage-card__top">
                                                                <div class="advantage-card__illustration">
                                                                    <picture class="advantage-card__picture">
                                                                      <img src="<?= $arFeature['SUB_VALUES']['FEATURES_ABOUT_IMG']['PICTURE']['SRC']; ?>" alt="<?= $arFeature['SUB_VALUES']['FEATURES_ABOUT_IMG']['PICTURE']["ALT"] ?>" title="<?= $arFeature['SUB_VALUES']['FEATURES_ABOUT_IMG']['PICTURE']["TITLE"] ?>" class="info-panel__image" />
                                                                    </picture>
                                                                </div><span class="advantage-card__title"><?= $arFeature['SUB_VALUES']['FEATURES_ABOUT_HEADER']['~VALUE']; ?></span>
                                                            </div>
                                                            <p class="advantage-card__text">
                                                                <?= $arFeature['SUB_VALUES']['FEATURES_ABOUT_TEXT']['~VALUE']['TEXT']; ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <!-- end .advantage-card-->
                                                </div>
                                            </div>
                                        <? } ?>
                                    </div>
                                </div>
                                <div class="advantages-carousel__navigation">
                                    <div class="advantages-carousel__pagination">
                                        <!-- begin .bullet-pagination-->
                                        <div class="bullet-pagination bullet-pagination_role_advantages">
                                        </div>
                                        <!-- end .bullet-pagination-->
                                    </div>
                                </div>
                            </div>
                            <!-- end .advantages-carousel-->
                        </div>
                    </div>
                </div>
                <!-- end .section-->
            </div>
        </div>
        <? $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "photos_slider_main",
            array(
                "IBLOCK_ID" => PHOTOS_SLIDER_MAIN_IB_ID,
                "IBLOCK_TYPE" => "content",
                "DISPLAY_DATE" => "Y",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "Y",
                "AJAX_MODE" => "N",
                "NEWS_COUNT" => "20",
                "SORT_BY2" => "ACTIVE_FROM",
                "SORT_ORDER2" => "DESC",
                "SORT_BY1" => "SORT",
                "SORT_ORDER1" => "ASC",
                "FILTER_NAME" => "",
                "FIELD_CODE" => array("ID", "PREVIEW_TEXT", "PREVIEW_PICTURE"),
                "PROPERTY_CODE" => array("HEADER", "LINK", "LINK_TEXT"),
                "CHECK_DATES" => "Y",
                "DETAIL_URL" => "",
                "PREVIEW_TRUNCATE_LEN" => "",
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "SET_TITLE" => "N",
                "SET_BROWSER_TITLE" => "Y",
                "SET_META_KEYWORDS" => "Y",
                "SET_META_DESCRIPTION" => "Y",
                "SET_LAST_MODIFIED" => "Y",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "ADD_SECTIONS_CHAIN" => "N",
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
                "PAGER_SHOW_ALWAYS" => "Y",
                "PAGER_TEMPLATE" => "",
                "PAGER_DESC_NUMBERING" => "Y",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "Y",
                "PAGER_BASE_LINK_ENABLE" => "Y",
                "SET_STATUS_404" => "Y",
                "SHOW_404" => "Y",
                "MESSAGE_404" => "",
                "PAGER_BASE_LINK" => "",
                "PAGER_PARAMS_NAME" => "arrPager",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_ADDITIONAL" => ""
            )
        ); ?>
    <? } ?>
<? } ?>