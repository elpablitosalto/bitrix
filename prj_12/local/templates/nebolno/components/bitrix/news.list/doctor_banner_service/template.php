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
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<?if (isset($arItem["DOCTOR_PHOTO"]['src'])):?>
		<div class="nb-top-b-services__bg" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<div class="nb-top-b-services__photo">
				<div class="nb-top-b-services__photo-container">
					<img src="<?=$arItem["DOCTOR_PHOTO"]['src']?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>">
				</div>
			</div>
		</div>
	<?endif;?>
	<?$this->SetViewTarget("doctor_info_" . $arParams['BLOCK_ID']);?>
	<div class="nb-top-b-services__doctor-info">
		<p class="nb-top-b-services__doctor"><?=$arItem['NAME']?></p>
		<?if (is_array($arItem['PROPERTIES']['SPECIALIZATIONS']['VALUE_ENUM']) && count($arItem['PROPERTIES']['SPECIALIZATIONS']['VALUE_ENUM']) > 0):?>
			<p class="nb-top-b-services__skill"><?=implode(', ', $arItem['PROPERTIES']['SPECIALIZATIONS']['VALUE_ENUM'])?></p>
		<?endif;?>
	</div>
	<?$this->EndViewTarget();?>
<?endforeach;?>