<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
?>

<?
//vardump($arResult['WEBINARS_IDS']);
?>

<div class="dp-search-result-section">
    <form class="dp-search-result-form">
        <input class="dp-search-result-form__input" type="text" name="q" placeholder="Поиск" value="<?= htmlspecialcharsbx($arResult["REQUEST"]["QUERY"]) ?>">
        <button class="dp-search-result-form__submit" type="submit"><span class="dp-search-result-form__submit-icon"></span><span class="dp-search-result-form__submit-desc">Найти</span>
        </button>
        <button class="dp-search-result-form__clear" type="button">
            <svg class="icon icon-search-close ">
                <use xlink:href="#search-close"></use>
            </svg>
        </button>
    </form>

    <? if (!$arResult["REQUEST"]["QUERY"]) { ?>
        <div class="dp-search-result">
            <div class="note note-empty-request">
                <div class="note__inner">
                    <p>Для того чтобы найти необходимые вам материалы, введите поисковую фразу или ключевые слова, например, «Трудный пациент».</p>
                </div>
            </div>
        </div>
    <? } elseif (empty($arResult["ELEMENTS"])) { ?>
        <div class="dp-search-result">
            <div class="note note-not-found">
                <div class="note__inner">
                    <p>По вашему запросу ничего не найдено.<br>Попробуйте изменить текст запроса, либо воспользуйтесь навигацией по сайту для просмотра существующих материалов.</p>
                </div>
            </div>
        </div>
    <? } ?>

    <div class="dp-search-result">

        <? if (!empty($arResult["ELEMENTS"]["upcoming_webinars"])) { ?>
            <section class="dp-section">
                <div class="container">
                    <div class="dp-section__header">
                        <h2 class="dp-section__title">Ближайшие мероприятия</h2>
                    </div>
                    <div class="dp-section__body">
                        <div class="dp-item-block  dp-events">
                            <div class="dp-item-list">
                                <? foreach ($arResult["ELEMENTS"]["upcoming_webinars"] as $arItem) {
                                ?>
                                    <div class="dp-item-col">
                                        <div class="dp-event">
                                            <a class="dp-event__link" href="<?= $arItem['PROPERTIES']['URL']['VALUE'] ?>">
                                                <div class="dp-event__caption">
                                                    <? if (isset($arItem['PROPERTIES']['THEME']['DISPLAY_VALUE']) && !empty($arItem['PROPERTIES']['THEME']['DISPLAY_VALUE'])) { ?>
                                                        <div class="dp-event__tags">
                                                            <? foreach ($arItem['PROPERTIES']['THEME']['DISPLAY_VALUE'] as $theme) { ?>
                                                                <span class="dp-event__tag dp-event__category"><?= $theme ?>
                                                                </span>
                                                            <? } ?>
                                                        </div>
                                                    <? } ?>
                                                    <h3 class="dp-event__title"><?= $arItem["NAME"] ?></h3>
                                                    <?
                                                    $DATE_TIME_START = $arItem['PROPERTIES']['DATE_TIME_START']['VALUE'];
                                                    ?>
                                                    <div class="dp-event__meta"><span class="dp-event__live">Прямой эфир</span>
                                                        <time class="dp-event__date" datetime="<? echo FormatDate("c", MakeTimeStamp($DATE_TIME_START)); ?>"><? echo FormatDate("j F G:i", MakeTimeStamp($DATE_TIME_START)); ?> </time>
                                                    </div>
                                                </div>
                                                <div class="dp-event__speaker">
                                                    <div class="dp-event__speaker-photo">
                                                        <img src="<?= $arItem['PICTURE']['SRC']; ?>" alt="<?= $arItem['PICTURE']['ALT']; ?>" title="<?= $arItem['PICTURE']['TITLE']; ?>" />
                                                    </div>
                                                    <? if ($arItem['PROPERTIES']['FIO']["VALUE"]) { ?>
                                                        <div class="dp-event__speaker-caption">
                                                            <p class="dp-event__speaker-title">Лектор:</p>
                                                            <p class="dp-event__speaker-name"><?= $arItem['PROPERTIES']['FIO']["VALUE"] ?></p>
                                                        </div>
                                                    <? } ?>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                <? } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <? } ?>


        <? if (!empty($arResult['WEBINARS_IDS'])) { ?>
            <?
            $GLOBALS['arrFilterPersonalNewWebinars']['ID'] = $arResult['WEBINARS_IDS'];
            ?>
            <? $APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "webinars",
                array(
                    "DISPLAY_DATE" => "N",
                    "DISPLAY_NAME" => "N",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "AJAX_MODE" => "N",
                    "IBLOCK_TYPE" => "content",
                    "IBLOCK_ID" => Indexis::getIblockId("webinars", "content"),
                    "NEWS_COUNT" => "300",
                    "SORT_BY1" => "PROPERTY_PAID",
                    "SORT_ORDER1" => "DESC",
                    "SORT_BY2" => "ACTIVE_FROM",
                    "SORT_ORDER2" => "DESC",
                    "FILTER_NAME" => "arrFilterPersonalNewWebinars",
                    "FIELD_CODE" => array("PREVIEW_TEXT", "PREVIEW_PICTURE", "DETAIL_PICTURE"),
                    "PROPERTY_CODE" => array('THEME', 'PRICE', 'SHOW_PRICE', 'BUY_LINK', 'PAID', 'SPEAKER'),
                    "CHECK_DATES" => "N",
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
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "PARENT_SECTION" => "",
                    "PARENT_SECTION_CODE" => "",
                    "INCLUDE_SUBSECTIONS" => "Y",
                    "CACHE_TYPE" => "N",
                    "CACHE_TIME" => "3600",
                    "CACHE_FILTER" => "Y",
                    "CACHE_GROUPS" => "Y",
                    "DISPLAY_TOP_PAGER" => "N",
                    "DISPLAY_BOTTOM_PAGER" => "N",
                    "PAGER_TITLE" => "Подразделы",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_TEMPLATE" => "geropharm",
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
                    'HEADER' => 'Вебинары',
                    'SHOW_MORE_SHOW' => 'N',
                    'SHOW_ALL_BUTTON' => 'Y',
                    'SHOW_H2' => 'Y',
                    'USER_AUTHORIZED' => $USER->IsAuthorized() ? 'Y' : 'N',
                    'SHOW_THREE_OR_FOUR' => 'N',
                    'USER_ORDERS' => $GLOBALS['USER_ORDERS'],
                    // <-- Мои параметры
                )
            ); ?>
        <? } ?>
        <?/*?>
        <? if (!empty($arResult["ELEMENTS"]["webinars"])) { ?>
            <section class="dp-section dp-dashboard-webinars">
                <div class="container">
                    <div class="dp-section__header">
                        <h2 class="dp-section__title">Вебинары</h2>
                    </div>
                    <div class="dp-section__body">
                        <div class="dp-item-block  dp-webinars">
                            <div class="dp-item-list">
                                <? foreach ($arResult["ELEMENTS"]["webinars"] as $arItem) {
                                    if(!isset($arItem['PICTURE']['SRC']) || !$arItem['PICTURE']['SRC']){
                                        $arItem['PICTURE']['SRC'] = "/local/templates/geropharm-main/img/content/webinar/webinar-default.jpg";
                                    }
                                    ?>
                                    <div class="dp-item-col">
                                        <div class="dp-webinar">
                                            <? if ($arParams['USER_AUTHORIZED'] == 'Y') { ?>
                                                <button class="dp-bookmark-btn js_article_bookmark js_article_bookmark_<?= $arItem['ID']; ?>"
                                                        data-id="<?= $arItem['ID']; ?>"
                                                        data-iblock-id="<?= $arItem['IBLOCK_ID']; ?>" type="button">
                                                    <svg class="icon icon-bookmark ">
                                                        <use xlink:href="#bookmark"></use>
                                                    </svg>
                                                </button>
                                            <? } ?>
                                            <a class="dp-webinar__link" href="<?= $arItem["DETAIL_PAGE_URL"] ?>">
                                                <div class="dp-webinar__img">
                                                    <img src="<?= $arItem['PICTURE']['SRC']; ?>"
                                                         alt="<?= $arItem['PICTURE']['ALT']; ?>"
                                                         title="<?= $arItem['PICTURE']['TITLE']; ?>"/>
                                                </div>
                                                <div class="dp-webinar__caption">
                                                    <div class="dp-webinar__tags">
                                                        <? if (isset($arItem['PROPERTIES']['THEME']['DISPLAY_VALUE']) && !empty($arItem['PROPERTIES']['THEME']['DISPLAY_VALUE'])) { ?>
                                                            <? foreach ($arItem['PROPERTIES']['THEME']['DISPLAY_VALUE'] as $theme) { ?>
                                                                <span class="dp-webinar__tag dp-webinar__category"><?= $theme ?></span>
                                                            <? } ?>
                                                        <? } ?>
                                                        <span class="dp-webinar__tag dp-webinar__viewed d-none js_article_readed_<?= $arItem['ID'] ?>">Просмотрено</span>
                                                    </div>
                                                    <h3 class="dp-webinar__title"><?= $arItem["NAME"] ?></h3>
                                                    <?
                                                    if ($arItem['DATE_ACTIVE_FROM']) {
                                                        $DATE_TIME_START = $arItem['DATE_ACTIVE_FROM'];
                                                        ?>
                                                        <time class="dp-webinar__date"
                                                              datetime="<? echo FormatDate("c", MakeTimeStamp($DATE_TIME_START)); ?>"><? echo FormatDate("j F G:i", MakeTimeStamp($DATE_TIME_START)); ?>
                                                        </time>
                                                    <? } ?>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                <? } ?>
                            </div>
                        </div>
                    </div>
                    <div class="dp-section__footer"><a href="/webinars/"
                                                       class="dp-btn dp-btn_orange dp-btn_m dp-section__link">Все
                            вебинары</a></div>
                </div>
            </section>
        <? } ?>
        <?*/ ?>

        <? if (!empty($arResult["ELEMENTS"]["articles"])) { ?>
            <section class="dp-section dp-dashboard-articles">
                <div class="container">
                    <div class="dp-section__header">
                        <h2 class="dp-section__title">Статьи</h2>
                    </div>
                    <div class="dp-section__body">
                        <div class="dp-item-block  dp-articles">
                            <div class="dp-item-list">
                                <? foreach ($arResult["ELEMENTS"]["articles"] as $arItem) { ?>
                                    <div class="dp-item-col">
                                        <div class="dp-article">
                                            <? if ($arParams['USER_AUTHORIZED'] == 'Y') { ?>
                                                <?
                                                // dp-bookmark-btn_active
                                                ?>
                                                <button class="dp-bookmark-btn js_article_bookmark js_article_bookmark_<?= $arItem['ID']; ?>" data-id="<?= $arItem['ID']; ?>" data-iblock-id="<?= $arItem['IBLOCK_ID']; ?>" type="button">
                                                    <svg class="icon icon-bookmark ">
                                                        <use xlink:href="#bookmark"></use>
                                                    </svg>
                                                </button>
                                            <? } ?>
                                            <a class="dp-article__link" href="<?= $arItem['DETAIL_PAGE_URL'] ?>">
                                                <div class="dp-article__img">
                                                    <img src="<?= $arItem['PICTURE']['SRC']; ?>" alt="<?= $arItem['PICTURE']['ALT']; ?>" title="<?= $arItem['PICTURE']['TITLE']; ?>" />
                                                </div>
                                                <div class="dp-article__caption">
                                                    <div class="dp-article__tags">
                                                        <? if (isset($arItem['PROPERTIES']['THEME']['DISPLAY_VALUE']) && !empty($arItem['PROPERTIES']['THEME']['DISPLAY_VALUE'])) { ?>
                                                            <? foreach ($arItem['PROPERTIES']['THEME']['DISPLAY_VALUE'] as $theme) { ?>
                                                                <span class="dp-article__tag dp-article__category"><?= $theme ?></span>
                                                            <? } ?>
                                                        <? } ?>
                                                        <span class="dp-article__tag dp-article__viewed d-none js_article_readed_<?= $arItem['ID'] ?>">Просмотрено</span>
                                                    </div>
                                                    <h3 class="dp-article__title"><?= $arItem['NAME']; ?></h3>
                                                    <div class="dp-article__desc">
                                                        <p><?= $arItem['PREVIEW_TEXT']; ?></p>
                                                        <div class="dp-article__img"><img src="<?= $arItem['PICTURE']['SRC']; ?>" alt="<?= $arItem['PICTURE']['ALT']; ?>" title="<?= $arItem['PICTURE']['TITLE']; ?>" /></div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                <? } ?>
                            </div>
                        </div>
                    </div>
                    <div class="dp-section__footer"><a href="/blog/" class="dp-btn dp-btn_orange dp-btn_m dp-section__link">Все
                            статьи</a>
                    </div>
                </div>
            </section>
        <? } ?>

        <? if (!empty($arResult["ELEMENTS"]["master-class"])) { ?>
            <section class="dp-section dp-dashboard-masterclasses">
                <div class="container">
                    <div class="dp-section__header">
                        <h2 class="dp-section__title">Мастер-классы</h2>
                    </div>
                    <div class="dp-section__body">
                        <div class="dp-item-block  dp-masterclasses">
                            <div class="dp-item-list">
                                <? foreach ($arResult["ELEMENTS"]["master-class"] as $arItem) { ?>
                                    <div class="dp-item-col">
                                        <div class="dp-masterclass">
                                            <? if ($arParams['USER_AUTHORIZED'] == 'Y') { ?>
                                                <button class="dp-bookmark-btn js_article_bookmark js_article_bookmark_<?= $arItem['ID']; ?>" data-id="<?= $arItem['ID']; ?>" data-iblock-id="<?= $arItem['IBLOCK_ID']; ?>" type="button">
                                                    <svg class="icon icon-bookmark ">
                                                        <use xlink:href="#bookmark"></use>
                                                    </svg>
                                                </button>
                                            <? } ?>
                                            <a class="dp-masterclass__link" data-id="<?= $arItem['ID']; ?>" href="<?= $arItem['PROPERTIES']['BUY_LINK']['VALUE'] ?>" data-iblock-id="<?= $arItem['IBLOCK_ID']; ?>">
                                                <div class="dp-masterclass__img">
                                                    <img src="<?= $arItem['PICTURE']['SRC']; ?>" alt="<?= $arItem['PICTURE']['ALT']; ?>" title="<?= $arItem['PICTURE']['TITLE']; ?>" />
                                                </div>
                                                <div class="dp-masterclass__caption">
                                                    <h3 class="dp-masterclass__title"><?= $arItem['NAME']; ?></h3>
                                                    <div class="dp-masterclass__meta">
                                                        <? if (!empty($arItem['PROPERTIES']['COUNT_MODULES']['VALUE'])) { ?>
                                                            <span class="dp-masterclass__modules">
                                                                <?= Indexis::num2word($arItem['PROPERTIES']['COUNT_MODULES']['VALUE'], ['модуль', 'модуля', 'модулей']); ?>
                                                            </span>
                                                        <? } ?>
                                                        <?
                                                        if (!empty($arItem['PROPERTIES']['DATE_START']['VALUE']) /*|| !empty( $arItem['DISPLAY_PROPERTIES']['DATE_END']['VALUE'] )*/) {
                                                        ?>
                                                            <?
                                                            $dateStart = FormatDate("j F", MakeTimeStamp($arItem['PROPERTIES']['DATE_START']['VALUE']));
                                                            $dateEnd = '';
                                                            if (!empty($arItem['PROPERTIES']['DATE_END']['VALUE'])) {
                                                                $dateEnd = ' — ' . FormatDate("j F", MakeTimeStamp($arItem['PROPERTIES']['DATE_END']['VALUE']));
                                                            }
                                                            ?>
                                                            <span class="dp-masterclass__date">
                                                                <? echo $dateStart; ?><? echo $dateEnd; ?>
                                                            </span>
                                                        <?
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="dp-masterclass__desc">
                                                        <p><?= $arItem['PREVIEW_TEXT']; ?></p>
                                                    </div>
                                                    <? if (!empty($arItem['PROPERTIES']['BUY_LINK']['VALUE'])) { ?>
                                                        <div class="dp-masterclass__actions">
                                                            <button class="dp-btn dp-btn_orange dp-btn_m dp-masterclass__btn" type="button">
                                                                Перейти к мастер-классу
                                                            </button>
                                                        </div>
                                                    <? } ?>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                <? } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <? } ?>

        <? if (!empty($arResult["ELEMENTS"]["courses"])) { ?>
            <section class="dp-section dp-dashboard-courses">
                <div class="container">
                    <div class="dp-section__header">
                        <h2 class="dp-section__title">Курсы</h2>
                    </div>
                    <div class="dp-section__body">
                        <div class="dp-item-block  dp-courses">
                            <div class="dp-item-list">
                                <? foreach ($arResult["ELEMENTS"]["courses"] as $arItem) { ?>
                                    <div class="dp-item-col">
                                        <div class="dp-course">

                                            <div class="dp-course__img">
                                                <a class="dp-course__img-link" href="#">
                                                    <img src="<?= $arItem['PICTURE']['SRC']; ?>" alt="<?= $arItem['PICTURE']['ALT']; ?>" title="<?= $arItem['PICTURE']['TITLE']; ?>" />
                                                </a>
                                            </div>

                                            <div class="dp-course__caption">
                                                <div class="dp-course__tags"><span class="dp-course__tag dp-course__category">Курс</span>
                                                </div>
                                                <a class="dp-course__title-link" href="<?= $arItem['PROPERTIES']['BUY_LINK']['VALUE'] ?>">
                                                    <h3 class="dp-course__title"><?= $arItem["NAME"] ?></h3>
                                                </a>
                                                <div class="dp-course__meta">
                                                    <? if ($arItem["PROPERTIES"]["COUNT_MODULES"]["VALUE"]) { ?>
                                                        <span class="dp-course__modules">
                                                            <?= Indexis::num2word($arItem['PROPERTIES']['COUNT_MODULES']['VALUE'], ['модуль', 'модуля', 'модулей']); ?>
                                                        </span>
                                                    <? } ?>
                                                    <?
                                                    if (!empty($arItem['PROPERTIES']['DATE_START']['VALUE'])) {
                                                    ?>
                                                        <?
                                                        $dateStart = FormatDate("j F", MakeTimeStamp($arItem['PROPERTIES']['DATE_START']['VALUE']));
                                                        $dateEnd = '';
                                                        if (!empty($arItem['PROPERTIES']['DATE_END']['VALUE'])) {
                                                            $dateEnd = ' — ' . FormatDate("j F", MakeTimeStamp($arItem['PROPERTIES']['DATE_END']['VALUE']));
                                                        }
                                                        ?>
                                                        <span class="dp-course__date">
                                                            <? echo $dateStart; ?><? echo $dateEnd; ?>
                                                        </span>
                                                    <?
                                                    }
                                                    ?>
                                                </div>
                                                <div class="dp-course__desc">
                                                    <p><?= $arItem["PREVIEW_TEXT"] ?></p>
                                                </div>
                                                <div class="dp-course__actions">
                                                    <a class="dp-btn dp-btn_m dp-course__btn-detail" href="<?= $arItem['PROPERTIES']['BUY_LINK']['VALUE'] ?>"">Подробнее</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <? } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <? } ?>
    </div>
</div>