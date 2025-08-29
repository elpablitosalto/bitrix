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
<form class="dp-header-search-form" method="get" action="<?= $arResult["FORM_ACTION"] ?>">
	<input id="title-search-input" class="dp-header-search-form__input" name="q" type="text" placeholder="Поиск" autocomplete="off">
	<button class="dp-header-search-form__submit" type="submit"><span class="dp-header-search-form__submit-icon"></span><span class="dp-header-search-form__submit-desc">Найти</span></button>
	<button class="dp-header-search-form__close" type="button">
		<svg class="icon icon-search-close ">
			<use xlink:href="#search-close"></use>
		</svg>
	</button>
</form>

<?/*?>
<form class="dp-header-search-form">
	<input id="title-search-input" class="dp-header-search-form__input" type="text" placeholder="Поиск">
	<button class="dp-header-search-form__submit" type="submit"><span class="dp-header-search-form__submit-icon"></span><span class="dp-header-search-form__submit-desc">Найти</span></button>
	<button class="dp-header-search-form__close" type="button">
		<svg class="icon icon-search-close ">
			<use xlink:href="#search-close"></use>
		</svg>
	</button>
</form>
<?*/?>