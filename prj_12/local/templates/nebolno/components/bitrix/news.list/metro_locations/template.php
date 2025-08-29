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

if (count($arResult["ITEMS"]) == 0)
	return false;
?>
<ul class="nb-header-metro">
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<li class="nb-header-metro-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<a class="nb-header-metro-item__link" href="<?=$arItem["DETAIL_PAGE_URL"]?>">
				<?if (mb_strlen($arItem['DISPLAY_PROPERTIES']['METRO']['DISPLAY_VALUE']) > 0):?>
					<svg class="icon icon-metro">
						<use xlink:href="#metro"></use>
					</svg>
					<span><?=$arItem['DISPLAY_PROPERTIES']['METRO']['DISPLAY_VALUE']?></span>
					<svg class="icon icon-slider-arrow">
						<use xlink:href="#slider-arrow"></use>
					</svg>
				<?endif;?>
			</a>
		</li>
	<?endforeach;?>
</ul>
