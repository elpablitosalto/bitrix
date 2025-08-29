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
<?if (count($arResult['ITEMS']) > 0):?>
    <?foreach($arResult['ITEMS'] as $arItem):?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div class="ml-top-banner">
            <div class="container" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <a class="ml-top-banner__link" href="<?=$arItem['DISPLAY_PROPERTIES']['LINK']['VALUE']?>">
                    <picture class="ml-top-banner__img">
                        <?if (isset($arItem['DISPLAY_PROPERTIES']['BANNER_SMARTPHONE']['FILE_VALUE']['SRC'])):?>
                            <source media="(max-width:420px)" srcset="<?=$arItem['DISPLAY_PROPERTIES']['BANNER_SMARTPHONE']['FILE_VALUE']['SRC']?>" />
                        <?endif;?>
                        <?if (isset($arItem['DISPLAY_PROPERTIES']['BANNER_TABLET']['FILE_VALUE']['SRC'])):?>
                            <source media="(max-width:991px)" srcset="<?=$arItem['DISPLAY_PROPERTIES']['BANNER_TABLET']['FILE_VALUE']['SRC']?>" />
                        <?endif;?>
                        <?if (isset($arItem['DISPLAY_PROPERTIES']['BANNER_DESKTOP']['FILE_VALUE']['SRC'])):?>
                            <img src="<?=$arItem['DISPLAY_PROPERTIES']['BANNER_DESKTOP']['FILE_VALUE']['SRC']?>" alt="<?=$arItem['NAME']?>" />
                        <?endif;?>
                    </picture>
                </a>
            </div>
        </div>
    <?endforeach;?>
<?endif;?>