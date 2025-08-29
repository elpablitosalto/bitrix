<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use Bitrix\Catalog\ProductTable;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 *
 *  _________________________________________________________________________
 * |	Attention!
 * |	The following comments are for system use
 * |	and are required for the component to work correctly in ajax mode:
 * |	<!-- items-container -->
 * |	<!-- pagination-container -->
 * |	<!-- component-end -->
 */

$this->setFrameMode(true);
?>
<div class="respBlock">
	<div id="BigBlocks" class="bigBlocks">
		<? foreach ($arResult["ITEMS"] as $arItem) { ?>
			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			<a class="bigBlock bigBlock<?= $arItem['PICTURE']['SIZE']; ?>" href="<?= $arItem['DETAIL_PAGE_URL'] ?>" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
				<img class="bbimg" loading="lazy" data-size="<?= $arItem['PICTURE']['SIZE']; ?>" src="<?= $arItem['PICTURE']['SRC']; ?>" sizes="(min-width:1270px) 580px, (min-width:1020px) 460px, (min-width:650px) 580px, 100vw" style="object-position:50% 50%;" width="<?= $arItem['PICTURE']['WIDTH']; ?>" height="<?= $arItem['PICTURE']['HEIGHT']; ?>" alt="<?= $arItem['PICTURE']['ALT']; ?> " title="<?= $arItem['PICTURE']['TITLE']; ?>" />
				<div class="content">
					<div class="title "><?= $arItem['NAME']; ?></div>
					<div class="text d"><?= $arItem['PREVIEW_TEXT']; ?></div>
					<?/*?>
					<p class="text d"><?= $arItem['PREVIEW_TEXT']; ?></p>
					<?*/?>
				</div>
			</a>
		<? } ?>
	</div>
</div>