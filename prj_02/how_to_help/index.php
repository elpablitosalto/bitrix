<?

use \Bitrix\Main\Page\Asset;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Как вы можете помочь");
Asset::getInstance()->addString('<script data-skip-moving="true" src="https://widget.cloudpayments.ru/bundles/cloudpayments.js"></script>');
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/how-help.js");
CJSCore::Init(array('clipboard'));
?>

<div class="page-head">
    <div class="container">
        <? $APPLICATION->IncludeComponent(
            "bitrix:breadcrumb",
            "",
            array(),
            false
        ); ?>
        <h1 class="page-title"><? $APPLICATION->ShowTitle(false) ?></h1>
    </div>
</div>
<div class="page-content how-help-page">
    <section class="pay">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="how-help__title">Сделать пожертвование</h3>
                    <div class="pay__tabs">
                        <div class="pay__item pay__card pay__active">Банковской картой</div>
                        <div class="pay__item pay__sbp">
                            <picture><img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= SITE_TEMPLATE_PATH ?>/images/sbp.png" loading="lazy" alt="" title="" />
                            </picture>
                            <span>СБП (QR-код)</span>
                        </div>
                        <div class="pay__item pay__bank">На счёт в банке</div>
                    </div>
                    <div class="pay__content">
                        <div class="pay-card active">
                            <? $APPLICATION->IncludeComponent(
                                "indexis:ajax.form",
                                "cloudpayments_pay_form",
                                array(
                                    "IBLOCK_ID" => Indexis::getIblockId("pay_form", "requests", "s1"),
                                    "IBLOCK_TYPE" => "requests",
                                    "FIELDS" => [
                                        "NAME" => ["CLEAR", "NOT_EMPTY"],
                                        "PREVIEW_TEXT" => ["CLEAR"],
                                        //"PROPERTY_PHONE" => ["CLEAR", "NOT_EMPTY", "PHONE"],
                                        //"PROPERTY_EMAIL" => ["CLEAR", "NOT_EMPTY", "EMAIL"],
                                        "PROPERTY_CATEGORY" => ["NOT_EMPTY", "LIST"],
                                        "PROPERTY_TYPE" => ["NOT_EMPTY", "LIST"],
                                        "PROPERTY_SUM" => ["CLEAR", "NOT_EMPTY", "NUMBER"],
                                    ],
                                    "CHECK_CAPTCHA" => "Y",
                                    "RETURN_FIELDS" => ["NAME", /*"PROPERTY_PHONE", "PROPERTY_EMAIL",*/ "PROPERTY_TYPE", "PROPERTY_CATEGORY", "PROPERTY_SUM"],
                                    "HANDLERS" => [
                                        "ACTIVE" => "N",
                                        "AGREEMENT" => [
                                            "method_name" => "check_value",
                                            "method_params" => [
                                                "VALUE" => "y",
                                                "TO" => "MAIN",
                                                "ERROR" => "Необходимо принять условия политики конфидициальности",
                                            ]
                                        ]
                                    ],
                                )
                            ); ?>
                            <div class="image">
                                <picture><img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= SITE_TEMPLATE_PATH ?>/images/сharity-box.svg" loading="lazy" alt="сharity-box" title="сharity-box" />
                                </picture>
                            </div>
                        </div>
                        <div class="row pay-sbp">
                            <div class="col-sm-7 wrapper">
                                <?
                                $APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    array(
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/how_to_help/qr.php",
                                    )
                                ); ?>
                            </div>
                            <div class="col-sm-4 image">
                                <div class="col-sm-7 wrapper">
                                    <?
                                    $APPLICATION->IncludeComponent(
                                        "bitrix:main.include",
                                        "",
                                        array(
                                            "AREA_FILE_SHOW" => "file",
                                            "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/how_to_help/qr_image.php",
                                        )
                                    ); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row pay-bank">
                            <div class="col-sm-8">
                                <?
                                $APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    array(
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/how_to_help/requsites_desc.php",
                                    )
                                ); ?>
                            </div>
                            <div class="col-sm-12 col-md-9">
                                <div class="table-header">
                                    <div class="title">Реквизиты</div>

                                    <?
                                    $APPLICATION->IncludeComponent(
                                        "bitrix:main.include",
                                        "",
                                        array(
                                            "AREA_FILE_SHOW" => "file",
                                            "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/how_to_help/requsites_file.php",
                                        )
                                    ); ?>
                                </div>

                                <?
                                $helpFilter = [
                                    "!PROPERTY_CATEGORY" => false
                                ];
                                ?>
                                <?
                                $APPLICATION->IncludeComponent(
                                    "bitrix:news.list",
                                    "how_to_help_requisites",
                                    array(
                                        "ACTIVE_DATE_FORMAT" => "x",
                                        "ADD_SECTIONS_CHAIN" => "N",
                                        "AJAX_MODE" => "N",
                                        "AJAX_OPTION_ADDITIONAL" => "",
                                        "AJAX_OPTION_HISTORY" => "N",
                                        "AJAX_OPTION_JUMP" => "N",
                                        "AJAX_OPTION_STYLE" => "N",
                                        "CACHE_FILTER" => "Y",
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
                                        "FIELD_CODE" => array("PREVIEW_TEXT", ""),
                                        "FILTER_NAME" => "helpFilter",
                                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                        "IBLOCK_ID" => Indexis::getIblockId("requisites_donations", "content", "s1"),
                                        "IBLOCK_TYPE" => "requests",
                                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                        "INCLUDE_SUBSECTIONS" => "Y",
                                        "MESSAGE_404" => "",
                                        "NEWS_COUNT" => "90",
                                        "PAGER_BASE_LINK_ENABLE" => "Y",
                                        "PAGER_DESC_NUMBERING" => "N",
                                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                        "PAGER_SHOW_ALL" => "Y",
                                        "PAGER_SHOW_ALWAYS" => "N",
                                        "PAGER_TEMPLATE" => "",
                                        "PAGER_TITLE" => "",
                                        "PARENT_SECTION" => "",
                                        "PARENT_SECTION_CODE" => "",
                                        "PREVIEW_TRUNCATE_LEN" => "",
                                        "PROPERTY_CODE" => array(""),
                                        "SET_BROWSER_TITLE" => "N",
                                        "SET_LAST_MODIFIED" => "N",
                                        "SET_META_DESCRIPTION" => "N",
                                        "SET_META_KEYWORDS" => "N",
                                        "SET_STATUS_404" => "N",
                                        "SET_TITLE" => "N",
                                        "SHOW_404" => "N",
                                        "SORT_BY1" => "SORT",
                                        "SORT_BY2" => "ID",
                                        "SORT_ORDER1" => "ASC",
                                        "SORT_ORDER2" => "DESC",
                                        "STRICT_SECTION_CHECK" => "N"
                                    )
                                ); ?>

                                <?
                                $APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    array(
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/how_to_help/requsites_desc_bottom.php",
                                    )
                                ); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?
    $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "how_to_help_payers",
        array(
            "ACTIVE_DATE_FORMAT" => "x",
            "ADD_SECTIONS_CHAIN" => "N",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "N",
            "CACHE_FILTER" => "Y",
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
            "FIELD_CODE" => array("PREVIEW_TEXT", ""),
            "FILTER_NAME" => "",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "IBLOCK_ID" => Indexis::getIblockId("pay_form", "requests", "s1"),
            "IBLOCK_TYPE" => "requests",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "INCLUDE_SUBSECTIONS" => "Y",
            "MESSAGE_404" => "",
            "NEWS_COUNT" => "20",
            "PAGER_BASE_LINK_ENABLE" => "Y",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "Y",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_TEMPLATE" => "",
            "PAGER_TITLE" => "",
            "PARENT_SECTION" => "",
            "PARENT_SECTION_CODE" => "",
            "PREVIEW_TRUNCATE_LEN" => "",
            "PROPERTY_CODE" => array("SUM"),
            "SET_BROWSER_TITLE" => "N",
            "SET_LAST_MODIFIED" => "N",
            "SET_META_DESCRIPTION" => "N",
            "SET_META_KEYWORDS" => "N",
            "SET_STATUS_404" => "N",
            "SET_TITLE" => "N",
            "SHOW_404" => "N",
            "SORT_BY1" => "ACTIVE_FROM",
            "SORT_BY2" => "ID",
            "SORT_ORDER1" => "DESC",
            "SORT_ORDER2" => "DESC",
            "STRICT_SECTION_CHECK" => "N"
        )
    ); ?>


    <?
    $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "how_to_help_ways",
        array(
            "ACTIVE_DATE_FORMAT" => "x",
            "ADD_SECTIONS_CHAIN" => "N",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "N",
            "CACHE_FILTER" => "Y",
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
            "FIELD_CODE" => array("PREVIEW_TEXT", ""),
            "FILTER_NAME" => "",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "IBLOCK_ID" => Indexis::getIblockId("ways_to_help", "content", "s1"),
            "IBLOCK_TYPE" => "requests",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "INCLUDE_SUBSECTIONS" => "Y",
            "MESSAGE_404" => "",
            "NEWS_COUNT" => "90",
            "PAGER_BASE_LINK_ENABLE" => "Y",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "Y",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_TEMPLATE" => "",
            "PAGER_TITLE" => "",
            "PARENT_SECTION" => "",
            "PARENT_SECTION_CODE" => "",
            "PREVIEW_TRUNCATE_LEN" => "",
            "PROPERTY_CODE" => array("LINK"),
            "SET_BROWSER_TITLE" => "N",
            "SET_LAST_MODIFIED" => "N",
            "SET_META_DESCRIPTION" => "N",
            "SET_META_KEYWORDS" => "N",
            "SET_STATUS_404" => "N",
            "SET_TITLE" => "N",
            "SHOW_404" => "N",
            "SORT_BY1" => "SORT",
            "SORT_BY2" => "ID",
            "SORT_ORDER1" => "ASC",
            "SORT_ORDER2" => "DESC",
            "STRICT_SECTION_CHECK" => "N"
        )
    ); ?>

    <?
    $APPLICATION->IncludeComponent(
        "bitrix:main.include",
        "",
        array(
            "AREA_FILE_SHOW" => "file",
            "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/common/tax_deduction_modal.php"
        )
    ); ?>

    <?
    $APPLICATION->IncludeComponent(
        "bitrix:main.include",
        "",
        array(
            "AREA_FILE_SHOW" => "file",
            "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/common/security_guarantees_modal.php"
        )
    ); ?>


    <?
    $APPLICATION->IncludeComponent(
        "bitrix:main.include",
        "",
        array(
            "AREA_FILE_SHOW" => "file",
            "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/common/information_dissemination.php"
        )
    ); ?>

</div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>