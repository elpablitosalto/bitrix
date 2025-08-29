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
<h2>
  Вопросы и ответы <span><? if (intval($arResult['ELEMENTS_COUNT']) > 0) { ?>(<?= $arResult['ELEMENTS_COUNT']; ?>)<? } ?></span>
</h2>
<?
//echo 'NavNum = ' . $arResult['NAV_RESULT']->NavNum . '<br />';
?>
<button class="card-main__questions-button">Задать вопрос</button>
<div class="popup faq-popup">
  <h2>Задать вопрос</h2>
  <?
  $APPLICATION->IncludeComponent(
    "indexis:iblock.form",
    "review",
    array(
      "CACHE_TIME" => "36000000",
      "CACHE_TYPE" => "A",
      "FORM_CODE" => 'questions',
      "IBLOCK_ID" => Indexis::getIblockId('questions', 'forms'),
      "IBLOCK_TYPE" => "forms",
      "PROPERTY_CODE" => array("NAME", "EMAIL", 'HEADER', 'TEXT', 'IMAGES', "HIDDEN_PRODUCT"),
      "EVENT_NAME" => "QUESTION_ADD",
      "DEFAULT_HIDDEN_PRODUCT" => $arParams['PRODUCT_ID'],
      'AJAX_MODE' => 'N',
      'FORM_ACTION' => '/local/ajax/question_add_form.php',
      'NEW_ELEMENT_ACTIVE' => 'N',
      'SUCCESS_MESSAGE_CODE' => 'SUCCESS_MESSAGE_QUESTION',
      //"EDIT_AREA_ID" => $arParams['EDIT_AREA_ID'],
      //"BLOCK_AREA_ID" => $arParams['BLOCK_AREA_ID'],
      'CONTAINER_CLASS' => 'faq-popup',
    )
  ); ?>
  <button class="popup-form__popup_close"></button>
</div>

<?
//vardump($arResult["ITEMS"]);
?>
<? if (!empty($arResult["ITEMS"])) { ?>
  <div class="js_nav_result_<?= $arResult['NAV_RESULT']->NavNum ?>">
    <? foreach ($arResult["ITEMS"] as $key => $arItem) { ?>
      <?
      $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
      $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
      ?>
      <div class="card-main__questions-user" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
        <div class=" card-main__questions-name"><?= $arItem['DISPLAY_PROPERTIES']['NAME']['VALUE']; ?></div>
        <div class="card-main__questions-date"><?= FormatDate("j F Y", MakeTimeStamp($arItem['DATE_CREATE'])); ?></div>
        <div class="card-main__questions-question"><?= $arItem['DISPLAY_PROPERTIES']['TEXT']['VALUE']['TEXT']; ?></div>
        <div class="card-main__questions-answers">
          <div class="card-main__questions-answerer"><?= $arItem['DISPLAY_PROPERTIES']['WHO_ANSWERED']['VALUE']; ?></div>
          <div class="card-main__questions-answer"><?= $arItem['DISPLAY_PROPERTIES']['ANSWER']['VALUE']['TEXT']; ?></div>
        </div>
      </div>
    <? } ?>
  </div>
  <? if ($arParams["DISPLAY_BOTTOM_PAGER"]) { ?>
    <div class="<?= "js_nav_string_" . $arResult['NAV_RESULT']->NavNum; ?>">
      <?
      echo $arResult["NAV_STRING"];
      ?>
    </div>
  <? } ?>
<? } ?>