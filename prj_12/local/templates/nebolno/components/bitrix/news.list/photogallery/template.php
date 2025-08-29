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

if (count($arResult["ITEMS"]) == 0)
	return false;
?>
<section class="nb-clinic-gallery-section">
	<div class="nb-clinic-gallery-section__header">
		<h2 class="nb-clinic-gallery-section__title">Фотогалерея клиники «Белый кролик»</h2>
	</div>
	<div class="nb-clinic-gallery-section__body">
		<div class="nb-clinic-gallery">
			<div class="nb-clinic-gallery-slider">
				<div class="nb-clinic-gallery-slider__container">
					<div class="nb-clinic-gallery-slider__list">
						<?
						foreach ($arResult["ITEMS"] as $key => $arItem) {
							$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
							$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
						?>
							<div class="nb-clinic-gallery-slider__col">
								<div class="nb-clinic-gallery-slider__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>" itemscope itemtype="http://schema.org/ImageObject">
									<meta itemprop="width" content="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>">
									<meta itemprop="height" content="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>">
									<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"]; ?>" alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"]; ?>" itemprop="contentUrl">
								</div>
							</div>
						<?
						}
						?>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="nb-clinic-gallery-desc">
					<div class="nb-clinic-gallery-desc__container">
						<div class="nb-clinic-gallery-desc__list">
							<?
							foreach ($arResult["ITEMS"] as $key => $arItem) {
							?>
								<div class="nb-clinic-gallery-desc__item">
									<p><?= $arItem["NAME"]; ?></p>
								</div>
							<?
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>