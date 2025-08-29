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

<? if (!empty($arResult["ITEMS"])) { ?>

    <section id="projects-detail-events" class="projects-detail-events">
        <div class="container">
            <div class="projects-detail-news-slider">
                <div class="section__head">
                    <h3 class="section__title"><?=$arParams["BLOCK_NAME"]?></h3>
                    <div class="section__nav">
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
                    <div class="swiper-wrapper">
                        <? foreach ($arResult["ITEMS"] as $item) { ?>
                            <?
                            $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
                            $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                            ?>
                            <div id="<?= $this->GetEditAreaId($item['ID']); ?>" class="swiper-slide">
                                <div class="list-item news-item"><a href="<?=$item["DETAIL_PAGE_URL"]?>" class="news-item__image">
                                        <?if($item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"]){?>
                                        <picture><img class="lazyload" src="<?=SITE_TEMPLATE_PATH?>/images/loader.svg" data-src="<?=$item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"]?>"
                                                      loading="lazy"
                                                      alt="<?=$item["PREVIEW_PICTURE"]["ALT"]?>"
                                                      title="<?=$item["PREVIEW_PICTURE"]["TITLE"]?>"/>
                                        </picture>
                                        <?}?>
                                    </a>
                                    <div class="h5 news-item__title"><a href="<?=$item["DETAIL_PAGE_URL"]?>"><?=$item["NAME"]?></a></div>
                                    <div class="news-item__info">
                                        <?if($item['DISPLAY_ACTIVE_FROM']){?>
                                        <span class="text-size-sm news-item__date"><?=$item['DISPLAY_ACTIVE_FROM']?></span>
                                        <?}?>
                                        <?if($item['DISPLAY_PROPERTIES']["AUDIENCE_TYPE"]["DISPLAY_VALUE"]){?>
                                        <span class="text-size-sm news-item__category"><?=$item['DISPLAY_PROPERTIES']["AUDIENCE_TYPE"]["DISPLAY_VALUE"]?></span>
                                        <?}?>
                                    </div>
                                </div>
                            </div>
                            <?
                        }
                        ?>
                    </div>
                </div>
                <div class="section__nav"><a href="/news/?set_filter=y&newsFilter_71_2367533627=Y">
                        <u><?=$arParams["ALL_NAME"]?></u>
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                             class="icon icon-arrow">
                            <use xlink:href="#arrow"></use>
                        </svg>
                    </a></div>
            </div>
        </div>
    </section>

<? } ?>