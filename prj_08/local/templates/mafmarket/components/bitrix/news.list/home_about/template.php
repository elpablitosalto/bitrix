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

//vardump($arResult["ITEMS"]);

if (!empty($arResult["ITEMS"])) {
?>

	<?
	foreach ($arResult["ITEMS"] as $arItem) {
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
		<section class="dp-section dp-about-slider" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
			<div class="container">
				<div class="row">
					<div class="col-lg-8">
						<div class="dp-section__header dp-section__header_aside">
							<div class="dp-section__subtitle"><?= $arItem['DISPLAY_PROPERTIES']['HOME_SECTION_HEADER']['DISPLAY_VALUE']; ?></div>
							<h2 class="dp-section__title"><?= $arItem['DISPLAY_PROPERTIES']['HOME_H_1']['DISPLAY_VALUE']; ?> <span class="color_blue"><?= $arItem['DISPLAY_PROPERTIES']['HOME_H_2']['DISPLAY_VALUE']; ?></span></h2>
							<div class="dp-section__desc">
								<?= $arItem['DISPLAY_PROPERTIES']['HOME_DESCR']['DISPLAY_VALUE']; ?>
							</div>
							<a class="dp-btn dp-section__link" href="<?= $arItem['DISPLAY_PROPERTIES']['HOME_LINK']['VALUE']; ?>">
								<span><?= $arItem['DISPLAY_PROPERTIES']['HOME_LINK_TEXT']['DISPLAY_VALUE']; ?></span>
								<svg class="icon icon-drop-right ">
									<use xlink:href="#drop-right"></use>
								</svg>
							</a>
						</div>
					</div>
					<? if (!empty($arItem['PICTURES'])) { ?>
						<div class="col-lg-16">
							<div class="dp-section__body">
								<div class="dp-item-list">
									<? foreach ($arItem['PICTURES'] as $key => $val) { ?>
										<div class="dp-about-item">
											<img class="dp-about-item__image" src="<?= $val['SRC']; ?>" alt="<?= $val['ALT']; ?>" title="<?= $val['TITLE']; ?>" />
										</div>

									<? } ?>
								</div>
								<div class="dp-slider-arrows"></div>
							</div>
						</div>
					<? } ?>
				</div>
			</div>
		</section>
	<? } ?>
<? } ?>