<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Type\DateTime;

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
<? if (!empty($arResult["ITEMS"])): ?>
    <div class="section">
        <div class="section__header section__header_type_inline">
            <div class="section__title">
                <!-- begin .title-->
                <h2 class="title title_size_h2">
                    Популярные статьи
                </h2>
                <!-- end .title-->
            </div>
        </div>
        <div class="section__content">
            <div class="section__cards-panel">
                <!-- no modifiers - panels take all available width, divinging equally up to three in one row-->
                <!-- promo-group_layout_l - one panel per row-->
                <!-- promo-group_layout_m - two panels per row-->
                <!-- promo-group_layout_s - three panels per row-->
                <!-- promo-group_layout_mixed - three panels every odd row, two panels every even row-->
                <!-- begin .cards-panel-->
                <div class="cards-panel cards-panel_layout_m cards-panel_role_articles cards-panel_panel-height_m">
                    <div class="cards-panel__container">
                        <div class="cards-panel__wrapper">
                            <? foreach ($arResult["ITEMS"] as $arItem): ?>
                                <?
                                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                                $backgroundImg = SITE_TEMPLATE_PATH."/assets/blocks/service-item/images/16.png";
                                if(!empty($arItem["PROPERTIES"]["FAVORITE_IMAGE"]["VALUE"])){
                                    $backgroundImg = \CFile::GetPath($arItem["PROPERTIES"]["FAVORITE_IMAGE"]["VALUE"]);
                                }?>
                                <div class="cards-panel__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                                    <!-- begin .service-item-->
                                    <a class="service-item service-item_style_primary service-item_role_articles cards-panel__panel" href="<?= $arItem["DETAIL_PAGE_URL"] ?>">
                                        <div class="service-item__content">
                                            <?if(!empty($backgroundImg)):?>
                                                <div class="service-item__background">
                                                    <picture class="service-item__picture">
                                                        <img src="<?= $backgroundImg ?>"
                                                            alt="<?= $arItem["NAME"] ?>" class="service-item__image"
                                                            title=""/>
                                                    </picture>
                                                </div>
                                            <?endif;?>
                                            <div class="service-item__header">
                                                <div class="service-item__tags">
                                                    <div class="service-item__tag">
                                                        <!-- begin .label-->
                                                        <? if (!empty($arItem["SECTION_NAME"])): ?>
                                                            <div class="label label_style_dashed">
                                                                <?= $arItem["SECTION_NAME"] ?>
                                                            </div>
                                                        <? endif; ?>
                                                        <!-- end .label-->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="service-item__favorite">
                                                <!-- begin .button-->
                                                <?if(!empty($arItem["PROPERTIES"]["FAVORITE"]["VALUE"])):?>
                                                    <button class="button button_size_sm button_style_bright" type="button"
                                                            aria-label="В избранное">
                                                        <span class="button__holder">
                                                            <svg class="button__icon" x="0px" y="0px" viewBox="-3 -3 30 30"><path
                                                                        class="button__icon-fill"
                                                                        d="M10.2,1.6c0.7-1.5,2.9-1.5,3.6,0L15.9,6c0.3,0.6,0.9,1,1.5,1.1l4.8,0.7c1.6,0.2,2.3,2.3,1.1,3.4l-3.5,3.4c-0.5,0.5-0.7,1.1-0.6,1.8l0.8,4.8c0.3,1.6-1.4,2.9-2.9,2.1L12.9,21c-0.6-0.3-1.3-0.3-1.9,0l-4.3,2.3c-1.5,0.8-3.2-0.5-2.9-2.1l0.8-4.8c0.1-0.6-0.1-1.3-0.6-1.8l-3.5-3.4C-0.6,10,0.1,8,1.7,7.8l4.8-0.7C7.2,7,7.8,6.6,8.1,6L10.2,1.6z"/><path
                                                                        fill="transparent" stroke="currentColor"
                                                                        stroke-width="2"
                                                                        d="M11.1,2.1c0.4-0.7,1.4-0.7,1.8,0L15,6.4c0.4,0.9,1.3,1.5,2.3,1.6l4.8,0.7c0.8,0.1,1.1,1.1,0.6,1.7l-3.5,3.4c-0.7,0.7-1,1.7-0.9,2.7l0.8,4.8c0.1,0.8-0.7,1.4-1.5,1.1l-4.3-2.3c-0.9-0.5-1.9-0.5-2.8,0l-4.3,2.3c-0.7,0.4-1.6-0.2-1.5-1.1l0.8-4.8c0.2-1-0.2-2-0.9-2.7l-3.5-3.4C0.7,9.9,1.1,8.9,1.9,8.8l4.8-0.7c1-0.1,1.8-0.8,2.3-1.6L11.1,2.1z"/></svg>
                                                        </span>
                                                    </button>
                                                <? endif; ?>
                                                <!-- end .button-->
                                            </div>
                                            <div class="service-item__main">
                                                <span class="service-item__format"><?= $arItem["PROPERTIES"]["FORMAT"]["VALUE"] ?></span>
                                                <div class="service-item__title">
                                                    <?= $arItem["NAME"] ?>
                                                </div>
                                                <div class="service-item__controls">
                                                    <div class="service-item__controls">
                                                        <!-- begin .button-->
                                                        <span class="button button_role_article">
                                                            <span class="button__holder">
                                                                <span class="button__text">Читать</span>
                                                            </span>
                                                        </span>
                                                        <!-- end .button-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <!-- end .service-item-->
                                </div>
                            <? endforeach; ?>
                        </div>
                    </div>
                </div>
                <!-- end .cards-panel-->
            </div>
        </div>
    </div>
<? endif; ?>