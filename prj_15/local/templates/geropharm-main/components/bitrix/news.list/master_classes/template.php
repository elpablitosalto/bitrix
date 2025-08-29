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
	<section class="dp-section dp-dashboard-masterclasses">
		<div class="container">
			<? if ($arParams['SHOW_H2'] != 'N') { ?>
				<div class="dp-section__header">
					<h2 class="dp-section__title">Мастер-классы</h2>
				</div>
			<? } ?>
			<div class="dp-section__body">
				<div class="dp-item-block  dp-slider dp-masterclasses">
					<div class="dp-item-list">
						<? foreach ($arResult["ITEMS"] as $arItem) { ?>
							<?
							$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
							$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
							?>
							<div class="dp-item-col" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
								<div class="dp-masterclass">
									<? if ($arParams['USER_AUTHORIZED'] == 'Y') { ?>
										<button class="dp-bookmark-btn js_article_bookmark js_article_bookmark_<?= $arItem['ID']; ?>" data-id="<?= $arItem['ID']; ?>" data-iblock-id="<?= $arParams['IBLOCK_ID']; ?>" type="button">
											<svg class="icon icon-bookmark ">
												<use xlink:href="#bookmark"></use>
											</svg>
										</button>
									<? } ?>

									<a target="_blank" class="dp-masterclass__link js_articles_list" data-id="<?= $arItem['ID']; ?>" href="<?= $arItem['DISPLAY_PROPERTIES']['BUY_LINK']['VALUE'] ?>" data-iblock-id="<?= $arParams['IBLOCK_ID']; ?>">
										<? if (!empty($arItem['PICTURE'])) { ?>
											<div class="dp-masterclass__img">
												<img src="<?= $arItem['PICTURE']['SRC']; ?>" alt="<?= $arItem['PICTURE']['ALT']; ?>" title="<?= $arItem['PICTURE']['TITLE']; ?>" />
											</div>
										<? } ?>
										<div class="dp-masterclass__caption">
											<h3 class="dp-masterclass__title"><?= $arItem['NAME']; ?></h3>
											<div class="dp-masterclass__meta">
												<? if (!empty($arItem['DISPLAY_PROPERTIES']['COUNT_MODULES']['VALUE'])) { ?>
													<span class="dp-masterclass__modules">
														<?= Indexis::num2word($arItem['DISPLAY_PROPERTIES']['COUNT_MODULES']['VALUE'], ['модуль', 'модуля', 'модулей']); ?>
													</span>
												<? } ?>
												<?
												if (!empty($arItem['DISPLAY_PROPERTIES']['DATE_START']['VALUE']) /*|| !empty( $arItem['DISPLAY_PROPERTIES']['DATE_END']['VALUE'] )*/) {
												?>
													<?
													$dateStart = FormatDate("j F", MakeTimeStamp($arItem['DISPLAY_PROPERTIES']['DATE_START']['VALUE']));
													$dateEnd = '';
													if (!empty($arItem['DISPLAY_PROPERTIES']['DATE_END']['VALUE'])) {
														$dateEnd = ' — ' . FormatDate("j F", MakeTimeStamp($arItem['DISPLAY_PROPERTIES']['DATE_END']['VALUE']));
													}
													?>
													<span class="dp-masterclass__date">
														<? echo $dateStart; ?><? echo $dateEnd; ?>
													</span>
												<?
												}
												?>
											</div>
											<div class="dp-masterclass__desc">
												<?= $arItem['PREVIEW_TEXT']; ?>
											</div>
											<? if (!empty($arItem['DISPLAY_PROPERTIES']['BUY_LINK']['VALUE'])) { ?>
												<div class="dp-masterclass__actions">
													<button class="dp-btn dp-btn_orange dp-btn_m dp-masterclass__btn" type="button" <?/*?>onclick="document.location.href='<?= $arItem['DISPLAY_PROPERTIES']['BUY_LINK']['VALUE'] ?>'"<?*/?>>
														Перейти к мастер-классу
													</button>
												</div>
											<? } ?>
										</div>
									</a>
								</div>
							</div>
						<? } ?>
					</div>
				</div>
			</div>
		</div>
	</section>
<? } ?>