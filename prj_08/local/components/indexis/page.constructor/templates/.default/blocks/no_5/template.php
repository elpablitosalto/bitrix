<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
$item = $arParams['ITEM'];
?>
<div class="content__wrapper" id="<?= $arParams['EDIT_AREA_ID'] ?>">
    <h2 class="content__faq-title"><?= $item['DISPLAY_PROPERTIES']['NO_5_H']['DISPLAY_VALUE']; ?></h2>
    <div class="content__faq-wrapper">
        <? foreach ($item['DISPLAY_PROPERTIES']['NO_5_Q']['DISPLAY_VALUE'] as $key => $val) { ?>
            <div class="content__faq">
                <div class="content__faq-question"><?= $val ?></div>
                <div class="content__faq-answer">
                    <?= $item['DISPLAY_PROPERTIES']['NO_5_A']['DISPLAY_VALUE'][$key] ?>
                </div>
            </div>
        <? } ?>
    </div>
</div>