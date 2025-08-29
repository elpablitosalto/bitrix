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

use \Bitrix\Main\Localization\Loc;

if (count($arResult["ITEMS"]) == 0)
	return false;
?>
<ul class="nb-footer-locations">
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<li class="nb-footer-location" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<?if (mb_strlen($arItem['DISPLAY_PROPERTIES']['ADDRESS']['DISPLAY_VALUE']) > 0):?>
				<span class="nb-footer-location__metro">
					<svg class="icon icon-metro">
						<use xlink:href="#metro"></use>
					</svg><span><?=$arItem['DISPLAY_PROPERTIES']['METRO']['DISPLAY_VALUE']?></span>
				</span>
			<?endif;?>
			<?if (mb_strlen($arItem['DISPLAY_PROPERTIES']['ADDRESS']['DISPLAY_VALUE']) > 0):?>
				<span class="nb-footer-location__address"><?=$arItem['DISPLAY_PROPERTIES']['ADDRESS']['DISPLAY_VALUE']?></span>
			<?endif;?>
			<span class="nb-footer-location__map-links">
				<a class="nb-footer-location__map-link" href="<?=$arItem["DETAIL_PAGE_URL"]?>" target="_blank">
					<span><?=Loc::getMessage('ROUTE_ON_CAR')?></span>
					<svg class="icon icon-slider-arrow">
						<use xlink:href="#slider-arrow"></use>
					</svg>
				</a><a class="nb-footer-location__map-link" href="<?=$arItem["DETAIL_PAGE_URL"]?>" target="_blank">
					<span><?=Loc::getMessage('ROUTE_ON_METRO')?></span>
					<svg class="icon icon-slider-arrow">
						<use xlink:href="#slider-arrow"></use>
					</svg>
				</a>
			</span>
		</li>
	<?endforeach;?>
</ul>
