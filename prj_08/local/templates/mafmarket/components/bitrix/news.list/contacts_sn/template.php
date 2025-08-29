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
	<section class="dp-section">
		<div class="container">
			<div class="dp-socials">Мы в соцсетях
				<ul class="dp-socials__list">
					<?
					foreach ($arResult["ITEMS"] as $arItem) {
						$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
						$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					?>
						<li class="dp-socials__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
							<a href="<?= $arItem['DISPLAY_PROPERTIES']['URL']['VALUE']; ?>">
								<?= $arItem['NAME']; ?>
							</a>
						</li>
					<?
					}
					?>
				</ul>
			</div>
		</div>
	</section>
<? } ?>