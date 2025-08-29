<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Корпоративная поддержка — инвестиции в детей и будущее");
?>

    <div class="page-content become-partner-page">
        <section class="become-partner-first">
            <div class="container">
                <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "", array(),
                    false
                ); ?>
                <h1 class="page-title"><? $APPLICATION->ShowTitle(false) ?></h1>
                <div class="section__inner">
                    <div class="text-size-lg section__desc">
                        <?
                        $APPLICATION->IncludeComponent(
                            "bitrix:main.include", "",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/partners/desc.php"
                            )
                        ); ?>
                    </div>
                    <div class="section__nav">
                        <div class="buttons-line"><a href="#become_partner" class="btn">Стать партнёром</a></div>
                    </div>

                    <?
                    $APPLICATION->IncludeComponent(
                        "bitrix:main.include", "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/partners/top_image.php"
                        )
                    ); ?>

                </div>
            </div>
        </section>
        <section class="become-partner-how-to-help">
            <div class="container">
                <h3 class="section__title">Как вы можете помочь подопечным фонда</h3>
                <div class="section__inner">
                    <ol class="text-size-lg">
                        <?
                        $APPLICATION->IncludeComponent(
                            "bitrix:main.include", "",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/partners/how_to_help.php"
                            )
                        ); ?>
                    </ol>
                </div>
                <div class="section__nav">
                    <div class="buttons-line"><a href="/contacts/" class="btn">Связаться с фондом</a></div>
                </div>
            </div>
        </section>
        <section class="become-partner-invest">
            <div class="container">
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:main.include", "",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/partners/invest.php"
                    )
                ); ?>
            </div>
        </section>
        <section class="become-partner-partners">
            <div class="container">
                <div class="section__head-block">
                    <div class="row">
                        <div class="col-lg-6">
                            <h2 class="h3 section__title">Наши партнёры</h2>
                        </div>
                        <div class="col-lg-6">
                            <p class="text-size-lg section__desc">
                                <?
                                $APPLICATION->IncludeComponent(
                                    "bitrix:main.include", "",
                                    array(
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/partners/desc2.php"
                                    )
                                ); ?>
                            </p>
                            <div class="section__nav"><a href="#become_partner" class="btn">Стать партнёром</a></div>
                        </div>
                    </div>
                </div>
                <div class="main-partners__logos-block">
                    <div class="row align-items-height">
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:news.list",
                            "partnership_partner",
                            array(
                                "DISPLAY_DATE" => "Y",
                                "DISPLAY_NAME" => "Y",
                                "DISPLAY_PICTURE" => "Y",
                                "DISPLAY_PREVIEW_TEXT" => "Y",
                                "AJAX_MODE" => "N",
                                "IBLOCK_TYPE" => "content",
                                "IBLOCK_ID" => Indexis::getIblockId("partners", "content", "s1"),
                                "NEWS_COUNT" => "20",
                                "SORT_BY1" => "SORT",
                                "SORT_ORDER1" => "ASC",
                                "SORT_BY2" => "ACTIVE_FROM",
                                "SORT_ORDER2" => "DESC",
                                "FILTER_NAME" => "partnersFilter",
                                "FIELD_CODE" => array("PREVIEW_PICTURE"),
                                "PROPERTY_CODE" => array("LINK"),
                                "CHECK_DATES" => "Y",
                                "DETAIL_URL" => "",
                                "PREVIEW_TRUNCATE_LEN" => "",
                                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                                "SET_TITLE" => "N",
                                "SET_BROWSER_TITLE" => "N",
                                "SET_META_KEYWORDS" => "N",
                                "SET_META_DESCRIPTION" => "N",
                                "SET_LAST_MODIFIED" => "N",
                                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                "ADD_SECTIONS_CHAIN" => "N",
                                "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
                                "PARENT_SECTION" => "",
                                "PARENT_SECTION_CODE" => "",
                                "INCLUDE_SUBSECTIONS" => "Y",
                                "CACHE_TYPE" => "A",
                                "CACHE_TIME" => "360000",
                                "CACHE_FILTER" => "Y",
                                "CACHE_GROUPS" => "Y",
                                "DISPLAY_TOP_PAGER" => "N",
                                "DISPLAY_BOTTOM_PAGER" => "N",
                                "PAGER_TITLE" => "Новости",
                                "PAGER_SHOW_ALWAYS" => "N",
                                "PAGER_TEMPLATE" => "",
                                "PAGER_DESC_NUMBERING" => "Y",
                                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                "PAGER_SHOW_ALL" => "N",
                                "PAGER_BASE_LINK_ENABLE" => "Y",
                                "SET_STATUS_404" => "N",
                                "SHOW_404" => "N",
                                "MESSAGE_404" => "",
                                "PAGER_BASE_LINK" => "",
                                "PAGER_PARAMS_NAME" => "",
                                "AJAX_OPTION_JUMP" => "N",
                                "AJAX_OPTION_STYLE" => "Y",
                                "AJAX_OPTION_HISTORY" => "N",
                                "AJAX_OPTION_ADDITIONAL" => "",
                            )
                        ); ?>
                    </div>
                </div>
            </div>

            <? $APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "partnership_partner_reviews",
                array(
                    "DISPLAY_DATE" => "Y",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "AJAX_MODE" => "N",
                    "IBLOCK_TYPE" => "content",
                    "IBLOCK_ID" => Indexis::getIblockId("partners_reviews", "content", "s1"),
                    "NEWS_COUNT" => "20",
                    "SORT_BY1" => "SORT",
                    "SORT_ORDER1" => "ASC",
                    "SORT_BY2" => "ACTIVE_FROM",
                    "SORT_ORDER2" => "DESC",
                    "FILTER_NAME" => "partnersFilter",
                    "FIELD_CODE" => array("PREVIEW_PICTURE"),
                    "PROPERTY_CODE" => array("POSITION"),
                    "CHECK_DATES" => "Y",
                    "DETAIL_URL" => "",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "SET_TITLE" => "N",
                    "SET_BROWSER_TITLE" => "N",
                    "SET_META_KEYWORDS" => "N",
                    "SET_META_DESCRIPTION" => "N",
                    "SET_LAST_MODIFIED" => "N",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    "ADD_SECTIONS_CHAIN" => "N",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
                    "PARENT_SECTION" => "",
                    "PARENT_SECTION_CODE" => "",
                    "INCLUDE_SUBSECTIONS" => "Y",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "360000",
                    "CACHE_FILTER" => "Y",
                    "CACHE_GROUPS" => "Y",
                    "DISPLAY_TOP_PAGER" => "N",
                    "DISPLAY_BOTTOM_PAGER" => "N",
                    "PAGER_TITLE" => "Новости",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_TEMPLATE" => "",
                    "PAGER_DESC_NUMBERING" => "Y",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "PAGER_BASE_LINK_ENABLE" => "Y",
                    "SET_STATUS_404" => "N",
                    "SHOW_404" => "N",
                    "MESSAGE_404" => "",
                    "PAGER_BASE_LINK" => "",
                    "PAGER_PARAMS_NAME" => "",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_ADDITIONAL" => "",
                )
            ); ?>

        </section>

        <section class="become-partner-tax-incentives">
            <div class="container">
                <div class="section__inner">
                    <?
                    $APPLICATION->IncludeComponent(
                        "bitrix:main.include", "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/partners/nalog.php"
                        )
                    ); ?>
                    <div class="section__nav">
                        <a href="<?/*?>/tax_deduction/<?*/?>" data-modal="#modal-tax" class="text-color-yellow">
                            <u>Подробнее</u>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 class="icon icon-arrow">
                                <use xlink:href="#arrow"></use>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <?
        $APPLICATION->IncludeComponent(
            "bitrix:main.include", "",
            array(
                "AREA_FILE_SHOW" => "file",
                "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/common/tax_deduction_modal.php"
            )
        ); ?>        
        <section class="become-partner-call-us">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <h3 class="section__title">У вас есть вопросы?<br>Свяжитесь с&nbsp;нами</h3>
                    </div>
                    <div class="col-lg-6">
                        <div class="text-size-lg section__desc">
                            <?
                            $APPLICATION->IncludeComponent(
                                "bitrix:main.include", "",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/partners/contacts.php"
                                )
                            ); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="site-callback">
            <div class="container">

                <?$APPLICATION->IncludeComponent(
                    "indexis:ajax.form",
                    "become_partner_callback",
                    Array(
                        "IBLOCK_ID" => Indexis::getIblockId("partners_form", "requests", "s1"),
                        "IBLOCK_TYPE" => "requests",
                        "CHECK_CAPTCHA" => "Y",
                        "CREATE_LEAD" => "Стать партнёром",
                        "FIELDS" => [
                            "NAME" => ["CLEAR","NOT_EMPTY","TEXT"],
                            "PROPERTY_CITY" => ["CLEAR","NOT_EMPTY","TEXT"],
                            "PROPERTY_ORGANIZATION" => ["CLEAR","NOT_EMPTY","TEXT"],
                            "PROPERTY_PHONE" => ["CLEAR","NOT_EMPTY","PHONE"],
                            "PROPERTY_COOPERATION_OPTIONS" => ["NOT_EMPTY","LIST"],
                        ],
                        "SEND_MESSAGE" => "BECOME_PARTNER_CALLBACK",
                        "HANDLERS" => [
                            "AGREE" => [
                                "method_name" => "check_value",
                                "method_params" => [
                                    "VALUE" => "y",
                                    "TO" => "MAIN",
                                    "ERROR" => "Необходимо принять условия политики конфидициальности",
                                ]
                            ]
                        ],
                    )
                );?>
            </div>
        </section>
    </div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>