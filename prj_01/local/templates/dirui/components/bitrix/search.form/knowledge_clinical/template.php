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

<form class="recommendation__form" action="<?= $arResult["FORM_ACTION"] ?>">
	<label class="recommendation__label">
		<input class="recommendation__input" type="text" name="q" placeholder="Найти" value="<?= $_GET['q']; ?>">
		<span class="recommendation__search">
			<svg width="16" height="16">
				<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/icons/sprite/svg-sprite.svg#search"></use>
			</svg>
		</span>
	</label>
</form>