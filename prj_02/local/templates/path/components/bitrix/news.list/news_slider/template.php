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
//vardump($arResult["ITEMS"]);
if (!empty($arResult["ITEMS"])) {
    ?>

    <section class="wrapper rs__news">
        <div class="container">
            <div class="rs__content">
                <div class="rs__content--top">
                    <div class="rs__section--title"><?=$arParams["HEADER"]?></div>
                    <div class="rs__slider--control">
                        <div class="rs__slider--control-prev"></div>
                        <div class="rs__slider--control-next"></div>
                    </div>
                </div>
                <div class="rs__materials--block swiper js--news-slider">
                    <div class="swiper-wrapper">
                        <? foreach ($arResult["ITEMS"] as $arItem) {
                            ?>
                            <?
                            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                            ?>
                            <div class="swiper-slide" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                                <div class="rs__materials--item">
                                    <picture class="rs__materials--pic<?if(!$arItem["PREVIEW_PICTURE"]["SRC"]) echo ' rs__materials--pic-bg';?>">
                                        <img src="<?= ($arItem["PREVIEW_PICTURE"]["SRC"])?$arItem["PREVIEW_PICTURE"]["SRC"]:SITE_TEMPLATE_PATH."/img/svg/magnet.svg"; ?>"  alt="<?= $arItem["NAME"]; ?>" title="<?= $arItem["NAME"]; ?>" class="rs__materials--img">
                                    </picture>
                                    <div class="rs__materials--info">
                                        <div class="rs__materials--chapter"><?= $arItem["DISPLAY_PROPERTIES"]["PUBLICATION_TYPE"]["VALUE"]; ?></div>
                                        <div class="rs__materials--title"><a href="<?= $arItem["DETAIL_PAGE_URL"]; ?>"><?= $arItem["NAME"]; ?></a>
                                        </div>
                                        <a href="<?= $arItem["DETAIL_PAGE_URL"]; ?>" class="rs__link rs__materials--link"><?= $arItem["DISPLAY_PROPERTIES"]["PUBLICATION_TYPE"]["VALUE"]; ?></a>
                                    </div>
                                </div>
                            </div>
                        <?
                        } ?>
                    </div>
                    <div class="is-hidden-tablet swiper-pagination"></div>
                </div>
                <div class="rs__button__group rs__section--nav">
                    <a class="rs__button__default rs__button--icon ico-arrow-main rs__button--icon-right"
                       href="<?=$arParams["MORE_LINK_URL"]?>"><?=$arParams["MORE_LINK_TITLE"]?></a>
                </div>
            </div>
        </div>
    </section>

    <?
}
//vardump($arResult);
?>