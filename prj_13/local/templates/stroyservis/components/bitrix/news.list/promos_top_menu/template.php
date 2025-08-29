<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Grid\Declension;

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
<? if (!empty($arResult["ITEMS"])) { ?>
  <div class="catalogs">
    <a class="catalogs__title" href="/promos/">
      <?
      $pictureId = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "PICTURE");
      ?>
      <img src="<?if (!empty($pictureId)):?><?=CFile::GetPath($pictureId)?><?else:?><?=SITE_TEMPLATE_PATH?>/img/content/megamenu/1.jpg<?endif;?>" alt="">
      <span>Акции</span>
    </a>
    <ul class="catalogs__list">
      <? foreach ($arResult["ITEMS"] as $key => $arItem) { ?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <li class="catalogs__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
          <a href="<?= $arItem["DETAIL_PAGE_URL"]; ?>">
            <span><?= $arItem["NAME"]; ?></span>
          </a>
        </li>
      <? } ?>
    </ul>
  </div>

<? } ?>