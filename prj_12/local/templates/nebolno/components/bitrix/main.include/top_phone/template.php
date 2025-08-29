<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
<?if(file_exists($arResult["FILE"])):?>
    <?
    $includeAreaContent = file_get_contents($arResult["FILE"]);
    ?>
    <a class="nb-btn nb-btn_light nb-call-btn nb-header-call-btn" href="tel:<?=Indexis::getCleanPhoneNumber($includeAreaContent);?>">
        <svg class="icon icon-call">
            <use xlink:href="#call"></use>
        </svg>
        <span><?=$includeAreaContent;?></span>
    </a>
<?endif;?>
