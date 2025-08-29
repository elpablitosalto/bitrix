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
?>
<? if (!empty($arResult["ITEMS"])): ?>
  <div class="cards-panel cards-panel_layout_s cards-panel_indent_s">
    <div class="cards-panel__container">
      <div class="cards-panel__wrapper js_list_wrapper js_nav_result_<?= $arResult['NAV_RESULT']->NavNum ?>">
        <? foreach ($arResult["ITEMS"] as $arItem): ?>
          <?
          $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
          $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
          //$imgCode = 'FAVORITE_IMAGE';
          $imgCode = 'POST_IMG';
          if (!empty($arItem["PROPERTIES"][$imgCode]["VALUE"])) {
            $backgroundImg = \CFile::GetPath($arItem["PROPERTIES"][$imgCode]["VALUE"]);
          }
          if (!is_file($_SERVER["DOCUMENT_ROOT"] . $backgroundImg)) {
            $backgroundImg = SITE_TEMPLATE_PATH . "/assets/blocks/news-card/images/1.png";
          }
          ?>
          <div class="cards-panel__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
            <!-- begin .news-card-->
            <div class="news-card cards-panel__panel">
              <div class="news-card__content">
                <div class="news-card__illustration">
                  <picture class="news-card__picture">
                    <img
                      src="<?= $backgroundImg ?>"
                      alt="<?= $arItem["NAME"] ?>"
                      class="news-card__image"
                      title="" />
                  </picture>
                </div>
                <div class="news-card__main">
                  <div class="news-card__tag">
                    <!-- begin .label-->
                    <? if (!empty($arItem["SECTION_NAME"])): ?>
                      <div class="label label_style_dashed">
                        <?= $arItem["SECTION_NAME"] ?>
                      </div>
                    <? endif; ?>
                    <!-- end .label-->
                  </div>
                  <div class="news-card__date">
                    <?= $arItem['DATE']; ?>
                  </div>
                  <div class="news-card__title"> <?= $arItem["NAME"] ?>
                  </div>
                  <div class="news-card__controls">
                    <div class="news-card__control">
                      <!-- begin .button-->
                      <a class="button button_role_article" href="<?= $arItem["DETAIL_PAGE_URL"] ?>"><span class="button__holder"><span class="button__text">Читать</span></span></a>
                      <!-- end .button-->
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- end .news-card-->
          </div>
        <? endforeach; ?>
      </div>
      <?/*?>
      <? if (!empty($arResult["NAV_RESULT"]->NavPageCount) && $arResult["NAV_RESULT"]->NavPageCount > 0): ?>
        <?= $arResult["NAV_STRING"] ?>
      <? endif; ?>
      <?*/ ?>
      <?
      $navNum = $arResult['NAV_RESULT']->NavNum;
      ?>
      <div class="js_nav_string <?= "js_nav_string_" . $navNum; ?>">
        <?
        echo $arResult["NAV_STRING"];
        ?>
      </div>
    </div>
  </div>
<? endif; ?>