<?
define('SET_OG_MARKING', 'Y');
use Bitrix\Main\Application,
    Bitrix\Main\Web\Uri;

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle('Вебинары и онлайн-курсы для врачей | Академия «Врач будущего»');
$APPLICATION->SetPageProperty("description", 'Бесплатные вебинары по вашей специальности с разбором клинических случаев. Курсы по общению с пациентом. Статьи и видеолекции, которые помогут врачу расширить медицинскую базу знаний и достигать целей профессиональной деятельности.');
$APPLICATION->SetPageProperty("keywords", 'курсы для врачей, бесплатные курсы для врачей, вебинары для врачей, мастер классы для врачей, курсы для докторов, лекции для врачей, курсы для медиков, курсы для терапевтов');
require(dirname(__FILE__) . "/.process.php");
$APPLICATION->SetPageProperty("PAGE_BODY_CLASS", 'dp-page-home');

// Разметка OG -->
$arResultFunc = CMarkingOG::getSetGlobalData(array(
    "ELEMENT_CODE" => "index"
));
// <-- Разметка OG

?>

<div class="dp-section dp-home-top-section">
    <div class="dp-home-top">
        <div class="container">
            <div class="dp-home-top__inner">

                <? $APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "top_block",
                    array(
                        "DISPLAY_DATE" => "Y",
                        "DISPLAY_NAME" => "Y",
                        "DISPLAY_PICTURE" => "Y",
                        "DISPLAY_PREVIEW_TEXT" => "Y",
                        "AJAX_MODE" => "N",
                        "IBLOCK_TYPE" => "content",
                        "IBLOCK_ID" => indexis::getIblockId("main_blocks", "content"),
                        "NEWS_COUNT" => "999",
                        "SORT_BY1" => "ACTIVE_FROM",
                        "SORT_ORDER1" => "DESC",
                        "SORT_BY2" => "SORT",
                        "SORT_ORDER2" => "ASC",
                        "FILTER_NAME" => "",
                        "FIELD_CODE" => array(""),
                        "PROPERTY_CODE" => array(""),
                        "CHECK_DATES" => "Y",
                        "DETAIL_URL" => "",
                        "PREVIEW_TRUNCATE_LEN" => "",
                        "ACTIVE_DATE_FORMAT" => "d.m.Y",
                        "SET_TITLE" => "N",
                        "SET_BROWSER_TITLE" => "N",
                        "SET_META_KEYWORDS" => "N",
                        "SET_META_DESCRIPTION" => "N",
                        "SET_LAST_MODIFIED" => "Y",
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                        "ADD_SECTIONS_CHAIN" => "N",
                        "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
                        "PARENT_SECTION" => "",
                        "PARENT_SECTION_CODE" => "webinars_main",
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
                        "AUTH_USER" => $USER->IsAuthorized()
                    )
                ); ?>

            </div>
        </div>
    </div>
</div>

<?
if ($_REQUEST["change_materials"] == "y") {
    $GLOBALS['APPLICATION']->RestartBuffer();
}
?>
<section class="dp-section dp-new-blog-section" id="new_materials">
    <div class="container">
        <div class="dp-section__header">
            <h2 class="dp-section__title">Новые материалы академии</h2>
        </div>
        <div class="dp-section__body">
            <div class="dp-filter-section">
                <div class="dp-filter dp-filter-slider">
                    <p class="dp-filter__title">Тема</p>
                    <div class="dp-modal dp-filter__modal">
                        <div class="dp-modal__overlay"></div>
                        <button class="dp-modal__close" type="button">
                            <svg class="icon icon-cross ">
                                <use xlink:href="#cross"></use>
                            </svg>
                        </button>
                        <div class="dp-modal__dialog">
                            <form class="dp-filter-form dp-filter-form-topic theme-form" action="/#new_materials" method="get">
                                <p class="dp-filter-form__title">Тема</p>
                                <div class="dp-filter-form__body">
                                    <div class="dp-filter-form__list">
                                        <? foreach ($arInput["VISIBLE_THEMES"] as $themeXml) {
                                            $theme = $arInput["THEMES"][$themeXml];
                                            if (!isset($theme) || mb_strlen($theme["UF_NAME"]) == 0)
                                                continue;
                                        ?>
                                            <div class="dp-filter-form__item">
                                                <input <? if (in_array($themeXml, $arInput["SELECTED_THEMES"])) echo "checked"; ?> id="ff-topic-<?= $themeXml ?>" type="radio" name="theme[]" value="<?= $themeXml ?>">
                                                <label onclick="mindboxClickOnNewMaterialsAcademy('<?= $theme["UF_NAME"] ?>')" for="ff-topic-<?= $themeXml ?>"><?= $theme["UF_NAME"] ?></label>
                                            </div>
                                        <? } ?>
                                    </div>
                                </div>
                                <div class="dp-filter-form__actions">
                                    <button class="dp-btn dp-btn_m dp-btn_orange" type="submit">Применить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="dp-filter">
                    <p class="dp-filter__title">Формат</p>
                    <div class="dp-modal dp-filter__modal">
                        <div class="dp-modal__overlay"></div>
                        <button class="dp-modal__close" type="button">
                            <svg class="icon icon-cross ">
                                <use xlink:href="#cross"></use>
                            </svg>
                        </button>
                        <div class="dp-modal__dialog">
                            <form class="dp-filter-form dp-filter-form-format theme-form" action="/#new_materials" method="get">
                                <input type="hidden" name="theme[]" value="<?= $arInput["SELECTED_THEMES"][0] ?>">
                                <p class="dp-filter-form__title">Формат</p>
                                <div class="dp-filter-form__body">
                                    <div class="dp-filter-form__list">
                                        <? foreach ($arInput["VISIBLE_IBLOCKS"] as $visibleBlock) {
                                            $arIblock = $arInput["IBLOCKS"][$visibleBlock];
                                        ?>
                                            <div class="dp-filter-form__item">
                                                <input <? if ($arInput["SELECTED_BLOCK"] == $arIblock["CODE"]) echo " checked"; ?> id="block-format-<?= $arIblock["CODE"] ?>" type="radio" name="type" value="<?= $arIblock["ID"] ?>">
                                                <label for="block-format-<?= $arIblock["CODE"] ?>"><?= $arIblock["NAME"] ?></label>
                                            </div>
                                        <? } ?>
                                    </div>
                                </div>
                                <div class="dp-filter-form__actions">
                                    <button class="dp-btn dp-btn_m dp-btn_orange" type="submit">Применить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dp-section__body" id="new_materials_ajax">
                <?
                global $materialsFilter;
                $materialsFilter = [];
                if (!empty($arInput["SELECTED_THEMES"])) {
                    $materialsFilter["PROPERTY_THEME"] = $arInput["SELECTED_THEMES"];
                } else {
                    $materialsFilter["PROPERTY_THEME"] = $arInput["VISIBLE_THEMES"];
                }

                // Дата больше сегодняшней -->
                $materialsFilter[">PROPERTY_DATE_TIME_START"] = date('Y-m-d H:i:s');
                $materialsFilter["ACTIVE"] = 'Y';
                // <-- Дата больше сегодняшней
                ?>
                <? $APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "new_materials",
                    array(
                        "CURRENT_BLOCK" => $arInput["SELECTED_BLOCK"],
                        "DISPLAY_DATE" => "Y",
                        "DISPLAY_NAME" => "Y",
                        "DISPLAY_PICTURE" => "Y",
                        "DISPLAY_PREVIEW_TEXT" => "Y",
                        "AJAX_MODE" => "N",
                        "IBLOCK_TYPE" => "content",
                        "IBLOCK_ID" => $arInput["SELECTED_BLOCK_ID"],
                        "NEWS_COUNT" => "10",
                        //"SORT_BY1" => "ACTIVE_FROM",
                        "SORT_BY1" => "PROPERTY_DATE_TIME_START",
                        "SORT_ORDER1" => "ASC",
                        "SORT_BY2" => "SORT",
                        "SORT_ORDER2" => "ASC",
                        "FILTER_NAME" => "materialsFilter",
                        "FIELD_CODE" => array("PREVIEW_PICTURE", "ACTIVE_FROM"),
                        "PROPERTY_CODE" => array("LIVE_START", "SPECIALITY", "DATE_END", "DATE_START", "COUNT_MODULES", "THEME", "URL", "DATE_TIME_START", "FIO"),
                        "CHECK_DATES" => "Y",
                        "DETAIL_URL" => "",
                        "PREVIEW_TRUNCATE_LEN" => "",
                        "ACTIVE_DATE_FORMAT" => "d F Y",
                        "SET_TITLE" => "N",
                        "SET_BROWSER_TITLE" => "N",
                        "SET_META_KEYWORDS" => "N",
                        "SET_META_DESCRIPTION" => "N",
                        "SET_LAST_MODIFIED" => "Y",
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                        "ADD_SECTIONS_CHAIN" => "N",
                        "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
                        "PARENT_SECTION" => "",
                        "PARENT_SECTION_CODE" => "",
                        "INCLUDE_SUBSECTIONS" => "Y",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "360000",
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
                        "AJAX_OPTION_ADDITIONAL" => ""
                    )
                ); ?>
            </div>
        </div>
    </div>
</section>
<?
if ($_REQUEST["change_materials"] == "y") {
    die();
}
?>

<? $APPLICATION->IncludeComponent(
    "indexis:ajax.form",
    "new_materials",
    array(
        "IBLOCK_ID" => Indexis::getIblockId("new_materials", "forms", "s1"),
        "IBLOCK_TYPE" => "forms",
        "RETURN_FIELDS" => "Y",
        "MINDBOX_TYPE" => "JS",
        "MINDBOX" => "mindboxSubscriptionFormonSite",
        "FIELDS" => [
            "NAME" => ["CLEAR", "NOT_EMPTY", "EMAIL"],
            "PROPERTY_SPECIALITY" => ["NOT_EMPTY", "HL_LIST"]
        ],
    )
); ?>

<? $APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "academy",
    array(
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "AJAX_MODE" => "N",
        "IBLOCK_TYPE" => "content",
        "IBLOCK_ID" => indexis::getIblockId("main_blocks", "content"),
        "NEWS_COUNT" => "999",
        "SORT_BY1" => "ACTIVE_FROM",
        "SORT_ORDER1" => "DESC",
        "SORT_BY2" => "SORT",
        "SORT_ORDER2" => "ASC",
        "FILTER_NAME" => "",
        "FIELD_CODE" => array(""),
        "PROPERTY_CODE" => array(""),
        "CHECK_DATES" => "Y",
        "DETAIL_URL" => "",
        "PREVIEW_TRUNCATE_LEN" => "",
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "SET_TITLE" => "N",
        "SET_BROWSER_TITLE" => "N",
        "SET_META_KEYWORDS" => "N",
        "SET_META_DESCRIPTION" => "N",
        "SET_LAST_MODIFIED" => "Y",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "ADD_SECTIONS_CHAIN" => "N",
        "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
        "PARENT_SECTION" => "",
        "PARENT_SECTION_CODE" => "academy",
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
        "AJAX_OPTION_ADDITIONAL" => ""
    )
); ?>
<section class="dp-section dp-speakers-section">
    <div class="container">
        <div class="dp-section__header">
            <h2 class="dp-section__title">Спикеры Академии — это ведущие <span class="dp-nowrap">эксперты-практики</span> в&nbsp;сфере здравоохранения
            </h2>
        </div>
        <div class="dp-section__body">
            <div class="dp-slider dp-speakers-slider">
                <div class="dp-slider__list">
                    <?
                    global $speakersFilter;
                    $speakersFilter = [
                        "!PROPERTY_SHOW_IN_MAIN" => false
                    ];
                    ?>
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:news.list",
                        "speakers",
                        array(
                            "DISPLAY_DATE" => "Y",
                            "DISPLAY_NAME" => "Y",
                            "DISPLAY_PICTURE" => "Y",
                            "DISPLAY_PREVIEW_TEXT" => "Y",
                            "AJAX_MODE" => "N",
                            "IBLOCK_TYPE" => "content",
                            "IBLOCK_ID" => indexis::getIblockId("speakers", "content"),
                            "NEWS_COUNT" => "999",
                            "SORT_BY1" => "ACTIVE_FROM",
                            "SORT_ORDER1" => "DESC",
                            "SORT_BY2" => "SORT",
                            "SORT_ORDER2" => "ASC",
                            "FILTER_NAME" => "speakersFilter",
                            "FIELD_CODE" => array("PREVIEW_TEXT", "PREVIEW_PICTURE"),
                            "PROPERTY_CODE" => array("SPECIALITY"),
                            "CHECK_DATES" => "Y",
                            "DETAIL_URL" => "",
                            "PREVIEW_TRUNCATE_LEN" => "",
                            "ACTIVE_DATE_FORMAT" => "d.m.Y",
                            "SET_TITLE" => "N",
                            "SET_BROWSER_TITLE" => "N",
                            "SET_META_KEYWORDS" => "N",
                            "SET_META_DESCRIPTION" => "N",
                            "SET_LAST_MODIFIED" => "Y",
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                            "ADD_SECTIONS_CHAIN" => "N",
                            "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
                            "PARENT_SECTION" => "",
                            "PARENT_SECTION_CODE" => "academy",
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
                            "AJAX_OPTION_ADDITIONAL" => ""
                        )
                    ); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="dp-section dp-compilation-section" id="compilation">
    <?
    if ($_REQUEST["change_compilation"] == "y") {
        $GLOBALS['APPLICATION']->RestartBuffer();
    }
    ?>
    <div class="container">
        <div class="dp-section__header">
            <h2 class="dp-section__title">Зарегистрируйтесь на&nbsp;сайте и&nbsp;получите доступ к&nbsp;закрытой
                подборке по&nbsp;своей специальности</h2>
        </div>
        <div class="dp-section__body">
            <? $arFilterFromComponent = $APPLICATION->IncludeComponent(
                "indexis:filter.materials",
                "home",
                array(
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "AJAX_OPTION_HISTORY" => "Y",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "CACHE_TIME" => "36000000",
                    "CACHE_TYPE" => "A",
                    "THEMES" => $arInput["PERSONAL_SELECTION"],
                    "USER_ID" => $USER->GetID(),
                    "HIBLOCK_ID" => $GLOBALS['arSiteConfig']['HIBLOCK']['THEMES']['ID'],
                    "FORM_ACTION" => "#closed_selection",
                    "SAVE" => "N",
                    "GET_SAVE" => "N",
                    "REDIRECT" => "N",
                )
            ); ?>
            <?
            // Фильтр -->
            $arResultFunc = CMaterials::getFilterMaterials(array(
                "arFilterFromComponent" => $arFilterFromComponent,
                "USER_ID" => $USER->GetID(),
                "IBLOCK_ID" => Indexis::getIblockId("articles", "content"),
                "MATERIAL_TYPE" => 'ARTICLES',
                'FILTER_BY_LEARNED' => 'N'
            ));
            if (!empty($arResultFunc['arFilterResult'])) {
                foreach ($arResultFunc['arFilterResult'] as $key => $val) {
                    $GLOBALS['articlesFilter'][$key] = $arResultFunc['arFilterResult'][$key];
                }
            }
            //vardump($GLOBALS[$arParams["~FILTER_NAME"]]);
            // <-- Фильтр
            ?>
            <div class="dp-slider dp-blog-slider dp-compilation-slider">
                <div class="dp-slider__list">
                    <?
                    $GLOBALS['articlesFilter']['!PREVIEW_PICTURE'] = false;
                    if(!isset($GLOBALS['articlesFilter']["PROPERTY_THEME"])){
                        $GLOBALS['articlesFilter']["PROPERTY_THEME"] =  $arInput["PERSONAL_SELECTION"];
                    }
                    ?>
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:news.list",
                        "main_articles",
                        array(
                            "DISPLAY_DATE" => "Y",
                            "DISPLAY_NAME" => "Y",
                            "DISPLAY_PICTURE" => "Y",
                            "DISPLAY_PREVIEW_TEXT" => "Y",
                            "AJAX_MODE" => "N",
                            "IBLOCK_TYPE" => "content",
                            "IBLOCK_ID" => Indexis::getIblockId("articles", "content"),
                            "NEWS_COUNT" => "10",
                            "SORT_BY1" => "ACTIVE_FROM",
                            "SORT_ORDER1" => "DESC",
                            "SORT_BY2" => "SORT",
                            "SORT_ORDER2" => "ASC",
                            "FILTER_NAME" => "articlesFilter",
                            "FIELD_CODE" => array("PREVIEW_PICTURE", "ACTIVE_FROM"),
                            "PROPERTY_CODE" => array("LIVE_START", "SPECIALITY", "DATE_END", "DATE_START", "COUNT_MODULES", 'THEME'),
                            "CHECK_DATES" => "Y",
                            "DETAIL_URL" => "",
                            "PREVIEW_TRUNCATE_LEN" => "",
                            "ACTIVE_DATE_FORMAT" => "d F Y",
                            "SET_TITLE" => "N",
                            "SET_BROWSER_TITLE" => "N",
                            "SET_META_KEYWORDS" => "N",
                            "SET_META_DESCRIPTION" => "N",
                            "SET_LAST_MODIFIED" => "Y",
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                            "ADD_SECTIONS_CHAIN" => "N",
                            "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
                            "PARENT_SECTION" => "",
                            "PARENT_SECTION_CODE" => "",
                            "INCLUDE_SUBSECTIONS" => "Y",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "360000",
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
                            "AJAX_OPTION_ADDITIONAL" => ""
                        )
                    ); ?>
                </div>
            </div>
        </div>
    </div>
    <? if (!$USER->IsAuthorized()) { ?>
        <div class="dp-section__footer">
            <div class="container">
                <div class="dp-compilation-sign-up">
                    <p class="dp-compilation-sign-up__title">И еще 50+ материалов: статей и&nbsp;записей
                        вебинаров</p>
                    <a href="#modal-auth" class="dp-btn dp-btn_orange" data-modal="" data-mb-block="3">Зарегистрироваться</a>
                </div>
            </div>
        </div>
    <? } ?>
    <?
    if ($_REQUEST["change_compilation"] == "y") {
        die();
    }
    ?>
</section>

<section class="dp-section dp-effectiveness-section">
    <div class="container">
        <p class="dp-section__note">Полезно для всех специалистов</p>
        <div class="dp-section__header">
            <h2 class="dp-section__title">Личная эффективность и общение с пациентами</h2>
        </div>
        <div class="dp-section__body">
            <div class="dp-slider dp-blog-slider dp-effectiveness-slider">
                <div class="dp-slider__list">
                    <?
                    global $articlesFilterEffect;
                    $articlesFilterEffect = ["PROPERTY_THEME" => $arInput["THEMES_EFECTIVNESS"], '!PREVIEW_PICTURE' => false];
                    ?>
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:news.list",
                        "main_articles",
                        array(
                            "DISPLAY_DATE" => "Y",
                            "DISPLAY_NAME" => "Y",
                            "DISPLAY_PICTURE" => "Y",
                            "DISPLAY_PREVIEW_TEXT" => "Y",
                            "AJAX_MODE" => "N",
                            "IBLOCK_TYPE" => "content",
                            "IBLOCK_ID" => indexis::getIblockId("articles", "content"),
                            "NEWS_COUNT" => "10",
                            "SORT_BY1" => "ACTIVE_FROM",
                            "SORT_ORDER1" => "DESC",
                            "SORT_BY2" => "SORT",
                            "SORT_ORDER2" => "ASC",
                            "FILTER_NAME" => "articlesFilterEffect",
                            "FIELD_CODE" => array("PREVIEW_PICTURE", "ACTIVE_FROM"),
                            "PROPERTY_CODE" => array("LIVE_START", "SPECIALITY", "DATE_END", "DATE_START", "COUNT_MODULES"),
                            "CHECK_DATES" => "Y",
                            "DETAIL_URL" => "",
                            "PREVIEW_TRUNCATE_LEN" => "",
                            "ACTIVE_DATE_FORMAT" => "d F Y",
                            "SET_TITLE" => "N",
                            "SET_BROWSER_TITLE" => "N",
                            "SET_META_KEYWORDS" => "N",
                            "SET_META_DESCRIPTION" => "N",
                            "SET_LAST_MODIFIED" => "Y",
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                            "ADD_SECTIONS_CHAIN" => "N",
                            "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
                            "PARENT_SECTION" => "",
                            "PARENT_SECTION_CODE" => "",
                            "INCLUDE_SUBSECTIONS" => "Y",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "360000",
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
                            "AJAX_OPTION_ADDITIONAL" => ""
                        )
                    ); ?>
                </div>
            </div>
        </div>
        <div class="dp-section__footer">
            <div class="container">
                <a onclick="mindboxClickOnReadAllArticles();" class="dp-btn dp-btn_m dp-btn_orange" href="/blog/?prefilter=pers_eff">Читать все статьи</a>
            </div>
        </div>
    </div>
</section>


<section class="dp-section dp-courses-section">
    <div class="container">
        <div class="dp-section__header">
            <h2 class="dp-section__title">Для тех, кто хочет серьезно погрузиться в тему</h2>
        </div>
        <div class="dp-section__body">
            <div class="dp-courses">
                <div class="dp-slider dp-courses-slider">
                    <div class="dp-slider__list">
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:news.line",
                            "main_courses",
                            array(
                                "IBLOCK_TYPE" => "CONTENT",
                                "IBLOCKS" => [
                                    indexis::getIblockId("master-class", "content"),
                                    indexis::getIblockId("courses", "content")
                                ],
                                "NEWS_COUNT" => "10",
                                "SORT_BY1" => "ACTIVE_FROM",
                                "SORT_ORDER1" => "DESC",
                                "SORT_BY2" => "SORT",
                                "SORT_ORDER2" => "ASC",
                                "FIELD_CODE" => array("PREVIEW_PICTURE", "PREVIEW_TEXT", "ACTIVE_FROM"),
                                "PROPERTY_CODE" => array("LIVE_START", "SPECIALITY", "DATE_END", "DATE_START", "COUNT_MODULES", "BUY_LINK"),
                                "CHECK_DATES" => "Y",
                                "DETAIL_URL" => "",
                            )
                        ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<? if (!$USER->IsAuthorized()) { ?>
    <section class="dp-section dp-join-section dp-gradient-bg">
        <div class="container">
            <div class="dp-section__header">
                <h2 class="dp-section__title">Зарегистрируйтесь на&nbsp;сайте и&nbsp;получите доступ к&nbsp;персональной
                    экспертной подборке</h2>
            </div>
            <div class="dp-section__body">
                <div class="dp-join-features">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="dp-join-feature"><span class="dp-join-feature__number">1</span>
                                <div class="dp-join-feature__caption">
                                    <p class="dp-join-feature__title">Зарегистрируйтесь <br>на&nbsp;сайте
                                    </p>
                                    <p class="dp-join-feature__desc">Регистрация займет меньше 3&#8209;х&nbsp;минут</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="dp-join-feature"><span class="dp-join-feature__number">2</span>
                                <div class="dp-join-feature__caption">
                                    <p class="dp-join-feature__title">Настройте <br>предпочтения
                                    </p>
                                    <p class="dp-join-feature__desc">Ответьте на несколько простых вопросов, чтобы мы
                                        могли настроить персонализированные рекомендации</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="dp-join-feature"><span class="dp-join-feature__number">3</span>
                                <div class="dp-join-feature__caption">
                                    <p class="dp-join-feature__title">Получите доступ к&nbsp;закрытым материалам
                                        Академии</p>
                                    <p class="dp-join-feature__desc">И одними из первых узнавайте о&nbsp;наших
                                        актуальных событиях</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dp-join-block">
                    <form class="dp-join-form">
                        <div class="dp-join-form__body">
                            <div class="dp-join-form__field">
                                <input class="dp-join-form__input" type="email" id="bottom_email" placeholder="Введите e-mail">
                            </div>
                            <? if (!$USER->IsAuthorized()) { ?>
                                <a href="#modal-auth" data-modal="" data-mb-block="4" class="dp-btn dp-btn_orange dp-join-form__submit bottom-auth">Зарегистрироваться
                                </a>
                            <? } else { ?>
                                <a class="dp-btn dp-btn_orange dp-join-form__submit" href="/personal/">Зарегистрироваться
                                </a>
                            <? } ?>
                        </div>
                    </form>
                    <div class="dp-join-social-auth">
                        <p class="dp-join-social-auth__title">или войдите через:</p>
                        <? if (!$USER->IsAuthorized()) { ?>
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:system.auth.form",
                                "social",
                                array(
                                    "REGISTER_URL" => "",
                                    "FORGOT_PASSWORD_URL" => "",
                                    "PROFILE_URL" => "",
                                    "SHOW_ERRORS" => "Y",
                                    "AJAX_MODE" => "Y",
                                    "AJAX_OPTION_SHADOW" => "N",
                                    "AJAX_OPTION_JUMP" => "N",
                                    "AJAX_OPTION_STYLE" => "Y",
                                    "AJAX_OPTION_HISTORY" => "N",
                                )
                            ); ?>
                        <? } else { ?>
                            <ul class="dp-social dp-social-auth">
                                <li class="dp-social__item"><a class="dp-social__link" href="/personal/">
                                        <svg class="icon icon-auth-yandex">
                                            <use xlink:href="#auth-yandex"></use>
                                        </svg>
                                    </a></li>
                                <li class="dp-social__item"><a class="dp-social__link" href="/personal/">
                                        <svg class="icon icon-auth-mail">
                                            <use xlink:href="#auth-mail"></use>
                                        </svg>
                                    </a></li>
                                <li class="dp-social__item"><a class="dp-social__link" href="/personal/">
                                        <svg class="icon icon-auth-vk">
                                            <use xlink:href="#auth-vk"></use>
                                        </svg>
                                    </a></li>
                                <li class="dp-social__item"><a class="dp-social__link" href="/personal/">
                                        <svg class="icon icon-auth-ok">
                                            <use xlink:href="#auth-ok"></use>
                                        </svg>
                                    </a></li>
                            </ul>
                        <? } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<? } ?>

<?
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
?>