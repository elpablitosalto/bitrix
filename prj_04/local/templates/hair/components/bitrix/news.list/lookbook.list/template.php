<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<section class="full-page-banner">    
    <img class="show-desktop" src="<?=$arParams['TOP_BANNER_DESKTOP']?>">
    <img class="middle-show" src="<?=$arParams['TOP_BANNER_DESKTOP']?>">
    <img class="show-mobile" src="<?=$arParams['TOP_BANNER_MOBILE']?>">
</section>
<div class="container _inside-page">
    <div class="lookbook-list">
        <?foreach($arResult['ITEMS'] as $k => $arItem):?>
            <?$pic = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width'=>400, 'height'=>400), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
            <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="lookbook-list__item" style="background-image: url(<?=$pic['src']?>)">
                <div class="lookbook-list__item-description">
                    <p class="lookbook-list__item-title"><?=$arItem['NAME']?></p>
                    <!--<img src="<?=MOCKUP?>/images/lookbooks/lb-text.svg">-->
                    <?foreach($arItem['DISPLAY_PROPERTIES']['WHAT_WE_USE']['LINK_ELEMENT_VALUE'] as $arProduct):?>
                        <p><?=$arProduct['NAME']?></p>
                    <?endforeach;?>
                </div>
            </a>
        <?endforeach;?>
    </div>
</div>
