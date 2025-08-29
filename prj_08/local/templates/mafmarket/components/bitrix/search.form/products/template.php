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
$this->setFrameMode(true); ?>

<form action="<?= $arResult["FORM_ACTION"] ?>">
	<label class="c-form--label c-form--label__search">
		<input class="c-form--input" type="text" name="q" placeholder="Найти" value="<?=$_GET['q'];?>" />
		<button class="c-form--label__search_clear display-none" type="button">
			<svg width="14" height="14">
				<use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons/sprite/svg-sprite.svg#close2"></use>
			</svg>
		</button>
		<svg width="2" height="16">
			<use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons/sprite/svg-sprite.svg#line"></use>
		</svg>
		<button class="c-form--label__search_search" type="submit">
			<svg width="18" height="18">
				<use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons/sprite/svg-sprite.svg#search"></use>
			</svg>
		</button>
		<div class="c-form--label__result c-form--label__all display-none">
			<a href="#">Гематологический анализатор</a>
			<a href="#">Гематологический анализатор</a>
			<a href="#">Гематологический анализатор</a>
		</div>
	</label>
</form>