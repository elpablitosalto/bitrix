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
<div class="sp-offer-list">
	<? foreach ($arResult["ITEMS"] as $arItem) : ?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<div class="sp-offer-item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
			<? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arItem["PREVIEW_PICTURE"])) : ?>
				<div class="img-wrapper">
					<? if ($arItem["PROPERTIES"]["LINK"]["VALUE"]) { ?>
						<a class="name" href="<?= $arItem["PROPERTIES"]["LINK"]["VALUE"] ?>">
						<? } ?>
						<img  class="js_lazy img-responsive" data-src="<?= $arItem['PICTURE']['SRC']; ?>" alt="<?= $arItem['PICTURE']['ALT']; ?>" title="<?= $arItem['PICTURE']['TITLE']; ?>" />
						<?/*?>
						<img class="js_lazy img-responsive" data-src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>" title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>" />
						<?*/?>
						<? if ($arItem["PROPERTIES"]["LINK"]["VALUE"]) { ?>
						</a>
					<? } ?>

				</div>
			<? endif ?>
			<? if ($arParams["DISPLAY_NAME"] != "N" && $arItem["NAME"]) : ?>
				<div class="title">
					<? if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])) : ?>
						<a href="<? echo $arItem["DETAIL_PAGE_URL"] ?>"><? echo $arItem["NAME"] ?></a>
					<? else : ?>
						<? echo $arItem["NAME"] ?>
					<? endif; ?>
				</div>
			<? endif; ?>
			<? if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && $arItem["PREVIEW_TEXT"]) : ?>
				<div class="descr">
					<?= $arItem["PREVIEW_TEXT"]; ?>
				</div>
			<? endif; ?>
			<? //$arItem["DISPLAY_PROPERTIES"]
			?>
		</div>
	<? endforeach; ?>
	<?/*if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;*/ ?>
</div>