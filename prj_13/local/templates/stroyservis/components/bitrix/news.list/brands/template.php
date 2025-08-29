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
<ul class="brands__list">
	<? foreach ($arResult["ITEMS"] as $arItem) { ?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<li class="brands__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
			<?/*?><div class="brands__image" ><?*/ ?>
			<a class="brands__image" href="<?= $arItem["DETAIL_PAGE_URL"]; ?>" itemscope itemtype="https://schema.org/ImageObject">
				<img itemprop="image" src="<?= $arItem["PICTURE"]['SRC']; ?>" alt="<?= $arItem["PICTURE"]['ALT']; ?>" title="<?= $arItem["PICTURE"]['TITLE']; ?>" <? if (!empty($arItem['PICTURE']['WIDTH'])) { ?>width="<?= $arItem['PICTURE']['WIDTH'] ?>" <? } ?> <? if (!empty($arItem['PICTURE']['HEIGHT'])) { ?>height="<?= $arItem['PICTURE']['HEIGHT'] ?>" <? } ?> />
			</a>
			<?/*?></div><?*/ ?>
			<p class="brands__title"><?= $arItem["DISPLAY_NAME"]; ?></p>
			<? if (!empty($arItem["arCountries"])) { ?>
				<div class="brands__country">
					<? foreach ($arItem["arCountries"] as $key => $ar_item) { ?>
						<div class="brands__country-wrapper">
							<div class="brands__country-image" itemscope itemtype="https://schema.org/ImageObject">
								<img itemprop="image" src="<?= $ar_item["PICTURE"]['SRC']; ?>" alt="<?= $ar_item["PICTURE"]['ALT']; ?>" title="<?= $ar_item["PICTURE"]['TITLE']; ?>" <? if (!empty($ar_item['PICTURE']['WIDTH'])) { ?>width="<?= $ar_item['PICTURE']['WIDTH'] ?>" <? } ?> <? if (!empty($ar_item['PICTURE']['HEIGHT'])) { ?>height="<?= $ar_item['PICTURE']['HEIGHT'] ?>" <? } ?> />
							</div><?= $ar_item['NAME']; ?>
						</div>
					<? } ?>
				</div>
			<? } ?>
			<p class="brands__text"><?= $arItem["DISPLAY_PROPERTIES"]["PRODUCT_TYPE"]["VALUE"]; ?></p>
		</li>
	<? } ?>
</ul>

<? if ($arParams["DISPLAY_BOTTOM_PAGER"]) : ?>
	<br /><?= $arResult["NAV_STRING"] ?>
<? endif; ?>