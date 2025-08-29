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

<? if (!empty($arResult["ITEMS"])) { ?>

    <section class="volunteerism-reviews">
        <div class="container">
            <div class="reviews-slider">
                <div class="section__head">
                    <h3 class="section__title">Отзывы наших добровольцев</h3>
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
                    <div class="swiper-wrapper">
                        <?
                        foreach ($arResult["ITEMS"] as $key => $val) {
                        ?>
                            <div class="swiper-slide">
                                <div class="list-item reviews-item">
                                    <div class="text-size-lg reviews-item__text"><?=$val["DETAIL_TEXT"];?></div>
                                    <div class="reviews-item__text-toggler">
                                        <a href="<?=$val["DETAIL_PAGE_URL"];?>" class="txt-show">
                                            <u>Подробнее</u>
                                        </a>
                                        <a href="#" class="txt-hide">
                                            <u>Скрыть</u>
                                        </a>
                                    </div>
                                    <div class="reviews-item__person">
                                        <div class="reviews-item__person-photo">
                                            <picture>
                                                <img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?=$val["PREVIEW_PICTURE"]["SRC"];?>" loading="lazy" alt="" title="" />
                                            </picture>
                                        </div>
                                        <div class="reviews-item__person-content">
                                            <div class="h6 reviews-item__person-name"><?=$val["NAME"];?></div>
                                            <div class="text-size-sm reviews-item__person-info"><?=$val["PREVIEW_TEXT"];?></div>
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