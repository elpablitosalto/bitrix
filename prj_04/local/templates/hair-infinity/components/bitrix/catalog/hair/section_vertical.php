<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;

/**
 * @global CMain $APPLICATION
 * @var CBitrixComponent $component
 * @var array $arParams
 * @var array $arResult
 * @var array $arCurSection
 */
if(empty($arCurSection) && Loader::includeModule("iblock")){
    \Bitrix\Iblock\Component\Tools::process404(
        trim($arParams["MESSAGE_404"]) ?: ""
        ,true
        ,$arParams["SET_STATUS_404"] === "Y"
        ,$arParams["SHOW_404"] === "Y"
        ,$arParams["FILE_404"]
    );
}

$obj = CIBlockSection::GetList(false,['IBLOCK_ID' => INFINITY_CATALOG_IB_ID, 'ACTIVE'=>'Y', 'CODE' => $arResult["VARIABLES"]["SECTION_CODE"]],false,['UF_*']);
if($res = $obj->GetNext())
{
    $arSection = $res;
}

$bannerCount = CIBlockElement::GetList(
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
?>
<?if($bannerCount > 0):?>
    <div class="page__intro">
        <!-- begin .image-carousel-->
        <?
        $GLOBALS["arSectionBannersFilter"] = [
            "PROPERTY_SECTION_ID" => $arCurSection["ID"]
        ];

        $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "sectionPageBanners.slider",
            array(
                "IBLOCK_TYPE" => "-",
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
                ),
                "CHECK_DATES" => "N",
                "STRICT_SECTION_CHECK" => "N",
                "IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
                "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
                "SEARCH_PAGE" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["search"],
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
        <!-- end .image-carousel-->
    </div>
<?endif;?>
<?if(!empty($arCurSection["UF_UTP_TITLE"]) || !empty($arCurSection["UF_UTP_DESC"]) || !empty($arCurSection["UF_UTP"])):?>
<div class="page__section">
    <!-- begin .section-->
    <div class="section section_style_filled section_role_product-features">
        <?if(!empty($arCurSection["UF_UTP_TITLE"]) || !empty($arCurSection["UF_UTP_DESC"])):?>
            <div class="section__header">
                <div class="section__container page__container">
                    <?if(!empty($arCurSection["UF_UTP_TITLE"])):?>
                        <div class="section__title">
                            <!-- begin .title-->
                            <h1 class="title title_size_h3 title_style_dependent"><?=$arCurSection["UF_UTP_TITLE"]?></h1>
                            <!-- end .title-->
                        </div>
                    <?endif;?>
                    <?if(!empty($arCurSection["UF_UTP_DESC"])):?>
                        <div class="section__text">
                            <?=htmlspecialchars_decode($arCurSection["UF_UTP_DESC"])?>
                        </div>
                    <?endif;?>
                </div>
            </div>
        <?endif;?>
        <?if(!empty($arCurSection["UF_UTP"])):?>
            <div class="section__content">
                <div class="page__container">
                    <div class="section__icon-panel-group">
                        <!-- begin .icon-panel-group-->
                        <?
                        $GLOBALS["arCatalogSectionFeatures"] = [
                            "ID" => $arCurSection["UF_UTP"]
                        ];
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
                                "FILTER_NAME" => "arCatalogSectionFeatures",
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
            </div>
        <?endif;?>
    </div>
    <!-- end .section-->
</div>
<?endif;?>
<div class="page__section">
    <!-- begin .section-->
    <div class="section section_role_category-products">
        <div class="section__header">
            <div class="section__container page__container">
                <div class="section__title">
                    <!-- begin .title-->
                    <h1 class="title title_size_h3 title_style_dependent">
                        <?if(!empty($arCurSection["UF_COLLECTION_TITLE"])):?>
                            <?=$arCurSection["UF_COLLECTION_TITLE"]?>
                        <?else:?>
                            Продукты линии <?=mb_strtolower($arCurSection["NAME"])?>
                        <?endif;?>
                    </h1>
                    <!-- end .title-->
                </div>
                <div class="section__text">
                    <?=htmlspecialchars_decode($arCurSection["DESCRIPTION"])?>
                </div>
                <?if(!empty($arSection['UF_HIDDEN_SEO_TEXT'])):?>
                    <div class="visually-hidden">
                        <?=htmlspecialchars_decode($arSection['UF_HIDDEN_SEO_TEXT'], ENT_QUOTES)?>
                    </div>
                <?endif;?>
            </div>
        </div>
        <div class="section__content">
            <div class="page__container">
                <div class="section__product-grid">
                    <!-- begin .product-grid-->
                    <div class="product-grid">
                        <?
                        $APPLICATION->IncludeComponent(
                            "bitrix:news.list",
                            "sectionPage.list",
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
                                "IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
                                "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                                "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
                                "SEARCH_PAGE" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["search"],
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
                    </div>
                    <!-- end .product-grid-->
                </div>
            </div>
        </div>
    </div>
    <!-- end .section-->
</div>
<div class="page__section">
    <!-- begin .section-->
    <?
    if(!empty($arCurSection['UF_VIDEOS'])) {
        $GLOBALS["arCatalogSectionFeatures"] = [
            "ID" => $arCurSection['UF_VIDEOS']
        ];
        $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "video.block",
            array(
                "IBLOCK_TYPE" => "-",
                "IBLOCK_ID" => VIDEO,
                "NEWS_COUNT" => 24,
                "SORT_BY1" => 'date_create',
                "SORT_ORDER1" => 'desc',
                "SORT_BY2" => $arParams["SORT_BY2"],
                "SORT_ORDER2" => $arParams["SORT_ORDER2"],
                "FILTER_NAME" => 'arCatalogSectionFeatures',
                "SET_TITLE" => "N",
                "SET_BROWSER_TITLE" => "N",
                "FIELD_CODE" => array(
                    0 => "ID",
                    1 => "CODE",
                    2 => "PREVIEW_PICTURE",
                    3 => "DETAIL_PICTURE",
                    4 => "NAME",
                ),
                "PROPERTY_CODE" => array(
                    0 => "",
                    1 => "VIDEO_PREVIEW",
                    2 => "VIDEO_LINK",
                    3 => "PRODUCT_COMPOSITION",
                    4 => "PRODUCT_TYPE",
                    5 => "",
                ),
            ),
            false
        );
    }
    ?>
    <!-- end .section-->
</div>
<div class="page__section">
    <!-- begin .section-->
    <?
    $rsRotSection = CIBlockSection::GetNavChain($arCurSection["IBLOCK_ID"], $arCurSection['ID']);
    if($arRootSection = $rsRotSection->Fetch()){
        $arSiblingFilter = array(
            '!ID' => $arCurSection['ID'],
            'IBLOCK_ID' => $arRootSection['IBLOCK_ID'],
            '>LEFT_MARGIN' => $arRootSection['LEFT_MARGIN'],
            '<RIGHT_MARGIN' => $arRootSection['RIGHT_MARGIN'],
            '>DEPTH_LEVEL' => $arRootSection['DEPTH_LEVEL']
        );
        $rsSiblingSections = CIBlockSection::GetList(array('left_margin' => 'asc'), $arSiblingFilter);
        while ($arSiblingSection = $rsSiblingSections->GetNext()){
            $GLOBALS["arCatalogSiblingsSections"]["ID"][] = $arSiblingSection["ID"];
        }
    }
    if(!empty($GLOBALS["arCatalogSiblingsSections"]["ID"])) {
        $APPLICATION->IncludeComponent(
            "bitrix:catalog.section.list",
            "siblings.sections",
            [
                "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                "ROOT_SECTION_NAME" => $arRootSection["NAME"],
                "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                "CACHE_TIME" => $arParams["CACHE_TIME"],
                "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                "COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
                "SECTION_USER_FIELDS" => [
                    "UF_MAIN_BLOCK_SMALL_DESC",
                ],
                "FILTER_NAME" => 'arCatalogSiblingsSections',
                "TOP_DEPTH" => 2,
                "SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
                "VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
                "SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
                "HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
                "ADD_SECTIONS_CHAIN" => (isset($arParams["ADD_SECTIONS_CHAIN"]) ? $arParams["ADD_SECTIONS_CHAIN"] : ''),
                "SECTION_TITLE_TEXT" => $arCurSection['UF_SIBLINGS_TITLE']
            ],
            $component,
            array("HIDE_ICONS" => "Y")
        );
    }
    ?>
    <!-- end .section-->
</div>
<?if(!empty($arCurSection['UF_BOTTOM_BANNER_PC'])):?>
    <div class="page__section">
        <!-- begin .section-->
        <div class="section section_role_banner">
            <div class="section__content">
                <div class="page__container">
                    <div class="section__banner">
                        <!-- begin .banner-->
                        <div class="banner">
                            <span class="banner__illustration">
                                <picture class="banner__picture">
                                    <?if(!empty($arCurSection['UF_BANNER_BOTTOM_MOB'])):?>
                                        <source
                                                srcset="<?=\CFile::GetPath($arCurSection['UF_BANNER_BOTTOM_MOB'])?>"
                                                type="image/jpeg"
                                                media="(max-width: 767px)"
                                        />
                                    <?endif;?>
                                    <img
                                            src="<?=\CFile::GetPath($arCurSection['UF_BOTTOM_BANNER_PC'])?>"
                                            alt="<?=$arCurSection["NAME"]?>"
                                            class="image-carousel__image"
                                            title=""
                                    />
                                </picture>
                            </span>
                        </div>
                        <!-- end .banner-->
                    </div>
                </div>
            </div>
        </div>
        <!-- end .section-->
    </div>
<?endif;?>
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
<?
// Цвет раздела
if(!empty($arCurSection['UF_COLOR'])) {
    $APPLICATION->IncludeComponent(
        "bitrix:main.include",
        "",
        Array(
            "AREA_FILE_SHOW" => "file",
            "PATH" => SITE_TEMPLATE_PATH."/include/catalog/recolor-styles.php",
            "AREA_FILE_RECURSIVE" => "N",
            "EDIT_MODE" => "html",
            "COLOR_ID" => $arCurSection['UF_COLOR'],
            "COLOR_CODE" => "",
            "CACHE_TYPE" => "N",
        ), false
    );
}

if($bannerCount > 0) {
    $GLOBALS['APPLICATION']->SetPageProperty("SECTION_PAGE_WITH_COLOR_CHANGE_PAGE_HEADER_CLASS", "page__header_position_absolute");
}

$GLOBALS['APPLICATION']->SetPageProperty("SECTION_PAGE_WITH_COLOR_CHANGE_HEADER_CLASS", "header_style_see-through");