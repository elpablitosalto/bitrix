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
  <div class="page__section">
    <div class="page__holder">
      <!-- begin .section-->
      <div class="section">
        <? if(!empty($arParams["TITLE"])): ?>
          <div class="section__header section__header_type_inline">
            <div class="section__title">
              <!-- begin .title-->
              <h2 class="title title_size_h2"><?=$arParams["TITLE"]?></h2>
              <!-- end .title-->
            </div>
          </div>
        <? endif; ?>
        <div class="section__content">
          <div class="section__description-panel">
            <!-- begin .description-panel-->
            <div class="description-panel">
              <div class="description-panel__container">
                <div class="description-panel__wrapper">
                  <? foreach ($arResult["ITEMS"] as $arItem): ?>
                    <?
                      $iconId = !empty($arItem["PROPERTIES"]["ICON"]["VALUE"]) ? $arItem["PROPERTIES"]["ICON"]["VALUE"] : '';
                      $iconSRC = '';
                      if(!empty($iconId)) {
                        $iconFileArray = CFile::GetFileArray($iconId);
                        $renderIcon = CFile::ResizeImageGet(
                          $iconFileArray,
                          Array("width" => 100, "height" => 100),
                          BX_RESIZE_IMAGE_PROPORTIONAL_ALT , true
                        );
                        $iconSRC = $renderIcon['src'];
                      }
                    ?>
                    <div class="description-panel__item">
                      <!-- begin .list-item-->
                      <div class="list-item list-item_icon-size_l list-item_icon-border_gray list-item_text-size_xl">
                        <div class="list-item__wrapper">
                          <? if(!empty($iconSRC)): ?>
                            <div class="list-item__icon">
                              <img src="<?=$iconSRC?>" class="list-item__icon-image" />
                            </div>
                          <? endif; ?>
                          <div class="list-item__highlight"><?=$arItem["NAME"]?></div>
                          <div class="list-item__text"><?=$arItem["PREVIEW_TEXT"]?></div>
                        </div>
                      </div>
                      <!-- end .list-item-->
                    </div>
                  <? endforeach; ?>
                </div>
              </div>
            </div>
            <!-- end .description-panel-->
          </div>
        </div>
      </div>
      <!-- end .section-->
    </div>
  </div>
<? endif; ?>