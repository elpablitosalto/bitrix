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
<?
$price = $item['ITEM_PRICES'][0]['PRICE'];
$weight = $item['PROPERTIES']['VES_ATTR_S']['VALUE'];
if ($weight > 0 && $price > 0) {
	$price_for_kg = ceil($price / $weight);
}
$quantity = $item['PRODUCT']['QUANTITY'];
$bAddToBasket = $price > 0 && $quantity > 0;
$ratingValue = $item['PROPERTIES']['RAITING_VAL']['VALUE'];
$ratingCount = $item['PROPERTIES']['RAITING_COUNT']['VALUE'];

/*
// Параметры добавления в корзину -->
$arAdd2BasketParams = array(
	'arFields' => array(
		'PRODUCT_ID' => $item['ID'],
		'PRODUCT_PRICE_ID' => $item['ITEM_PRICES'][0]['ID'],
		'PRICE' => $item['ITEM_PRICES'][0]['PRICE'],
		'CURRENCY' => $item['ITEM_PRICES'][0]['CURRENCY'],
		'WEIGHT' => $weight,
		'QUANTITY' => 1,
		'LID' => LANG,
		'DELAY' => 'N',
		'CAN_BUY' => 'Y',
		'NAME' => $item['NAME'],
		//'CALLBACK_FUNC' => 'MyBasketCallback',
		'MODULE' => 'my_module',
		//'NOTES' => '',
		//'ORDER_CALLBACK_FUNC' => 'MyBasketOrderCallback',
		'DETAIL_PAGE_URL' => $item['DETAIL_PAGE_URL']
	),
	'arProps' => array(
		array(
			'NAME' => 'Артикул',    'CODE' => 'CML2_ARTICLE',    'VALUE' => $item['PROPERTIES']['CML2_ARTICLE']['VALUE']
		),
		array(
			'NAME' => 'Цена за кг',    'CODE' => 'PRICE_FOR_KG',    'VALUE' => $price_for_kg
		),
	),
);
$jsonAdd2BasketParams = base64_encode(json_encode($arAdd2BasketParams));
// <-- Параметры добавления в корзину
*/

// Скидка -->
$bShowPriceBeforeDiscount = false;
$showBasePrice = "";
if (
	!empty($item['ITEM_PRICES'][0]['PRICE'])
	&& !empty($item['ITEM_PRICES'][0]['BASE_PRICE'])
	&& $item['ITEM_PRICES'][0]['PRICE'] != $item['ITEM_PRICES'][0]['BASE_PRICE']
	&& strlen($item['ITEM_PRICES'][0]['PERCENT']) > 0
) {
	$bShowPriceBeforeDiscount = true;
	$showBasePrice = intval($item['ITEM_PRICES'][0]['BASE_PRICE']);
}
// <-- Скидка
?>
<?/*?>
<input type="hidden" value="<?= $jsonAdd2BasketParams; ?>" id="jsAdd2BasketParams<?= $item['ID']; ?>" />
<?/**/ ?>


<div class="popup__item-image" id="<?= $itemIds['PICT_SLIDER'] ?>">
	<img itemprop="image" src="<?= $item['PICTURE']['SRC'] ?>" alt="<?= $item['PICTURE']['ALT'] ?>" alt="<?= $item['PICTURE']['TITLE'] ?>" />
</div>
<div class="popup__item-wrapper">
	<div class="popup__title">
		<?= $item['NAME']; ?>
	</div>
	<div class="order-card__code">
		<? if (strlen($item['PROPERTIES']['CML2_ARTICLE']['VALUE']) > 0) { ?>
			Артикул: <?= $item['PROPERTIES']['CML2_ARTICLE']['VALUE']; ?>
		<? } ?>
	</div>
	<?
	$bPriceShow = false;
	$bPriceForKgShow = false;
	$bDiscoutShow = false;
	?>
	<? if ($item['HIDE_PRICE'] != 'Y') { ?>
		<? if (strlen($price) > 0) { ?>
			<?
			$bPriceShow = true;
			?>
			<? if (strlen($price_for_kg) > 0) { ?>
				<?
				$bPriceForKgShow = true;
				?>
			<? } ?>
			<? if ($bShowPriceBeforeDiscount) { ?>
				<?
				$bDiscoutShow = true;
				?>
			<? } ?>
		<? } ?>
	<? } ?>

	<?/*?>
	<div class="order-card__item-price" id="<?= $itemIds['PRICE'] ?>">
		<div class="popup__item-price">
			<span class="prices">
				<? if ($bPriceShow) { ?><?= $price; ?><? } else { ?>&nbsp;<? } ?>
			</span>
			<span>
				<? if ($bPriceShow) { ?>&#8381;<? } else { ?>&nbsp;<? } ?>
			</span>
		</div>
		<div class="order-card__item-sumfor">
			<span class="prices">
				<? if ($bPriceForKgShow) { ?><?= $price_for_kg; ?><? } else { ?>&nbsp;<? } ?>
			</span>
			<span>
				<? if ($bPriceForKgShow) { ?>&#8381;/кг.<? } else { ?>&nbsp;<? } ?>
			</span>
		</div>
	</div>
	<div class="order-card__discount">
		<span class="order-card__discount-old">
			<span class="prices">
				<? if ($bDiscoutShow) { ?><?= $showBasePrice; ?><? } else { ?> &nbsp; <? } ?>
			</span>
			<? if ($bDiscoutShow) { ?>&#8381;/шт.<? } else { ?>&nbsp;<? } ?>
		</span>
		<span class="order-card__discount-percent">
			<? if ($bDiscoutShow) { ?><?= $item['ITEM_PRICES'][0]['PERCENT']; ?>%<? } else { ?>&nbsp;<? } ?>
		</span>
	</div>
	<?*/ ?>

	<? if ($bPriceShow) { ?>
		<div class="order-card__item-price">
			<div class="popup__item-price"><?= $price; ?> <span>&#8381;</span>
			</div>
			<? if ($bPriceForKgShow) { ?>
				<div class="order-card__item-sumfor"><?= $price_for_kg; ?> <span>&#8381;/кг.</span>
				</div>
			<? } ?>
		</div>
		<? if ($bDiscoutShow) { ?>
		<div class="order-card__discount">
			<span class="order-card__discount-old"><?= $showBasePrice; ?> ₽/шт.</span>
			<span class="order-card__discount-percent"><?= $item['ITEM_PRICES'][0]['PERCENT']; ?>%</span>
		</div>
		<? } ?>
	<? } ?>

	<? if ($item['HIDE_PRICE'] == 'Y' || empty($item['PRICE'])) { ?>
		<?/*?><div><?*/ ?>
		<button class="button-orange popup__buy js_request_wholesale_price" data-formtype="know" data-product-name="<?= $item['NAME']; ?>" type="button">
			Узнать цену
		</button>
		<?/*?></div><?*/ ?>
	<? } else if ($item['CAN_BUY_CUSTOM'] == 'Y') { ?>
		<?/*?><div id="<?= $itemIds['BASKET_ACTIONS'] ?>"><?*/ ?>
		<button id="<?= $itemIds['BASKET_ACTIONS'] ?>" class="button-orange popup__buy js_add_to_basket" onclick="addToBasketOpenPopup('<?= $item['ID']; ?>', 'half', 'Y');" type="button" id="<?= $itemIds['BUY_LINK'] ?>" data-product-id="<?= $item['ID']; ?>" data-type-add="half">
			В корзину
		</button>
		<?/*?></div><?*/ ?>
	<? } else { ?>
		<?/*?><div><?*/ ?>
		<? if ($item['OUT_OF_PRODUCTION'] == 'Y' || $item['NOT_AVAILABLE'] == 'Y') { ?>
			<button class="button-orange popup__buy js_choose_analogue" data-product-name="<?= $item['NAME']; ?>" type="button">
				Подобрать аналог
			</button>
		<? } else if ($item['CAN_ORDER_CUSTOM'] == 'Y') { ?>
			<button class="button-orange popup__buy js_product_on_order" data-product-name="<?= $item['NAME']; ?>" type="button">
				Заказать
			</button>
		<? } ?>
		<?/*?></div><?*/ ?>
	<? } ?>
</div>