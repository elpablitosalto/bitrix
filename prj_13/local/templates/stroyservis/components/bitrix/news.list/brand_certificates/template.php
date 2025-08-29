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
  <section class="certificate">
    <div class="title-section">
      <h2>Сертификаты</h2>
      <div class="certificate__navigation">
        <div class="button-arrow button-arrow_left certificate__prev"></div>
        <div class="button-arrow button-arrow_right certificate__next"></div>
      </div>
    </div>
    <div class="certificate__slider">
      <div class="certificate__wrapper">
        <? foreach ($arResult["ITEMS"] as $key => $arItem) { ?>
          <?
          $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
          $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
          ?>
          <div class="certificate__slide" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
            <div class="certificate__image">
              <? foreach ($arItem['PICTURES'] as $photo) { ?>
                <a class="certificates__button" data-fancybox="gallery" href="<?= $photo["FILE_VALUE_SOURCE"]["SRC"] ?>">
                  <img src="<?= $photo['SRC'] ?>" alt="<?= $photo["ALT"] ?>" title="<?= $photo["TITLE"] ?>" />
                </a>
              <? } ?>
            </div>
          </div>
        <? } ?>

      </div>
    </div>
  </section>

<? } ?>