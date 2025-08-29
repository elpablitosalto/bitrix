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

<? if (!empty($arResult['PICTURES'])) { ?>
    <section class="offices">
        <div class="title-section">
            <h2>Наш офис</h2>
            <div class="offices__navigation">
                <div class="button-arrow button-arrow_left offices__prev"></div>
                <div class="button-arrow button-arrow_right offices__next"></div>
            </div>
        </div>
        <div class="offices__slider">
            <div class="offices__wrapper">
                <? foreach ($arResult['PICTURES'] as $file) { ?>
                    <div class="offices__slide"><img src="<?=$file['SRC']?>" alt="<?=$file['TITLE']?>" title="<?=$file['TITLE']?>"></div>
                <? } ?>
            </div>
        </div>
    </section>
<? } ?>