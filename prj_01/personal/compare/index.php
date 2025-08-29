<?
define('PAGE_TYPE', 3);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Сравнение моделей");
$APPLICATION->SetPageProperty("PAGE_BODY_CLASS", 'dp-page-lk-price');
$APPLICATION->SetPageProperty("PAGE_SECTION_CLASS", 'lk lk-price');
$APPLICATION->SetPageProperty("PAGE_HEADER_CLASS", 'lk__title');

require($_SERVER["DOCUMENT_ROOT"] . "/personal/head.php");
?>

<? if (!($USER->IsAuthorized())) { ?>
    <?
    $APPLICATION->IncludeComponent(
        "bitrix:main.include",
        "",
        array(
            "AREA_FILE_SHOW" => "file",
            "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/personal/need_auth.php"
        )
    );
    ?>
<? } else { ?>
    <?
    $arResultFunc = CPersonal::isPartner();
    $isPartner = $arResultFunc['isPartner'];
    ?>
    <? if (!$isPartner) { ?>
        <?
        $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            array(
                "AREA_FILE_SHOW" => "file",
                "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/personal/need_auth_partner.php"
            )
        );
        ?>
    <? } else { ?>
        <div class="page-wrapper">
            <?
            $APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/personal/left.php"
                )
            );
            ?>
            <div class="page-body">
                <div class="page-body__wrapper">
                    <h1>Сравнение моделей</h1>
                    <?
                    //$GLOBALS['arrFilterCompare']['SECTION_GLOBAL_ACTIVE'] = 'Y';
                    //$GLOBALS['arrFilterCompare']['SECTION_SCOPE'] = 'IBLOCK';
                    ?>
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:news.list",
                        "price_lists",
                        array(
                            "DISPLAY_DATE" => "N",
                            "DISPLAY_NAME" => "Y",
                            "DISPLAY_PICTURE" => "Y",
                            "DISPLAY_PREVIEW_TEXT" => "Y",
                            "AJAX_MODE" => "N",
                            "IBLOCK_TYPE" => "content",
                            "IBLOCK_ID" => Indexis::getIblockId("compare_models", "content"),
                            "IBLOCK_CODE" => '',
                            "NEWS_COUNT" => "1000",
                            "SORT_BY2" => "SORT",
                            "SORT_ORDER2" => "ASC",
                            "SORT_BY1" => "SORT",
                            "SORT_ORDER1" => "ASC",
                            "FILTER_NAME" => 'arrFilterCompare',
                            "FIELD_CODE" => array('ID', 'NAME', 'ACTIVE_FROM', 'IBLOCK_SECTION_ID'),
                            "PROPERTY_CODE" => array('FILE'),
                            "CHECK_DATES" => "Y",
                            "DETAIL_URL" => "",
                            "PREVIEW_TRUNCATE_LEN" => "",
                            "ACTIVE_DATE_FORMAT" => "d.m.Y",
                            "SET_TITLE" => "N",
                            "SET_BROWSER_TITLE" => "Y",
                            "SET_META_KEYWORDS" => "Y",
                            "SET_META_DESCRIPTION" => "N",
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
                            "PAGER_TEMPLATE" => "show_more_clinical",
                            "PAGER_DESC_NUMBERING" => "N",
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            "PAGER_SHOW_ALL" => "N",
                            "PAGER_BASE_LINK_ENABLE" => "Y",
                            "SET_STATUS_404" => "N",
                            "SHOW_404" => "N",
                            "MESSAGE_404" => "",
                            "PAGER_BASE_LINK" => "",
                            "PAGER_PARAMS_NAME" => "arrPager",
                            "AJAX_OPTION_JUMP" => "N",
                            "AJAX_OPTION_STYLE" => "Y",
                            "AJAX_OPTION_HISTORY" => "N",
                            "AJAX_OPTION_ADDITIONAL" => "",

                            // Мои параметры -->
                            //'CUSTOM_SECTION_SORT' => $CUSTOM_SECTION_SORT,
                            // <-- Мои параметры 
                        )
                    ); ?>
                </div>
            </div>
        </div>
    <? } ?>
<? } ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>