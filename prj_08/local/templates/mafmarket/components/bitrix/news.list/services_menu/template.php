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
	<ul class="dp-tags__list dp-tags__list_row">
		<?
		foreach ($arResult["ITEMS"] as $arItem) {
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
			<li class="dp-tags__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
				<a class="dp-btn dp-btn_xs dp-btn_blue" href="#<?= $arItem['CODE']; ?>" data-anchor="#<?= $arItem['CODE']; ?>">
					<span><?= $arItem['DISPLAY_PROPERTIES']['MENU_HEADER']['VALUE']; ?></span>
				</a>
			</li>
		<?
		}
		?>
	</ul>
<? } ?>