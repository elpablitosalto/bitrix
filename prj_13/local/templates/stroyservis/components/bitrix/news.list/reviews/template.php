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
<h2>Отзывы</h2>
<div class="card-main__reviews-wrapper">
  <? if (!empty($arResult["ITEMS"]) && $arResult['AVERAGE_RATING'] > 0) { ?>
    <div class="card-main__review-wrapper" itemprop="aggregateRating" itemscope itemtype="https://schema.org/AggregateRating">
      <meta itemprop="worstRating" content="0">
      <meta itemprop="bestRating" content="5">
      <div class="card-main__reviews-quantity" itemprop="ratingValue">
        <?= $arResult['AVERAGE_RATING']; ?>
        <meta itemprop="ratingCount" content="<?= $arResult['ELEMENTS_COUNT']; ?>">
        <div class="card-main__reviews-stars">
          <?
          for ($i = 1; $i <= 5; $i++) {
            if ($i <= $arResult['AVERAGE_RATING']) { ?>
              <span class="card-main_full"></span>
              <?
            } else if ($i > $arResult['AVERAGE_RATING']) {
              $val = (float)$arResult['AVERAGE_RATING'];
              if ($i == ceil($val)) {
              ?>
                <span class="card-main_half"></span>
              <?
              } else {
              ?>
                <span></span><?
                            }
                          }
                        }
                              ?>
        </div>
      </div>
      Основано на <?= Indexis::num2word($arResult['ELEMENTS_COUNT'], ['#NUM# отзыве', '#NUM# отзывах', '#NUM# отзывах']) ?>
    </div>
  <? } ?>
  <button class="card-main__reviews-button">Оставить отзыв</button>
  <div class="popup review-popup">
    <h2>Написать отзыв</h2>
    <?
    $APPLICATION->IncludeComponent(
      "indexis:iblock.form",
      "review",
      array(
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "FORM_CODE" => 'reviews',
        "IBLOCK_ID" => Indexis::getIblockId('reviews', 'forms'),
        "IBLOCK_TYPE" => "forms",
        "PROPERTY_CODE" => array("NAME", "EMAIL", 'RATING', 'HEADER', 'TEXT', 'IMAGES', "HIDDEN_PRODUCT"),
        "EVENT_NAME" => "REVIEW_ADD",
        "DEFAULT_HIDDEN_PRODUCT" => $arParams['PRODUCT_ID'],
        'AJAX_MODE' => 'N',
        'FORM_ACTION' => '/local/ajax/review_add_form.php',
        'NEW_ELEMENT_ACTIVE' => 'N',
        'SUCCESS_MESSAGE_CODE' => 'SUCCESS_MESSAGE_REVIEW',
        //"EDIT_AREA_ID" => $arParams['EDIT_AREA_ID'],
        //"BLOCK_AREA_ID" => $arParams['BLOCK_AREA_ID'],
        'CONTAINER_CLASS' => 'review-popup',
      )
    ); ?>
    <button class="popup-form__popup_close"></button>
  </div>
</div>


<? if (!empty($arResult["ITEMS"])) { ?>
  <div class="card-main__reviews-list js_nav_result_<?= $arResult['NAV_RESULT']->NavNum ?>">
    <? foreach ($arResult["ITEMS"] as $key => $arItem) { ?>
      <?
      $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
      $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
      ?>
      <div class="review-user" itemprop="author" itemtype="http://schema.org/Person" itemscope="" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
        <div class="review-name" itemprop="name">
          <?= $arItem['DISPLAY_PROPERTIES']['NAME']['VALUE']; ?>
        </div>
        <? if ($arItem['DISPLAY_PROPERTIES']['RATING']['VALUE'] > 0) { ?>
          <div class="review-rating" itemprop="reviewRating" itemtype="http://schema.org/Rating" itemscope="">
            <meta itemprop="worstRating" content="0" />
            <meta itemprop="bestRating" content="5" />
            <meta itemprop="ratingValue" content="<?= $arItem['DISPLAY_PROPERTIES']['RATING']['VALUE']; ?>" />
            <?
            for ($i = 1; $i <= 5; $i++) {
              if ($i <= $arItem['DISPLAY_PROPERTIES']['RATING']['VALUE']) { ?>
                <span class="review__rating_full"></span>
                <?
              } else if ($i > $arItem['DISPLAY_PROPERTIES']['RATING']['VALUE']) {
                $val = (float)$arItem['DISPLAY_PROPERTIES']['RATING']['VALUE'];
                if ($i == ceil($val)) {
                ?>
                  <span class="review__rating_half"></span>
                <?
                } else {
                ?>
                  <span></span><?
                              }
                            }
                          }
                                ?>
          </div>
        <? } ?>
        <div class="review-date" itemprop="datePublished"><?= FormatDate("j F Y", MakeTimeStamp($arItem['DATE_CREATE'])); ?></div>
        <div class="review-text" itemprop="reviewBody">
          <h4><?= $arItem['DISPLAY_PROPERTIES']['HEADER']['VALUE'] ?></h4>
          <?= $arItem['DISPLAY_PROPERTIES']['TEXT']['VALUE']['TEXT']; ?>
        </div>
        <? if (!empty($arItem['PICTURES'])) { ?>
          <div class="review-images">
            <? foreach ($arItem['PICTURES'] as $key => $ar_picture) { ?>
              <button class="certificates__button" data-fancybox src="<?= $ar_picture['SOURCE_PICTURE']['SRC'] ?>" data-link-image="<?= $ar_picture['SOURCE_PICTURE']['SRC'] ?>">
                <img itemprop="image" src="<?= $ar_picture['SRC'] ?>" alt="<?= $ar_picture['ALT'] ?>" alt="<?= $ar_picture['TITLE'] ?>" />
              </button>
              <?/*?>
              <a href="<?= $ar_picture['SOURCE_PICTURE']['SRC'] ?>" target="_blank" data-link-image="<?= $ar_picture['SOURCE_PICTURE']['SRC'] ?>">
                <img itemprop="image" src="<?= $ar_picture['SRC'] ?>" alt="<?= $ar_picture['ALT'] ?>" alt="<?= $ar_picture['TITLE'] ?>" />
              </a>
              <?*/ ?>
            <? } ?>
          </div>
          <div class="popup review-images__popup">
            <img src="" alt="">
            <button class="popup-form__popup_close"></button>
          </div>
        <? } ?>
      </div>
    <? } ?>
  </div>
  <?
  if ($arParams["DISPLAY_BOTTOM_PAGER"]) {
  ?>
    <div class="<?= "js_nav_string_" . $arResult['NAV_RESULT']->NavNum; ?>">
      <?
      echo $arResult["NAV_STRING"];
      ?>
    </div>
  <?
  }
  ?>
<? } ?>