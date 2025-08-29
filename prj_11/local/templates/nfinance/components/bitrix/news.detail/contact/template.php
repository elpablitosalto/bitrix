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
$this->setFrameMode(true);?>
<?if(!empty($arResult)):?>
<!-- begin .banner-->
<div class="banner banner_text-size_s banner_style_primary banner_layout_secondary banner_background-pointer_visible">
    <div class="banner__wrapper">
        <div class="banner__background">
            <picture class="banner__picture">
                <?if(!empty($arResult["DETAIL_PICTURE"])):?>
                    <img src="<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>" alt="<?=$arResult["NAME"]?>" class="banner__image" title=""/>
                <?endif;?>
            </picture>
        </div>
        <div class="banner__icons">
            <img class="banner__icon banner__icon_type_main banner__icon_size_l" src="<?=SITE_TEMPLATE_PATH?>/assets/blocks/banner/images/icon-lamp.svg" role="presentation" alt="">
        <div class="banner__content">
            <div class="banner__title">
                <span class="highlight"><?=htmlspecialchars_decode($arResult["PROPERTIES"]["TITLE"]["VALUE"]["TEXT"])?></span>
            </div>
            <div class="banner__text">
                <?=htmlspecialchars_decode($arResult["PREVIEW_TEXT"])?>
            </div>
            <ul class="list list_layout_desktop-horizontal list_weight_medium list_text-size_l list_style_secondary banner__bullet-list">
                <?if(!empty($arResult["PROPERTIES"]["TELEGRAM"]["VALUE"])):?>
                    <li class="list__item list__item_no_bullet list__item_has_icon">
                        <div class="list__icon-wrapper">
                            <svg class="list__icon">
                                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/icon.svg#icon_contained-telegram"></use>
                            </svg>
                        </div>
                        <div class="list__text">
                            <a class="link link_style_ninja" target="_blank" href="https://t.me/<?=str_replace("@", "", $arResult["PROPERTIES"]["TELEGRAM"]["VALUE"])?>"><?=$arResult["PROPERTIES"]["TELEGRAM"]["VALUE"]?></a>
                        </div>
                    </li>
                <?endif;?>

                <?if(!empty($arResult["PROPERTIES"]["WHATSAPP"]["VALUE"])):?>
                    <li class="list__item list__item_no_bullet list__item_has_icon">
                        <div class="list__icon-wrapper">
                            <svg class="list__icon">
                                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/icon.svg#icon_contained-whatsapp"></use>
                            </svg>
                        </div>
                        <div class="list__text"><a class="link link_style_ninja" href="https://wa.me/<?=filter_var($arResult["PROPERTIES"]["WHATSAPP"]["VALUE"], FILTER_SANITIZE_NUMBER_INT)?>" target="_blank"><?=$arResult["PROPERTIES"]["WHATSAPP"]["VALUE"]?></a>
                        </div>
                    </li>
                <?endif;?>

                 <?if(!empty($arResult["PROPERTIES"]["EMAIL"]["VALUE"])):?>
                    <li class="list__item">
                        <div class="list__text"><a class="link link_style_ninja" href="mailto:<?=$arResult["PROPERTIES"]["EMAIL"]["VALUE"]?>"><?=$arResult["PROPERTIES"]["EMAIL"]["VALUE"]?></a>
                        </div>
                    </li>
                <?endif;?>
            </ul>
        </div>
    </div>
</div>
<!-- end .banner-->
<?endif;?>