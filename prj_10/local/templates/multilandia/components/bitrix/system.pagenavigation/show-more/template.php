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
?>
<?
//var_dump('YES');
//var_dump($arResult["NavPageNomer"]);
//var_dump($arResult["NavPageCount"]);
//echo '<pre>' . print_r($arResult, true) . '</pre>';
//$arResult['nStartPage'] = 1;
//$arResult['NavPageNomer'] = 1;
global $APPLICATION;
?>
<?if($arResult["NavPageCount"] > 1):?>

    <?if ($arResult["NavPageNomer"]+1 <= $arResult["nEndPage"]):?>
        <?
        $plus = $arResult["NavPageNomer"]+1;
        //$url = $arResult["sUrlPathParams"] . "PAGEN_".$arResult["NavNum"]."=".$plus;
        $url = $APPLICATION->GetCurPage(false) . "?PAGEN_".$arResult["NavNum"]."=".$plus
        ?>

        <div class="load-more-items" data-url="<?=$url?>">Показать еще</div>

    <?endif?>
<?endif?>
