<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("About");
?>

<?
ob_start();
?>
<? $APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "slider_banners_main_page",
    array(
        "IBLOCK_ID" => CONCEPT_BANNERS_ABOUT_IB_ID,
        "IBLOCK_TYPE" => "banners_en",
        "COMPONENT_TEMPLATE" => "slider_banners_main_page",
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
        "FIELD_CODE" => array(0 => "ID", 1 => "CODE", 2 => "PREVIEW_PICTURE", 3 => "DETAIL_PICTURE", 4 => "",),
        "FILTER_NAME" => "",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
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
        "PROPERTY_CODE" => array(0 => "VDEO_URL", 1 => "VIDEO_FILE",),
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
); ?>
<?
$out = ob_get_contents();
ob_end_clean();
$APPLICATION->AddViewContent('TOP_BIG_SLIDER', $out);
?>

<div class="page__section">
    <!-- begin .section-->
    <div class="section">
        <div class="section__main">
            <div class="section__content">
                <div class="page__container">
                    <div class="section__text section__text_size_s section__text_width_l">
                        <?
                        $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_DIR . "/include/about/h1_text.php",
                                "AREA_FILE_RECURSIVE" => "N",
                                "EDIT_MODE" => "html",
                            ),
                            false,
                            array('HIDE_ICONS' => 'N')
                        );
                        ?>
                    </div>
                    <div class="section__advantage-group">
                        <!-- begin .advantage-group-->
                        <div class="advantage-group">
                            <div class="advantage-group__header">
                                <div class="advantage-group__title">
                                    <!-- begin .title-->
                                    <h2 class="title title_size_h4 title_weight_medium">
                                        <?
                                        $APPLICATION->IncludeComponent(
                                            "bitrix:main.include",
                                            "",
                                            array(
                                                "AREA_FILE_SHOW" => "file",
                                                "PATH" => SITE_DIR . "/include/about/h2.php",
                                                "AREA_FILE_RECURSIVE" => "N",
                                                "EDIT_MODE" => "html",
                                            ),
                                            false,
                                            array('HIDE_ICONS' => 'N')
                                        );
                                        ?>
                                    </h2>
                                    <!-- end .title-->
                                </div>
                            </div>
                            <div class="advantage-group__main">
                                <ul class="advantage-group__list">
                                    <li class="advantage-group__item">
                                        <!-- begin .advantage-->
                                        <div class="advantage">
                                            <div class="advantage__illustration">
                                                <picture class="advantage__picture">
                                                    <img src="<?= SITE_TEMPLATE_PATH ?>/mockup/dist/assets/blocks/advantage/images/1.png" alt="image" class="advantage__image" title="" />
                                                </picture>
                                            </div>
                                            <div class="advantage__main">
                                                <div class="advantage__text">
                                                    <?
                                                    $APPLICATION->IncludeComponent(
                                                        "bitrix:main.include",
                                                        "",
                                                        array(
                                                            "AREA_FILE_SHOW" => "file",
                                                            "PATH" => SITE_DIR . "/include/about/feature_1.php",
                                                            "AREA_FILE_RECURSIVE" => "N",
                                                            "EDIT_MODE" => "html",
                                                        ),
                                                        false,
                                                        array('HIDE_ICONS' => 'N')
                                                    );
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end .advantage-->
                                    </li>
                                    <li class="advantage-group__item">
                                        <!-- begin .advantage-->
                                        <div class="advantage">
                                            <div class="advantage__illustration">
                                                <picture class="advantage__picture">
                                                    <img src="<?= SITE_TEMPLATE_PATH ?>/mockup/dist/assets/blocks/advantage/images/2.png" alt="image" class="advantage__image" title="" />
                                                </picture>
                                            </div>
                                            <div class="advantage__main">
                                                <div class="advantage__text">
                                                    <?
                                                    $APPLICATION->IncludeComponent(
                                                        "bitrix:main.include",
                                                        "",
                                                        array(
                                                            "AREA_FILE_SHOW" => "file",
                                                            "PATH" => SITE_DIR . "/include/about/feature_2.php",
                                                            "AREA_FILE_RECURSIVE" => "N",
                                                            "EDIT_MODE" => "html",
                                                        ),
                                                        false,
                                                        array('HIDE_ICONS' => 'N')
                                                    );
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end .advantage-->
                                    </li>
                                    <li class="advantage-group__item">
                                        <!-- begin .advantage-->
                                        <div class="advantage">
                                            <div class="advantage__illustration">
                                                <picture class="advantage__picture">
                                                    <img src="<?= SITE_TEMPLATE_PATH ?>/mockup/dist/assets/blocks/advantage/images/3.png" alt="image" class="advantage__image" title="" />
                                                </picture>
                                            </div>
                                            <div class="advantage__main">
                                                <div class="advantage__text">
                                                    <?
                                                    $APPLICATION->IncludeComponent(
                                                        "bitrix:main.include",
                                                        "",
                                                        array(
                                                            "AREA_FILE_SHOW" => "file",
                                                            "PATH" => SITE_DIR . "/include/about/feature_3.php",
                                                            "AREA_FILE_RECURSIVE" => "N",
                                                            "EDIT_MODE" => "html",
                                                        ),
                                                        false,
                                                        array('HIDE_ICONS' => 'N')
                                                    );
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end .advantage-->
                                    </li>
                                    <li class="advantage-group__item">
                                        <!-- begin .advantage-->
                                        <div class="advantage">
                                            <div class="advantage__illustration">
                                                <picture class="advantage__picture">
                                                    <img src="<?= SITE_TEMPLATE_PATH ?>/mockup/dist/assets/blocks/advantage/images/4.png" alt="image" class="advantage__image" title="" />
                                                </picture>
                                            </div>
                                            <div class="advantage__main">
                                                <div class="advantage__text">
                                                    <?
                                                    $APPLICATION->IncludeComponent(
                                                        "bitrix:main.include",
                                                        "",
                                                        array(
                                                            "AREA_FILE_SHOW" => "file",
                                                            "PATH" => SITE_DIR . "/include/about/feature_4.php",
                                                            "AREA_FILE_RECURSIVE" => "N",
                                                            "EDIT_MODE" => "html",
                                                        ),
                                                        false,
                                                        array('HIDE_ICONS' => 'N')
                                                    );
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end .advantage-->
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- end .advantage-group-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end .section-->
</div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>