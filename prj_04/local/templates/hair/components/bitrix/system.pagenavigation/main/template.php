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

if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");
?>

<ul class="main-pager">

<?if ($arResult["NavPageNomer"] > 1):?>

	<?if($arResult["bSavePage"]):?>
		<li class="main-pager__item">
			<a class="main-pager__arrow main-pager__arrow_type_prev" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>"><?=GetMessage("nav_prev")?></a>
		</li>
	<?else:?>
		<li class="main-pager__item">
			<a class="main-pager__arrow main-pager__arrow_type_prev" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>"><?=GetMessage("nav_prev")?></a>
		</li>
	<?endif?>

<?else:?>
	<li class="main-pager__item">
		<span class="main-pager__arrow main-pager__arrow_type_prev"><?=GetMessage("nav_prev")?></span>
	</li>
<?endif?>

<?while($arResult["nStartPage"] <= $arResult["nEndPage"]):?>
	<li class="main-pager__item">
		<?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
			<span class="main-pager__current"><?=$arResult["nStartPage"]?></span>
		<?elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):?>
			<a class="main-pager__link" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$arResult["nStartPage"]?></a>
		<?else:?>
			<a class="main-pager__link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$arResult["nStartPage"]?></a>
		<?endif?>
		<?$arResult["nStartPage"]++?>
	</li>
<?endwhile?>

<?if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
	<li class="main-pager__item">
		<a class="main-pager__arrow main-pager__arrow_type_next" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>"><?=GetMessage("nav_next")?></a>
	</li>
<?else:?>
	<li class="main-pager__item">
		<span class="main-pager__arrow main-pager__arrow_type_next"><?=GetMessage("nav_next")?></span>
	</li>
<?endif?>

</ul>