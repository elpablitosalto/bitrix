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
?>

<section id="projects-detail-main" class="projects-detail-main">
    <?
    $this->AddEditAction($arResult['ID'], $arResult['EDIT_LINK'], CIBlock::GetArrayByID($arResult["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arResult['ID'], $arResult['DELETE_LINK'], CIBlock::GetArrayByID($arResult["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>
    <div class="container" id="<?= $this->GetEditAreaId($arResult['ID']); ?>">
        <div class="row">
            <div class="col-lg-7">
                <div class="section__content">
                    <? if ($arParams["DISPLAY_NAME"] != "N" && $arResult["NAME"]) { ?>
                        <h1 class="page-title"><?= $arResult["NAME"] ?></h1>
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
                    <div class="buttons-line"><a href="#projects-detail-help" class="btn">
                            Поддержать программу</a>
                    </div>
                </div>
            </div>

            <? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arResult["DETAIL_PICTURE"])) : ?>
                <div class="col-lg-5">
                    <div class="section__image">
                        <picture class="projects-detail-main__image">
                            <source media="(max-width: 767.98px)" srcset="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-srcset="<?= $arResult["DETAIL_PICTURE"]["DETAIL_PICTURE_RESIZED_SMALL"] ?>" />
                            <source media="(min-width: 768px) and (max-width: 1279.98px)" srcset="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-srcset="<?= $arResult["DETAIL_PICTURE"]["DETAIL_PICTURE_RESIZED_BIG"] ?>" />
                            <img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= $arResult["DETAIL_PICTURE"]["DETAIL_PICTURE_RESIZED_MEDIUM"] ?>" loading="lazy" alt="<?= $arResult["DETAIL_PICTURE"]["ALT"] ?>" title="<?= $arResult["DETAIL_PICTURE"]["TITLE"] ?>" />
                        </picture>
                        <picture class="projects-detail-main__pattern"><img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= SITE_TEMPLATE_PATH ?>/images/projects-detail-first-image.png" loading="lazy" alt="" title="" />
                        </picture>
                    </div>
                </div>
            <? endif ?>
        </div>
        <div id="projects-categories" class="nav-tabs-container projects-categories">
            <ul class="text-size-lg nav-tabs">
                <? if ($arResult["DISPLAY_PROPERTIES"]["PROGRAM_GOAL"]["DISPLAY_VALUE"]) { ?>
                    <li><a href="#projects-detail-about" data-scroll-to="#projects-detail-about" class="active">О
                            программе</a></li>
                <? } ?>
                <? if (!empty($arResult["DISPLAY_PROPERTIES"]["DOCS"]["FULL_FILES"])) { ?>
                    <li><a href="#projects-detail-documents" data-scroll-to="#projects-detail-documents">Документы</a></li>
                <? } ?>
                <li id="events_link"><a href="#projects-detail-events" data-scroll-to="#projects-detail-events">Текущие акции</a>
                </li>
                <li id="who_link"><a href="#projects-detail-who" data-scroll-to="#projects-detail-who">Для кого работает</a>
                </li>
                <li id="projects_link"><a href="#projects-detail-projects" data-scroll-to="#projects-detail-projects">Проекты</a>
                </li>
                <li id="news_link"><a href="#projects-detail-news" data-scroll-to="#projects-detail-news">Новости</a></li>
                <li id="materials_link"><a href="#projects-detail-media" data-scroll-to="#projects-detail-media">Материалы</a></li>
                <li id="partners_link"><a href="#main-partners" data-scroll-to="#main-partners">Партнеры</a></li>
            </ul>
        </div>
    </div>
</section>
<section id="projects-detail-hidden-nav" class="projects-detail-hidden-nav">
    <div class="container">
        <div class="buttons-line">
            <a href="#projects-categories" data-scroll-to="#projects-categories" class="btn btn-white btn-page-nav xs-collapsed">
                <span>Разделы страницы</span>
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-anchor">
                    <use xlink:href="#anchor"></use>
                </svg>
            </a>
            <a href="#projects-detail-help" data-scroll-to="#projects-detail-help" class="btn btn-help">Поддержать программу</a><a href="#projects-detail-share" data-toggle-activity="#projects-detail-share" class="btn btn-share">
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
<? if ($arResult["DISPLAY_PROPERTIES"]["PROGRAM_GOAL"]["DISPLAY_VALUE"]) { ?>
    <section id="projects-detail-about" class="projects-detail-about">
        <div class="container">
            <div class="section__head">
                <h3 class="section__title">Цель программы</h3>
            </div>
            <div id="projects-detail-desc" class="section__desc">
                <div class="h5 section__desc-inner"><?= $arResult["DISPLAY_PROPERTIES"]["PROGRAM_GOAL"]["DISPLAY_VALUE"] ?>
                </div>

                <? if ($arResult["DISPLAY_PROPERTIES"]["PROGRAM_GOAL_DESCRIPTION"]["DISPLAY_VALUE"] || $arResult["DISPLAY_PROPERTIES"]["PROGRAM_GOAL_DESCRIPTION_2"]["DISPLAY_VALUE"]) { ?>
                    <div class="section__desc-default-hidden">
                        <div class="row">
                            <? if ($arResult["DISPLAY_PROPERTIES"]["PROGRAM_GOAL_DESCRIPTION"]["DISPLAY_VALUE"]) { ?>
                                <div class="col-lg-6"><?= $arResult["DISPLAY_PROPERTIES"]["PROGRAM_GOAL_DESCRIPTION"]["DISPLAY_VALUE"]; ?>
                                </div>
                            <? } ?>
                            <? if ($arResult["DISPLAY_PROPERTIES"]["PROGRAM_GOAL_DESCRIPTION_2"]["DISPLAY_VALUE"]) { ?>
                                <div class="col-lg-6"><?= $arResult["DISPLAY_PROPERTIES"]["PROGRAM_GOAL_DESCRIPTION_2"]["DISPLAY_VALUE"]; ?>
                                </div>
                            <? } ?>
                        </div>
                    </div>
                    <a href="#projects-detail-desc" data-toggle-activity="#projects-detail-desc" class="text-size-lg section__desc-toggler"><span class="txt-show">Читать описание</span><span class="txt-hide">Скрыть описание</span></a>
                <? } ?>

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
                            <h5 class="section__title">Документы программы</h5>
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
                                        <div class="document-item__info"><?= strtoupper(pathinfo($arFile["SRC"], PATHINFO_EXTENSION)); ?>, <?= $showSize ?></div>
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

<? if (!empty($arResult["DISPLAY_PROPERTIES"]["PROGRAM_NUMBERS"]["DISPLAY_VALUE"])) { ?>
    <section class="projects-detail-digits">
        <div class="container">
            <div class="items-list">
                <div class="row">
                    <? foreach ($arResult["DISPLAY_PROPERTIES"]["PROGRAM_NUMBERS"]["DISPLAY_VALUE"] as $num => $val) { ?>
                        <div class="col-sm-6 col-lg-4">
                            <div class="list-item main-digits-item">
                                <div class="h2 main-digits-item__title"><?= $val ?></div>
                                <div class="text-size-lg main-digits-item__text"><?= $arResult["DISPLAY_PROPERTIES"]["PROGRAM_NUMBERS"]["DESCRIPTION"][$num] ?></div>
                            </div>
                        </div>
                    <? } ?>
                </div>
            </div>
        </div>
    </section>
<? } ?>