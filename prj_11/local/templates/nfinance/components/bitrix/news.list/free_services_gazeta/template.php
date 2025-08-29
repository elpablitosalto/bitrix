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
    <div class="section section_space_top-close">
        <div class="section__content">
            <div class="section__cards-panel">
                <!-- no modifiers - panels take all available width, divinging equally up to three in one row-->
                <!-- cards-panel_layout_l - one panel per row-->
                <!-- cards-panel_layout_m - two panels per row-->
                <!-- cards-panel_layout_s - three panels per row-->
                <!-- cards-panel_layout_xs - four panels per row-->
                <!-- cards-panel_layout_mixed - three panels every odd row, two panels every even row-->
                <!-- begin .cards-panel-->
                <div class="cards-panel cards-panel_layout_xs">
                    <div class="cards-panel__container">
                        <div class="cards-panel__wrapper">
                            <? foreach ($arResult["ITEMS"] as $arItem): ?>
                                <?
                                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                                ?>
                                <div class="cards-panel__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                                    <!-- begin .service-item-->
                                    <div class="service-item service-item_style_secondary">
                                        <div class="service-item__content">
                                            <?if(!empty($arItem['PROPERTIES']['IMAGE_BACKGROUND']['VALUE'])):?>
                                                <div class="service-item__background">
                                                    <picture class="service-item__picture">
                                                        <?
                                                          $resizeImage = CFile::ResizeImageGet($arItem['PROPERTIES']['IMAGE_BACKGROUND']['VALUE'],
                                                          array('width'=>520, 'height'=>800),
                                                          BX_RESIZE_IMAGE_EXACT, true);
                                                        ?>
                                                        <img
                                                            src="<?= $resizeImage['src']?>"
                                                            alt="<?=$arItem['NAME']?>" class="service-item__image" title=""
                                                        />
                                                    </picture>
                                                </div>
                                            <?endif;?>
                                            <div class="service-item__header">
                                                <div class="service-item__tags">
                                                    <div class="service-item__tag">
                                                        <!-- begin .label-->
                                                        <div class="label label_style_dashed">
                                                            бесплатно
                                                        </div>
                                                        <!-- end .label-->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="service-item__main">
                                                <div class="service-item__title">
                                                    <?= $arItem["NAME"] ?>
                                                </div>

                                                <?
                                                    $link = !empty($arItem["PROPERTIES"]["LINK"]["VALUE"]) ? $arItem["PROPERTIES"]["LINK"]["VALUE"] : $arItem['DETAIL_PAGE_URL'];
                                                ?>
                                                <?if(!empty($link)):?>
                                                    <?
                                                        $isExternalLink = preg_match('/(http|www)/', $link);
                                                    ?>
                                                    <div class="service-item__controls">
                                                        <div class="service-item__controls">
                                                            <!-- begin .button-->
                                                            <a
                                                                href="<?=$link?>"
                                                                <?=($isExternalLink ? 'target="_blank"' : '');?>
                                                                class="button button_width_full button_style_shadowless"
                                                            >
                                                                <span class="button__holder">
                                                                    <span class="button__text">Подробнее</span>
                                                                </span>
                                                            </a>
                                                            <!-- end .button-->
                                                        </div>
                                                    </div>
                                                <?endif;?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end .service-item-->
                                </div>
                            <? endforeach; ?>
                        </div>
                    </div>
                </div>
                <!-- end .cards-panel-->
            </div>
        </div>
    </div>
<? endif; ?>