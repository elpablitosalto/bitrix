<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Маркетинговые материалы");
?>
<div class="page__breadcrumbs">
    <div class="page__container">
        <!-- begin .breadcrumbs-->
        <?$APPLICATION->IncludeComponent("bitrix:breadcrumb","hair.crumbs",Array(
                "START_FROM" => "0",
                "PATH" => "",
                "SITE_ID" => "s1"
            )
        );?>
        <!-- end .breadcrumbs-->
    </div>
</div>
<div class="page__section">
    <!-- begin .section-->
    <div
            class="section section_role_entity-grid section_spacing_top-close section_text-size_l section_text-style_grey"
    >
        <div class="section__header">
            <div class="section__container page__container">
                <div class="section__title">
                    <!-- begin .title-->
                    <h1 class="title title_size_h4">Скачиваемые файлы</h1>
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
                            "PATH" => SITE_TEMPLATE_PATH."/include/downloads/list_desc.php",
                            "AREA_FILE_RECURSIVE" => "N",
                            "EDIT_MODE" => "html",
                        ), false
                    );
                    ?>
                </div>
                <div class="section__entity-grid">
                    <!-- begin .entity-grid-->
                    <div class="entity-grid">
                        <div class="entity-grid__select-group">
                            <?$APPLICATION->IncludeComponent(
                                "bitrix:catalog.smart.filter",
                                "downloads.page.filter",
                                array(
                                    "CACHE_GROUPS" => "Y",
                                    "CACHE_TIME" => "36000000",
                                    "CACHE_TYPE" => "A",
                                    "DISPLAY_ELEMENT_COUNT" => "Y",
                                    "FILTER_NAME" => "arrFilter",
                                    "FILTER_VIEW_MODE" => "vertical",
                                    "IBLOCK_ID" => "4",
                                    "IBLOCK_TYPE" => "materials",
                                    "PAGER_PARAMS_NAME" => "arrPager",
                                    "POPUP_POSITION" => "left",
                                    "PREFILTER_NAME" => "smartPreFilter",
                                    "SAVE_IN_SESSION" => "N",
                                    "SECTION_CODE" => "",
                                    "SECTION_CODE_PATH" => "",
                                    "SECTION_DESCRIPTION" => "-",
                                    "SECTION_ID" => $_REQUEST["SECTION_ID"],
                                    "SECTION_TITLE" => "-",
                                    "SEF_MODE" => "Y",
                                    "SEF_RULE" => "",
                                    "SMART_FILTER_PATH" => "",
                                    "TEMPLATE_THEME" => "blue",
                                    "XML_EXPORT" => "N",
                                    "COMPONENT_TEMPLATE" => "downloads.page.filter"
                                ),
                                false
                            );?>
                            <div class="download-actions">
                                <a class="icon-link" target="_blank" data-ajax-download href="#">
                                    <span class="icon-link__icon-wrapper">
                                        <svg class="icon-link__icon" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0)">
                                                <path d="M7.99996 10.6666C7.8633 10.6666 7.73263 10.6106 7.63863 10.512L4.13863 6.84531C3.8353 6.52798 4.06063 5.99998 4.49996 5.99998H6.3333V2.16665C6.3333 1.70731 6.7073 1.33331 7.16663 1.33331H8.8333C9.29263 1.33331 9.66663 1.70731 9.66663 2.16665V5.99998H11.5C11.9393 5.99998 12.1646 6.52798 11.8613 6.84531L8.3613 10.512C8.2673 10.6106 8.13663 10.6666 7.99996 10.6666Z" fill="#282323"></path>
                                                <path d="M14.8333 14.6667H1.16667C0.523333 14.6667 0 14.1433 0 13.5V13.1667C0 12.5233 0.523333 12 1.16667 12H14.8333C15.4767 12 16 12.5233 16 13.1667V13.5C16 14.1433 15.4767 14.6667 14.8333 14.6667Z" fill="#282323"></path>
                                            </g>
                                            <defs>
                                                <clipPath id="clip0">
                                                    <rect width="16" height="16" fill="white"></rect>
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </span>
                                    <span class="downloads-cnt icon-link__text">Скачать (<i>0</i>)</span>
                                    <input type="hidden" id="filesToDownload" name="FILES" />
                                </a>
                            </div>
                        </div>
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:news.list",
                            "downloads.page",
                            array(
                                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                                "ADD_SECTIONS_CHAIN" => "N",
                                "AJAX_MODE" => "Y",
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
                                "FIELD_CODE" => array(
                                    0 => "",
                                    1 => "",
                                ),
                                "FILTER_NAME" => "",
                                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                "IBLOCK_ID" => MATERIALS,
                                "IBLOCK_TYPE" => "materials",
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
                                    0 => "PRODUCT_LINES",
                                    1 => "MATERIAL_TYPE",
                                    2 => "MATERIAL_FORMAT",
                                    3 => "",
                                ),
                                "SET_BROWSER_TITLE" => "Y",
                                "SET_LAST_MODIFIED" => "N",
                                "SET_META_DESCRIPTION" => "Y",
                                "SET_META_KEYWORDS" => "Y",
                                "SET_STATUS_404" => "N",
                                "SET_TITLE" => "Y",
                                "SHOW_404" => "N",
                                "SORT_BY1" => "ACTIVE_FROM",
                                "SORT_BY2" => "SORT",
                                "SORT_ORDER1" => "DESC",
                                "SORT_ORDER2" => "ASC",
                                "STRICT_SECTION_CHECK" => "N",
                                "COMPONENT_TEMPLATE" => "downloads.page"
                            ),
                            false
                        );?>
                    </div>
                    <!-- end .entity-grid-->
                </div>
            </div>
        </div>
    </div>
    <!-- end .section-->
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>