<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

use Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */

$this->setFrameMode(true);

$templateLibrary = array('popup', 'fx');
$currencyList = '';

if (!empty($arResult['CURRENCIES'])) {
    $templateLibrary[] = 'currency';
    $currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}

$templateData = array(
    'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
    'TEMPLATE_LIBRARY' => $templateLibrary,
    'CURRENCIES' => $currencyList,
    'ITEM' => array(
        'ID' => $arResult['ID'],
        'IBLOCK_ID' => $arResult['IBLOCK_ID'],
        'OFFERS_SELECTED' => $arResult['OFFERS_SELECTED'],
        'JS_OFFERS' => $arResult['JS_OFFERS']
    )
);
unset($currencyList, $templateLibrary);

$mainId = $this->GetEditAreaId($arResult['ID']);
$itemIds = array(
    'ID' => $mainId,
    'DISCOUNT_PERCENT_ID' => $mainId . '_dsc_pict',
    'STICKER_ID' => $mainId . '_sticker',
    'BIG_SLIDER_ID' => $mainId . '_big_slider',
    'BIG_IMG_CONT_ID' => $mainId . '_bigimg_cont',
    'SLIDER_CONT_ID' => $mainId . '_slider_cont',
    'OLD_PRICE_ID' => $mainId . '_old_price',
    'PRICE_ID' => $mainId . '_price',
    'DESCRIPTION_ID' => $mainId . '_description',
    'DISCOUNT_PRICE_ID' => $mainId . '_price_discount',
    'PRICE_TOTAL' => $mainId . '_price_total',
    'SLIDER_CONT_OF_ID' => $mainId . '_slider_cont_',
    'QUANTITY_ID' => $mainId . '_quantity',
    'QUANTITY_DOWN_ID' => $mainId . '_quant_down',
    'QUANTITY_UP_ID' => $mainId . '_quant_up',
    'QUANTITY_MEASURE' => $mainId . '_quant_measure',
    'QUANTITY_LIMIT' => $mainId . '_quant_limit',
    'BUY_LINK' => $mainId . '_buy_link',
    'ADD_BASKET_LINK' => $mainId . '_add_basket_link',
    'BASKET_ACTIONS_ID' => $mainId . '_basket_actions',
    'NOT_AVAILABLE_MESS' => $mainId . '_not_avail',
    'COMPARE_LINK' => $mainId . '_compare_link',
    'TREE_ID' => $mainId . '_skudiv',
    'DISPLAY_PROP_DIV' => $mainId . '_sku_prop',
    'DISPLAY_MAIN_PROP_DIV' => $mainId . '_main_sku_prop',
    'OFFER_GROUP' => $mainId . '_set_group_',
    'BASKET_PROP_DIV' => $mainId . '_basket_prop',
    'SUBSCRIBE_LINK' => $mainId . '_subscribe',
    'TABS_ID' => $mainId . '_tabs',
    'TAB_CONTAINERS_ID' => $mainId . '_tab_containers',
    'SMALL_CARD_PANEL_ID' => $mainId . '_small_card_panel',
    'TABS_PANEL_ID' => $mainId . '_tabs_panel'
);
$obName = $templateData['JS_OBJ'] = 'ob' . preg_replace('/[^a-zA-Z0-9_]/', 'x', $mainId);
$name = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'])
    ? $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
    : $arResult['NAME'];
$title = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE'])
    ? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE']
    : $arResult['NAME'];
$alt = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT'])
    ? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT']
    : $arResult['NAME'];

$haveOffers = !empty($arResult['OFFERS']);
if ($haveOffers) {
    $actualItem = $arResult['OFFERS'][$arResult['OFFERS_SELECTED']] ?? reset($arResult['OFFERS']);
    $showSliderControls = false;

    foreach ($arResult['OFFERS'] as $offer) {
        if ($offer['MORE_PHOTO_COUNT'] > 1) {
            $showSliderControls = true;
            break;
        }
    }
} else {
    $actualItem = $arResult;
    $showSliderControls = $arResult['MORE_PHOTO_COUNT'] > 1;
}

$skuProps = array();
$price = $actualItem['ITEM_PRICES'][$actualItem['ITEM_PRICE_SELECTED']];
$measureRatio = $actualItem['ITEM_MEASURE_RATIOS'][$actualItem['ITEM_MEASURE_RATIO_SELECTED']]['RATIO'];
$showDiscount = $price['PERCENT'] > 0;

if ($arParams['SHOW_SKU_DESCRIPTION'] === 'Y') {
    $skuDescription = false;
    foreach ($arResult['OFFERS'] as $offer) {
        if ($offer['DETAIL_TEXT'] != '' || $offer['PREVIEW_TEXT'] != '') {
            $skuDescription = true;
            break;
        }
    }
    $showDescription = $skuDescription || !empty($arResult['PREVIEW_TEXT']) || !empty($arResult['DETAIL_TEXT']);
} else {
    $showDescription = !empty($arResult['PREVIEW_TEXT']) || !empty($arResult['DETAIL_TEXT']);
}

$showBuyBtn = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION']);
$buyButtonClassName = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-default' : 'btn-link';
$showAddBtn = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION']);
$showButtonClassName = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-default' : 'btn-link';
$showSubscribe = $arParams['PRODUCT_SUBSCRIPTION'] === 'Y' && ($arResult['PRODUCT']['SUBSCRIBE'] === 'Y' || $haveOffers);

$arParams['MESS_BTN_BUY'] = $arParams['MESS_BTN_BUY'] ?: Loc::getMessage('CT_BCE_CATALOG_BUY');
$arParams['MESS_BTN_ADD_TO_BASKET'] = $arParams['MESS_BTN_ADD_TO_BASKET'] ?: Loc::getMessage('CT_BCE_CATALOG_ADD');
$arParams['MESS_NOT_AVAILABLE'] = $arParams['MESS_NOT_AVAILABLE'] ?: Loc::getMessage('CT_BCE_CATALOG_NOT_AVAILABLE');
$arParams['MESS_BTN_COMPARE'] = $arParams['MESS_BTN_COMPARE'] ?: Loc::getMessage('CT_BCE_CATALOG_COMPARE');
$arParams['MESS_PRICE_RANGES_TITLE'] = $arParams['MESS_PRICE_RANGES_TITLE'] ?: Loc::getMessage('CT_BCE_CATALOG_PRICE_RANGES_TITLE');
$arParams['MESS_DESCRIPTION_TAB'] = $arParams['MESS_DESCRIPTION_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_DESCRIPTION_TAB');
$arParams['MESS_PROPERTIES_TAB'] = $arParams['MESS_PROPERTIES_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_PROPERTIES_TAB');
$arParams['MESS_COMMENTS_TAB'] = $arParams['MESS_COMMENTS_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_COMMENTS_TAB');
$arParams['MESS_SHOW_MAX_QUANTITY'] = $arParams['MESS_SHOW_MAX_QUANTITY'] ?: Loc::getMessage('CT_BCE_CATALOG_SHOW_MAX_QUANTITY');
$arParams['MESS_RELATIVE_QUANTITY_MANY'] = $arParams['MESS_RELATIVE_QUANTITY_MANY'] ?: Loc::getMessage('CT_BCE_CATALOG_RELATIVE_QUANTITY_MANY');
$arParams['MESS_RELATIVE_QUANTITY_FEW'] = $arParams['MESS_RELATIVE_QUANTITY_FEW'] ?: Loc::getMessage('CT_BCE_CATALOG_RELATIVE_QUANTITY_FEW');

$positionClassMap = array(
    'left' => 'product-item-label-left',
    'center' => 'product-item-label-center',
    'right' => 'product-item-label-right',
    'bottom' => 'product-item-label-bottom',
    'middle' => 'product-item-label-middle',
    'top' => 'product-item-label-top'
);

$discountPositionClass = 'product-item-label-big';
if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y' && !empty($arParams['DISCOUNT_PERCENT_POSITION'])) {
    foreach (explode('-', $arParams['DISCOUNT_PERCENT_POSITION']) as $pos) {
        $discountPositionClass .= isset($positionClassMap[$pos]) ? ' ' . $positionClassMap[$pos] : '';
    }
}

$labelPositionClass = 'product-item-label-big';
if (!empty($arParams['LABEL_PROP_POSITION'])) {
    foreach (explode('-', $arParams['LABEL_PROP_POSITION']) as $pos) {
        $labelPositionClass .= isset($positionClassMap[$pos]) ? ' ' . $positionClassMap[$pos] : '';
    }
}
?>

<?
// Кнопка в Избранное -->

// Если пользователь не авторизован, то по клику "В избранное" поднимаем попап авторизации -->
$but_class = '';
$data_modal = 'data-modal="#modal-auth"';
if ($USER->IsAuthorized()) {
    $but_class = 'js--add_favorite_catalog_item_cookie_button';
    $data_modal = '';
}
// <--
?>
<? $this->SetViewTarget("content_wrapper_h1_before"); ?>
<div class="row">
    <? $this->EndViewTarget(); ?>

    <? $this->SetViewTarget("content_wrapper_h1_after"); ?>
</div>
<? $this->EndViewTarget(); ?>

<? $this->SetViewTarget("content_after_h1"); ?>
<div class="ml-page-actions ml-page-actions-favorite">
    <button name="<?= $arResult['ID'] ?>" class="ml-btn ml-btn_round ml-btn_orange-pink ml-btn-favorite <?= $but_class; ?>" type="button" <?= $data_modal; ?>>
        <svg class="icon icon-star ">
            <use xlink:href="#star"></use>
        </svg><span></span>
    </button>
</div>
<? $this->EndViewTarget(); ?>
<?
// <-- Кнопка в Избранное
?>


    <div class="container">

        <div class="row">

            <? /*?>
             <div class="icon_favorites_detail_cartoons">
             <label class="heart-label js--add_favorite_catalog_item_cookie">
             <input class="heart-check"
             type="checkbox" value="<?=$arResult['ID']?>"
             />
             <span class="heart-span"></span>
             </label>
             </div>
             <?*/ ?>

            <? /*?>
             <div class="icon_favorites_detail_cartoons">
             <label class="heart-label js--add_favorite_catalog_item_cookie">
             <input class="heart-check"
             <?if(!empty($_COOKIE['favorites_'.$arResult['ID']])) { echo 'checked'; } type="checkbox" value="<?=$arResult['ID']?>"
             />
             <span class="heart-span"></span>
             </label>
             </div>
             <?*/ ?>

            <div class="col-lg-5">
                <? if (!empty($actualItem['MORE_PHOTO'])) {
                    foreach ($actualItem['MORE_PHOTO'] as $key => $photo) {
                ?>
                        <picture><img class="lazyload" data-src="<?= $photo['SRC'] ?>" alt="<?= $alt ?>" title="<?= $title ?>"></picture>
                <?
                    }
                } ?>
            </div>
            <div class="col-lg-7">
                <?
                if (!empty($arResult['DISPLAY_PROPERTIES']) || !empty($arResult['LABEL_ARRAY_VALUE'])) {
                ?>
                    <ul class="cartoon-features">
                        <?php
                        if ($arResult['LABEL'] && !empty($arResult['LABEL_ARRAY_VALUE'])) {
                            foreach ($arResult['LABEL_ARRAY_VALUE'] as $code => $value) {
                        ?>
                                <li class="cartoon-features__item">
                                    <span class="cartoon-features__item-title">
                                        <?= $arResult['PROPERTIES'][$code]['NAME'] ?>
                                    </span>
                                    <span class="cartoon-features__item-desc"><span class="age-limit-label age-limit-label_light">
                                            <?= $value ?>
                                        </span></span>
                                </li>
                        <?php
                            }
                        }
                        ?>
                        <?php
                        foreach ($arResult['DISPLAY_PROPERTIES'] as $property) {
                        ?>
                            <li class="cartoon-features__item">
                                <span class="cartoon-features__item-title">
                                    <?= $property['NAME'] ?>
                                </span>
                                <span class="cartoon-features__item-desc">
                                    <?= (is_array($property['DISPLAY_VALUE'])
                                        ? implode(', ', $property['DISPLAY_VALUE'])
                                        : $property['DISPLAY_VALUE']
                                    ) ?>
                                </span>
                            </li>
                        <?php
                        }
                        unset($property);
                        ?>
                    </ul>
                <?php
                }
                ?>
            </div>
        </div>
        <?
        // Если несколько картинок, то выводим слайдер -->
        if (count($arResult["arVideo"]) > 1) { ?>
            <? /* Также нужно предусмотреть возможность использования нескольких картинок по разные разрешения и генерить low-res превью для lazyload */ ?>
            <div class="ml-slider" data-desktop-items="1">
                <div class="ml-slider__container">
                    <div class="ml-slider__wrapper">
                        <? foreach ($arResult["arVideo"] as $key => $val) { ?>
                            <div class="ml-slider__item">
                                <a href="<?= $val["VIDEO_LINK"] ?>" class="ml-video-link" data-fancybox="cartoon-series">
                                    <figure>
                                        <picture>
                                            <source media="(max-width:480px)" srcset="<?= $val["arPictSizes"]["MEDIUM"]["src"] ?>">
                                            <source media="(max-width:991px)" srcset="<?= $val["arPictSizes"]["BIG"]["src"] ?>">
                                            <img class="lazyload" data-src="<?= $val["VIDEO_POSTER_SRC"] ?>" src="<?= $val["arPictSizes"]["SMALL"]["src"] ?>" alt="">
                                        </picture>
                                        <? if (mb_strlen($val["VIDEO_POSTER_DESC"]) > 0) { ?>
                                            <figcaption><?= $val["VIDEO_POSTER_DESC"] ?></figcaption>
                                        <? } ?>
                                    </figure>
                                </a>
                            </div>
                        <? } ?>
                    </div>
                </div>
            </div>
            <?/**/ ?>
        <? }
        // <-- Если несколько картинок, то выводим слайдер

        // Если одна картинка -->
        else if (count($arResult["arVideo"]) == 1) {
        ?>
            <? foreach ($arResult["arVideo"] as $key => $val) { ?>
                <a class="ml-video-link" rel="nofollow" href="<?= $val["VIDEO_LINK"] ?>" data-fancybox="cartoon-series">
                    <figure>
                        <picture>
                            <source media="(max-width:480px)" srcset="<?= $val["arPictSizes"]["MEDIUM"]["src"] ?>">
                            <source media="(max-width:991px)" srcset="<?= $val["arPictSizes"]["BIG"]["src"] ?>">
                            <img class="lazyload" data-src="<?= $val["VIDEO_POSTER_SRC"] ?>" src="<?= $val["arPictSizes"]["SMALL"]["src"] ?>" alt="">
                        </picture>
                        <? if (mb_strlen($arResult['PROPERTIES']['VIDEO_POSTER']['DESCRIPTION']) > 0) : ?>
                            <figcaption><?= $arResult['PROPERTIES']['VIDEO_POSTER']['DESCRIPTION'] ?></figcaption>
                        <? endif; ?>
                    </figure>
                </a>
            <? } ?>
        <? }
        /* 
        else if (!empty($arResult['PROPERTIES']['VIDEO_POSTER']['VALUE']) && mb_strlen($arResult['PROPERTIES']['VIDEO_LINK']['VALUE']) > 0) {
        ?>
            <a class="ml-video-link" rel="nofollow" href="<?= $arResult['PROPERTIES']['VIDEO_LINK']['VALUE'] ?>" data-fancybox="cartoon-series">
                <figure>
                    <picture>
                        <img src="<?= CFile::GetPath($arResult['PROPERTIES']['VIDEO_POSTER']['VALUE']); ?>" alt="" />
                    </picture>
                    <? if (mb_strlen($arResult['PROPERTIES']['VIDEO_POSTER']['DESCRIPTION']) > 0) : ?>
                        <figcaption><?= $arResult['PROPERTIES']['VIDEO_POSTER']['DESCRIPTION'] ?></figcaption>
                    <? endif; ?>
                </figure>
            </a>
        <? }
        */
        // <-- Если одна картинка
        ?>

        <? if (mb_strlen($arResult['DETAIL_TEXT']) > 0) : ?>
            <div class="row">
                <div class="col-lg-9">
                    <h2 class="ml-content-title">О мультфильме</h2>
                    <?
                    $obParser = new CTextParser;
                    $previewText = $obParser->html_cut($arResult['DETAIL_TEXT'], 600);
                    $detailText = $arResult['DETAIL_TEXT'];
                    $descLength = mb_strlen($arResult['DETAIL_TEXT']);
                    if ($descLength > 900) :
                    ?>
                        <div class="ml-section-preview-text"><?= $previewText ?></div>
                        <div class="ml-section-detail-text"><?= $detailText ?></div>
                        <div class="ml-content-actions">
                            <button data-entity="show-movie-detail-text" class="ml-btn ml-btn_round" type="button">Читать далее</button>
                        </div>
                    <? else : ?>
                        <?= $detailText ?>
                    <? endif; ?>
                </div>
            </div>
        <? endif; ?>

    </div>

