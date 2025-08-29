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
<? if(!empty($arResult["ITEMS"])): ?>
<div class="section <?=(!empty($arParams['SECTION_CLASS']) ? $arParams['SECTION_CLASS'] : '')?>">
    <div class="section__header section__header_type_inline">
        <div class="section__title">
            <!-- begin .title-->
            <div class="title title_size_h1"><?=$arParams["TITLE"]?></div>
            <!-- end .title-->
        </div>
    </div>
    <div class="section__content">
        <div class="section__logo-carousel">
            <!-- begin .logo-carousel-->
            <div class=" <?=(!empty($arParams['SLIDER_WRAP_CLASS']) ? $arParams['SLIDER_WRAP_CLASS'] : 'logo-carousel')?>">
                <div class="<?=(!empty($arParams['SLIDER_ABOUT_CLASS']) ? "logo-carousel-about__container" : 'logo-carousel__container')?> swiper <?=(!empty($arParams['SLIDER_JS_CLASS']) ? $arParams['SLIDER_JS_CLASS'] : 'js-logo-carousel')?>">
                    <div class=" <?=(!empty($arParams['SLIDER_ABOUT_CLASS']) ? "logo-carousel-about__wrapper" : 'logo-carousel__wrapper')?> swiper-wrapper">
                        <?foreach($arResult["ITEMS"] as $arElement):?>
                            <div class=" <?=(!empty($arParams['SLIDER_ABOUT_CLASS']) ? "logo-carousel-about__slide" : 'logo-carousel__slide')?>  swiper-slide">
                            <span class="logo-carousel__illustration">
                                <picture class="logo-carousel__picture">
                                    <img
                                        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                                        data-src="<?=$arElement["PREVIEW_PICTURE"]["SRC"]?>"
                                        alt="<?=$arElement["NAME"]?>"
                                        class="logo-carousel__image swiper-lazy"
                                    />
                                </picture>
                            </span>
                        </div>
                        <?endforeach;?>
                    </div>
                    <div class="logo-carousel__navigation">
                        <div class="logo-carousel__arrows">
                            <!-- begin .carousel-nav-->
                            <div
                                class="carousel-nav carousel-nav_position_sides js-carousel-nav"
                                data-nav-scope=".logo-carousel"
                                data-nav-target=".swiper"
                            >
                                <div class="carousel-nav__control">
                                    <button
                                        type="button"
                                        class="carousel-nav__arrow carousel-nav__arrow_type_prev js-carousel-nav-prev"
                                    >
                                        Предыдущий слайд
                                    </button>
                                </div>
                                <div class="carousel-nav__control">
                                    <button
                                        type="button"
                                        class="carousel-nav__arrow carousel-nav__arrow_type_next js-carousel-nav-next"
                                    >
                                        Следующий слайд
                                    </button>
                                </div>
                            </div>
                            <!-- end .carousel-nav-->
                        </div>
                    </div>
                </div>
                <?if(!empty($arParams["FORM"])):?>
                    <div class="logo-carousel__controls">
                        <div class="logo-carousel__control">
                            <!-- begin .button-->
                            <a
                                class="button button_width_full button_size_l button_text-size_l js-modal js-modal_type"
                                href="#<?=$arParams["FORM"]["CODE"]?>"
                            >
                                <span class="button__holder"><?=$arParams["FORM"]["NAME"]?></span>
                            </a>
                            <!-- end .button-->
                        </div>
                    </div>
                <?endif;?>
            </div>
            <!-- end .logo-carousel-->
        </div>
    </div>
</div>
<? endif; ?>
