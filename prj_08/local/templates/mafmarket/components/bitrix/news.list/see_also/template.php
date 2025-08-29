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
	<div class="materials-card__wrapper">
		<h3 class="materials-card__also">Смотрите также</h3>
	</div>
	<?
	foreach ($arResult["ITEMS"] as $arItem) {
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
		<div class="section-materials__also-item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
			<div class="materials-card__image">
				<img src="<?= $arItem['PICTURE']['SRC']; ?>" alt="<?= $arItem['PICTURE']['ALT']; ?>" title="<?= $arItem['PICTURE']['TITLE']; ?>" />
			</div>
			<div class="section-materials__description">
				<p class="materials-item__title"><?= $arItem['NAME']; ?></p>
				<div class="materials-item__text">
					<?= $arItem['PREVIEW_TEXT']; ?>
				</div>
				<a class="dp-btn materials-item__button" href="<?= $arItem['DETAIL_PAGE_URL']; ?>">
					<span>Подробнее</span>
					<svg class="icon icon-drop-right ">
						<use xlink:href="#drop-right"></use>
					</svg>
				</a>
			</div>
		</div>
	<?
	}
	?>
<? } ?>