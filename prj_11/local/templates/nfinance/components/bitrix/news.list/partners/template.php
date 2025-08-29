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
    <!-- 2 списка партнеров в каждом по 10 элементов. Для корректного зацикливания нужно выводить каждый спискок х2, остальные будут автоматически переставляться-->
<?if(!empty($arResult["ITEMS"])):?>
    <div class="section section_space_close">
        <div class="section__header section__header_type_inline">
            <div class="section__title">
                <!-- begin .title-->
                <h2 class="title title_size_h2">
                    Наши партнеры
                </h2>
                <!-- end .title-->
            </div>
        </div>
        <div class="section__content">
            <div class="section__following">
                <!-- begin .following-partners-->
                <div class="following-partners">
                    <div class="following-partners__container swiper js-partners-carousel">
                        <div class="following-partners__wrapper swiper-wrapper">
                            <?$firstPart = array_splice($arResult["ITEMS"], 0, 10);?>
                            <?foreach(range(0, 1) as $index):?>
                                <?foreach($firstPart as $arItem):?>
                                    <?
                                        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                                        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                                    ?>
                                    <div id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="following-partners__slide swiper-slide">
                                        <span class="following-partners__illustration">
                                          <picture class="following-partners__picture">
                                              <img
                                                  src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>"
                                                  class="following-partners__image" title="" loading="lazy"/>
                                          </picture>
                                        </span>
                                    </div>
                                <?endforeach;?>
                            <?endforeach;?>
                        </div>
                    </div>
                    <div class="following-partners__container following-partners__container_direction_reverse swiper js-partners-carousel-reverse">
                        <div class="following-partners__wrapper swiper-wrapper">
                            <?$secondPart = array_splice($arResult["ITEMS"], 0, 10);?>
                            <?foreach(range(0, 1) as $index):?>
                                <?foreach($secondPart as $arItem):?>
                                    <?
                                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                                    ?>
                                    <div id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="following-partners__slide swiper-slide">
                                        <span class="following-partners__illustration">
                                          <picture class="following-partners__picture">
                                              <img
                                                  src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>"
                                                  class="following-partners__image" title="" loading="lazy"/>
                                          </picture>
                                        </span>
                                    </div>
                                <?endforeach;?>
                            <?endforeach;?>
                        </div>
                    </div>
                </div>
                <!-- end .following-partners-->
            </div>
        </div>
    </div>
<?endif;?>