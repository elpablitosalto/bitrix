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
	<div class="dp-courses">
		<div class="dp-slider dp-courses-slider">
			<div class="dp-slider__list">
				<? foreach ($arResult["ITEMS"] as $arItem) { ?>
					<?
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					?>
					<div class="dp-slider__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
						<div class="dp-courses-item">
							<div class="row flex-lg-row-reverse">
								<div class="col-lg-6">
									<? if (!empty($arItem['PICTURE'])) { ?>
										<div class="dp-courses-item__img">
											<a class="dp-courses-item__img-link" href="<?= $arItem['DISPLAY_PROPERTIES']['EXTERNAL_URL']['VALUE'] ?>">
												<img loading="lazy" src="<?= $arItem['PICTURE']['SRC']; ?>" alt="<?= $arItem['PICTURE']['ALT']; ?>" title="<?= $arItem['PICTURE']['TITLE']; ?>" />
												<div class="swiper-lazy-preloader"></div>
											</a>
										</div>
									<? } ?>
								</div>
								<div class="col-lg-6">
									<div class="dp-courses-item__caption">
										<div class="dp-courses-item__tags">
											<span class="dp-courses-item__tag dp-courses-item__category">Курс</span>
											<? foreach ($arItem['DISPLAY_PROPERTIES']['THEME']['DISPLAY_VALUE'] as $key => $val) { ?>
												<span class="dp-courses-item__tag dp-courses-item__category"><?= $val; ?></span>
											<? } ?>
										</div>
										<a class="dp-courses-item__title-link" href="<?= $arItem['DISPLAY_PROPERTIES']['EXTERNAL_URL']['VALUE'] ?>">
											<h3 class="dp-courses-item__title"><?= $arItem['NAME']; ?></h3>
										</a>
										<div class="dp-courses-item__meta">
											<? if (!empty($arItem['DISPLAY_PROPERTIES']['COUNT_MODULES']['VALUE'])) { ?>
												<span class="dp-courses-item__modules">
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
											<?
											}
											?>
											<?if((isset($arItem["DISPLAY_PROPERTIES"]["DATE_START"]["VALUE"]) && mb_strlen($arItem["DISPLAY_PROPERTIES"]["DATE_START"]["VALUE"]))
												|| (isset($arItem["DISPLAY_PROPERTIES"]["DATE_END"]["VALUE"]) && mb_strlen($arItem["DISPLAY_PROPERTIES"]["DATE_END"]["VALUE"]))
											){?>
												<span class="dp-courses-item__date">
													<?if(isset($arItem["DISPLAY_PROPERTIES"]["DATE_START"]["VALUE"]) && mb_strlen($arItem["DISPLAY_PROPERTIES"]["DATE_START"]["VALUE"])){?>
														<?=$dateStart ?>
													<?}?>
													<?if((isset($arItem["DISPLAY_PROPERTIES"]["DATE_START"]["VALUE"]) && mb_strlen($arItem["DISPLAY_PROPERTIES"]["DATE_START"]["VALUE"]))
														&& (isset($arItem["DISPLAY_PROPERTIES"]["DATE_END"]["VALUE"]) && mb_strlen($arItem["DISPLAY_PROPERTIES"]["DATE_END"]["VALUE"]))
													){?>
														—
													<?}?>
													<?if(isset($arItem["DISPLAY_PROPERTIES"]["DATE_END"]["VALUE"]) && mb_strlen($arItem["DISPLAY_PROPERTIES"]["DATE_END"]["VALUE"])){?>
														<?=$dateEnd ?>
													<?}?>
													</span>
											<?}?>
										</div>
										<div class="dp-courses-item__desc">
											<?= $arItem['PREVIEW_TEXT']; ?>
										</div>
										<div class="dp-courses-item__actions">
											<a class="dp-btn dp-btn_m dp-courses-item__btn-detail" href="<?= $arItem['DISPLAY_PROPERTIES']['EXTERNAL_URL']['VALUE'] ?>">Подробнее</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				<? } ?>
			</div>
		</div>
	</div>
<? } ?>