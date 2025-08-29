<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

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

$basket = new Mirvendinga\Basket();
$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
define('IS_PRODUCT_DETAIL', 1);
if(!empty($arResult['PREVIEW_PICTURE']['ID'])) {
	$resizeImage = CFile::ResizeImageGet($arResult['PREVIEW_PICTURE']['ID'], Array("width" => 128, "height" => 128), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false);
} else {
	$resizeImage = array('src' => SITE_TEMPLATE_PATH . '/mockup/dist/assets/images/image-not-found.png');
}
$favorite = new \Mirvendinga\Favorites();
$arResult["IS_FAVORITE"] = $favorite->isFavorite($arResult["ID"]);
$arCatalogData = \Mirvendinga\Catalog::getProductCatalogData($arResult['ID']);


?>
<?ob_start(); // старт отложенного вывода?>
	<meta property="og:image" content="//<?=$_SERVER["SERVER_NAME"].$resizeImage['src']?>" />
	<meta property="og:image:secure_url" content="<?=(CMain::IsHTTPS()) ? "https://" : "http://"?><?=$_SERVER["SERVER_NAME"].$resizeImage['src']?>" />
	<meta property="og:image:type" content="image/jpeg" />
	<meta property="og:image:width" content="128" />
	<meta property="og:image:height" content="128" />
<?
	$ogImageContent = ob_get_contents(); // сложили все в буфер
	ob_end_clean(); // очистили
	$APPLICATION->AddViewContent('og_image', $ogImageContent);
?>
<div class="page__product-card <?=($basket->isProductInBasket($arResult['ID']) ? 'product-card_state_added' : '')?>">
	<div class="page__container">
		<!-- begin .product-card-->
		<div
			data-product="detail_product_<?=$arResult['ID']?>"
			data-product-id="<?=$arResult['ID']?>"
			class="product-card"
		>
			<div class="product-card__wrapper">
					<div class="product-card__showcase">
						<?if(!empty($arResult['BRAND']['BADGE_IMAGE']['src'])):?>
							<div class="product-card__brands">
								<a href="<?=$arResult['BRAND']['DETAIL_PAGE_URL'];?>" class="product-card__brand">
									<img
										src="<?=$arResult['BRAND']['BADGE_IMAGE']['src'];?>"
										alt="<?=$arResult['BRAND']['NAME'];?>"
										class="product-card__image"
									>
								</a>
							</div>
						<?endif;?>
						<?if(!empty($arResult['PROPERTIES']['SALE_ACTIONS']['VALUE'])/* || !empty($arResult['ITEM']["PRICES"]["STANDARTPRICE"]["DISCOUNT_DIFF_PERCENT"])*/):?>
							<div class="product-card__labels">
								<?if(!empty($arResult['PROPERTIES']['SALE_ACTIONS']['VALUE'])):?>
									<?foreach ($arResult['PROPERTIES']['SALE_ACTIONS']['VALUE'] as $saleLabelIndex => $saleLabel):?>
										<div class="product-card__label">
											<div class="label sale_label <?=$arResult['PROPERTIES']['SALE_ACTIONS']['VALUE_XML_ID'][$saleLabelIndex]?>"><?=$saleLabel?></div>
										</div>
									<?endforeach;?>
								<?endif?>

								<?/*if(!empty($arResult["PRICES"]["STANDARTPRICE"]["DISCOUNT_DIFF_PERCENT"])):*/?><!--
									<div class="label label_style_warning">
										Акция
									</div>
								--><?/*endif*/?>
							</div>
						<?endif?>
						<div class="product-card__photo-carousel-group">
							<!-- begin .photo-carousel-group-->
							<div class="photo-carousel-group">
								<div class="photo-carousel-group__main">
									<div class="photo-carousel-group__container swiper js-photo-carousel-main">
										<div class="photo-carousel-group__wrapper swiper-wrapper">
											<?if(!empty($arResult['GALLERY'])):?>
												<?foreach($arResult['GALLERY'] as $arImage):?>
													<div class="photo-carousel-group__slide swiper-slide">
														<div class="photo-carousel-group__illustration">
															<picture class="photo-carousel-group__picture">
																<img
																	src="<?=$arImage['CAROUSEL_SRC']?>"
																	alt="<?=$arResult['NAME']?>"
																	class="photo-carousel-group__image"
																	itemprop="image"
																/>
															</picture>
														</div>
													</div>
												<?endforeach?>
											<?else:?>
												<div class="photo-carousel-group__slide swiper-slide">
													<div class="photo-carousel-group__illustration">
														<picture class="photo-carousel-group__picture">
															<img
																src="<?=SITE_TEMPLATE_PATH . '/mockup/dist/assets/images/image-not-found.png'?>"
																alt="<?=$arResult['NAME']?>"
																class="photo-carousel-group__image"
																itemprop="image"
															/>
														</picture>
													</div>
												</div>
											<?endif?>
										</div>
									</div>
									<?if(count($arResult['GALLERY']) > 1):?>
										<div class="photo-carousel-group__navigation">
											<div class="photo-carousel-group__arrows">
												<!-- begin .carousel-nav-->
												<div
													class="carousel-nav carousel-nav_position_sides js-carousel-nav"
													data-nav-scope=".photo-carousel-group"
													data-nav-target=".js-photo-carousel-main"
												>
													<div class="carousel-nav__control">
														<button
															type="button"
															class="carousel-nav__arrow carousel-nav__arrow_type_prev js-carousel-nav-prev"
														>
															Предыдущий слайд
														</button>
													</div>
													<div class="carousel-nav__control">
														<button
															type="button"
															class="carousel-nav__arrow carousel-nav__arrow_type_next js-carousel-nav-next"
														>
															Следующий слайд
														</button>
													</div>
												</div>
												<!-- end .carousel-nav-->
											</div>
										</div>
									<?endif?>
								</div>
								<?if(count($arResult['GALLERY']) > 1):?>
									<div class="photo-carousel-group__nav">
										<div class="photo-carousel-group__nav-container swiper js-photo-carousel-nav">
											<div class="photo-carousel-group__nav-wrapper swiper-wrapper">
												<?foreach($arResult['GALLERY'] as $arImage):?>
													<div class="photo-carousel-group__nav-slide swiper-slide">
														<div class="photo-carousel-group__nav-illustration">
															<picture class="photo-carousel-group__picture">
																<img
																	src="<?=$arImage['THUMB_SRC']?>"
																	alt="<?=$arImage['NAME']?>"
																	class="photo-carousel-group__image"
																/>
															</picture>
														</div>
													</div>
												<?endforeach?>
											</div>
										</div>
									</div>
								<?endif?>
							</div>
							<!-- end .photo-carousel-group-->
						</div>
					</div>


				<div class="product-card__main">
					<div class="product-card__main-wrapper">
						<div class="product-card__header">
							<?if(!empty($arResult['ARTICLE'])):?>
								<div class="product-card__top">
									<div class="product-card__articul">
										<!-- begin .props-->
										<div class="props props_size_l">
												<div class="props__prop">
														<div class="props__label">Артикул:</div>
														<div class="props__value"><?=$arResult['ARTICLE']?></div>
												</div>
										</div>
										<!-- end .props-->
									</div>
                                    <div class="product-card__controls">
                                        <!-- button_state_active for added state-->
                                        <!--<div class="product-card__control">
                                            <a
                                                class="button button_type_operational button_state_active"
                                                href="#"
                                            >
                                                <span class="button__holder">
                                                    <svg
                                                            width="16"
                                                            height="16"
                                                            viewBox="0 0 16 16"
                                                            fill="none"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            class="button__icon"
                                                    >
                                                        <path
                                                                d="M2 6.00004H4V14.6667H2V6.00004Z"
                                                        ></path>
                                                        <path
                                                                d="M5.33333 1.33337H7.33333V14.6667H5.33333V1.33337Z"
                                                        ></path>
                                                        <path
                                                                d="M8.66667 8.00004H10.6667V14.6667H8.66667V8.00004Z"
                                                        ></path>
                                                        <path
                                                                d="M12 4.00004H14V14.6667H12V4.00004Z"
                                                        ></path>
                                                    </svg>
                                                    <span class="button__text">К сравнению</span>
                                                </span>
                                            </a>
                                        </div>-->
                                        <div class="product-card__control favorite-wrapper">
                                            <!-- begin .button-->
                                            <a class="button button_type_operational button_type_operational-filling js-toggle-favorite">
                                                <span class="button__holder<?if($arResult["IS_FAVORITE"]):?> is-favorite<?endif;?>">
                                                    <svg
                                                            width="16"
                                                            height="16"
                                                            viewBox="-2 -2 20 20"
                                                            fill="none"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            class="button__icon not-favorite"
                                                    >
                                                        <path
                                                                d="M8.00004 3.39C8.72671 2.54 9.84004 2 11 2C13.0567 2 14.6667 3.61 14.6667 5.66667C14.6667 8.1824 12.4017 10.2385 8.97055 13.3532L8.96671 13.3567L8.00004 14.2333L7.03337 13.3567L7.02953 13.3532C3.59835 10.2385 1.33337 8.18239 1.33337 5.66667C1.33337 3.61 2.94337 2 5.00004 2C6.16004 2 7.27337 2.54 8.00004 3.39Z"
                                                        ></path>
                                                    </svg>
                                                    <svg
                                                            width="16"
                                                            height="16"
                                                            viewBox="-2 -2 20 20"
                                                            fill="none"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            class="button__icon favorite"
                                                    >
                                                        <path
                                                                d="M8.00004 3.39C8.72671 2.54 9.84004 2 11 2C13.0567 2 14.6667 3.61 14.6667 5.66667C14.6667 8.1824 12.4017 10.2385 8.97055 13.3532L8.96671 13.3567L8.00004 14.2333L7.03337 13.3567L7.02953 13.3532C3.59835 10.2385 1.33337 8.18239 1.33337 5.66667C1.33337 3.61 2.94337 2 5.00004 2C6.16004 2 7.27337 2.54 8.00004 3.39Z" fill="#CF006F"
                                                        ></path>
                                                    </svg>
                                                    <span class="button__text">В избранное</span>
                                                </span>
                                            </a>
                                            <!-- end .button-->
                                        </div>
                                    </div>
								</div>
							<?endif?>
							<div class="product-card__title">
								<!-- begin .title-->
								<h1 class="title title_size_h2"><?$APPLICATION->ShowTitle(false)?></h1>
								<!-- end .title-->
							</div>
						</div>
						<div class="product-card__content">
							<?if(!empty($arCatalogData["PRICE"]["VALUE"])):?>
								<div class="product-card__price-group">
									<!-- begin .price-group-->
									<div class="price-group">
										<?if(!empty($arCatalogData["PRICE"]["DISCOUNT_DIFF"])):?>
											<div class="price-group__extra">
												<?if(!empty($arCatalogData["PRICE"]["DISCOUNT_DIFF"]) && !empty($arCatalogData["PRICE"]["PRINT_BASE_VALUE"])):?>
													<div class="price-group__price price-group__price_type_old">
														<span class="price-group__value">
															<?=$arCatalogData["PRICE"]['PRINT_BASE_VALUE']?></span>
														</span>
													</div>
												<?endif?>
                                                <?if(!empty($arCatalogData["PRICE"]['DISCOUNT_DIFF_PERCENT'])):?>
													<div class="price-group__label">
															<!-- begin .label-->
															<div class="label label_style_secondary">
																	Скидка -<?=$arCatalogData["PRICE"]['DISCOUNT_DIFF_PERCENT']?>%
															</div>
															<!-- end .label-->
													</div>
												<?endif?>
                                                <?if(!empty($arCatalogData["PRICE"]["PRINT_DISCOUNT_VALUE"])):?>
													<div class="price-group__label">
															<!-- begin .label-->
															<div class="label label_style_secondary">
																	Выгода <?=$arCatalogData["PRICE"]["PRINT_DISCOUNT_VALUE"]?>
															</div>
															<!-- end .label-->
													</div>
												<?endif?>
											</div>
										<?endif?>
										<div class="price-group__main">
											<div class="price-group__price">
                                                <?if(!empty($arCatalogData["PRICE"]["PRINT_VALUE"])):?>
                                                    <span class="price-group__value"><?=$arCatalogData["PRICE"]['PRINT_VALUE']?></span><?if(!empty($arCatalogData['PACKAGE_AMOUNT']['MEASURE'])):?><span class="price-group__unit">/<?=$arCatalogData['PACKAGE_AMOUNT']['MEASURE']?></span><?endif?>
                                                <?endif?>
											</div>
										</div>
									</div>
									<!-- end .price-group-->
								</div>
							<?endif?>

							<div class="product-card__info">
								<?/* Есть цена, есть в наличии в выбранном регионе */?>
								<?if(!empty($arCatalogData["PRICE"]["VALUE"]) && !empty($arCatalogData["QUANTITY"]['REGION_QUANTITY'])):?>
									<div class="product-card__availability product-card__availability_status_available">
										В наличии
									</div>
								<?/* Есть цена, есть в наличии в других регионах */?>
								<?elseif(!empty($arCatalogData["PRICE"]["VALUE"]) && (!empty($arCatalogData["QUANTITY"]['TOTAL_QUANTITY']) || $arResult['ANY_STORE_HAS_STOCK'])):?>
									<div class="product-card__availability product-card__availability_status_available">
										В наличии на других складах
									</div>
								<?/* Есть цена, нет в наличии */?>
								<?elseif(!empty($arCatalogData["PRICE"]["VALUE"])):?>
									<div class="product-card__availability <?=$arCatalogData["QUANTITY"]["STATUS"]["CLASS"]?>">
										<?=$arCatalogData["QUANTITY"]["STATUS"]["TEXT"]?>
									</div>
								<?/* Нет цены, наличие не влияет */?>
								<?else:?>
									<div class="product-card__availability <?=$arCatalogData["QUANTITY"]["STATUS"]["CLASS"]?>">
										Недоступен для заказа
									</div>
								<?endif;?>
							</div>

							<?php if(!empty($arResult['SHORT_PROPERTIES'])): ?>
								<div class="product-card__props">
									<div class="props props_type_dotted props_layout_spread props_size_l">
										<?foreach($arResult['SHORT_PROPERTIES'] as $arProp):?>
											<div class="props__prop">
													<div class="props__label"><?=$arProp['LABEL']?>:</div>
													<div class="props__value"><?=$arProp['VALUE']?></div>
											</div>
										<?endforeach?>
                                        <?if(!empty($arCatalogData["PACKAGE_AMOUNT"]["IS_SOLD_IN_PACKS"]) && !empty($arCatalogData["UNIT_PRICE"]["PRINT_VALUE"])):?>
                                            <div class="props__prop">
                                                <div class="props__label">Цена за 1 шт:</div>
                                                <div class="props__value"><?=$arCatalogData["UNIT_PRICE"]["PRINT_VALUE"]?></div>
                                            </div>
                                        <?php endif; ?>
									</div>
								</div>
							<?php endif; ?>

							<?if(!empty($arResult['PREVIEW_TEXT'])):?>
								<div class="product-card__description"><?=$arResult['PREVIEW_TEXT']?></div>
							<?endif?>

							<?/* Если есть цена, то показываем кнопки. Иначе ничего не показываем */?>
                            <?if(!empty($arCatalogData["PRICE"]["VALUE"])):?>
								<?/* Если есть в наличии, выводится выбор количества и добавление в корзину */?>
								<?if(!empty($arCatalogData["QUANTITY"]['REGION_QUANTITY']) ):?>
									<form class="product-card__final">
										<div class="product-card__quantity-input">
											<!-- begin .quantity-input-->
											<div class="quantity-input">
												<div class="quantity-input__wrapper js-quantity-container">
													<div class="quantity-input__control">
															<button type="button" disabled="" class="quantity-input__button quantity-input__button_type_decrease js-quantity-decrease">
																	Убавить
															</button>
													</div>
													<div class="quantity-input__field">
															<input type="number" value="<?=$basket->getBasketQuantityByProductId($arResult['ID'])?>" min="1" max="<?=$arCatalogData["QUANTITY"]['REGION_QUANTITY']?>" data-min="1" data-max="<?=$arCatalogData["QUANTITY"]['REGION_QUANTITY']?>" class="quantity-input__input js-quantity-input" data-last-val="1" data-product-quantity="<?=$arResult['ID']?>" data-product-item="detail_product_<?=$arResult['ID']?>" data-product-id="<?=$arResult['ID']?>">
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
										<div class="product-card__button">
												<!-- begin .button-->
												<button
                                                        type="button"
                                                        class="button button_width_full button_icon-size_l button_text-size_l button_size_xl <?=($basket->isProductInBasket($arResult['ID']) ? 'button_state_alt-content' : '')?>"
                                                        data-product-add-to-card
                                                        data-product-item="detail_product_<?=$arResult['ID']?>"
                                                        data-product-id="<?=$arResult['ID']?>"
                                                        data-package-amount="<?=$arCatalogData["PACKAGE_AMOUNT"]["PACKAGE_AMOUNT"]?>"
                                                >
														<span class="button__holder">
																<span class="button__wrapper button__wrapper_type_initial">
																		<span class="button__holder">
																				<svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg" class="button__icon">
																					<path d="M8.16666 25.6666C7.52499 25.6666 6.97588 25.4384 6.51932 24.9818C6.06199 24.5245 5.83332 23.975 5.83332 23.3333C5.83332 22.6916 6.06199 22.1421 6.51932 21.6848C6.97588 21.2283 7.52499 21 8.16666 21C8.80832 21 9.35743 21.2283 9.81399 21.6848C10.2713 22.1421 10.5 22.6916 10.5 23.3333C10.5 23.975 10.2713 24.5245 9.81399 24.9818C9.35743 25.4384 8.80832 25.6666 8.16666 25.6666ZM19.8333 25.6666C19.1917 25.6666 18.6425 25.4384 18.186 24.9818C17.7287 24.5245 17.5 23.975 17.5 23.3333C17.5 22.6916 17.7287 22.1421 18.186 21.6848C18.6425 21.2283 19.1917 21 19.8333 21C20.475 21 21.0245 21.2283 21.4818 21.6848C21.9384 22.1421 22.1667 22.6916 22.1667 23.3333C22.1667 23.975 21.9384 24.5245 21.4818 24.9818C21.0245 25.4384 20.475 25.6666 19.8333 25.6666ZM7.17499 6.99998L9.97499 12.8333H18.1417L21.35 6.99998H7.17499ZM8.16666 19.8333C7.29166 19.8333 6.63055 19.4491 6.18332 18.6806C5.7361 17.913 5.71666 17.15 6.12499 16.3916L7.69999 13.5333L3.49999 4.66665H2.30416C1.9736 4.66665 1.70138 4.55465 1.48749 4.33065C1.2736 4.10742 1.16666 3.83054 1.16666 3.49998C1.16666 3.16942 1.27866 2.89215 1.50266 2.66815C1.72588 2.44492 2.00277 2.33331 2.33332 2.33331H4.22916C4.44305 2.33331 4.64721 2.39165 4.84166 2.50831C5.0361 2.62498 5.18193 2.79026 5.27916 3.00415L6.06666 4.66665H23.275C23.8 4.66665 24.1597 4.86109 24.3542 5.24998C24.5486 5.63887 24.5389 6.0472 24.325 6.47498L20.1833 13.9416C19.9694 14.3305 19.6875 14.6319 19.3375 14.8458C18.9875 15.0597 18.5889 15.1666 18.1417 15.1666H9.44999L8.16666 17.5H21.0292C21.3597 17.5 21.6319 17.6116 21.8458 17.8348C22.0597 18.0588 22.1667 18.3361 22.1667 18.6666C22.1667 18.9972 22.0547 19.2741 21.8307 19.4973C21.6074 19.7213 21.3305 19.8333 21 19.8333H8.16666ZM9.97499 12.8333H18.1417H9.97499Z"></path>
																				</svg>
																				<span class="button__text">В корзину</span>
																		</span>
																</span>
																<span class="button__wrapper button__wrapper_type_alt">
																		<span class="button__holder">
																				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="button__icon">
																						<path d="M9.00039 16.2001L4.80039 12.0001L3.40039 13.4001L9.00039 19.0001L21.0004 7.0001L19.6004 5.6001L9.00039 16.2001Z"></path>
																				</svg>
																				<span class="button__text">В корзине</span>
																		</span>
																</span>
														</span>
												</button>
												<!-- end .button-->
										</div>
									</form>
								<?/* Если нет в наличии, выводится только кнопка для модального окна с формой */?>
                                <?else:?>
									<div class="product-card__final">
										<div class="product-card__button">
											<a class="button button_width_full button_text-size_l button_size_l button_style_outline js-modal js-set-value" href="#modalOrder" data-text="<?$APPLICATION->ShowTitle(false)?>" data-selector=".js-product-name-input">
												<span class="button__holder">
													<span class="button__text">Заказать товар</span>
												</span>
											</a>
										</div>
									</div>
                                <?endif;?>
							<?endif;?>
						</div>
					</div>
				</div>
			</div>
			<?if(!$request->isAjaxRequest()):?>
				<script type="application/ld+json">
					{
						"@context": "https://schema.org/",
						"@type": "Product",
						"productID": "<?=$arResult["ID"]?>",
						"name": "<?$APPLICATION->ShowTitle(false)?>",
						"image": "<?=(CMain::IsHTTPS()) ? 'https://' : 'http://'?><?=$_SERVER['SERVER_NAME']?><?=$arResult['GALLERY'][0]['CAROUSEL_SRC']?>",
						"description": "<?=str_replace("\n", "", strip_tags($arResult['PREVIEW_TEXT']))?>",
						"brand": "<?=$arResult['BRAND']['NAME']?>",
						"category": "<?=str_replace("/", " > ", $arResult['CATEGORY_PATH'])?>",
						"offers": [
							{
								"@type": "Offer",
								"url": "<?=(CMain::IsHTTPS()) ? "https://" : "http://"?><?=$_SERVER["SERVER_NAME"]?><?=$APPLICATION->GetCurPage()?>",
                                "priceCurrency": "<?=$arCatalogData['PRICE']['CURRENCY']?>",
                                "price": "<?=$arCatalogData['PRICE']['VALUE']?>",
                                "availability": "<?=(!empty($arCatalogData["QUANTITY"]["REGION_QUANTITY"]) ? "https://schema.org/InStock" : (!empty($arCatalogData["QUANTITY"]["TOTAL_QUANTITY"]) ? "https://schema.org/PreOrder" : "https://schema.org/OutOfStock"))?>"
							}
						]
					}
				</script>
			<?endif;?>
		</div>
		<!-- end .product-card-->
	</div>
</div>

<div class="page__section">
	<div class="page__container">
		<div class="page__info-tabs">
				<!-- begin .tabs-->
				<!-- containers without js-tabs class will be ignored by script completely-->
				<!-- triggers without js-tabs-trigger will be ignored by script-->
				<!-- panels without js-tabs-panel will be ignored by script-->
				<!-- if links and panels need to be in separate containers, apply data-tabs-set="some-selector" on js-tabs element-->
				<!-- that selector should match a single element, containing .js-tabs-panel elements inside it-->
				<div class="tabs tabs_type_tiles js-tabs">
						<ul class="tabs__nav">
								<li class="tabs__item">
										<button class="tabs__label js-tabs-trigger" type="button">Описание</button>
								</li>
								<?if(!empty($arResult['FILES'])):?>
									<li class="tabs__item">
											<button class="tabs__label js-tabs-trigger" type="button">Документация</button>
									</li>
								<?endif?>
						</ul>
						<div class="tabs__content">
								<div class="tabs__panel js-tabs-panel">
									<?php if(!empty($arResult['DETAIL_PROPERTIES'])): ?>
										<div class="tabs__props-group">
											<div class="tabs__props tabs__props_width_l">
												<!-- begin .props-->
												<div class="props props_size_l props_layout_spread props_type_dotted">
													<?foreach($arResult['DETAIL_PROPERTIES'] as $arProp):?>
														<div class="props__prop">
																<div class="props__label"><?=$arProp['LABEL']?>:</div>
																<div class="props__value"><?=$arProp['VALUE']?></div>
														</div>
													<?endforeach?>
													</div>
												<!-- end .props-->
											</div>
										</div>
									<?php endif; ?>

									<?if(!empty($arResult['LIST_OF_DRINK'])):?>
										<div class="tabs__text">
											<div class="tabs__props tabs__props_width_l">
												<div class="props props_size_l props_type_dotted">
													<div class="props__prop">
															<div class="props__label">Количество выборов напитков</div>
															<div class="props__value"><?=count($arResult['LIST_OF_DRINK'])?>:</div>
														</div>
												</div>
											</div>

											<ul>
												<?foreach($arResult['LIST_OF_DRINK'] as $item):?>
													<li><?=$item?></li>
												<?endforeach?>
											</ul>
										</div>
									<?endif?>

									<?if(!empty($arResult['DETAIL_TEXT'])):?>
										<div class="tabs__text"><?=$arResult['DETAIL_TEXT']?></div>
									<?elseif(!empty($arResult['PREVIEW_TEXT'])):?>
										<div class="tabs__text"><?=$arResult['PREVIEW_TEXT']?></div>
									<?endif?>
								</div>

								<?if(!empty($arResult['FILES'])):?>
									<div class="tabs__panel js-tabs-panel">
											<div class="tabs__docs">
													<!-- begin .doc-list-->
													<div class="doc-list">
															<ul class="doc-list__list">
																<?foreach($arResult['FILES'] as $arFile):?>
																	<li class="doc-list__item">
																			<div class="doc-list__document">
																					<div class="doc-list__main">
																							<!-- begin .link-item-->
																							<div
																									class="link-item link-item_text-size_l link-item_icon-size_m link-item_effects_static"
																							>
																									<div class="link-item__icon-wrapper">
																											<svg
																													class="link-item__icon"
																													width="20"
																													height="20"
																													viewBox="0 0 20 20"
																													fill="none"
																													xmlns="http://www.w3.org/2000/svg"
																											>
																													<path
																															d="M6.8891 12.2333C6.73577 12.2333 6.63243 12.2483 6.5791 12.2633V13.245C6.64243 13.26 6.7216 13.2642 6.83077 13.2642C7.22993 13.2642 7.47577 13.0625 7.47577 12.7217C7.47577 12.4167 7.2641 12.2333 6.8891 12.2333ZM9.79493 12.2433C9.62827 12.2433 9.51993 12.2583 9.45577 12.2733V14.4483C9.51993 14.4633 9.62327 14.4633 9.7166 14.4633C10.3974 14.4683 10.8408 14.0933 10.8408 13.3C10.8458 12.6083 10.4416 12.2433 9.79493 12.2433Z"
																															fill="#939393"
																													/>
																													<path
																															d="M11.6663 1.66666H4.99967C4.55765 1.66666 4.13372 1.84225 3.82116 2.15481C3.5086 2.46737 3.33301 2.8913 3.33301 3.33332V16.6667C3.33301 17.1087 3.5086 17.5326 3.82116 17.8452C4.13372 18.1577 4.55765 18.3333 4.99967 18.3333H14.9997C15.4417 18.3333 15.8656 18.1577 16.1782 17.8452C16.4907 17.5326 16.6663 17.1087 16.6663 16.6667V6.66666L11.6663 1.66666ZM7.91467 13.4917C7.65717 13.7333 7.27717 13.8417 6.83467 13.8417C6.74887 13.8426 6.66311 13.8376 6.57801 13.8267V15.015H5.83301V11.735C6.16922 11.6848 6.50894 11.662 6.84884 11.6667C7.31301 11.6667 7.64301 11.755 7.86551 11.9325C8.07717 12.1008 8.22051 12.3767 8.22051 12.7017C8.21967 13.0283 8.11134 13.3042 7.91467 13.4917ZM11.0872 14.6208C10.7372 14.9117 10.2047 15.05 9.55384 15.05C9.16384 15.05 8.88801 15.025 8.70051 15V11.7358C9.03684 11.6867 9.37646 11.6636 9.71634 11.6667C10.3472 11.6667 10.7572 11.78 11.0772 12.0217C11.423 12.2783 11.6397 12.6875 11.6397 13.275C11.6397 13.9108 11.4072 14.35 11.0872 14.6208ZM14.1663 12.3083H12.8897V13.0675H14.083V13.6792H12.8897V15.0158H12.1347V11.6917H14.1663V12.3083ZM11.6663 7.49999H10.833V3.33332L14.9997 7.49999H11.6663Z"
																															fill="#939393"
																													/>
																											</svg>
																									</div>
																									<div class="link-item__label"><?=$arFile['ORIGINAL_NAME']?></div>
																							</div>
																							<!-- end .link-item-->
																					</div>
																					<div class="doc-list__link">
																							<!-- begin .link-item-->
																							<a
																									class="link-item link-item_text-size_l link-item_icon-size_m link-item_style_primary"
																									href="<?=$arFile['SRC']?>"
																							>
																									<span class="link-item__icon-wrapper">
																											<svg
																													class="link-item__icon"
																													width="20"
																													height="20"
																													viewBox="0 0 20 20"
																													fill="none"
																													xmlns="http://www.w3.org/2000/svg"
																											>
																													<path
																															d="M9.99967 13.3333L5.83301 9.16668L6.99967 7.95834L9.16634 10.125V3.33334H10.833V10.125L12.9997 7.95834L14.1663 9.16668L9.99967 13.3333ZM3.33301 16.6667V12.5H4.99967V15H14.9997V12.5H16.6663V16.6667H3.33301Z"
																													/>
																											</svg>
																									</span>
																									<span class="link-item__label">Скачать</span>
																							</a>
																							<!-- end .link-item-->
																					</div>
																			</div>
																	</li>
																<?endforeach?>
															</ul>
													</div>
													<!-- end .doc-list-->
											</div>
									</div>
								<?endif?>
						</div>
				</div>
				<!-- end .tabs-->
		</div>
	</div>
</div>
<?
unset($actualItem, $itemIds, $jsParams);
?>

<?
if(!empty($arResult["PROPERTIES"]["LINKED_PRODUCTS"]["VALUE"]) && is_array($arResult["PROPERTIES"]["LINKED_PRODUCTS"]["VALUE"])) {
?>
    <div class="page__section">
        <div class="page__container">
            <!-- begin .section-->
            <div class="section">
                <div class="section__header section__header_type_inline">
                    <div class="section__title">
                        <!-- begin .title-->
                        <div class="title title_size_h1">
                            <span class="hide-up-m">А также</span>
                            <span class="hide-m">С этим товаром покупают</span>
                        </div>
                        <!-- end .title-->
                    </div>
                    <div class="section__extra">
                        <div class="section__link-item">
                            <!-- begin .link-item-->
                            <a
                                class="link-item link-item_text-size_l link-item_icon-size_l link-item_icon-offset_l link-item_style_primary"
                                href="/catalog/"
                            >
                                <span class="link-item__label">Смотреть все</span>
                                <span class="link-item__icon-wrapper">
                                    <svg
                                            class="link-item__icon"
                                            width="24"
                                            height="24"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path d="M9.4 18L8 16.6L12.6 12L8 7.4L9.4 6L15.4 12L9.4 18Z" />
                                    </svg>
                                </span>
                            </a>
                            <!-- end .link-item-->
                        </div>
                    </div>
                </div>
                <?
                $GLOBALS["arLinkedProductsFilter"]["=ID"] = $arResult["PROPERTIES"]["LINKED_PRODUCTS"]["VALUE"];
                $APPLICATION->IncludeComponent(
                    "bitrix:catalog.section",
                    "product-slider",
                    array(
                        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                        "ELEMENT_SORT_FIELD" => "ID",
                        "ELEMENT_SORT_ORDER" => $GLOBALS["arLinkedProductsFilter"]["=ID"],
                        "ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
                        "ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
                        "PROPERTY_CODE" => (isset($arParams["LIST_PROPERTY_CODE"]) ? $arParams["LIST_PROPERTY_CODE"] : []),
                        "PROPERTY_CODE_MOBILE" => $arParams["LIST_PROPERTY_CODE_MOBILE"],
                        "META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
                        "META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
                        "BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
                        "SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
                        "INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
                        "BASKET_URL" => $arParams["BASKET_URL"],
                        "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
                        "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
                        "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
                        "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
                        "PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
                        "FILTER_NAME" => "arLinkedProductsFilter",
                        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                        "CACHE_TIME" => $arParams["CACHE_TIME"],
                        "CACHE_FILTER" => $arParams["CACHE_FILTER"],
                        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                        "SET_TITLE" => $arParams["SET_TITLE"],
                        "MESSAGE_404" => $arParams["~MESSAGE_404"],
                        "SET_STATUS_404" => $arParams["SET_STATUS_404"],
                        "SHOW_404" => $arParams["SHOW_404"],
                        "FILE_404" => $arParams["FILE_404"],
                        "DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
                        "PAGE_ELEMENT_COUNT" => 25,
                        "LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
                        "PRICE_CODE" => $arParams["~PRICE_CODE"],
                        "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
                        "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

                        "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
                        "USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
                        "ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
                        "PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
                        "PRODUCT_PROPERTIES" => (isset($arParams["PRODUCT_PROPERTIES"]) ? $arParams["PRODUCT_PROPERTIES"] : []),

                        "DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
                        "DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
                        "PAGER_TITLE" => $arParams["PAGER_TITLE"],
                        "PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
                        "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
                        "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
                        "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
                        "PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
                        "PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
                        "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
                        "LAZY_LOAD" => $arParams["LAZY_LOAD"],
                        "MESS_BTN_LAZY_LOAD" => $arParams["~MESS_BTN_LAZY_LOAD"],
                        "LOAD_ON_SCROLL" => $arParams["LOAD_ON_SCROLL"],

                        "OFFERS_CART_PROPERTIES" => (isset($arParams["OFFERS_CART_PROPERTIES"]) ? $arParams["OFFERS_CART_PROPERTIES"] : []),
                        "OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
                        "OFFERS_PROPERTY_CODE" => (isset($arParams["LIST_OFFERS_PROPERTY_CODE"]) ? $arParams["LIST_OFFERS_PROPERTY_CODE"] : []),
                        "OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
                        "OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
                        "OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
                        "OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
                        "OFFERS_LIMIT" => (isset($arParams["LIST_OFFERS_LIMIT"]) ? $arParams["LIST_OFFERS_LIMIT"] : 0),

                        "SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
                        "DETAIL_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["element"],
                        "USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],
                        'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                        'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                        'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
                        'HIDE_NOT_AVAILABLE_OFFERS' => $arParams["HIDE_NOT_AVAILABLE_OFFERS"],

                        'LABEL_PROP' => $arParams['LABEL_PROP'],
                        'LABEL_PROP_MOBILE' => $arParams['LABEL_PROP_MOBILE'],
                        'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],
                        'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
                        'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
                        'PRODUCT_BLOCKS_ORDER' => $arParams['LIST_PRODUCT_BLOCKS_ORDER'],
                        'PRODUCT_ROW_VARIANTS' => $arParams['LIST_PRODUCT_ROW_VARIANTS'],
                        'ENLARGE_PRODUCT' => $arParams['LIST_ENLARGE_PRODUCT'],
                        'ENLARGE_PROP' => isset($arParams['LIST_ENLARGE_PROP']) ? $arParams['LIST_ENLARGE_PROP'] : '',
                        'SHOW_SLIDER' => $arParams['LIST_SHOW_SLIDER'],
                        'SLIDER_INTERVAL' => isset($arParams['LIST_SLIDER_INTERVAL']) ? $arParams['LIST_SLIDER_INTERVAL'] : '',
                        'SLIDER_PROGRESS' => isset($arParams['LIST_SLIDER_PROGRESS']) ? $arParams['LIST_SLIDER_PROGRESS'] : '',

                        'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
                        'OFFER_TREE_PROPS' => (isset($arParams['OFFER_TREE_PROPS']) ? $arParams['OFFER_TREE_PROPS'] : []),
                        'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
                        'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
                        'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
                        'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
                        'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
                        'MESS_SHOW_MAX_QUANTITY' => (isset($arParams['~MESS_SHOW_MAX_QUANTITY']) ? $arParams['~MESS_SHOW_MAX_QUANTITY'] : ''),
                        'RELATIVE_QUANTITY_FACTOR' => (isset($arParams['RELATIVE_QUANTITY_FACTOR']) ? $arParams['RELATIVE_QUANTITY_FACTOR'] : ''),
                        'MESS_RELATIVE_QUANTITY_MANY' => (isset($arParams['~MESS_RELATIVE_QUANTITY_MANY']) ? $arParams['~MESS_RELATIVE_QUANTITY_MANY'] : ''),
                        'MESS_RELATIVE_QUANTITY_FEW' => (isset($arParams['~MESS_RELATIVE_QUANTITY_FEW']) ? $arParams['~MESS_RELATIVE_QUANTITY_FEW'] : ''),
                        'MESS_BTN_BUY' => (isset($arParams['~MESS_BTN_BUY']) ? $arParams['~MESS_BTN_BUY'] : ''),
                        'MESS_BTN_ADD_TO_BASKET' => (isset($arParams['~MESS_BTN_ADD_TO_BASKET']) ? $arParams['~MESS_BTN_ADD_TO_BASKET'] : ''),
                        'MESS_BTN_SUBSCRIBE' => (isset($arParams['~MESS_BTN_SUBSCRIBE']) ? $arParams['~MESS_BTN_SUBSCRIBE'] : ''),
                        'MESS_BTN_DETAIL' => (isset($arParams['~MESS_BTN_DETAIL']) ? $arParams['~MESS_BTN_DETAIL'] : ''),
                        'MESS_NOT_AVAILABLE' => $arParams['~MESS_NOT_AVAILABLE'] ?? '',
                        'MESS_NOT_AVAILABLE_SERVICE' => $arParams['~MESS_NOT_AVAILABLE_SERVICE'] ?? '',
                        'MESS_BTN_COMPARE' => (isset($arParams['~MESS_BTN_COMPARE']) ? $arParams['~MESS_BTN_COMPARE'] : ''),

                        'USE_ENHANCED_ECOMMERCE' => (isset($arParams['USE_ENHANCED_ECOMMERCE']) ? $arParams['USE_ENHANCED_ECOMMERCE'] : ''),
                        'DATA_LAYER_NAME' => (isset($arParams['DATA_LAYER_NAME']) ? $arParams['DATA_LAYER_NAME'] : ''),
                        'BRAND_PROPERTY' => (isset($arParams['BRAND_PROPERTY']) ? $arParams['BRAND_PROPERTY'] : ''),

                        'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
                        "ADD_SECTIONS_CHAIN" => "Y",
                        'ADD_TO_BASKET_ACTION' => $basketAction,
                        'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
                        'COMPARE_PATH' => $arResult['FOLDER'] . $arResult['URL_TEMPLATES']['compare'],
                        'COMPARE_NAME' => $arParams['COMPARE_NAME'],
                        'USE_COMPARE_LIST' => 'Y',
                        'BACKGROUND_IMAGE' => (isset($arParams['SECTION_BACKGROUND_IMAGE']) ? $arParams['SECTION_BACKGROUND_IMAGE'] : ''),
                        'COMPATIBLE_MODE' => (isset($arParams['COMPATIBLE_MODE']) ? $arParams['COMPATIBLE_MODE'] : ''),
                        'DISABLE_INIT_JS_IN_COMPONENT' => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : ''),
                        'LIST_SHORT_PROPERTIES' => $arParams['SHORT_PROPERTIES'],
                        "BY_LINK" => 'Y',
                    ),
                    $component
                );
                ?>
            </div>
            <!-- end .section-->
        </div>
    </div>
    <?
}?>