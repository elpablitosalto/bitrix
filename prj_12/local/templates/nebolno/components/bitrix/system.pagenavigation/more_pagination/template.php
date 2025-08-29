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
<?if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
	<div class="nb-pagination" data-entity="pagination">
		<div class="nb-pagination__inner">
			<div class="nb-pagination__counter">
				<span class="font-weight_bold"><?=$arResult["NavLastRecordShow"]?></span> <?=GetMessage("nav_of")?> <?=$arResult["NavRecordCount"]?>
			</div>
			<button data-entity="load-more" data-href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>" class="nb-btn nb-btn_light nb-btn_shadow nb-pagination__btn" type="button">Показать ещё</button>
		</div>
	</div>
<?endif;?>