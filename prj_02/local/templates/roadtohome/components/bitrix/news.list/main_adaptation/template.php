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

    <section class="main-children-slider">
        <div class="container">
            <div class="section__head">
                <div class="section__head-first">
                    <h2 class="h3 section__title">Взять ребенка в&nbsp;семью</h2><b class="text-color-gray">Городской
                        центр «Наши дети», г.&nbsp;Череповец</b>
                </div>
                <div class="section__nav mobile-hidden">
                    <div class="swiper-nav lg">
                        <button type="button" class="swiper-button prev">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 class="icon icon-drop-light">
                                <use xlink:href="#drop-light"></use>
                            </svg>
                        </button>
                        <button type="button" class="swiper-button next">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 class="icon icon-drop-light">
                                <use xlink:href="#drop-light"></use>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div class="items-list swiper-container">
                <div class="swiper-wrapper align-items-height">
            <? foreach ($arResult["ITEMS"] as $item) { ?>
                <?
                $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <div class="swiper-slide" id="<?= $this->GetEditAreaId($item['ID']); ?>">
                    <a href="<?=$item["DETAIL_PAGE_URL"]?>" target="_self"
                                             class="list-item main-children-item">
                        <div class="main-children-item__photo">
                            <picture><img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg"
                                          data-src="<?= $item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"] ?>"
                                          loading="lazy" alt="<?= $item["PREVIEW_PICTURE"]["ALT"] ?>"
                                          title="<?= $item["PREVIEW_PICTURE"]["TITLE"] ?>"/>
                            </picture>
                        </div>
                        <div class="text-size-lg main-children-item__name"><?=$item["NAME"]?><?if($item["DISPLAY_PROPERTIES"]["BIRTH_DATE"]["DISPLAY_VALUE"]){?>, <?=$item["DISPLAY_PROPERTIES"]["BIRTH_DATE"]["DISPLAY_VALUE"]?> лет<?}?>
                        </div>
                    </a>
                </div>
            <? } ?>

                </div>
            </div>
            <div class="section__nav"><a href="/how_to_adopt/" target="_self">
                    <u>Как взять ребенка в семью</u>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                         class="icon icon-arrow">
                        <use xlink:href="#arrow"></use>
                    </svg>
                </a></div>
        </div>
    </section>

<? } ?>