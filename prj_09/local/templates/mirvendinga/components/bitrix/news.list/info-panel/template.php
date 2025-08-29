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
<? if(!empty($arResult['DISPLAY_ITEMS'])): ?>

	<div class="page__section">
		<div class="page__container">
				<!-- begin .section-->
				<div class="section">
						<div class="section__content">
								<div class="section__info-panel">

										<?foreach($arResult['DISPLAY_ITEMS'] as $arItem):?>
											<!-- begin .info-panel-->
											<!-- info-panel_type_simple -->
											<div class="info-panel <?=$arItem['SNIPPET_CLASS']?>">
													<div class="info-panel__content">
															<div class="info-panel__title">
																	<!-- begin .title-->
																	<div class="title <?=($arItem['IS_MINIMAL'] ? 'title_size_h2 title_align_center' : 'title_size_h1')?>"><?=$arItem['NAME']?></div>
																	<!-- end .title-->
															</div>

															<?if(!empty($arItem['PREVIEW_TEXT']) && !$arItem['IS_MINIMAL']):?>
																<div class="info-panel__text">
																		<?=$arItem['PREVIEW_TEXT']?>
																</div>
															<?endif?>

															<?if(!empty($arItem['BUTTON']) && !$arItem['BUTTON_HIDE'] && !$arItem['IS_MINIMAL']):?>
																<div class="info-panel__controls">
																		<div class="info-panel__control">
																				<!-- begin .button-->
																				<a
																						class="button button_width_full button_size_l button_text-size_l <?=$arItem['BUTTON']['CLASS']?>"
																						href="<?=$arItem['BUTTON']['HREF']?>"
																				>
																						<span class="button__holder"><?=$arItem['BUTTON']['TEXT']?></span>
																				</a>
																				<!-- end .button-->
																		</div>
																</div>
															<?endif?>
													</div>
													<?if(!empty($arItem['IMAGE']['SRC'])):?>
														<div class="info-panel__illustration">
																<picture class="info-panel__picture">
																		<img
																				src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
																				data-src="<?=$arItem['IMAGE']['SRC']?>"
																				width="692"
																				height="440"
																				alt="<?=$arItem['NAME']?>"
																				class="info-panel__image lazyload"
																		/>
																</picture>
														</div>
													<?endif?>
											</div>
											<!-- end .info-panel-->
										<?endforeach?>
								</div>
						</div>
				</div>
				<!-- end .section-->
		</div>
	</div>
<? endif; ?>
