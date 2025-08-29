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

$arBreakpoints = [
  "S" => "max-width: 479px",
  "M" => "max-width: 767px",
  "L" => "max-width: 1024px",
  "XL" => "max-width: 1280px",
  "XXL" => "max-width: 1439px",
];
?>
<? if(!empty($arResult['ITEMS'])): ?>
	<div class="page__intro">
		<!-- begin .banner-carousel-->
		<div class="banner-carousel">
			<div class="banner-carousel__container swiper js-banner-carousel">
				<div class="banner-carousel__wrapper swiper-wrapper">
					<?foreach($arResult['ITEMS'] as $key => $arItem):?>
						<div class="banner-carousel__slide swiper-slide">
							<!-- begin .banner-->
							<div class="banner banner-carousel__slide-wrapper <?=(!empty($arItem['BANNER_CLASS']) ? implode(' ', $arItem['BANNER_CLASS']) : '')?> " <?=(!empty($arItem['INLINE_STYLE']) ? 'style="'.implode(' ', $arItem['INLINE_STYLE']).'"' : '');?>>
								<?if(!empty($arItem["BACKGROUND"]["DEFAULT"]["SRC"])):?>
									<div class="banner__background">
										<picture class="banner__picture">
											<?foreach($arItem["BACKGROUND"]["BREAKPOINTS"] as $point => $arImage):?>
												<source
													srcset="<?=$arImage["SRC"]?>"
													type="image/png"
													media="(<?=$arBreakpoints[$point]?>)"
													class="banner__source"
												>
											<?endforeach;?>
											<img
												src="<?=$arItem["BACKGROUND"]["DEFAULT"]["SRC"]?>"
												alt
												class="banner__image"
											>
										</picture>
									</div>
								<?endif;?>
								<div class="banner__container">
									<?if(!empty($arItem["IMAGE"]["DEFAULT"]["SRC"])):?>
										<div class="banner__illustration">
											<picture class="banner__picture">
												<?foreach($arItem["IMAGE"]["BREAKPOINTS"] as $point => $arImage):?>
													<source
														srcset="<?=$arImage['SRC']?>"
														type="image/png"
														media="(<?=$arBreakpoints[$point]?>)"
														class="banner__source"
														<?=(!empty($arImage['WIDTH']) ? 'width="'.$arImage['WIDTH'].'"' : '');?>
														<?=(!empty($arImage['HEIGHT']) ? 'height="'.$arImage['HEIGHT'].'"' : '');?>
													>
												<?endforeach;?>
												<?if(!empty($arItem['IMAGE']['DEFAULT']['HALVED'])):?>
													<source
														srcset="<?=$arItem['IMAGE']['DEFAULT']['SRC']?>"
														type="image/png"
														class="banner__source"
														<?=(!empty($arItem['IMAGE']['DEFAULT']['WIDTH']) ? 'width="'.$arItem['IMAGE']['DEFAULT']['WIDTH'].'"' : '');?>
														<?=(!empty($arItem['IMAGE']['DEFAULT']['HEIGHT']) ? 'height="'.$arItem['IMAGE']['DEFAULT']['HEIGHT'].'"' : '');?>
													>
													<img
														src="<?=$arItem['IMAGE']['DEFAULT']['HALVED']?>"
														alt="<?=$arItem['NAME']?>"
														class="banner__image"
													>
												<?else:?>
													<img
														src="<?=$arItem['IMAGE']['DEFAULT']['SRC']?>"
														alt="<?=$arItem['NAME']?>"
														class="banner__image"
													>
												<?endif;?>
											</picture>
										</div>
									<?endif;?>

									<?if($arItem['SHOW_TEXT']):?>
										<div class="banner__content">
												<div class="banner__main">
													<div class="banner__heading">
														<?if(!empty($arItem['CAPTION'])):?>
															<div class="banner__label"><?=$arItem['CAPTION']?></div>
														<?endif;?>
														<h2 class="banner__title"><?=$arItem['NAME']?></h2>
														<div class="banner__subtitle"><?=$arItem['PREVIEW_TEXT']?></div>
													</div>

													<?if(!empty($arItem['BUTTON']['HREF']) && $arItem['BUTTON']['SHOW']):?>
														<div class="banner__controls">
															<div class="banner__control">
																<!-- begin .button-->
																<a class="button button_width_full button_size_s <?=(!empty($arItem['BUTTON']['CLASS']) ? $arItem['BUTTON']['CLASS'] : '')?>" href="<?=$arItem['BUTTON']['HREF']?>" <?=(str_contains($arItem['BUTTON']['HREF'], 'https://') ? 'target="_blank"' : '')?>>
																	<span class="button__holder"><?=$arItem['BUTTON']['TEXT']?></span>
																</a>
																<!-- end .button-->
															</div>
														</div>
													<?endif?>
												</div>
												<?if(!empty($arItem['LABEL'])):?>
													<div class="banner__bottom">
														<div class="banner__note"><?=$arItem['LABEL']?></div>
													</div>
												<?endif?>
										</div>
									<?endif?>

								</div>
								<?if(!empty($arItem['BUTTON']['HREF']) && !$arItem['BUTTON']['SHOW']):?>
									<a class="banner__stretched-link <?=(!empty($arItem['BUTTON']['CLASS']) ? $arItem['BUTTON']['CLASS'] : '')?>" href="<?=$arItem['BUTTON']['HREF']?>" <?=(str_contains($arItem['BUTTON']['HREF'], 'https://') ? 'target="_blank"' : '')?>><?=$arItem['BUTTON']['TEXT']?></a>
								<?endif;?>
							</div>
							<!-- end .banner-->
						</div>
					<?endforeach;?>
				</div>

				<div
					class="banner-carousel__navigation page__container page__container page__container_width_full"
				>
					<div class="banner-carousel__pagination">
							<!-- begin .bullet-pagination-->
							<div class="bullet-pagination"></div>
							<!-- end .bullet-pagination-->
					</div>
					<div class="banner-carousel__arrows">
							<!-- begin .carousel-nav-->
							<div
									class="carousel-nav carousel-nav_position_sides js-carousel-nav"
									data-nav-scope=".banner-carousel"
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
		<!-- end .banner-carousel-->
	</div>
<? endif; ?>
