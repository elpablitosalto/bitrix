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

if (!empty($arResult["ITEMS"])) {
?>
	<h2 class="csHeadline"><?= $arParams['HEADER'] ?></h2>
	<div class="refwrap">
		<? foreach ($arResult["ITEMS"] as $arItem) { ?>
			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			<a class="refTeaser bigBlock<?= $arItem['PICTURE']['SIZE']; ?> " id="<?= $this->GetEditAreaId($arItem['ID']); ?>" data-src="<?= $arItem['PICTURE']['SOURCE_PICTURE']['SRC']; ?>" data-mini="" href="<?= $arItem['DETAIL_PAGE_URL']; ?>">
				<img loading="lazy" src="<?= $arItem['PICTURE']['SRC']; ?>" title="<?= $arItem['PICTURE']['TITLE']; ?>" alt="<?= $arItem['PICTURE']['ALT']; ?>" width="<?= $arItem['PICTURE']['WIDTH']; ?>" height="<?= $arItem['PICTURE']['HEIGHT']; ?>" />
				<div class="content">
					<div class="title "><?= $arItem['NAME']; ?></div>
				</div>
			</a>
		<? } ?>
	</div>
<? } ?>