<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

<?if(!empty($arResult["ITEMS"])){?>
<section class="main-stories-slider">
        <div class="container">
            <div class="section__head">
                <h2 class="h3 section__title">Добрые истории</h2>
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
                    <div class="swiper-slide" id="<?=$this->GetEditAreaId($item['ID']);?>">
                        <div class="list-item main-stories-item">
                            <div data-lazy-bg="<?=$item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"]?>" class="main-stories-item__image"></div>
                            <div class="text-size-lg main-stories-item__text"><?=$item["PREVIEW_TEXT"]?>
                            </div>
                            <div class="main-stories-item__link-block"><a
                                        href="<?=$item["DETAIL_PAGE_URL"]?>" target="_self">
                                    <u>Подробнее</u>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-arrow">
                                        <use xlink:href="#arrow"></use>
                                    </svg>
                                </a></div>
                        </div>
                    </div>
                    <?}?>
                </div>
            </div>
            <div class="section__nav"><a href="/news/?set_filter=y&newsFilter_71_4196041389=Y">
                    <u>Узнать больше историй</u>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                         class="icon icon-arrow">
                        <use xlink:href="#arrow"></use>
                    </svg>
                </a></div>
        </div>
    </section>
<?}?>