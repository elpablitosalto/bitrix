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
	<section class="dp-section dp-dashboard-articles">
		<div class="container">
			<? if ($arParams['SHOW_H2'] != 'N') { ?>
				<div class="dp-section__header">
					<h2 class="dp-section__title"><?= $arParams['HEADER']; ?></h2>
				</div>
			<? } ?>
			<div class="dp-section__body">
				<div class="dp-item-block  dp-slider dp-articles">
					<div class="dp-item-list">
						<? foreach ($arResult["ITEMS"] as $arItem) { ?>
							<?
							$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
							$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
							?>
							<div class="dp-item-col" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
								<div class="dp-article">
									<? if ($arParams['USER_AUTHORIZED'] == 'Y') { ?>
										<?
										// dp-bookmark-btn_active	
										?>
										<button class="dp-bookmark-btn js_article_bookmark js_article_bookmark_<?= $arItem['ID']; ?>" data-id="<?= $arItem['ID']; ?>" data-iblock-id="<?= $arParams['IBLOCK_ID']; ?>" type="button">
											<svg class="icon icon-bookmark ">
												<use xlink:href="#bookmark"></use>
											</svg>
										</button>
									<? } ?>
									<a class="dp-article__link js_articles_list" data-id="<?= $arItem['ID']; ?>" href="<?= $arItem['DETAIL_PAGE_URL']; ?>" data-iblock-id="<?= $arParams['IBLOCK_ID']; ?>">
										<? if (!empty($arItem['PICTURE'])) { ?>
											<div class="dp-article__img">
												<img src="<?= $arItem['PICTURE']['SRC']; ?>" alt="<?= $arItem['PICTURE']['ALT']; ?>" title="<?= $arItem['PICTURE']['TITLE']; ?>" />
											</div>
										<? } ?>
										<div class="dp-article__caption">
											<div class="dp-article__tags">
												<? foreach ($arItem['DISPLAY_PROPERTIES']['THEME']['DISPLAY_VALUE'] as $key => $val) { ?>
													<span class="dp-article__tag dp-article__category"><?= $val; ?></span>
												<? } ?>
												<span class="dp-article__tag dp-article__viewed d-none js_article_readed_<?= $arItem['ID'] ?>">Просмотрено</span>
												<span class="dp-article__tag dp-article__read d-none js_article_read_<?= $arItem['ID'] ?>">Читать</span>
											</div>
											<h3 class="dp-article__title"><?= $arItem['NAME']; ?></h3>
											<div class="dp-article__desc">
												<p><?= $arItem['PREVIEW_TEXT']; ?></p>
												<? if (!empty($arItem['PICTURE'])) { ?>
													<div class="dp-article__img">
														<img src="<?= $arItem['PICTURE']['SRC']; ?>" alt="<?= $arItem['PICTURE']['ALT']; ?>" title="<?= $arItem['PICTURE']['TITLE']; ?>" />
													</div>
												<? } ?>
											</div>
										</div>
									</a>
								</div>
							</div>
						<? } ?>
					</div>
				</div>

				<? if ($arParams["DISPLAY_BOTTOM_PAGER"]) : ?>
					<?= $arResult["NAV_STRING"] ?>
				<? endif; ?>
			</div>
			<? if ($arParams['SHOW_MORE_SHOW'] == 'Y') { ?>
				<div class="dp-section__footer">
					<a class="dp-btn dp-btn_orange dp-btn_m dp-section__link" href="/recommendations/blog/">
						Показать больше
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