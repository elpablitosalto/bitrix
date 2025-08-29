<?php
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();
?>
<section class="ml-section ml-banner-section ml-home-banner-1">
    <div class="container">
        <a class="ml-banner" href="#">
            <picture class="ml-banner__img">
                <source media="(max-width: 480px)" srcset="<?= SITE_TEMPLATE_PATH ?>/img/content/banners/krutiksi-mobile.jpg">
                <source media="(max-width: 991px)" srcset="<?= SITE_TEMPLATE_PATH ?>/img/content/banners/krutiksi-tablet.jpg">
                <img src="<?= SITE_TEMPLATE_PATH ?>/img/content/banners/krutiksi-desktop.jpg" alt="">
            </picture>
            <div class="ml-banner__caption">
                <div class="ml-banner__caption-inner">
                    <p class="ml-banner__title"><span>Крутиксы</span></p>
                    <p class="ml-banner__desc"><span>Смотри о пятницам в 12:00</span></p><span class="ml-banner__link">Подробнее</span>
                </div>
            </div>
        </a>
    </div>
</section>