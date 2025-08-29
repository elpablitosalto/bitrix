<?
define('PAGE_TYPE', 4);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Оплата");
$APPLICATION->SetPageProperty("PAGE_SECTION_CLASS", 'payment');
?>

<section class="<? $APPLICATION->ShowProperty("PAGE_SECTION_CLASS"); ?>">
    <?
    $APPLICATION->IncludeComponent(
        "bitrix:breadcrumb",
        "stroyservis",
        array(
            "START_FROM" => "0",
            "PATH" => "",
            "SITE_ID" => SITE_ID
        )
    );
    ?>
    <div class="title-section">
        <h1><? $APPLICATION->ShowTitle(false); ?></h1>
    </div>

    <ul class="payment__list">
        <li class="payment__item"><a href="#entity">Для юридических лиц</a></li>
        <li class="payment__item"><a href="#individual">Для физических лиц</a></li>
    </ul>
    <div class="payment__type" id="entity">
        <?
        $APPLICATION->IncludeFile(
            SITE_DIR . 'include/payment/requisites_ul.php',
            array(),
            array('SHOW_BORDER' => true)
        );
        ?>
        <div class="requisites">
            <h2>Реквизиты</h2>
            <? $APPLICATION->IncludeComponent(
                "bitrix:news.detail",
                "requisites",
                array(
                    "DISPLAY_DATE" => "N",
                    "DISPLAY_NAME" => "N",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "N",
                    "USE_SHARE" => "N",
                    "SHARE_HIDE" => "Y",
                    "SHARE_TEMPLATE" => "",
                    "SHARE_HANDLERS" => array("delicious"),
                    "SHARE_SHORTEN_URL_LOGIN" => "",
                    "SHARE_SHORTEN_URL_KEY" => "",
                    "AJAX_MODE" => "N",
                    "IBLOCK_TYPE" => 'content',
                    "IBLOCK_ID" => Indexis::getIblockId('requisites', 'content'),
                    "ELEMENT_ID" => '',
                    "ELEMENT_CODE" => 'requisites',
                    "CHECK_DATES" => "Y",
                    "FIELD_CODE" => array("ID", 'NAME', 'DETAIL_PICTURE', 'DETAIL_TEXT'),
                    "PROPERTY_CODE" => array('FULL_NAME', 'SHORT_NAME', 'INN', 'KPP', 'OGRN', 'ADDRESS_REG', 'BANK_NAME', 'BIK', 'KS', 'RS', 'CEO', 'EMAIL', 'FILE'),
                    "IBLOCK_URL" => "news.php?ID=#IBLOCK_ID#\"",
                    "DETAIL_URL" => "",
                    "SET_TITLE" => "Y",
                    "SET_CANONICAL_URL" => "Y",
                    "SET_BROWSER_TITLE" => "Y",
                    "BROWSER_TITLE" => "-",
                    "SET_META_KEYWORDS" => "Y",
                    "META_KEYWORDS" => "-",
                    "SET_META_DESCRIPTION" => "Y",
                    "META_DESCRIPTION" => "-",
                    "SET_STATUS_404" => "N",
                    "SET_LAST_MODIFIED" => "N",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    "ADD_SECTIONS_CHAIN" => "N",
                    "ADD_ELEMENT_CHAIN" => "N",
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "USE_PERMISSIONS" => "N",
                    "GROUP_PERMISSIONS" => array("1"),
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "3600",
                    "CACHE_GROUPS" => "Y",
                    "DISPLAY_TOP_PAGER" => "N",
                    "DISPLAY_BOTTOM_PAGER" => "N",
                    "PAGER_TITLE" => "Страница",
                    "PAGER_TEMPLATE" => "",
                    "PAGER_SHOW_ALL" => "N",
                    "PAGER_BASE_LINK_ENABLE" => "Y",
                    "SHOW_404" => "N",
                    "MESSAGE_404" => "",
                    "STRICT_SECTION_CHECK" => "Y",
                    "PAGER_BASE_LINK" => "",
                    "PAGER_PARAMS_NAME" => "arrPager",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "AJAX_OPTION_HISTORY" => "N"
                )
            ); ?>
        </div>
    </div>

    <div class="payment__type" id="individual">
        <?
        $APPLICATION->IncludeFile(
            SITE_DIR . 'include/payment/requisites_fl.php',
            array(),
            array('SHOW_BORDER' => true)
        );
        ?>
    </div>
</section>

<?
$APPLICATION->IncludeFile(
    SITE_DIR . 'include/catalog/popular_sections.php',
    array(),
    array('SHOW_BORDER' => false)
);
?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>