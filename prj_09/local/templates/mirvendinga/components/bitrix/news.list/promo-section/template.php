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
								<div class="section__promo-group">
										<!-- begin .promo-group-->
										<div class="promo-group <?=$arResult['GRID_CLASS']?>">
												<div class="promo-group__container js-promo-group-carousel">
														<div class="promo-group__wrapper">
															<?foreach($arResult['ITEMS'] as $key => $arItem):?>
																<div class="promo-group__item">

																		<?if(count($arResult['ITEMS']) > 1):?>
																			<!-- begin .promo-panel-->
																			<?/*
																				promo-panel_style_morning - черный текст, желтый фон;
																				promo-panel_style_night - белый текст, черный фон;
																				promo-panel_style_ocean - белый текст, синий фон;
																				promo-panel_style_outline - черный текст, прозрачный фон;

																				promo-panel_layout_halfs - изображение выравнивается по правому краю и огранчивается 100% высотой и 50% шириной
																			*/?>
																			<div class="promo-panel <?=$arItem['SECTION_SNIPPET_CLASS']?>">
																				<div class="promo-panel__content">
																					<div class="promo-panel__title"><?=$arItem['NAME']?></div>
																					<?if(!empty($arItem['PREVIEW_TEXT'])):?>
																						<div class="promo-panel__text"><?=$arItem['PREVIEW_TEXT']?></div>
																					<?endif;?>
																					<div class="promo-panel__controls">
																						<div class="promo-panel__control">
																							<!-- begin .button-->
																							<a class="button button_width_full button_size_s" href="<?=$arItem['DETAIL_PAGE_URL']?>">
																								<span class="button__holder">Подробнее</span>
																							</a>
																							<!-- end .button-->
																						</div>
																					</div>
																				</div>
																				<?if(!empty($arItem['SECTION_IMAGE']['SRC'])):?>
																					<div class="promo-panel__illustration">
																						<picture class="promo-panel__picture">
																							<img src="<?=$arItem['SECTION_IMAGE']['SRC']?>" alt="<?=$arItem['NAME']?>" class="promo-panel__image">
																						</picture>
																					</div>
																				<?endif;?>
																				<?if(!empty($arItem['PROPERTIES']['DISPLAYED_CONTENT']['VALUE']) && $arItem['PROPERTIES']['DISPLAYED_CONTENT']['VALUE_XML_ID'] === 'no-content'):?>
																					<a class="promo-panel__stretched-link" href="<?=$arItem['DETAIL_PAGE_URL']?>">Подрбнее</a>
																				<?endif;?>
																			</div>
																			<!-- end .promo-panel-->
																		<?else:?>
																			<div class="info-panel">
																				<div class="info-panel__content">
																						<div class="info-panel__title">
																							<?if(!empty($arItem['NAME'])):?>
																								<div class="title title_size_h2 title_align_center"><?=$arItem['NAME']?></div>
																							<?endif;?>

																							<?if(false && !empty($arItem['PREVIEW_TEXT'])):?>
																								<div class="info-panel__text"><?=$arItem['PREVIEW_TEXT']?></div>
																							<?endif;?>
																						</div>
																				</div>
																				<div class="info-panel__illustration">
																					<?if(!empty($arItem['SECTION_IMAGE']['SRC'])):?>
																						<picture class="info-panel__picture">
																								<img data-src="<?=$arItem['SECTION_IMAGE']['SRC']?>" alt="<?=$arItem['NAME']?>" class="info-panel__image lazyload lazyload_entered lazyload_loaded">
																						</picture>
																					<?endif?>
																				</div>
																		</div>
																		<?endif?>
																</div>
															<?endforeach?>
														</div>
												</div>
										</div>
										<!-- end .promo-group-->
								</div>
						</div>
				</div>
				<!-- end .section-->
		</div>
	</div>
<? endif; ?>
