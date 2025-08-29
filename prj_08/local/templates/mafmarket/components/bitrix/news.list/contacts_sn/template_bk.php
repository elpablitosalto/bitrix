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
		<section class="dp-section" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
			<div class="container">
				<div class="dp-socials">Мы в соцсетях
					<ul class="dp-socials__list">
						<? if (!empty($arItem['DISPLAY_PROPERTIES']['VK']['VALUE'])) { ?>
							<li class="dp-socials__item">
								<a href="<?= $arItem['DISPLAY_PROPERTIES']['VK']['VALUE']; ?>">ВК</a>
							</li>
						<? } ?>
						<? if (!empty($arItem['DISPLAY_PROPERTIES']['INSTAGRAM']['VALUE'])) { ?>
							<li class="dp-socials__item">
								<a href="<?= $arItem['DISPLAY_PROPERTIES']['INSTAGRAM']['VALUE']; ?>">Instagram</a>
							</li>
						<? } ?>
						<? if (!empty($arItem['DISPLAY_PROPERTIES']['FACEBOOK']['VALUE'])) { ?>
							<li class="dp-socials__item"><a href="<?= $arItem['DISPLAY_PROPERTIES']['FACEBOOK']['VALUE']; ?>">Facebook</a></li>
						<? } ?>
						<? if (!empty($arItem['DISPLAY_PROPERTIES']['WHATSAPP']['VALUE'])) { ?>
							<li class="dp-socials__item"><a href="https://wa.me/<?= $arItem['WHATSAPP_PHONE_FOR_LINK']; ?>">WhatsApp</a></li>
						<? } ?>
					</ul>
				</div>
			</div>
		</section>
	<?
	}
	?>
<? } ?>