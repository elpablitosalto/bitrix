<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? if (!empty($arResult['SECTIONS'])) : ?>
    <div class="section section_style_cream section_role_product-categories">
        <div class="section__header">
            <div class="section__container page__container">
                <div class="section__title">
                    <!-- begin .title-->
                    <h2 class="title title_size_h3 title_style_dependent"><?= (!empty($arParams['SECTION_TITLE_TEXT']) ? $arParams['SECTION_TITLE_TEXT'] : 'Все линии ухода') ?></h2>
                    <!-- end .title-->
                </div>
            </div>
        </div>
        <div class="section__content">
            <div class="page__container">
                <div class="section__product-grid">
                    <!-- begin .product-grid-->
                    <div class="product-grid product-grid_size_s">
                        <ul class="product-grid__list">
                            <? foreach ($arResult['SECTIONS'] as $index => $arSection) : ?>
                                <? $image = CFile::ResizeImageGet($arSection['PICTURE'], array('width' => 692, 'height' => 692), BX_RESIZE_IMAGE_PROPORTIONAL, true); ?>
                                <li class="product-grid__item">
                                    <!-- begin .product-snippet-->
                                    <div class="product-snippet product-grid__snippet">
                                        <? if (!empty($arSection['DETAIL_PICTURE'])) : ?>
                                            <?
                                            $bgImage = CFile::ResizeImageGet($arSection['DETAIL_PICTURE'], array('width' => 1999, 'height' => 1008), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                                            ?>
                                            <div class="product-snippet__background">
                                                <picture class="product-snippet__picture">
                                                    <img class="product-snippet__image js_lazy" data-src="<?= $bgImage['src'] ?>"  alt="<?= $arSection["NAME"] ?>" title="<?= $arSection["NAME"] ?>" aria-hidden="aria-hidden" role="presentation" />
                                                </picture>
                                            </div>
                                        <? endif; ?>
                                        <div class="product-snippet__label"><?= $arParams["ROOT_SECTION_NAME"] ?></div>
                                        <div class="product-snippet__title">
                                            <a href="<?= $arSection['SECTION_PAGE_URL'] ?>" class="product-snippet__link">
                                                <?= $arSection["NAME"] ?>
                                            </a>
                                        </div>
                                        <a href="<?= $arSection['SECTION_PAGE_URL'] ?>" class="product-snippet__illustration">
                                            <picture class="product-snippet__picture">
                                                <img class="product-snippet__image js_lazy" data-src="<?= $image["src"] ?>" alt="<?= $arSection["NAME"] ?>" title="<?= $arSection["NAME"] ?>" />
                                            </picture>
                                        </a>
                                    </div>
                                    <!-- end .product-snippet-->
                                </li>
                            <? endforeach; ?>
                        </ul>
                    </div>
                    <!-- end .product-grid-->
                </div>
            </div>
        </div>
    </div>
<? endif; ?>