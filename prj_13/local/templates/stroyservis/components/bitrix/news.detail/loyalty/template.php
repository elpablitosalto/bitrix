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
?>

<section class="loyal">
    <p class="loyal__annotation">
        <?if ($arParams['IS_AUTH'] == 'Y'):?>
            <?= $arResult['DISPLAY_PROPERTIES']['AUTH_ANNOTATION']['~VALUE']['TEXT'] ?>
        <?else:?>
            <?= $arResult['PREVIEW_TEXT'] ?>
        <?endif;?>
    </p>
    <? if (!empty($arResult['DISPLAY_PROPERTIES']['FOOTNOTE']['VALUE'])) { ?>
        <p class="loyal__notation"><?= $arResult['DISPLAY_PROPERTIES']['FOOTNOTE']['VALUE'] ?></p>
    <? } ?>
    <div class="loyal__banner">
        <picture>
            <? if (!empty($arResult['IMAGE_MOB'])) { ?>
                <source media="(max-width: 576px)" srcset="<?= $arResult['IMAGE_MOB']['SRC']; ?>" alt="<?= $arResult['IMAGE_MOB']['ALT']; ?>" title="<?= $arResult['IMAGE_MOB']['TITLE']; ?>" />
            <? } ?>
            <? if (!empty($arResult['IMAGE_LAP'])) { ?>
                <source media="(max-width: 991px)" srcset="<?= $arResult['IMAGE_LAP']['SRC']; ?>" alt="<?= $arResult['IMAGE_LAP']['ALT']; ?>" title="<?= $arResult['IMAGE_LAP']['TITLE']; ?>" />
            <? } ?>
            <img src="<?= $arResult['IMAGE_DESK']['SRC']; ?>" alt="<?= $arResult['IMAGE_DESK']['ALT']; ?>" title="<?= $arResult['IMAGE_DESK']['TITLE']; ?>" />
        </picture>
    </div>
    <h2>Условия программы лояльности</h2>
    <?= $arResult['DETAIL_TEXT'] ?>
    </p>
</section>