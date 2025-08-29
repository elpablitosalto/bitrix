<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
?>
<section class="nb-top-banner-section nb-top-banner-section-promotions nb-top-banner-main<?if ($arParams['HIDE_TOP_BANNER_ON_MOBILE'] == "Y"):?> nb-top-banner-section_hide-mobile<?endif;?>" id="<?= $arParams['BLOCK_AREA_ID'] ?>">
    <? $APPLICATION->IncludeComponent(
        "bitrix:breadcrumb",
        "",
        array(
            "START_FROM" => "0",
            "PATH" => "",
            "SITE_ID" => SITE_ID
        )
    ); ?>

    <?
    $APPLICATION->IncludeComponent(
        "bitrix:news.detail",
        "promo",
        array(
            "DISPLAY_DATE" => "Y",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "USE_SHARE" => "N",
            "SHARE_HIDE" => "N",
            "SHARE_TEMPLATE" => "",
            "SHARE_HANDLERS" => array("delicious"),
            "SHARE_SHORTEN_URL_LOGIN" => "",
            "SHARE_SHORTEN_URL_KEY" => "",
            "AJAX_MODE" => "N",
            "IBLOCK_TYPE" => "services",
            "IBLOCK_ID" => Indexis::getIblockId("promotions"),
            "ELEMENT_ID" => "",
            "ELEMENT_CODE" => $arParams['PROMO_CODE'],
            "CHECK_DATES" => "Y",
            "FIELD_CODE" => array(
                "ID", "NAME", "ACTIVE_TO", "PREVIEW_TEXT", "PREVIEW_TEXT_TYPE"
            ),
            "PROPERTY_CODE" => array(
                "NAME_PART_2"
            ),
            "IBLOCK_URL" => "/promos/",
            "DETAIL_URL" => "",
            "SET_TITLE" => "Y",
            "SET_CANONICAL_URL" => "Y",
            "SET_BROWSER_TITLE" => "Y",
            "BROWSER_TITLE" => "-",
            "SET_META_KEYWORDS" => "Y",
            "META_KEYWORDS" => "-",
            "SET_META_DESCRIPTION" => "Y",
            "META_DESCRIPTION" => "-",
            "SET_STATUS_404" => "Y",
            "SET_LAST_MODIFIED" => "Y",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "ADD_SECTIONS_CHAIN" => "N",
            "ADD_ELEMENT_CHAIN" => "N"/*($arParams['HIDE_TOP_BANNER_ON_MOBILE'] == "Y" ? "N" : "Y")*/,
            "ACTIVE_DATE_FORMAT" => "d.m.Y",
            "USE_PERMISSIONS" => "N",
            "GROUP_PERMISSIONS" => array("1"),
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "3600",
            "CACHE_GROUPS" => "Y",
            "DISPLAY_TOP_PAGER" => "Y",
            "DISPLAY_BOTTOM_PAGER" => "Y",
            "PAGER_TITLE" => "Акция",
            "PAGER_TEMPLATE" => "",
            "PAGER_SHOW_ALL" => "Y",
            "PAGER_BASE_LINK_ENABLE" => "Y",
            "SHOW_404" => "Y",
            "MESSAGE_404" => "",
            "STRICT_SECTION_CHECK" => "Y",
            "PAGER_BASE_LINK" => "",
            "PAGER_PARAMS_NAME" => "arrPager",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "AJAX_OPTION_HISTORY" => "N",
            'BLOCK_AREA_ID' => $arParams['BLOCK_AREA_ID'],
            'EDIT_AREA_ID' => $arParams['EDIT_AREA_ID'],
            'HIDE_TOP_BANNER_ON_MOBILE' => $arParams['HIDE_TOP_BANNER_ON_MOBILE']
        )
    );
    ?>
</section>