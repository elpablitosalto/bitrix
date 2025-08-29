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
	<? if (intval($item['DISCOUNT_PERSENT']) > 0) { ?>
		<?/*?><span class="order-card__discount-perc"><?= $item['DISCOUNT_PERSENT']; ?>%</span><?*/ ?>
		<div class="c-mark c-mark__akcia"><b><?= $item['DISCOUNT_PERSENT'] ?>%</b></div>
	<? } ?>
	<? if ($item['BESTSELLER'] == 'Y') { ?>
		<div class="c-mark c-mark__hit">Хит продаж</div>
	<? } ?>
</div>
<a target="_self" class="product__image" href="<?= $item['DETAIL_PAGE_URL']; ?>">
	<div class="product__image-wrapper" id="<?= $itemIds['PICT_SLIDER'] ?>">
		<?
		$i = 0;
		foreach ($item['PICTURES'] as $key => $photo) {
			$i++;
			$id = "";
			if ($i == 1) {
				$id = $item['SECOND_PICT'] ? $itemIds['SECOND_PICT'] : $itemIds['PICT'];
			}
		?>
			<img id="<?= $id; ?>" itemprop="image" src="<?= $photo['SRC'] ?>" alt="<?= $photo['ALT'] ?>" alt="<?= $photo['TITLE'] ?>" />
		<? } ?>
	</div>
	<div class="product__image-pagination"></div>
</a>
<a target="_self" class="product__title" itemprop="name" href="<?= $item['DETAIL_PAGE_URL']; ?>"><?= $item['NAME']; ?></a>
<div class="product__bottom">
	<div class="product__attributes">
		<div class="product__rating" itemprop="aggregateRating">
			<?
			//echo 'RAITING = '.$arParams['RAITING'].'<br />';
			//$raiting = $item['RATING_VALUE'];
			//$raiting_count = $item['RATING_COUNT'];
			$raiting = $arParams['RAITING'];
			$raiting_count = $arParams['RAITING_COUNT'];
			?>
			<meta itemprop="worstRating" content="0" />
			<meta itemprop="bestRating" content="5" />
			<meta itemprop="ratingValue" content="<?= $raiting; ?>" />
			<meta itemprop="ratingCount" content="<?= $raiting_count; ?>" />
			<?
			for ($i = 1; $i <= 5; $i++) {
				if ($i <= $raiting) { ?>
					<span class="product__rating_full"></span>
					<?
				} else if ($i > $raiting) {
					$val = (float)$raiting;
					if ($i == ceil($val)) {
					?>
						<span class="product__rating_half"></span>
					<?
					} else {
					?>
						<span></span><?
									}
								}
							}
										?>
		</div>
		<div class="product__code">
			<? if (strlen($item['PROPERTIES']['CML2_ARTICLE']['VALUE']) > 0) { ?>
				Артикул: <?= $item['PROPERTIES']['CML2_ARTICLE']['VALUE']; ?>
			<? } ?>
		</div>
	</div>

	<div class="product__availability">
		<? if ($item['OUT_OF_PRODUCTION'] == 'Y') { ?>
			Cнят с производства
		<? } else { ?>
			<? if (intval($item['QUANTITY']) > 0) { ?>
				Наличие: <span class="product__availability_quantity"><?= $item['QUANTITY']; ?></span> <span>шт.</span>
			<? } else { ?>
				Наличие: <span>под заказ 2-3 дня</span>
			<? } ?>
		<? } ?>
	</div>

	<?
	$bonusValue = Indexis::getBonusValueByPrice($item['PRICE']);
	if ($bonusValue > 0) :
	?>
		<div class="product__bonus">
			<div class="product__bonus_help">?</div>
			<?= Indexis::num2word($bonusValue, [
				'<span class="product__bonus_quantity">#NUM#</span> СтройБонус',
				'<span class="product__bonus_quantity">#NUM#</span> СтройБонуса',
				'<span class="product__bonus_quantity">#NUM#</span> СтройБонусов',
			]) ?>
		</div>
	<? endif; ?>

	<? if ($item['HIDE_PRICE'] != 'Y') { ?>

		<? if (strlen($item['PRICE']) > 0) { ?>
			<div class="product__price" id="<?= $itemIds['PRICE'] ?>" itemtype="https://schema.org/Offer" itemprop="offers" itemscope="itemscope">
				<div class="product__price-new">
					<span class="product__price_sum" itemprop="price"><?= $item['PRICE']; ?></span>
					<span class="product__price_ruble" itemprop="priceCurrency">&#8381;</span>
				</div>
				<? if ($item['SHOW_PRICE_BEFORE_DISCOUNT'] == 'Y') { ?>
					<div class="product__price-old"><span class="product__price-old-sum"><?= $item['BASE_PRICE']; ?></span>
						<span class="product__price-old-rub">&#8381;</span>
					</div>
				<? } ?>
			</div>
		<? } ?>

		<div class="product__price-for">
			<? if ($item['PRICE_FOR_KG'] > 0) { ?>
				<span class="product__price-for_sum"><?= $item['PRICE_FOR_KG']; ?></span> &#8381;/кг.
			<? } ?>
		</div>

	<? } ?>

	<? if ($item['HIDE_PRICE'] == 'Y' || empty($item['PRICE'])) { ?>
		<div class="product__add">
			<button class="product__add_basket js_request_wholesale_price" data-formtype="know" data-product-name="<?= $item['NAME']; ?>" type="button">
				Узнать цену
			</button>
		</div>
	<? } else if ($item['CAN_BUY_CUSTOM'] == 'Y') { ?>
		<div class="product__add" id="<?= $itemIds['BASKET_ACTIONS'] ?>">
			<button class="product__add_basket js_product__add_basket js_add_to_basket" id="<?= $itemIds['BUY_LINK'] ?>" data-product-id="<?= $item['ID']; ?>" data-type-add="full">В корзину</button>
		</div>
	<? } else { ?>
		<div class="product__add">
			<? if ($item['OUT_OF_PRODUCTION'] == 'Y' || $item['NOT_AVAILABLE'] == 'Y') { ?>
				<button class="product__add_basket js_choose_analogue" data-product-name="<?= $item['NAME']; ?>" type="button">
					Подобрать аналог
				</button>
			<? } else if ($item['CAN_ORDER_CUSTOM'] == 'Y') { ?>
				<button class="product__add_basket js_product_on_order" data-product-name="<?= $item['NAME']; ?>" type="button">
					Заказать
				</button>
			<? } ?>
		</div>
	<? } ?>
</div>