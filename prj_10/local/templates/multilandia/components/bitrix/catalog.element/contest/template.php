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

<div class="ml-page-content ml-contest-detail">
	<div class="container">
		<div class="ml-contest-detail__top">
			<div class="row">
				<div class="col-lg-6 col-xl-5">
					<?
					if (!empty($actualItem['MORE_PHOTO'])) {
						foreach ($actualItem['MORE_PHOTO'] as $key => $photo) {
					?>
						<picture><img class="lazyload" data-src="<?= $photo['SRC'] ?>" alt="<?= $alt ?>" title="<?= $title ?>" /></picture>
					<?
						}
					}
					?>
				</div>
				<div class="col-lg-6 col-xl-7">
					<?
					$dateStartFormat = FormatDate('d.m', strtotime($arResult['PROPERTIES']['DATE_START']['VALUE']));
					$dateEndFormat = FormatDate('d.m.Y', strtotime($arResult['PROPERTIES']['DATE_END']['VALUE']));
					?>
					<? if ($arResult['IS_ACTIVE_CONTEST']): ?>
						<p class="ml-contest-detail__dates">
							<?= Loc::getMessage('CONTEST_ACTIVE_TIME', array('#DATE_START#' => $dateStartFormat, '#DATE_END#' => $dateEndFormat)) ?>
						</p>
						<?
						// Счётчик -->
						if( $arResult["SHOW"]["COUNTER"] == "Y" )
						{
						?>
						<div class="ml-timer ml-contest-detail__timer" data-end="<? echo $arResult["arContest"]["DATE_END_COUNT"]; ?>"></div>
						<?
						}
						// <-- Счётчик
						?>
						<?
						if ($arResult["SHOW"]["BUTTON_PARTICIPATE"] == "Y") {
							?>
							<button class="ml-btn ml-btn_round" type="button"
								data-modal="#<?= $arParams["arDevParams"]["arModalsParams"]["contest_cur_modal_id"]; ?>"
							><?= Loc::getMessage('CONTEST_PARTICIPATE') ?></button>
						<?
						}
						?>
					<? else: ?>
						<div class="ml-contest-detail__complete-caption">
							<div class="ml-contest-detail__complete-btn">
								<?= Loc::getMessage('CONTEST_COMPLETE_STATUS') ?>
							</div>
							<div class="ml-contest-detail__complete-dates">
								<?= Loc::getMessage('CONTEST_COMPLETE_TIME', array('#DATE_START#' => $dateStartFormat, '#DATE_END#' => $dateEndFormat)) ?>
							</div>
						</div>
					<? endif; ?>
				</div>
			</div>
		</div>

		<? if (mb_strlen($arResult['DETAIL_TEXT']) > 0): ?>
			<div class="ml-contest-detail__desc">
				<div class="row">
					<div class="col-lg-9">
						<?/* Этот заголовок не выводится?
 						<h2 class="ml-contest-detail__desc-title">Условия конкурса</h2>
 						*/?>
						<?= $arResult['DETAIL_TEXT'] ?>
					</div>
				</div>
			</div>
		<? endif; ?>

		<?/* TO_DO здесь может быть слайдер, см. макет страницы мультфильма */ 
		if (!empty($arResult['PROPERTIES']['VIDEO_POSTER']['VALUE']) && mb_strlen($arResult['PROPERTIES']['VIDEO_LINK']['VALUE']) > 0): ?>
			<div class="ml-contest-detail__video">
				<a class="ml-video-link" rel="nofollow" href="<?= $arResult['PROPERTIES']['VIDEO_LINK']['VALUE'] ?>" data-fancybox="contest-video">
					<figure>
						<picture>
							<img class="lazyload" data-src="<?= CFile::GetPath($arResult['PROPERTIES']['VIDEO_POSTER']['VALUE']); ?>" alt="" />
						</picture>
						<? if (mb_strlen($arResult['PROPERTIES']['VIDEO_POSTER']['DESCRIPTION']) > 0): ?>
							<figcaption><?= $arResult['PROPERTIES']['VIDEO_POSTER']['DESCRIPTION'] ?></figcaption>
						<? endif; ?>
					</figure>
				</a>
			</div>
		<? endif; ?>

		<? if (mb_strlen($arResult['PROPERTIES']['CONDITIONS']['~VALUE']['TEXT']) > 0): ?>
			<div class="ml-contest-detail__rules">
				<div class="row">
					<div class="col-lg-9">
						<?
						$obParser = new CTextParser;
						$previewTextConditions = $obParser->html_cut($arResult['PROPERTIES']['CONDITIONS']['~VALUE']['TEXT'], 500);
						$detailTextConditions = $arResult['PROPERTIES']['CONDITIONS']['~VALUE']['TEXT'];
						$detailTextConditionsLength = mb_strlen( $arResult['PROPERTIES']['CONDITIONS']['~VALUE']['TEXT']);
						?>
						<a name="<? echo $arParams["arDevParams"]["arContestParams"]["ANCHOR_TO_CONTEST_RULES"]; ?>"></a>
						<?/* Этот заголовок не выводится?
 						<h2 class="ml-contest-detail__rules-title">Условия конкурса</h2>
 						*/?>
						<?
						if ($detailTextConditionsLength > 750): ?>
							<div class="ml-contest-detail__rules-desc">
								<div class="ml-section-preview-text-conditions">
									<?= $previewTextConditions ?>
								</div>
								<div class="ml-section-detail-text-conditions">
									<?= $detailTextConditions ?>
								</div>
							</div>
							<div class="ml-contest-detail__rules-actions">
								<button data-entity="show-contest-detail-text-conditions" class="ml-btn ml-btn_round ml-contest-detail__rules-btn" type="button"><?= Loc::getMessage('CONTEST_FULL_CONDITIONS') ?></button>
							</div>
						<? else: ?>
							<div class="ml-contest-detail__rules-desc">
								<?= $detailTextConditions ?>
							</div>
						<? endif; ?>
					</div>
				</div>
			</div>
		<? endif; ?>

		<? if (!empty($arResult['PROPERTIES']['BANNER']['VALUE'])): ?>
			<div class="ml-contest-detail__banner">
				<picture class="ml-section-img">
					<img src="<?= CFile::GetPath($arResult['PROPERTIES']['BANNER']['VALUE']); ?>" alt="" />
				</picture>
			</div>
		<? endif; ?>

		<? if ($arResult['IS_ACTIVE_CONTEST'] && $arResult["SHOW"]["BUTTON_PARTICIPATE"] == "Y"): ?>
			<div class="ml-contest-detail__actions">
				<p class="ml-contest-detail__actions-title"><?= $arResult['PROPERTIES']['CALL_TO_ACTION']['VALUE'] ?></p>
				<button data-modal="#<?= $arParams["arDevParams"]["arModalsParams"]["contest_cur_modal_id"]; ?>"
						class="ml-btn ml-btn_round ml-contest-detail__actions-btn" type="button">
					<?= Loc::getMessage('CONTEST_PARTICIPATE') ?></button>
			</div>
		<? endif; ?>

	</div>
</div>

<?
/*
// Hiddens -->
?>
<input id="CONTEST_ELEMENT_ID" type="hidden" value="<? echo $arParams["ELEMENT_ID"]; ?>" />
<?
// <-- Hiddens
*/
?>