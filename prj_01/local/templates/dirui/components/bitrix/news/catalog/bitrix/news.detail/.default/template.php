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

<section class="product-card">
    <div class="product-card__head">
        <div class="product-card__info">
            <h2 class="product-card__title"><?= $arResult["NAME"] ?></h2>
            <h3 class="product-card__subtitle"><?= $arResult["DISPLAY_PROPERTIES"]["CATEGORY"]["VALUE"] ?></h3>
        </div>
        <div class="product-card__btns">
            <a href="#product-docs">Документация</a>
            <a href="#product-reagents" class="link-button_grey">Реагенты</a>
            <a class="link-button_rose" href="#callback">Связаться с нами</a>
        </div>
    </div>
    <div class="product-card__wrapper">
        <ul class="product-card__features-list">
            <? foreach ($arResult["DISPLAY_PROPERTIES"]["FEATURES_TOP"]["VALUE"] as $type) { ?>
                <li class="product-card__feature">
                    <?= $type ?>
                </li>
            <? } ?>
        </ul>
        <? if (isset($arResult["PREVIEW_PICTURE"]["ID"])) { ?>
            <div class="product-card__main-img">
                <picture>
                    <img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/img/icons/loader.svg"
                         data-src="<?= $arResult["PREVIEW_PICTURE"]["SRC"] ?>" loading="lazy"
                         alt="<?= $arResult["PREVIEW_PICTURE"]["ALT"] ?>"
                         title="<?= $arResult["PREVIEW_PICTURE"]["TITLE"] ?>"/>
                </picture>
            </div>
        <? } ?>
    </div>
</section>

<section class="product-detail">
    <div class="page-wrapper">
        <div class="page-menu">
            <div class="product-detail__model"><?= $arResult["NAME"] ?></div>
            <ul class="page-menu__list">
                <li class="page-menu__item">
                    <a class="page-menu__link page-menu__link_active" href="#product-info">
                        Описание
                    </a>
                </li>
                <li class="page-menu__item">
                    <a class="page-menu__link" href="#product-features">
                        Преимущества
                    </a>
                </li>
                <li class="page-menu__item">
                    <a class="page-menu__link" href="#product-details">
                        Детали
                    </a>
                </li>
                <li class="page-menu__item">
                    <a class="page-menu__link" href="#product-chat">
                        Характеристики
                    </a>
                </li>
                <li class="page-menu__item">
                    <a class="page-menu__link" href="#product-reagents">
                        Реагенты
                    </a>
                </li>
                <li class="page-menu__item">
                    <a class="page-menu__link" href="#product-docs">
                        Документация и обучение
                    </a>
                </li>
            </ul>
            <div class="page-menu__wrapper">
                <? if (isset($arResult["DISPLAY_PROPERTIES"]["CONTACT_NAME"]["DISPLAY_VALUE"]) || isset($arResult["DISPLAY_PROPERTIES"]["CONTACT_EMAIL"]["DISPLAY_VALUE"]) || isset($arResult["DISPLAY_PROPERTIES"]["CONTACT_PHONE"]["DISPLAY_VALUE"])) { ?>
                    <div class="page-menu__description">Контактное лицо:</div>
                    <div class="page-menu__contact">
                        <? if ($arResult["DISPLAY_PROPERTIES"]["CONTACT_NAME"]["DISPLAY_VALUE"]) { ?>
                            <div class="page-menu__name"><?= $arResult["DISPLAY_PROPERTIES"]["CONTACT_NAME"]["DISPLAY_VALUE"] ?></div>
                        <? } ?>
                        <? if ($arResult["DISPLAY_PROPERTIES"]["CONTACT_EMAIL"]["DISPLAY_VALUE"]) { ?>
                            <a class="partnership__contact"
                               href="mailto:<?= $arResult["DISPLAY_PROPERTIES"]["CONTACT_EMAIL"]["DISPLAY_VALUE"] ?>"><?= $arResult["DISPLAY_PROPERTIES"]["CONTACT_EMAIL"]["DISPLAY_VALUE"] ?></a>
                        <? } ?>
                        <? if ($arResult["DISPLAY_PROPERTIES"]["CONTACT_PHONE"]["DISPLAY_VALUE"]) { ?>
                            <a class="partnership__contact"
                               href="tel:<?= $arResult["DISPLAY_PROPERTIES"]["CONTACT_PHONE"]["DISPLAY_VALUE"] ?>"><?= $arResult["DISPLAY_PROPERTIES"]["CONTACT_PHONE"]["DISPLAY_VALUE"] ?></a>
                        <? } ?>
                        <? if ($arResult["DISPLAY_PROPERTIES"]["CONTACT_PHONE"]["DISPLAY_VALUE"]) { ?>
                            <a href="tel:<?= $arResult["DISPLAY_PROPERTIES"]["CONTACT_PHONE"]["DISPLAY_VALUE"] ?>"
                               class="link-button_rose">Связаться с нами</a>
                        <? } elseif ($arResult["DISPLAY_PROPERTIES"]["CONTACT_EMAIL"]["DISPLAY_VALUE"]) { ?>
                            <a href="mailto:<?= $arResult["DISPLAY_PROPERTIES"]["CONTACT_EMAIL"]["DISPLAY_VALUE"] ?>"
                               class="link-button_rose">Связаться с нами</a>
                        <? } ?>
                    </div>
                <? } ?>
            </div>
        </div>
        <div class="product-detail__content">
            <div class="product-detail__wrapper">
                <div class="product-detail__info documentation__anchor" id="product-info">
                    <? if (isset($arResult["DISPLAY_PROPERTIES"]["DETAIL_TEXT_HEAD"]["DISPLAY_VALUE"])) { ?>
                        <div class="product-detail__text"><?= $arResult["DISPLAY_PROPERTIES"]["DETAIL_TEXT_HEAD"]["DISPLAY_VALUE"] ?></div>
                    <? } ?>
                    <div class="product-detail__container">
                        <? if (isset($arResult["DETAIL_PICTURE"]["ID"])) { ?>
                            <div class="product-detail__main-img">
                                <picture>
                                    <img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/img/icons/loader.svg"
                                         data-src="<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>" loading="lazy"
                                         alt="<?= $arResult["DETAIL_PICTURE"]["ALT"] ?>"
                                         title="<?= $arResult["DETAIL_PICTURE"]["TITLE"] ?>"/>
                                </picture>
                            </div>
                        <? } ?>
                        <div class="product-detail__text-wrapper">
                            <?= $arResult["DETAIL_TEXT"] ?>
                        </div>
                    </div>
                    <? if (isset($arResult["REVIEW"]) && !empty($arResult["REVIEW"])) { ?>
                        <div class="product-detail__review">
                            <p><?= $arResult["REVIEW"]["PREVIEW_TEXT"] ?></p>
                            <div class="product-detail__review-from">
                                <? if (isset($arResult["REVIEW"]["PREVIEW_PICTURE_LINK"])) { ?>
                                    <div class="product-detail__review-img">
                                        <picture><img class="lazyload"
                                                      src="<?= SITE_TEMPLATE_PATH ?>/img/icons/loader.svg"
                                                      data-src="<?= $arResult["REVIEW"]["PREVIEW_PICTURE_LINK"] ?>"
                                                      loading="lazy" alt="<?= $arResult["REVIEW"]["NAME"] ?>"
                                                      title="<?= $arResult["REVIEW"]["NAME"] ?>"/>
                                        </picture>
                                    </div>
                                <? } ?>
                                <div class="product-detail__review-name">- <?= $arResult["REVIEW"]["NAME"] ?></div>
                            </div>
                        </div>
                    <? } ?>
                </div>
                <div class="product-detail__features documentation__anchor" id="product-features">
                    <div class="product-detail__text product-detail__text--red">
                        Преимущества <?= $arResult["NAME"] ?></div>
                    <? if (isset($arResult["DISPLAY_PROPERTIES"]["FEATURES_IMAGE"]["FILE_VALUE"]["SRC"]) && mb_strlen($arResult["DISPLAY_PROPERTIES"]["FEATURES_IMAGE"]["FILE_VALUE"]["SRC"])) { ?>
                        <div class="product-detail__features-img">
                            <picture><img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/img/icons/loader.svg"
                                          data-src="<?= $arResult["DISPLAY_PROPERTIES"]["FEATURES_IMAGE"]["FILE_VALUE"]["SRC"] ?>"
                                          loading="lazy" alt="<?= $arResult["NAME"] ?>"
                                          title="<?= $arResult["NAME"] ?>"/>
                            </picture>
                        </div>
                    <? } ?>
                    <? if (isset($arResult["DISPLAY_PROPERTIES"]["FEATURES"]["DISPLAY_VALUE"])) { ?>
                        <div class="product-detail__container">
                            <?= $arResult["DISPLAY_PROPERTIES"]["FEATURES"]["DISPLAY_VALUE"] ?>
                        </div>
                    <? } ?>
                    <? if (isset($arResult["OFFERS"]) && !empty($arResult["OFFERS"])) { ?>
                        <div class="product-detail__subtext"><?= $arResult["DISPLAY_PROPERTIES"]["OFFERS_TITLE"]["DISPLAY_VALUE"] ?></div>
                        <div class="product-detail__features-table">
                            <? foreach ($arResult["OFFERS"] as $offer) { ?>
                                <div class="c-custom-table2">
                                    <div class="c-custom-table2__item c-custom-table__item--title">
                                        <a <? if (mb_strlen($offer["PROPERTY_LINK_VALUE"])){ ?>href="<?= $offer["PROPERTY_LINK_VALUE"] ?>" <? } ?>
                                           class="pd_title"><?= $offer["NAME"] ?></a>
                                    </div>
                                    <div class="c-custom-table2__item c-custom-table__item--title">
                                        <?= $offer["PREVIEW_TEXT"] ?>
                                    </div>
                                    <div class="c-custom-table2__item c-custom-table__item--title">
                                        <?= $offer["DETAIL_TEXT"] ?>
                                    </div>
                                </div>
                                <? if (isset($offer["PREVIEW_PICTURE_LINK"])) { ?>
                                    <div class="product-detail__img-wrapper">
                                        <picture><img class="lazyload"
                                                      src="<?= SITE_TEMPLATE_PATH ?>/img/icons/loader.svg"
                                                      data-src="<?= $offer["PREVIEW_PICTURE_LINK"] ?>" loading="lazy"
                                                      alt="<?= $offer["NAME"] ?>"
                                                      title="<?= $offer["NAME"] ?>"/>
                                        </picture>
                                    </div>
                                <? } ?>
                            <? } ?>
                        </div>
                    <? } ?>
                    <? if (isset($arResult["DISPLAY_PROPERTIES"]["IMAGES"]["FILE_VALUE"]) && !empty($arResult["DISPLAY_PROPERTIES"]["IMAGES"]["FILE_VALUE"])) { ?>
                        <div class="product-detail__subtext"
                             id="product-details"><?= $arResult["DISPLAY_PROPERTIES"]["IMAGES_LIST_TITLE"]["DISPLAY_VALUE"] ?></div>
                        <div class="product-detail__collage">
                            <? foreach ($arResult["DISPLAY_PROPERTIES"]["IMAGES"]["FILE_VALUE"] as $num => $arFile) { ?>
                                <div class="product-detail__collage-item">
                                    <div class="product-detail__bg-img"
                                         style="background-image: url('<?= $arFile["SRC"] ?>')"></div>
                                    <p><?= $arResult["DISPLAY_PROPERTIES"]["IMAGES"]["DESCRIPTION"][$num] ?></p>
                                </div>
                            <? } ?>
                        </div>
                    <? } ?>
                    <? if (isset($arResult["DISPLAY_PROPERTIES"]["METHODS"]["DISPLAY_VALUE"]) && !empty($arResult["DISPLAY_PROPERTIES"]["METHODS"]["DISPLAY_VALUE"])) { ?>
                        <div class="product-detail__subtext product-detail__text--red">Программируемые методы</div>
                        <div class="product-detail__methods">
                            <? foreach ($arResult["DISPLAY_PROPERTIES"]["METHODS"]["DISPLAY_VALUE"] as $method) { ?>
                                <div class="product-card__label product-card--red-label"><?= $method ?></div>
                            <? } ?>
                        </div>
                    <? } ?>
                </div>
            </div>
            <div class="product-detail__detailst documentation__anchor" id="product-details">
                <div class="product-detail__text" id="product-chat"><span><?= $arResult["NAME"] ?></span> в деталях
                </div>
                <? if (isset($arResult["DISPLAY_PROPERTIES"]["PICTURE_IN_DETAILS"]["FILE_VALUE"]["SRC"]) && mb_strlen($arResult["DISPLAY_PROPERTIES"]["PICTURE_IN_DETAILS"]["FILE_VALUE"]["SRC"])) { ?>
                    <div class="product-detail__detail-img">
                        <picture>
                            <img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/img/icons/loader.svg"
                                 data-src="<?= $arResult["DISPLAY_PROPERTIES"]["PICTURE_IN_DETAILS"]["FILE_VALUE"]["SRC"] ?>"
                                 loading="lazy" alt="<?= $arResult["NAME"] ?>" title="<?= $arResult["NAME"] ?>"/>
                        </picture>
                    </div>
                <? } ?>
            </div>
            <? if (isset($arResult["DISPLAY_PROPERTIES"]["CHARACTERISTICS"]["DISPLAY_VALUE"]) && !empty($arResult["DISPLAY_PROPERTIES"]["CHARACTERISTICS"]["DISPLAY_VALUE"])) { ?>
                <div class="product-detail__all-chars documentation__anchor" id="product-chat">
                    <div class="product-detail__text">Все характеристики <?= $arResult["NAME"] ?></div>
                    <div class="c-custom-table2">
                        <? foreach ($arResult["DISPLAY_PROPERTIES"]["CHARACTERISTICS"]["DISPLAY_VALUE"] as $num => $val) { ?>
                            <div class="c-custom-table2__item c-custom-table__item--title"><?= $val ?></div>
                            <div class="c-custom-table2__item c-custom-table__item--title">
                                <?= $arResult["DISPLAY_PROPERTIES"]["CHARACTERISTICS"]["DESCRIPTION"][$num] ?>
                            </div>
                        <? } ?>
                    </div>
                </div>
            <? } ?>
            <? if (isset($arResult["DISPLAY_PROPERTIES"]["MATERIALS"]["DISPLAY_VALUE"]) && !empty($arResult["DISPLAY_PROPERTIES"]["MATERIALS"]["DISPLAY_VALUE"])) { ?>
                <div class="product-detail__stuff documentation__anchor" id="product-reagents">
                    <div class="product-detail__text">Расходные материалы для <?= $arResult["NAME"] ?></div>
                    <div class="c-custom-table3">
                        <? foreach ($arResult["DISPLAY_PROPERTIES"]["MATERIALS"]["DISPLAY_VALUE"] as $num => $val) { ?>
                            <div class="c-custom-table3__item c-custom-table__item--title"><?= $val ?></div>
                        <? } ?>
                    </div>
                </div>
            <? } ?>
        </div>
    </div>
</section>

<section class="product-manual" id="product-docs">
    <section class="product-manual" id="product-docs">
        <h2>Документация и обучение</h2>
        <? if (isset($arResult["DISPLAY_PROPERTIES"]["DOCS"]["FILE_VALUE"]) && !empty($arResult["DISPLAY_PROPERTIES"]["DOCS"]["FILE_VALUE"])) { ?>
            <div class="product-manual__links">
                <? foreach ($arResult["DISPLAY_PROPERTIES"]["DOCS"]["FILE_VALUE"] as $num => $file) { ?>
                    <a target="_blank" href="<?= $file["SRC"] ?>"
                       class="product-manual__link underline-link underline-link__black">
                        <?= (mb_strlen($arResult["DISPLAY_PROPERTIES"]["DOCS"]["DESCRIPTION"][$num]) > 0) ? $arResult["DISPLAY_PROPERTIES"]["DOCS"]["DESCRIPTION"][$num] : $file["ORIGINAL_NAME"] ?>
                    </a>
                <? } ?>
            </div>
        <? } ?>
        <? if (isset($arResult["DISPLAY_PROPERTIES"]["DOCS_VIDEO"]["FILE_VALUE"]) && !empty($arResult["DISPLAY_PROPERTIES"]["DOCS_VIDEO"]["FILE_VALUE"])) { ?>
            <ul class="base__list">
                <? foreach ($arResult["DISPLAY_PROPERTIES"]["DOCS_VIDEO"]["FILE_VALUE"] as $num => $file) { ?>
                    <li class="base__item">
                        <div class="base__video" data-link-video="<?= $file["SRC"] ?>"><img src="<?= SITE_TEMPLATE_PATH ?>/img/content/reagents/banner.jpg" alt="">
                            <svg width="20" height="25">
                                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons/sprite/svg-sprite.svg#play"></use>
                            </svg>
                        </div>
                        <?= (mb_strlen($arResult["DISPLAY_PROPERTIES"]["DOCS_VIDEO"]["DESCRIPTION"][$num]) > 0) ? $arResult["DISPLAY_PROPERTIES"]["DOCS_VIDEO"]["DESCRIPTION"][$num] : $file["ORIGINAL_NAME"] ?>
                    </li>
                <? } ?>
            </ul>
        <? } ?>
    </section>

</section>
