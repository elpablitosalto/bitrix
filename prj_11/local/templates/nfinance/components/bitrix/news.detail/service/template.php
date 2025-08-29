<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<?
$pathToImage = '';
if(!empty($arResult['DISPLAY_PROPERTIES']['BANNER']['LINK_ELEMENT_VALUE'])){
  $pathToImage = CFile::GetPath(array_shift($arResult['DISPLAY_PROPERTIES']['BANNER']['LINK_ELEMENT_VALUE'])['DETAIL_PICTURE']);
}
$siteName = SITE_SERVER_NAME;
$mainEntityOfPageUrl = !empty($arResult['DETAIL_PAGE_URL']) ? $arResult['DETAIL_PAGE_URL'] : null;

$downloadFile = !empty($arResult["PROPERTIES"]["DOWNLOAD_FILE"]["VALUE"]) ? CFile::GetFileArray($arResult["PROPERTIES"]["DOWNLOAD_FILE"]["VALUE"]) : Array();

$pageType = !empty($arResult["PROPERTIES"]["DETAIL_TYPE"]["VALUE_XML_ID"]) ? $arResult["PROPERTIES"]["DETAIL_TYPE"]["VALUE_XML_ID"] : "DEFAULT";
$downloadLink = !empty($downloadFile["SRC"]) ? $downloadFile["SRC"] : "";
$pageType = !empty($downloadLink) ? "BOOK" : $pageType;


$downloadForm = "#modalDownload";
?>
<script type='application/ld+json'>

<?
$arr = array(
  "@context" => "https://schema.org",
  "@type" => "Article",
  "headline" => !empty($arResult['NAME']) ? $arResult['NAME'] : null,
  "image" => "https://{$siteName}{$pathToImage}",
  "datePublished" => '05.04.2024 16:29:09',
  "keywords" => !empty($arResult['IPROPERTY_VALUES']['ELEMENT_META_KEYWORDS']) ? $arResult['IPROPERTY_VALUES']['ELEMENT_META_KEYWORDS'] : null,
  "description" => !empty($arResult['PREVIEW_TEXT']) ? $arResult['PREVIEW_TEXT'] : null ,
  "articleSection" =>  !empty($arResult['SECTION']['PATH'][0]['NAME']) ? $arResult['SECTION']['PATH'][0]['NAME'] : null,
  "author" => 'Нескуные финансы',
  "mainEntityOfPage" => "https://{$siteName}{$mainEntityOfPageUrl}",
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

<?if($pageType !== "BOOK"):?>
    <?if(!empty($arResult["PROPERTIES"]["BANNER"]["VALUE"])):?>
        <div class="page__section page__section_no_overflow">
            <div class="page__holder page__holder_mobile-gutter_s">
                <!-- begin .section-->
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:news.detail",
                    "service_top_banner",
                    Array(
                        "IBLOCK_ID" => $arResult["PROPERTIES"]["BANNER"]["LINK_IBLOCK_ID"],
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                        "ADD_SECTIONS_CHAIN" => "N",
                        "ADD_ELEMENT_CHAIN" => "N",
                        "FIELD_CODE" => [
                            "NAME",
                            "PREVIEW_TEXT",
                            "PREVIEW_PICTURE",
                            "DETAIL_PICTURE",
                        ],
                        "PROPERTY_CODE" => [
                            "BUTTON_NAME",
                            "BUTTON_LINK",
                            "BUTTON_DESC",
                            "TITLE",
                            "TIPPY_PRIMARY_NAME",
                            "TIPPY_PRIMARY_DESC",
                            "TIPPY_SECONDARY_NAME",
                            "TIPPY_SECONDARY_DESC",
                            "BANNER_TYPE"
                        ],
                        "ELEMENT_ID" => $arResult["PROPERTIES"]["BANNER"]["VALUE"]
                    ),
                    $component
                );
                ?>
                <!-- end .section-->
            </div>
        </div>
    <?endif;?>
    <div class="page__section">
        <div class="page__holder">
            <!-- begin .section-->
            <div class="section section_space_top-close">
                <div class="section__header section__header_type_inline">
                    <div class="section__title">
                        <!-- begin .title-->
                        <h2 class="title title_size_h2">
                            <?=(!empty($arResult['PROPERTIES']['TITLE']['VALUE']['TEXT']) ? htmlspecialchars_decode($arResult['PROPERTIES']['TITLE']['VALUE']['TEXT']) : $arResult["NAME"])?>
                        </h2>
                        <!-- end .title-->
                    </div>
                    <div class="section__meta">
                        <div class="section__subtitle">
                            <?=htmlspecialchars_decode($arResult["PREVIEW_TEXT"])?>
                        </div>
                    </div>
                </div>
                <?if(!empty($arResult["PROPERTIES"]["ADVANTAGES"]["VALUE"])):?>
                    <div class="section__content">
                        <div class="section__description-panel">
                            <!-- begin .description-panel-->
                            <?
                            $GLOBALS["advantagesFilter"] = [
                                "ID" => $arResult["PROPERTIES"]["ADVANTAGES"]["VALUE"]
                            ];
                            $APPLICATION->IncludeComponent("bitrix:news.list", "service_advantages", array(
                                "IBLOCK_TYPE" => "directories",
                                "IBLOCK_ID" => $arResult["PROPERTIES"]["ADVANTAGES"]["LINK_IBLOCK_ID"],
                                "NEWS_COUNT" => "9",
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
                                    "ICON"
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
                            <!-- end .description-panel-->
                        </div>
                    </div>
                <?endif;?>
            </div>
            <!-- end .section-->
        </div>
    </div>
    <?if(!empty($arResult["PROPERTIES"]["LIST"]["VALUE"])):?>
    <div class="page__section page__section_style_secondary page__section_role_sticky">
        <div class="page__holder">
            <!-- begin .section-->
            <div class="section section_role_sticky">
                <div class="section__content">
                    <div class="section__stiky-panel">
                        <!-- begin .sticky-info-->
                        <?
                        $GLOBALS["listFilter"] = [
                            "ID" => $arResult["PROPERTIES"]["LIST"]["VALUE"]
                        ];
                        $APPLICATION->IncludeComponent("bitrix:news.list", "service_list", array(
                            "IBLOCK_TYPE" => "directories",
                            "IBLOCK_ID" => $arResult["PROPERTIES"]["LIST"]["LINK_IBLOCK_ID"],
                            "NEWS_COUNT" => "20",
                            "SORT_BY1" => "SORT",
                            "SORT_ORDER1" => "ASC",
                            "SORT_BY2" => "ID",
                            "SORT_ORDER2" => "ASC",
                            "FILTER_NAME" => "listFilter",
                            "FIELD_CODE" => array(
                                "NAME",
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
                            "AJAX_OPTION_ADDITIONAL" => "",
                            "TITLE" => !empty($arResult["PROPERTIES"]["LIST_TITLE"]["VALUE"]["TEXT"]) ? $arResult["PROPERTIES"]["LIST_TITLE"]["VALUE"]["TEXT"] : ""
                        ),
                            false
                        );?>
                        <!-- end .sticky-info-->
                    </div>
                </div>
            </div>
            <!-- end .section-->
        </div>
    </div>
    <?endif;?>
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
                    <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/include/services/middle_banner.php",
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
    <?if(!empty($arResult['PROPERTIES']['ADVANTAGE_IMAGES']['VALUE'])):?>
        <div class="page__section">
            <div class="page__holder">
                <!-- begin .section-->
                <div class="section section_space_bottom-close">
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
                            $GLOBALS["advantagesFilter_".$arResult['ID']] = [
                                "ID" => $arResult['PROPERTIES']['ADVANTAGE_IMAGES']['VALUE']
                            ];
                            $APPLICATION->IncludeComponent("bitrix:news.list", "advantages", array(
                                "IBLOCK_TYPE" => "content",
                                "IBLOCK_ID" => "11",
                                "NEWS_COUNT" => "4",
                                "SORT_BY1" => "SORT",
                                "SORT_ORDER1" => "ASC",
                                "SORT_BY2" => "ID",
                                "SORT_ORDER2" => "ASC",
                                "FILTER_NAME" => "advantagesFilter_".$arResult['ID'],
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
    <?endif;?>
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
                "AJAX_OPTION_ADDITIONAL" => "",
                "SECTION_MODIF_CLASS" => ""
            ),
                false
            );
            ?>
            <!-- end .section-->
        </div>
    </div>
<?else:?>
    <?// Страница книги?>
    <?if(!empty($arResult["PROPERTIES"]["BANNER"]["VALUE"])):?>
        <div class="page__section page__section_no_overflow">
            <div class="page__holder page__holder_mobile-gutter_s">
                <!-- begin .section-->
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:news.detail",
                    "service_top_banner",
                    Array(
                        "IBLOCK_ID" => $arResult["PROPERTIES"]["BANNER"]["LINK_IBLOCK_ID"],
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                        "ADD_SECTIONS_CHAIN" => "N",
                        "ADD_ELEMENT_CHAIN" => "N",
                        "FIELD_CODE" => [
                            "NAME",
                            "PREVIEW_TEXT",
                            "PREVIEW_PICTURE",
                            "DETAIL_PICTURE",
                        ],
                        "PROPERTY_CODE" => [
                            "BUTTON_NAME",
                            "BUTTON_LINK",
                            "BUTTON_DESC",
                            "TITLE",
                            "TIPPY_PRIMARY_NAME",
                            "TIPPY_PRIMARY_DESC",
                            "TIPPY_SECONDARY_NAME",
                            "TIPPY_SECONDARY_DESC",
                            "BANNER_TYPE"
                        ],
                        "ELEMENT_ID" => $arResult["PROPERTIES"]["BANNER"]["VALUE"],
                        "BUTTON_SHOW" => !empty($arResult["PROPERTIES"]["WEB_FORM_ID"]["VALUE"]),
                        "BUTTON_LINK" => $downloadForm,
                        "BUTTON_TEXT" => "Скачать книгу бесплатно",
                        "DOWNLOAD_ICON" => true
                    ),
                    $component
                );
                ?>
                <!-- end .section-->
            </div>
        </div>
    <?endif;?>
    <?if(!empty($arResult["PROPERTIES"]["ADVANTAGES"]["VALUE"])):?>
        <div class="page__section">
            <div class="page__holder">
                <!-- begin .section-->
                <div class="section section_space_top-close section_role_grid">
                    <div class="section__header section__header_type_inline">
                        <div class="section__title">
                            <!-- begin .title-->
                            <div class="title title_size_sh2 title_style_primary">Какую пользу</div>
                            <!-- end .title-->
                            <!-- begin .title-->
                            <h2 class="title title_size_sh2">получу из книги</h2>
                            <!-- end .title-->
                        </div>
                    </div>
                    <div class="section__content">
                        <div class="section__description-panel section__description-panel_space_close">
                            <?
                            $GLOBALS["advantagesFilter"] = [
                                "ID" => $arResult["PROPERTIES"]["ADVANTAGES"]["VALUE"]
                            ];
                            $APPLICATION->IncludeComponent("bitrix:news.list", "book_advantages", array(
                                "IBLOCK_TYPE" => "directories",
                                "IBLOCK_ID" => $arResult["PROPERTIES"]["ADVANTAGES"]["LINK_IBLOCK_ID"],
                                "NEWS_COUNT" => "9",
                                "SORT_BY1" => "SORT",
                                "SORT_ORDER1" => "ASC",
                                "SORT_BY2" => "ID",
                                "SORT_ORDER2" => "ASC",
                                "FILTER_NAME" => "advantagesFilter",
                                "FIELD_CODE" => array(
                                    "NAME",
                                    "PREVIEW_TEXT",
                                    "PREVIEW_PICTURE",
                                ),
                                "PROPERTY_CODE" => array(
                                    "ICON"
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
                                "AJAX_OPTION_ADDITIONAL" => "",
                                "BUTTON_SHOW" => !empty($arResult["PROPERTIES"]["WEB_FORM_ID"]["VALUE"]),
                                "BUTTON_LINK" => $downloadForm,
                                "BUTTON_TEXT" => "Скачать книгу бесплатно",
                                "DOWNLOAD_ICON" => true
                            ),
                                false
                            );?>
                        </div>
                    </div>
                </div>
                <!-- end .section-->
            </div>
        </div>
    <?endif;?>

    <?if(!empty($arResult["GALLERY"])):?>
        <div class="page__section page__section_no_overflow page__section_style_secondary page__section_decoration_bottom">
        <div class="page__holder">
          <!-- begin .section-->
          <div class="section">
            <div class="section__header section__header_type_inline">
              <div class="section__title">
                <!-- begin .title-->
                <h2 class="title title_size_sh2">Полистайте <i class="lb lb_disabled_s">&nbsp;</i>книгу
                </h2>
                <!-- end .title-->
              </div>
              <div class="section__carousel-nav">
                <!-- begin .carousel-nav-->
                <div class="carousel-nav undefined js-carousel-nav" data-nav-scope=".section" data-nav-target=".swiper">
                  <div class="carousel-nav__control">
                    <!-- begin .button-->
                    <button class="button button_role_navigation js-carousel-nav-prev" type="button"><span class="button__holder">
                      <svg class="button__icon" width="10" height="17" viewBox="0 0 10 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 1L1.33333 8.66667L9 16.3333" fill="transparent" stroke="currentColor"></path>
                      </svg></span>
                    </button>
                    <!-- end .button-->
                  </div>
                  <div class="carousel-nav__control">
                    <!-- begin .button-->
                    <button class="button button_role_navigation js-carousel-nav-next" type="button"><span class="button__holder">
                      <svg class="button__icon" width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 16L11.6667 8.33333L4 0.666667" fill="transparent" stroke="currentColor"></path>
                      </svg></span>
                    </button>
                    <!-- end .button-->
                  </div>
                </div>
                <!-- end .carousel-nav-->
              </div>
            </div>
            <div class="section__content">
              <div class="section__reviews-panel">
                <!-- begin .gallery-->
                <div class="gallery gallery_layout_portrait">
                  <div class="gallery__container swiper js-gallery-carousel">
                    <div class="gallery__wrapper swiper-wrapper">
                        <?foreach($arResult["GALLERY"] as $arGalleryItem):?>
                            <div class="gallery__slide swiper-slide">
                                <a class="gallery__illustration gallery__illustration_indent_s js-modal" href="<?=$arGalleryItem["DETAIL"]["src"]?>" data-fancybox="gallery-<?=$arResult["ID"]?>">
                                    <picture class="gallery__picture">
                                        <img src="<?=$arGalleryItem["PREVIEW"]["src"]?>" alt="image" class="gallery__image" title="">
                                    </picture>
                                    <span class="gallery__icon-holder">
                                        <svg class="gallery__icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M19.8169 18.9331L16.2515 15.3677C17.7312 13.6785 18.5397 11.5364 18.5397 9.26987C18.5397 6.79382 17.5754 4.46597 15.8246 2.71511C14.0737 0.964257 11.7459 0 9.26983 0C6.79378 0 4.46589 0.964257 2.71504 2.71507C0.964218 4.46593 0 6.79378 0 9.26983C0 11.7459 0.964257 14.0737 2.71507 15.8246C4.46589 17.5754 6.79378 18.5397 9.26983 18.5397C11.5364 18.5397 13.6784 17.7312 15.3677 16.2515L18.9331 19.8169C19.0551 19.939 19.2151 20 19.375 20C19.5349 20 19.6949 19.9389 19.8169 19.8169C20.061 19.5728 20.061 19.1771 19.8169 18.9331ZM9.26983 17.2897C4.84765 17.2897 1.25 13.692 1.25 9.26983C1.25 4.84765 4.84765 1.25 9.26983 1.25C13.692 1.25 17.2897 4.84769 17.2897 9.26983C17.2897 13.692 13.692 17.2897 9.26983 17.2897Z"></path>
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        <?endforeach;?>
                    </div>
                  </div>
                  <div class="gallery__navigation">
                    <div class="gallery__pagination">
                      <!-- begin .bullet-pagination-->
                      <div class="bullet-pagination bullet-pagination_role_gallery">
                      </div>
                      <!-- end .bullet-pagination-->
                    </div>
                  </div>
                </div>
                <!-- end .gallery-->
              </div>
            </div>
          </div>
          <!-- end .section-->
        </div>
      </div>
    <?endif;?>

    <?if(!empty($arResult["PROPERTIES"]["BOTTOM_BANNER"]["VALUE"])):?>
        <div class="page__section page__section_no_overflow">
            <div class="section section_space_close">
                <div class="section__content">
                    <div class="section__media-panel">
                        <?
                        $APPLICATION->IncludeComponent(
                            "bitrix:news.detail",
                            "wide_banner",
                            Array(
                                "IBLOCK_ID" => $arResult["PROPERTIES"]["BOTTOM_BANNER"]["LINK_IBLOCK_ID"],
                                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                "ADD_SECTIONS_CHAIN" => "N",
                                "ADD_ELEMENT_CHAIN" => "N",
                                "FIELD_CODE" => [
                                    "NAME",
                                    "PREVIEW_TEXT",
                                    "PREVIEW_PICTURE",
                                    "DETAIL_PICTURE",
                                ],
                                "PROPERTY_CODE" => [
                                    "BUTTON_NAME",
                                    "BUTTON_LINK",
                                    "BUTTON_DESC",
                                    "TITLE",
                                    "TIPPY_PRIMARY_NAME",
                                    "TIPPY_PRIMARY_DESC",
                                    "TIPPY_SECONDARY_NAME",
                                    "TIPPY_SECONDARY_DESC",
                                    "BANNER_TYPE"
                                ],
                                "ELEMENT_ID" => $arResult["PROPERTIES"]["BOTTOM_BANNER"]["VALUE"],
                                "BUTTON_SHOW" => !empty($arResult["PROPERTIES"]["WEB_FORM_ID"]["VALUE"]),
                                "BUTTON_LINK" => $downloadForm,
                                "BUTTON_TEXT" => "Скачать книгу бесплатно",
                                "DOWNLOAD_ICON" => true
                            ),
                            $component
                        );
                        ?>
                    </div>
                </div>
            </div>
        </div>
    <?endif;?>
<?endif;?>
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
<?if(!empty($arResult["PROPERTIES"]["WEB_FORM_ID"]["VALUE"])):?>
    <?
        $APPLICATION->IncludeComponent(
        "waim:feedback.form",
        "modal_secondary",
        array(
            "BACKGROUND_COLOR" => "#FFFFFF",
            "BUTTON_TEXT" => "Скачать бесплатно",
            "DESCRIPTION" => !empty($arResult["PROPERTIES"]["MODAL_FORM_DESCRIPTION"]["VALUE"]) ? $arResult["PROPERTIES"]["MODAL_FORM_DESCRIPTION"]["VALUE"] : "Оставьте заявку, мы вышлем книгу в формате PDF на указанный E-mail",
            "ERROR_DESCRIPTION" => "Попробуйте повторить отправку позднее",
            "ERROR_TITLE" => "Произошла ошибка :(",
            "FORM_TYPE" => "",
            "POLICY_LINK" => "/policy/",
            "POLICY_LINK_CLASS" => "",
            "POLICY_LINK_TEXT" => "политикой конфиденциальности",
            "POLICY_TEXT" => "Нажимая на кнопку, вы соглашаетесь с %s",
            "SUCCESS_DESCRIPTION" => !empty($arResult["PROPERTIES"]["MODAL_SUCCESS_DESCRIPTION"]["VALUE"]) ? $arResult["PROPERTIES"]["MODAL_SUCCESS_DESCRIPTION"]["VALUE"] : "Не спешите уходить, мы подготовили для вас много пользы",
            "SUCCESS_TITLE" => !empty($arResult["PROPERTIES"]["MODAL_SUCCESS_TITLE"]["VALUE"]) ? $arResult["PROPERTIES"]["MODAL_SUCCESS_TITLE"]["VALUE"] : "Мы отправили файл вам на почту",
            "SUCCESS_TITLE_HIGHLIGHT" => !empty($arResult["PROPERTIES"]["MODAL_SUCCESS_TITLE_HIGHLIGHT"]["VALUE"]) ? $arResult["PROPERTIES"]["MODAL_SUCCESS_TITLE_HIGHLIGHT"]["VALUE"] : "Спасибо!",
            "SUCCESS_BUTTON_TEXT" =>  !empty($arResult["PROPERTIES"]["MODAL_SUCCESS_BUTTON_TEXT"]["VALUE"]) ? $arResult["PROPERTIES"]["MODAL_SUCCESS_BUTTON_TEXT"]["VALUE"] : "Ко всем услугам",
            "SUCCESS_BUTTON_LINK" => !empty($arResult["PROPERTIES"]["MODAL_SUCCESS_BUTTON_LINK"]["VALUE"]) ? $arResult["PROPERTIES"]["MODAL_SUCCESS_BUTTON_LINK"]["VALUE"] : "/services/",
            "TITLE_HIGHLIGHT" => !empty($arResult["PROPERTIES"]["MODAL_FORM_TITLE_HIGHLIGHT"]["VALUE"]) ? $arResult["PROPERTIES"]["MODAL_FORM_TITLE_HIGHLIGHT"]["VALUE"] : "Скачать",
            "TITLE" => !empty($arResult["PROPERTIES"]["MODAL_FORM_TITLE"]["VALUE"]) ? $arResult["PROPERTIES"]["MODAL_FORM_TITLE"]["VALUE"] : "книгу ",
            "WEB_FORM_ID" => $arResult["PROPERTIES"]["WEB_FORM_ID"]["VALUE"],
            "MODAL_ID" => "modalDownload",
            "COMPONENT_TEMPLATE" => "modal",
            "FORM_TYPE" => $arResult["NAME"]
        ),
        false
    );?>
<?endif;?>