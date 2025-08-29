<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $item
 * @var array $actualItem
 * @var array $minOffer
 * @var array $itemIds
 * @var array $price
 * @var array $measureRatio
 * @var bool $haveOffers
 * @var bool $showSubscribe
 * @var array $morePhoto
 * @var bool $showSlider
 * @var bool $itemHasDetailUrl
 * @var string $imgTitle
 * @var string $productTitle
 * @var string $buttonSizeClass
 * @var string $discountPositionClass
 * @var string $labelPositionClass
 * @var CatalogSectionComponent $component
 */
?>

<div class="c-marks">
	<?/*?><div class="c-mark c-mark__bage">Бейдж</div><?/**/ ?>
	<? if ($item['DISCOUNT_PERSENT'] > 0) { ?>
		<div class="c-mark c-mark__akcia"><b><?= $item['DISCOUNT_PERSENT'] ?>%</b></div>
	<? } ?>
	<? if ($item['BESTSELLER'] == 'Y') { ?>
		<div class="c-mark c-mark__hit">Хит продаж</div>
	<? } ?>
</div>
<a href="<?= $item['DETAIL_PAGE_URL']; ?>">
	<div class="related__image" id="<?= $itemIds['PICT_SLIDER'] ?>">
		<?
		$id = $item['SECOND_PICT'] ? $itemIds['SECOND_PICT'] : $itemIds['PICT'];
		?>
		<img id="<?= $id; ?>" src="<?= $item['PICTURE']['SRC'] ?>" alt="<?= $imgAlt ?>" title="<?= $imgTitle ?>" />
		<? /* if (strlen($item['DISCOUNT_PERSENT']) > 0) { ?>
				<span class="related-card__discount-perc"><?= $item['DISCOUNT_PERSENT']; ?>%</span>
			<? } */ ?>
	</div>
</a>
<a class="related__title" href="<?= $item['DETAIL_PAGE_URL']; ?>"><?= $item['NAME']; ?></a>
<div class="related__bottom">
	<div class="related__attributes">
		<div class="related__rating">
			<?
			for ($i = 1; $i <= 5; $i++) {
				if ($i <= $item['RATING_VALUE']) { ?>
					<span class="related__rating_full"></span>
					<?
				} else if ($i > $item['RATING_VALUE']) {
					$val = (float)$item['RATING_VALUE'];
					if ($i == ceil($val)) {
					?>
						<span class="related__rating_half"></span>
					<?
					} else {
					?>
						<span></span><?
									}
								}
							}
										?>
		</div>

		<div class="related__code">
			<? if (strlen($item['PROPERTIES']['CML2_ARTICLE']['VALUE']) > 0) { ?>
				Артикул: <?= $item['PROPERTIES']['CML2_ARTICLE']['VALUE']; ?>
			<? } ?>
		</div>
	</div>
	<div class="related__availability">
		<? if ($item['OUT_OF_PRODUCTION'] == 'Y') { ?>
			Cнят с производства
		<? } else { ?>
			<? if (intval($item['QUANTITY']) > 0) { ?>
				Наличие: <span class="related__availability_quantity"><?= $item['QUANTITY']; ?></span> <span>шт.</span>
			<? } else { ?>
				Наличие: <span>под заказ 2-3 дня</span>
			<? } ?>
		<? } ?>
	</div>
	<?
	$bonusValue = Indexis::getBonusValueByPrice($item['PRICE']);
	if ($bonusValue > 0) :
	?>
		<div class="related__bonus">
			<div class="related__bonus_help">?</div>
			<?= Indexis::num2word($bonusValue, [
				'<span class="product__bonus_quantity">#NUM#</span> СтройБонус',
				'<span class="product__bonus_quantity">#NUM#</span> СтройБонуса',
				'<span class="product__bonus_quantity">#NUM#</span> СтройБонусов',
			]) ?>
		</div>
	<? endif; ?>
	<? if ($item['HIDE_PRICE'] != 'Y') { ?>
		<div class="related__price">
			<? if (strlen($item['PRICE']) > 0) { ?>
				<div class="product__price-new" id="<?= $itemIds['PRICE'] ?>">
					<span class="product__price_sum" itemprop="price"><?= $item['PRICE']; ?></span>
					<span class="product__price_ruble" itemprop="priceCurrency">&#8381;</span>
				</div>
			<? } ?>
			<? if ($item['SHOW_PRICE_BEFORE_DISCOUNT'] == 'Y') { ?>
				<div class="product__price-old">
					<span class="product__price-old-sum"><?= $item['BASE_PRICE']; ?></span>
					<span class="product__price-old-rub">&#8381;</span>
				</div>
			<? } ?>
		</div>
		<div class="related__price-for">
			<? if ($item['PRICE_FOR_KG'] > 0) { ?>
				<span class="related__price-for_sum"><?= $item['PRICE_FOR_KG']; ?></span> &#8381;/кг.
			<? } ?>
		</div>
	<? } ?>
	<? if ($item['HIDE_PRICE'] == 'Y' || empty($item['PRICE'])) { ?>
		<div class="related__add">
			<div class="product-card__btn-line">
				<button class="related__add_basket js_request_wholesale_price" data-formtype="know" data-product-name="<?= $item['NAME']; ?>" type="button">
					Узнать цену
				</button>
			</div>
		</div>
	<? } else if ($item['CAN_BUY_CUSTOM'] == 'Y') { ?>
		<div class="related__add" id="<?= $itemIds['BASKET_ACTIONS'] ?>">
			<div class="product-card__btn-line">
				<div class="order-card__item-add" data-entity="quantity-block">
					<button type="button" class="related__add_control related__add_control_minus js_list_minus_quantity" id="<?= $itemIds['QUANTITY_DOWN'] ?>" data-el-id="<?= $item['ID']; ?>" data-action="minus">-</button>
					<input class="popup__input-quantity" id="<?= $itemIds['QUANTITY'] ?>" name="<?= $arParams['PRODUCT_QUANTITY_VARIABLE'] ?>" placeholder="1" value="1" data-el-basket-id="<?= $item['ID']; ?>" required>
					<button type="button" class="related__add_control related__add_control_plus js_list_plus_quantity" id="<?= $itemIds['QUANTITY_UP'] ?>" data-el-id="<?= $item['ID']; ?>" data-action="plus">+</button>
				</div>
				<button class="related__add_basket js_add_to_basket" id="<?= $itemIds['BUY_LINK'] ?>" data-product-id="<?= $item['ID']; ?>" data-type-add="full">В корзину</button>
			</div>
		</div>
	<? } else { ?>
		<div class="related__add">
			<div class="product-card__btn-line">
				<? if ($item['OUT_OF_PRODUCTION'] == 'Y' || $item['NOT_AVAILABLE'] == 'Y') { ?>
					<button class="related__add_basket js_choose_analogue" data-product-name="<?= $item['NAME']; ?>" type="button">
						Подобрать аналог
					</button>
				<? } else if ($item['CAN_ORDER_CUSTOM'] == 'Y') { ?>
					<button class="related__add_basket js_product_on_order" data-product-name="<?= $item['NAME']; ?>" type="button">
						Заказать
					</button>
				<? } ?>
			</div>
		</div>
	<? } ?>
</div>