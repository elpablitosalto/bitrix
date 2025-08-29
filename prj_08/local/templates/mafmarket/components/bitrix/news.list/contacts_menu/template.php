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
		<div class="aside__contact-wrapper" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
			<p class="aside__contact-title">Контакты:</p>
			<a class="aside__contact-link" href="mailto:<?= $arItem['DISPLAY_PROPERTIES']['EMAIL']['DISPLAY_VALUE']; ?>"><?= $arItem['DISPLAY_PROPERTIES']['EMAIL']['DISPLAY_VALUE']; ?></a>
			<? foreach ($arItem['PHONES']['arSources'] as $key => $val) { ?>
				<a class="aside__contact-link" href="tel:<?= $arItem['PHONES']['arValuesForLink'][$key] ?>"><?= $val; ?></a>
			<? } ?>
		</div>
	<?
	}
	?>
<? } ?>