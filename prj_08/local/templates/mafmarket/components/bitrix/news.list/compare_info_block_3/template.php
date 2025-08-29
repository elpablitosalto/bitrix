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

//vardump($arResult);

if (!empty($arResult["ITEMS"])) {
?>
	<?
	foreach ($arResult["ITEMS"] as $arItem) {
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
		<div class="comparison__wrapper" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
			<div class="comparison__invitation">
				<h2><?= $arItem['DISPLAY_PROPERTIES']['HEADER_LAST_BLOCK']['DISPLAY_VALUE'] ?></h2>
				<? foreach ($arItem['DISPLAY_PROPERTIES']['ADV_LAST_BLOCK']['DISPLAY_VALUE'] as $val) { ?>
					<p><?= $val; ?></p>
				<? } ?>
				<div class="comparison__invitation-links">
					<a class="dp-btn dp-btn_sm dp-btn_white" href="<?= $arItem['DISPLAY_PROPERTIES']['BUT_1_LINK_LAST_BLOCK']['DISPLAY_VALUE'] ?>"><?= $arItem['DISPLAY_PROPERTIES']['BUT_1_HEADER_LAST_BLOCK']['DISPLAY_VALUE'] ?></a>
					<a class="dp-btn dp-btn_sm dp-btn_white" href="<?= $arItem['DISPLAY_PROPERTIES']['BUT_2_LINK_LAST_BLOCK']['DISPLAY_VALUE'] ?>"><?= $arItem['DISPLAY_PROPERTIES']['BUT_2_HEADER_LAST_BLOCK']['DISPLAY_VALUE'] ?></a>
				</div>
			</div>
		</div>
	<?
	}
	?>
<? } ?>