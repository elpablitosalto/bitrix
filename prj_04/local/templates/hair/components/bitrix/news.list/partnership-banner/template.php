<?
use Hair\General;
?>
<?foreach($arResult['ITEMS'] as $arItem):?>
    <section class="full-page-banner">
        <?if(!empty($arItem['PROPERTIES']['DESKTOP_IMAGE']['VALUE'])):?>
            <?
                $bannerDesktop = CFile::ResizeImageGet($arItem['PROPERTIES']['DESKTOP_IMAGE']['VALUE'], array('width'=>1920, 'height'=>600), BX_RESIZE_IMAGE_PROPORTIONAL, true);
            ?>
            <img class="show-desktop" src="<?=$bannerDesktop['src']?>">
        <?endif;?>

        <?if(!empty($arItem['PROPERTIES']['TABLET_IMAGE']['VALUE'])):?>
            <?
                $bannerTablet = CFile::ResizeImageGet($arItem['PROPERTIES']['TABLET_IMAGE']['VALUE'], array('width'=>992, 'height'=>310), BX_RESIZE_IMAGE_PROPORTIONAL, true);
            ?>
            <img class="middle-show" src="<?=$bannerTablet['src']?>">
        <?endif;?>

        <?if(!empty($arItem['PROPERTIES']['MOBILE_IMAGE']['VALUE'])):?>
            <?
                $bannerMobile = CFile::ResizeImageGet($arItem['PROPERTIES']['MOBILE_IMAGE']['VALUE'], array('width'=>640, 'height'=>360), BX_RESIZE_IMAGE_PROPORTIONAL, true);
            ?>
            <img class="show-mobile" src="<?=$bannerMobile['src']?>">
        <?endif;?>
    </section>
<?endforeach;?>