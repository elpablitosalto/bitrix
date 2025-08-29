<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

<? if (count($arResult['ITEMS']) > 0): ?>
    <? foreach($arResult['ITEMS'] as $arItem):
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <section class="ml-section ml-banner-section <?=$arParams['ADDITIONAL_CLASS'];?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <div class="container">
                <a class="ml-banner" href="<?=$arItem['PROPERTIES']['LINK']['VALUE']?>">
                    <picture class="ml-banner__img">
                        <?if (!empty($arItem['PROPERTIES']['BANNER_SMARTPHONE']['VALUE'])):?>
                            <source media="(max-width: 480px)" srcset="<?=CFile::GetPath($arItem['PROPERTIES']['BANNER_SMARTPHONE']['VALUE'])?>">
                        <?endif;?>
                        <?if (!empty($arItem['PROPERTIES']['BANNER_TABLET']['VALUE'])):?>
                            <source media="(max-width: 991px)" srcset="<?=CFile::GetPath($arItem['PROPERTIES']['BANNER_TABLET']['VALUE'])?>">
                        <?endif;?>
                        <img src="<?=CFile::GetPath($arItem['PROPERTIES']['BANNER_DESKTOP']['VALUE'])?>" alt="">
                    </picture>
                    <?if($arItem['PROPERTIES']['BANNER_TITLE']['VALUE'] || $arItem['PROPERTIES']['BANNER_DESC']['VALUE'] || $arItem['PROPERTIES']['BANNER_BTN']['VALUE']):?>
                        <div class="ml-banner__caption">
                            <div class="ml-banner__caption-inner">
                                <?if($arItem['PROPERTIES']['BANNER_TITLE']['VALUE']):?>
                                    <p class="ml-banner__title"><span><?=$arItem['PROPERTIES']['BANNER_TITLE']['VALUE']?></span></p>
                                <?endif;?>
                                <?if($arItem['PROPERTIES']['BANNER_DESC']['VALUE']):?>
                                    <p class="ml-banner__desc"><span><?=$arItem['PROPERTIES']['BANNER_DESC']['VALUE']?></span></p>
                                <?endif;?>
                                <?if($arItem['PROPERTIES']['BANNER_BTN']['VALUE']):?>
                                    <span class="ml-banner__link"><?=$arItem['PROPERTIES']['BANNER_BTN']['VALUE']?></span>
                                <?endif;?>
                            </div>
                        </div>
                    <?endif;?>
                </a>
            </div>
        </section>
    <? endforeach; ?>
<?php endif; ?>