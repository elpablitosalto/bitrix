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
        <a class="ml-sidebar-banner <?=$arParams['ADDITIONAL_CLASS'];?>" href="<?=$arItem['PROPERTIES']['LINK']['VALUE']?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <picture class="ml-sidebar-banner__img">
                <?if (!empty($arItem['PROPERTIES']['BANNER_SMARTPHONE']['VALUE'])):?>
                    <source media="(max-width: 480px)" srcset="<?=CFile::GetPath($arItem['PROPERTIES']['BANNER_SMARTPHONE']['VALUE'])?>">
                <?endif;?>
                <?if (!empty($arItem['PROPERTIES']['BANNER_TABLET']['VALUE'])):?>
                    <source media="(max-width: 991px)" srcset="<?=CFile::GetPath($arItem['PROPERTIES']['BANNER_TABLET']['VALUE'])?>">
                <?endif;?>
                <img src="<?=CFile::GetPath($arItem['PROPERTIES']['BANNER_DESKTOP']['VALUE'])?>" alt="<?=$arItem["NAME"];?>">
            </picture>
        </a>
    <? endforeach; ?>
<?php endif; ?>