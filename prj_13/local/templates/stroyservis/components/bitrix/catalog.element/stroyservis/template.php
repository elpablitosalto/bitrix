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
 * @var string $templateFolder
 */

$this->setFrameMode(true);
//$this->addExternalCss('/bitrix/css/main/bootstrap.css');

$templateLibrary = array('popup', 'fx', 'ui.fonts.opensans');
$currencyList = '';

if (!empty($arResult['CURRENCIES'])) {
	$templateLibrary[] = 'currency';
	$currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}

$haveOffers = !empty($arResult['OFFERS']);

$templateData = [
	'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
	'TEMPLATE_LIBRARY' => $templateLibrary,
	'CURRENCIES' => $currencyList,
	'ITEM' => [
		'ID' => $arResult['ID'],
		'IBLOCK_ID' => $arResult['IBLOCK_ID'],
	],
];
if ($haveOffers) {
	$templateData['ITEM']['OFFERS_SELECTED'] = $arResult['OFFERS_SELECTED'];
	$templateData['ITEM']['JS_OFFERS'] = $arResult['JS_OFFERS'];
}
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
$productType = $arResult['PRODUCT']['TYPE'];

$arParams['MESS_BTN_BUY'] = $arParams['MESS_BTN_BUY'] ?: Loc::getMessage('CT_BCE_CATALOG_BUY');
$arParams['MESS_BTN_ADD_TO_BASKET'] = $arParams['MESS_BTN_ADD_TO_BASKET'] ?: Loc::getMessage('CT_BCE_CATALOG_ADD');

if ($arResult['MODULES']['catalog'] && $arResult['PRODUCT']['TYPE'] === ProductTable::TYPE_SERVICE) {
	$arParams['~MESS_NOT_AVAILABLE'] = $arParams['~MESS_NOT_AVAILABLE_SERVICE']
		?: Loc::getMessage('CT_BCE_CATALOG_NOT_AVAILABLE_SERVICE');
	$arParams['MESS_NOT_AVAILABLE'] = $arParams['MESS_NOT_AVAILABLE_SERVICE']
		?: Loc::getMessage('CT_BCE_CATALOG_NOT_AVAILABLE_SERVICE');
} else {
	$arParams['~MESS_NOT_AVAILABLE'] = $arParams['~MESS_NOT_AVAILABLE']
		?: Loc::getMessage('CT_BCE_CATALOG_NOT_AVAILABLE');
	$arParams['MESS_NOT_AVAILABLE'] = $arParams['MESS_NOT_AVAILABLE']
		?: Loc::getMessage('CT_BCE_CATALOG_NOT_AVAILABLE');
}

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
//vardump($arResult);
//echo ' = '.$arResult['PROPERTIES']['RAITING_VAL']['VALUE'].'<br />';
//vardump($price);
?>
<? $this->SetViewTarget("AFTER_H1_BLOCK"); ?>
<div class="card-title__title-wrapper">
	<? if (strlen($arResult['PROPERTIES']['CML2_ARTICLE']['VALUE']) > 0) { ?>
		<div class="card-title__code">Арт. <?= $arResult['PROPERTIES']['CML2_ARTICLE']['VALUE']; ?></div>
	<? } ?>
	<? if ($arResult['AVERAGE_RATING'] > 0) { ?>
		<div class="card-title__rating" itemprop="aggregateRating">
			<meta itemprop="worstRating" content="0">
			<meta itemprop="bestRating" content="5">
			<meta itemprop="ratingValue" content="<?= $arResult['PROPERTIES']['RAITING_VAL']['VALUE']; ?>">
			<meta itemprop="ratingCount" content="<?= $arResult['PROPERTIES']['RAITING_COUNT']['VALUE']; ?>" />
			<?
			for ($i = 1; $i <= 5; $i++) {
				if ($i <= $arResult['AVERAGE_RATING']) { ?>
					<span class="card-title__rating_full"></span>
					<?
				} else if ($i > $arResult['AVERAGE_RATING']) {
					$val = (float)$arResult['AVERAGE_RATING'];
					if ($i == ceil($val)) {
					?>
						<span class="card-title__rating_half"></span>
					<?
					} else {
					?>
						<span></span><?
									}
								}
							}
										?>
			<? if (intval($arResult['REVIEWS_COUNT']) > 0) { ?>
				<div class="card-title__review">
					<?= Indexis::num2word($arResult['REVIEWS_COUNT'], ['#NUM# отзыв', '#NUM# отзыва', '#NUM# отзывов']) ?>
				</div>
			<? } ?>
		</div>
	<? } ?>
</div>
<? $this->EndViewTarget(); ?>

<div class="card-title__wrapper" id="<?= $itemIds['ID'] ?>">
	<? if (count($arResult['PICTURES']) > 0) { ?>
		<div class="card-title__images" id="<?= $itemIds['BIG_SLIDER_ID'] ?>">
			<div class="card-title__images-slider">
				<div class="card-title__images-wrapper" data-entity="images-container">
					<? foreach ($arResult['PICTURES'] as $key => $photo) { ?>
						<div class="card-title__image" itemscope itemtype="https://schema.org/ImageObject">
							<a href="<?= $photo['SRC'] ?>" data-fancybox="gallery">
								<img itemprop="image" src="<?= $photo['SRC'] ?>" alt="<?= $photo['ALT'] ?>" title="<?= $photo['TITLE'] ?>" />
							</a>
						</div>
					<? } ?>
					<? foreach ($arResult['arVideos'] as $key => $val) { ?>
						<div class="card-title__image">
							<div class="card-title__images-video">
								<iframe width="439" height="247" src="<?= $val; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
							</div>
						</div>
					<? } ?>
				</div>
				<div class="card-title__images-pagination"></div>
			</div>

			<div class="card-title__image-wrapper">
				<? if ($arResult['HIDE_PRICE'] != 'Y') { ?>
					<? if ($arResult['SHOW_PRICE_BEFORE_DISCOUNT'] == 'Y') { ?>
						<span class="card-title__percent"><?= $arResult['DISCOUNT_PERSENT'] ?>%</span>
					<? } ?>
				<? } ?>
				<? if ($arResult['BESTSELLER'] == 'Y') { ?>
					<span class="card-title__bestseller">Хит продаж</span>
				<? } ?>
			</div>

			<div class="card-title__images-sliders-wrapper">
				<div class="card-title__image-slider">
					<div class="card-title__image-slider-wrapper">
						<?
						$i = 0;
						foreach ($arResult['PICTURES'] as $key => $photo) {
							$i++;
							$ext_class = '';
							if ($i == 1) {
								$ext_class = 'card-title__image-slide_active';
							}
						?>
							<div class="card-title__image-slide <?= $ext_class; ?>">
								<img src="<?= $photo['SRC_SLIDE'] ?>" alt="<?= $photo['ALT'] ?>" alt="<?= $photo['TITLE'] ?>" />
							</div>
						<? } ?>
						<? foreach ($arResult['arVideos'] as $key => $val) { ?>
							<div class="card-title__image-slide card-title__image-slider-video">
								<svg width="23" height="17">
									<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/icons/sprite/svg-sprite.svg#youtube_black"></use>
								</svg>
							</div>
						<? } ?>
					</div>
				</div>
				<button class="card-title__image-slider-navigation card-title__image-slider-navigation_prev"></button>
				<button class="card-title__image-slider-navigation card-title__image-slider-navigation_next"></button>
			</div>

			<? if ($arResult['OUT_OF_PRODUCTION'] == 'Y') { ?>
				<div class="card-title__image-off"></div>
			<? } ?>
		</div>
	<? } ?>
	<?
	$currentWeight = preg_replace( '/[^0-9\.]/', '', $arResult['PROPERTIES']['VES_ATTR_S']['VALUE']);
	?>
	<div class="card-title__characteristics-wrapper">
		<div class="card-title__characteristic-wrapper">
			<? if (!empty($arResult['arColors'])) { ?>
				<div class="card-title__color">
					<?
					$arCurColor = $arResult['curGroupProduct']['COLOR'];
					if (!empty($arCurColor)) { ?>
						<p class="card-title__color-name">
							Цвет: <span><?/*=$arCurColor['UF_NUM_COLOR_CATALOG'] */ ?> <?= $arCurColor['UF_NAME'] ?></span>
						</p>
					<? } ?>
					<ul class="card-title__color-wrapper">
						<?
						$index = 0;
						foreach ($arResult['arColors'] as $ind => $ar_el) {
							$active = '';
							//if ($ar_el['ACTIVE'] == 'Y') {

							if ($currentWeight != $ar_el['WEIGHT'])
								continue;

							if ($ar_el['COLOR']['UF_XML_ID'] == $arResult['curColor']['UF_XML_ID']) {
								$active = ' card-title__colors-active';
							}
						?>
							<li class="card-title__colors<?if ($index > 2):?> display-none<?endif;?>">
								<a target="_self" href="<?= $ar_el['DETAIL_PAGE_URL'] ?>">
									<div class="card-title__colors-block <?= $active ?>">
										<div class="card-title__colors-color" style="border: 2px solid #EEE<?/*?><?= $ar_el['COLOR']['UF_COLOR']; ?><?*/ ?>; background-color: #<?= $ar_el['COLOR']['UF_COLOR']; ?>"></div>
									</div><?= $ar_el['COLOR']['UF_NUM_COLOR_CATALOG']; ?>
								</a>
							</li>
							<?
							$index++;
							?>
						<? } ?>
						<? if (count($arResult['arColors']) > 3) { ?>
							<li class="card-title__colors">
								<button></button>
							</li>
						<? } ?>
					</ul>
				</div>
			<? } ?>
			<? if (!empty($arResult['arLengths'])) { ?>
				<div class="card-title__weight">
					<p class="card-title__weight-name">
						Длина, м:
					<ul class="card-title__weight-wrapper">
						<?
						foreach ($arResult['arLengths'] as $length => $ar_el) {
							$active = '';
							if ($ar_el['LENGTH'] == $arResult['curLength']) {
								$active = ' card-title__weights-active';
							}
							?>
							<li class="card-title__weights">
								<a class="<?= $active; ?>" target="_self" href="<?= $ar_el['DETAIL_PAGE_URL'] ?>"><?= $length; ?></a>
							</li>
						<? } ?>
					</ul>
					</p>
				</div>
			<? } ?>
			<? if (!empty($arResult['arWeights'])) { ?>
				<div class="card-title__weight">
					<p class="card-title__weight-name">
						Вес товара, кг:
					<ul class="card-title__weight-wrapper">
						<?
						foreach ($arResult['arWeights'] as $weight => $ar_el) {
							$active = '';
							//if ($ar_el['ACTIVE'] == 'Y') {
							if ($ar_el['WEIGHT'] == $arResult['curWeight']) {
								$active = ' card-title__weights-active';
							}
						?>
							<li class="card-title__weights">
								<a class="<?= $active; ?>" target="_self" href="<?= $ar_el['DETAIL_PAGE_URL'] ?>"><?= $weight; ?></a>
							</li>
						<? } ?>
					</ul>
					</p>
				</div>
			<? } ?>
		</div>
		<? if (!empty($arResult['arDisplayProperties'])) { ?>
			<div class="card-title__characteristics">
				<div class="card-title__characteristics-list">
					<?
					$i = 0;
					$max_characters = 6;
					if (!empty($arResult['UF_MAX_SHORT_CHARACTERS'])) {
						$max_characters = $arResult['UF_MAX_SHORT_CHARACTERS'];
					}
					foreach ($arResult['arDisplayProperties'] as $prop_code => $ar_prop) {
						$style = '';
						if ($i == $max_characters) {
							break;
							//$style = 'display: none;';
						}
					?>
						<dl style="<?= $style; ?>">
							<dt><span><?= $ar_prop['NAME'] ?>:</span></dt>
							<dd><?= $ar_prop['DISPLAY_VALUE'] ?></dd>
						</dl>
					<?
						$i++;
					} ?>
					<?
					//$count = count($arResult['arDisplayProperties']);
					$count = $i;
					if ($count > 3 || 1) { ?>
						<button>Все характеристики</button>
					<? } ?>
				</div>
				<? if (!empty($arResult['arBrand'])) { ?>
					<div class="card-title__characteristics-brand">
						<div class="card-title__characteristics-brand-image">
							<img src="<?= $arResult['arBrand']["PICTURE"]['SRC']; ?>" alt="<?= $arResult['arBrand']["PICTURE"]['ALT']; ?>" title="<?= $arResult['arBrand']["PICTURE"]['TITLE']; ?>" <? if (!empty($arResult['arBrand']['PICTURE']['WIDTH'])) { ?>width="<?= $arResult['arBrand']['PICTURE']['WIDTH'] ?>" <? } ?> <? if (!empty($arResult['arBrand']['PICTURE']['HEIGHT'])) { ?>height="<?= $arResult['arBrand']['PICTURE']['HEIGHT'] ?>" <? } ?> />
						</div>
						<? if (!empty($arResult['arBrand']['COUNTRY_HOME'])) { ?>
							<p><?= $arResult['arBrand']['COUNTRY_HOME']['NAME'] ?> - родина бренда</p>
						<? } ?>
						<? if (!empty($arResult['arBrand']['COUNTRY_MADE'])) { ?>
							<p><?= $arResult['arBrand']['COUNTRY_MADE']['NAME'] ?> - страна производства</p>
						<? } ?>
					</div>
				<? } ?>
				<div class="card-title__characteristics-documentation">
					<? if (!empty($arResult['arDocs'])) { ?>
						<div class="card-title__characteristics-documentation-wrapper">
							<p class="card-title__characteristics-documentation-title">Документация</p>
							<? foreach ($arResult['arDocs'] as $key => $arFile) { ?>
								<a target="_blank" href="<?= $arFile['SRC']; ?>"><?= $arFile['NAME']; ?></a>
							<? } ?>
						</div>
					<? } ?>
					<? if (!empty($arResult['arBrand']['PICTURE_CERT'])) { ?>
						<?
						$arFile = $arResult['arBrand']['PICTURE_CERT'];
						?>
						<button class="card-title__characteristics-certificate" data-fancybox src="<?= $arFile['SRC_ORIG'] ?>" data-link-image="<?= $arFile['SRC_ORIG'] ?>">
							<img src="<?= $arFile['SRC'] ?>" alt="<?= $arFile['ALT'] ?>" alt="<?= $arFile['TITLE'] ?>" <? if (!empty($arFile['WIDTH'])) { ?>width="<?= $arFile['WIDTH'] ?>" <? } ?> <? if (!empty($arFile['HEIGHT'])) { ?>height="<?= $arFile['HEIGHT'] ?>" <? } ?> />
						</button>
						<?/*?>
						<div class="popup popup-certificate">
							<div class="popup-certificate__image">
								<img src="<?= $arFile['SRC_ORIG'] ?>" alt="<?= $arFile['ALT'] ?>" alt="<?= $arFile['TITLE'] ?>" />
							</div>
							<button class="popup-form__popup_close"></button>
						</div>
						<?*/ ?>
					<? } ?>
				</div>
			</div>
		<? } ?>
	</div>
	<div class="card-title__characteristics-wrapper">
		<? if ($arResult['OUT_OF_PRODUCTION'] == 'Y' || $arResult['NOT_AVAILABLE'] == 'Y') { ?>
			<div class="card-title__ended-wrapper">
				<? if ($arResult['OUT_OF_PRODUCTION'] == 'Y') { ?>
					<p class="card-title__ended">Товар снят с производства</p>
				<? } else if ($arResult['NOT_AVAILABLE'] == 'Y') { ?>
					<p class="card-title__ended">Нет в наличии</p>
				<? } ?>
				<button class="card-title__ended-analog js_choose_analogue" data-product-name="<?= $arResult['NAME']; ?>" type="button">
					Подобрать аналог
					<svg width="56" height="36">
						<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/icons/sprite/svg-sprite.svg#button-image"></use>
					</svg>
				</button>
			</div>
			<div class="card-title__price" <?/*?>itemprop="offers" itemscope itemtype="https://schema.org/Offer"<?*/ ?>>
				<div class="card-title__wholesale">
					<?/*?>Оптовые скидки от <span>10 000 руб.</span><?*/ ?>
				</div>
			</div>
		<? } else { ?>
			<div class="card-title__price" itemprop="offers" itemscope itemtype="https://schema.org/Offer">
				<? if ($arResult['HIDE_PRICE'] != 'Y') { ?>
					<? if (((float)$arResult['PRICE']) > 0) { ?>
						<p class="card-title__price-title">Розничная цена</p>
					<? } ?>
					<? if ($arResult['SHOW_PRICE_BEFORE_DISCOUNT'] == 'Y') { ?>
						<p class="card-title__old-price">
							<span itemprop="price"><?= $arResult['BASE_PRICE']; ?></span>
							<meta itemprop="priceCurrency" content="₽/шт."> ₽/шт.
						</p>
					<? } ?>
					<?
					//echo 'PRICE = '.$arResult['PRICE'].'<br />';
					?>
					<? if (((float)$arResult['PRICE']) > 0) { ?>
						<?
						$add_class = '';
						if ($arResult['SHOW_PRICE_BEFORE_DISCOUNT'] == 'Y') {
							$add_class = 'card-title__cost-first_promotion';
						}
						?>
						<div class="card-title__cost <?= $add_class; ?>">
							<span class="card-title__cost-first <?= $add_class; ?>" id="<?= $itemIds['PRICE_ID'] ?>" itemprop="price"><?= $arResult['PRICE']; ?></span> ₽/шт.
							<span style="display: none;" itemprop="priceCurrency">RUB</span>
							<? if (strlen($arResult['PRICE_FOR_KG']) > 0) { ?>
								<span class="card-title__cost-second"><?= $arResult['PRICE_FOR_KG']; ?> ₽/кг.</span>
							<? } ?>
						</div>

						<?
						$bonusValue = Indexis::getBonusValueByPrice($arResult['PRICE']);
						if ($bonusValue > 0) :
							?>
							<div class="related__bonus">
								<div class="related__bonus_help">?</div>
								<?= Indexis::num2word($bonusValue, [
									'<span class="related__bonus_quantity">#NUM#</span> СтройБонус',
									'<span class="related__bonus_quantity">#NUM#</span> СтройБонуса',
									'<span class="related__bonus_quantity">#NUM#</span> СтройБонусов',
								]) ?>
							</div>
						<? endif; ?>
					<? } ?>
				<? } ?>
				<? if (((float)$arResult['QUANTITY']) > 0) { ?>
					<div class="card-title__price-quantity">
						На складе <span><?= $arResult['QUANTITY']; ?> шт.</span>
					</div>
				<? } else { ?>
					<p class="card-title__order <?/*?>card-title__image-none<?*/ ?>">
						Наличие: <span>под заказ 2-3 дня</span>
					</p>
				<? } ?>
				<?
				//echo 'CAN_BUY = '.$arResult['CAN_BUY'].'<br />';
				?>
				<? if ($arResult['HIDE_PRICE'] != 'Y') { ?>
					<? if ($arResult['CAN_BUY_CUSTOM'] == 'Y') { ?>
						<div id="<?= $itemIds['BASKET_ACTIONS_ID'] ?>">
							<button class="card-title__buy" type="button" id="<?= $itemIds['ADD_BASKET_LINK'] ?>">
								<span>Купить</span>
								<span class="card-title__image-none">Заказать</span>
							</button>
							<button class="card-title__fast-order" id="js_quick_order" data-product-id="<?= $arResult['ID'] ?>">
								Быстрый заказ
							</button>
						</div>
					<? } else if ($arResult['CAN_ORDER_CUSTOM'] == 'Y') { ?>
						<div <?/*?>id="<?= $itemIds['BASKET_ACTIONS_ID'] ?>"<?*/ ?>>
							<button class="card-title__buy js_product_on_order" data-product-name="<?= $arResult['NAME']; ?>" type="button">
								<span class="card-title__image-none">Купить</span>
								<span>Заказать</span>
							</button>
						</div>
					<? } ?>
				<? } ?>
				<? if ($arResult['CAN_BUY_ORDER_CUSTOM'] == 'Y') { ?>
					<div class="card-title__wholesale">
						<?
						$APPLICATION->IncludeComponent(
							"bitrix:main.include",
							"",
							array(
								"AREA_FILE_SHOW" => "file",
								"PATH" => "/include/static/bulk_discounts.php"
							)
						); ?>
					</div>
					<!--<br>-->
				<? } ?>
			</div>
			<? if ($arResult['HIDE_PRICE'] == 'Y' || empty($arResult['PRICE'])) { ?>
				<button class="card-title__buy-wholesale js_request_wholesale_price" data-formtype="know" data-product-name="<?= $arResult['NAME']; ?>" type="button">
					Узнать цену
					<svg width="56" height="36">
						<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/icons/sprite/svg-sprite.svg#button-image"></use>
					</svg>
				</button>
			<? } else if ($arResult['CAN_BUY_ORDER_CUSTOM'] == 'Y') { ?>
				<button class="card-title__buy-wholesale js_request_wholesale_price" data-formtype="wholesale" data-product-name="<?= $arResult['NAME']; ?>" type="button">
					Запросить оптовую цену
					<svg width="56" height="36">
						<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/icons/sprite/svg-sprite.svg#button-image"></use>
					</svg>
				</button>
			<? } ?>
		<? } ?>

		<? if ($arResult['OUT_OF_PRODUCTION'] != 'Y') { ?>
			<? if (!empty($arResult['arMarketPlaces'])) { ?>
				<div class="card-title__marketplace">
					В розницу этот товар можно купить у нас на маркетплейсах:
					<ul class="card-title__marketplace-list">
						<? if (strlen($arResult['arMarketPlaces']['LINK_OZON']) > 0) { ?>
							<li class="card-title__marketplace-item">
								<a target="_blank" rel="nofollow" href="<?= $arResult['arMarketPlaces']['LINK_OZON']; ?>">
									<img src="<?= SITE_TEMPLATE_PATH ?>/img/design/logo-ozon.png" alt="Ozon">
								</a>
							</li>
						<? } ?>
						<? if (strlen($arResult['arMarketPlaces']['LINK_WILDBERRIES']) > 0) { ?>
							<li class="card-title__marketplace-item">
								<a target="_blank" rel="nofollow" href="<?= $arResult['arMarketPlaces']['LINK_WILDBERRIES']; ?>">
									<img src="<?= SITE_TEMPLATE_PATH ?>/img/design/logo-wildberries.png" alt="Wildberries">
								</a>
							</li>
						<? } ?>
						<? if (strlen($arResult['arMarketPlaces']['LINK_YANDEX_MARKET']) > 0) { ?>
							<li class="card-title__marketplace-item">
								<a target="_blank" rel="nofollow" href="<?= $arResult['arMarketPlaces']['LINK_YANDEX_MARKET']; ?>">
									<img src="<?= SITE_TEMPLATE_PATH ?>/img/design/logo-yandexmarket.png" alt="Yandex Market">
								</a>
							</li>
						<? } ?>
						<? if (strlen($arResult['arMarketPlaces']['LINK_SBERMEGAMARKET']) > 0) { ?>
							<li class="card-title__marketplace-item">
								<a target="_blank" rel="nofollow" href="<?= $arResult['arMarketPlaces']['LINK_SBERMEGAMARKET']; ?>">
									<img src="<?= SITE_TEMPLATE_PATH ?>/img/design/logo-megamarket.svg" alt="Мега Маркет">
								</a>
							</li>
						<? } ?>
						<? if (strlen($arResult['arMarketPlaces']['LINK_LEROY_MERLIN']) > 0) { ?>
							<li class="card-title__marketplace-item">
								<a target="_blank" rel="nofollow" href="<?= $arResult['arMarketPlaces']['LINK_LEROY_MERLIN']; ?>">
									<img src="<?= SITE_TEMPLATE_PATH ?>/img/design/logo-leroymerlin.png" alt="Leroy Merlin">
								</a>
							</li>
						<? } ?>
					</ul>
				</div>
			<? } ?>
		<? } ?>
		<? if ($arResult['OUT_OF_PRODUCTION'] != 'Y') { ?>
			<div class="card-title__advantages">
				<?
				$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					array(
						"AREA_FILE_SHOW" => "file",
						"PATH" => "/include/static/detail_product_payment_shipping.php"
					)
				); ?>
			</div>
		<? } ?>
	</div>
</div>

<?
// Табы -->
$this->SetViewTarget('CatalogElementTabs');
?>
<ul class="card-main__list">
	<? if (!empty($arResult['arDisplayProperties'])) { ?>
		<li class="card-main__item"><a href="#characteristics">Характеристики</a></li>
	<? } ?>
	<? if (strlen($arResult['~DETAIL_TEXT']) > 0) { ?>
		<li class="card-main__item"><a href="#description">Описание</a></li>
	<? } ?>
	<? if (strlen($arResult['INSTRUCTION']) > 0) { ?>
		<li class="card-main__item"><a href="#instruction">Инструкция</a></li>
	<? } ?>
	<li class="card-main__item"><a href="#reviews">Отзывы <?= $arResult['REVIEWS_COUNT_SHOW']; ?></a></li>
	<li class="card-main__item"><a href="#questions">Задать вопрос <?= $arResult['QUESTIONS_COUNT_SHOW'] ?></a></li>
	<li class="card-main__item">
		<div class="card-main__mini">
			<div class="card-main__mini-wrapper">
				<div class="card-main__mini-image"><? foreach ($arResult['PICTURES'] as $key => $photo) { ?><img src="<?= $photo['SRC'] ?>" alt="<?= $photo['ALT'] ?>" alt="<?= $photo['TITLE'] ?>" /><? break; ?><? } ?></div>
				<p><? echo TruncateText($arResult['NAME'], 18); ?></p>
				<? if ($arResult['HIDE_PRICE'] != 'Y') { ?>
					<? if (!empty($arResult['PRICE'])) { ?>
						<div class="card-main__price"><?= $arResult['PRICE']; ?> <span>₽/шт.</span></div>
					<? } ?>
				<? } ?>
			</div>
			<div class="card-main__mini-wrapper">
				<? if ($arResult['OUT_OF_PRODUCTION'] == 'Y' || $arResult['NOT_AVAILABLE'] == 'Y') { ?>
					<button class="card-title__buy-wholesale js_choose_analogue" data-product-name="<?= $arResult['NAME']; ?>" type="button">
						Подобрать аналог
					</button>
				<? } else { ?>
					<? if ($arResult['HIDE_PRICE'] == 'Y') { ?>
						<button class="card-title__buy-wholesale js_request_wholesale_price" data-formtype="know" data-product-name="<?= $arResult['NAME']; ?>" type="button">
							Узнать цену
						</button>
					<? } else if ($arResult['CAN_BUY_ORDER_CUSTOM'] == 'Y') { ?>
						<button class="card-title__buy-wholesale js_request_wholesale_price" data-formtype="wholesale" data-product-name="<?= $arResult['NAME']; ?>" type="button">
							Запросить оптовую цену
						</button>
					<? } ?>
					<? if ($arResult['CAN_BUY_CUSTOM'] == 'Y') { ?>
						<button class="card-title__buy" type="button" onclick="$('#<?= $itemIds['ADD_BASKET_LINK'] ?>').click();" <?/*?>id="<?= $itemIds['ADD_BASKET_LINK'] ?>"<?*/ ?>>
							Купить
						</button>
					<? } else if ($arResult['CAN_ORDER_CUSTOM'] == 'Y') { ?>
						<button class="card-title__buy js_product_on_order" data-product-name="<?= $arResult['NAME']; ?>" type="button">
							Заказать
						</button>
					<? } ?>
				<? } ?>
			</div>
		</div>
	</li>
</ul>

<? if (!empty($arResult['arDisplayProperties'])) { ?>
	<div class="card-main__characteristics card-title__anchor" id="characteristics">
		<h2>Характеристики</h2>
		<div class="card-main__characteristics-list card-main__height">
			<?
			foreach ($arResult['arDisplayProperties'] as $prop_code => $ar_prop) {
			?>
				<dl>
					<dt><span><?= $ar_prop['NAME'] ?></span></dt>
					<dd><?= $ar_prop['DISPLAY_VALUE'] ?></dd>
				</dl>
			<? } ?>
		</div>
		<!-- <button class="card-main__button card-main__characteristics-button card-main__button_close"></button> -->
	</div>
<? } ?>
<? if ($arResult['SHOW_BANNER'] == 'Y') { ?>
	<div class="card-main__colors">
		<?
		$APPLICATION->IncludeComponent(
			"bitrix:main.include",
			"",
			array(
				"AREA_FILE_SHOW" => "file",
				"PATH" => "/include/static/find_perfect_color.php"
			)
		); ?>
	</div>
<? } else { ?>
	<br /><br />
<? } ?>
<? if (!empty($arResult['arVideos'])) { ?>
	<div class="card-main__video">
		<? foreach ($arResult['arVideos'] as $key => $val) { ?>
			<iframe width="1150" height="647" src="<?= $val; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
		<?
			break;
		} ?>
	</div>
<? } ?>
<? if (strlen($arResult['~DETAIL_TEXT']) > 0) { ?>
	<div class="card-main__description card-title__anchor" id="description" itemprop="description">
		<h2>Описание</h2>
		<div class="card-main__description-wrapper card-main__height">
			<? echo $arResult['~DETAIL_TEXT'] ?>
		</div>
		<!-- <button class="card-main__button card-main__description-button card-main__button_close"></button> -->
	</div>
<? } ?>
<? if (strlen($arResult['INSTRUCTION']) > 0) { ?>
	<div class="card-main__instruction card-title__anchor" id="instruction" itemscope itemtype="https://schema.org/HowTo">
		<h2>Инструкция</h2>
		<div class="card-main__instruction-wrapper card-main__height">
			<?= $arResult['INSTRUCTION']; ?>
		</div>
		<!-- <button class="card-main__button card-main__instruction-button card-main__button_close"></button> -->
	</div>
<? } ?>
<?
$this->EndViewTarget();
// <-- Табы

// Попап цветов и весов -->
?>
<? if (!empty($arResult['arColors']) || !empty($arResult['arWeights'])) { ?>
	<input type="hidden" id="click_popup_colors_weights" value="Y" />
	<div class="popup order-color">
		<div class="order-color__wrapper">
			<h2>Все варианты товара</h2>
			<div class="order-color__name js_popup_colors_weights_name_wrapper">
				<div class="order-color__image">
					<? foreach ($arResult['PICTURES'] as $key => $photo) { ?>
						<img src="<?= $photo['SRC'] ?>" alt="<?= $photo['ALT'] ?>" title="<?= $photo['TITLE'] ?>" />
						<? break; ?>
					<? } ?>
				</div>
				<div class="order-color__name_wrapper">
					<div class="order-color__title"><?= $arResult['NAME']; ?></div>
					<? if (((float)$arResult['PRICE']) > 0) { ?>
						<div class="order-color__price">
							<span class="order-color__price_coast"><?= number_format($arResult['PRICE'], 0, ',', ' '); ?></span>
							<span class="order-color__price_ruble">₽/</span>
							<span class="order-color__price_piece">шт.</span>
						</div>
					<? } ?>
				</div>
			</div>
			<? if (!empty($arResult['arColors'])) { ?>
				<div class="card-title__color">
					<p class="card-title__color-name js_popup_colors_weights_color_wrapper">
						Цвет: <span><?/*=$arCurColor['UF_NUM_COLOR_CATALOG'] */ ?> <?= $arCurColor['UF_NAME'] ?></span>
					</p>
					<ul class="card-title__color-wrapper">
						<?
						foreach ($arResult['arColors'] as $ind => $ar_el) {
							$active = '';
							if ($ar_el['COLOR']['UF_XML_ID'] == $arResult['curColor']['UF_XML_ID'] && $currentWeight == $ar_el['WEIGHT']) {
								$active = ' card-title__colors-active';
							}
						?>
							<li class="card-title__colors<?if ($currentWeight != $ar_el['WEIGHT']):?> display-none<?endif;?>">
								<a data-weight="<?=$ar_el['WEIGHT']?>" data-color="<?=$ar_el['COLOR']['UF_NUM_COLOR_CATALOG']?>" class="js_popup_colors_weights_link js_popup_colors_link" data-type="colors" href="#" data-url="<?= $ar_el['DETAIL_PAGE_URL'] ?>">
									<div class="card-title__colors-block <?= $active; ?>">
										<div class="card-title__colors-color" style="border: 2px solid #EEE<?/*?><?= $ar_el['COLOR']['UF_COLOR']; ?><?*/ ?>; background-color: #<?= $ar_el['COLOR']['UF_COLOR']; ?>"></div>
									</div><?= $ar_el['COLOR']['UF_NUM_COLOR_CATALOG']; ?>
								</a>
							</li>
						<? } ?>
					</ul>
				</div>
			<? } ?>

			<? if (!empty($arResult['arWeights'])) { ?>
				<div class="card-title__weight">
					<p class="card-title__weight-name">
						Вес товара, кг:
					<ul class="card-title__weight-wrapper">
						<?
						foreach ($arResult['arWeights'] as $weight => $ar_el) {
							$active = '';
							//if ($ar_el['ACTIVE'] == 'Y') {
							if ($ar_el['WEIGHT'] == $arResult['curWeight']) {
								$active = ' card-title__weights-active';
							}
						?>
							<li class="card-title__weights">
								<a data-weight="<?= $weight; ?>" class="<?= $active; ?> js_popup_colors_weights_link js_popup_weights_link" data-type="weights" target="_self" href="#" data-url="<?= $ar_el['DETAIL_PAGE_URL'] ?>">
									<?= $weight; ?>
								</a>
							</li>
						<? } ?>
					</ul>
					</p>
				</div>
			<? } ?>
		</div>
		<div class="card-title__control">
			<input type="hidden" id="js_id_popup_colors_weights_link" value="<?= $_SERVER['REQUEST_URI']; ?>" />
			<a class="button-orange js_popup_colors_weights_choose_button" href="#">Выбрать</a>
			<a class="card-title__buy" href="#">Отмена</a>
		</div>
		<button class="popup-form__popup_close"></button>
	</div>
<? } ?>
<?
// <-- Попап цветов и весов

// Сопутствующие, аналоги, вы смотрели -->
$this->SetViewTarget('RelatedSimilarViewed');
?>
<? if (!empty($arResult['PROPERTIES']['RELATED_PRODUCTS']['VALUE'])) { ?>
	<?
	$APPLICATION->IncludeFile(
		SITE_DIR . 'include/catalog/related_similar.php',
		array(
			"filterCode" => "arrFilterRelatedProductsCard",
			"arrFilterRelatedProductsCard" => array("ID" => $arResult['PROPERTIES']['RELATED_PRODUCTS']['VALUE']),
			"template" => "related",
		),
		array('SHOW_BORDER' => false)
	);
	?>
<? } ?>
<? if (!empty($arResult['PROPERTIES']['ANALOG_PRODUCTS']['VALUE'])) { ?>
	<?
	$APPLICATION->IncludeFile(
		SITE_DIR . 'include/catalog/related_similar.php',
		array(
			"filterCode" => "arrFilterSimilarProductsCard",
			"arrFilterSimilarProductsCard" => array("ID" => $arResult['PROPERTIES']['ANALOG_PRODUCTS']['VALUE']),
			"template" => "similar",
		),
		array('SHOW_BORDER' => false)
	);
	?>
<? } ?>
<?
$APPLICATION->IncludeFile(
	SITE_DIR . 'include/catalog/products_viewed.php',
	array(),
	array('SHOW_BORDER' => false)
);
?>
<?
$this->EndViewTarget();
// <-- 
?>
<?
if ($haveOffers) {
	$offerIds = array();
	$offerCodes = array();

	$useRatio = $arParams['USE_RATIO_IN_RANGES'] === 'Y';

	foreach ($arResult['JS_OFFERS'] as $ind => &$jsOffer) {
		$offerIds[] = (int)$jsOffer['ID'];
		$offerCodes[] = $jsOffer['CODE'];

		$fullOffer = $arResult['OFFERS'][$ind];
		$measureName = $fullOffer['ITEM_MEASURE']['TITLE'];

		$strAllProps = '';
		$strMainProps = '';
		$strPriceRangesRatio = '';
		$strPriceRanges = '';

		if ($arResult['SHOW_OFFERS_PROPS']) {
			if (!empty($jsOffer['DISPLAY_PROPERTIES'])) {
				foreach ($jsOffer['DISPLAY_PROPERTIES'] as $property) {
					$current = '<dt>' . $property['NAME'] . '</dt><dd>' . (is_array($property['VALUE'])
						? implode(' / ', $property['VALUE'])
						: $property['VALUE']
					) . '</dd>';
					$strAllProps .= $current;

					if (isset($arParams['MAIN_BLOCK_OFFERS_PROPERTY_CODE'][$property['CODE']])) {
						$strMainProps .= $current;
					}
				}

				unset($current);
			}
		}

		if ($arParams['USE_PRICE_COUNT'] && count($jsOffer['ITEM_QUANTITY_RANGES']) > 1) {
			$strPriceRangesRatio = '(' . Loc::getMessage(
				'CT_BCE_CATALOG_RATIO_PRICE',
				array('#RATIO#' => ($useRatio
					? $fullOffer['ITEM_MEASURE_RATIOS'][$fullOffer['ITEM_MEASURE_RATIO_SELECTED']]['RATIO']
					: '1'
				) . ' ' . $measureName)
			) . ')';

			foreach ($jsOffer['ITEM_QUANTITY_RANGES'] as $range) {
				if ($range['HASH'] !== 'ZERO-INF') {
					$itemPrice = false;

					foreach ($jsOffer['ITEM_PRICES'] as $itemPrice) {
						if ($itemPrice['QUANTITY_HASH'] === $range['HASH']) {
							break;
						}
					}

					if ($itemPrice) {
						$strPriceRanges .= '<dt>' . Loc::getMessage(
							'CT_BCE_CATALOG_RANGE_FROM',
							array('#FROM#' => $range['SORT_FROM'] . ' ' . $measureName)
						) . ' ';

						if (is_infinite($range['SORT_TO'])) {
							$strPriceRanges .= Loc::getMessage('CT_BCE_CATALOG_RANGE_MORE');
						} else {
							$strPriceRanges .= Loc::getMessage(
								'CT_BCE_CATALOG_RANGE_TO',
								array('#TO#' => $range['SORT_TO'] . ' ' . $measureName)
							);
						}

						$strPriceRanges .= '</dt><dd>' . ($useRatio ? $itemPrice['PRINT_RATIO_PRICE'] : $itemPrice['PRINT_PRICE']) . '</dd>';
					}
				}
			}

			unset($range, $itemPrice);
		}

		$jsOffer['DISPLAY_PROPERTIES'] = $strAllProps;
		$jsOffer['DISPLAY_PROPERTIES_MAIN_BLOCK'] = $strMainProps;
		$jsOffer['PRICE_RANGES_RATIO_HTML'] = $strPriceRangesRatio;
		$jsOffer['PRICE_RANGES_HTML'] = $strPriceRanges;
	}

	$templateData['OFFER_IDS'] = $offerIds;
	$templateData['OFFER_CODES'] = $offerCodes;
	unset($jsOffer, $strAllProps, $strMainProps, $strPriceRanges, $strPriceRangesRatio, $useRatio);

	$jsParams = array(
		'CONFIG' => array(
			'USE_CATALOG' => $arResult['CATALOG'],
			'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
			'SHOW_PRICE' => true,
			'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'] === 'Y',
			'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'] === 'Y',
			'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
			'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
			'SHOW_SKU_PROPS' => $arResult['SHOW_OFFERS_PROPS'],
			'OFFER_GROUP' => $arResult['OFFER_GROUP'],
			'MAIN_PICTURE_MODE' => $arParams['DETAIL_PICTURE_MODE'],
			'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
			'SHOW_CLOSE_POPUP' => $arParams['SHOW_CLOSE_POPUP'] === 'Y',
			'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
			'RELATIVE_QUANTITY_FACTOR' => $arParams['RELATIVE_QUANTITY_FACTOR'],
			'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
			'USE_STICKERS' => true,
			'USE_SUBSCRIBE' => $showSubscribe,
			'SHOW_SLIDER' => $arParams['SHOW_SLIDER'],
			'SLIDER_INTERVAL' => $arParams['SLIDER_INTERVAL'],
			'ALT' => $alt,
			'TITLE' => $title,
			'MAGNIFIER_ZOOM_PERCENT' => 200,
			'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
			'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
			'BRAND_PROPERTY' => !empty($arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']])
				? $arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']]['DISPLAY_VALUE']
				: null,
			'SHOW_SKU_DESCRIPTION' => $arParams['SHOW_SKU_DESCRIPTION'],
			'DISPLAY_PREVIEW_TEXT_MODE' => $arParams['DISPLAY_PREVIEW_TEXT_MODE']
		),
		'PRODUCT_TYPE' => $arResult['PRODUCT']['TYPE'],
		'VISUAL' => $itemIds,
		'DEFAULT_PICTURE' => array(
			'PREVIEW_PICTURE' => $arResult['DEFAULT_PICTURE'],
			'DETAIL_PICTURE' => $arResult['DEFAULT_PICTURE']
		),
		'PRODUCT' => array(
			'ID' => $arResult['ID'],
			'ACTIVE' => $arResult['ACTIVE'],
			'NAME' => $arResult['~NAME'],
			'CATEGORY' => $arResult['CATEGORY_PATH'],
			'DETAIL_TEXT' => $arResult['DETAIL_TEXT'],
			'DETAIL_TEXT_TYPE' => $arResult['DETAIL_TEXT_TYPE'],
			'PREVIEW_TEXT' => $arResult['PREVIEW_TEXT'],
			'PREVIEW_TEXT_TYPE' => $arResult['PREVIEW_TEXT_TYPE']
		),
		'BASKET' => array(
			'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
			'BASKET_URL' => $arParams['BASKET_URL'],
			'SKU_PROPS' => $arResult['OFFERS_PROP_CODES'],
			'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
			'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE']
		),
		'OFFERS' => $arResult['JS_OFFERS'],
		'OFFER_SELECTED' => $arResult['OFFERS_SELECTED'],
		'TREE_PROPS' => $skuProps
	);
} else {
	$emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
	if ($arParams['ADD_PROPERTIES_TO_BASKET'] === 'Y' && !$emptyProductProperties) {
?>
		<div id="<?= $itemIds['BASKET_PROP_DIV'] ?>" style="display: none;">
			<?php
			if (!empty($arResult['PRODUCT_PROPERTIES_FILL'])) {
				foreach ($arResult['PRODUCT_PROPERTIES_FILL'] as $propId => $propInfo) {
			?>
					<input type="hidden" name="<?= $arParams['PRODUCT_PROPS_VARIABLE'] ?>[<?= $propId ?>]" value="<?= htmlspecialcharsbx($propInfo['ID']) ?>">
				<?php
					unset($arResult['PRODUCT_PROPERTIES'][$propId]);
				}
			}

			$emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
			if (!$emptyProductProperties) {
				?>
				<table>
					<?php
					foreach ($arResult['PRODUCT_PROPERTIES'] as $propId => $propInfo) {
					?>
						<tr>
							<td><?= $arResult['PROPERTIES'][$propId]['NAME'] ?></td>
							<td>
								<?php
								if (
									$arResult['PROPERTIES'][$propId]['PROPERTY_TYPE'] === 'L'
									&& $arResult['PROPERTIES'][$propId]['LIST_TYPE'] === 'C'
								) {
									foreach ($propInfo['VALUES'] as $valueId => $value) {
								?>
										<label>
											<input type="radio" name="<?= $arParams['PRODUCT_PROPS_VARIABLE'] ?>[<?= $propId ?>]" value="<?= $valueId ?>" <?= ($valueId == $propInfo['SELECTED'] ? '"checked"' : '') ?>>
											<?= $value ?>
										</label>
										<br>
									<?php
									}
								} else {
									?>
									<select name="<?= $arParams['PRODUCT_PROPS_VARIABLE'] ?>[<?= $propId ?>]">
										<?php
										foreach ($propInfo['VALUES'] as $valueId => $value) {
										?>
											<option value="<?= $valueId ?>" <?= ($valueId == $propInfo['SELECTED'] ? '"selected"' : '') ?>>
												<?= $value ?>
											</option>
										<?php
										}
										?>
									</select>
								<?php
								}
								?>
							</td>
						</tr>
					<?php
					}
					?>
				</table>
			<?php
			}
			?>
		</div>
<?php
	}

	$jsParams = array(
		'CONFIG' => array(
			'USE_CATALOG' => $arResult['CATALOG'],
			'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
			'SHOW_PRICE' => !empty($arResult['ITEM_PRICES']),
			'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'] === 'Y',
			'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'] === 'Y',
			'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
			'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
			'MAIN_PICTURE_MODE' => $arParams['DETAIL_PICTURE_MODE'],
			'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
			'SHOW_CLOSE_POPUP' => $arParams['SHOW_CLOSE_POPUP'] === 'Y',
			'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
			'RELATIVE_QUANTITY_FACTOR' => $arParams['RELATIVE_QUANTITY_FACTOR'],
			'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
			'USE_STICKERS' => true,
			'USE_SUBSCRIBE' => $showSubscribe,
			'SHOW_SLIDER' => $arParams['SHOW_SLIDER'],
			'SLIDER_INTERVAL' => $arParams['SLIDER_INTERVAL'],
			'ALT' => $alt,
			'TITLE' => $title,
			'MAGNIFIER_ZOOM_PERCENT' => 200,
			'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
			'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
			'BRAND_PROPERTY' => !empty($arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']])
				? $arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']]['DISPLAY_VALUE']
				: null
		),
		'VISUAL' => $itemIds,
		'PRODUCT_TYPE' => $arResult['PRODUCT']['TYPE'],
		'PRODUCT' => array(
			'ID' => $arResult['ID'],
			'ACTIVE' => $arResult['ACTIVE'],
			'PICT' => reset($arResult['MORE_PHOTO']),
			'NAME' => $arResult['~NAME'],
			'SUBSCRIPTION' => true,
			'ITEM_PRICE_MODE' => $arResult['ITEM_PRICE_MODE'],
			'ITEM_PRICES' => $arResult['ITEM_PRICES'],
			'ITEM_PRICE_SELECTED' => $arResult['ITEM_PRICE_SELECTED'],
			'ITEM_QUANTITY_RANGES' => $arResult['ITEM_QUANTITY_RANGES'],
			'ITEM_QUANTITY_RANGE_SELECTED' => $arResult['ITEM_QUANTITY_RANGE_SELECTED'],
			'ITEM_MEASURE_RATIOS' => $arResult['ITEM_MEASURE_RATIOS'],
			'ITEM_MEASURE_RATIO_SELECTED' => $arResult['ITEM_MEASURE_RATIO_SELECTED'],
			'SLIDER_COUNT' => $arResult['MORE_PHOTO_COUNT'],
			'SLIDER' => $arResult['MORE_PHOTO'],
			'CAN_BUY' => $arResult['CAN_BUY'],
			'CHECK_QUANTITY' => $arResult['CHECK_QUANTITY'],
			'QUANTITY_FLOAT' => is_float($arResult['ITEM_MEASURE_RATIOS'][$arResult['ITEM_MEASURE_RATIO_SELECTED']]['RATIO']),
			'MAX_QUANTITY' => $arResult['PRODUCT']['QUANTITY'],
			'STEP_QUANTITY' => $arResult['ITEM_MEASURE_RATIOS'][$arResult['ITEM_MEASURE_RATIO_SELECTED']]['RATIO'],
			'CATEGORY' => $arResult['CATEGORY_PATH']
		),
		'BASKET' => array(
			'ADD_PROPS' => $arParams['ADD_PROPERTIES_TO_BASKET'] === 'Y',
			'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
			'PROPS' => $arParams['PRODUCT_PROPS_VARIABLE'],
			'EMPTY_PROPS' => $emptyProductProperties,
			'BASKET_URL' => $arParams['BASKET_URL'],
			'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
			'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE']
		)
	);
	unset($emptyProductProperties);
}

if ($arParams['DISPLAY_COMPARE']) {
	$jsParams['COMPARE'] = array(
		'COMPARE_URL_TEMPLATE' => $arResult['~COMPARE_URL_TEMPLATE'],
		'COMPARE_DELETE_URL_TEMPLATE' => $arResult['~COMPARE_DELETE_URL_TEMPLATE'],
		'COMPARE_PATH' => $arParams['COMPARE_PATH']
	);
}

$jsParams["IS_FACEBOOK_CONVERSION_CUSTOMIZE_PRODUCT_EVENT_ENABLED"] =
	$arResult["IS_FACEBOOK_CONVERSION_CUSTOMIZE_PRODUCT_EVENT_ENABLED"];
?>
<script>
	BX.message({
		ECONOMY_INFO_MESSAGE: '<?= GetMessageJS('CT_BCE_CATALOG_ECONOMY_INFO2') ?>',
		TITLE_ERROR: '<?= GetMessageJS('CT_BCE_CATALOG_TITLE_ERROR') ?>',
		TITLE_BASKET_PROPS: '<?= GetMessageJS('CT_BCE_CATALOG_TITLE_BASKET_PROPS') ?>',
		BASKET_UNKNOWN_ERROR: '<?= GetMessageJS('CT_BCE_CATALOG_BASKET_UNKNOWN_ERROR') ?>',
		BTN_SEND_PROPS: '<?= GetMessageJS('CT_BCE_CATALOG_BTN_SEND_PROPS') ?>',
		BTN_MESSAGE_DETAIL_BASKET_REDIRECT: '<?= GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_BASKET_REDIRECT') ?>',
		BTN_MESSAGE_CLOSE: '<?= GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE') ?>',
		BTN_MESSAGE_DETAIL_CLOSE_POPUP: '<?= GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE_POPUP') ?>',
		TITLE_SUCCESSFUL: '<?= GetMessageJS('CT_BCE_CATALOG_ADD_TO_BASKET_OK') ?>',
		COMPARE_MESSAGE_OK: '<?= GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_OK') ?>',
		COMPARE_UNKNOWN_ERROR: '<?= GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_UNKNOWN_ERROR') ?>',
		COMPARE_TITLE: '<?= GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_TITLE') ?>',
		BTN_MESSAGE_COMPARE_REDIRECT: '<?= GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_COMPARE_REDIRECT') ?>',
		PRODUCT_GIFT_LABEL: '<?= GetMessageJS('CT_BCE_CATALOG_PRODUCT_GIFT_LABEL') ?>',
		PRICE_TOTAL_PREFIX: '<?= GetMessageJS('CT_BCE_CATALOG_MESS_PRICE_TOTAL_PREFIX') ?>',
		RELATIVE_QUANTITY_MANY: '<?= CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_MANY']) ?>',
		RELATIVE_QUANTITY_FEW: '<?= CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_FEW']) ?>',
		SITE_ID: '<?= CUtil::JSEscape($component->getSiteId()) ?>'
	});

	var <?= $obName ?> = new JCCatalogElement(<?= CUtil::PhpToJSObject($jsParams, false, true) ?>);
</script>
<?php
unset($actualItem, $itemIds, $jsParams);
