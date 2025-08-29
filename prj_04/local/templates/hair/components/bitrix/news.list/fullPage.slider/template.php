<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Hair\General;
if($arParams['STATIC'] == 'Y'): 
    $arItem = $arResult['ITEMS'][0];
?>
    <div class="full-page-slider__wrapper swiper-wrapper">
        <?foreach($arItem['PROPERTIES']['PHOTOS']['VALUE'] as $k => $photo):?>
            <?
                $pic = CFile::ResizeImageGet($photo, array('width'=>1920, 'height'=>360), BX_RESIZE_IMAGE_EXACT, true);
                $picMobile = CFile::ResizeImageGet($arItem['PROPERTIES']['PHOTOS_MOBILE']['VALUE'][$k], array('width'=>320, 'height'=>183), BX_RESIZE_IMAGE_PROPORTIONAL, true);
            ?>
            <div class="full-page-slider__wrapper-slide swiper-slide">
                <img class="show-desktop" src="<?=$pic['src']?>" loading="lazy" />
                <img class="show-mobile" src="<?=$picMobile['src']?>" loading="lazy" />
            </div>
        <?endforeach;?>
    </div>
    <div class="container navigation">     
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
<?else:?>
    <div class="full-page-slider__wrapper swiper-wrapper">    
        <?foreach($arResult['ITEMS'] as $k => $arItem):?>
            <div class="full-page-slider__wrapper-slide swiper-slide">
                <?if(!empty($arItem['PROPERTIES']['VIDEO_FILE']['VALUE'])):?>
                    <?$arFile = CFIle::GetFileArray($arItem['PROPERTIES']['VIDEO_FILE']['VALUE']);?>
                    <video muted width="100%" height="100%">
                        <source src="<?=$arFile['SRC']?>" type="<?=$arFile['CONTENT_TYPE']?>"><!-- MP4 длѝ Safari, IE9, iPhone, iPad, Android, и Windows Phone 7 -->
                    </video>
                <?elseif(!empty($arItem['PROPERTIES']['VIDEO_URL']['VALUE'])):?>
                    <?
                        $url = General::ParseShortYouTubeLink($arItem['PROPERTIES']['VIDEO_URL']['VALUE']);
                        $duration = General::GetYouTubeVideoDuration($url);
                    ?>
                    <iframe width="100%" height="100%" src="<?=$url.'?mute=1&showinfo=0&controls=0'?>" loading="lazy" data-duration="<?=$duration?>" title="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                <?
                else:
                    $desktopImg = CFile::ResizeImageGet($arItem['DETAIL_PICTURE'], array('width'=>1920, 'height'=>464), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                ?>
                    <img class="show-desktop" src="<?=$desktopImg['src']?>" loading="lazy"/>
                    <img class="middle-show" src="<?=$arItem['DETAIL_PICTURE']['SRC']?>" loading="lazy"/>
                    <img class="show-mobile" src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" loading="lazy"/>
                <?endif;?>
            </div>
        <?endforeach;?>
    </div>
    <div class="container navigation">           
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
        <!-- Add Arrows -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
<?endif;?>