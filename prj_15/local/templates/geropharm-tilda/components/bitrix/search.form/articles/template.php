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

<form class="dp-form dp-form-search-items" action="<?= $arResult["FORM_ACTION"] ?>">
	<div class="dp-form-search-items__inner">
		<div class="dp-field dp-field_m">
			<input type="text" name="q" placeholder="Поиск по названию" value="<?= $_GET['q']; ?>" />
		</div>
		<button class="dp-form__submit" type="submit">
			<svg class="icon icon-search-tablet ">
				<use xlink:href="#search-tablet"></use>
			</svg>
		</button>
		<button class="dp-form__close" type="button">
			<svg class="icon icon-search-close ">
				<use xlink:href="#search-close"></use>
			</svg>
		</button>
	</div>
</form>