<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
<? if (!empty($arResult["ITEMS"])) { ?>
	<input type="hidden" id="js_buy_link" data-go-link="N" value="" />
	<section class="dp-section dp-dashboard-webinars">
		<div class="container">
			<? if ($arParams['SHOW_H2'] != 'N') { ?>
				<div class="dp-section__header">
					<h2 class="dp-section__title"><?= $arParams['HEADER']; ?></h2>
				</div>
			<? } ?>
			<div class="dp-section__body">
				<?
				/*
				echo 'SHOW_COUNT = '.$arResult['SHOW_COUNT'].'<br />';
				echo 'PAID_PRESENT = '.$arResult['PAID_PRESENT'].'<br />';
				echo 'count = '.count($arResult["ITEMS"]).'<br />';
				*/
				/* Если выводим 3 вебинара */
				if ($arResult['SHOW_COUNT'] == 3 && $arResult['PAID_PRESENT'] == 'Y') {
				?>
					<div class="dp-item-block dp-webinars dp-webinars-paid">
						<div class="dp-item-list">
							<?
							$i = 0;
							?>
							<? foreach ($arResult["ITEMS"] as $arItem) { ?>
								<?
								$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
								$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
								?>
								<div class="dp-item-col" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
									<div class="dp-webinar">
										<? if ($arParams['USER_AUTHORIZED'] == 'Y') { ?>
											<button class="dp-bookmark-btn js_article_bookmark js_article_bookmark_<?= $arItem['ID']; ?>" data-id="<?= $arItem['ID']; ?>" data-iblock-id="<?= $arParams['IBLOCK_ID']; ?>" type="button">
												<svg class="icon icon-bookmark ">
													<use xlink:href="#bookmark"></use>
												</svg>
											</button>
										<? } ?>

										<div class="dp-webinar__link js_articles_list" data-id="<?= $arItem['ID']; ?>" <?/*?>href="<?= $arItem['DETAIL_PAGE_URL']; ?>"<?*/ ?> data-iblock-id="<?= $arParams['IBLOCK_ID']; ?>">
											<? if (!empty($arItem['PICTURE'])) { ?>
												<div class="dp-webinar__img">
													<img src="<?= $arItem['PICTURE']['SRC']; ?>" alt="<?= $arItem['PICTURE']['ALT']; ?>" title="<?= $arItem['PICTURE']['TITLE']; ?>" />
												</div>
											<? } ?>
											<div class="dp-webinar__caption">
												<div class="dp-webinar__tags">
													<? foreach ($arItem['DISPLAY_PROPERTIES']['THEME']['DISPLAY_VALUE'] as $key => $val) { ?>
														<span class="dp-webinar__tag dp-webinar__category"><?= $val; ?></span>
													<? } ?>
													<span class="dp-webinar__tag dp-webinar__viewed d-none js_article_readed_<?= $arItem['ID'] ?>">Просмотрено</span>
												</div>
												<h3 class="dp-webinar__title"><?= $arItem['NAME']; ?></h3>
												<? if (!empty($arItem["ACTIVE_FROM"])) { ?>
													<time class="dp-webinar__date" datetime="<? echo FormatDate("Y-m-d", MakeTimeStamp($arItem["ACTIVE_FROM"])); ?>">
														<? echo FormatDate("j F Y", MakeTimeStamp($arItem["ACTIVE_FROM"])); ?>
													</time>
												<? } ?>
												<?
												//vardump($arItem['DISPLAY_PROPERTIES']);
												?>
												<? if ($arItem['DISPLAY_PROPERTIES']['SHOW_PRICE']['VALUE'] == 'Y') { ?>
													<? if ($arItem['DISPLAY_PROPERTIES']['PRICE']['DISPLAY_VALUE'] > 0) { ?>
														<p class="dp-webinar__price">
															<?= Indexis::getPriceFormatted($arItem['DISPLAY_PROPERTIES']['PRICE']['DISPLAY_VALUE']); ?>
														</p>
													<? } ?>
												<? } ?>
												<?
												// Описание для анонса вебинара, лектор -->
												?>
												<div class="dp-webinar__desc">
													<?= $arItem['PREVIEW_TEXT']; ?>
												</div>
												<div class="dp-webinar__speaker">
													<p class="dp-webinar__speaker-title"></p>
													<?= $arItem['SPEAKER']['NAME']; ?>
													<br />
													<?= $arItem['SPEAKER']['RANK']; ?>
												</div>
												<?
												// <-- Описание для анонса вебинара, лектор
												?>

												<div class="dp-webinar__actions">
													<? if ($arItem['BUTTON_TYPE'] == 'BUY') { ?>
														<a class="dp-btn dp-btn_orange dp-btn_m dp-webinar__buy js_buy_check_auth" target="_blank" data-link="<?= $arItem['DISPLAY_PROPERTIES']['BUY_LINK']['VALUE'] ?>" href="<?= $arItem['DISPLAY_PROPERTIES']['BUY_LINK']['VALUE'] ?>">
															Купить
														</a>
													<? } else { ?>
														<a class="dp-btn dp-btn_orange dp-btn_m" href="<?= $arItem['DETAIL_PAGE_URL']; ?>">Смотреть</a>
													<? } ?>
												</div>
											</div>
										</div>
									</div>
								</div>
								<?
								$i++;
								?>
							<? } ?>
						</div>
					</div>
				<?
				}

				/* Если выводим 4 вебинара */ else {
				?>
					<div class="dp-item-block dp-webinars">
						<div class="dp-item-list">
							<? foreach ($arResult["ITEMS"] as $arItem) { ?>
								<?
								$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
								$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
								?>
								<div class="dp-item-col" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
									<div class="dp-webinar">
										<? if ($arParams['USER_AUTHORIZED'] == 'Y') { ?>
											<button class="dp-bookmark-btn js_article_bookmark js_article_bookmark_<?= $arItem['ID']; ?>" data-id="<?= $arItem['ID']; ?>" data-iblock-id="<?= $arParams['IBLOCK_ID']; ?>" type="button">
												<svg class="icon icon-bookmark ">
													<use xlink:href="#bookmark"></use>
												</svg>
											</button>
										<? } ?>

										<div class="dp-webinar__link js_articles_list" data-id="<?= $arItem['ID']; ?>" <?/*?>href="<?= $arItem['DETAIL_PAGE_URL']; ?>"<?*/ ?> data-iblock-id="<?= $arParams['IBLOCK_ID']; ?>">
											<? if (!empty($arItem['PICTURE'])) { ?>
												<div class="dp-webinar__img">
													<img src="<?= $arItem['PICTURE']['SRC']; ?>" alt="<?= $arItem['PICTURE']['ALT']; ?>" title="<?= $arItem['PICTURE']['TITLE']; ?>" />
												</div>
											<? } ?>
											<div class="dp-webinar__caption">
												<div class="dp-webinar__tags">
													<? foreach ($arItem['DISPLAY_PROPERTIES']['THEME']['DISPLAY_VALUE'] as $key => $val) { ?>
														<span class="dp-webinar__tag dp-webinar__category"><?= $val; ?></span>
													<? } ?>
													<span class="dp-webinar__tag dp-webinar__viewed d-none js_article_readed_<?= $arItem['ID'] ?>">Просмотрено</span>
												</div>
												<h3 class="dp-webinar__title"><?= $arItem['NAME']; ?></h3>
												<? if (!empty($arItem["ACTIVE_FROM"])) { ?>
													<time class="dp-webinar__date" datetime="<? echo FormatDate("Y-m-d", MakeTimeStamp($arItem["ACTIVE_FROM"])); ?>">
														<? echo FormatDate("j F Y", MakeTimeStamp($arItem["ACTIVE_FROM"])); ?>
													</time>
												<? } ?>
												<?
												//vardump($arItem['DISPLAY_PROPERTIES']['SHOW_PRICE']);
												?>
												<? if ($arItem['DISPLAY_PROPERTIES']['SHOW_PRICE']['VALUE'] == 'Y') { ?>
													<? if ($arItem['BUTTON_TYPE'] == 'BUY') { ?>
														<? if ($arItem['DISPLAY_PROPERTIES']['PRICE']['DISPLAY_VALUE'] > 0) { ?>
															<p class="dp-webinar__price">
																<?= Indexis::getPriceFormatted($arItem['DISPLAY_PROPERTIES']['PRICE']['DISPLAY_VALUE']); ?>
															</p>
														<? } ?>
													<? } ?>
												<? } ?>
												<div class="dp-webinar__actions">
													<? if ($arItem['BUTTON_TYPE'] == 'BUY') { ?>
														<a class="dp-btn dp-btn_orange dp-btn_m dp-webinar__buy js_buy_check_auth" target="_blank" data-link="<?= $arItem['DISPLAY_PROPERTIES']['BUY_LINK']['VALUE'] ?>" href="<?= $arItem['DISPLAY_PROPERTIES']['BUY_LINK']['VALUE'] ?>">
															Купить
														</a>
													<? } else { ?>
														<a class="dp-btn dp-btn_orange dp-btn_m" href="<?= $arItem['DETAIL_PAGE_URL']; ?>">Смотреть</a>
													<? } ?>
												</div>
											</div>
										</div>
									</div>
								</div>
							<? } ?>
						</div>
					</div>
				<? } ?>

				<? if ($arParams["DISPLAY_BOTTOM_PAGER"]) : ?>
					<?= $arResult["NAV_STRING"] ?>
				<? endif; ?>
			</div>
			<? if ($arParams['SHOW_MORE_SHOW'] == 'Y') { ?>
				<div class="dp-section__footer">
					<a class="dp-btn dp-btn_orange dp-btn_m dp-section__link" href="/recommendations/webinars/">
						Показать больше
					</a>
				</div>
			<? } ?>
			<? if ($arParams['SHOW_ALL_BUTTON'] == 'Y') { ?>
				<div class="dp-section__footer">
					<a class="dp-btn dp-btn_orange dp-btn_m dp-section__link" href="/webinars/">
						Все вебинары
					</a>
				</div>
			<? } ?>
		</div>
	</section>
<? } else { ?>
	<? if ($arParams['SHOW_EMPTY_BLOCK'] == 'Y') { ?>
		<div class="dp-empty-results">
			<div class="note">
				<p>
					Материалы с выбранными параметрами фильтрации и поиска не найдены.<br>
					Попробуйте изменить условия поиска.
				</p>
			</div>
		</div>
	<? } ?>
<? } ?>