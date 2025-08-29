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
?>
<? foreach ($arResult["ITEMS"] as $arItem): ?>
<?
$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
?>
	<div class="dp-slider__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
		<div class="dp-speakers-item">
			<a class="dp-speakers-item__link">
				<div class="dp-speakers-item__img">
					<?if(isset($arItem["PREVIEW_PICTURE"]["SRC"])){?>
						<img
								src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
								title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"
								alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>">
					<?}?>
				</div>
				<div class="dp-speakers-item__caption">
					<h3 class="dp-speakers-item__name"><?= $arItem["NAME"] ?></h3>
					<p class="dp-speakers-item__category"><?= $arItem["DISPLAY_PROPERTIES"]["SPECIALITY"]["DISPLAY_VALUE"] ?></p>
					<p class="dp-speakers-item__desc"><?= $arItem["PREVIEW_TEXT"] ?></p>
				</div>
			</a></div>
	</div>

<?endforeach;?>
