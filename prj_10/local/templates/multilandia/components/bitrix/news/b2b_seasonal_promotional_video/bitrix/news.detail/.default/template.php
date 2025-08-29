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

if ($arResult['~DETAIL_PICTURE'] || $arResult['DISPLAY_PROPERTIES']['VIDEO']['FILE_VALUE']['SRC']) {
    $imgDesktop = [];
    $imgDesktop = CFile::ResizeImageGet($arResult['~DETAIL_PICTURE'], ['width' => 1720, 'height' => 660 * 2], BX_RESIZE_IMAGE_PROPORTIONAL, true, false, false, 100);
    $imgDesktop = $imgDesktop['src'] ? : SITE_TEMPLATE_PATH.'/img/no_photo.png';
    $imgTablet = [];
    $imgTablet = CFile::ResizeImageGet($arResult['~DETAIL_PICTURE'], ['width' => 708, 'height' => 272 * 2], BX_RESIZE_IMAGE_PROPORTIONAL, true, false, false, 100);
    $imgTablet = $imgTablet['src'] ? : SITE_TEMPLATE_PATH.'/img/no_photo.png';
    $imgMobile = [];
    $imgMobile = CFile::ResizeImageGet($arResult['~DETAIL_PICTURE'], ['width' => 440, 'height' => 168 * 2], BX_RESIZE_IMAGE_PROPORTIONAL, true, false, false, 100);
    $imgMobile = $imgMobile['src'] ? : SITE_TEMPLATE_PATH.'/img/no_photo.png';
}
?>
<div class="ml-page-content ml-cartoon-detail ml-news-detail">
    <?if ($arResult['DISPLAY_PROPERTIES']['VIDEO']['FILE_VALUE']['SRC']) {?>
        <a class="ml-video-link" rel="nofollow" href="<?=$arResult['DISPLAY_PROPERTIES']['VIDEO']['FILE_VALUE']['SRC']?>" data-fancybox="cartoon-series">
            <figure>
                <picture>
                    <source media="(max-width:480px)" srcset="<?=$imgMobile?>">
                    <source media="(max-width:991px)" srcset="<?=$imgTablet?>">
                    <img class="lazyload" data-src="<?=$imgDesktop?>" src="<?=$imgDesktop?>" alt="<?=$arResult['NAME']?>">
                </picture>
            </figure>
        </a>
    <?} else if ($imgDesktop) {?>
        <div class="ml-banner ml-news-detail__cover">
            <picture class="ml-banner__img">
                <source media="(max-width: 480px)" data-srcset="<?=$imgMobile?>" srcset="<?=$imgMobile?>">
                <source media="(max-width: 991px)" data-srcset="<?=$imgTablet?>" srcset="<?=$imgTablet?>">
                <img class="lazyloaded" data-src="<?=$imgDesktop?>" src="<?=$imgDesktop?>" width="1720" height="660" alt="<?=$arResult['NAME']?>">
            </picture>
        </div>
    <?}?>

    <?if ($arResult['PROPERTIES']['IFRAME']['VALUE']) {
        foreach ($arResult['PROPERTIES']['IFRAME']['VALUE'] as $value) {?>
            <div class="ml-iframe">
                <iframe src="<?=$value?>"></iframe>
            </div>
        <?}
    }?>

    <?if ($arResult['~DETAIL_TEXT']) {?>
        <div class="ml-news-detail__content">
            <div class="row">
                <div class="col-lg-9">
                    <?=$arResult['~DETAIL_TEXT']?>
                </div>
            </div>
        </div>
    <?}?>
</div>