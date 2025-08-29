<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
define('SHOW_TEMPLATE_BOTTOM_BANNER', 'N');

use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;

/**
 * @global CMain $APPLICATION
 * @var CBitrixComponent $component
 * @var array $arParams
 * @var array $arResult
 * @var array $arCurSection
 */
?>
<?
if ($obCache->InitCache(86400, md5(serialize($arResult['VARIABLES'])), "/iblock/catalog/collection/detail/")) {
    $arSection = $obCache->GetVars();
} elseif ($obCache->StartDataCache()) {
    $arSection = array();
    if (Loader::includeModule("iblock")) {
        // -->
        $obj = CIBlockSection::GetList(
            false,
            ['IBLOCK_ID' => INFINITY_CATALOG_EN_IB_ID, 'ACTIVE' => 'Y', 'CODE' => $arResult["VARIABLES"]["SECTION_CODE"]],
            false,
            ['UF_*']
        );
        if ($res = $obj->GetNext()) {
            $arSection = $res;
        }
        // <--

        // -->
        $arSection['bannerCount'] = CIBlockElement::GetList(
            [],
            array(
                "IBLOCK_ID" => INFINITY_CATALOG_BANNERS_IB_ID,
                "SECTION_ID" => $arCurSection["ID"],
                "ACTIVE" => "Y"
            ),
            false,
            false,
            array("ID")
        )->AffectedRowsCount();
        // <--

        // Цветовая палитра -->
        if (!empty($arSection['UF_BOTTOM_BANNER_PC_M'])) {
            foreach ($arSection['UF_BOTTOM_BANNER_PC_M'] as $img) {
                if (is_array($img)) {
                    $arFile = $img;
                } else {
                    $arFile = CFile::GetFileArray($img);
                }
                $arResultLocal = getImageFormatted(array(
                    'RESIZE' => 'Y',
                    'FILE_VALUE' => $arFile,
                    'WIDTH' => 1440,
                    'HEIGHT' => 9999,
                    'DEFAULT_ALT_TITLE' => $arSection['NAME']
                ));
                $arSection['PICTURE_COLOR_PALETTE_SLIDER'][] = $arResultLocal['PICTURE'];
            }
        }
        // <-- Цветовая палитра

        // Навигационная цепочка -->
        $list = \CIBlockSection::GetNavChain(false, $arSection['ID'], array(), true);
        foreach ($list as $arSectionPath) {
            $res_2 = CIBlockSection::GetByID($arSectionPath['ID']);
            if ($arChain = $res_2->GetNext()) {
                $arSection['CHAIN'][] = array(
                    'NAME' => $arChain['NAME'],
                    'SECTION_PAGE_URL' => $arChain['SECTION_PAGE_URL'],
                );
            }
        }
        // <-- 

        // Баннер -->
        //vardump($arSection);
        if (!empty($arSection['UF_BOTTOM_BANNER_PC'])) {
            if (is_array($arSection['UF_BOTTOM_BANNER_PC'])) {
                $arFile = $arSection['UF_BOTTOM_BANNER_PC'];
            } else {
                $arFile = CFile::GetFileArray($arSection['UF_BOTTOM_BANNER_PC']);
            }
            $arResultLocal = getImageFormatted(array(
                'RESIZE' => 'Y',
                'FILE_VALUE' => $arFile,
                'WIDTH' => 1440,
                'HEIGHT' => 5000,
                'DEFAULT_ALT_TITLE' => $arSection['NAME']
            ));
            $arSection['BOTTOM_BANNER_PC'] = $arResultLocal['PICTURE'];
        }

        if (!empty($arSection['UF_BANNER_BOTTOM_MOB'])) {
            if (is_array($arSection['UF_BANNER_BOTTOM_MOB'])) {
                $arFile = $arSection['UF_BANNER_BOTTOM_MOB'];
            } else {
                $arFile = CFile::GetFileArray($arSection['UF_BANNER_BOTTOM_MOB']);
            }
            $arResultLocal = getImageFormatted(array(
                'RESIZE' => 'Y',
                'FILE_VALUE' => $arFile,
                'WIDTH' => 1024,
                'HEIGHT' => 5000,
                'DEFAULT_ALT_TITLE' => $arSection['NAME']
            ));
            $arSection['BANNER_BOTTOM_MOB'] = $arResultLocal['PICTURE'];
        }
        // <-- 
    }
    $obCache->EndDataCache($arSection);
}
//vardump($arCurSection);
if (empty($arSection)) {
    //LocalRedirect("/404.php", "404 Not Found");
    $APPLICATION->RestartBuffer();
    include $_SERVER['DOCUMENT_ROOT'] . '/404.php';
} else {
    foreach ($arSection['CHAIN'] as $arChain) {
        $APPLICATION->AddChainItem($arChain['NAME'], $arChain['SECTION_PAGE_URL']);
    } ?>
    <?
    ob_start();
    ?>
    <?
    $GLOBALS["arSectionBannersFilter"] = [
        "PROPERTY_SECTION_ID" => $arCurSection["ID"]
    ];
    ?>
    <? $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "section_page_banners_slider",
        array(
            "IBLOCK_TYPE" => "banners_en",
            "IBLOCK_ID" => INFINITY_CATALOG_BANNERS_IB_ID,
            "NEWS_COUNT" => 20,
            "SORT_BY1" => "SORT",
            "SORT_ORDER1" => "ASC",
            "SORT_BY2" => $arParams["SORT_BY2"],
            "SORT_ORDER2" => $arParams["SORT_ORDER2"],
            "FILTER_NAME" => "arSectionBannersFilter",
            "FIELD_CODE" => array(
                0 => "ID",
                1 => "CODE",
                2 => "PREVIEW_PICTURE",
                3 => "DETAIL_PICTURE",
                4 => "",
            ),
            "PROPERTY_CODE" => array(
                0 => "",
                1 => "VIDEO_URL",
                2 => "VIDEO_FILE",
                3 => "ACTIVE_SUBSTANCE",
                4 => "PACK_VOLUME",
                5 => "FIXATION_STRENGTH",
            ),
            "CHECK_DATES" => "N",
            "STRICT_SECTION_CHECK" => "N",
            "IBLOCK_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["news"],
            "SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
            "DETAIL_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["element"],
            "SEARCH_PAGE" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["search"],
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => $arParams["CACHE_TIME"],
            "CACHE_FILTER" => "N",
            "CACHE_GROUPS" => "N",
            "PREVIEW_TRUNCATE_LEN" => $arParams["PREVIEW_TRUNCATE_LEN"],
            "ACTIVE_DATE_FORMAT" => $arParams["LIST_ACTIVE_DATE_FORMAT"],
            "SET_TITLE" => "Y",
            "SET_BROWSER_TITLE" => "Y",
            "SET_META_KEYWORDS" => "Y",
            "SET_META_DESCRIPTION" => "Y",
            "MESSAGE_404" => $arParams["MESSAGE_404"],
            "SET_STATUS_404" => "N",
            "SHOW_404" => "N",
            "FILE_404" => $arParams["FILE_404"],
            "SET_LAST_MODIFIED" => "N",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "ADD_SECTIONS_CHAIN" => "N",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "PARENT_SECTION" => $arResult["VARIABLES"]["SECTION_ID"],
            "PARENT_SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
            "INCLUDE_SUBSECTIONS" => "Y",
            "DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
            "DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
            "MEDIA_PROPERTY" => $arParams["MEDIA_PROPERTY"],
            "SLIDER_PROPERTY" => $arParams["SLIDER_PROPERTY"],
            "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
            "DISPLAY_TOP_PAGER" => "N",
            "DISPLAY_BOTTOM_PAGER" => "Y",
            "PAGER_TITLE" => $arParams["PAGER_TITLE"],
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
            "PAGER_SHOW_ALL" => "N",
            "PAGER_BASE_LINK_ENABLE" => "N",
            "PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
            "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
            "USE_RATING" => $arParams["USE_RATING"],
            "DISPLAY_AS_RATING" => $arParams["DISPLAY_AS_RATING"],
            "MAX_VOTE" => $arParams["MAX_VOTE"],
            "VOTE_NAMES" => $arParams["VOTE_NAMES"],
            "USE_SHARE" => $arParams["LIST_USE_SHARE"],
            "SHARE_HIDE" => $arParams["SHARE_HIDE"],
            "SHARE_TEMPLATE" => $arParams["SHARE_TEMPLATE"],
            "SHARE_HANDLERS" => $arParams["SHARE_HANDLERS"],
            "SHARE_SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
            "SHARE_SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
            "TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
            "COMPONENT_TEMPLATE" => "sectionPage.list",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_ADDITIONAL" => ""
        ),
        false
    );
    ?>

    <?
    $GLOBALS["arCatalogSectionFeatures"] = [
        "ID" => $arCurSection["UF_UTP"]
    ];
    ?>
    <? $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "section_page_features",
        array(
            "IBLOCK_ID" => INFINITY_MAIN_FEATURES_IB_ID,
            "IBLOCK_TYPE" => "content_en",
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
            "FIELD_CODE" => array(0 => "ID", 1 => "CODE", 2 => "PREVIEW_PICTURE", 3 => "DETAIL_PICTURE", 4 => "",),
            "FILTER_NAME" => "arCatalogSectionFeatures",
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
    ); ?>
    <?
    $out = ob_get_contents();
    ob_end_clean();
    $APPLICATION->AddViewContent('TOP_BIG_SLIDER', $out);
    ?>

    <?
    $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "collection_detail",
        array(
            "IBLOCK_TYPE" => "-",
            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
            "NEWS_COUNT" => 150,
            "SECTION_ID" => $arCurSection["ID"],
            "SORT_BY1" => $arParams["SORT_BY1"],
            "SORT_ORDER1" => $arParams["SORT_ORDER1"],
            "SORT_BY2" => $arParams["SORT_BY2"],
            "SORT_ORDER2" => $arParams["SORT_ORDER2"],
            "FILTER_NAME" => $arParams["FILTER_NAME"],
            "FIELD_CODE" => array(
                0 => "ID",
                1 => "CODE",
                2 => "PREVIEW_PICTURE",
                3 => "DETAIL_PICTURE",
                4 => "",
            ),
            "PROPERTY_CODE" => array(
                0 => "",
                1 => "PRODUCT_FEATURE",
                2 => "PRODUCT_PROPS",
                3 => "PRODUCT_COMPOSITION",
                4 => "PRODUCT_TYPE",
                5 => "",
            ),
            "CHECK_DATES" => "N",
            "STRICT_SECTION_CHECK" => "N",
            "IBLOCK_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["news"],
            "SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
            "DETAIL_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["element"],
            "SEARCH_PAGE" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["search"],
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => $arParams["CACHE_TIME"],
            "CACHE_FILTER" => "N",
            "CACHE_GROUPS" => "N",
            "PREVIEW_TRUNCATE_LEN" => $arParams["PREVIEW_TRUNCATE_LEN"],
            "ACTIVE_DATE_FORMAT" => $arParams["LIST_ACTIVE_DATE_FORMAT"],
            "SET_TITLE" => "Y",
            "SET_BROWSER_TITLE" => "Y",
            "SET_META_KEYWORDS" => "Y",
            "SET_META_DESCRIPTION" => "Y",
            "MESSAGE_404" => $arParams["MESSAGE_404"],
            "SET_STATUS_404" => "Y",
            "SHOW_404" => "Y",
            "FILE_404" => $arParams["FILE_404"],
            "SET_LAST_MODIFIED" => "N",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "ADD_SECTIONS_CHAIN" => "N",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "PARENT_SECTION" => $arResult["VARIABLES"]["SECTION_ID"],
            "PARENT_SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
            "INCLUDE_SUBSECTIONS" => "Y",
            "DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
            "DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
            "MEDIA_PROPERTY" => $arParams["MEDIA_PROPERTY"],
            "SLIDER_PROPERTY" => $arParams["SLIDER_PROPERTY"],
            "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
            "DISPLAY_TOP_PAGER" => "N",
            "DISPLAY_BOTTOM_PAGER" => "Y",
            "PAGER_TITLE" => $arParams["PAGER_TITLE"],
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
            "PAGER_SHOW_ALL" => "N",
            "PAGER_BASE_LINK_ENABLE" => "N",
            "PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
            "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
            "USE_RATING" => $arParams["USE_RATING"],
            "DISPLAY_AS_RATING" => $arParams["DISPLAY_AS_RATING"],
            "MAX_VOTE" => $arParams["MAX_VOTE"],
            "VOTE_NAMES" => $arParams["VOTE_NAMES"],
            "USE_SHARE" => $arParams["LIST_USE_SHARE"],
            "SHARE_HIDE" => $arParams["SHARE_HIDE"],
            "SHARE_TEMPLATE" => $arParams["SHARE_TEMPLATE"],
            "SHARE_HANDLERS" => $arParams["SHARE_HANDLERS"],
            "SHARE_SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
            "SHARE_SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
            "TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
            "COMPONENT_TEMPLATE" => "sectionPage.list",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_ADDITIONAL" => ""
        ),
        false
    );
    ?>
    <div class="page__detail-group">
        <div class="page__detail">
            <? if (!empty($arSection['PICTURE_COLOR_PALETTE_SLIDER'])) { ?>
                <div class="page__banner-carousel">
                    <div class="page__container page__container_gutter_none">
                        <!-- begin .banner-carousel-->
                        <div class="banner-carousel">
                            <div class="banner-carousel__container swiper js-banner-carousel">
                                <div class="banner-carousel__wrapper swiper-wrapper">
                                    <? foreach ($arSection['PICTURE_COLOR_PALETTE_SLIDER'] as $img) { ?>
                                        <div class="banner-carousel__slide swiper-slide">
                                            <!-- begin .banner-->
                                            <div class="banner banner_height_auto banner-carousel__banner">
                                                <picture class="banner__picture">
                                                    <img src="<?= $img['SRC']; ?>" alt="<?= $img["ALT"] ?>" title="<?= $img["TITLE"] ?>" class="banner__image" />
                                                </picture>
                                            </div>
                                            <!-- end .banner-->
                                        </div>
                                    <? } ?>
                                </div>
                                <div class="banner-carousel__carousel-nav">
                                    <!-- begin .carousel-nav-->
                                    <div class="carousel-nav js-carousel-nav" data-nav-scope=".banner-carousel" data-nav-target=".swiper">
                                        <div class="carousel-nav__control">
                                            <button class="carousel-nav__arrow carousel-nav__arrow_type_prev js-carousel-nav-prev" type="button" aria-label="Previous Slide">
                                                <svg class="carousel-nav__icon">
                                                    <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/mockup/dist/assets/images/icon.svg#icon_arrow-right"></use>
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="carousel-nav__control">
                                            <button class="carousel-nav__arrow carousel-nav__arrow_type_next js-carousel-nav-next" type="button" aria-label="Next Slide">
                                                <svg class="carousel-nav__icon">
                                                    <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/mockup/dist/assets/images/icon.svg#icon_arrow-right"></use>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- end .carousel-nav-->
                                </div>
                            </div>
                        </div>
                        <!-- end .banner-carousel-->
                    </div>
                </div>
            <? } ?>

            <?
            if (!empty($arSection['UF_RELATED_PRODUCTS'])) {
                global $arRelatedProductsFilter;
                $arRelatedProductsFilter['ID'] = $arSection['UF_RELATED_PRODUCTS']; ?>
                <? $APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "related_products",
                    array(
                        "IBLOCK_ID" => INFINITY_CATALOG_EN_IB_ID,
                        "IBLOCK_TYPE" => "catalog_en",
                        "COMPONENT_TEMPLATE" => "related_products",
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
                        "DISPLAY_DATE" => "Y",
                        "DISPLAY_NAME" => "Y",
                        "DISPLAY_PICTURE" => "Y",
                        "DISPLAY_PREVIEW_TEXT" => "Y",
                        "FIELD_CODE" => array(
                            0 => "ID",
                            1 => "CODE",
                            2 => "PREVIEW_PICTURE",
                            3 => "DETAIL_PICTURE",
                            4 => "",
                        ),
                        "FILTER_NAME" => "arRelatedProductsFilter",
                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                        "INCLUDE_SUBSECTIONS" => "Y",
                        "MESSAGE_404" => "",
                        "PAGER_BASE_LINK_ENABLE" => "N",
                        "PAGER_DESC_NUMBERING" => "N",
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                        "PAGER_SHOW_ALL" => "N",
                        "PAGER_SHOW_ALWAYS" => "N",
                        //"NEWS_COUNT" => "20",
                        //"PAGER_TEMPLATE" => ".default",
						"NEWS_COUNT" => 3,
						"PAGER_TEMPLATE" => "auto_load",
                        "PAGER_TITLE" => "Новости",
                        "DISPLAY_TOP_PAGER" => "N",
                        "DISPLAY_BOTTOM_PAGER" => "Y",
                        "PARENT_SECTION" => "",
                        "PARENT_SECTION_CODE" => "",
                        "PREVIEW_TRUNCATE_LEN" => "",
                        "PROPERTY_CODE" => array(
                            0 => "PRODUCT_FEATURE",
                            1 => "PRODUCT_PROPS",
                            2 => "PRODUCT_COMPOSITION",
                            3 => "PRODUCT_TYPE",
                            4 => "",
                        ),
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
                        "STRICT_SECTION_CHECK" => "N",
                    ),
                    false
                ); ?>
            <? } ?>

            <? if (!empty($arSection['UF_VIDEOS'])) { ?>
                <?
                global $videoFilter;
                $videoFilter['ID'] = $arSection['UF_VIDEOS'];
                //vardump($videoFilter);
                ?>
                <? $APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "video_block",
                    array(
                        "IBLOCK_ID" => VIDEO,
                        "IBLOCK_TYPE" => "materials_en",
                        "COMPONENT_TEMPLATE" => "video_block",
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
                        "FIELD_CODE" => array(
                            0 => "ID",
                            1 => "CODE",
                            2 => "PREVIEW_PICTURE",
                            3 => "DETAIL_PICTURE",
                            4 => "",
                        ),
                        "FILTER_NAME" => "videoFilter",
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
                        "PROPERTY_CODE" => array(
                            1 => "VIDEO_PREVIEW",
                            2 => "VIDEO_LINK",
                            3 => "PRODUCT_COMPOSITION",
                            4 => "PRODUCT_TYPE",
                            5 => "",
                        ),
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
                        "STRICT_SECTION_CHECK" => "N",
                    ),
                    false
                ); ?>
            <? } ?>

        </div>

    </div>

    <? if (!empty($arSection['BANNER_BOTTOM_MOB']) || !empty($arSection['BOTTOM_BANNER_PC'])) { ?>
        <div class="page__banner">
            <div class="page__container">
                <!-- begin .banner-->
                <div class="banner">
                    <picture class="banner__picture">
                        <? if (!empty($arSection['BANNER_BOTTOM_MOB'])) { ?>
                            <source srcset="<?= $arSection['BANNER_BOTTOM_MOB']['SRC']; ?>" type="image/png" media="(max-width: 1024px)" class="banner__source" />
                        <? } ?>
                        <? if (!empty($arSection['BOTTOM_BANNER_PC'])) { ?>
                            <img src="<?= $arSection['BOTTOM_BANNER_PC']['SRC']; ?>" alt="<?= $arSection['BOTTOM_BANNER_PC']["ALT"] ?>" title="<?= $arSection['BOTTOM_BANNER_PC']["TITLE"] ?>" class="banner__image" />
                        <? } ?>
                    </picture>
                </div>
                <!-- end .banner-->
            </div>
        </div>
    <? } ?>

    <?
    if (!empty($arSection['UF_COLOR'])) {
        $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            array(
                "AREA_FILE_SHOW" => "file",
                "PATH" => SITE_DIR . "/include/catalog/recolor-styles.php",
                "AREA_FILE_RECURSIVE" => "N",
                "EDIT_MODE" => "html",
                "COLOR_ID" => $arSection['UF_COLOR'],
                "COLOR_CODE" => "",
                "CACHE_TYPE" => "N",
            ),
            false
        );
    }
    ?>
<? } ?>