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
    <div class="cards-panel cards-panel_layout_m cards-panel_style_secondary">
        <div class="cards-panel__container">
            <div class="cards-panel__wrapper">
                <? foreach ($arResult["ITEMS"] as $arItem): ?>
                    <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                    <div class="cards-panel__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                        <!-- begin .advantages-item-->
                        <div class="advantages-item">
                          <?if(!empty($arItem["PROPERTIES"]["LINK"]["VALUE"])):?>
                            <a class="advantages-item__content" href="<?=$arItem["PROPERTIES"]["LINK"]["VALUE"]?>" target="_blank">
                                <span class="advantages-item__background">
                                  <picture class="advantages-item__picture">
                                    <?if(!empty($arItem["PROPERTIES"]["SMALL_IMAGE"]["VALUE"])):?>
                                      <source srcset="<?= \CFile::GetPath($arItem["PROPERTIES"]["SMALL_IMAGE"]["VALUE"]) ?>"
                                              type="image/png" media="(max-width: 480px)" class="advantages-item__source"/>
                                    <?endif;?>
                                    <?if(!empty($arItem["PROPERTIES"]["MEDIUM_IMAGE"]["VALUE"])):?>
                                      <source srcset="<?= \CFile::GetPath($arItem["PROPERTIES"]["MEDIUM_IMAGE"]["VALUE"]) ?>"
                                              type="image/png" media="(max-width: 768px)" class="advantages-item__source"/>
                                    <?endif;?>
                                    <?if(!empty($arItem["PROPERTIES"]["BIG_IMAGE"]["VALUE"])):?>
                                      <img src="<?= \CFile::GetPath($arItem["PROPERTIES"]["BIG_IMAGE"]["VALUE"]) ?>"
                                          alt="<?=$arItem["NAME"]?>" class="advantages-item__image" title="" loading="lazy"/>
                                    <?endif;?>
                                  </picture>
                                </span>
                                <span class="advantages-item__main"></span>
                            </a>
                          <?else:?>
                            <div class="advantages-item__content">
                                <span class="advantages-item__background">
                                  <picture class="advantages-item__picture">
                                    <?if(!empty($arItem["PROPERTIES"]["SMALL_IMAGE"]["VALUE"])):?>
                                      <source srcset="<?= \CFile::GetPath($arItem["PROPERTIES"]["SMALL_IMAGE"]["VALUE"]) ?>"
                                              type="image/png" media="(max-width: 480px)" class="advantages-item__source"/>
                                    <?endif;?>
                                    <?if(!empty($arItem["PROPERTIES"]["MEDIUM_IMAGE"]["VALUE"])):?>
                                      <source srcset="<?= \CFile::GetPath($arItem["PROPERTIES"]["MEDIUM_IMAGE"]["VALUE"]) ?>"
                                              type="image/png" media="(max-width: 768px)" class="advantages-item__source"/>
                                    <?endif;?>
                                    <?if(!empty($arItem["PROPERTIES"]["BIG_IMAGE"]["VALUE"])):?>
                                      <img src="<?= \CFile::GetPath($arItem["PROPERTIES"]["BIG_IMAGE"]["VALUE"]) ?>"
                                          alt="<?=$arItem["NAME"]?>" class="advantages-item__image" title="" loading="lazy"/>
                                    <?endif;?>
                                  </picture>
                                </span>
                                <span class="advantages-item__main"></span>
                            </div>
                          <?endif;?>
                        </div>
                        <!-- end .advantages-item-->
                    </div>
                <? endforeach; ?>
            </div>
        </div>
    </div>
<? endif; ?>