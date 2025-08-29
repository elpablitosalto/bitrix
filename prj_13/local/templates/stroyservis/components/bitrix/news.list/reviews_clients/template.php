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

  <ul class="reviews__list">
    <? foreach ($arResult["ITEMS"] as $key => $arItem) { ?>
      <?
      $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
      $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
      ?>
      <li class="reviews__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
        <a data-fancybox="gallery" href="<?= $arItem["DETAIL_PICTURE"]["SRC"] ?>">
          <img src="<?= $arItem['PICTURE']['SRC'] ?>" alt="<?= $arItem["PICTURE"]["ALT"] ?>" title="<?= $arItem["PICTURE"]["TITLE"] ?>" />
        </a>
      </li>
    <? } ?>
  </ul>
  <? if ($arParams["DISPLAY_BOTTOM_PAGER"]) { ?>
    <div class="certificates__pagination">
      <?
      echo $arResult["NAV_STRING"];
      ?>
    </div>
  <? } ?>

<? } ?>