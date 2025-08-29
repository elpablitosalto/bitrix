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
<ul class="articles__list">
	<? foreach ($arResult["ITEMS"] as $arItem) : ?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<li class="articles__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
			<a href="<? echo $arItem["DETAIL_PAGE_URL"]; ?>" target="_self">
				<div class="articles__image" itemscope itemtype="https://schema.org/ImageObject">
					<? if (!empty($arItem["DETAIL_PICTURE"]["DETAIL_PICTURE_RESIZED"])) { ?>
						<img itemprop="image" src="<?= $arItem["DETAIL_PICTURE"]["DETAIL_PICTURE_RESIZED"] ?>" alt="<?= $arItem["DETAIL_PICTURE"]["ALT"] ?>" title="<?= $arItem["DETAIL_PICTURE"]["TITLE"] ?>" />
					<? } else if (!empty($arItem["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"])) { ?>
						<img itemprop="image" src="<?= $arItem["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"] ?>" alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>" title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>" />
					<? } else { ?>
						<? echo $arItem["NOT_FOUND_PICTURE_HTML"]; ?>
					<? } ?>
				</div>
				<p class="articles__title">
					<?= $arItem["NAME"]; ?>
				</p>
				<? if (strlen($arItem["PREVIEW_TEXT"]) > 0) { ?>
					<p class="articles__text">
						<?=$arItem["PREVIEW_TEXT"];?>
					</p>
				<? } ?>
			</a>
		</li>
	<? endforeach; ?>
</ul>
<? if ($arParams["DISPLAY_BOTTOM_PAGER"]) : ?>
	<br /><?= $arResult["NAV_STRING"] ?>
<? endif; ?>