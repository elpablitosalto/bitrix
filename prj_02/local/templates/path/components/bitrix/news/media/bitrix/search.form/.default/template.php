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
$this->setFrameMode(true);?>

<form action="<?=$arResult["FORM_ACTION"]?>" class="rs__input--label">
    <div class="rs__input--block">
        <div class="rs__input--group is-line">
            <input name="q"  class="rs__input" type="text" placeholder="Что ищем?">
            <button class="rs__button__default rs__button--icon ico-search rs__button__default--clean rs__button--icon-left" type="submit">Найти</button>
        </div>
    </div>
</form>