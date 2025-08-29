<?
use Hair\General;
?>
<section id="mainPageSlider" data-video-page-slider class="main-page-slider swiper-container test">
    <div class="main-page-slider__wrapper swiper-wrapper">
        <?foreach($arResult['ITEMS'] as $k => $arItem):?>
            <div class="main-page-slider__wrapper-slide swiper-slide">
                <?if(!empty($arItem['PROPERTIES']['LINK']['VALUE'])):?><a class="main-page-slider__wrapper-slide-link" href="<?=$arItem['PROPERTIES']['LINK']['VALUE']?>"></a><?endif?>
                <?if(!empty($arItem['PROPERTIES']['VIDEO_FILE']['VALUE'])):?>
                    <?$arFile = CFIle::GetFileArray($arItem['PROPERTIES']['VIDEO_FILE']['VALUE']);?>
                    <video autoplay loop muted width="100%" height="100%" id="main-page-slide-<?=$k?>">
                        <source src="<?=$arFile['SRC']?>" type="<?=$arFile['CONTENT_TYPE']?>"><!-- MP4 длѝ Safari, IE9, iPhone, iPad, Android, и Windows Phone 7 -->
                    </video>
                <?elseif(!empty($arItem['PROPERTIES']['VIDEO_URL']['VALUE'])):?>
                    <?
                        $url = General::ParseShortYouTubeLink($arItem['PROPERTIES']['VIDEO_URL']['VALUE']);
                        $duration = General::GetYouTubeVideoDuration($url);
                    ?>
                    <iframe width="100%" height="100%" src="<?=$url.'?mute=1&showinfo=0&controls=0'?>" data-duration="<?=$duration?>" title="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                <?
                else:
                    $desktopImg = CFile::ResizeImageGet($arItem['DETAIL_PICTURE'], array('width'=>1920, 'height'=>1075), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                    $picInfoDesktop = CFile::GetByID($arSection['UF_BANNER_DESKTOP'])->Fetch();
                    $mobileImg = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width'=>576, 'height'=>510), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                    $picInfoMobile = CFile::GetByID($arSection['UF_BANNER_MOBILE'])->Fetch();

                    BitrixTools::picSrcset(array(
                        "picMobile" => array(
                            "src" => $mobileImg['src'],
                        ),
                        "picDesktop" => array(
                            "src" => $desktopImg['src'],
                        ),
                        "alt" => $arItem['NAME'],
                        "title" => $arItem['NAME'],
                        "class" => "banner-picture__image",
                        "src" => $desktopImg['src'],
                        "width" => $desktopImg['width'],
                        "height" => $desktopImg['height'],
                    ));
                ?>
                    <?/*?>
                    <picture class="banner-picture">
                        <source srcset="<?=$picMobile['src']?>" type="<?=(!empty($picInfoMobile) ? $picInfoMobile['CONTENT_TYPE'] : 'image/jpeg')?>" media="(max-width: 576px)">
                        <!--<source srcset="<?=$picDesktop['src']?>" type="<?=(!empty($picInfoDesktop) ? $picInfoDesktop['CONTENT_TYPE'] : 'image/jpeg')?>" media="(max-width: 991px)">-->
                        <source srcset="<?=$picDesktop['src']?>" type="<?=(!empty($picInfoDesktop) ? $picInfoDesktop['CONTENT_TYPE'] : 'image/jpeg')?>">
                        <img class="banner-picture__image" src="<?=$picDesktop['src']?>">
                    </picture>
                    <?*/?>
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
</section>