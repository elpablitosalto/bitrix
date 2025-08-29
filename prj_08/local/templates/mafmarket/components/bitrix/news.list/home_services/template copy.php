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
	<section class="dp-section dp-catalog-section" id="project-goods">
		<div class="container">
			<div class="dp-section__header">
				<h3 class="dp-section__title">Изделия в проекте:</h3>
			</div>
			<div class="dp-section__body">
				<div class="dp-item-list">
					<div class="row">
						<?
						foreach ($arResult["ITEMS"] as $arItem) {
							$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
							$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
						?>
							<div class="col-sm-12 col-md-8" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
								<a class="dp-catalog-item dp-catalog-item_toggle" href="<?= $arItem['DETAIL_PAGE_URL']; ?>" id="">
									<div class="dp-catalog-item__image">
										<picture>
											<img src="<?= $arItem['PICTURE_1']['SRC']; ?>" alt="<?= $arItem['PICTURE_1']['ALT']; ?>" title="<?= $arItem['PICTURE_1']['TITLE']; ?>" />
										</picture>
									</div>
									<div class="dp-catalog-item__image_alt">
										<picture class="dp-catalog-item__image-2">
											<img src="<?= $arItem['PICTURE_2']['SRC']; ?>" alt="<?= $arItem['PICTURE_2']['ALT']; ?>" title="<?= $arItem['PICTURE_2']['TITLE']; ?>" />
										</picture>
									</div>
									<h4 class="dp-catalog-item__title"><?= $arItem['NAME']; ?></h4>
								</a>
							</div>
						<?
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</section>
<? } ?>