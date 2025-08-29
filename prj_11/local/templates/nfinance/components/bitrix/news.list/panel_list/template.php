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
    <!-- begin .panel-list-->
    <ul class="panel-list">
        <?foreach ($arResult["ITEMS"] as $arItem):?>
            <li class="panel-list__item">
                <!-- begin .list-panel-->
                <div class="list-panel <?=(!empty($arItem["CLASS_LIST"]) ? $arItem["CLASS_LIST"] : "")?> panel-list__panel">
                    <div class="list-panel__content">
                        <?if(!empty($arItem["NAME"])):?>
                            <?$titleClass = !empty($arItem['PROPERTIES']['HIGHLIGHT_TITLE']['VALUE_XML_ID']) ? 'list-panel__title_style_primary' : '';?>
                            <div class="list-panel__title <?=$titleClass?>"><?=$arItem["NAME"]?></div>
                        <?endif;?>
                        <?if(!empty($arItem["DESCRIPTION"])):?>
                            <div class="list-panel__text"><?=htmlspecialchars_decode($arItem["DESCRIPTION"])?></div>
                        <?endif;?>

                        <?if(!empty($arItem["LIST"])):?>
                            <ul class="list-panel__list">
                                <?foreach($arItem["LIST"] as $text):?>
                                    <li class="list-panel__item">
                                        <!-- begin .list-item-->
                                        <div class="list-item list-item_icon-size_l list-item_icon-border_gray list-item_text-size_lg">
                                            <div class="list-item__wrapper">
                                                <div class="list-item__icon">
                                                    <img class="list-item__icon-image" src="<?=SITE_TEMPLATE_PATH?>/assets/blocks/list-item/images/3.png" alt="" role="presentation">
                                                </div>
                                                <div class="list-item__text"><?=htmlspecialchars_decode($text)?></div>
                                            </div>
                                        </div>
                                        <!-- end .list-item-->
                                    </li>
                                <?endforeach;?>
                            </ul>
                        <?endif;?>

                        <?if(!empty($arItem["SHOW_FORM_BUTTON"])):?>
                            <div class="list-panel__controls">
                                <div class="list-panel__control">
                                    <!-- begin .button-->
                                    <a class="button js-go-to" href="#conditionsSection">
                                        <span class="button__holder">
                                            <span class="button__text">Стать партнером</span>
                                        </span>
                                    </a>
                                    <!-- end .button-->
                                </div>
                            </div>
                        <?endif;?>
                    </div>
                    <?if(!empty($arItem["IMAGE"]["DEFAULT"]["SRC"])):?>
                        <div class="list-panel__illustration">
                            <picture class="list-panel__picture">
                                <?foreach($arItem["IMAGE"]["SOURCES"] as $arSource):?>
                                    <source srcset="<?=$arSource["SRC"]?>" type="image/png" media="<?=$arSource["MEDIA"]?>" class="list-panel__source">
                                    <?endforeach;?>
                                <img src="<?=$arItem["IMAGE"]["DEFAULT"]["SRC"]?>" alt="<?$arItem["IMAGE"]["DEFAULT"]["ALT"]?>" class="list-panel__image">
                        </picture>
                        </div>
                    <?endif;?>
                </div>
                <!-- end .list-panel-->
            </li>
        <?endforeach;?>
    </ul>
    <!-- end .panel-list-->
<? endif; ?>