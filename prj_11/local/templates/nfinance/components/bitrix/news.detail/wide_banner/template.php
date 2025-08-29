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
    <!-- begin .wide-banner-->
    <div class="wide-banner wide-banner_type_full wide-banner_indent_s">
        <div class="wide-banner__background">
            <picture class="wide-banner__picture">
                <source srcset="<?=SITE_TEMPLATE_PATH?>/assets/blocks/wide-banner/images/bg-3.png" type="image/png" media="(max-width: 479px)" class="wide-banner__source">
                <source srcset="<?=SITE_TEMPLATE_PATH?>/assets/blocks/wide-banner/images/bg-3-m.png" type="image/png" media="(max-width: 1024px)" class="wide-banner__source">
                <img src="<?=SITE_TEMPLATE_PATH?>/assets/blocks/wide-banner/images/bg-1.png" alt="image" class="wide-banner__image" title="">
            </picture>
        </div>
        <div class="wide-banner__container">
            <div class="wide-banner__wrapper">
                <div class="wide-banner__content">
                    <div class="wide-banner__title">
                        <?=htmlspecialchars_decode($arResult["PROPERTIES"]["TITLE"]["VALUE"]["TEXT"])?>
                    </div>
                    <div class="wide-banner__text">
                        <?=htmlspecialchars_decode($arResult["PREVIEW_TEXT"])?>
                    </div>
                    <div class="wide-banner__controls">
                        <div class="wide-banner__control">
                            <?
                                $buttonText = !empty($arParams["BUTTON_TEXT"]) ? $arParams["BUTTON_TEXT"] : "";
                                $buttonText = !empty($arResult["PROPERTIES"]["BUTTON_NAME"]["VALUE"]) ? $arResult["PROPERTIES"]["BUTTON_NAME"]["VALUE"] : $buttonText;
                                $buttonLink = !empty($arParams["BUTTON_LINK"]) ? $arParams["BUTTON_LINK"] : "";
                                $buttonLink = !empty($arResult["PROPERTIES"]["BUTTON_LINK"]["VALUE"]) ? $arResult["PROPERTIES"]["BUTTON_LINK"]["VALUE"] : $buttonLink;
                                $buttonShow = !empty($arParams["BUTTON_SHOW"]) ? $arParams["BUTTON_SHOW"] : false;
                                $isDownload = !empty($arParams["DOWNLOAD_BUTTON"]) ? $arParams["DOWNLOAD_BUTTON"] : false;
                                $showDownloadIcon = !empty($arParams["DOWNLOAD_ICON"]) ? $arParams["DOWNLOAD_ICON"] : false;
                                $isModal = mb_substr($buttonLink, 0, 1) === '#';
                            ?>
                            <!-- begin .button-->
                            <?if($buttonShow && !empty($buttonLink) && !empty($buttonText)):?>
                                <?if($isDownload):?>
                                    <a class="button" href="<?=$buttonLink?>" download>
                                        <span class="button__holder">
                                            <span class="button__text"><?=$buttonText?></span>
                                            <svg class="button__icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.99967 14.1667V2.5M16.6663 17.5H3.33301M14.1663 10L9.99884 14.1675L5.83217 10" stroke="currentColor" fill="transparent" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                                        </span>
                                    </a>
                                <?else:?>
                                    <a class="button <?=($isModal ? 'js-modal' : '')?>" href="<?=$buttonLink?>">
                                        <span class="button__holder">
                                            <span class="button__text"><?=$buttonText?></span>
                                            <?if($showDownloadIcon):?>
                                                <svg class="button__icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.99967 14.1667V2.5M16.6663 17.5H3.33301M14.1663 10L9.99884 14.1675L5.83217 10" stroke="currentColor" fill="transparent" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                                            <?endif;?>
                                        </span>
                                    </a>
                                <?endif;?>
                            <?endif;?>
                            <!-- end .button-->
                        </div>
                        <?if(!empty($arResult["PROPERTIES"]["MORE_BUTTON_TEXT"]["VALUE"]) && !empty($arResult["PROPERTIES"]["MORE_BUTTON_LINK"]["VALUE"])):?>
                            <div class="wide-banner__control">
                                <!-- begin .button-->
                                <a class="button" href="<?=$arResult["PROPERTIES"]["MORE_BUTTON_LINK"]["VALUE"]?>">
                                    <span class="button__holder">
                                        <span class="button__text">
                                            <?=$arResult["PROPERTIES"]["MORE_BUTTON_TEXT"]["VALUE"]?>
                                        </span>
                                    </span>
                                </a>
                                <!-- end .button-->
                            </div>
                        <?endif;?>
                    </div>
                </div>
                <div class="wide-banner__illustration">
                    <!-- begin .tippy-->
                    <?if(!empty($arResult["PROPERTIES"]["TIPPY_SECONDARY_NAME"]["VALUE"]["TEXT"])):?>
                        <div class="tippy tippy_style_secondary">
                            <div class="tippy__content">
                                <div class="tippy__icon">!
                                </div>
                                <div class="tippy__container">
                                    <div class="tippy__name">
                                        <?=htmlspecialchars_decode($arResult["PROPERTIES"]["TIPPY_SECONDARY_NAME"]["VALUE"]["TEXT"])?>
                                    </div>
                                    <div class="tippy__role">
                                        <?=htmlspecialchars_decode($arResult["PROPERTIES"]["TIPPY_SECONDARY_DESC"]["VALUE"]["TEXT"])?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?endif;?>
                    <!-- end .tippy-->
                    <picture class="wide-banner__picture">
                        <?if(!empty($arResult["PREVIEW_PICTURE"])):?>
                            <source srcset="<?= $arResult["PREVIEW_PICTURE"]["SRC"] ?>"
                                    type="image/png" media="(max-width: 480px)"
                                    class="wide-banner__source"/>
                        <?endif;?>

                        <?$imagePath = ''?>
                        <?if(!empty($arResult["PROPERTIES"]["IMAGE_XS"]["VALUE"])):?>
                            <?$imagePath = \CFile::GetPath($arResult["PROPERTIES"]["IMAGE_XS"]["VALUE"]);?>
                            <source srcset="<?=$imagePath?>"
                                type="image/png"
                                media="(max-width: 479px)"
                                class="wide-banner__source"
                            />
                        <?endif;?>
                        <?if(!empty($arResult["PROPERTIES"]["IMAGE_S"]["VALUE"])):?>
                            <?$imagePath = \CFile::GetPath($arResult["PROPERTIES"]["IMAGE_S"]["VALUE"]);?>
                            <source srcset="<?=$imagePath?>"
                                type="image/png"
                                media="(max-width: 767px)"
                                class="wide-banner__source"
                            />
                        <?endif;?>
                        <?if(!empty($arResult["PROPERTIES"]["IMAGE_M"]["VALUE"])):?>
                            <?$imagePath = \CFile::GetPath($arResult["PROPERTIES"]["IMAGE_M"]["VALUE"]);?>
                            <source srcset="<?=$imagePath?>"
                                type="image/png"
                                media="(max-width: 1280px)"
                                class="wide-banner__source"
                            />
                        <?endif;?>
                        <?if(!empty($arResult["DETAIL_PICTURE"])):?>
                            <?$imagePath = $arResult["DETAIL_PICTURE"]["SRC"];?>
                        <?endif;?>
                        <img
                            src="<?=$imagePath?>"
                            alt="<?=$arResult["NAME"]?>"
                            class="wide-banner__image"
                        />
                    </picture>
                </div>
            </div>
        </div>
    </div>
    <!-- end .wide-banner-->
<?endif;?>