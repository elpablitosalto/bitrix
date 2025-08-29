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
$this->setFrameMode(true);

//if ($arResult["DISPLAY_PROPERTIES"]["LONG_HEADER"]["DISPLAY_VALUE"] == "Y") {
if (mb_strlen($arResult["DISPLAY_PROPERTIES"]["LONG_HEADER"]["VALUE"])) {
?>
    <section id="projects-detail-main" class="projects-detail-main full-width">
    <?
} else {
    ?>
        <section id="projects-detail-main" class="projects-detail-main">
        <?
    }
        ?>
        <?
        $this->AddEditAction($arResult['ID'], $arResult['EDIT_LINK'], CIBlock::GetArrayByID($arResult["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arResult['ID'], $arResult['DELETE_LINK'], CIBlock::GetArrayByID($arResult["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div class="container" id="<?= $this->GetEditAreaId($arResult['ID']); ?>">
            <?
            //if ($arResult["DISPLAY_PROPERTIES"]["LONG_HEADER"]["DISPLAY_VALUE"] == "Y") {
            if (mb_strlen($arResult["DISPLAY_PROPERTIES"]["LONG_HEADER"]["VALUE"])) {
            ?>
                <div class="section__content">
                    <h1 class="page-title"><?= $arResult["NAME"] ?></h1>
                    <? if ($arResult["DETAIL_TEXT"] <> '') { ?>
                        <p class="text-size-lg section__desc">
                            <? echo $arResult["DETAIL_TEXT"]; ?>
                        </p>
                    <? } else { ?>
                        <p class="text-size-lg section__desc">
                            <? echo $arResult["PREVIEW_TEXT"]; ?>
                        </p>
                    <? } ?>
                    <div class="buttons-line"><a href="#projects-detail-help" class="btn">Поддержать проект</a></div>
                </div>
                <? if (strlen($arResult["DETAIL_PICTURE"]["SRC"]) > 0) { ?>
                    <div class="section__image">
                        <picture class="projects-detail-main__image">
                            <img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= $arResult["DETAIL_PICTURE"]["SRC"]; ?>" loading="lazy" alt="<?= $arResult["NAME"] ?>" title="<?= $arResult["NAME"] ?>" />
                        </picture>
                        <picture class="projects-detail-main__pattern">
                            <img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= SITE_TEMPLATE_PATH ?>/images/projects-detail-first-image.png" loading="lazy" alt="" title="" />
                        </picture>
                    </div>
                <? } ?>
            <?
            } else {
            ?>
                <div class="row">
                    <div class="col-lg-7">
                        <div class="section__content">
                            <? if ($arParams["DISPLAY_NAME"] != "N" && $arResult["NAME"]) { ?>
                                <? if (!mb_strlen($arResult["DISPLAY_PROPERTIES"]["IS_GRANT_PROJECT"]["VALUE"])) { ?>
                                    <h1 class="page-title"><?= $arResult["NAME"] ?></h1>
                                <? } else { ?>
                                    <?/*?>
                                <h1 class="page-title">Грантовый проект «<?= $arResult["NAME"] ?>»</h1>
                                <?*/ ?>
                                    <h1 class="page-title"><?= $arResult["NAME"] ?></h1>
                                <? } ?>
                            <? }; ?>
                            <? if ($arResult["DETAIL_TEXT"] <> '') { ?>
                                <p class="text-size-lg section__desc">
                                    <? echo $arResult["DETAIL_TEXT"]; ?>
                                </p>
                            <? } else { ?>
                                <p class="text-size-lg section__desc">
                                    <? echo $arResult["PREVIEW_TEXT"]; ?>
                                </p>
                            <? } ?>
                            <div class="buttons-line"><a href="#projects-detail-help" class="btn">Поддержать проект</a></div>
                        </div>
                    </div>
                    <? if ($arResult["DETAIL_PICTURE"]["DETAIL_PICTURE_RESIZED"]) { ?>
                        <div class="col-lg-5">
                            <div class="section__image">
                                <picture class="projects-detail-main__image"><img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= $arResult["DETAIL_PICTURE"]["DETAIL_PICTURE_RESIZED"] ?>" loading="lazy" alt="<?= $arResult["DETAIL_PICTURE"]["ALT"] ?>" title="<?= $arResult["DETAIL_PICTURE"]["TITLE"] ?>" />
                                </picture>
                                <picture class="projects-detail-main__pattern"><img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= SITE_TEMPLATE_PATH ?>/images/projects-detail-first-image.png" loading="lazy" alt="loader" title="loader" />
                                </picture>
                            </div>
                        </div>
                    <? } ?>
                </div>
            <?
            }
            ?>
            <div id="projects-categories" class="nav-tabs-container projects-categories">
                <ul class="text-size-lg nav-tabs">
                    <? if (mb_strlen($arResult["DISPLAY_PROPERTIES"]["ABOUT"]["DISPLAY_VALUE"]) > 0) { ?>
                        <li><a href="#projects-detail-about" data-scroll-to="#projects-detail-about">О проекте</a></li>
                    <? } ?>
                    <? if (!empty($arResult["DISPLAY_PROPERTIES"]["DOCS"]["FULL_FILES"])) { ?>
                        <li><a href="#projects-detail-documents" data-scroll-to="#projects-detail-documents">Документы</a>
                        </li>
                    <? } ?>
                    <? if (!empty($arResult["DISPLAY_PROPERTIES"]["HOW_WE_HELP"]["DISPLAY_VALUE"])) { ?>
                        <li><a href="#projects-detail-how-we-help" data-scroll-to="#projects-detail-how-we-help">Как мы
                                помогаем</a></li>
                    <? } ?>
                    <? if (!empty($arResult["DISPLAY_PROPERTIES"]["GALERY"]["DISPLAY_VALUE"])) { ?>
                        <li><a href="#projects-detail-gallery" data-scroll-to="#projects-detail-gallery">Галерея</a>
                        </li>
                    <? } ?>
                    <li class="news_link"><a href="#projects-detail-news" data-scroll-to="#projects-detail-news">Новости</a></li>
                    <li class="materials_link"><a href="#projects-detail-media" data-scroll-to="#projects-detail-media">Материалы</a>
                    </li>
                    <li class="partners_link"><a href="#main-partners" data-scroll-to="#main-partners">Партнеры</a></li>
                    <li class="team_link"><a href="#projects-detail-team" data-scroll-to="#projects-detail-team">Команда
                            проекта</a></li>
                </ul>
            </div>
        </div>
        </section>

        <section id="projects-detail-hidden-nav" class="projects-detail-hidden-nav">
            <div class="container">
                <div class="buttons-line">
                    <div class="hidden-page-nav-wrapper"><a href="#projects-categories" data-toggle-activity="#btn-page-nav-popup" class="btn btn-white btn-page-nav open-popup xs-collapsed"><span>Разделы страницы</span>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-anchor">
                                <use xlink:href="#anchor"></use>
                            </svg>
                        </a><a href="#projects-categories" data-toggle-activity="#btn-page-nav-popup" class="btn btn-page-nav close-popup xs-collapsed">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-close">
                                <use xlink:href="#close"></use>
                            </svg>
                        </a>
                        <div id="btn-page-nav-popup" data-close-on-outside-click="true" class="nav-tabs-container hidden-page-nav-popup">
                            <ul class="text-size-lg nav-tabs">
                                <? if (mb_strlen($arResult["DISPLAY_PROPERTIES"]["ABOUT"]["DISPLAY_VALUE"]) > 0) { ?>
                                    <li><a href="#projects-detail-about" data-scroll-to="#projects-detail-about">О
                                            проекте</a>
                                    </li>
                                <? } ?>
                                <? if (!empty($arResult["DISPLAY_PROPERTIES"]["DOCS"]["FULL_FILES"])) { ?>
                                    <li><a href="#projects-detail-documents" data-scroll-to="#projects-detail-documents">Документы</a>
                                    </li>
                                <? } ?>
                                <? if (!empty($arResult["DISPLAY_PROPERTIES"]["HOW_WE_HELP"]["DISPLAY_VALUE"])) { ?>
                                    <li><a href="#projects-detail-how-we-help" data-scroll-to="#projects-detail-how-we-help">Как
                                            мы помогаем</a></li>
                                <? } ?>
                                <? if (!empty($arResult["DISPLAY_PROPERTIES"]["GALERY"]["DISPLAY_VALUE"])) { ?>
                                    <li><a href="#projects-detail-gallery" data-scroll-to="#projects-detail-gallery">Галерея</a>
                                    </li>
                                <? } ?>
                                <li class="news_link"><a href="#projects-detail-news" data-scroll-to="#projects-detail-news">Новости</a></li>
                                <li class="materials_link"><a href="#projects-detail-media" data-scroll-to="#projects-detail-media">Материалы</a>
                                </li>
                                <li class="partners_link"><a href="#main-partners" data-scroll-to="#main-partners">Партнеры</a></li>
                                <li class="team_link"><a href="#projects-detail-team" data-scroll-to="#projects-detail-team">Команда
                                        проекта</a></li>
                            </ul>
                        </div>
                    </div>
                    <a href="#projects-detail-help" data-scroll-to="#projects-detail-help" class="btn btn-help">Поддержать
                        проект</a><a href="#projects-detail-share" data-toggle-activity="#projects-detail-share" class="btn btn-share">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-share">
                            <use xlink:href="#share"></use>
                        </svg>
                    </a>
                </div>
                <div id="projects-detail-share" class="projects-detail-share">
                    <div data-curtain data-shape="round" data-color-scheme="blackwhite" data-services="vkontakte,odnoklassniki,telegram,whatsapp" data-size="l" class="ya-share2"></div>
                </div>
            </div>
        </section>

        <? if (mb_strlen($arResult["DISPLAY_PROPERTIES"]["ABOUT"]["DISPLAY_VALUE"]) > 0) { ?>
            <section id="projects-detail-about" class="projects-detail-about">
                <div class="container">
                    <div class="section__head">
                        <h3 class="section__title">О проекте</h3>
                    </div>
                    <div id="projects-detail-desc" class="section__desc">

                        <? if (mb_strlen($arResult["DISPLAY_PROPERTIES"]["ABOUT"]["DISPLAY_VALUE"]) > 500) {
                            $desc = $arResult["DISPLAY_PROPERTIES"]["ABOUT"]["DISPLAY_VALUE"] . " ";
                            $l = intval(strlen($desc) / 2 + strlen($desc) * 0.02);
                            $desc = preg_replace("[\r\n]", " ", $desc);
                            preg_match_all("/(.{1,$l})[ \n\r\t]+/", $desc, $descArray);

                        ?>
                            <div class="h5 section__desc-inner"><?= $descArray[1][0] ?>
                            </div>
                            <div class="section__desc-default-hidden">
                                <div class="h5 section__desc-inne">
                                    <?= $descArray[1][1] ?>
                                </div>
                            </div>
                            <a href="#projects-detail-desc" data-toggle-activity="#projects-detail-desc" class="text-size-lg section__desc-toggler"><span class="txt-show">Читать описание</span><span class="txt-hide">Скрыть описание</span></a>
                    </div>
                <? } else { ?>
                    <div class="h5 section__desc-inner"><?= $arResult["DISPLAY_PROPERTIES"]["ABOUT"]["DISPLAY_VALUE"] ?>
                    </div>
                <?
                        } ?>
                </div>
                </div>
            </section>
        <? } ?>

        <? if (!empty($arResult["DISPLAY_PROPERTIES"]["FOR_WHOM"]["DISPLAY_VALUE"]) || !empty($arResult["DISPLAY_PROPERTIES"]["DOCS"]["VALUE"])) { ?>
            <section class="projects-detail-info">
                <div class="container">
                    <div class="row">
                        <? if (!empty($arResult["DISPLAY_PROPERTIES"]["FOR_WHOM"]["DISPLAY_VALUE"])) { ?>
                            <div class="col-xl-6">
                                <div class="projects-detail-for">
                                    <h5 class="section__title">Для кого предназначен</h5>
                                    <ol class="text-size-lg">
                                        <? foreach ($arResult["DISPLAY_PROPERTIES"]["FOR_WHOM"]["DISPLAY_VALUE"] as $val) { ?>
                                            <li><?= $val ?></li>
                                        <? } ?>
                                    </ol>
                                </div>
                            </div>
                        <? } ?>
                        <? if (!empty($arResult["DISPLAY_PROPERTIES"]["DOCS"]["VALUE"])) { ?>
                            <div class="col-xl-6">
                                <div id="projects-detail-documents" class="projects-detail-documents">
                                    <h5 class="section__title">Документы проекта</h5>
                                    <div class="items-list documents-list">
                                        <? foreach ($arResult["DISPLAY_PROPERTIES"]["DOCS"]["FULL_FILES"] as $arFile) {
                                            $sizeKb = $arFile["FILE_SIZE"] / 1024;
                                            if ($sizeKb > 1024) {
                                                $showSize = number_format($sizeKb / 1024, 2, '.', '') . " mB";
                                            } else {
                                                $showSize = number_format($sizeKb, 0, '.', '') . " kB";
                                            }
                                        ?>
                                            <div class="list-item document-item">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-pdf document-item__icon">
                                                    <use xlink:href="#pdf"></use>
                                                </svg>
                                                <div class="text-size-lg document-item__title"><?= ($arFile["DESCRIPTION"]) ? htmlspecialcharsbx($arFile["DESCRIPTION"]) : htmlspecialcharsbx($arFile["FILE_NAME"]); ?>
                                                </div>
                                                <div class="document-item__info"><?= strtoupper(pathinfo($arFile["SRC"], PATHINFO_EXTENSION)); ?>
                                                    , <?= $showSize ?></div>
                                                <a href="<?= $arFile["SRC"] ?>" class="btn btn-transparent document-item__link" download>
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-download">
                                                        <use xlink:href="#download"></use>
                                                    </svg>
                                                </a>
                                            </div>
                                        <? } ?>
                                    </div>
                                    <? if (count($arResult["DISPLAY_PROPERTIES"]["DOCS"]["VALUE"]) > 2) { ?>
                                        <div class="buttons-line section__nav"><a href="#projects-detail-documents" data-toggle-activity="#projects-detail-documents" class="btn btn-transparent projects-detail-documents-toggler"><span class="txt-show">Показать все</span><span class="txt-hide">Свернуть</span></a></div>
                                    <? } ?>
                                </div>
                            </div>
                        <? } ?>
                    </div>
                </div>
            </section>
        <? } ?>

        <? if (!empty($arResult["DISPLAY_PROPERTIES"]["PROJECT_BUDGET"]["DISPLAY_VALUE"])) { ?>
            <section class="projects-detail-digits">
                <div class="container">
                    <h3 class="section__title">Бюджет проекта</h3>
                    <div class="items-list">
                        <div class="row">
                            <? foreach ($arResult["DISPLAY_PROPERTIES"]["PROJECT_BUDGET"]["DISPLAY_VALUE"] as $arVal) { ?>
                                <div class="col-md-6">
                                    <div class="list-item main-digits-item">
                                        <div class="h2 main-digits-item__title"><?= $arVal["SUB_VALUES"]["PROJECT_BUDGET_NUM"]["DISPLAY_VALUE"] ?></div>
                                        <div class="text-size-lg main-digits-item__text"><?= $arVal["SUB_VALUES"]["PROJECT_BUDGET_TEXT"]["DISPLAY_VALUE"] ?></div>
                                        <? if (!empty($arVal["SUB_VALUES"]["PROJECT_BUDGET_LOGO"]["FILE_VALUE"])) { ?>
                                            <div class="main-digits-item__logo">
                                                <picture><img src="<?= $arVal["SUB_VALUES"]["PROJECT_BUDGET_LOGO"]["FILE_VALUE"]["SRC"] ?>" alt="<?= $arVal["SUB_VALUES"]["PROJECT_BUDGET_LOGO"]["FILE_VALUE"]["FILE_NAME"] ?>" title="<?= $arVal["SUB_VALUES"]["PROJECT_BUDGET_LOGO"]["FILE_VALUE"]["FILE_NAME"] ?>">
                                                </picture>
                                            </div>
                                        <? } ?>
                                    </div>
                                </div>
                            <? } ?>
                        </div>
                    </div>
                </div>
            </section>
        <? } elseif (!empty($arResult["DISPLAY_PROPERTIES"]["PROJECT_NUMBERS"]["DISPLAY_VALUE"])) { ?>
            <section class="projects-detail-digits">
                <div class="container">
                    <div class="items-list">
                        <div class="row">
                            <? foreach ($arResult["DISPLAY_PROPERTIES"]["PROJECT_NUMBERS"]["DISPLAY_VALUE"] as $num => $val) { ?>
                                <div class="col-sm-6 col-lg-4">
                                    <div class="list-item main-digits-item">
                                        <div class="h2 main-digits-item__title"><?= $val ?></div>
                                        <div class="text-size-lg main-digits-item__text"><?= $arResult["DISPLAY_PROPERTIES"]["PROJECT_NUMBERS"]["DESCRIPTION"][$num] ?></div>
                                    </div>
                                </div>
                            <? } ?>
                        </div>
                    </div>
                </div>
            </section>
        <? } ?>