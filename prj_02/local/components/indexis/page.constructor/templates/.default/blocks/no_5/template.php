<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
$item = $arParams['ITEM'];
$arVideo = $item['DISPLAY_PROPERTIES']['NO_5_VIDEO']['FILE_VALUE'];
$arPicture = $item['DISPLAY_PROPERTIES']['NO_5_PICTURE']['FILE_VALUE'];
$arLink = $item['DISPLAY_PROPERTIES']['NO_5_VIDEO_LINK'];

$video_link = $arVideo["SRC"];
if (strlen($arLink["VALUE"]) > 0) {
    $video_link = $arLink["VALUE"];
}
?>
<div class="news-detail-video">
    <a data-fancybox href="<?= $video_link; ?>" class="news-detail-video-item">
        <picture>
            <img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= $arPicture["SRC"]; ?>" loading="lazy" alt="" title="" />
        </picture>
        <h3 class="news-detail-video-item__title"><?= $item["NAME"]; ?></h3>
        <div class="news-detail-video-item__play">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-triangle">
                <use xlink:href="#triangle"></use>
            </svg>
        </div>
    </a>
</div>