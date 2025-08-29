<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Grid\Declension;

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
//vardump($arResult["ITEMS"]);
?>

<? if (!empty($arResult["ITEMS"])) {
?>

    <section class="main-news">
        <div class="container">
            <h2 class="h3 section__title tablet-hidden">Фонд сегодня</h2>
            <div class="row align-items-height">
                <div class="col-lg-8">
                    <div class="main-news-slider">
                        <div class="section__head tablet-visible">
                            <h2 class="h3 section__title">Фонд сегодня</h2>
                            <div class="section__nav">
                                <div class="swiper-nav lg">
                                    <button type="button" class="swiper-button prev">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-drop-light">
                                            <use xlink:href="#drop-light"></use>
                                        </svg>
                                    </button>
                                    <button type="button" class="swiper-button next">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-drop-light">
                                            <use xlink:href="#drop-light"></use>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-container items-list">
                            <div class="swiper-wrapper align-items-height">
                                <?
                                foreach ($arResult["ITEMS"] as $key => $item) {
                                    $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
                                    $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

                                ?>
                                    <? if ($item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"]) { ?>
                                        <div class="swiper-slide" id="<?= $this->GetEditAreaId($item['ID']); ?>">
                                            <a href="<?= $item["DETAIL_PAGE_URL"] ?>" target="_self" class="list-item main-news-item">
                                                <? if ($item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"]) { ?>
                                                    <div class="main-news-item__image">
                                                        <picture>
                                                            <img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= $item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"] ?>" loading="lazy" alt="<?= $item["PREVIEW_PICTURE"]["ALT"] ?>" title="<?= $item["PREVIEW_PICTURE"]["TITLE"] ?>" />
                                                        </picture>
                                                    </div>
                                                <? } ?>
                                                <? if ($item["DISPLAY_PROPERTIES"]["PUBLICATION_TYPE"]["DISPLAY_VALUE"]) { ?>
                                                    <div class="main-news-item__category"><span class="btn btn-xs"><?= $item["DISPLAY_PROPERTIES"]["PUBLICATION_TYPE"]["DISPLAY_VALUE"] ?></span>
                                                    </div>
                                                <? } ?>
                                                <div class="h6 main-news-item__title"><?= $item["NAME"] ?>
                                                </div>
                                                <? if (mb_strlen($item["PREVIEW_TEXT"])) { ?>
                                                    <div class="main-news-item__text"><?= $item["PREVIEW_TEXT"] ?>
                                                    </div>
                                                <? } ?>
                                            </a>
                                        </div>
                                    <? } else { ?>
                                        <div class="swiper-slide" id="<?= $this->GetEditAreaId($item['ID']); ?>">
                                            <a href="<?= $item["DETAIL_PAGE_URL"] ?>" target="_self" class="list-item main-news-item">
                                                <? if ($item["DISPLAY_PROPERTIES"]["PUBLICATION_TYPE"]["DISPLAY_VALUE"]) { ?>
                                                    <div class="main-news-item__category">
                                                        <span class="btn btn-xs"><?= $item["DISPLAY_PROPERTIES"]["PUBLICATION_TYPE"]["DISPLAY_VALUE"] ?></span>
                                                    </div>
                                                <? } ?>
                                                <div class="h6 main-news-item__title"><?= $item["NAME"] ?></div>
                                                <? if (mb_strlen($item["PREVIEW_TEXT"])) { ?>
                                                    <div class="main-news-item__text"><?= $item["PREVIEW_TEXT"] ?>
                                                    </div>
                                                <? } ?>
                                                <div class="main-news-item__decor">
                                                    <picture>
                                                        <img class="lazyload" src="<?=SITE_TEMPLATE_PATH?>/images/loader.svg" data-src="<?=SITE_TEMPLATE_PATH?>/images/pdmi-orange-thin.png" loading="lazy" alt="" title="" />
                                                    </picture>
                                                </div>
                                            </a>
                                        </div>
                                    <? } ?>
                                <?
                                }
                                ?>
                            </div>
                        </div>
                        <div class="swiper-nav desktop-visible">
                            <button type="button" class="swiper-button prev">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-drop">
                                    <use xlink:href="#drop"></use>
                                </svg>
                            </button>
                            <button type="button" class="swiper-button next">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-drop">
                                    <use xlink:href="#drop"></use>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="main-news-list">
                        <div class="swiper-container items-list">
                            <div class="swiper-wrapper">
                                <? foreach ($arResult["ITEMS2"] as $key => $item) {
                                ?>
                                    <div class="swiper-slide main-news-list__item-wrapper"><a href="<?= $item["DETAIL_PAGE_URL"] ?>" target="_self" class="list-item main-news-item simple">
                                            <div class="h6 main-news-item__title"><?= $item["NAME"] ?>
                                            </div>
                                            <div class="text-size-sm main-news-item__date"><?= $item["ACTIVE_FROM"] ?></div>
                                        </a>
                                    </div>
                                <? } ?>
                            </div>
                        </div>
                        <div class="section__nav"><a href="/news/" target="_self">
                                <u>Все новости</u>
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-arrow">
                                    <use xlink:href="#arrow"></use>
                                </svg>
                            </a></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<? } ?>