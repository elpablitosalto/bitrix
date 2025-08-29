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

if (!empty($arResult["ITEMS"])) {
?>
	<h2 class="checkR"><?=$arParams['HEADER']?></h2>
	<div class="farbWrapper gallery">
		<? foreach ($arResult["ITEMS"] as $arItem) { ?>
			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			<div class="img  " id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
				<div class="galThumb" data-mfp-src="<?= $arItem['PICTURE']['SOURCE_PICTURE']['SRC']; ?>" title="<?= $arItem['NAME']; ?>">
					<img loading="lazy" src="<?= $arItem['PICTURE']['SRC']; ?>" sizes="(min-width:1500px) 360px, (min-width:1420px) 300px, (min-width:1270px) 282px, 300px" style="object-position:50% 50%;" title="<?= $arItem['PICTURE']['TITLE']; ?>" alt="<?= $arItem['PICTURE']['ALT']; ?>" width="<?= $arItem['PICTURE']['WIDTH']; ?>" height="<?= $arItem['PICTURE']['HEIGHT']; ?>" />
				</div>
				<div class="subtitle checkR"><?= $arItem['NAME']; ?></div>
			</div>
		<? } ?>
	</div>
<? } ?>