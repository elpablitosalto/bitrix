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

<?
foreach ($arResult["ITEMS"] as $key => $item):
	$this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<section class="nb-clinic-gallery-section nb-clinic-gallery-section_light" id="<?=$arParams['BLOCK_AREA_ID'] ?>">
		<div class="nb-clinic-gallery-section__header">
			<h2 class="nb-clinic-gallery-section__title"><?=$arParams['CUSTOM_TITLE']?></h2>
		</div>
		<div class="nb-clinic-gallery-section__body" id="<?=$this->GetEditAreaId($item['ID']);?>">
			<div class="nb-clinic-gallery">
				<div class="nb-clinic-gallery-slider">
					<div class="nb-clinic-gallery-slider__container">
						<div class="nb-clinic-gallery-slider__list">
							<? foreach ($item['PROPERTIES']['K_47_SLIDES']['VALUE'] as $arItem) : ?>
								<?
								$arItemValues = $arItem['SUB_VALUES'];
								?>
								<div class="nb-clinic-gallery-slider__col">
									<div class="nb-clinic-gallery-slider__item">
										<img src="<?= CFile::GetPath($arItemValues['K_47_PHOTO']['VALUE']) ?>" alt="">
									</div>
								</div>
							<? endforeach; ?>
						</div>
					</div>
				</div>
				<div class="container">
					<div class="nb-clinic-gallery-desc">
						<div class="nb-clinic-gallery-desc__container">
							<div class="nb-clinic-gallery-desc__list">
								<? foreach ($item['PROPERTIES']['K_47_SLIDES']['VALUE'] as $arItem) : ?>
									<?
									$arItemValues = $arItem['SUB_VALUES'];
									?>
									<div class="nb-clinic-gallery-desc__item">
										<p><?= $arItemValues['K_47_DESCRIPTION']['VALUE'] ?></p>
									</div>
								<? endforeach; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?endforeach;?>

<?if ($arParams['SYNC_CONTENT_CLINIC'] == 'Y'):?>
	<script>
		$(function() {
			var $clinicGallery = $('#<?=$arParams['BLOCK_AREA_ID']?> .nb-clinic-gallery');
			if ($clinicGallery.length > 0) {
				clinicSlider($clinicGallery);
			}
		});
	</script>
<?endif;?>