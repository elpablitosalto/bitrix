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
use \Bitrix\Main\Localization\Loc;
?>
<?if(file_exists($arResult["FILE"])):?>
    <?
    $includeAreaContent = file_get_contents($arResult["FILE"]);
    ?>
    <span class="nb-footer-contacts-item__label"><?=Loc::getMessage('BOTTOM_EMAIL_LABEL')?></span>
    <a class="nb-footer-contacts-item__link" href="mailto:<?=$includeAreaContent;?>"><?=$includeAreaContent;?></a>
<?endif;?>
