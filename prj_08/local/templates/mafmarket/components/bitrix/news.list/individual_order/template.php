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
			<div class="container individual__wrapper">
				<div class="dp-section__header">
					<h2 class="dp-section__individual-title"><?= $arItem['NAME']; ?></h2>
					<div class="dp-section__desc dp-section__individual-desc">
						<?= $arItem['PREVIEW_TEXT']; ?>
					</div>
					<a class="dp-btn dp-section__link" href="<?= $arItem['DISPLAY_PROPERTIES']['LINK']['VALUE'] ?>">
						<span><?= $arItem['DISPLAY_PROPERTIES']['LINK_TEXT']['VALUE'] ?></span>
						<svg class="icon icon-drop-right ">
							<use xlink:href="#drop-right"></use>
						</svg>
					</a>
				</div>
				<div class="dp-section__body">
					<?
					$bFlag = false;
					if (is_array($arItem['PICTURES'])) {
						if (count($arItem['PICTURES']) > 1) {
							$bFlag = true;
						}
					}
					?>
					<? if ($bFlag) { ?>
						<div class="individual__image-wrapper">
						<? } ?>
						<? foreach ($arItem['PICTURES'] as $key => $arFile) { ?>
							<div class="individual__image">
								<img src="<?= $arFile['SRC']; ?>" alt="<?= $arFile['ALT']; ?>" title="<?= $arFile['TITLE']; ?>" />
							</div>
						<? } ?>
						<? if ($bFlag) { ?>
						</div>
					<? } ?>
				</div>
			</div>
		</section>
	<?
	}
	?>
<? } ?>