<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use Bitrix\Catalog\ProductTable;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 *
 *  _________________________________________________________________________
 * |    Attention!
 * |    The following comments are for system use
 * |    and are required for the component to work correctly in ajax mode:
 * |    <!-- items-container -->
 * |    <!-- pagination-container -->
 * |    <!-- component-end -->
 */

$this->setFrameMode(true);
$this->addExternalCss('/bitrix/css/main/bootstrap.css');

if (!empty($arResult['NAV_RESULT'])) {
    $navParams = array(
        'NavPageCount' => $arResult['NAV_RESULT']->NavPageCount,
        'NavPageNomer' => $arResult['NAV_RESULT']->NavPageNomer,
        'NavNum' => $arResult['NAV_RESULT']->NavNum
    );
} else {
    $navParams = array(
        'NavPageCount' => 1,
        'NavPageNomer' => 1,
        'NavNum' => $this->randString()
    );
}

$showTopPager = false;
$showBottomPager = false;
$showLazyLoad = false;

if ($arParams['PAGE_ELEMENT_COUNT'] > 0 && $navParams['NavPageCount'] > 1) {
    $showTopPager = $arParams['DISPLAY_TOP_PAGER'];
    $showBottomPager = $arParams['DISPLAY_BOTTOM_PAGER'];
    $showLazyLoad = $arParams['LAZY_LOAD'] === 'Y' && $navParams['NavPageNomer'] != $navParams['NavPageCount'];
}

$templateLibrary = array('popup', 'ajax', 'fx');
$currencyList = '';

if (!empty($arResult['CURRENCIES'])) {
    $templateLibrary[] = 'currency';
    $currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}

$templateData = array(
    'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
    'TEMPLATE_LIBRARY' => $templateLibrary,
    'CURRENCIES' => $currencyList,
    'USE_PAGINATION_CONTAINER' => $showTopPager || $showBottomPager,
);
unset($currencyList, $templateLibrary);

$elementEdit = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT');
$elementDelete = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE');
$elementDeleteParams = array('CONFIRM' => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));

$positionClassMap = array(
    'left' => 'product-item-label-left',
    'center' => 'product-item-label-center',
    'right' => 'product-item-label-right',
    'bottom' => 'product-item-label-bottom',
    'middle' => 'product-item-label-middle',
    'top' => 'product-item-label-top'
);

$discountPositionClass = '';
if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y' && !empty($arParams['DISCOUNT_PERCENT_POSITION'])) {
    foreach (explode('-', $arParams['DISCOUNT_PERCENT_POSITION']) as $pos) {
        $discountPositionClass .= isset($positionClassMap[$pos]) ? ' ' . $positionClassMap[$pos] : '';
    }
}

$labelPositionClass = '';
if (!empty($arParams['LABEL_PROP_POSITION'])) {
    foreach (explode('-', $arParams['LABEL_PROP_POSITION']) as $pos) {
        $labelPositionClass .= isset($positionClassMap[$pos]) ? ' ' . $positionClassMap[$pos] : '';
    }
}

$arParams['~MESS_BTN_BUY'] = ($arParams['~MESS_BTN_BUY'] ?? '') ?: Loc::getMessage('CT_BCS_TPL_MESS_BTN_BUY');
$arParams['~MESS_BTN_DETAIL'] = ($arParams['~MESS_BTN_DETAIL'] ?? '') ?: Loc::getMessage('CT_BCS_TPL_MESS_BTN_DETAIL');
$arParams['~MESS_BTN_COMPARE'] = ($arParams['~MESS_BTN_COMPARE'] ?? '') ?: Loc::getMessage('CT_BCS_TPL_MESS_BTN_COMPARE');
$arParams['~MESS_BTN_SUBSCRIBE'] = ($arParams['~MESS_BTN_SUBSCRIBE'] ?? '') ?: Loc::getMessage('CT_BCS_TPL_MESS_BTN_SUBSCRIBE');
$arParams['~MESS_BTN_ADD_TO_BASKET'] = ($arParams['~MESS_BTN_ADD_TO_BASKET'] ?? '') ?: Loc::getMessage('CT_BCS_TPL_MESS_BTN_ADD_TO_BASKET');
$arParams['~MESS_NOT_AVAILABLE'] = ($arParams['~MESS_NOT_AVAILABLE'] ?? '') ?: Loc::getMessage('CT_BCS_TPL_MESS_PRODUCT_NOT_AVAILABLE');
$arParams['~MESS_NOT_AVAILABLE_SERVICE'] = ($arParams['~MESS_NOT_AVAILABLE_SERVICE'] ?? '') ?: Loc::getMessage('CP_BCS_TPL_MESS_PRODUCT_NOT_AVAILABLE_SERVICE');
$arParams['~MESS_SHOW_MAX_QUANTITY'] = ($arParams['~MESS_SHOW_MAX_QUANTITY'] ?? '') ?: Loc::getMessage('CT_BCS_CATALOG_SHOW_MAX_QUANTITY');
$arParams['~MESS_RELATIVE_QUANTITY_MANY'] = ($arParams['~MESS_RELATIVE_QUANTITY_MANY'] ?? '') ?: Loc::getMessage('CT_BCS_CATALOG_RELATIVE_QUANTITY_MANY');
$arParams['MESS_RELATIVE_QUANTITY_MANY'] = ($arParams['MESS_RELATIVE_QUANTITY_MANY'] ?? '') ?: Loc::getMessage('CT_BCS_CATALOG_RELATIVE_QUANTITY_MANY');
$arParams['~MESS_RELATIVE_QUANTITY_FEW'] = ($arParams['~MESS_RELATIVE_QUANTITY_FEW'] ?? '') ?: Loc::getMessage('CT_BCS_CATALOG_RELATIVE_QUANTITY_FEW');
$arParams['MESS_RELATIVE_QUANTITY_FEW'] = ($arParams['MESS_RELATIVE_QUANTITY_FEW'] ?? '') ?: Loc::getMessage('CT_BCS_CATALOG_RELATIVE_QUANTITY_FEW');

$arParams['MESS_BTN_LAZY_LOAD'] = $arParams['MESS_BTN_LAZY_LOAD'] ?: Loc::getMessage('CT_BCS_CATALOG_MESS_BTN_LAZY_LOAD');

$obName = 'ob' . preg_replace('/[^a-zA-Z0-9_]/', 'x', $this->GetEditAreaId($navParams['NavNum']));
$containerName = 'container-' . $navParams['NavNum'];
$defaultImage = $this->GetFolder() . '/images/line-empty.png'; ?>

<section class="dp-section dp-page-top-nav mobile-visible">
    <div class="container">
        <div class="dp-tags">
            <ul class="dp-tags__list dp-tags__list_">
                <!--<li class="dp-tags__item"><a
                        class="dp-btn dp-tag"
                        href="#series-mobile-filter-item-02"
                        data-anchor="#series-mobile-filter-item-02"> <span>Файлы серии</span></a>
                </li>-->
                <? if (mb_strlen($arResult["SECTION_DATA"]["DESCRIPTION"]) > 0) { ?>
                    <li class="dp-tags__item"><a class="dp-btn dp-tag" href="#series-desc" data-anchor="#series-desc"> <span>Описание</span></a>
                    </li>
                <? } ?>
                <li class="dp-tags__item"><a class="dp-btn dp-tag" href="#series-mobile-filter-item-01" data-anchor="#series-mobile-filter-item-01"> <span>Список моделей</span></a>
                </li>
            </ul>
        </div>
    </div>
</section>

<? if ($arResult['SHOW_SLIDER'] == 'Y') { ?>
    <section class="dp-section dp-series-gallery" id="series-gallery">
        <div class="container">
            <div class="dp-section__body">
                <div class="dp-series-gallery__main">
                    <div class="dp-series-gallery__main-container">
                        <div class="dp-series-gallery__main-wrapper">
                            <? if (!empty($arResult["SECTION_DATA"]["VIDEO_SLIDER"])) { ?>
                                <div class="dp-series-gallery__main-item">
                                    <video poster="<?= $arResult["SECTION_DATA"]["VIDEO_SLIDER_POSTER"]; ?>" autoplay muted>
                                        <source src="<?= $arResult["SECTION_DATA"]["VIDEO_SLIDER"]; ?>" type="video/mp4">
                                    </video>
                                </div>
                            <? } ?>
                            <? foreach ($arResult["SECTION_DATA"]["SLIDER"] as $slide) { ?>
                                <div class="dp-series-gallery__main-item">
                                    <picture><img src="<?= $slide ?>" alt=""></picture>
                                </div>
                            <? } ?>
                        </div>
                    </div>
                    <div class="dp-slider-arrows"></div>
                </div>
                <div class="dp-series-gallery__nav">
                    <div class="dp-series-gallery__nav-container">
                        <div class="dp-series-gallery__nav-wrapper">
                            <? if (!empty($arResult["SECTION_DATA"]["VIDEO_SLIDER"])) { ?>
                                <div class="dp-series-gallery__nav-item">
                                    <picture><img src="<?= $arResult["SECTION_DATA"]["VIDEO_SLIDER_POSTER"]; ?>" alt=""></picture>
                                </div>
                            <? } ?>
                            <? foreach ($arResult["SECTION_DATA"]["SLIDER"] as $slide) { ?>
                                <div class="dp-series-gallery__nav-item">
                                    <picture><img src="<?= $slide ?>" alt=""></picture>
                                </div>
                            <? } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<? } ?>

<section class="dp-section dp-series-mobile-filter">
    <div class="container">
        <div class="dp-series-mobile-filter__item" id="series-mobile-filter-item-01">
            <div class="dp-series-mobile-filter__item-head">
                <div class="dp-series-mobile-filter__item__item-title">Модели серии</div>
            </div>
            <div class="dp-series-mobile-filter__item-body">
                <div class="row">
                    <div class="col-sm-8"><a href=# class="dp-btn dp-btn_select-like" data-modal="#modal-series-models"><span>Модели</span></a>
                    </div>
                </div>
            </div>
        </div>
        <!--
        <div class="dp-series-mobile-filter__item collapsed" id="series-mobile-filter-item-02">
            <div class="dp-series-mobile-filter__item-head">
                <div class="dp-series-mobile-filter__item__item-title">Файлы серии</div>
            </div>
            <div class="dp-series-mobile-filter__item-body">
                <div class="row">
                    <div class="col-auto"><a class="dp-btn dp-btn_xs dp-btn_outlined" href="#"><span>2 D</span>
                            <svg class="icon icon-download ">
                                <use xlink:href="#download"></use>
                            </svg>
                        </a></div>
                    <div class="col-auto"><a class="dp-btn dp-btn_xs dp-btn_outlined" href="#"><span>3D DWG</span>
                            <svg class="icon icon-download ">
                                <use xlink:href="#download"></use>
                            </svg>
                        </a></div>
                    <div class="col-auto"><a class="dp-btn dp-btn_xs dp-btn_outlined" href="#"><span>3D MAX</span>
                            <svg class="icon icon-download ">
                                <use xlink:href="#download"></use>
                            </svg>
                        </a></div>
                    <div class="col-auto"><a class="dp-btn dp-btn_xs dp-btn_outlined" href="#"><span>Чертеж с размерами</span>
                            <svg class="icon icon-download ">
                                <use xlink:href="#download"></use>
                            </svg>
                        </a></div>
                    <div class="col-auto"><a class="dp-btn dp-btn_xs dp-btn_outlined" href="#"><span>Галерея фотографий</span>
                            <svg class="icon icon-download ">
                                <use xlink:href="#download"></use>
                            </svg>
                        </a></div>
                    <div class="col-auto"><a class="dp-btn dp-btn_xs dp-btn_outlined" href="#"><span>Монтажная инструкция</span>
                            <svg class="icon icon-download ">
                                <use xlink:href="#download"></use>
                            </svg>
                        </a></div>
                    <div class="col-auto"><a class="dp-btn dp-btn_xs dp-btn_outlined"
                                             href="#"><span>Скачать все</span>
                            <svg class="icon icon-download ">
                                <use xlink:href="#download"></use>
                            </svg>
                        </a></div>
                </div>
            </div>
        </div>
        -->
    </div>
</section>

<section class="dp-section dp-section-desc" id="series-desc">
    <div class="container">
        <div class="dp-section__header">
            <h3 class="dp-section__title"><?= $arResult["SECTION_DATA"]["NAME"] ?></h3>
        </div>
        <? if (mb_strlen($arResult["SECTION_DATA"]["DESCRIPTION"]) > 0) { ?>
            <div class="dp-section__body">
                <p><?= $arResult["SECTION_DATA"]["DESCRIPTION"] ?></p>
            </div>
        <? } ?>
    </div>
</section>

<? if (is_array($arResult["SECTION_DATA"]["UF_DISAIGNER"]) && !empty($arResult["SECTION_DATA"]["UF_DISAIGNER"])) { ?>
    <section class="dp-section dp-series-info dp-series-info-designer">
        <div class="container">
            <div class="row">
                <div class="col-sm-auto">
                    <div class="dp-section__header">
                        <h5 class="dp-section__title">Дизайн</h5>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="dp-section__body">
                        <p><?= $arResult["SECTION_DATA"]["UF_DISAIGNER"]["NAME"] ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
<? } ?>
<? if (is_array($arResult["SECTION_DATA"]["UF_MANUFACTER"]) && !empty($arResult["SECTION_DATA"]["UF_MANUFACTER"])) { ?>
    <section class="dp-section dp-series-info dp-series-manufacturer">
        <div class="container">
            <div class="row">
                <div class="col-sm-auto">
                    <div class="dp-section__header">
                        <h5 class="dp-section__title">Производитель</h5>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="dp-section__body">
                        <div class="dp-series-manufacturer-logo"><img src="<?= $arResult["SECTION_DATA"]["UF_MANUFACTER"]["PICTURE"]["SRC"] ?>" alt="<?= $arResult["SECTION_DATA"]["UF_MANUFACTER"]["NAME"] ?>"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<? } ?>


<div class="dp-section dp-series-models" id="filter-start">
    <div class="container">
        <h2 class="dp-section__title">Модели</h2>

        <?= $APPLICATION->getViewContent('detail_filter') ?>

        <div class="dp-series-models-list">
            <? foreach ($arResult["ITEMS"] as $arItem) { ?>
                <div class="dp-model-card" id="model-bank-line-1-bnk<?= $arItem["ID"] ?>">
                    <div class="dp-model-card__inner">
                        <div class="dp-model-card__block dp-model-card__header">
                            <div class="dp-model-card__subtitle"><?= $arItem["PREVIEW_TEXT"] ?></div>
                            <h3 class="dp-model-card__title"><?= $arItem["NAME"] ?></h3>
                        </div>
                        <!--
                        <div class="dp-model-card__block dp-model-card__files">
                            <div class="dp-model-card__block-head">
                                <div class="h5 dp-model-card__block-title">Файлы модели</div>
                            </div>
                            <div class="dp-model-card__block-body">
                                <div class="dp-tags">
                                    <ul class="dp-tags__list dp-tags__list_">
                                        <li class="dp-tags__item"><a class="dp-btn dp-btn_xs dp-btn_outlined">
                                                <span>2 D</span>
                                                <svg class="icon icon-download ">
                                                    <use xlink:href="#download"></use>
                                                </svg>
                                            </a>
                                        </li>
                                        <li class="dp-tags__item"><a class="dp-btn dp-btn_xs dp-btn_outlined"> <span>3D DWG</span>
                                                <svg class="icon icon-download ">
                                                    <use xlink:href="#download"></use>
                                                </svg>
                                            </a>
                                        </li>
                                        <li class="dp-tags__item"><a class="dp-btn dp-btn_xs dp-btn_outlined"> <span>3D MAX</span>
                                                <svg class="icon icon-download ">
                                                    <use xlink:href="#download"></use>
                                                </svg>
                                            </a>
                                        </li>
                                        <li class="dp-tags__item"><a class="dp-btn dp-btn_xs dp-btn_outlined"> <span>Чертеж с размерами</span>
                                                <svg class="icon icon-download ">
                                                    <use xlink:href="#download"></use>
                                                </svg>
                                            </a>
                                        </li>
                                        <li class="dp-tags__item"><a class="dp-btn dp-btn_xs dp-btn_outlined"> <span>Галерея фотографий</span>
                                                <svg class="icon icon-download ">
                                                    <use xlink:href="#download"></use>
                                                </svg>
                                            </a>
                                        </li>
                                        <li class="dp-tags__item"><a class="dp-btn dp-btn_xs dp-btn_outlined"> <span>Монтажная инструкция</span>
                                                <svg class="icon icon-download ">
                                                    <use xlink:href="#download"></use>
                                                </svg>
                                            </a>
                                        </li>
                                        <li class="dp-tags__item"><a class="dp-btn dp-btn_xs dp-btn_outlined"> <span>Видео</span>
                                                <svg class="icon icon-download ">
                                                    <use xlink:href="#download"></use>
                                                </svg>
                                            </a>
                                        </li>
                                        <li class="dp-tags__item"><a class="dp-btn dp-btn_xs dp-btn_outlined"> <span>Скачать все</span>
                                                <svg class="icon icon-download ">
                                                    <use xlink:href="#download"></use>
                                                </svg>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        -->
                        <div class="dp-model-card__block dp-model-card__gallery">
                            <? foreach ($arItem["GALLERY"] as $imgLink) { ?>
                                <a class="dp-model-card__gallery-item" href="<?= $imgLink ?>" data-fancybox="bank-line-1-bnk<?= $arItem["ID"] ?>">
                                    <img src="<?= $imgLink ?>">
                                </a>
                            <? } ?>
                        </div>
                        <div class="dp-model-card__samples-wrapper">
                            <? if (isset($arItem["OFFERS_PROPS_VARIANTS"]["VID_DREVESINY_BRUSKA_DOSKI"])) { ?>
                                <div class="dp-model-card__block dp-model-card__samples-block">
                                    <div class="dp-model-card__block-head">
                                        <div class="h5 dp-model-card__block-title">Дерево:</div>
                                    </div>
                                    <div class="dp-model-card__block-body">
                                        <ul class="dp-model-card__samples-list">
                                            <? foreach ($arItem["OFFERS_PROPS_VARIANTS"]["VID_DREVESINY_BRUSKA_DOSKI"] as $type) {
                                                $type = mb_strtolower($type);
                                                if (isset($arResult["REFERENCE"]["tree_types"][$type])) {
                                                    $src = $arResult["REFERENCE"]["tree_types"][$type]["PREVIEW_PICTURE_SRC"];
                                                } else $src = $defaultImage;
                                            ?>
                                                <li class="dp-model-card__samples-item">
                                                    <div class="dp-model-card__sample"><img title="<?= $type ?>" src="<?= $src ?>">
                                                    </div>
                                                </li>
                                            <? } ?>
                                        </ul>
                                        <? if (isset($arItem["OFFERS_PROPS_VARIANTS"]["OKRAS_BRUSKA"])) { ?>
                                            <div class="dp-model-card__block-link">
                                                <a href="#" data-modal="#modal-series-wood-paint-<?= $arItem["ID"] ?>">Варианты
                                                    покрытия краской</a>
                                            </div>
                                        <? } ?>
                                    </div>
                                </div>
                            <? } ?>
                            <? if (isset($arItem["OFFERS_PROPS_VARIANTS"]["METALL"])) { ?>
                                <div class="dp-model-card__block dp-model-card__samples-block">
                                    <div class="dp-model-card__block-head">
                                        <div class="h5 dp-model-card__block-title">Металл:</div>
                                    </div>
                                    <div class="dp-model-card__block-body">
                                        <ul class="dp-model-card__samples-list">
                                            <? foreach ($arItem["OFFERS_PROPS_VARIANTS"]["METALL"] as $type) {
                                                $type = mb_strtolower($type);
                                                if (isset($arResult["REFERENCE"]["metal_types"][$type])) {
                                                    $src = $arResult["REFERENCE"]["metal_types"][$type]["PREVIEW_PICTURE_SRC"];
                                                } else $src = $defaultImage;
                                            ?>
                                                <li class="dp-model-card__samples-item">
                                                    <div class="dp-model-card__sample"><img title="<?= $type ?>" src="<?= $src ?>">
                                                    </div>
                                                </li>
                                            <? } ?>
                                        </ul>
                                        <? if (isset($arItem["OFFERS_PROPS_VARIANTS"]["TSVET_METALLICHESKOGO_POKRYTIYA"])) { ?>
                                            <div class="dp-model-card__block-link"><a href="#" data-modal="#modal-series-ral-<?= $arItem["ID"] ?>">Доступные
                                                    цвета RAL</a></div>
                                        <? } ?>
                                    </div>
                                </div>
                            <? } ?>
                        </div>
                        <div class="dp-model-card__bottom">
                            <div class="dp-model-card__block dp-model-card__chars">
                                <div class="dp-model-card__block-head">
                                    <h5 class="dp-model-card__block-title">Характеристики:</h5>
                                </div>
                                <div class="dp-model-card__block-body">
                                    <ul class="dp-model-card__chars-list">
                                        <li>Длина: 3000 мм</li>
                                    </ul>
                                    <div class="dp-model-card__block-link"><a href="#">Больше характеристик</a>
                                    </div>
                                </div>
                            </div>
                            <div class="dp-model-card__block dp-model-card__kit">
                                <div class="dp-model-card__block-head">
                                    <h5 class="dp-model-card__block-title">Дополнения:</h5>
                                </div>
                                <div class="dp-model-card__block-body">
                                    <ul class="dp-model-card__chars-list">
                                        <li>USB - зарядка - 2 шт.</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="dp-model-card__block dp-model-card__buttons">
                                <div class="dp-buttons-line">
                                    <button class="dp-btn dp-model-card__config-toggler mobile-hidden" type="button">
                                        <span>Выбрать опции и добавить в ведомость</span></button>
                                    <button class="dp-btn dp-model-card__config-toggler mobile-visible" type="button">
                                        <span>Выбрать и добавить в ведомость</span></button>
                                    <div class="dp-icon-btn dp-icon-btn_white" data-tooltip="текст подсказки">?
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dp-model-card-config">
                        <div class="dp-model-card-config__header">
                            <button class="dp-model-card-config__close" type="button">
                                <svg class="icon icon-close ">
                                    <use xlink:href="#close"></use>
                                </svg>
                            </button>
                            <div class="dp-model-card__subtitle"><?= $arItem["PREVIEW_TEXT"] ?></div>
                            <div class="h3 dp-model-card__title"><?= $arItem["NAME"] ?></div>
                        </div>
                        <div class="dp-model-card-config__body">
                            <div class="dp-model-card__inner">
                                <div class="dp-model-card__block dp-model-card__image">
                                    <? if ($arItem["PREVIEW_PICTURE"]["SRC"]) { ?>
                                        <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>">
                                    <? } else { ?>
                                        <img src="<?= $defaultImage; ?>">
                                    <? } ?>
                                </div>
                                <div class="dp-model-card__block dp-model-card__options">
                                    <div class="dp-model-card__inner">
                                        <? if (isset($arItem["OFFERS_PROPS_VARIANTS"]["VID_DREVESINY_BRUSKA_DOSKI"]) && isset($arItem["OFFERS_PROPS_VARIANTS"]["METALL"])) { ?>
                                            <div class="dp-model-card__block dp-model-card__fields-group">
                                                <div class="dp-form-group">
                                                    <label class="dp-form-control-label">1. Выберите породу дерева и
                                                        покрытие</label>
                                                    <button class="dp-btn dp-btn_select-like" type="button" data-modal="#modal-series-tree-<?= $arItem["ID"] ?>">
                                                        <div class="dp-model-card__sample">
                                                            <img src="<?= $defaultImage ?>">
                                                        </div>
                                                        <span>Не выбрано</span>
                                                    </button>
                                                </div>
                                                <? if (isset($arItem["OFFERS_PROPS_VARIANTS"]["OKRAS_BRUSKA"])) { ?>
                                                    <div class="dp-form-group">
                                                        <label class="dp-form-control-label">2. Выберите вариант
                                                            окраски
                                                            древесины</label>
                                                        <button class="dp-btn dp-btn_select-like" type="button" data-modal="#modal-series-wood-paint-<?= $arItem["ID"] ?>">
                                                            <div class="dp-model-card__sample">
                                                                <img src="<?= $defaultImage ?>">
                                                            </div>
                                                            <span>Не выбрано</span>
                                                        </button>
                                                    </div>
                                                <? } ?>
                                            </div>
                                            <div class="dp-model-card__block dp-model-card__fields-group">
                                                <div class="dp-form-group">
                                                    <label class="dp-form-control-label">3. Выберите металл</label>
                                                    <button class="dp-btn dp-btn_select-like" type="button" data-modal="#modal-series-metal-<?= $arItem["ID"] ?>">
                                                        <div class="dp-model-card__sample">
                                                            <img src="<?= $defaultImage ?>">
                                                        </div>
                                                        <span>Не выбрано</span>
                                                    </button>
                                                </div>
                                                <? if (isset($arItem["OFFERS_PROPS_VARIANTS"]["TSVET_METALLICHESKOGO_POKRYTIYA"])) { ?>
                                                    <div class="dp-form-group">
                                                        <label class="dp-form-control-label">4. Выберите цвет
                                                            металла</label>
                                                        <button class="dp-btn dp-btn_select-like" type="button" data-modal="#modal-series-ral-<?= $arItem["ID"] ?>">
                                                            <div class="dp-model-card__sample">
                                                                <img src="<?= $defaultImage ?>">
                                                            </div>
                                                            <span>Не выбрано</span>
                                                        </button>
                                                    </div>
                                                <? } ?>
                                            </div>
                                        <? } elseif (isset($arItem["OFFERS_PROPS_VARIANTS"]["VID_DREVESINY_BRUSKA_DOSKI"])) { ?>
                                            <div class="dp-model-card__block dp-model-card__fields-group">
                                                <div class="dp-form-group">
                                                    <label class="dp-form-control-label">1. Выберите породу дерева и
                                                        покрытие</label>
                                                    <button class="dp-btn dp-btn_select-like" type="button" data-modal="#modal-series-tree-<?= $arItem["ID"] ?>">
                                                        <div class="dp-model-card__sample">
                                                            <img src="<?= $defaultImage ?>">
                                                        </div>
                                                        <span>Не выбрано</span>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="dp-model-card__block dp-model-card__fields-group">
                                                <? if (isset($arItem["OFFERS_PROPS_VARIANTS"]["OKRAS_BRUSKA"])) { ?>
                                                    <div class="dp-form-group">
                                                        <label class="dp-form-control-label">2. Выберите вариант
                                                            окраски
                                                            древесины</label>
                                                        <button class="dp-btn dp-btn_select-like" type="button" data-modal="#modal-series-wood-paint-<?= $arItem["ID"] ?>">
                                                            <div class="dp-model-card__sample">
                                                                <img src="<?= $defaultImage ?>">
                                                            </div>
                                                            <span>Не выбрано</span>
                                                        </button>
                                                    </div>
                                                <? } ?>
                                            </div>
                                        <? } elseif ($arItem["OFFERS_PROPS_VARIANTS"]["METALL"]) { ?>
                                            <div class="dp-model-card__block dp-model-card__fields-group">
                                                <div class="dp-form-group">
                                                    <label class="dp-form-control-label">1. Выберите металл</label>
                                                    <button class="dp-btn dp-btn_select-like" type="button" data-modal="#modal-series-metal-<?= $arItem["ID"] ?>">
                                                        <div class="dp-model-card__sample">
                                                            <img src="<?= $defaultImage ?>">
                                                        </div>
                                                        <span>Не выбрано</span>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="dp-model-card__block dp-model-card__fields-group">
                                                <? if (isset($arItem["OFFERS_PROPS_VARIANTS"]["TSVET_METALLICHESKOGO_POKRYTIYA"])) { ?>
                                                    <div class="dp-form-group">
                                                        <label class="dp-form-control-label">2. Выберите цвет
                                                            металла</label>
                                                        <button class="dp-btn dp-btn_select-like" type="button" data-modal="#modal-series-ral-<?= $arItem["ID"] ?>">
                                                            <div class="dp-model-card__sample">
                                                                <img src="<?= $defaultImage ?>">
                                                            </div>
                                                            <span>Не выбрано</span>
                                                        </button>
                                                    </div>
                                                <? } ?>
                                            </div>
                                        <? } ?>
                                    </div>
                                    <div class="dp-buttons-line">
                                        <button data-accept="<?= $arItem["ID"] ?>" data-value="" class="dp-btn dp-model-card__config-accep" type="button"><span>Добавить в список</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <? } ?>
        </div>
    </div>
</div>


<? foreach ($arResult["ITEMS"] as $arItem) { ?>
    <div class="dp-modal dp-modal-series" data-offer-select="<?= $arItem["ID"] ?>" data-property="PROPERTY_VID_DREVESINY_BRUSKA_DOSKI" id="modal-series-tree-<?= $arItem["ID"] ?>">
        <div class="dp-modal__overlay"></div>
        <div class="dp-modal__dialog">
            <button class="dp-modal__close" type="button">
                <svg class="icon icon-close ">
                    <use xlink:href="#close"></use>
                </svg>
            </button>
            <div class="dp-modal__header">
                <h3 class="dp-modal__title">Выберите породу дерева и покрытие</h3>
            </div>
            <div class="dp-modal__body">
                <ul class="dp-modal-series__list">
                    <? $type = "Не выбрано"; ?>
                    <li class="dp-modal-series__item">
                        <input type="radio" checked value="" name="<?= $arItem["ID"] ?>-tree" id="series-tree-<?= $arItem["ID"] . "-" . md5($type) ?>">
                        <label class="dp-series-hexagon-item" for="series-tree-<?= $arItem["ID"] . "-" . md5($type) ?>">
                            <div class="dp-series-hexagon-item__image">
                                <picture><img src="<?= $src ?>" alt="<?= $type ?>"></picture>
                            </div>
                            <span class="dp-series-hexagon-item__text"><?= $type ?></span>
                        </label>
                    </li>
                    <? foreach ($arItem["OFFERS_PROPS_VARIANTS"]["VID_DREVESINY_BRUSKA_DOSKI"] as $type) {
                        $type = mb_strtolower($type);
                        if (isset($arResult["REFERENCE"]["tree_types"][$type])) {
                            $src = $arResult["REFERENCE"]["tree_types"][$type]["PREVIEW_PICTURE_SRC"];
                        } else $src = $defaultImage;
                    ?>
                        <li class="dp-modal-series__item">
                            <input type="radio" value="<?= $type ?>" name="<?= $arItem["ID"] ?>-tree" id="series-tree-<?= $arItem["ID"] . "-" . md5($type) ?>">
                            <label class="dp-series-hexagon-item" for="series-tree-<?= $arItem["ID"] . "-" . md5($type) ?>">
                                <div class="dp-series-hexagon-item__image">
                                    <picture><img src="<?= $src ?>" alt="<?= $type ?>"></picture>
                                </div>
                                <span class="dp-series-hexagon-item__text"><?= $type ?></span>
                            </label>
                        </li>
                    <? } ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="dp-modal dp-modal-series" data-offer-select="<?= $arItem["ID"] ?>" data-property="PROPERTY_METALL" id="modal-series-metal-<?= $arItem["ID"] ?>">
        <div class="dp-modal__overlay"></div>
        <div class="dp-modal__dialog">
            <button class="dp-modal__close" type="button">
                <svg class="icon icon-close ">
                    <use xlink:href="#close"></use>
                </svg>
            </button>
            <div class="dp-modal__header">
                <h3 class="dp-modal__title">Выберите метал</h3>
            </div>
            <div class="dp-modal__body">
                <ul class="dp-modal-series__list">
                    <? $type = "Не выбрано"; ?>
                    <li class="dp-modal-series__item">
                        <input value="" checked type="radio" name="<?= $arItem["ID"] ?>-metal" id="series-metal-<?= $arItem["ID"] . "-" . md5($type) ?>">
                        <label class="dp-series-hexagon-item" for="series-metal-<?= $arItem["ID"] . "-" . md5($type) ?>">
                            <div class="dp-series-hexagon-item__image">
                                <picture><img src="<?= $src ?>" alt="<?= $type ?>"></picture>
                            </div>
                            <span class="dp-series-hexagon-item__text"><?= $type ?></span>
                        </label>
                    </li>
                    <? foreach ($arItem["OFFERS_PROPS_VARIANTS"]["METALL"] as $type) {
                        $type = mb_strtolower($type);
                        if (isset($arResult["REFERENCE"]["metal_types"][$type])) {
                            $src = $arResult["REFERENCE"]["metal_types"][$type]["PREVIEW_PICTURE_SRC"];
                        } else $src = $defaultImage;
                    ?>
                        <li class="dp-modal-series__item">
                            <input value="<?= $type ?>" type="radio" name="<?= $arItem["ID"] ?>-metal" id="series-metal-<?= $arItem["ID"] . "-" . md5($type) ?>">
                            <label class="dp-series-hexagon-item" for="series-metal-<?= $arItem["ID"] . "-" . md5($type) ?>">
                                <div class="dp-series-hexagon-item__image">
                                    <picture><img src="<?= $src ?>" alt="<?= $type ?>"></picture>
                                </div>
                                <span class="dp-series-hexagon-item__text"><?= $type ?></span>
                            </label>
                        </li>
                    <? } ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="dp-modal dp-modal-series" data-offer-select="<?= $arItem["ID"] ?>" data-property="PROPERTY_TSVET_METALLICHESKOGO_POKRYTIYA" id="modal-series-ral-<?= $arItem["ID"] ?>">
        <div class="dp-modal__overlay"></div>
        <div class="dp-modal__dialog">
            <button class="dp-modal__close" type="button">
                <svg class="icon icon-close ">
                    <use xlink:href="#close"></use>
                </svg>
            </button>
            <div class="dp-modal__header">
                <h3 class="dp-modal__title">Выберите цвет RAL для порошкового покрытия металла</h3>
            </div>
            <div class="dp-modal__body">
                <ul class="dp-modal-series__list">
                    <? $type = "Не выбрано"; ?>
                    <li class="dp-modal-series__item">
                        <input value="" checked type="radio" name="<?= $arItem["ID"] ?>-ral" id="series-ral-<?= $arItem["ID"] . "-" . md5($type) ?>">
                        <label class="dp-series-hexagon-item" for="series-ral-<?= $arItem["ID"] . "-" . md5($type) ?>">
                            <div class="dp-series-hexagon-item__image">
                                <picture><img src="<?= $src ?>" alt="<?= $type ?>"></picture>
                            </div>
                            <span class="dp-series-hexagon-item__text"><?= $type ?></span>
                        </label>
                    </li>
                    <? foreach ($arItem["OFFERS_PROPS_VARIANTS"]["TSVET_METALLICHESKOGO_POKRYTIYA"] as $type) {
                        $type = mb_strtolower($type);
                        if (isset($arResult["REFERENCE"]["colors"][$type])) {
                            $src = $arResult["REFERENCE"]["colors"][$type]["PREVIEW_PICTURE_SRC"];
                        } else $src = $defaultImage;
                    ?>
                        <li class="dp-modal-series__item">
                            <input value="<?= $type ?>" type="radio" name="<?= $arItem["ID"] ?>-ral" id="series-ral-<?= $arItem["ID"] . "-" . md5($type) ?>">
                            <label class="dp-series-hexagon-item" for="series-ral-<?= $arItem["ID"] . "-" . md5($type) ?>">
                                <div class="dp-series-hexagon-item__image">
                                    <picture><img src="<?= $src ?>" alt="<?= $type ?>"></picture>
                                </div>
                                <span class="dp-series-hexagon-item__text"><?= $type ?></span>
                            </label>
                        </li>
                    <? } ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="dp-modal dp-modal-series" data-offer-select="<?= $arItem["ID"] ?>" data-property="PROPERTY_OKRAS_BRUSKA" id="modal-series-wood-paint-<?= $arItem["ID"] ?>">
        <div class="dp-modal__overlay"></div>
        <div class="dp-modal__dialog">
            <button class="dp-modal__close" type="button">
                <svg class="icon icon-close ">
                    <use xlink:href="#close"></use>
                </svg>
            </button>
            <div class="dp-modal__header">
                <h3 class="dp-modal__title">Выберите вариант окраски древесины</h3>
            </div>
            <div class="dp-modal__body">
                <ul class="dp-modal-series__list">
                    <? $type = "Не выбрано"; ?>
                    <li class="dp-modal-series__item">
                        <input value="" checked type="radio" name="<?= $arItem["ID"] ?>-color" id="series-color-<?= $arItem["ID"] . "-" . md5($type) ?>">
                        <label class="dp-series-hexagon-item" for="series-color-<?= $arItem["ID"] . "-" . md5($type) ?>">
                            <div class="dp-series-hexagon-item__image">
                                <picture><img src="<?= $src ?>" alt="<?= $type ?>"></picture>
                            </div>
                            <span class="dp-series-hexagon-item__text"><?= $type ?></span>
                        </label>
                    </li>
                    <? foreach ($arItem["OFFERS_PROPS_VARIANTS"]["OKRAS_BRUSKA"] as $type) {
                        $type = mb_strtolower($type);
                        if (isset($arResult["REFERENCE"]["color_options"][$type])) {
                            $src = $arResult["REFERENCE"]["color_options"][$type]["PREVIEW_PICTURE_SRC"];
                        } else $src = $defaultImage;
                    ?>
                        <li class="dp-modal-series__item">
                            <input value="<?= $type ?>" type="radio" name="<?= $arItem["ID"] ?>-color" id="series-color-<?= $arItem["ID"] . "-" . md5($type) ?>">
                            <label class="dp-series-hexagon-item" for="series-color-<?= $arItem["ID"] . "-" . md5($type) ?>">
                                <div class="dp-series-hexagon-item__image">
                                    <picture><img src="<?= $src ?>" alt="<?= $type ?>"></picture>
                                </div>
                                <span class="dp-series-hexagon-item__text"><?= $type ?></span>
                            </label>
                        </li>
                    <? } ?>
                </ul>
            </div>
        </div>
    </div>
<? } ?>

<? $this->SetViewTarget("sidebar_detail"); ?>
<aside class="dp-page__aside">
    <div class="dp-aside dp-sticky">
        <div class="dp-page__back">
            <a href="<?= $arResult["PARENT"]["SECTION_PAGE_URL"] ?>">
                <svg class="icon icon-drop-left ">
                    <use xlink:href="#drop-left"></use>
                </svg>
                <span><?= $arResult["PARENT"]["NAME"] ?></span>
            </a>
        </div>
        <div class="h3 dp-aside__title"><?= $arParams["COLLECTION"] ?></div>
        <div class="dp-aside-filter">
            <? /*
                                                                    <div class="dp-aside-filter__item">
                                                                        <div class="dp-aside-filter__item-head">
                                                                            <div class="dp-aside-filter__item-title">Файлы серии</div>
                                                                        </div>
                                                                        <div class="dp-aside-filter__item-body">
                                                                            <div class="row">
                                                                                <div class="col-auto"><a href=# class="dp-btn dp-btn_xs dp-btn_outlined"><span>2D</span>
                                                                                        <svg class="icon icon-download ">
                                                                                            <use xlink:href="#download"></use>
                                                                                        </svg></a>
                                                                                </div>
                                                                                <div class="col-auto"><a href=# class="dp-btn dp-btn_xs dp-btn_outlined"><span>2D PDF</span>
                                                                                        <svg class="icon icon-download ">
                                                                                            <use xlink:href="#download"></use>
                                                                                        </svg></a>
                                                                                </div>
                                                                                <div class="col-auto"><a href=# class="dp-btn dp-btn_xs dp-btn_outlined"><span>2D DWG</span>
                                                                                        <svg class="icon icon-download ">
                                                                                            <use xlink:href="#download"></use>
                                                                                        </svg></a>
                                                                                </div>
                                                                                <div class="col-auto"><a href=# class="dp-btn dp-btn_xs dp-btn_outlined"><span>3D DWG</span>
                                                                                        <svg class="icon icon-download ">
                                                                                            <use xlink:href="#download"></use>
                                                                                        </svg></a>
                                                                                </div>
                                                                                <div class="col-auto"><a href=# class="dp-btn dp-btn_xs dp-btn_outlined"><span>3D MAX</span>
                                                                                        <svg class="icon icon-download ">
                                                                                            <use xlink:href="#download"></use>
                                                                                        </svg></a>
                                                                                </div>
                                                                                <div class="col-auto"><a href=# class="dp-btn dp-btn_xs dp-btn_outlined"><span>Чертеж с размерами</span>
                                                                                        <svg class="icon icon-download ">
                                                                                            <use xlink:href="#download"></use>
                                                                                        </svg></a>
                                                                                </div>
                                                                                <div class="col-auto"><a href=# class="dp-btn dp-btn_xs dp-btn_outlined"><span>Галерея фотографий</span>
                                                                                        <svg class="icon icon-download ">
                                                                                            <use xlink:href="#download"></use>
                                                                                        </svg></a>
                                                                                </div>
                                                                                <div class="col-auto"><a href=# class="dp-btn dp-btn_xs dp-btn_outlined"><span>Монтажная инструкция</span>
                                                                                        <svg class="icon icon-download ">
                                                                                            <use xlink:href="#download"></use>
                                                                                        </svg></a>
                                                                                </div>
                                                                                <div class="col-auto"><a href=# class="dp-btn dp-btn_xs dp-btn_outlined"><span>Скачать все</span>
                                                                                        <svg class="icon icon-download ">
                                                                                            <use xlink:href="#download"></use>
                                                                                        </svg></a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    */ ?>
            <div class="dp-aside-filter__item">
                <div class="dp-aside-filter__item-head">
                    <div class="dp-aside-filter__item-title">Модели серии</div>
                </div>
                <div class="dp-aside-filter__item-body">
                    <div class="row">
                        <div class="col-xxl-20"><a href=# class="dp-btn dp-btn_select-like" data-modal="#modal-series-models"><span>Модели</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="dp-modal dp-modal-series" id="modal-series-models">
        <div class="dp-modal__overlay"></div>
        <div class="dp-modal__dialog">
            <button class="dp-modal__close" type="button">
                <svg class="icon icon-close ">
                    <use xlink:href="#close"></use>
                </svg>
            </button>
            <div class="dp-modal__header">
                <h3 class="dp-modal__title">Список моделей <?= $arParams["COLLECTION"] ?></h3>
            </div>
            <div class="dp-modal__body">
                <ul class="dp-modal-series__list">
                    <? foreach ($arResult["ITEMS"] as $arItem) { ?>
                        <li class="dp-modal-series__item">
                            <a class="dp-series-model-item" href="#model-bank-line-1-bnk<?= $arItem["ID"] ?>" data-anchor="#model-bank-line-1-bnk<?= $arItem["ID"] ?>">
                                <div class="dp-series-model-item__image">
                                    <picture>
                                        <? if ($arItem["PREVIEW_PICTURE"]["SRC"]) { ?>
                                            <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>">
                                        <? } else { ?>
                                            <img src="<?= $defaultImage; ?>">
                                        <? } ?>
                                    </picture>
                                </div>
                                <span class="dp-series-model-item__text"><?= $arItem["NAME"] ?></span>
                            </a>
                        </li>
                    <? } ?>
                </ul>
            </div>
        </div>
    </div>
</aside>
<? $this->EndViewTarget(); ?>