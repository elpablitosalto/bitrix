<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
<? if (empty($_REQUEST["AJAX_CALL"]) || $_REQUEST["AJAX_CALL"] != "Y") : ?>
    <ul class="product-grid__list" data-ajax-container="sectionPage.list">
    <? endif; ?>
    <? foreach ($arResult['ITEMS'] as $arProduct) : ?>
        <li class="product-grid__item">
            <!-- begin .product-snippet-->
            <div class="product-snippet product-grid__snippet">
                <? if (!empty($arProduct['PROPERTIES']['SECONDARY_IMAGE']['VALUE'])) : ?>
                    <?
                    $bgImage = CFile::ResizeImageGet($arProduct['PROPERTIES']['SECONDARY_IMAGE']['VALUE'], array('width' => 1999, 'height' => 1008), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                    $mobileImg = CFile::ResizeImageGet($arProduct['PROPERTIES']['SECONDARY_IMAGE']['VALUE'], array('width' => 425, 'height' => 692), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                    ?>
                    <div class="product-snippet__background">
                        <picture class="product-snippet__picture">
                            <source srcset="<?= $mobileImg['src'] ?>" type="image/jpeg" media="(max-width: 425px)" />
                            <img src="<?= $bgImage['src'] ?>" alt aria-hidden="aria-hidden" role="presentation" class="product-snippet__image" />
                        </picture>
                    </div>
                <? endif; ?>
                <div class="product-snippet__label"><?= $arProduct["NAME"] ?></div>
                <div class="product-snippet__title">
                    <a href="<?= $arProduct["DETAIL_PAGE_URL"] ?>" class="product-snippet__link">
                        <?= htmlspecialchars_decode($arProduct["PREVIEW_TEXT"]) ?>
                    </a>
                </div>
                <a href="<?= $arProduct["DETAIL_PAGE_URL"] ?>" class="product-snippet__illustration">
                    <?
                    $arImage = CFile::ResizeImageGet($arProduct["PREVIEW_PICTURE"]["ID"], array('width' => 692, 'height' => 692), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                    $mobileImg = CFile::ResizeImageGet($arProduct["PREVIEW_PICTURE"]["ID"], array('width' => 425, 'height' => 692), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                    ?>
                    <picture class="product-snippet__picture">
                        <source srcset="<?= $mobileImg['src'] ?>" type="image/jpeg" media="(max-width: 425px)" />
                        <img src="<?= $arImage["src"] ?>" alt="<?= $arProduct["NAME"] ?>" class="product-snippet__image" title="" />
                    </picture>
                </a>
                <div class="product-snippet__choice-group">
                    <!-- begin .choice-group-->
                    <? if (!empty($arProduct["PRODUCT_VARIANTS"]) && !empty($arProduct["PRODUCT_VARIANTS"]["PROPERTY_VALUES"])) : ?>
                        <div class="choice-group">
                            <ul class="choice-group__list">
                                <? foreach ($arProduct["PRODUCT_VARIANTS"]["PROPERTY_VALUES"] as $propValue) : ?>
                                    <li class="choice-group__item">
                                        <label class="choice-group__label">
                                            <span class="choice-group__tooltip">
                                                <?= $arProduct["PRODUCT_VARIANTS"]["PROPERTY_NAME"] ?>
                                            </span>
                                            <input class="choice-group__input" type="radio" name="product-filter-<?= $arProduct["ID"] ?>-<?= $arProduct["PRODUCT_VARIANTS"]["PROPERTY_CODE"] ?>" />
                                            <span class="choice-group__panel"><?= $propValue["UF_NAME"] ?></span>
                                        </label>
                                    </li>
                                <? endforeach; ?>
                            </ul>
                        </div>
                    <? endif; ?>
                    <!-- end .choice-group-->
                </div>
            </div>
            <!-- end .product-snippet-->
        </li>
    <? endforeach; ?>
    <? if (empty($_REQUEST["AJAX_CALL"]) || $_REQUEST["AJAX_CALL"] != "Y") : ?>
    </ul>
    <div class="product-grid__controls">
    <? endif; ?>
    <? if (!empty($arResult["NAV_RESULT"]) && $arResult["NAV_RESULT"]->NavPageCount > 1 && $arResult["NAV_RESULT"]->NavPageNomer < $arResult["NAV_RESULT"]->NavPageCount) : ?>
        <div class="product-grid__control">
            <!-- begin .button-->
            <button class="button button_width_full button_type_skewed js-show-more" type="button" data-page-num="<?= ($arResult["NAV_RESULT"]->NavPageNomer + 1) ?>">
                <span class="button__holder">
                    <svg class="button__icon">
                        <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/mockup/dist/assets/images/icon.svg#icon_infinity"></use>
                    </svg>
                    <span class="button__text">Показать ещё</span>
                </span>
            </button>
            <!-- end .button-->
        </div>
    <? endif; ?>
    <? if (empty($_REQUEST["AJAX_CALL"]) || $_REQUEST["AJAX_CALL"] != "Y") : ?>
    </div>
<? endif; ?>