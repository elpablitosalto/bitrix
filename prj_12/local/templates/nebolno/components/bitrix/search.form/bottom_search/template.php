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
use \Bitrix\Main\Localization\Loc;
?>

<div class="nb-footer-search">
	<form class="nb-footer-search-form" action="<?=$arResult["FORM_ACTION"]?>">
		<input class="nb-footer-search-form__input" type="text" placeholder="<?=Loc::getMessage('BSF_T_BOTTOM_SEARCH_PLACEHOLDER')?>" name="q" value="" size="15" maxlength="50" autocomplete="off" />
		<button class="nb-footer-search-form__submit" type="submit">
			<svg class="icon icon-search nb-footer-search-form__icon">
				<use xlink:href="#search"></use>
			</svg>
		</button>
	</form>
</div>