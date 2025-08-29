<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
$item = $arParams['ITEM'];

// Изображения -->
for ($i = 1; $i <= 3; $i++) {
    $arResultLocal = Indexis::getImageFormatted(array(
        'RESIZE' => 'N',
        'FILE_VALUE' => $item['DISPLAY_PROPERTIES']['NO_2_PICTURE_' . $i]['FILE_VALUE'],
        'NO_IMAGE_DEFAULT' => SITE_TEMPLATE_PATH . '/img/reviewer-thumb.png',
        //'WIDTH' => 205,
        //'HEIGHT' => 116,
        'DEFAULT_ALT_TITLE' => $item['DISPLAY_PROPERTIES']['NO_2_H3']['DISPLAY_VALUE']
    ));
    $arResult['PICTURE_' . $i] = $arResultLocal['PICTURE'];

    $arResultLocal = Indexis::getImageFormatted(array(
        'RESIZE' => 'Y',
        'FILE_VALUE' => $item['DISPLAY_PROPERTIES']['NO_2_PICTURE_' . $i]['FILE_VALUE'],
        'NO_IMAGE_DEFAULT' => SITE_TEMPLATE_PATH . '/img/reviewer-thumb.png',
        'WIDTH' => 767,
        'HEIGHT' => 5000,
        'DEFAULT_ALT_TITLE' => $item['DISPLAY_PROPERTIES']['NO_2_H3']['DISPLAY_VALUE']
    ));
    $arResult['PICTURE_' . $i . '_1'] = $arResultLocal['PICTURE'];

    $arResultLocal = Indexis::getImageFormatted(array(
        'RESIZE' => 'Y',
        'FILE_VALUE' => $item['DISPLAY_PROPERTIES']['NO_2_PICTURE_' . $i]['FILE_VALUE'],
        'NO_IMAGE_DEFAULT' => SITE_TEMPLATE_PATH . '/img/reviewer-thumb.png',
        'WIDTH' => 1199,
        'HEIGHT' => 5000,
        'DEFAULT_ALT_TITLE' => $item['DISPLAY_PROPERTIES']['NO_2_H3']['DISPLAY_VALUE']
    ));
    $arResult['PICTURE_' . $i . '_2'] = $arResultLocal['PICTURE'];
}
// <-- Изображения
?>
<div class="content__wrapper" id="<?= $arParams['EDIT_AREA_ID'] ?>">
    <h3><?= $item['DISPLAY_PROPERTIES']['NO_2_H3']['DISPLAY_VALUE']; ?></h3>
    <div class="content__text-wrapper">
        <?= $item['DISPLAY_PROPERTIES']['NO_2_TEXT_1']['DISPLAY_VALUE']; ?>
    </div>
    <div class="content__images">
        <div class="content__image">
            <picture>
                <source media="(max-width: 767px)" srcset="<?= $arResult['PICTURE_1_1']['SRC']; ?>">
                <source media="(max-width: 1199px)" srcset="<?= $arResult['PICTURE_1_2']['SRC']; ?>">
                <img src="<?= $arResult['PICTURE_1']['SRC']; ?>" alt="<?= $arResult['PICTURE_1']['ALT']; ?>" title="<?= $arResult['PICTURE_1']['TITLE']; ?>" />
            </picture>
        </div>
        <div class="content__image">
            <picture>
                <source media="(max-width: 767px)" srcset="<?= $arResult['PICTURE_2_1']['SRC']; ?>">
                <source media="(max-width: 1199px)" srcset="<?= $arResult['PICTURE_2_2']['SRC']; ?>">
                <img src="<?= $arResult['PICTURE_2']['SRC']; ?>" alt="<?= $arResult['PICTURE_2']['ALT']; ?>" title="<?= $arResult['PICTURE_2']['TITLE']; ?>" />
            </picture>
        </div>
    </div>
    <div class="content__text-wrapper">
        <?= $item['DISPLAY_PROPERTIES']['NO_2_TEXT_2']['DISPLAY_VALUE']; ?>
    </div>
</div>
<div class="content__wrapper">
    <div class="content__image">
        <picture>
            <source media="(max-width: 767px)" srcset="<?= $arResult['PICTURE_3_1']['SRC']; ?>">
            <source media="(max-width: 1199px)" srcset="<?= $arResult['PICTURE_3_2']['SRC']; ?>">
            <img src="<?= $arResult['PICTURE_3']['SRC']; ?>" alt="<?= $arResult['PICTURE_3']['ALT']; ?>" title="<?= $arResult['PICTURE_3']['TITLE']; ?>" />
        </picture>
    </div>
</div>