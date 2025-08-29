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

  <div class=" js_nav_result_<?= $arResult['NAV_RESULT']->NavNum ?>">

    <? foreach ($arResult["ITEMS"] as $key => $arItem) { ?>
      <?
      $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
      $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
      ?>
      <div id="<?= $this->GetEditAreaId($arItem['ID']); ?>" class="faq__name" itemprop="mainEntity" itemscope itemtype="https://schema.org/Question">
        <h2 class="faq__question" itemprop="name"><span><?= $arItem["NAME"]; ?></span></h2>
        <div class="faq__wrapper" itemprop="text"><?= $arItem["DETAIL_TEXT"]; ?></div>
      </div>
    <? } ?>

  </div>

  <div class="<?= "js_nav_string_" . $arResult['NAV_RESULT']->NavNum; ?>">
    <?
    if ($arParams["DISPLAY_BOTTOM_PAGER"]) {
      echo $arResult["NAV_STRING"];
    }
    ?>
  </div>

<? } ?>