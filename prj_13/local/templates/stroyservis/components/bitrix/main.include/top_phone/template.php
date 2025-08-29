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
    <a class="header__phone" href="tel:<?=Indexis::getCleanPhoneNumber($includeAreaContent);?>"><?=$includeAreaContent;?><span></span></a>
<?endif;?>
