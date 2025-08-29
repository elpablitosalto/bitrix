<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords", "Каталог реагентов");
$APPLICATION->SetPageProperty("description", "Каталог реагентов");
$APPLICATION->SetTitle("Каталог реагентов");
CModule::IncludeModule('iblock');
?>
<?
$IBLOCK_CODE = $_GET['IBLOCK_CODE'];
if (strlen($IBLOCK_CODE) <= 0) {
    $IBLOCK_CODE = 'hematology';
    $headElementCode = 'hematology';
}
$IBLOCK_ID = Indexis::getIblockId($IBLOCK_CODE, "reagents", SITE_ID);
$template = '';
$CUSTOM_SECTION_SORT = array("LEFT_MARGIN" => "ASC", 'NAME' => 'ASC');
$arClasses = array(
    'hematology' => 'link-button_grey',
    'biochemistry' => 'link-button_grey',
    'analysis' => 'link-button_grey',
    'veterinary' => 'link-button_grey',
);
$bookmarks_table = '';
switch ($IBLOCK_CODE) {
    case 'hematology':
        $template = 'hematology';
        $PROPERTY_CODE = $GLOBALS['arSiteConfig']['PROPERTY_CODE']['hematology'];
        $arClasses['hematology'] = 'link-button_rose';
        $bookmarks_table = 'bookmarks-urine';
        $headElementCode = 'hematology';
        break;
    case 'biochemistry':
        $template = 'biochemistry';
        $PROPERTY_CODE = $GLOBALS['arSiteConfig']['PROPERTY_CODE']['biochemistry'];
        $arClasses['biochemistry'] = 'link-button_rose';
        $headElementCode = 'biochemistry';
        break;
    case 'analysis':
        $template = 'analysis';
        $PROPERTY_CODE = $GLOBALS['arSiteConfig']['PROPERTY_CODE']['analysis'];
        $arClasses['analysis'] = 'link-button_rose';
        $bookmarks_table = 'bookmarks-urine';
        $headElementCode = 'analysis';
        break;
    case 'veterinary':
        $template = 'veterinary';
        $PROPERTY_CODE = $GLOBALS['arSiteConfig']['PROPERTY_CODE']['veterinary'];
        $arClasses['veterinary'] = 'link-button_rose';
        $headElementCode = 'veterinary';
        break;
}
//vardump($PROPERTY_CODE);
//echo 'template = '.$template.'<br />';
?>
<? if (intval($IBLOCK_ID) > 0 && strlen($template) > 0) { ?>
    <section class="header-top-banner">
        <? if (strlen($headElementCode) > 0) { ?>
            <?
            $GLOBALS['arrFilterReagentsHead']['CODE'] = $headElementCode;
            ?>
            <? $APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "reagents_head",
                array(
                    "DISPLAY_DATE" => "Y",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "AJAX_MODE" => "N",
                    "IBLOCK_TYPE" => "content",
                    "IBLOCK_ID" => Indexis::getIblockId("content", "reagents", "s1"),
                    "NEWS_COUNT" => "1",
                    "SORT_BY1" => "SORT",
                    "SORT_ORDER1" => "ASC",
                    "SORT_BY2" => "ACTIVE_FROM",
                    "SORT_ORDER2" => "DESC",
                    "FILTER_NAME" => "arrFilterReagentsHead",
                    "FIELD_CODE" => array("PREVIEW_PICTURE"),
                    "PROPERTY_CODE" => array("HEADER", 'VIDEO'),
                    "CHECK_DATES" => "Y",
                    "DETAIL_URL" => "",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "ACTIVE_DATE_FORMAT" => "d F Y",
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

        <? } ?>
        <ul class="header-top-banner__list">
            <?
            $res = CIBlock::GetList(
                array('sort' => 'asc'),
                array(
                    'TYPE' => 'reagents',
                    'SITE_ID' => SITE_ID,
                    'ACTIVE' => 'Y',
                    "CNT_ACTIVE" => "Y",
                    'CODE' => array('hematology', 'biochemistry', 'analysis', 'veterinary'),
                ),
                true
            );
            while ($ar_res = $res->Fetch()) {
                //$ar_res['LIST_PAGE_URL'] = str_replace('#SITE_DIR#', SITE_DIR, $ar_res['LIST_PAGE_URL']);
            ?>
                <li class="header-top-banner__item">
                    <a class="<?= $arClasses[$ar_res['CODE']]; ?>" href="<?= $ar_res['LIST_PAGE_URL']; ?>"><?= $ar_res['NAME']; ?><? if (intval($ar_res['ELEMENT_CNT']) > 0) { ?><span>(<?= $ar_res['ELEMENT_CNT']; ?>)</span><? } ?></a>
                </li>
            <?
            }
            ?>
        </ul>
    </section>

    <section class="bookmarks-table <?= $bookmarks_table; ?>">
        <div class="page-wrapper">
            <div class="page-menu">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:catalog.section.list",
                    "reagents_sections",
                    array(
                        "ADDITIONAL_COUNT_ELEMENTS_FILTER" => "additionalCountFilter",
                        "VIEW_MODE" => "TEXT",
                        "SHOW_PARENT_NAME" => "Y",
                        "IBLOCK_TYPE" => "reagents",
                        "IBLOCK_ID" => $IBLOCK_ID,
                        "SECTION_ID" => "",
                        "SECTION_CODE" => "",
                        "SECTION_URL" => "",
                        "COUNT_ELEMENTS" => "N",
                        "COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
                        "HIDE_SECTIONS_WITH_ZERO_COUNT_ELEMENTS" => "Y",
                        "TOP_DEPTH" => "1",
                        "SECTION_FIELDS" => "",
                        "SECTION_USER_FIELDS" => "",
                        "ADD_SECTIONS_CHAIN" => "N",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "36000000",
                        "CACHE_NOTES" => "",
                        "CACHE_GROUPS" => "Y",
                        'CUSTOM_SECTION_SORT' => $CUSTOM_SECTION_SORT,
                    )
                ); ?>
                <?/*?>
                <ul class="page-menu__list">
                    <li class="page-menu__item"><a class="page-menu__link" href="#reagents-bf6800">Реагенты для BF-6800</a></li>
                    <li class="page-menu__item"><a class="page-menu__link" href="#reagents-bf6801">Реагенты для BF-6800</a></li>
                    <li class="page-menu__item"><a class="page-menu__link" href="#reagents-bf6802">Реагенты для BF-6800</a></li>
                </ul>
                <?*/ ?>
                <a class="link-button_rose link-button_rose__inline" href="#callback">Связаться с нами</a>
            </div>
            <div class="page-body">
                <div class="page-body__wrapper">
                    <?
                    $bShowComponent = true;
                    ?>
                    <? if (mb_strlen($_GET["q"]) > 0) { ?>
                        <?
                        $arSearchParams = array(
                            '~FILTER_NAME' => 'arrFilterReagents',
                            'CHECK_DATES' => 'N',
                            'IBLOCK_TYPE' => 'reagents',
                            'CACHE_TYPE' => 'N',
                            'CACHE_TIME' => '3600',
                            'SET_TITLE' => 'N',
                            'IBLOCK_ID' => $IBLOCK_ID,
                        );
                        $arSearchParamsComponent = array(
                            "CHECK_DATES" => $arSearchParams["CHECK_DATES"] !== "N" ? "Y" : "N",
                            "arrWHERE" => array("iblock_" . $arSearchParams["IBLOCK_TYPE"]),
                            "arrFILTER" => array("iblock_" . $arSearchParams["IBLOCK_TYPE"]),
                            "SHOW_WHERE" => "N",
                            "CACHE_TYPE" => $arSearchParams["CACHE_TYPE"],
                            "CACHE_TIME" => $arSearchParams["CACHE_TIME"],
                            "SET_TITLE" => $arSearchParams["SET_TITLE"],
                            "arrFILTER_iblock_" . $arSearchParams["IBLOCK_TYPE"] => array($arSearchParams["IBLOCK_ID"]),
                            "PAGE" => $_SERVER['REQUEST_URI'],
                            'USE_TITLE_RANK' => 'Y',
                            'PAGE_RESULT_COUNT' => 5000,
                            'USE_LANGUAGE_GUESS' => 'N',
                            'NO_WORD_LOGIC' => 'Y',
                            'RESTART' => 'Y',
                        );
                        $GLOBALS[$arSearchParams["~FILTER_NAME"]]["=ID"] = $APPLICATION->IncludeComponent(
                            "bitrix:search.page",
                            "reagents",
                            $arSearchParamsComponent,
                            $component
                        );
                        //vardump($arSearchParamsComponent);
                        //vardump($GLOBALS[$arSearchParams["~FILTER_NAME"]]);
                        if (empty($GLOBALS[$arSearchParams["~FILTER_NAME"]]["=ID"])) {
                            $bShowComponent = false;
                        }
                        ?>
                    <? } else { ?>

                    <? } ?>
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:search.form",
                        "reagents",
                        array(
                            //"PAGE" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["search"],
                            //"PAGE" => $arResult["FOLDER"],
                            "PAGE" => $_SERVER['REQUEST_URI'],
                        ),
                        $component
                    ); ?>

                    <?
                    //echo 'template = '.$template.'<br />';
                    //vardump($GLOBALS[$arSearchParams["~FILTER_NAME"]]);
                    ?>
                    <? if ($bShowComponent == false) { ?>
                        <? ShowError('Ничего не найдено'); ?>
                    <? } else { ?>
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:news.list",
                            $template,
                            array(
                                "DISPLAY_DATE" => "N",
                                "DISPLAY_NAME" => "Y",
                                "DISPLAY_PICTURE" => "Y",
                                "DISPLAY_PREVIEW_TEXT" => "Y",
                                "AJAX_MODE" => "N",
                                "IBLOCK_TYPE" => "reagents",
                                "IBLOCK_ID" => $IBLOCK_ID,
                                "IBLOCK_CODE" => $IBLOCK_CODE,
                                "NEWS_COUNT" => "2000",
                                "SORT_BY1" => "ACTIVE_FROM",
                                "SORT_ORDER1" => "DESC",
                                "SORT_BY2" => "SORT",
                                "SORT_ORDER2" => "ASC",
                                "FILTER_NAME" => "arrFilterReagents",
                                "FIELD_CODE" => array('ID', 'NAME', 'IBLOCK_SECTION_ID'),
                                "PROPERTY_CODE" => $PROPERTY_CODE,
                                "CHECK_DATES" => "Y",
                                "DETAIL_URL" => "",
                                "PREVIEW_TRUNCATE_LEN" => "",
                                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                                "SET_TITLE" => "Y",
                                "SET_BROWSER_TITLE" => "Y",
                                "SET_META_KEYWORDS" => "Y",
                                "SET_META_DESCRIPTION" => "Y",
                                "SET_LAST_MODIFIED" => "Y",
                                "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                                "ADD_SECTIONS_CHAIN" => "Y",
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
                                "PAGER_TEMPLATE" => "",
                                "PAGER_DESC_NUMBERING" => "Y",
                                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                "PAGER_SHOW_ALL" => "Y",
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
                                'CUSTOM_SECTION_SORT' => $CUSTOM_SECTION_SORT,
                                // <-- Мои параметры 
                            )
                        ); ?>
                    <? } ?>
                </div>
            </div>
        </div>
    </section>

    <?
    $APPLICATION->IncludeComponent(
        "bitrix:main.include",
        "",
        array(
            "AREA_FILE_SHOW" => "file",
            "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/main/care.php"
        )
    ); ?>

    <? $APPLICATION->IncludeComponent(
        "bitrix:form.result.new",
        "callback",
        array(
            "SEF_MODE" => "N",
            "WEB_FORM_ID" => 1,
            "LIST_URL" => "",
            "EDIT_URL" => "",
            "SUCCESS_URL" => "",
            "CHAIN_ITEM_TEXT" => "",
            "CHAIN_ITEM_LINK" => "",
            "IGNORE_CUSTOM_TEMPLATE" => "Y",
            "USE_EXTENDED_ERRORS" => "Y",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "3600",
            "VARIABLE_ALIASES" => array(),
            "AJAX_MODE" => "Y",
            "AJAX_OPTION_SHADOW" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "AJAX_OPTION_HISTORY" => "N",

            // Мои параметры -->
            'PAGE_URL' => array(
                'VALUE' => $_SERVER['REQUEST_URI'],
                'AUTOCOMPLETE' => 'Y'
            ),
            // <- Мои параметры 
        )
    ); ?>
<? } ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>