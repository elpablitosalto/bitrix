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
?>
<section class="page-desc">
  <div class="container">
    <div class="text-size-lg">
      <?= $arResult['PREVIEW_TEXT']; ?>
    </div>
    <div class="section__nav">
      <div class="buttons-line">
          <?if(isset($arResult['DISPLAY_PROPERTIES']['END_REG']['DISPLAY_VALUE']) && mb_strlen($arResult['DISPLAY_PROPERTIES']['END_REG']['DISPLAY_VALUE'])){?>
              <a hreg="javascript:void(0)" class="btn">Регистрация закрыта</a>
          <?} else {?>
              <a target="_blank" href="<?= $arResult['DISPLAY_PROPERTIES']['FORM_REG_LINK']['VALUE']; ?>" class="btn">Зарегистрироваться</a>
          <?}?>
      </div>
    </div>
  </div>
</section>