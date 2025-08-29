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

<? if (is_array($arResult["ITEMS"]) && count($arResult["ITEMS"]) > 0) { ?>
	<section class="offices">
		<div class="title-section">
			<h2>Наш офис</h2>
			<div class="offices__navigation">
				<div class="button-arrow button-arrow_left offices__prev"></div>
				<div class="button-arrow button-arrow_right offices__next"></div>
			</div>
		</div>
		<div class="offices__slider">
			<div class="offices__wrapper">
				<? foreach ($arResult["ITEMS"] as $arItem) { ?>
					<?
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					?>
					<div class="offices__slide" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
						<? if (isset($arItem["PREVIEW_PICTURE"]["SRC"])) : ?>
							<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>">
						<? endif; ?>
					</div>
				<? } ?>
			</div>
		</div>
	</section>
<? } ?>