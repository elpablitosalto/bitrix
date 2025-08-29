<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogProductsViewedComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */

$this->setFrameMode(true);

$basket = new Mirvendinga\Basket();

if (isset($arResult['ITEM'])) {
	$item = $arResult['ITEM'];
	$areaId = $arResult['AREA_ID'];
	$itemIds = array(
		'ID' => $areaId,
		'PICT' => $areaId . '_pict',
		'SECOND_PICT' => $areaId . '_secondpict',
		'PICT_SLIDER' => $areaId . '_pict_slider',
		'STICKER_ID' => $areaId . '_sticker',
		'SECOND_STICKER_ID' => $areaId . '_secondsticker',
		'QUANTITY' => $areaId . '_quantity',
		'QUANTITY_DOWN' => $areaId . '_quant_down',
		'QUANTITY_UP' => $areaId . '_quant_up',
		'QUANTITY_MEASURE' => $areaId . '_quant_measure',
		'QUANTITY_LIMIT' => $areaId . '_quant_limit',
		'BUY_LINK' => $areaId . '_buy_link',
		'WISHLIST_ID' => $areaId . '_wishlist_id',
		'BASKET_ACTIONS' => $areaId . '_basket_actions',
		'NOT_AVAILABLE_MESS' => $areaId . '_not_avail',
		'SUBSCRIBE_LINK' => $areaId . '_subscribe',
		'COMPARE_LINK' => $areaId . '_compare_link',
		'PRICE' => $areaId . '_price',
		'PRICE_OLD' => $areaId . '_price_old',
		'PRICE_TOTAL' => $areaId . '_price_total',
		'DSC_PERC' => $areaId . '_dsc_perc',
		'SECOND_DSC_PERC' => $areaId . '_second_dsc_perc',
		'PROP_DIV' => $areaId . '_sku_tree',
		'PROP' => $areaId . '_prop_',
		'DISPLAY_PROP_DIV' => $areaId . '_sku_prop',
		'BASKET_PROP_DIV' => $areaId . '_basket_prop',
	);
	$obName = 'ob' . preg_replace("/[^a-zA-Z0-9_]/", "x", $areaId);
	$isBig = isset($arResult['BIG']) && $arResult['BIG'] === 'Y';

	$productTitle = isset($item['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']) && $item['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] != ''
		? $item['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
		: $item['NAME'];

	$imgTitle = isset($item['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE']) && $item['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE'] != ''
		? $item['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE']
		: $item['NAME'];

	$skuProps = array();

	$haveOffers = !empty($item['OFFERS']);
	if ($haveOffers) {
		$actualItem = isset($item['OFFERS'][$item['OFFERS_SELECTED']])
			? $item['OFFERS'][$item['OFFERS_SELECTED']]
			: reset($item['OFFERS']);
	} else {
		$actualItem = $item;
	}

	$morePhoto = null;
	if ($arParams['PRODUCT_DISPLAY_MODE'] === 'N' && $haveOffers) {
		$price = $item['ITEM_START_PRICE'];
		$minOffer = $item['OFFERS'][$item['ITEM_START_PRICE_SELECTED']];
		$measureRatio = $minOffer['ITEM_MEASURE_RATIOS'][$minOffer['ITEM_MEASURE_RATIO_SELECTED']]['RATIO'];
		if (isset($item['MORE_PHOTO'])) {
			$morePhoto = $item['MORE_PHOTO'];
		}
	} else {
		$price = $actualItem['ITEM_PRICES'][$actualItem['ITEM_PRICE_SELECTED']];
		$measureRatio = $price['MIN_QUANTITY'];
		if (isset($actualItem['MORE_PHOTO'])) {
			$morePhoto = $actualItem['MORE_PHOTO'];
		}
	}

	$showSlider = is_array($morePhoto) && count($morePhoto) > 1;
	$showSubscribe = $arParams['PRODUCT_SUBSCRIPTION'] === 'Y' && ($item['CATALOG_SUBSCRIBE'] === 'Y' || $haveOffers);

	$discountPositionClass = isset($arResult['BIG_DISCOUNT_PERCENT']) && $arResult['BIG_DISCOUNT_PERCENT'] === 'Y'
		? 'product-item-label-big'
		: 'product-item-label-small';
	$discountPositionClass .= $arParams['DISCOUNT_POSITION_CLASS'];

	$labelPositionClass = isset($arResult['BIG_LABEL']) && $arResult['BIG_LABEL'] === 'Y'
		? 'product-item-label-big'
		: 'product-item-label-small';
	$labelPositionClass .= $arParams['LABEL_POSITION_CLASS'];

	$buttonSizeClass = isset($arResult['BIG_BUTTONS']) && $arResult['BIG_BUTTONS'] === 'Y' ? 'btn-md' : 'btn-sm';
	$itemHasDetailUrl = isset($item['DETAIL_PAGE_URL']) && $item['DETAIL_PAGE_URL'] != '';

	$favorite = new \Mirvendinga\Favorites();
	$item["IS_FAVORITE"] = $favorite->isFavorite($item["ID"]);

	$arCatalogData = \Mirvendinga\Catalog::getProductCatalogData($arResult['ITEM']['ID']);

	// Есть цена, есть в наличии в выбранном регионе
	$itemStatusAvailable = !empty($arCatalogData["PRICE"]["VALUE"]) && !empty($arCatalogData["QUANTITY"]['REGION_QUANTITY']);
	// Есть цена, нет в наличии
	$itemStatusAvailableSomewhere = !$itemStatusAvailable && !empty($arCatalogData["PRICE"]["VALUE"]) && (!empty($arCatalogData["QUANTITY"]['TOTAL_QUANTITY']) || $arResult['ANY_STORE_HAS_STOCK']);
	// Нет цены, наличие не влияет
	$itemStatusUnavailable = !$itemStatusAvailable && !$itemStatusAvailableSomewhere && !empty($arCatalogData["PRICE"]["VALUE"]);
	// Есть цена, есть в наличии в других регионах
	$itemStatusCantBeBought = empty($arCatalogData["PRICE"]["VALUE"]);

	// Показываем выбор количества и кнопку добавки в корзину только если у товара есть цена и он в наличии в нужном регионе
	$showCart = $itemStatusAvailable;
	// Сообщение доступности товара показывается только если его нет в наличии в нужном регионе (или совсем) или если товар недоступен к покупке
	$showStatus = !$showCart;
	// Показываем кнопку заказа товара только если у товара есть цена, но он не в наличии в нужном регионе
	$showOrder = $itemStatusAvailableSomewhere || $itemStatusUnavailable;

	/*
	if ($USER->IsAdmin()) {
		vardump($arCatalogData);
	}
	*/
?>
	<!-- begin .product-snippet-->
	<div data-hide-count="N" data-product="catalog_product_<?= $arResult['ITEM']['ID'] ?>" data-product-id="<?= $arResult['ITEM']['ID'] ?>" class="product-grid__snippet  product-snippet product-snippet_type_adaptive <? if ($showOrder) : ?>product-snippet_state_order-only<? endif; ?> <? if ($arParams['SHOW_LIKE_LIST'] === 'Y' && CATALOG_LAYOUT === 'LIST') : ?>product-snippet_layout_list-item<? endif ?> <?/*?><?=$basket->isProductInBasket($arResult['ITEM']['ID']) ? 'product-snippet_state_added' : ''?><?*/ ?>" itemscope itemtype="http://schema.org/Product">
		<div class="product-snippet__panel">
			<a href="<?= $arResult['ITEM']['DETAIL_PAGE_URL'] ?>" class="product-snippet__illustration">
				<?php
				if (!empty($arResult['ITEM']['PREVIEW_PICTURE']['ID'])) {
					$resizeImage = CFile::ResizeImageGet($arResult['ITEM']['PREVIEW_PICTURE']['ID'], array("width" => 580, "height" => 460), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false);
				} else {
					$resizeImage = array('src' => SITE_TEMPLATE_PATH . '/mockup/dist/assets/images/image-not-found.png');
				}
				?>
				<picture class="product-snippet__picture">
					<img data-src="<?= $resizeImage['src'] ?>" alt="<?= $arResult['ITEM']['NAME'] ?>" class="product-snippet__image lazyload" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" itemprop="image" />
				</picture>
			</a>
			<div class="product-snippet__favorite">
				<!-- begin .button-->
				<a class="button button_type_operational button_type_operational-small button_type_operational-filling js-toggle-favorite">
					<span class="button__holder<? if ($item["IS_FAVORITE"]) : ?> is-favorite<? endif; ?>">
						<svg width="16" height="16" viewBox="-2 -2 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" class="button__icon not-favorite">
							<path d="M8.00004 3.39C8.72671 2.54 9.84004 2 11 2C13.0567 2 14.6667 3.61 14.6667 5.66667C14.6667 8.1824 12.4017 10.2385 8.97055 13.3532L8.96671 13.3567L8.00004 14.2333L7.03337 13.3567L7.02953 13.3532C3.59835 10.2385 1.33337 8.18239 1.33337 5.66667C1.33337 3.61 2.94337 2 5.00004 2C6.16004 2 7.27337 2.54 8.00004 3.39Z"></path>
						</svg>
						<svg width="16" height="16" viewBox="-2 -2 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" class="button__icon favorite">
							<g clip-path="url(#clip0_2098_4240)">
								<path d="M8.00004 3.39C8.72671 2.54 9.84004 2 11 2C13.0567 2 14.6667 3.61 14.6667 5.66667C14.6667 8.1824 12.4017 10.2385 8.97055 13.3532L8.96671 13.3567L8.00004 14.2333L7.03337 13.3567L7.02953 13.3532C3.59835 10.2385 1.33337 8.18239 1.33337 5.66667C1.33337 3.61 2.94337 2 5.00004 2C6.16004 2 7.27337 2.54 8.00004 3.39Z" fill="#CF006F" />
							</g>
							<defs>
								<clipPath id="clip0_2098_4240">
									<rect width="16" height="16" fill="white" />
								</clipPath>
							</defs>
						</svg>
						<span class="button__text">
							В избранное
						</span>
					</span>
				</a>
				<!-- end .button-->
			</div>
		</div>
		<div class="product-snippet__main">
			<div class="product-snippet__info">
				<? if (!empty($arResult['ITEM']['PROPERTIES']['SALE_ACTIONS']['VALUE'])/* || !empty($arResult['ITEM']["PRICES"]["STANDARTPRICE"]["DISCOUNT_DIFF_PERCENT"])*/) : ?>
					<div class="product-snippet__label">
						<? if (!empty($arResult['ITEM']['PROPERTIES']['SALE_ACTIONS']['VALUE'])) : ?>
							<? foreach ($arResult['ITEM']['PROPERTIES']['SALE_ACTIONS']['VALUE'] as $saleLabelIndex => $saleLabel) : ?>
								<div class="label sale_label <?= $arResult['ITEM']['PROPERTIES']['SALE_ACTIONS']['VALUE_XML_ID'][$saleLabelIndex] ?>"><?= $saleLabel ?></div>
							<? endforeach; ?>
						<? endif ?>

						<?/*if(!empty($arResult['ITEM']["PRICES"]["STANDARTPRICE"]["DISCOUNT_DIFF_PERCENT"])):*/ ?><!--
							<div class="label label_style_warning">
									Акция
							</div>
						--><?/*endif*/ ?>
					</div>
				<? endif ?>

				<div class="product-snippet__title" itemprop="name">
					<a href="<?= $arResult['ITEM']['DETAIL_PAGE_URL'] ?>" class="product-snippet__link"><?= $arResult['ITEM']['NAME'] ?></a>
				</div>

				<?php if (!empty($arResult['ITEM']['SHORT_PROPERTIES'])) : ?>
					<div class="product-snippet__props">
						<div class="props">
							<? foreach ($arResult['ITEM']['SHORT_PROPERTIES'] as $arProp) : ?>
								<div class="props__prop">
									<div class="props__label"><?= $arProp['LABEL'] ?>:</div>
									<div class="props__value"><?= $arProp['VALUE'] ?></div>
								</div>
							<? endforeach ?>
							<? if (!empty($arCatalogData["PACKAGE_AMOUNT"]["IS_SOLD_IN_PACKS"]) && !empty($arCatalogData["UNIT_PRICE"]["PRINT_VALUE"])) : ?>
								<div class="props__prop">
									<div class="props__label">Цена за 1 шт:</div>
									<div class="props__value"><?= $arCatalogData["UNIT_PRICE"]["PRINT_VALUE"] ?></div>
								</div>
							<?php endif; ?>
						</div>
					</div>
				<?php endif; ?>
			</div>
			<? // TODO: убрать
			?>
			<? //=$arCatalogData["PRICE"]["VALUE"]
			?>
			<? // TODO: убрать
			?>
			<? if (!empty($arCatalogData["PRICE"]["VALUE"]) && !empty($arCatalogData["QUANTITY"]['REGION_QUANTITY'])) : ?>
				<div class="product-snippet__price-group">
					<!-- begin .price-group-->
					<div class="price-group" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
						<? if (!empty($arCatalogData["PRICE"]["PRINT_BASE_VALUE"]) && !empty($arCatalogData["PRICE"]["DISCOUNT_DIFF"])) : ?>
							<div class="price-group__extra">
								<div class="price-group__price price-group__price_type_old">
									<span class="price-group__value">
										<?= $arCatalogData["PRICE"]["PRINT_BASE_VALUE"] ?>
									</span>
								</div>
								<? if (!empty($arCatalogData["PRICE"]["DISCOUNT_DIFF_PERCENT"])) : ?>
									<div class="price-group__label">
										<!-- begin .label-->
										<div class="label label_style_secondary">
											Скидка -<?= $arCatalogData["PRICE"]["DISCOUNT_DIFF_PERCENT"] ?>%
										</div>
										<!-- end .label-->
									</div>
								<? endif ?>
							</div>
						<? endif ?>
						<? if (!empty($arCatalogData["PRICE"]["PRINT_VALUE"])) : ?>
							<div class="price-group__main">
								<div class="price-group__price">
									<span class="price-group__value" itemprop="price"><?= $arCatalogData["PRICE"]["PRINT_VALUE"] ?></span><? if (!empty($arCatalogData['PACKAGE_AMOUNT']['MEASURE'])) : ?><span class="price-group__unit" itemprop="priceCurrency">/<?= $arCatalogData['PACKAGE_AMOUNT']['MEASURE'] ?></span><? endif ?>
								</div>
							</div>
						<? endif ?>
					</div>
					<!-- end .price-group-->
				</div>
			<? endif; ?>
			<? if ($showCart) : ?>
				<div class="product-snippet__final js_quantity_els_container">
					<div class="product-snippet__quantity-input">
						<!-- begin .quantity-input-->
						<div class="quantity-input">
							<div class="quantity-input__wrapper js-quantity-container">
								<div class="quantity-input__control">
									<button type="button" disabled="" class="quantity-input__button quantity-input__button_type_decrease js-quantity-decrease <? if ($arResult['IN_BASKET'] == 'Y') { ?>js_decrease_quantity<? } ?>">
										Убавить
									</button>
								</div>
								<div class="quantity-input__field">
									<?
									$min = $arResult['ITEM']['CATALOG_MEASURE_RATIO'];
									if ($arResult['IN_BASKET'] == 'Y') {
										$min = 0;
									}
									?>
									<input type="number" value="<?= $basket->getBasketQuantityByProductId($arResult['ITEM']['ID']) ?>" min="<?= $min; ?>" data-min="<?= $min; ?>" max="<?= $arCatalogData["QUANTITY"]['REGION_QUANTITY'] ?>" data-max="<?= $arCatalogData["QUANTITY"]['REGION_QUANTITY'] ?>" data-ratio="<?= $arResult['ITEM']['CATALOG_MEASURE_RATIO'] ?>" class="quantity-input__input js-quantity-input <? if ($arResult['IN_BASKET'] == 'Y') { ?>js_input_quantity<? } ?>" data-last-val="1" data-product-quantity="<?= $arResult['ITEM']['ID'] ?>" data-product-item="catalog_product_<?= $arResult['ITEM']['ID'] ?>" data-product-id="<?= $arResult['ITEM']['ID'] ?>">
								</div>
								<div class="quantity-input__control">
									<button type="button" class="quantity-input__button quantity-input__button_type_increase js-quantity-increase">
										Добавить
									</button>
								</div>
							</div>
						</div>
						<!-- end .quantity-input-->
					</div>
					<div class="product-snippet__button">
						<!-- begin .button-->
						<button class="button button_width_full button_icon-size_l button_size_xl js_button_add_to_basket <?= ($basket->isProductInBasket($arResult['ITEM']['ID']) ? 'button_state_alt-content' : '') ?>" data-product-item="catalog_product_<?= $arResult['ITEM']['ID'] ?>" data-product-id="<?= $arResult['ITEM']['ID'] ?>" data-product-add-to-card data-package-amount="<?= $arCatalogData["PACKAGE_AMOUNT"]["PACKAGE_AMOUNT"] ?>">
							<span class="button__holder">
								<span class="button__wrapper button__wrapper_type_initial">
									<span class="button__holder">
										<svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg" class="button__icon">
											<path d="M8.16666 25.6666C7.52499 25.6666 6.97588 25.4384 6.51932 24.9818C6.06199 24.5245 5.83332 23.975 5.83332 23.3333C5.83332 22.6916 6.06199 22.1421 6.51932 21.6848C6.97588 21.2283 7.52499 21 8.16666 21C8.80832 21 9.35743 21.2283 9.81399 21.6848C10.2713 22.1421 10.5 22.6916 10.5 23.3333C10.5 23.975 10.2713 24.5245 9.81399 24.9818C9.35743 25.4384 8.80832 25.6666 8.16666 25.6666ZM19.8333 25.6666C19.1917 25.6666 18.6425 25.4384 18.186 24.9818C17.7287 24.5245 17.5 23.975 17.5 23.3333C17.5 22.6916 17.7287 22.1421 18.186 21.6848C18.6425 21.2283 19.1917 21 19.8333 21C20.475 21 21.0245 21.2283 21.4818 21.6848C21.9384 22.1421 22.1667 22.6916 22.1667 23.3333C22.1667 23.975 21.9384 24.5245 21.4818 24.9818C21.0245 25.4384 20.475 25.6666 19.8333 25.6666ZM7.17499 6.99998L9.97499 12.8333H18.1417L21.35 6.99998H7.17499ZM8.16666 19.8333C7.29166 19.8333 6.63055 19.4491 6.18332 18.6806C5.7361 17.913 5.71666 17.15 6.12499 16.3916L7.69999 13.5333L3.49999 4.66665H2.30416C1.9736 4.66665 1.70138 4.55465 1.48749 4.33065C1.2736 4.10742 1.16666 3.83054 1.16666 3.49998C1.16666 3.16942 1.27866 2.89215 1.50266 2.66815C1.72588 2.44492 2.00277 2.33331 2.33332 2.33331H4.22916C4.44305 2.33331 4.64721 2.39165 4.84166 2.50831C5.0361 2.62498 5.18193 2.79026 5.27916 3.00415L6.06666 4.66665H23.275C23.8 4.66665 24.1597 4.86109 24.3542 5.24998C24.5486 5.63887 24.5389 6.0472 24.325 6.47498L20.1833 13.9416C19.9694 14.3305 19.6875 14.6319 19.3375 14.8458C18.9875 15.0597 18.5889 15.1666 18.1417 15.1666H9.44999L8.16666 17.5H21.0292C21.3597 17.5 21.6319 17.6116 21.8458 17.8348C22.0597 18.0588 22.1667 18.3361 22.1667 18.6666C22.1667 18.9972 22.0547 19.2741 21.8307 19.4973C21.6074 19.7213 21.3305 19.8333 21 19.8333H8.16666ZM9.97499 12.8333H18.1417H9.97499Z"></path>
										</svg>
									</span>
								</span>
								<span class="button__wrapper button__wrapper_type_alt">
									<span class="button__holder">
										<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="button__icon">
											<path d="M9.00039 16.2001L4.80039 12.0001L3.40039 13.4001L9.00039 19.0001L21.0004 7.0001L19.6004 5.6001L9.00039 16.2001Z"></path>
										</svg>
									</span>
								</span>
							</span>
						</button>
						<!-- end .button-->
					</div>
				</div>
				<div class="product-snippet__checkbox-container">
					<label class="check-elem check-elem_text-size_l">
						<input class="check-elem__input" type="checkbox" data-product-item="catalog_product_<?= $arResult['ITEM']['ID'] ?>" data-product-id="<?= $arResult['ITEM']['ID'] ?>" data-product-add-to-list>
						<span class="check-elem__label"></span>
					</label>
				</div>
			<? else : ?>
				<div class="product-snippet__final">
					<? if ($showStatus) : ?>
						<div class="product-snippet__availability <?= ($itemStatusAvailableSomewhere ? 'product-snippet__availability_status_available' : 'product-snippet__availability_status_unavailable') ?>">
							<?
							if ($itemStatusAvailableSomewhere) {
								echo 'В наличии на других складах';
							} else if ($itemStatusUnavailable) {
								echo 'Нет в наличии';
							} else {
								echo 'Недоступен для заказа';
							}
							?>
						</div>
					<? endif; ?>
					<? if ($showOrder) : ?>
						<div class="product-snippet__button">
							<!-- begin .button-->
							<a class="button button_width_full button_size_l button_text-size_l button_style_outline" href="<?= $arResult['ITEM']['DETAIL_PAGE_URL'] ?>">
								<span class="button__holder">
									Заказать товар
								</span>
							</a>
							<!-- end .button-->
						</div>
					<? endif ?>
				</div>
			<? endif ?>
		</div>

	</div>
	<!-- end .product-snippet-->

<?php
	unset($item, $actualItem, $minOffer, $itemIds, $jsParams);
}
?>