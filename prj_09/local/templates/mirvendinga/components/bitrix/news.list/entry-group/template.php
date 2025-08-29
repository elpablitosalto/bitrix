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
				<div class="section <?=(!empty($arParams['SECTION_CLASS']) ? $arParams['SECTION_CLASS'] : '')?>">
						<?if(!empty($arParams['TITLE'])):?>
							<!--<div class="section__header section__header_title-width_s">-->
                            <div class="section__header">
                                <div class="section__title">
                                        <!-- begin .title-->
                                        <div class="title title_size_h1"><?=$arParams['TITLE']?></div>
                                        <!-- end .title-->
                                </div>
							</div>
						<?endif?>
						<div class="section__content">
								<div class="section__entry-group">
										<!-- begin .entry-group-->
										<div class="entry-group">
												<ul class="entry-group__list">
													<?foreach($arResult['ITEMS'] as $key => $arItem):?>

														<li class="entry-group__item">
																<!-- begin .entry-->
																<div class="entry entry-group__snippet">
																		<?if(!empty($arItem['PROPERTIES']['NUMBER']['VALUE'])):?>
																			<div class="entry__label"><?=$arItem['PROPERTIES']['NUMBER']['VALUE']?></div>
																		<?elseif(!empty($arItem['PREVIEW_PICTURE']['SRC'])):?>
																			<div class="entry__illustration">
																					<picture class="entry__picture">
																							<img
																								data-src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>"
																								width="60"
																								height="60"
																								alt="<?=$arItem['NAME']?>"
																								class="entry__image lazyload"
																							/>
																					</picture>
																			</div>
																		<?endif?>
																		<div class="entry__content">
																				<div class="entry__title">
																						<!-- begin .title-->
																						<h3 class="title title_size_h4"><?=$arItem['NAME']?></h3>
																						<!-- end .title-->
																				</div>
																				<?if(!empty($arItem['PREVIEW_TEXT'])):?>
																					<div class="entry__text">
																							<?=$arItem['PREVIEW_TEXT']?>
																					</div>
																				<?endif?>
																		</div>
																</div>
																<!-- end .entry-->
														</li>
													<?endforeach;?>
												</ul>
										</div>
										<!-- end .entry-group-->
								</div>
						</div>
				</div>
				<!-- end .section-->
		</div>
	</div>
<? endif; ?>
