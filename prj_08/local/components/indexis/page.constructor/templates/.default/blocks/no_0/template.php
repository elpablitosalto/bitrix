<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
$item = $arParams['ITEM'];

$APPLICATION->SetTitle($item['DISPLAY_PROPERTIES']['NO_0_H1']['DISPLAY_VALUE']);
$APPLICATION->SetPageProperty("PAGE_H3", $item['DISPLAY_PROPERTIES']['NO_0_H1']['DISPLAY_VALUE']);

// Изображения -->
$arResultLocal = Indexis::getImageFormatted(array(
    'RESIZE' => 'N',
    'FILE_VALUE' => $item['DISPLAY_PROPERTIES']['NO_0_DETAIL_PICTURE']['FILE_VALUE'],
    'NO_IMAGE_DEFAULT' => SITE_TEMPLATE_PATH . '/img/reviewer-thumb.png',
    //'WIDTH' => 205,
    //'HEIGHT' => 116,
    'DEFAULT_ALT_TITLE' => $item['DISPLAY_PROPERTIES']['NO_0_H1']['DISPLAY_VALUE']
));
$arResult['PICTURE'] = $arResultLocal['PICTURE'];

$arResultLocal = Indexis::getImageFormatted(array(
    'RESIZE' => 'Y',
    'FILE_VALUE' => $item['DISPLAY_PROPERTIES']['NO_0_DETAIL_PICTURE']['FILE_VALUE'],
    'NO_IMAGE_DEFAULT' => SITE_TEMPLATE_PATH . '/img/reviewer-thumb.png',
    'WIDTH' => 767,
    'HEIGHT' => 5000,
    'DEFAULT_ALT_TITLE' => $item['DISPLAY_PROPERTIES']['NO_0_H1']['DISPLAY_VALUE']
));
$arResult['PICTURE_1'] = $arResultLocal['PICTURE'];

$arResultLocal = Indexis::getImageFormatted(array(
    'RESIZE' => 'Y',
    'FILE_VALUE' => $item['DISPLAY_PROPERTIES']['NO_0_DETAIL_PICTURE']['FILE_VALUE'],
    'NO_IMAGE_DEFAULT' => SITE_TEMPLATE_PATH . '/img/reviewer-thumb.png',
    'WIDTH' => 1199,
    'HEIGHT' => 5000,
    'DEFAULT_ALT_TITLE' => $item['DISPLAY_PROPERTIES']['NO_0_H1']['DISPLAY_VALUE']
));
$arResult['PICTURE_2'] = $arResultLocal['PICTURE'];
// <-- Изображения
?>
<div class="content__wrapper" id="<?= $arParams['EDIT_AREA_ID'] ?>">
    <div class="content__image">
        <picture>
            <source media="(max-width: 767px)" srcset="<?= $arResult['PICTURE_1']['SRC']; ?>">
            <source media="(max-width: 1199px)" srcset="<?= $arResult['PICTURE_2']['SRC']; ?>">
            <img src="<?= $arResult['PICTURE']['SRC']; ?>" alt="<?= $arResult['PICTURE']['ALT']; ?>" title="<?= $arResult['PICTURE']['TITLE']; ?>" />
        </picture>
    </div>
</div>