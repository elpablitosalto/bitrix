<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "18 лет мы поддерживаем неблагополучные семьи, семьи в трудных жизненных ситуациях, ведем профилактику детской преступности и помогаем развивать таланты");
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
$APPLICATION->SetTitle("Благотворительный фонд «Дорога к дому»");
?>
<?

use \Bitrix\Main\Data\Cache,
    \Bitrix\Main\Application,
    \Bitrix\Main\Page\Asset,
    \Bitrix\Main\Loader,
    \Bitrix\Main\Grid\Declension;

Loader::includeModule('iblock');
Asset::getInstance()->addString('<script data-skip-moving="true" src="https://widget.cloudpayments.ru/bundles/cloudpayments.js"></script>');
?>

<div class="page-content main-page">
    <section class="main-first">
        <div class="container">
            <div class="section__head-block">
                <h1 class="section__title"><? $APPLICATION->ShowTitle(false) ?></h1>
                <?
                $GLOBALS['arrHomeMainText']['CODE'] = 'we_support';
                ?>
                <? $APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "home_main_text",
                    array(
                        "DISPLAY_DATE" => "Y",
                        "DISPLAY_NAME" => "Y",
                        "DISPLAY_PICTURE" => "Y",
                        "DISPLAY_PREVIEW_TEXT" => "Y",
                        "AJAX_MODE" => "N",
                        "IBLOCK_TYPE" => "content",
                        "IBLOCK_ID" => Indexis::getIblockId("texts", "settings", "s1"),
                        "NEWS_COUNT" => "1",
                        "SORT_BY1" => "SORT",
                        "SORT_ORDER1" => "ASC",
                        "SORT_BY2" => "ACTIVE_FROM",
                        "SORT_ORDER2" => "DESC",
                        "FILTER_NAME" => "arrHomeMainText",
                        "FIELD_CODE" => array("PREVIEW_TEXT"),
                        "PROPERTY_CODE" => array(),
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
                <?/*?>
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/main_page/top_desc.php"
                    )
                ); ?>
                <?*/ ?>
                <picture class="main-first__pattern">
                    <img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= SITE_TEMPLATE_PATH ?>/images/main-first-birds.png" loading="lazy" alt="Дорога к дому" title="Дорога к дому" />
                </picture>
            </div>

            <?
            $APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/main_page/top_image.php"
                )
            ); ?>
        </div>
    </section>
    <section class="main-digits">
        <div class="container">
            <div class="items-list">
                <?
                //echo 'SITE_TEMPLATE_PATH = '.SITE_TEMPLATE_PATH.'<br />';
                ?>
                <? $APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "main_stat",
                    array(
                        "DISPLAY_DATE" => "Y",
                        "DISPLAY_NAME" => "Y",
                        "DISPLAY_PICTURE" => "Y",
                        "DISPLAY_PREVIEW_TEXT" => "Y",
                        "AJAX_MODE" => "N",
                        "IBLOCK_TYPE" => "content",
                        "IBLOCK_ID" => Indexis::getIblockId("stat", "content", "s1"),
                        //"IBLOCK_ID" => Indexis::getIblockId("stat", "content"),
                        "NEWS_COUNT" => "99999",
                        "SORT_BY1" => "SORT",
                        "SORT_ORDER1" => "ASC",
                        "SORT_BY2" => "ACTIVE_FROM",
                        "SORT_ORDER2" => "DESC",
                        "FILTER_NAME" => "",
                        "FIELD_CODE" => array("PREVIEW_PICTURE"),
                        "PROPERTY_CODE" => array(),
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
            <div class="section__nav"><a href="/about/financial-reports/" target="_self">
                    <u>Смотреть отчеты</u>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-arrow">
                        <use xlink:href="#arrow"></use>
                    </svg>
                </a></div>
        </div>
    </section>

    <?
    $fondFilter = ["!PROPERTY_SHOW_IN_TODAY_FOND" => false]; ?>
    <? $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "main_show_in_fond",
        array(
            "DISPLAY_DATE" => "Y",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "AJAX_MODE" => "N",
            "IBLOCK_TYPE" => "content",
            "IBLOCK_ID" => Indexis::getIblockId("news", "content", "s1"),
            "NEWS_COUNT" => "5",
            "SORT_BY1" => "SORT",
            "SORT_ORDER1" => "ASC",
            "SORT_BY2" => "ACTIVE_FROM",
            "SORT_ORDER2" => "DESC",
            "FILTER_NAME" => "fondFilter",
            "FIELD_CODE" => array("PREVIEW_PICTURE"),
            "PROPERTY_CODE" => array("PUBLICATION_TYPE"),
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

    <section class="main-programs">
        <div class="container">
            <div class="section__head-block">
                <div class="row">
                    <div class="col-lg-6">
                        <h2 class="h3 section__title">Деятельность фонда</h2>
                    </div>
                    <div class="col-lg-6">
                        <p class="text-size-lg section__desc">
                            <?
                            $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/main_page/activity.php"
                                )
                            ); ?>
                        </p>
                        <div class="section__nav"><a href="/about/" target="_self">
                                <u>О фонде</u>
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-arrow">
                                    <use xlink:href="#arrow"></use>
                                </svg>
                            </a></div>
                    </div>
                </div>
            </div>
            <div class="items-list programs-list">
                <div class="row">
                    <? //программы
                    ?>
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:news.list",
                        "main_programs",
                        array(
                            "DISPLAY_DATE" => "Y",
                            "DISPLAY_NAME" => "Y",
                            "DISPLAY_PICTURE" => "Y",
                            "DISPLAY_PREVIEW_TEXT" => "Y",
                            "AJAX_MODE" => "N",
                            "IBLOCK_TYPE" => "content",
                            "IBLOCK_ID" => Indexis::getIblockId("programs", "content", "s1"),
                            "NEWS_COUNT" => "2",
                            "SORT_BY1" => "SORT",
                            "SORT_ORDER1" => "ASC",
                            "SORT_BY2" => "ACTIVE_FROM",
                            "SORT_ORDER2" => "DESC",
                            "FILTER_NAME" => "",
                            "FIELD_CODE" => array("PREVIEW_PICTURE"),
                            "PROPERTY_CODE" => array("AUDIENCE_TYPE", "PROGRAM_ACTIVITY", "PROJECTS"),
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
                    <?
                    //грантовые проекты
                    $cache = Cache::createInstance();
                    $taggedCache = Application::getInstance()->getTaggedCache();
                    $grantProjCount = 0;

                    $cachePath = '/main/';
                    $cacheTtl = 360000;
                    $projIb = Indexis::getIblockId("projects", "content", "s1");
                    $cacheKey = 'grant_projects_' . $projIb;

                    if ($cache->initCache($cacheTtl, $cacheKey, $cachePath)) {
                        $grantProjCount = $cache->getVars();
                    } elseif ($cache->startDataCache()) {

                        $taggedCache->startTagCache($cachePath);
                        $taggedCache->registerTag('iblock_id_' . $projIb);

                        $arSelect = array("ID");
                        $arFilter = array("IBLOCK_ID" => $projIb, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y", "!PROPERTY_IS_GRANT_PROJECT" => false, "SECTION_ID" => 91);
                        $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
                        $grantProjCount = $res->SelectedRowsCount();

                        if ($grantProjCount == 0) {
                            $taggedCache->abortTagCache();
                            $cache->abortDataCache();
                        }

                        $taggedCache->endTagCache();
                        $cache->endDataCache($grantProjCount);
                    }
                    if ($grantProjCount > 0) {
                        $projDeclension = new Declension('проект', 'проекта', 'проектов');
                    ?>
                        <div class="col-12">
                            <div class="list-item main-programs-item">
                                <div class="main-programs-item__head">
                                    <div class="h4 main-programs-item__title">Грантовые проекты фонда</div>
                                    <button type="button" class="btn btn-white main-programs-item__toggler">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-drop-light">
                                            <use xlink:href="#drop-light"></use>
                                        </svg>
                                    </button>
                                </div>
                                <div class="row align-items-height">
                                    <div class="col-lg-6 main-programs-item__content-wrapper">
                                        <div class="main-programs-item__content">
                                            <?
                                            $APPLICATION->IncludeComponent(
                                                "bitrix:main.include",
                                                "",
                                                array(
                                                    "AREA_FILE_SHOW" => "file",
                                                    "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/main_page/grant_proj_desc.php"
                                                )
                                            ); ?>
                                            <div class="main-programs-item__buttons">
                                                <div class="buttons-line"><a href="/projects/grantovye-proekty/" target="_self" class="btn main-programs-item__btn"><?= $grantProjCount ?> <?= $projDeclension->get($grantProjCount); ?>
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-arrow">
                                                            <use xlink:href="#arrow"></use>
                                                        </svg>
                                                    </a><a href="/projects/?pf-1=projectFilter_253_3918974738&set_filter=y&projectFilter_253_3918974738=Y" target="_self" class="main-programs-item__link">
                                                        <u>Завершенные проекты</u>
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-arrow">
                                                            <use xlink:href="#arrow"></use>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="main-programs-item__decor">
                                    <picture><img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= SITE_TEMPLATE_PATH ?>/images/main-programs-decor.png" loading="lazy" alt="" title="" />
                                    </picture>
                                </div>
                            </div>
                        </div>
                    <? } ?>
                </div>
            </div>
        </div>
    </section>

    <? //новости добрые истории
    ?>
    <?
    global $goodStoriesFilter;
    $cache = Cache::createInstance();
    $taggedCache = Application::getInstance()->getTaggedCache();

    $cachePath = '/main/';
    $cacheTtl = 360000;
    $newsIb = Indexis::getIblockId("news", "content", "s1");
    $cacheKey = 'goodStoriesVal_' . $newsIb;

    if ($cache->initCache($cacheTtl, $cacheKey, $cachePath)) {
        $goodStoriesFilter = $cache->getVars();
    } elseif ($cache->startDataCache()) {

        $taggedCache->startTagCache($cachePath);

        $goodStoriesFilter = [];
        $rsEnums = CIBlockPropertyEnum::GetList(
            array(
                "SORT" => "ASC",
            ),
            array(
                "IBLOCK_ID" => $newsIb,
                "CODE" => ["PUBLICATION_TYPE"]
            )
        );
        while ($arEnums = $rsEnums->Fetch()) {
            if ($arEnums["XML_ID"] == "GOOD_STORY") {
                $goodStoriesFilter["PROPERTY_PUBLICATION_TYPE"] = $arEnums["ID"];
                break;
            }
        }

        $taggedCache->registerTag('iblock_id_' . $newsIb);


        if (empty($goodStoriesFilter)) {
            $taggedCache->abortTagCache();
            $cache->abortDataCache();
        }

        $taggedCache->endTagCache();
        $cache->endDataCache($goodStoriesFilter);
    }
    ?>
    <? $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "main_good_stories",
        array(
            "DISPLAY_DATE" => "Y",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "AJAX_MODE" => "N",
            "IBLOCK_TYPE" => "content",
            "IBLOCK_ID" => Indexis::getIblockId("news", "content", "s1"),
            "NEWS_COUNT" => "20",
            "SORT_BY1" => "SORT",
            "SORT_ORDER1" => "ASC",
            "SORT_BY2" => "ACTIVE_FROM",
            "SORT_ORDER2" => "DESC",
            "FILTER_NAME" => "goodStoriesFilter",
            "FIELD_CODE" => array("PREVIEW_PICTURE"),
            "PROPERTY_CODE" => array(),
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

    <section class="main-help">
        <div class="container">
            <h2 class="h3 section__title">Как вы можете помочь</h2>
            <div class="items-list">
                <div class="row align-items-height">
                    <div class="col-lg-8">
                        <?
                        $APPLICATION->IncludeComponent(
                            "indexis:ajax.form",
                            "cloudpayments_pay_form_main",
                            array(
                                "IBLOCK_ID" => Indexis::getIblockId("pay_form", "requests", "s1"),
                                "IBLOCK_TYPE" => "requests",
                                "FIELDS" => [
                                    "PROPERTY_TYPE" => ["NOT_EMPTY", "LIST"],
                                    "PROPERTY_SUM" => ["CLEAR", "NOT_EMPTY", "NUMBER"],
                                ],
                                "CHECK_CAPTCHA" => "Y",
                                "RETURN_FIELDS" => ["PROPERTY_SUM", "PROPERTY_TYPE"],
                                "HANDLERS" => [
                                    "ACTIVE" => "N",
                                    "NAME" => htmlspecialcharsbx($APPLICATION->GetCurPage()),
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
                        );
                        ?>
                    </div>
                    <div class="col-lg-4">
                        <div class="list-item main-help-item">
                            <div class="main-help-item__content">
                                <div class="h5 main-help-item__title">Другие <span class="text-color-orange">способы помощи</span>
                                </div>
                                <ul class="text-size-lg main-help-item__list">
                                    <?
                                    $APPLICATION->IncludeComponent(
                                        "bitrix:main.include",
                                        "",
                                        array(
                                            "AREA_FILE_SHOW" => "file",
                                            "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/main_page/help_list.php"
                                        )
                                    ); ?>
                                </ul>
                            </div>
                            <div class="main-help-item__nav">
                                <div class="buttons-line"><a href="/how_to_help/" target="_self" class="btn">Все способы помочь
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-arrow">
                                            <use xlink:href="#arrow"></use>
                                        </svg>
                                    </a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="main-volunteers">
        <div class="container">
            <div class="section__head-block">
                <div class="row">
                    <div class="col-lg-6">
                        <h2 class="h3 section__title">Добровольчество</h2>
                    </div>
                    <div class="col-lg-6">
                        <?
                        $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/main_page/volunteer_desc.php"
                            )
                        ); ?>
                        <div class="section__nav">
                            <a href="/how_to_help/volunteering/" target="_self">
                                <u>Как стать добровольцем</u>
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-arrow">
                                    <use xlink:href="#arrow"></use>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main-volunteers__image">
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/main_page/volunteer_img.php"
                    )
                ); ?>
            </div>
        </div>

        <? //добровольцы
        ?>
        <? $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "main_volunteers",
            array(
                "DISPLAY_DATE" => "Y",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "Y",
                "AJAX_MODE" => "N",
                "IBLOCK_TYPE" => "content",
                "IBLOCK_ID" => Indexis::getIblockId("volunteer", "content", "s1"),
                "NEWS_COUNT" => "20",
                "SORT_BY1" => "SORT",
                "SORT_ORDER1" => "ASC",
                "SORT_BY2" => "ACTIVE_FROM",
                "SORT_ORDER2" => "DESC",
                "FILTER_NAME" => "",
                "FIELD_CODE" => array("PREVIEW_PICTURE"),
                "PROPERTY_CODE" => array("OCCUPATION"),
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
    <section class="main-partners">
        <div class="container">
            <div class="section__head-block">
                <div class="row">
                    <div class="col-lg-6">
                        <h2 class="h3 section__title">Партнерская помощь</h2>
                    </div>
                    <div class="col-lg-6">
                        <p class="text-size-lg section__desc">
                            <?
                            $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/main_page/partners_desc.php"
                                )
                            ); ?>
                        </p>

                        <div class="section__nav"><a href="/how_to_help/partnership/" target="_self">
                                <u>Как стать партнером</u>
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-arrow">
                                    <use xlink:href="#arrow"></use>
                                </svg>
                            </a></div>
                    </div>
                </div>
            </div>

            <? //партнёры
            ?>
            <? $partnersFilter = ["!PROPERTY_SHOW_ON_MAIN" => false]; ?>
            <? $APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "common_partner_reviews",
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
                    "PROPERTY_CODE" => array("POSTION"),
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


    <? //ребёнок на усыновление
    ?>
    <? $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "main_adaptation",
        array(
            "DISPLAY_DATE" => "Y",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "AJAX_MODE" => "N",
            "IBLOCK_TYPE" => "content",
            "IBLOCK_ID" => Indexis::getIblockId("adaptation", "content", "s1"),
            "NEWS_COUNT" => "20",
            "SORT_BY1" => "SORT",
            "SORT_ORDER1" => "ASC",
            "SORT_BY2" => "ACTIVE_FROM",
            "SORT_ORDER2" => "DESC",
            "FILTER_NAME" => "",
            "FIELD_CODE" => array("PREVIEW_PICTURE"),
            "PROPERTY_CODE" => array("BIRTH_DATE"),
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