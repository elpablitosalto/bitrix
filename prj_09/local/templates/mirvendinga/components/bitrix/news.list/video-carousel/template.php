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
		<!-- begin .section-->
		<div class="section">
				<div class="section__content">
						<div class="section__media-carousel">
								<!-- begin .media-carousel-->
								<div class="media-carousel">
										<div class="page__container">
												<div class="media-carousel__container swiper js-media-carousel">
														<div class="media-carousel__wrapper swiper-wrapper">
																<?foreach($arResult['ITEMS'] as $key => $arItem):?>
																	<div class="media-carousel__slide swiper-slide">
																			<div class="media-carousel__panel">
																				<?
																					$imageLink = !empty($arItem["VIDEO_PREVIEW_PICTURE_ORIGINAL"]["SRC"]) ? $arItem["VIDEO_PREVIEW_PICTURE_ORIGINAL"]["SRC"] : null;
																				?>
																				<?if(!empty($arItem["VIDEO_YOUTUBE_LINK"]) || !empty($imageLink)):?>
																						<a
																								href="<?=(!empty($arItem["VIDEO_YOUTUBE_LINK"]) ? $arItem["VIDEO_YOUTUBE_LINK"] : $imageLink)?>"
																								data-type="iframe"
																								class="media-carousel__illustration js-modal"
																						>
																							<?if(!empty($arItem["VIDEO_PREVIEW_PICTURE"]["src"])):?>
																								<picture class="media-carousel__picture">
																									<img
																										src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
																										data-src="<?=$arItem["VIDEO_PREVIEW_PICTURE"]["src"]?>"
																										alt="<?=$arItem["TITLE"]?>"
																										class="media-carousel__image <?=(count($arResult['ITEMS']) > 1 ? 'swiper-lazy' : 'lazyload')?>"
																									/>
																								</picture>
																							<?endif;?>
																								<span class="media-carousel__play">Проиграть видео</span>
																						</a>
																					<?else:?>
																						<div class="media-carousel__illustration"></div>
																					<?endif;?>
																					<div class="media-carousel__content">
																							<div class="media-carousel__title">
																									<!-- begin .title-->
																									<div class="title title_size_h2"><?=$arItem["TITLE"]?></div>
																									<!-- end .title-->
																							</div>
																							<?if(!empty($arItem["DESCRIPTION"])):?>
																								<div class="media-carousel__text"><?=$arItem["DESCRIPTION"]?></div>
																							<?endif;?>
																							<div class="media-carousel__controls">
																								<?if(!empty($arItem["PRIMARY_BUTTON"]["TEXT"]) && !empty($arItem["PRIMARY_BUTTON"]["HREF"])):?>
																									<div class="media-carousel__control">
																											<!-- begin .button-->
																											<a
																													class="button button_width_full button_size_s"
																													href="<?=$arItem["PRIMARY_BUTTON"]["HREF"]?>"
																											>
																													<span class="button__holder"><?=$arItem["PRIMARY_BUTTON"]["TEXT"]?></span>
																											</a>
																											<!-- end .button-->
																									</div>
																								<?endif;?>

																								<?if(!empty($arItem["SECONDARY_BUTTON"]["TEXT"]) && !empty($arItem["SECONDARY_BUTTON"]["HREF"])):?>
																									<div class="media-carousel__control">
																											<!-- begin .button-->
																											<a
																													class="button button_width_full button_size_s js-modal"
																													href="<?=$arItem["SECONDARY_BUTTON"]["HREF"]?>"
																											>
																													<span class="button__holder"><?=$arItem["SECONDARY_BUTTON"]["TEXT"]?></span>
																											</a>
																											<!-- end .button-->
																									</div>
																								<?endif;?>
																							</div>
																					</div>
																			</div>
																	</div>
																<?endforeach;?>
														</div>
														<?if(count($arResult['ITEMS']) > 1):?>
															<div class="media-carousel__navigation">
																	<div class="media-carousel__pagination">
																			<!-- begin .bullet-pagination-->
																			<div class="bullet-pagination"></div>
																			<!-- end .bullet-pagination-->
																	</div>
																	<div class="media-carousel__arrows">
																			<!-- begin .carousel-nav-->
																			<div
																					class="carousel-nav carousel-nav_type_solid js-carousel-nav"
																					data-nav-scope=".media-carousel"
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
														<?endif;?>
												</div>
										</div>
								</div>
								<!-- end .media-carousel-->
						</div>
				</div>
		</div>
		<!-- end .section-->
	</div>
<? endif; ?>
