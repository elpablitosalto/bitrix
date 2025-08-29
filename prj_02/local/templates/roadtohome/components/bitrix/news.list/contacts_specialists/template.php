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
//echo '!!';
?>
<? if (!empty($arResult["ITEMS"])) { ?>
  <? if ($arParams["AJAX_LOAD"] != "Y") { ?>
    <div class="nav_result_<?= $arResult['NAV_RESULT']->NavNum ?>">
    <? } ?>
    <?
    foreach ($arResult["ITEMS"] as $item) {
      if (empty($arResult['SPECIALISTS'][$item['ID']])) {
        continue;
      }
      $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
      $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>
      <section class="employees" id="<?= $this->GetEditAreaId($item['ID']); ?>">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <h3 class="employee-card-title"><?= $item["NAME"] ?></h3>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="employee-card-list">
                <? foreach ($arResult['SPECIALISTS'][$item['ID']] as $spec) { ?>
                  <?/* TODO edit link */ ?>
                  <div class="employee-card">
                    <? if (!empty($spec["PREVIEW_PICTURE"])) { ?>
                      <div class="employee-card__img">
                        <picture>
                          <img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= $spec["PREVIEW_PICTURE"] ?>" loading="lazy" alt="<?= $spec["NAME"] ?>" title="<?= $spec["NAME"] ?>" />
                        </picture>
                      </div>
                    <? } ?>
                    <div class="employee-card__title"><?= $spec["NAME"] ?></div>
                    <? if (!empty($spec["POSITION"])) { ?>
                      <div class="employee-card__desc"><?= $spec["POSITION"] ?></div>
                    <? } ?>
                    <? if (!empty($spec["PHONE"])) { ?>
                      <a href="tel:<?= $spec["PHONE"] ?>" class="employee-card__phone"><?= $spec["PHONE"] ?></a>
                    <? } ?>
                    <? if (!(empty($spec["EMAIL"]) && empty($spec["PREVIEW_TEXT"]))) { ?>
                      <a data-modal="#modal-team-<?= $spec["ID"] ?>" class="employee-card__link">Подробнее</a>
                      <div id="modal-team-<?= $spec["ID"] ?>" class="modal modal-team">
                        <button type="button" data-fancybox-close="data-fancybox-close" class="modal-close">
                          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-close">
                            <use xlink:href="#close"></use>
                          </svg>
                        </button>
                        <div class="modal-team__wrapper">
                          <!--.modal-team__decor-->
                          <div class="modal-team__image">
                            <div class="modal-team__img-wrapper">
                              <picture class="modal-team__main-image">
                                <img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= $spec["PREVIEW_PICTURE"] ?>" loading="lazy" alt="<?= $spec["NAME"] ?>" title="<?= $spec["NAME"] ?>" />
                              </picture>
                            </div>
                          </div>
                          <div class="modal-team__rside">
                            <div class="modal-team__title"><?= $spec["NAME"] ?></div>
                            <? if (!empty($spec["POSITION"])) { ?>
                              <div class="modal-team__job"><?= $spec["POSITION"] ?></div>
                            <? } ?>
                            <? if (!empty($spec["PHONE"])) { ?>
                              <div class="modal-team__phone">Телефон:&nbsp;<a><?= $spec["PHONE"] ?></a></div>
                            <? } ?>
                            <? if (!empty($spec["EMAIL"])) { ?>
                              <div class="modal-team__email">E-mail:&nbsp;<a><?= $spec["EMAIL"] ?></a></div>
                            <? } ?>
                            <? if (!empty($spec["PREVIEW_TEXT"])) { ?>
                              <div class="modal-team__info"><?= $spec["PREVIEW_TEXT"] ?></div>
                            <? } ?>
                          </div>
                        </div>
                      </div>
                    <? } ?>
                  </div>
                <? } ?>
              </div>
            </div>
          </div>
        </div>
      </section>
    <? } ?>
    <? if ($arParams["AJAX_LOAD"] != "Y") { ?>
    </div>
  <? } ?>
<? } ?>
<? if ($arParams["DISPLAY_BOTTOM_PAGER"]) {
  echo $arResult["NAV_STRING"];
} ?>