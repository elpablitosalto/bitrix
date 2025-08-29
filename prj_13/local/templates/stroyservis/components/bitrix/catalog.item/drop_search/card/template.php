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
<div class="search__link">
	<a class="search__links" href="<?= $item['DETAIL_PAGE_URL']; ?>">
		<div class="search__item-image" id="<?= $itemIds['PICT_SLIDER'] ?>">
			<?
			$id = $item['SECOND_PICT'] ? $itemIds['SECOND_PICT'] : $itemIds['PICT'];
			?>
			<img id="<?= $id; ?>" src="<?= $item['PICTURE']['SRC'] ?>" alt="<?= $imgAlt ?>" title="<?= $imgTitle ?>" />
		</div>
		<div class="search__item-body">
			<p class="search__item-title"><?= $item['NAME']; ?></p>
			<? if (strlen($item['PROPERTIES']['CML2_ARTICLE']['VALUE']) > 0) { ?>
				<p class="search__item-code">Артикул: <?= $item['PROPERTIES']['CML2_ARTICLE']['VALUE']; ?></p>
			<? } ?>
			<? if ($item['HIDE_PRICE'] != 'Y') { ?>
				<div class="search__item-prices">
					<? if (strlen($item['PRICE']) > 0) { ?>
						<div class="search__item-price" id="<?= $itemIds['PRICE'] ?>">
							<?= $item['PRICE']; ?>
							<span>&#8381;</span>
						</div>
					<? } ?>
					<? if ($item['PRICE_FOR_KG'] > 0) { ?>
						<div class="search__item-sumfor"><?= $item['PRICE_FOR_KG']; ?> <span>&#8381;/кг.</span></div>
					<? } ?>
				</div>
			<? } ?>
		</div>
	</a>
	<? if ($item['HIDE_PRICE'] == 'Y' || empty($item['PRICE'])) { ?>
		<div class="search__actions">
			<a class="button-orange js_request_wholesale_price" data-formtype="know" href="javascript:void(0)" data-product-name="<?= $item['NAME']; ?>">
				Узнать цену
			</a>
		</div>
	<? } else if ($item['CAN_BUY_CUSTOM'] == 'Y') { ?>
		<div class="search__actions" id="<?= $itemIds['BASKET_ACTIONS'] ?>">
			<a class="button-orange" href="javascript:void(0)" id="<?= $itemIds['BUY_LINK'] ?>" data-product-id="<?= $item['ID']; ?>" data-type-add="full">В корзину</a>
		</div>
	<? } else { ?>
		<div class="search__actions">
			<? if ($item['OUT_OF_PRODUCTION'] == 'Y' || $item['NOT_AVAILABLE'] == 'Y') { ?>
				<a class="button-orange js_choose_analogue" href="javascript:void(0)" data-product-name="<?= $item['NAME']; ?>">
					Подобрать аналог
				</a>
			<? } else if ($item['CAN_ORDER_CUSTOM'] == 'Y') { ?>
				<a class="button-orange js_product_on_order" href="javascript:void(0)" data-product-name="<?= $item['NAME']; ?>">
					Заказать
				</a>
			<? } ?>
		</div>
	<? } ?>
</div>