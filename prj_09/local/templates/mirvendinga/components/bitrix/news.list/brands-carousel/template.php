<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<? if(!empty($arResult['ITEMS'])): ?>
	<div class="page__section">
		<div class="page__container">
				<!-- begin .section-->
				<div class="section">
						<div class="section__header section__header_type_inline">
							<?if(!empty($arParams['TITLE'])):?>
									<div class="section__title">
											<!-- begin .title-->
											<div class="title title_size_h1"><?=$arParams['TITLE']?></div>
											<!-- end .title-->
									</div>
								<?endif?>
								<?if(!empty($arResult['MORE_LINK_URL'])):?>
									<div class="section__extra">
											<div class="section__link-item">
													<!-- begin .link-item-->
													<a
															class="link-item link-item_text-size_l link-item_icon-size_l link-item_icon-offset_l link-item_style_primary"
															href="<?=$arParams['MORE_LINK_URL']?>"
													>
															<span class="link-item__label"><?=$arParams['MORE_LINK_TEXT']?></span>
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
								<?endif?>
						</div>
						<div class="section__content">
								<div class="section__logo-carousel">
										<!-- begin .logo-carousel-->
										<div class="logo-carousel<?= (count($arResult['ITEMS']) < 4 ? ' logo-carousel_lacking-items' : '')?>">
												<div class="logo-carousel__container swiper js-logo-carousel">
														<div class="logo-carousel__wrapper swiper-wrapper">
																<?foreach($arResult['ITEMS'] as $key => $arItem):?>
																	<?if(!empty($arItem['BRAND_IMAGE']['SRC'])):?>
																		<div class="logo-carousel__slide swiper-slide">
																				<a class="logo-carousel__illustration" href="<?=$arItem['DETAIL_PAGE_URL']?>" target="_blank">
																						<picture class="logo-carousel__picture">
																								<img
																										src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
																										data-src="<?=$arItem['BRAND_IMAGE']['SRC']?>"
																										width="450"
																										height="301"
																										alt="<?=$arItem['NAME']?>"
																										class="logo-carousel__image swiper-lazy"
																								/>
																						</picture>
																				</a>
																		</div>
																	<?endif?>
																<?endforeach;?>
														</div>
														<div class="logo-carousel__navigation">
																<div class="logo-carousel__arrows">
																		<!-- begin .carousel-nav-->
																		<div
																				class="carousel-nav carousel-nav_position_sides js-carousel-nav"
																				data-nav-scope=".logo-carousel"
																				data-nav-target=".swiper"
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
												</div>
										</div>
										<!-- end .logo-carousel-->
								</div>
						</div>
				</div>
				<!-- end .section-->
		</div>
	</div>
<? endif; ?>
