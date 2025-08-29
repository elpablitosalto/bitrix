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
<? if (!empty($arResult["ITEMS"])): ?>
        <!-- begin .entity-banner-->
    <div class="entity-banner page__entity-banner">
        <?if(!empty($arParams["TITLE"]) || !empty($arParams["DESCRIPTION"])):?>
            <div class="entity-banner__header">
                <?if(!empty($arParams["TITLE"])):?>
                    <h1 class="entity-banner__title"><?=$arParams["TITLE"]?></h1>
                <? endif; ?>
                <?if(!empty($arParams["DESCRIPTION"])):?>
                    <div class="entity-banner__text"><?=$arParams["DESCRIPTION"]?></div>
                <? endif; ?>
            </div>
        <? endif; ?>
      <? if(!empty($arParams["BACKGROUND_IMAGE"])): ?>
        <div class="entity-banner__main">
            <div class="entity-banner__panel">
            <div class="entity-banner__illustration">
                <picture class="entity-banner__picture">
                    <?if(!empty($arParams["BACKGROUND_IMAGE_M"])):?>
                        <source srcset="<?=$arParams["BACKGROUND_IMAGE_M"]?>" type="image/png" media="(max-width: 767px)" class="entity-banner__source"/>
                    <? endif; ?>
                    <?if(!empty($arParams["BACKGROUND_IMAGE_L"])):?>
                        <source srcset="<?=$arParams["BACKGROUND_IMAGE_L"]?>" type="image/png" media="(max-width: 1024px)" class="entity-banner__source"/>
                    <? endif; ?>
                    <img src="<?=$arParams["BACKGROUND_IMAGE"]?>" alt="Нескучные финансы" class="entity-banner__image"/>
                </picture>
            </div>
            <div class="entity-banner__tooltips">
                <? foreach ($arResult["ITEMS"] as $arItem): ?>
                    <div class="entity-banner__tooltip" style="left:<?=$arItem["PROPERTIES"]["LEFT_POSITION"]["VALUE"]?>%">
                    <!-- begin .tippy-->
                    <div class="tippy tippy_position_none tippy_type_cross tippy_size_l tippy_content-position_shifted-top-left tippy_padding_s tippy_style_outline">
                        <div class="tippy__content">
                        <div class="tippy__icon">Подробнее</div>
                        <div class="tippy__container">
                            <div class="tippy__name"><?=$arItem["NAME"]?></div>
                            <div class="tippy__role"><?=$arItem["PREVIEW_TEXT"]?></div>
                        </div>
                        </div>
                    </div>
                    <!-- end .tippy-->
                    </div>
                <? endforeach; ?>
            </div>
            </div>
        </div>
      <? endif; ?>
    </div>
<? endif; ?>