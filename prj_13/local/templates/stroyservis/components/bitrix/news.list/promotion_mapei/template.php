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
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<section class="promotion" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<div class="title-section">
				<h2><?=$arResult['NAME']?></h2>
				<a class="title-link" href="<?=$arItem["LIST_PAGE_URL"]?>">Все акции</a>
			</div>
            <div class="promotion__content" style="background-image: url('/local/templates/stroyservis/img/content/promotion/promotion.png')">
				<p><?=$arItem["NAME"]?></p>
				<a class="promotion__more" href="<?=$arItem["DETAIL_PAGE_URL"]?>">Подробнее</a>
                <div class="promotion__adline">
					<?=$arItem['DISPLAY_PROPERTIES']['BANNER_ADV_SIGN']['DISPLAY_VALUE']?>
					<?if (mb_strlen($arItem['DISPLAY_PROPERTIES']['BANNER_TOKEN']['DISPLAY_VALUE']) > 0):?>ERID: <?=$arItem['DISPLAY_PROPERTIES']['BANNER_TOKEN']['DISPLAY_VALUE']?><?endif;?>
				</div>
			</div>
		</section>
	<?endforeach;?>
<?endif;?>