<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
<?if (is_array($arResult["ITEMS"]) && count($arResult["ITEMS"]) > 0):?>
	<section class="advantages">
		<div class="title-section">
			<h2><?=$arResult['NAME']?></h2>
		</div>
		<ul class="advantages__list">
			<?foreach($arResult["ITEMS"] as $arItem):?>
				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>
				<li class="advantages__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
					<?if (isset($arItem["PREVIEW_PICTURE"]["SRC"])):?>
						<div class="advantages__icon">
							<img loading="lazy" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>">
						</div>
					<?endif;?>
					<div class="advantages__description">
						<p class="advantages__title"><?=$arItem["NAME"]?></p>
						<?if (mb_strlen($arItem["PREVIEW_TEXT"]) > 0):?>
							<div class="advantages__notation"><?=$arItem["PREVIEW_TEXT"]?></div>
						<?endif;?>
					</div>
				</li>
			<?endforeach;?>
		</ul>
	</section>
<?endif;?>