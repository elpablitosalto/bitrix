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

<div class="rs__gallery rs__news--detail-video">
    <div class="is-video js--gallery-it rs__gallery--item" data-youtube="<?= $video_link; ?>">
        <div class="rs__gallery--pic">
            <picture>
                <img src="<?= $arPicture["SRC"]; ?>" class="rs__gallery--img">
            </picture>
        </div>
    </div>
</div>