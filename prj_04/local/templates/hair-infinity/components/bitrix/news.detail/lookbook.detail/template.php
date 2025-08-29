<?
$bannerDesktop = CFile::ResizeImageGet($arResult['PROPERTIES']['TOP_BANNER_DESKTOP']['VALUE'], array('width'=>1920, 'height'=>530), BX_RESIZE_IMAGE_PROPORTIONAL, true);
$bannerMobile = CFile::ResizeImageGet($arResult['PROPERTIES']['TOP_BANNER_MOBILE']['VALUE'], array('width'=>480, 'height'=>180), BX_RESIZE_IMAGE_PROPORTIONAL, true);
?>
<div class="section section_spacing_top-close">
    <div class="section__header">
        <div class="section__container page__container">
            <div class="section__title">
                <!-- begin .title-->
                <h1 class="title title_size_h4 title_case_upper"><?=$arResult["NAME"]?></h1>
                <!-- end .title-->
            </div>
        </div>
    </div>
    <div class="section__content">
        <div class="page__container">
            <div class="section__content-section">
                <!-- begin .content-section-->
                <?if(!empty($arResult["PROPERTIES"]["GALLERY"]["VALUE"]) && is_array($arResult["PROPERTIES"]["GALLERY"]["VALUE"])):?>
                    <div class="content-section">
                        <div class="content-section__header">
                            <h2 class="content-section__title">
                                Создание образа
                            </h2>
                            <?if(!empty($arResult['DISPLAY_PROPERTIES']['INSTRUCTION']['LINK_ELEMENT_VALUE'])):?>
                                <?foreach ($arResult['DISPLAY_PROPERTIES']['INSTRUCTION']['LINK_ELEMENT_VALUE'] as $item):?>
                                    <?
                                        $arSelect = Array();
                                        $arFilter = Array("IBLOCK_ID"=>4, "ID"=>$item['ID']);
                                        $res = CIBlockElement::GetList(Array(), $arFilter, false);
                                        if($ar_res = $res->GetNextElement())
                                            $arProps = $ar_res->GetProperties();
                                        $href = CFile::GetPath($arProps['FILE']['VALUE']);
                                    ?>
                                    <div class="content-section__download-link">
                                        <a href="<?=$href?>" class="icon-link icon-link_icon-spacing_l icon-link_style_primary">
                                            <span class="icon-link__icon-wrapper">
                                                <svg class="icon-link__icon" width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M7.99996 11.5519C7.8633 11.5519 7.73263 11.4959 7.63863 11.3972L4.13863 7.73054C3.8353 7.4132 4.06063 6.8852 4.49996 6.8852H6.3333V3.05187C6.3333 2.59254 6.7073 2.21854 7.16663 2.21854H8.8333C9.29263 2.21854 9.66663 2.59254 9.66663 3.05187V6.8852H11.5C11.9393 6.8852 12.1646 7.4132 11.8613 7.73054L8.3613 11.3972C8.2673 11.4959 8.13663 11.5519 7.99996 11.5519Z"/>
                                                    <path d="M14.8333 15.5519H1.16667C0.523333 15.5519 0 15.0285 0 14.3852V14.0519C0 13.4085 0.523333 12.8852 1.16667 12.8852H14.8333C15.4767 12.8852 16 13.4085 16 14.0519V14.3852C16 15.0285 15.4767 15.5519 14.8333 15.5519Z"/>
                                                </svg>
                                            </span>
                                            <span class="icon-link__text">Скачать инструкцию</span>
                                        </a>
                                    </div>
                                <?endforeach;?>
                            <?endif;?>
                        </div>
                        <div class="content-section__content">
                            <div class="content-section__lookbook">
                                <!-- begin .lookbook-->
                                <div class="lookbook js-lookbook">
                                    <div class="lookbook__main">
                                        <div class="lookbook__background">
                                            <picture class="lookbook__picture">
                                                <img
                                                    src="<?= SITE_TEMPLATE_PATH ?>/mockup/dist/assets/blocks/lookbook/images/book.png"
                                                    alt="image"
                                                    class="lookbook__image"
                                                    title=""
                                                />
                                            </picture>
                                        </div>
                                        <div class="lookbook__pages js-lookbook-pages">
                                            <?foreach ($arResult["PROPERTIES"]["GALLERY"]["VALUE"] as $index => $image):?>
                                                <div class="lookbook__page js-lookbook-page">
                                                    <button type="button" class="lookbook__trigger js-lookbook-trigger">
                                                        Перелистнуть страницу
                                                    </button>
                                                    <div class="lookbook__illustration">
                                                        <picture class="lookbook__picture">
                                                            <img
                                                                src="<?=\CFile::GetPath($image) ?>"
                                                                alt="<?=$arResult["NAME"]?> <?=($index + 1)?>"
                                                                class="lookbook__image"
                                                            />
                                                        </picture>
                                                    </div>
                                                </div>
                                            <?endforeach;?>
                                            <div class="lookbook__flippable-pages js-lookbook-flippable-pages">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="lookbook__nav">
                                        <div class="lookbook__control">
                                            <button type="button" class="lookbook__arrow js-lookbook-prev">
                                                <svg class="lookbook__icon" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12.0466 21.4207C12.1921 21.2756 12.3075 21.1032 12.3863 20.9133C12.4651 20.7235 12.5056 20.52 12.5056 20.3145C12.5056 20.1089 12.4651 19.9054 12.3863 19.7156C12.3075 19.5258 12.1921 19.3534 12.0466 19.2082L3.7747 10.9395L12.0466 2.67072C12.34 2.37732 12.5048 1.97939 12.5048 1.56447C12.5048 1.14954 12.34 0.751614 12.0466 0.458218C11.7532 0.164822 11.3552 -3.86498e-06 10.9403 -3.88312e-06C10.5254 -3.90126e-06 10.1275 0.164822 9.83407 0.458218L0.459073 9.83322C0.313563 9.97836 0.198118 10.1508 0.119347 10.3406C0.0405774 10.5304 3.10048e-05 10.7339 3.09958e-05 10.9395C3.09868e-05 11.145 0.0405774 11.3485 0.119347 11.5383C0.198118 11.7282 0.313563 11.9006 0.459073 12.0457L9.83407 21.4207C9.97922 21.5662 10.1516 21.6817 10.3415 21.7604C10.5313 21.8392 10.7348 21.8798 10.9403 21.8798C11.1458 21.8798 11.3493 21.8392 11.5392 21.7604C11.729 21.6817 11.9014 21.5662 12.0466 21.4207Z"/>
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M21.8777 10.9395C21.8777 10.5251 21.7131 10.1276 21.42 9.8346C21.127 9.54157 20.7296 9.37695 20.3152 9.37695L4.69019 9.37695C4.27579 9.37695 3.87836 9.54157 3.58533 9.8346C3.29231 10.1276 3.12769 10.5251 3.12769 10.9395C3.12769 11.3539 3.29231 11.7513 3.58533 12.0443C3.87836 12.3373 4.27579 12.502 4.69019 12.502L20.3152 12.502C20.7296 12.502 21.127 12.3373 21.42 12.0443C21.7131 11.7513 21.8777 11.3539 21.8777 10.9395Z"/>
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="lookbook__control">
                                            <button type="button" class="lookbook__arrow js-lookbook-next">
                                                <svg class="lookbook__icon" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9.83111 21.4207C9.6856 21.2756 9.57016 21.1032 9.49139 20.9133C9.41262 20.7235 9.37207 20.52 9.37207 20.3145C9.37207 20.1089 9.41262 19.9054 9.49139 19.7156C9.57016 19.5258 9.6856 19.3534 9.83111 19.2082L18.103 10.9395L9.83111 2.67072C9.53772 2.37732 9.37289 1.97939 9.37289 1.56447C9.37289 1.14954 9.53772 0.751614 9.83111 0.458218C10.1245 0.164822 10.5224 -3.86498e-06 10.9374 -3.88312e-06C11.3523 -3.90126e-06 11.7502 0.164822 12.0436 0.458218L21.4186 9.83322C21.5641 9.97836 21.6796 10.1508 21.7583 10.3406C21.8371 10.5304 21.8777 10.7339 21.8777 10.9395C21.8777 11.145 21.8371 11.3485 21.7583 11.5383C21.6796 11.7282 21.5641 11.9006 21.4186 12.0457L12.0436 21.4207C11.8985 21.5662 11.726 21.6817 11.5362 21.7604C11.3464 21.8392 11.1429 21.8798 10.9374 21.8798C10.7318 21.8798 10.5283 21.8392 10.3385 21.7604C10.1487 21.6817 9.97626 21.5662 9.83111 21.4207Z"/>
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M-6.8299e-08 10.9395C-8.64131e-08 10.5251 0.16462 10.1276 0.457646 9.8346C0.750671 9.54157 1.1481 9.37695 1.5625 9.37695L17.1875 9.37695C17.6019 9.37695 17.9993 9.54157 18.2924 9.8346C18.5854 10.1276 18.75 10.5251 18.75 10.9395C18.75 11.3539 18.5854 11.7513 18.2924 12.0443C17.9993 12.3373 17.6019 12.502 17.1875 12.502L1.5625 12.502C1.1481 12.502 0.750672 12.3373 0.457646 12.0443C0.16462 11.7513 -5.0185e-08 11.3539 -6.8299e-08 10.9395Z"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- end .lookbook-->
                            </div>
                        </div>
                    </div>
                <?endif;?>
                <!-- end .content-section-->
            </div>
            <div class="section__content-section">
                <!-- begin .content-section-->
                <?if(!empty($arResult['PROPERTIES']['PHOTOS']['VALUE'])):?>
                    <div class="content-section">
                        <div class="content-section__header">
                            <h2 class="content-section__title">Готовый образ</h2>
                        </div>
                        <div class="content-section__content">
                            <div class="content-section__image-carousel">
                                <div id="lookBookDetailRedesign" class="swiper-container photo-slider">
                                    <div class="swiper-wrapper">
                                        <?foreach($arResult['PROPERTIES']['PHOTOS']['VALUE'] as $i=>$photo):?>
                                            <?if($i<3):?>
                                                <?$pic = CFile::ResizeImageGet($photo, array('width'=>386, 'height'=>470), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
                                                <div class="swiper-slide photo-slider__slide"><img src="<?=$pic['src']?>" alt="<?=$pic['ALT']?>" title="<?=$pic['TITLE']?>"/></div>
                                            <?endif;?>
                                        <?endforeach;?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?endif;?>
                <!-- end .content-section-->
            </div>
            <div class="section__content-section">
                <!-- begin .content-section-->
                <div class="content-section">
                    <?if(isset($arResult['VIDEO_STRING'])):?>
                        <div class="content-section__header">
                            <h2 class="content-section__title">Видео инструкция</h2>
                        </div>
                        <div class="content-section__content">
                            <div class="content-section__video-group">
                                <?=$arResult['VIDEO_STRING']?>
                            </div>
                        </div>
                    <?endif;?>
                </div>
                <!-- end .content-section-->
            </div>
            <?if(isset($arResult['PROPERTIES']['HIDDEN_SEO_TEXT']) && !empty($arResult['PROPERTIES']['HIDDEN_SEO_TEXT']['VALUE']['TEXT'])):?>
                <div class="visually-hidden"><?=$arResult['PROPERTIES']['HIDDEN_SEO_TEXT']['~VALUE']['TEXT']?></div>
            <?endif;?>
        </div>
    </div>
</div>