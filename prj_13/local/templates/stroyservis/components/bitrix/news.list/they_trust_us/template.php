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
	<section class="clients">
		<div class="title-section">
			<h2><?=$arResult['NAME']?></h2>
		</div>
		<ul class="clients__list">
			<?foreach($arResult["ITEMS"] as $arItem):?>
				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>
				<li class="clients__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>" itemscope itemtype="https://schema.org/ImageObject">
					<?if (isset($arItem["PREVIEW_PICTURE"]["SRC"])):?>
						<img loading="lazy" itemprop="image" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>">
					<?endif;?>
				</li>
			<?endforeach;?>
		</ul>
	</section>
<?endif;?>