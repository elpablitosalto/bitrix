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

<div class="main-partners-slider">
    <div class="container">
        <div class="items-list swiper-container">
            <div class="swiper-wrapper align-items-height">

                <? foreach ($arResult["ITEMS"] as $item) { ?>
                    <?
                    $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>

                    <div class="swiper-slide">
                        <div class="list-item main-partners-item">
                            <div class="text-size-lg main-partners-item__text"><?=$item["PREVIEW_TEXT"]?></div>
                            <div class="main-partners-item__person">
                                <div class="main-partners-item__person-photo">
                                    <picture><img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg"
                                                   data-src="<?= $item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"] ?>"
                                                   loading="lazy" alt="<?= $item["PREVIEW_PICTURE"]["ALT"] ?>"
                                    </picture>
                                </div>
                                <div class="main-partners-item__person-content">
                                    <div class="h6 main-partners-item__person-name"><?= $item["NAME"] ?>
                                    </div>
                                    <div class="text-size-sm main-partners-item__person-info">
                                        <?= $item["DISPLAY_PROPERTIES"]["POSITION"]["DISPLAY_VALUE"] ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <? } ?>

            </div>
        </div>
        <div class="swiper-nav lg desktop-visible">
          <button type="button" class="swiper-button prev">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-drop-light">
              <use xlink:href="#drop-light"></use>
            </svg>
          </button>
          <button type="button" class="swiper-button next">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-drop-light">
              <use xlink:href="#drop-light"></use>
            </svg>
          </button>
        </div>
        <div class="swiper-pagination desktop-hidden"></div>
    </div>
</div>


