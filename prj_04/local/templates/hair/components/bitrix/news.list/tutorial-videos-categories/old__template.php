<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>

<div class="tabs" id="#tabs">
	<div class="tabs-buttons-wrapper">
		<a class="tabs-buttons-wrapper__button" href=".#tabs">
			Все разделы
		</a>
		<?
			$activeCategory = $_GET['CATEGORY'];
			$i = 1;
			if (empty($arResult['TYPES'][$activeCategory])) {
				$activeCategory = array_key_first($arResult['TYPES']);
			}
		?>
		<?foreach($arResult['TYPES'] as $k => $type):?>
			<button class="tabs-buttons-wrapper__button<?=($k === $activeCategory) ? ' _active' : ''?>" data-tab="<?=$i?>">
				<?=$type['NAME']?>
			</button>
			<?$i++?>
		<?endforeach;?>
	</div>
	<div class="current-select-item" style="display: block">
		<?foreach($arResult['TYPES'] as $k => $type):?>
			<div class="tabs-item<?=($activeCategory === $k) ? ' _active' : ''?>">
				<?
					$firstTopicCode = $k;
					$firstTopic = $type;
					if (!empty($type['TOPICS'])) {
						$firstTopicCode = array_key_first($type['TOPICS']);
						$firstTopic = $type['TOPICS'][$firstTopicCode];
					}
				?>
				<div class="tutorial-videos-section">
					<div class="tutorial-videos-section__header">
						<h2 class="tutorial-videos-section__title">
							<?=$firstTopic['NAME']?>
						</h2>
						<div class="tutorial-videos-section__arrows">
							<div class="carousel-navigation">
								<button id="<?=$k.'_'.$firstTopicCode.'_prev'?>" class="carousel-navigation__arrow carousel-navigation__arrow_type_prev set-carousel__prev" type="button">Предыдущий слайд</button>
								<button id="<?=$k.'_'.$firstTopicCode.'_next'?>" class="carousel-navigation__arrow carousel-navigation__arrow_type_next set-carousel__next" type="button">Следйющий слайд</button>
							</div>
						</div>
					</div>
					<div class="tutorial-videos-section__content">
						<div class="tutorial-videos-section__carousel">
							<div class="tutorial-videos-carousel">
								<div class="tutorial-videos-carousel__container swiper-container js-tutorial-videos-carousel" data-arrows="<?=$k.'_'.$firstTopicCode?>_">
									<div class="tutorial-videos-carousel__wrapper swiper-wrapper">
										<?foreach($firstTopic['ITEMS'] as $i => $arItem):?>
											<div class="tutorial-videos-carousel__slide swiper-slide">
												<div class="detailed-video detailed-video_size_l">
													<a class="detailed-video__illustration" data-youtube href="<?=$arItem['PROPERTIES']['LINK']['VALUE']?>">
														<img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt role="presentation" class="detailed-video__image">
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
								</div>
							</div>
						</div>
					</div>
				</div>
				<?
					$events = CIBlockElement::GetList(
						array(
							"SORT"=>"ASC",
							"PROPERTY_TYPE" => "Y",
							"PROPERTY_COST" => "Y",
							"PROPERTY_VALUE" => "Y",
							"PROPERTY_LOCATION" => "Y",
							"PROPERTY_START_DATE" => "Y",
							"PROPERTY_EVENT_TIME" => "Y",
							"PROPERTY_PRODUCT_LINE" => "Y",
							"PROPERTY_STATUS" => "Y",
						),
						array(
							"IBLOCK_ID" => "6",
							"ACTIVE_DATE" => "Y",
							"ACTIVE" => "Y",
						)
					);

					$eIndex = 0;
					$eventArray = [];
					?><pre style="display: none"><?print_r($type);?></pre><?
					while($event = $events->getNext()) {
						?><pre style="display: none"><?print_r($event['PROPERTY_PRODUCT_LINE_VALUE']);?></pre><?
						if (!empty($event['PROPERTY_PRODUCT_LINE_VALUE'])) {
							$eType = CIBlockSection::GetList(
								array(
									"SORT"=>"ASC",
								),
								array(
									"IBLOCK_ID" => "2",
									"ID" => $event['PROPERTY_PRODUCT_LINE_VALUE']
								)
							)->getNext();
							if (!empty($eType['IBLOCK_SECTION_ID'])) {
								$eType = CIBlockSection::GetList(
									array(
										"SORT"=>"ASC",
									),
									array(
										"IBLOCK_ID" => "2",
										"ID" => $eType['IBLOCK_SECTION_ID']
									)
								)->getNext();
							}
							?><pre style="display: none"><?print_r($event);?></pre><?
							?><pre style="display: none"><?print_r($eType);?></pre><?
							if (strtolower($eType['NAME']) === strtolower($type['NAME']) || strstr(strtolower($type['NAME']), strtolower($eType['NAME'])) || strstr(strtolower($eType['NAME']), strtolower($type['NAME']))) {
								$event['TYPE'] = $eType;
								$event['LOCATION'] = CIBlockSection::GetList(
									array(
										"SORT"=>"ASC",
									),
									array(
										"IBLOCK_ID" => "11",
										"ID" => $event['PROPERTY_LOCATION_VALUE']
									)
								)->getNext();
								$eventArray[] = $event;
								$eIndex++;
							}
						}
					}
				?>
				<?if(count($eventArray) > 0):?>
					<div style="margin-bottom: 35px; width: 100%;">
						<div class="tutorial-videos-section__header">
							<h2 class="tutorial-videos-section__title">
								Ближайшие семинары по окрашиванию
							</h2>
						</div>
						<div class="tutorial-videos-section__content">
							<div class="events-wrapper">
								<? if (count($eventArray) == 1):?>
									<div class="event-carousel">
										<div class="one-event">
								<?else:?>
									<div class="event-carousel">
										<div class="swiper js-event-carousel">
											<div class="swiper-wrapper">
								<?endif;?>

								<? foreach ($eventArray as $item): ?>
									<? if (count($eventArray) > 1):?>
										<div class="swiper-slide">
									<?endif;?>

									<!-- .event-item -->
									<?
										$pic = CFile::ResizeImageGet($item['PREVIEW_PICTURE'], array('width' => 500, 'height' => 288), BX_RESIZE_IMAGE_PROPORTIONAL, true);
										$locationID = $item['PROPERTY_LOCATION_VALUE'];
									?>
									<div class="event-item<?= (isset($item['PROPERTY_STATUS_VALUE'])) ? ' _active' : '' ?>">
										<a href="<?= $item['DETAIL_PAGE_URL'] ?>" class="event-item__image">
											<div class="event-item__image-container">
												<img src="<?= $pic['src'] ?>" alt role="presentation" class="event-item__img">
											</div>
										</a>
										<div class="event-item__description">
											<h3><?= $item['NAME'] ?></h3>
											<div class="event-item__description-date">
												<p><?= FormatDate('j F Y года', strtotime($item['ACTIVE_FROM'])) ?>
													, <?= $item['LOCATION']['NAME'] ?></p>
												<p><?= $item['PROPERTY_EVENT_TIME_VALUE'] ?></p>
											</div>
											<div class="event-item__description-text">
												<?= $item['PREVIEW_TEXT'] ?>
											</div>
											<div class="bottom-button-wrapper">
												<a href="<?= $item['DETAIL_PAGE_URL'] ?>"
												class="button _small mobile-slider-button">Подробнее</a>
											</div>
										</div>
									</div>
									<!-- .event-item end -->

									<? if (count($eventArray) > 1):?>
										</div>
										<!-- .swiper-slide end -->
									<?endif;?>
								<? endforeach; ?>

								<? if (count($eventArray) == 1):?>
										</div>
										<!-- .one-event end -->
									</div>
									<!-- .mobile-carousel end -->
								<?else:?>
											</div>
											<!-- .swiper-wrapper end -->
										</div>
										<!-- .swiper end -->
									</div>
									<!-- .mobile-carousel end -->
								<?endif;?>
							</div>
						</div>
					</div>
				<?endif;?>
				<?if(!empty($type['TOPICS'])):?>
					<?foreach($type['TOPICS'] as $tK => $topic):?>
						<?if($topic['NAME'] === $firstTopic['NAME']) {
							continue;
						}?>

						<div class="tutorial-videos-section">
							<div class="tutorial-videos-section__header">
								<h2 class="tutorial-videos-section__title">
									<?=$topic['NAME']?>
								</h2>
								<div class="tutorial-videos-section__arrows">
									<div class="carousel-navigation">
										<button id="<?=$k.'_'.$tK.'_prev'?>" class="carousel-navigation__arrow carousel-navigation__arrow_type_prev set-carousel__prev" type="button">Предыдущий слайд</button>
										<button id="<?=$k.'_'.$tK.'_next'?>" class="carousel-navigation__arrow carousel-navigation__arrow_type_next set-carousel__next" type="button">Следйющий слайд</button>
									</div>
								</div>
							</div>
							<div class="tutorial-videos-section__content">
								<div class="tutorial-videos-section__carousel">
									<div class="tutorial-videos-carousel">
										<div class="tutorial-videos-carousel__container swiper-container js-tutorial-videos-carousel " data-arrows="<?=$k.'_'.$tK?>_">
											<div class="tutorial-videos-carousel__wrapper swiper-wrapper">
												<?foreach($topic['ITEMS'] as $i => $arItem):?>
													<div class="tutorial-videos-carousel__slide swiper-slide">
														<div class="detailed-video detailed-video_size_l">
															<a class="detailed-video__illustration" data-youtube href="<?=$arItem['PROPERTIES']['LINK']['VALUE']?>">
																<img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt role="presentation" class="detailed-video__image">
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
										</div>
									</div>
								</div>
							</div>
						</div>
					<?endforeach;?>
				<?endif;?>
			</div>
		<?endforeach;?>
	</div>
</div>