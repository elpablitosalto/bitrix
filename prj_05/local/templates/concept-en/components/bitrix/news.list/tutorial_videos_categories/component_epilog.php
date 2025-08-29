<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>

<? ?>
<div class="page__section">
    <!-- begin .section-->
    <div class="section">
        <div class="section__main">
            <?/*?>
            <div class="section__header">
                <div class="section__header-container page__container">
                    <div class="section__title">
                        <!-- begin .title-->
                        <h1 class="title title_size_h1 title_case_normal">
                            <?
                            $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "/include/videos/h1.php",
                                    "AREA_FILE_RECURSIVE" => "N",
                                    "EDIT_MODE" => "html",
                                ),
                                false,
                                array('HIDE_ICONS' => 'N')
                            );
                            ?>
                        </h1>
                        <!-- end .title-->
                    </div>
                </div>
            </div>
            <?*/?>
            <div class="section__content">
                <div class="page__container">
                    <div class="section__text section__text_size_m section__text_width_l">
                        <?
                        $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_DIR . "/include/videos/text.php",
                                "AREA_FILE_RECURSIVE" => "N",
                                "EDIT_MODE" => "html",
                            ),
                            false,
                            array('HIDE_ICONS' => 'N')
                        );
                        ?>
                    </div>
                    <div class="section__tabs">
                        <!-- begin .tabs-->
                        <div class="tabs tabs_no_mobile-title js-tabs">
                            <ul class="tabs__nav">
                                <li class="tabs__item">
                                    <button class="tabs__label js-tabs-trigger tabs__label_state_active" type="button" data-tab="1">
                                        <?= GetMessage('TUTORIAL_VIDEOS_CATEGORIES_ALL_SECTIONS'); ?>
                                    </button>
                                </li>
                                <? $i = 2; ?>
                                <? foreach ($arResult['TYPES'] as $k => $type) { ?>
                                    <li class="tabs__item">
                                        <button class="tabs__label js-tabs-trigger" type="button" data-tab="<?= $i ?>">
                                            <?= $type['NAME'] ?>
                                        </button>
                                    </li>
                                    <? $i++ ?>
                                <? } ?>
                            </ul>

                            <? $APPLICATION->IncludeComponent(
                                "bitrix:news.list",
                                "tutorial_videos",
                                array(
                                    "IBLOCK_ID" => TRAINING_VIDEOS_IB_ID,
                                    "IBLOCK_TYPE" => "content_en",
                                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                                    "ADD_ELEMENT_CHAIN" => "N",
                                    "ADD_SECTIONS_CHAIN" => "N",
                                    "AJAX_MODE" => "N",
                                    "AJAX_OPTION_ADDITIONAL" => "",
                                    "AJAX_OPTION_HISTORY" => "N",
                                    "AJAX_OPTION_JUMP" => "N",
                                    "AJAX_OPTION_STYLE" => "Y",
                                    "BROWSER_TITLE" => "-",
                                    "CACHE_GROUPS" => "Y",
                                    "CACHE_TIME" => "36000000",
                                    "CACHE_TYPE" => "A",
                                    "CHECK_DATES" => "Y",
                                    "DETAIL_URL" => "",
                                    "DISPLAY_BOTTOM_PAGER" => "Y",
                                    "DISPLAY_DATE" => "Y",
                                    "DISPLAY_NAME" => "Y",
                                    "DISPLAY_PICTURE" => "Y",
                                    "DISPLAY_PREVIEW_TEXT" => "Y",
                                    "DISPLAY_TOP_PAGER" => "N",
                                    "ELEMENT_CODE" => $_REQUEST["CODE"],
                                    "ELEMENT_ID" => "",
                                    "FIELD_CODE" => array("", ""),
                                    "IBLOCK_URL" => "",
                                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                    "MESSAGE_404" => "",
                                    "NEWS_COUNT" => "99",
                                    "META_DESCRIPTION" => "-",
                                    "META_KEYWORDS" => "-",
                                    "PAGER_BASE_LINK_ENABLE" => "N",
                                    "PAGER_SHOW_ALL" => "N",
                                    "PAGER_SHOW_ALWAYS" => "N",
                                    "PAGER_TEMPLATE" => "main",
                                    "PAGER_TITLE" => "Видео",
                                    "PROPERTY_CODE" => array("", "TOP_BANNER_DESKTOP", "TOP_BANNER_MOBILE", ""),
                                    "SET_BROWSER_TITLE" => "Y",
                                    "SET_CANONICAL_URL" => "N",
                                    "SET_LAST_MODIFIED" => "N",
                                    "SET_META_DESCRIPTION" => "N",
                                    "SET_META_KEYWORDS" => "N",
                                    "SET_STATUS_404" => "N",
                                    "SET_TITLE" => "Y",
                                    "SHOW_404" => "N",
                                    "SORT_BY1" => "SORT",
                                    "SORT_BY2" => "ID",
                                    "SORT_ORDER1" => "ASC",
                                    "SORT_ORDER2" => "DESC",
                                    "STRICT_SECTION_CHECK" => "N",
                                    "USE_PERMISSIONS" => "N",
                                    "USE_SHARE" => "N"
                                )
                            ); ?>                            
                        </div>
                        <!-- end .tabs-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end .section-->
</div>