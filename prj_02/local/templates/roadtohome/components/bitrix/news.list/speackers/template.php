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
//vardump($arResult["ITEMS"]);
?>
<? if (!empty($arResult["ITEMS"])) { ?>
  <section class="employees">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h3 class="employee-card-title">Спикеры</h3>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="employee-card-list">
            <?
            //foreach ($arResult['SPECIALISTS'][$item['ID']] as $spec) { 
            foreach ($arResult["ITEMS"] as $item) {
            ?>
              <?
              $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
              $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
              ?>
              <?/* TODO edit link */ ?>
              <div class="employee-card" id="<?= $this->GetEditAreaId($item['ID']); ?>">
                <? if (strlen( $item["PICTURE"]['SRC'] ) > 0) { ?>
                  <div class="employee-card__img">
                    <picture>
                      <img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= $item["PICTURE"]['SRC'] ?>" loading="lazy" alt="<?= $item["PICTURE"]["ALT"] ?>" title="<?= $item["PICTURE"]["TITLE"] ?>" />
                    </picture>
                  </div>
                <? } ?>
                <div class="employee-card__title"><?= $item["NAME"] ?></div>
                <? if (!empty($item['DISPLAY_PROPERTIES']["POSITION"]['VALUE'])) { ?>
                  <div class="employee-card__desc"><?= $item['DISPLAY_PROPERTIES']["POSITION"]['VALUE'] ?></div>
                <? } ?>
                <? if (!empty($item['DISPLAY_PROPERTIES']["PHONE"]['VALUE'])) { ?>
                  <a href="tel:<?= preg_replace('![^0-9]+!', '', $item['DISPLAY_PROPERTIES']["PHONE"]['VALUE']) ?>" class="employee-card__phone"><?= $item['DISPLAY_PROPERTIES']["PHONE"]['VALUE'] ?></a>
                <? } ?>
                <? if (!(empty($item['DISPLAY_PROPERTIES']["EMAIL"]['VALUE']) && empty($item["PREVIEW_TEXT"]))) { ?>
                  <a data-modal="#modal-team-<?= $item["ID"] ?>" class="employee-card__link">Подробнее</a>
                  <div id="modal-team-<?= $item["ID"] ?>" class="modal modal-team">
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
                            <img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= $item["PICTURE"]['SRC'] ?>" loading="lazy" alt="<?= $item["PICTURE"]["ALT"] ?>" title="<?= $item["PICTURE"]["TITLE"] ?>" />
                          </picture>
                        </div>
                      </div>
                      <div class="modal-team__rside">
                        <div class="modal-team__title"><?= $item["NAME"] ?></div>
                        <? if (!empty($item['DISPLAY_PROPERTIES']["POSITION"]['VALUE'])) { ?>
                          <div class="modal-team__job"><?= $item['DISPLAY_PROPERTIES']["POSITION"]['VALUE'] ?></div>
                        <? } ?>
                        <? if (!empty($item['DISPLAY_PROPERTIES']["PHONE"]['VALUE'])) { ?>
                          <div class="modal-team__phone">Телефон:&nbsp;<a><?= $item['DISPLAY_PROPERTIES']["PHONE"]['VALUE'] ?></a></div>
                        <? } ?>
                        <? if (!empty($item['DISPLAY_PROPERTIES']["EMAIL"]['VALUE'])) { ?>
                          <div class="modal-team__email">E-mail:&nbsp;<a><?= $item['DISPLAY_PROPERTIES']["EMAIL"]['VALUE'] ?></a></div>
                        <? } ?>
                        <? if (!empty($item["PREVIEW_TEXT"])) { ?>
                          <div class="modal-team__info"><?= $item["PREVIEW_TEXT"] ?></div>
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

<? if ($arParams["DISPLAY_BOTTOM_PAGER"]) {
  //echo $arResult["NAV_STRING"];
} ?>