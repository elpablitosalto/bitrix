<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>

<div class="tabs" id="#tabs">
	<div class="tabs-buttons-wrapper">
		<div class="tabs-buttons-wrapper__button _active">
			Все разделы
		</div>
		<?foreach($arResult['TYPES'] as $k => $type):?>
			<a class="tabs-buttons-wrapper__button" href="categories.php#tabs?CATEGORY=<?=$k?>">
				<?=$type['NAME']?>
			</a>
		<?endforeach;?>
	</div>
	<div class="current-select-item" style="display: block">
		<div class="tabs-item _active">
			<div class="tutorial-videos-section">
				<div class="tutorial-videos-section__content">
					<?if(!empty($arResult['ITEMS'])):?>
						<div class="tutorial-videos-section__wrapper">
							<?foreach($arResult['ITEMS'] as $i => $arItem):?>
								<div class="tutorial-videos-section__item">
									<div class="detailed-video">
										<a class="detailed-video__illustration" data-youtube href="<?=$arItem['PROPERTIES']['LINK']['VALUE']?>" style="background-image: url(<?=$arItem['PREVIEW_PICTURE']['SRC']?>)">
										</a>
										<div class="detailed-video__info">
											<div class="detailed-video__title">
												<?=$arItem['NAME']?>
											</div>
											<div class="detailed-video__fields">
												<?if(!empty($arItem['PREVIEW_TEXT'])):?>
													<div class="detailed-video__field">
														<?=$arItem['PREVIEW_TEXT']?>
													</div>
												<?endif;?>
												<?if(!empty($arItem['PROPERTIES']['PRODUCTS']['VALUE'])):?>
													<div class="detailed-video__field">
														<div class="detailed-video__subtitle">
															Продукты:
														</div>
														<?=$arItem['PROPERTIES']['PRODUCTS']['VALUE']?>
													</div>
												<?endif;?>
												<?if(!empty($arItem['PROPERTIES']['COLOR_TECHNIQUE']['VALUE'])):?>
													<div class="detailed-video__field">
														<div class="detailed-video__subtitle">
															Техника окрашивания:
														</div>
														<?=$arItem['PROPERTIES']['COLOR_TECHNIQUE']['VALUE']?>
													</div>
												<?endif;?>
												<?if(!empty($arItem['PROPERTIES']['RESULT']['VALUE'])):?>
													<div class="detailed-video__field">
														<div class="detailed-video__subtitle">
															Результат:
														</div>
														<?=$arItem['PROPERTIES']['RESULT']['VALUE']?>
													</div>
												<?endif;?>
												<?if(!empty($arItem['PROPERTIES']['BASE']['VALUE'])):?>
													<div class="detailed-video__field">
														<div class="detailed-video__subtitle">
															Исходная база:
														</div>
														<?=$arItem['PROPERTIES']['BASE']['VALUE']?>
													</div>
												<?endif;?>
												<?if(!empty($arItem['PROPERTIES']['SECRETS']['VALUE'])):?>
													<div class="detailed-video__field">
														<div class="detailed-video__subtitle">
															Секреты:
														</div>
														<?=$arItem['PROPERTIES']['SECRETS']['VALUE']?>
													</div>
												<?endif;?>
											</div>
											<?if(!empty($arItem['PROPERTIES']['INSTRUCTIONS']['VALUE'])):?>
												<?$fileSRC = CFile::GetPath($arItem['PROPERTIES']['INSTRUCTIONS']['VALUE']);?>
												<div class="detailed-video__download-link">
													<a href="<?=$fileSRC?>" target="_blank" class="dl-link dl-link_size_l">
														<svg class="dl-link__icon" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<path d="M11.9999 16C11.7949 16 11.5989 15.916 11.4579 15.768L6.20794 10.268C5.75294 9.792 6.09094 9 6.74994 9H9.49994V3.25C9.49994 2.561 10.0609 2 10.7499 2H13.2499C13.9389 2 14.4999 2.561 14.4999 3.25V9H17.2499C17.9089 9 18.2469 9.792 17.7919 10.268L12.5419 15.768C12.4009 15.916 12.2049 16 11.9999 16Z"></path>
															<path d="M22.25 22H1.75C0.785 22 0 21.215 0 20.25V19.75C0 18.785 0.785 18 1.75 18H22.25C23.215 18 24 18.785 24 19.75V20.25C24 21.215 23.215 22 22.25 22Z"></path>
														</svg>
														<span class="dl-link__label">Скачать инструкцию</span>
													</a>
												</div>
											<?endif;?>
										</div>
									</div>
								</div>
							<?endforeach;?>
						</div>
					<?endif;?>
				</div>
				<?if(!empty($arResult["NAV_STRING"])):?>
					<div class="tutorial-videos-section__pagination">
						<?=$arResult["NAV_STRING"]?>
					</div>
				<?endif;?>
			</div>
		</div>
	</div>
</div>