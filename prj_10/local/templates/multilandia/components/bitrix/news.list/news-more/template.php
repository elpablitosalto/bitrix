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
<?if($arResult["ITEMS"]):?>
    <section class="ml-section">
        <div class="container">
            <div class="ml-section-header">
                <h2 class="ml-section-title"><?=$arParams["TITLE"] ? : "Похожие новости"; ?></h2>
                <a class="ml-btn ml-btn_round ml-btn_green ml-section-btn" href="<?=$arParams["ALL_LINK"] ? : "#"; ?>"><?=$arParams["ALL_NEWS"] ? : "Все новости"; ?></a>
            </div>
            <div class="ml-section-body">
                <div class="ml-slider" data-desktop-items="4" data-theme="green">
                    <div class="ml-slider__container">
                        <div class="ml-slider__wrapper">
                            <?foreach($arResult["ITEMS"] as $arItem):?>
                            <?
                                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                            ?>
                            <div class="ml-slider__item">
                                <div class="anim-item anim-item_article">
                                    <a class="anim-item__link" href="<?echo $arItem["DETAIL_PAGE_URL"]?>">
                                        <div class="anim-item__img">
                                            <img class="lazyload" data-src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?echo $arItem["NAME"]?>"/>
                                            <?if($arItem["PROPERTIES"]["VOZRAST"]["VALUE"]):?>
                                                <span class="age-limit-label age-limit-label_light"><?=$arItem["PROPERTIES"]["VOZRAST"]["VALUE"]?></span>
                                            <?endif;?>
                                        </div>
                                        <div class="anim-item__caption">
                                            <p class="anim-item__title"><?echo $arItem["NAME"]?></p>
                                            <time class="anim-item__date" datetime="<? echo FormatDate("Y-m-d", MakeTimeStamp($arItem["ACTIVE_FROM"])); ?>"><? echo FormatDate("j F Y", MakeTimeStamp($arItem["ACTIVE_FROM"])); ?></time>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <?endforeach;?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ml-section-footer">
                <a class="ml-btn ml-btn_round ml-btn_green ml-section-btn" href="<?=$arParams["ALL_LINK"] ? : "#"; ?>"><?=$arParams["ALL_NEWS"] ? : "Все новости"; ?></a>
            </div>
        </div>
    </section>
<?endif;?>
