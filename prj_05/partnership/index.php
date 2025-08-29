<?
define('SHOW_TEMPLATE_BOTTOM_BANNER', 'N');
define('SHOW_TEMPLATE_BOTTOM_ASK', 'N');
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Partnership");
?>

<?
ob_start();
?>

<? $APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "slider_banners_partnership",
    array(
        "IBLOCK_ID" => CONCEPT_BANNERS_COOPERATION_IB_ID,
        "IBLOCK_TYPE" => "banners_en",
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
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "DISPLAY_TOP_PAGER" => "N",
        "FIELD_CODE" => array(0 => "", 1 => "",),
        "FILTER_NAME" => "arrBannerCooperation",
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
        "PROPERTY_CODE" => array(0 => "LINK", 1 => "MOBILE_IMAGE", 2 => "TABLET_IMAGE", 3 => "DESKTOP_IMAGE", 4 => "",),
        "SET_BROWSER_TITLE" => "N",
        "SET_LAST_MODIFIED" => "N",
        "SET_META_DESCRIPTION" => "N",
        "SET_META_KEYWORDS" => "N",
        "SET_STATUS_404" => "Y",
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

<div class="page__contacts js_page_scroll_after_form_send">
    <div class="page__container">
        <!-- begin .contacts-->
        <div class="contacts">
            <div class="contacts__wrapper">
                <div class="contacts__main">
                    <div class="contacts__section">
                        <h1 class="contacts__title">
                            <?
                            $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "/include/partnership/h1.php",
                                    "AREA_FILE_RECURSIVE" => "N",
                                    "EDIT_MODE" => "html",
                                ),
                                false,
                                array('HIDE_ICONS' => 'N')
                            );
                            ?>
                        </h1>
                        <div class="contacts__text">
                            <?
                            $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "/include/partnership/text_1.php",
                                    "AREA_FILE_RECURSIVE" => "N",
                                    "EDIT_MODE" => "html",
                                ),
                                false,
                                array('HIDE_ICONS' => 'N')
                            );
                            ?>
                        </div>
                        <div class="contacts__note">
                            <?
                            $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "/include/partnership/text_2.php",
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
                <? $APPLICATION->IncludeComponent(
                    "bitrix:form.result.new",
                    "partnership",
                    array(
                        "SEF_MODE" => "N",
                        "WEB_FORM_ID" => 3,
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
                    )
                ); ?>    
            </div>
        </div>
        <!-- end .contacts-->
    </div>
</div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>