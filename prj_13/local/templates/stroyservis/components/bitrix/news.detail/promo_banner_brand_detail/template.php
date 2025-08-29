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
?>
<div class="promotion__content" style="background-image: url('<?=$arResult['PICTURE']['SRC'];?>')">
	<p><?=$arResult['DISPLAY_PROPERTIES']['BANNER_HEADER']['VALUE']?></p>
	<a class="promotion__more" href="<?=$arResult['DETAIL_URL_TOKEN']?>">Подробнее</a>
    <div class="promotion__adline"><?=$arResult['DISPLAY_PROPERTIES']['BANNER_ADV_SIGN']['VALUE']?></div>
	<div class="promotion__background">
		<div class="promotion__background_1"></div>
		<div class="promotion__background_1"></div>
		<div class="promotion__background_2"></div>
		<div class="promotion__background_4"></div>
		<div class="promotion__background_3"></div>
		<div class="promotion__background_1"></div>
		<div class="promotion__background_4"></div>
		<div class="promotion__background_4"></div>
		<div class="promotion__background_1"></div>
	</div>
</div>