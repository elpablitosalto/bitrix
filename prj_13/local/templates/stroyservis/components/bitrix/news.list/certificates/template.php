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

  <ul class="certificates__list">
    <? foreach ($arResult["ITEMS"] as $key => $arItem) { ?>
      <?
      $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
      $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
      ?>
      <li class="certificates__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
        <a class="certificates__button" data-fancybox src="<?= $arItem["DETAIL_PICTURE"]["SRC"] ?>" data-link-image="<?= $arItem["DETAIL_PICTURE"]["SRC"] ?>" itemscope itemtype="https://schema.org/ImageObject">
          <img itemprop="image" src="<?= $arItem["DETAIL_PICTURE"]["DETAIL_PICTURE_RESIZED"] ?>" alt="<?= $arItem["DETAIL_PICTURE"]["ALT"] ?>" title="<?= $arItem["DETAIL_PICTURE"]["TITLE"] ?>" />
        </a>
      </li>
      <?/* ?>
      <li class="certificates__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
        <a href="<?= $arItem["DETAIL_PICTURE"]["SRC"] ?>" target="_blank" itemscope itemtype="https://schema.org/ImageObject">
          <img itemprop="image" src="<?= $arItem["DETAIL_PICTURE"]["DETAIL_PICTURE_RESIZED"] ?>" alt="<?= $arItem["DETAIL_PICTURE"]["ALT"] ?>" title="<?= $arItem["DETAIL_PICTURE"]["TITLE"] ?>" />
        </a>
      </li>
      <?/**/ ?>
    <? } ?>
  </ul>
  <div class="certificates__pagination">
    <?
    if ($arParams["DISPLAY_BOTTOM_PAGER"]) {
      echo $arResult["NAV_STRING"];
    }
    ?>
  </div>

  <?/*?>
  <div class="popup popup-certificate">
    <div class="popup-certificate__image">
      <img src="<?= $arItem["DETAIL_PICTURE"]["SRC"] ?>" alt="Сертификат" title="Сертификат" />
    </div>
    <button class="popup-form__popup_close"></button>
  </div>
  <?*/?>

  <?/*?>
  <div class="popup popup-certificate">
    <div class="popup-certificate__image">
      <img src="<?= $arItem["DETAIL_PICTURE"]["SRC"] ?>" alt="<?= $arItem["DETAIL_PICTURE"]["ALT"] ?>" title="<?= $arItem["DETAIL_PICTURE"]["TITLE"] ?>" />
    </div>
    <button class="popup-form__popup_close"></button>
  </div>
  <?*/ ?>

<? } ?>