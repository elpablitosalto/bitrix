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
	<section class="dp-section dp-actual-section">
		<div class="container">
			<? if ($arParams['SHOW_H2'] != 'N') { ?>
				<div class="dp-section__header">
					<h2 class="dp-section__title"><?= $arParams['HEADER']; ?></h2>
				</div>
			<? } ?>
			<div class="dp-section__body">
				<div class="dp-actual-slider">
					<div class="dp-actual-slider__list">
						<? foreach ($arResult["ITEMS"] as $arItem) { ?>
							<?
							$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
							$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
							?>
							<div class="dp-actual-slider__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
								<div class="dp-actual-item">
									<a class="dp-actual-item__link" href="<?= $arItem['DISPLAY_PROPERTIES']['URL']['VALUE'] ?>">
										<? if (!empty($arItem['PICTURE'])) { ?>
											<div class="dp-actual-item__img">
												<img src="<?= $arItem['PICTURE']['SRC']; ?>" alt="<?= $arItem['PICTURE']['ALT']; ?>" title="<?= $arItem['PICTURE']['TITLE']; ?>" />
											</div>
										<? } ?>
										<div class="dp-actual-item__caption">
											<div class="dp-actual-item__tags">
												<? if (!empty($arItem['DISPLAY_PROPERTIES']['TYPE']['DISPLAY_VALUE'])) { ?>
													<span class="dp-actual-item__tag">
														<?= $arItem['DISPLAY_PROPERTIES']['TYPE']['DISPLAY_VALUE']; ?>
													</span>
												<? } ?>
												<? foreach ($arItem['DISPLAY_PROPERTIES']['THEME']['DISPLAY_VALUE'] as $key => $val) { ?>
													<span class="dp-actual-item__tag"><?= $val; ?></span>
												<? } ?>
											</div>
											<h3 class="dp-actual-item__title"><?= $arItem['NAME']; ?></h3>
											<time class="dp-actual-item__date" datetime="<? echo FormatDate("c", MakeTimeStamp($arItem['DISPLAY_PROPERTIES']['DATE']['VALUE'])); ?>">
												<? echo FormatDate("j F Y", MakeTimeStamp($arItem['DISPLAY_PROPERTIES']['DATE']['VALUE'])); ?>
											</time>
											<div class="dp-actual-item__actions">
												<button class="dp-btn dp-btn_m dp-btn_orange dp-actual-item__btn" type="button">
													Подробнее
												</button>
											</div>
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