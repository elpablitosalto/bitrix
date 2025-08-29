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
			<div class="comparison__item">
				<div class="comparison__item-wrapper">
					<h2><span><?= $arItem['DISPLAY_PROPERTIES']['HEADER']['DISPLAY_VALUE'] ?></span></h2>
					<p>
						<?= $arItem['PREVIEW_TEXT']; ?>
					</p>
				</div>
				<div class="comparison__item-wrapper">
					<div class="comparison__item-block">
						<div class="comparison__detail">
							<div class="comparison__plus"></div>МАФ маркет
						</div>
						<div class="comparison__item-images">
							<? foreach ($arItem['PICTURES_PLUS'] as $key => $arFile) { ?>
								<div class="comparison__item-image">
									<img src="<?= $arFile['SRC']; ?>" alt="<?= $arFile['ALT']; ?>" title="<?= $arFile['TITLE']; ?>" />
								</div>
							<? } ?>
						</div>
						<? foreach ($arItem['DISPLAY_PROPERTIES']['TEXTS_PLUS']['DISPLAY_VALUE'] as $val) { ?>
							<p><?= $val; ?></p>
						<? } ?>
					</div>
					<div class="comparison__item-block">
						<div class="comparison__detail">
							<div class="comparison__minus"></div>Аналог/копия
						</div>
						<div class="comparison__item-images">
							<? foreach ($arItem['PICTURES_MINUS'] as $key => $arFile) { ?>
								<div class="comparison__item-image">
									<img src="<?= $arFile['SRC']; ?>" alt="<?= $arFile['ALT']; ?>" title="<?= $arFile['TITLE']; ?>" />
								</div>
							<? } ?>
						</div>
						<? foreach ($arItem['DISPLAY_PROPERTIES']['TEXTS_MINUS']['DISPLAY_VALUE'] as $val) { ?>
							<p><?= $val; ?></p>
						<? } ?>
					</div>
				</div>
			</div>
		</div>
	<?
	}
	?>
<? } ?>