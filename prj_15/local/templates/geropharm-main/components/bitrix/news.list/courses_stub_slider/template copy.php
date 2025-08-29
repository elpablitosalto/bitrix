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
	<section class="dp-section dp-dashboard-courses">
		<div class="container">
			<? if ($arParams['SHOW_H2'] != 'N') { ?>
				<div class="dp-section__header">
					<h2 class="dp-section__title">Курсы</h2>
				</div>
			<? } ?>
			<div class="dp-section__body">
				<div class="dp-item-block  dp-slider dp-courses">
					<div class="dp-item-list">
						<? foreach ($arResult["ITEMS"] as $arItem) { ?>
							<?
							$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
							$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
							?>
							<div class="dp-item-col" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
								<div class="dp-course">
									<? if (!empty($arItem['PICTURE'])) { ?>
										<div class="dp-course__img">
											<a class="dp-course__img-link" href="#">
												<img src="<?= $arItem['PICTURE']['SRC']; ?>" alt="<?= $arItem['PICTURE']['ALT']; ?>" title="<?= $arItem['PICTURE']['TITLE']; ?>" />
											</a>
										</div>
									<? } ?>
									<div class="dp-course__caption">
										<div class="dp-course__tags">
											<? foreach ($arItem['DISPLAY_PROPERTIES']['THEME']['DISPLAY_VALUE'] as $key => $val) { ?>
												<span class="dp-course__tag dp-course__category"><?= $val; ?></span>
											<? } ?>
										</div>
										<a class="dp-course__title-link js_articles_list" data-id="<?= $arItem['ID']; ?>" href="<?= $arItem['DISPLAY_PROPERTIES']['BUY_LINK']['VALUE'] ?>" data-iblock-id="<?= $arParams['IBLOCK_ID']; ?>">
											<h3 class="dp-course__title"><?= $arItem['NAME']; ?></h3>
										</a>
										<div class="dp-course__meta">
											<? if (!empty($arItem['DISPLAY_PROPERTIES']['COUNT_MODULES']['VALUE'])) { ?>
												<span class="dp-course__modules">
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
												<span class="dp-course__date">
													<? echo $dateStart; ?><? echo $dateEnd; ?>
												</span>
											<?
											}
											?>
										</div>
										<div class="dp-course__desc">
											<?= $arItem['PREVIEW_TEXT']; ?>
										</div>
										<div class="dp-course__actions">
											<? if (!empty($arItem['DISPLAY_PROPERTIES']['EXTERNAL_URL']['VALUE'])) { ?>
												<a class="dp-btn dp-btn_m dp-course__btn-free-lesson" href="<?= $arItem['DISPLAY_PROPERTIES']['EXTERNAL_URL']['VALUE']; ?>">Пройти пробный урок бесплатно</a>
											<? } ?>
											<? if (!empty($arItem['DISPLAY_PROPERTIES']['BUY_LINK']['VALUE'])) { ?>
												<a class="dp-btn dp-btn_m dp-course__btn-detail" href="<?= $arItem['DISPLAY_PROPERTIES']['BUY_LINK']['VALUE'] ?>">Подробнее</a>
											<? } ?>
										</div>
									</div>
								</div>
							</div>
						<? } ?>
					</div>
				</div>
			</div>
		</div>
	</section>
<? } ?>