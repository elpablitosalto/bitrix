<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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

if (count($arResult["ITEMS"]) == 0)
	return false;

//vardump($arResult["ITEMS"]);	

foreach ($arResult["ITEMS"] as $key => $val) {
	$date = $val["PROPERTIES"]["DATE"]["VALUE"];
	$city = $val["PROPERTIES"]["CITY"]["VALUE"];
?>
	<div class="col-sm-6">
		<div class="nb-document nb-document-frame"><a class="nb-document__link" href="<?=$val["DETAIL_PAGE_URL"];?>">
				<div class="nb-document__title"><?=$val["NAME"];?></div>
				<div class="nb-document__desc">
					<p><?=$val["PREVIEW_TEXT"];?></p>
				</div>
				<div class="nb-document__meta">
					<time datetime="<?=date("Y-m-d", strtotime($date))?>"><?=$date;?></time> 
					г. <?=$city;?>.
				</div>
			</a>
		</div>
	</div>
<?
}
?>