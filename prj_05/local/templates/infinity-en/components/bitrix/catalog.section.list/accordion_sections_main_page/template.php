<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
<? if (!empty($arResult['SECTIONS'])) { ?>
    <div class="section section_style_decorated-reverse section_style_gradient section_role_catalog">
        <div class="section__main">
            <div class="section__header">
                <div class="section__header-container page__container">
                    <div class="section__title">
                        <!-- begin .title-->
                        <h2 class="title title_size_h1 title_style_primary"><?= GetMessage("ACCORDION_SECTIONS_MAIN_PAGE_H2") ?>
                        </h2>
                        <!-- end .title-->
                    </div>
                </div>
            </div>
            <div class="section__content">
                <div class="page__container">
                    <!-- begin .accordion-group-->
                    <div class="accordion-group">
                        <ul class="accordion-group__list js-accordion-list">
                            <? foreach ($arResult['SECTIONS'] as $k => $arSection) { ?>
                                <?
                                $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
                                $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
                                ?>
                                <li class="accordion-group__item" id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
                                    <!-- begin .accordion-->
                                    <div class="accordion js-accordion">
                                        <div class="accordion__header">
                                            <button class="accordion__trigger js-accordion-trigger" type="button"><?= $arSection["NAME"] ?>
                                            </button>
                                            <div class="accordion__note"><?= htmlspecialchars_decode($arSection["UF_MAIN_BLOCK_SMALL_DESC"]) ?>
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
                                                                    <img src="<?= $arSection['PICTURE_SLIDER']['SRC']; ?>" alt="<?= $arSection['PICTURE_SLIDER']["ALT"] ?>" title="<?= $arSection['PICTURE_SLIDER']["TITLE"] ?>" class="product-preview__image" />
                                                                </picture>
                                                            </div>
                                                        </div>
                                                        <div class="product-preview__info">
                                                            <? if (!empty($arSection["DESC_BLOCKS"])) { ?>
                                                                <? foreach ($arSection["DESC_BLOCKS"] as $arDescBlock) { ?>
                                                                    <div class="product-preview__description">
                                                                        <?= htmlspecialchars_decode($arDescBlock["PREVIEW_TEXT"]) ?>
                                                                    </div>
                                                                    <div class="product-preview__properties">
                                                                        <!-- begin .properties-->
                                                                        <div class="properties">
                                                                            <ul class="properties__list">
                                                                                <? if (!empty($arDescBlock["PROPERTY_BLOCK_VOLUME_VALUE"])) : ?>
                                                                                    <li class="properties__item">
                                                                                        <div class="properties__label">
                                                                                            <div class="properties__label-text">
                                                                                                <?= GetMessage("ACCORDION_SECTIONS_MAIN_PAGE_VOLUME") ?>:
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
                                                                                                <?= GetMessage("ACCORDION_SECTIONS_MAIN_PAGE_ASSORTMENT") ?>:
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
                                                                                                <?= GetMessage("ACCORDION_SECTIONS_MAIN_PAGE_FEATURES") ?>:
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
                                                                    <? if (!empty($arDescBlock["PROPERTY_BLOCK_LINK_VALUE"])) { ?>
                                                                        <div class="product-preview__controls">
                                                                            <div class="product-preview__control">
                                                                                <!-- begin .button-->
                                                                                <a class="button button_width_full button_weight_bold button_style_dashed-outline" href="<?= $arDescBlock["PROPERTY_BLOCK_LINK_VALUE"] ?>">
                                                                                    <span class="button__holder">
                                                                                        <svg class="button__icon">
                                                                                            <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/mockup/dist/assets/images/icon.svg#icon_infinity"></use>
                                                                                        </svg><span class="button__text"><?= GetMessage("ACCORDION_SECTIONS_MAIN_PAGE_LEARN_MORE") ?></span></span>
                                                                                </a>
                                                                                <!-- end .button-->
                                                                            </div>
                                                                        </div>
                                                                    <? } ?>
                                                                    <br />
                                                                <? } ?>
                                                            <? } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end .product-preview-->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end .accordion-->
                                </li>
                            <? } ?>
                        </ul>
                    </div>
                    <!-- end .accordion-group-->
                </div>
            </div>
        </div>
    </div>
<? } ?>