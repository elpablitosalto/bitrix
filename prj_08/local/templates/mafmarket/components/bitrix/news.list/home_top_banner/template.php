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

//vardump($arResult["ITEMS"]);

if (!empty($arResult["ITEMS"])) {
?>
	<?
	foreach ($arResult["ITEMS"] as $arItem) {
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
		<section class="dp-section dp-promo" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
			<div class="dp-section__bg">
				<video class="dp-promo__video-desktop" poster="<?= $arItem['PICTURE']['SRC']; ?>" itemscope itemtype="https://schema.org/VideoObject" autoplay="autoplay" muted="muted">
					<meta itemprop="name" content="{videoTitle}">
					<meta itemprop="duration" content="PT1M33S">
					<meta itemprop="thumbnail" content="<?= $arItem['PICTURE']['SRC']; ?>">
					<source src="<?= $arItem['DISPLAY_PROPERTIES']['VIDEO']['FILE_VALUE']['SRC']; ?>" type="">
				</video>
				<video class="dp-promo__video-mobile" poster="<?= $arItem['PICTURE']['SRC']; ?>" itemscope itemtype="https://schema.org/VideoObject" autoplay="autoplay" muted="muted">
					<meta itemprop="name" content="{videoTitle}">
					<meta itemprop="duration" content="PT1M33S">
					<meta itemprop="thumbnail" content="<?= $arItem['PICTURE']['SRC']; ?>">
					<source src="<?= $arItem['DISPLAY_PROPERTIES']['VIDEO_MOBILE']['FILE_VALUE']['SRC']; ?>" type="">
				</video>
			</div>

			<div class="dp-section__content">
				<div class="container">
					<div class="dp-section__desc"><?= $arItem['PREVIEW_TEXT']; ?></div>
					<h1 class="dp-section__title"><?= $arItem['DISPLAY_PROPERTIES']['H_1']['DISPLAY_VALUE']; ?><br> <span class="color_blue"><?= $arItem['DISPLAY_PROPERTIES']['H_2']['DISPLAY_VALUE']; ?></span></h1>
				</div>
			</div>
		</section>
	<? } ?>
<? } ?>