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
	<div class="comparison__wrapper">
		<ul class="comparison__advantages-list">
			<?
			foreach ($arResult["ITEMS"] as $arItem) {
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
				<li class="comparison__advantages-item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
					<p class="comparison__advantages-title"><?= $arItem['NAME']; ?></p>
					<p class="comparison__advantages-text"><?= $arItem['PREVIEW_TEXT']; ?></p>
				</li>
			<?
			}
			?>
		</ul>
	</div>
<? } ?>