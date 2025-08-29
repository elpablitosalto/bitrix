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

use \Bitrix\Main\Localization\Loc;
?>
<?if (count($arResult['ITEMS']) > 0):?>
    <div class="home-top-slider">
        <div class="home-top-slider-container">
            <div class="home-top-slider-list">
                <?foreach($arResult['ITEMS'] as $arItem):?>
                    <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                    <div class="home-top-slider-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                        <picture class="home-top-slider-item__img">
                            <?if (isset($arItem['DISPLAY_PROPERTIES']['BANNER_SMARTPHONE']['FILE_VALUE']['SRC'])):?>
                                <source media="(max-width: 480px)" srcset="<?=$arItem['DISPLAY_PROPERTIES']['BANNER_SMARTPHONE']['FILE_VALUE']['SRC']?>" />
                            <?endif;?>
                            <?if (isset($arItem['DISPLAY_PROPERTIES']['BANNER_TABLET']['FILE_VALUE']['SRC'])):?>
                                <source media="(max-width: 991px)" srcset="<?=$arItem['DISPLAY_PROPERTIES']['BANNER_TABLET']['FILE_VALUE']['SRC']?>" />
                            <?endif;?>
                            <?if (isset($arItem['DISPLAY_PROPERTIES']['BANNER_DESKTOP']['FILE_VALUE']['SRC'])):?>
                                <img src="<?=$arItem['DISPLAY_PROPERTIES']['BANNER_DESKTOP']['FILE_VALUE']['SRC']?>" alt="<?=$arItem['NAME']?>" />
                            <?endif;?>
                        </picture>
                        <div class="home-top-slider-item__caption">
                            <div class="home-top-slider-item__caption-inner">
                                <p class="home-top-slider-item__title"><span><?=$arItem['NAME']?></span></p>
                                <?if (mb_strlen($arItem['PREVIEW_TEXT']) > 0):?>
                                    <p class="home-top-slider-item__desc"><span><?=$arItem['PREVIEW_TEXT']?></span></p>
                                <?endif;?>
                                <?if (mb_strlen($arItem['DISPLAY_PROPERTIES']['LINK']['VALUE']) > 0):?>
                                    <a class="home-top-slider-item__link" href="<?=$arItem['DISPLAY_PROPERTIES']['LINK']['VALUE']?>"><?=Loc::getMessage('SHOW_MORE')?></a>
                                <?endif;?>
                            </div>
                        </div>
                    </div>
                <?endforeach;?>
            </div>
        </div>
    </div>
<?endif;?>