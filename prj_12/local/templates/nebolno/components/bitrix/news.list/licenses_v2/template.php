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
<div class="nb-licenses">
	<div class="nb-licenses__container">
		<div class="nb-licenses__list">
			<?php
			foreach ($arResult["ITEMS"] as $key => $val) {
				$date = $val["PROPERTIES"]["DATE"]["VALUE"];
				$city = $val["PROPERTIES"]["CITY"]["VALUE"];
				$pdf = CFile::GetFileArray($val["PROPERTIES"]["PDF"]["VALUE"]);
				?>
				<?
				$this->AddEditAction($val['ID'], $val['EDIT_LINK'], CIBlock::GetArrayByID($val["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($val['ID'], $val['DELETE_LINK'], CIBlock::GetArrayByID($val["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>
				<div class="nb-licenses__col" id="<?=$this->GetEditAreaId($val['ID']);?>">
					<div class="nb-license">
						<?if($val["PREVIEW_PICTURE"]["SRC"]):?>
						<a href="<?=((is_array($pdf) && $pdf["SRC"]) ? $pdf["SRC"] : $val["PREVIEW_PICTURE"]["SRC"])?>" class="nb-license__link"<?if(is_array($pdf) && $pdf["SRC"]):?> target="_blank"<?else:?> data-fancybox="licenses"<?endif;?>>
						<?endif;?>
							<div class="nb-license__title"><?= $val["NAME"]; ?></div>
							<div class="nb-license__desc">
								<p>Описание сертификата: «<?= $val["PREVIEW_TEXT"]; ?>» г. <?= $city; ?>.</p>
							</div>
						<?if($val["PREVIEW_PICTURE"]["SRC"]):?>
						</a>
						<?endif;?>
					</div>
				</div>
				<?
			}
			?>
		</div>
	</div>
</div>
<?if ($arParams['SYNC_CONTENT_CLINIC'] == 'Y'):?>
	<script>
		$(function() {
			var $element = $('.nb-licenses__container:not(.swiper-initialized)');
			if ($element.length > 0) {
				licensesSlider($element.closest('.nb-licenses'));
			}
		});
	</script>
<?endif;?>