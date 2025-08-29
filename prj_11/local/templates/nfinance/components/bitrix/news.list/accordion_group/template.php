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
<?if(!empty($arResult["ITEMS"])):?>
    <div class="accordion-group section__accordion-group">
        <ul class="accordion-group__list js-accordion-list">
            <?foreach ($arResult["ITEMS"] as $arItem):?>
                <li class="accordion-group__item">
                <!-- begin .accordion-->
                <div class="accordion js-accordion">
                    <div class="accordion__header">
                    <button class="accordion__trigger js-accordion-trigger" type="button"><?=htmlspecialcharsbx($arItem["NAME"])?></button>
                    </div>
                    <div class="accordion__body">
                    <div class="accordion__text"><?=htmlspecialcharsbx($arItem["DETAIL_TEXT"])?></div>
                    </div>
                </div>
                <!-- end .accordion-->
                </li>
            <?endforeach;?>
        </ul>
    </div>
<?endif;?>