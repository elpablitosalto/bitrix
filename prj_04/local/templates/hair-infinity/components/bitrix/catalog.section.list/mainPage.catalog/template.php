<? if (!empty($arResult["SECTIONS"])) : ?>
    <div class="section section_style_gradient section_style_decorated-reverse section_role_catalog">
        <div class="section__header">
            <div class="section__container page__container">
                <div class="section__title">
                    <!-- begin .title-->
                    <h2 class="title title_size_h1">Каталог Infinity</h2>
                    <!-- end .title-->
                </div>
            </div>
        </div>
        <div class="section__content">
            <div class="page__container">
                <!-- begin .accordion-group-->
                <div class="accordion-group">
                    <ul class="accordion-group__list js-accordion-list">
                        <? foreach ($arResult["SECTIONS"] as $arSection) : ?>
                            <li class="accordion-group__item">
                                <!-- begin .accordion-->
                                <!--accordion_state_open-->
                                <div class="accordion js-accordion">
                                    <div class="accordion__header">
                                        <button type="button" class="accordion__trigger js-accordion-trigger">
                                            <?= $arSection["NAME"] ?>
                                        </button>
                                        <div class="accordion__note">
                                            <?= htmlspecialchars_decode($arSection["UF_MAIN_BLOCK_SMALL_DESC"]) ?>
                                        </div>
                                    </div>
                                    <div class="accordion__body">
                                        <div class="accordion__product-preview">
                                            <!-- begin .product-preview-->
                                            <div class="product-preview">
                                                <div class="product-preview__wrapper">
                                                    <div class="product-preview__showcase">
                                                        <div class="product-preview__illustration">
                                                            <picture class="product-preview__picture">
                                                                <img class="product-preview__image js_lazy" data-src="<?= $arSection["PICTURE"]["SRC"] ?>" width="<?= $arSection["PICTURE"]["WIDTH"] ?>" height="<?= $arSection["PICTURE"]["HEIGHT"] ?>" alt="<?= $arSection["NAME"] ?>" title="<?= $arSection["NAME"] ?>" />
                                                            </picture>
                                                        </div>
                                                    </div>
                                                    <div class="product-preview__info">
                                                        <? if (!empty($arSection["DESC_BLOCKS"])) : ?>
                                                            <? foreach ($arSection["DESC_BLOCKS"] as $arDescBlock) : ?>
                                                                <div class="product-preview__description-wrapper">
                                                                    <div class="product-preview__description">
                                                                        <div class="product-preview__description_title"><?= $arDescBlock["NAME"] ?>:</div>
                                                                        <div><?= htmlspecialchars_decode($arDescBlock["PREVIEW_TEXT"]) ?></div>
                                                                    </div>
                                                                    <div class="product-preview__properties">
                                                                        <!-- begin .properties-->
                                                                        <div class="properties">
                                                                            <ul class="properties__list">
                                                                                <? if (!empty($arDescBlock["PROPERTY_BLOCK_VOLUME_VALUE"])) : ?>
                                                                                    <li class="properties__item">
                                                                                        <div class="properties__label">
                                                                                            <div class="properties__label-text">
                                                                                                Объем:
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="properties__value">
                                                                                            <?= $arDescBlock["PROPERTY_BLOCK_VOLUME_VALUE"] ?>
                                                                                        </div>
                                                                                    </li>
                                                                                <? endif; ?>
                                                                                <? if (!empty($arDescBlock["PROPERTY_BLOCK_RANGE_VALUE"])) : ?>
                                                                                    <li class="properties__item">
                                                                                        <div class="properties__label">
                                                                                            <div class="properties__label-text">
                                                                                                Ассортимент:
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="properties__value">
                                                                                            <?= $arDescBlock["PROPERTY_BLOCK_RANGE_VALUE"] ?>
                                                                                        </div>
                                                                                    </li>
                                                                                <? endif; ?>
                                                                                <? if (!empty($arDescBlock["PROPERTY_BLOCK_PECULIARITIES_VALUE"])) : ?>
                                                                                    <li class="properties__item">
                                                                                        <div class="properties__label">
                                                                                            <div class="properties__label-text">
                                                                                                Особенности:
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="properties__value">
                                                                                            <?= $arDescBlock["PROPERTY_BLOCK_PECULIARITIES_VALUE"] ?>
                                                                                        </div>
                                                                                    </li>
                                                                                <? endif; ?>
                                                                            </ul>
                                                                        </div>
                                                                        <!-- end .properties-->
                                                                    </div>
                                                                    <? if (!empty($arDescBlock["PROPERTY_BLOCK_LINK_VALUE"])) : ?>
                                                                        <div class="product-preview__controls">
                                                                            <div class="product-preview__control">
                                                                                <!-- begin .button-->
                                                                                <a class="button button_width_full button_style_dashed-outline" href="<?= $arDescBlock["PROPERTY_BLOCK_LINK_VALUE"] ?>">
                                                                                    <span class="button__holder">
                                                                                        <svg class="button__icon">
                                                                                            <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/mockup/dist/assets/images/icon.svg#icon_infinity"></use>
                                                                                        </svg>
                                                                                        <span class="button__text">
                                                                                            Узнать подробнее
                                                                                        </span>
                                                                                    </span>
                                                                                </a>
                                                                                <!-- end .button-->
                                                                            </div>
                                                                        </div>
                                                                    <? endif; ?>
                                                                </div>
                                                            <? endforeach; ?>
                                                        <? endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end .product-preview-->
                                        </div>
                                    </div>
                                </div>
                                <!-- end .accordion-->
                            </li>
                        <? endforeach; ?>
                    </ul>
                </div>
                <!-- end .accordion-group-->
            </div>
        </div>
    </div>
<? endif; ?>