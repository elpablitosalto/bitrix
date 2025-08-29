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
<?
//vardump($arResult);
?>
<?
$this->SetViewTarget('slideShow');
?>
<?
//$this->AddEditAction($arResult['ID'], $arResult['EDIT_LINK'], CIBlock::GetArrayByID($arResult["IBLOCK_ID"], "ELEMENT_EDIT"));
//$this->AddDeleteAction($arResult['ID'], $arResult['DELETE_LINK'], CIBlock::GetArrayByID($arResult["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
?>
<div id="<?= $this->GetEditAreaId($arResult['ID']); ?>">
  <? foreach ($arResult['PICTURES'] as $key => $arFileCustom) { ?>
    <div class="slide" itemscope="" itemtype="https://schema.org/ImageObject">
      <meta itemprop="contentUrl" content="">
      <meta itemprop="thumbnailUrl" content="">
      <img class="bbimg" src="<?= $arFileCustom['SRC'] ?>" sizes="100vw" style="object-position:50% 50%;" width="1920" height="750" alt="<?= $arFileCustom['ALT'] ?>" title="<?= $arFileCustom['TITLE'] ?>" />
      <? if (strlen($arFileCustom['DESCRIPTION']) > 0) { ?>
        <div class="subtitle">
          <div class="description" itemprop="description"><?= $arFileCustom['DESCRIPTION']; ?></div>
        </div>
      <? } ?>
    </div>
  <? } ?>
</div>
<?
$this->EndViewTarget();
?>

<?
// Данные, которые были в хедере -->
?>
<?
$GLOBALS['PAGE_H1'] = $arResult['NAME'];
$GLOBALS['PAGE_H2'] = $arResult['UF_H2'];
$GLOBALS['PAGE_DESCRIPTION'] = $arResult['DESCRIPTION'];
include($_SERVER["DOCUMENT_ROOT"] . "/include/header_first_content.php");
?>
<?
// <-- Данные, которые были в хедере
?>