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
<? foreach ($arResult["ITEMS"] as $arItem) : ?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>

    <div class="container">
        <section class="banner" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
            <a href="<?= $arItem["DISPLAY_PROPERTIES"]['LINK']['VALUE'] ?>">
                <?php
                $mobile_image = null;
                $mobile_image_type = null;
                $tablet_image = null;
                $tablet_image_type = null;
                $desktop_image = null;
                $desktop_image_type = null;

                if (!empty($arItem['DISPLAY_PROPERTIES']['MOBILE_IMAGE']['FILE_VALUE']['SRC']) && !empty($arItem['DISPLAY_PROPERTIES']['MOBILE_IMAGE']['FILE_VALUE']['CONTENT_TYPE'])) {
                    $mobile_image = $arItem['DISPLAY_PROPERTIES']['MOBILE_IMAGE']['FILE_VALUE']['SRC'];
                    $mobile_image_type = $arItem['DISPLAY_PROPERTIES']['MOBILE_IMAGE']['FILE_VALUE']['CONTENT_TYPE'];
                }

                if (!empty($arItem['DISPLAY_PROPERTIES']['TABLET_IMAGE']['FILE_VALUE']['SRC']) && !empty($arItem['DISPLAY_PROPERTIES']['TABLET_IMAGE']['FILE_VALUE']['CONTENT_TYPE'])) {
                    $tablet_image = $arItem['DISPLAY_PROPERTIES']['TABLET_IMAGE']['FILE_VALUE']['SRC'];
                    $tablet_image_type = $arItem['DISPLAY_PROPERTIES']['TABLET_IMAGE']['FILE_VALUE']['CONTENT_TYPE'];
                }

                if (!empty($arItem['DISPLAY_PROPERTIES']['DESKTOP_IMAGE']['FILE_VALUE']['SRC']) && !empty($arItem['DISPLAY_PROPERTIES']['DESKTOP_IMAGE']['FILE_VALUE']['CONTENT_TYPE'])) {
                    $desktop_image = $arItem['DISPLAY_PROPERTIES']['DESKTOP_IMAGE']['FILE_VALUE']['SRC'];
                    $arDesktopImage = $arItem['DISPLAY_PROPERTIES']['DESKTOP_IMAGE']['FILE_VALUE'];
                    $desktop_image_type = $arItem['DISPLAY_PROPERTIES']['DESKTOP_IMAGE']['FILE_VALUE']['CONTENT_TYPE'];
                }
                ?>

                <?php if (!empty($desktop_image)) : ?>
                    <?
                    $arSrcset = array();
                    $arSizes = array();
                    $srcset = '';
                    $sizes = '';
                    if (!empty($tablet_image)) {
                        if (!empty($mobile_image)) {
                            $arSrcset[] = $mobile_image . ' 576w';
                            $arSizes[] = '(max-width: 576px) 576px';
                        }
                        $arSrcset[] = $tablet_image . ' 991w';
                        $arSizes[] = '(max-width: 991px) 991px';
                    } elseif (!empty($mobile_image)) {
                        $arSrcset[] = $mobile_image . ' 991w';
                        //$arSrcset[] = $mobile_image . '';
                        $arSizes[] = '(max-width: 991px) 991px';
                    }
                    $arSrcset[] = $desktop_image . ' 992w';
                    $arSizes[] = '(min-width: 992px) 992px';
                    if (!empty($arSrcset)) {
                        $srcset = 'srcset="' . implode(", ", $arSrcset) . '"';
                    }
                    if (!empty($arSizes)) {
                        //$sizes = 'sizes="' . implode(", ", $arSizes) . '"';
                    }
                    ?>
                    <img class="rd-banner__image js_lazy_" src="<?= $desktop_image ?>" <?= $srcset; ?> <?= $sizes; ?> alt="<?= $arItem['NAME']; ?>" title="<?= $arItem['NAME']; ?>" width="<?=$arDesktopImage['WIDTH'];?>" height="<?=$arDesktopImage['HEIGHT'];?>" />
                <?php else : ?>
                    <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" class="full-img" alt="<?= $arItem['NAME']; ?>" title="<?= $arItem['NAME']; ?>" />
                <?php endif; ?>

                <?/*?>
                <?php if (!empty($desktop_image)) : ?>
                    <picture class="rd-banner__picture">
                        <? if (!empty($tablet_image)) : ?>
                            <? if (!empty($mobile_image)) : ?>
                                <source type="<?= $mobile_image_type ?>" media="(max-width: 576px)" srcset="<?= $mobile_image ?>">
                            <? endif; ?>

                            <source type="<?= $tablet_image_type ?>" media="(max-width: 991px)" srcset="<?= $tablet_image ?>">
                        <? elseif (!empty($mobile_image)) : ?>
                            <source type="<?= $mobile_image_type ?>" media="(max-width: 991px)" srcset="<?= $mobile_image ?>">
                        <? endif; ?>
                        <img alt class="rd-banner__image" src="<?= $desktop_image ?>">
                    </picture>
                <?php else : ?>
                    <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" class="full-img" />
                <?php endif; ?>
                <?*/?>

            </a>
            <!--    <div class="container">-->
            <!--        <div class="col-9 col-lg-7">-->
            <!--            <div class="banner__text">-->
            <!--                <p class="banner__text-title _hidden-mobile">--><? //=$arItem["NAME"]
                                                                                ?><!--</p>-->
            <!--                <p class="banner__text-title">--><? //=$arItem["PREVIEW_TEXT"];
                                                                    ?><!--</p>-->
            <!--                <a href="--><? //=$arItem["DISPLAY_PROPERTIES"]['LINK']['VALUE']
                                            ?><!--" class="rounded-button">Подробнее</a>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--    <div class="banner__picture"><img src="--><? //=$arItem["PREVIEW_PICTURE"]["SRC"]
                                                                ?><!--" /></div>-->
            <!--    <div class="banner__bg-image">-->
            <!--        <svg width="877" height="320" viewBox="0 0 877 320" fill="none" xmlns="http://www.w3.org/2000/svg">-->
            <!--            <mask id="mask0" mask-type="alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="877" height="320">-->
            <!--                <path d="M0 0H877L865.307 320H0V0Z" fill="#C4C4C4"/>-->
            <!--            </mask>-->
            <!--            <g mask="url(#mask0)">-->
            <!--                <g filter="url(#filter0_d)">-->
            <!--                    <ellipse cx="374" cy="117.134" rx="478" ry="447.103" fill="#3333CC"/>-->
            <!--                </g>-->
            <!--            </g>-->
            <!--            <defs>-->
            <!--                <filter id="filter0_d" x="-116" y="-349.969" width="996" height="934.206" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">-->
            <!--                    <feFlood flood-opacity="0" result="BackgroundImageFix"/>-->
            <!--                    <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/>-->
            <!--                    <feOffset dx="8"/>-->
            <!--                    <feGaussianBlur stdDeviation="10"/>-->
            <!--                    <feColorMatrix type="matrix" values="0 0 0 0 0.105882 0 0 0 0 0.101961 0 0 0 0 0.0941176 0 0 0 0.3 0"/>-->
            <!--                    <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow"/>-->
            <!--                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape"/>-->
            <!--                </filter>-->
            <!--            </defs>-->
            <!--        </svg>-->
            <!--    </div>-->
        </section>
    </div>
<?php endforeach; ?>