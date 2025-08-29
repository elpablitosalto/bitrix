<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
$item = $arParams['ITEM'];

if (!is_array($item['DISPLAY_PROPERTIES']['NO_6_PICTURE']['FILE_VALUE'])) {
    if (strlen($item['DISPLAY_PROPERTIES']['NO_6_PICTURE']['FILE_VALUE']) > 0) {
        $item['DISPLAY_PROPERTIES']['NO_6_PICTURE']['FILE_VALUE'] = array($item['DISPLAY_PROPERTIES']['NO_6_PICTURE']['FILE_VALUE']);
    }
}

// Изображения -->
foreach ($item['DISPLAY_PROPERTIES']['NO_6_PICTURE']['FILE_VALUE'] as $key => $arFile) {
    $arResultLocal = Indexis::getImageFormatted(array(
        'RESIZE' => 'N',
        'FILE_VALUE' => $arFile,
        'NO_IMAGE_DEFAULT' => SITE_TEMPLATE_PATH . '/img/reviewer-thumb.png',
        //'WIDTH' => 205,
        //'HEIGHT' => 116,
        'DEFAULT_ALT_TITLE' => ''
    ));
    $arResult['PICTURES'][$key]['PICTURE'] = $arResultLocal['PICTURE'];

    $arResultLocal = Indexis::getImageFormatted(array(
        'RESIZE' => 'Y',
        'FILE_VALUE' => $arFile,
        'NO_IMAGE_DEFAULT' => SITE_TEMPLATE_PATH . '/img/reviewer-thumb.png',
        'WIDTH' => 767,
        'HEIGHT' => 5000,
        'DEFAULT_ALT_TITLE' => ''
    ));
    $arResult['PICTURES'][$key]['PICTURE_1'] = $arResultLocal['PICTURE'];

    $arResultLocal = Indexis::getImageFormatted(array(
        'RESIZE' => 'Y',
        'FILE_VALUE' => $arFile,
        'NO_IMAGE_DEFAULT' => SITE_TEMPLATE_PATH . '/img/reviewer-thumb.png',
        'WIDTH' => 1199,
        'HEIGHT' => 5000,
        'DEFAULT_ALT_TITLE' => ''
    ));
    $arResult['PICTURES'][$key]['PICTURE_2'] = $arResultLocal['PICTURE'];
}
// <-- Изображения
?>
<div class="content__wrapper" id="<?= $arParams['EDIT_AREA_ID'] ?>">
    <div class="content__slider">
        <div class="content__slider-main swiper">
            <div class="swiper-wrapper">
                <? foreach ($arResult['PICTURES'] as $key => $arFile) { ?>
                    <div class="swiper-slide">
                        <picture>
                            <source media="(max-width: 767px)" srcset="<?= $arFile['PICTURE_1']['SRC']; ?>">
                            <source media="(max-width: 1199px)" srcset="<?= $arFile['PICTURE_2']['SRC']; ?>">
                            <img src="<?= $arFile['PICTURE']['SRC']; ?>" alt="<?= $arFile['PICTURE']['ALT']; ?>" title="<?= $arFile['PICTURE']['TITLE']; ?>" />
                        </picture>
                    </div>
                <? } ?>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
        <div class="content__slider-second swiper">
            <div class="swiper-wrapper">
                <? foreach ($arResult['PICTURES'] as $key => $arFile) { ?>
                    <div class="swiper-slide">
                        <img src="<?= $arFile['PICTURE']['SRC']; ?>" alt="<?= $arFile['PICTURE']['ALT']; ?>" title="<?= $arFile['PICTURE']['TITLE']; ?>" />
                    </div>
                <? } ?>
            </div>
        </div>
    </div>
</div>