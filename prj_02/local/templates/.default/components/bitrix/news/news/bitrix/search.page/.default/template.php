<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
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
?>

<form action="<?=$arParams["PAGE"]?>" method="get" autocomplete="off" class="search-form" target="_self">
    <input type="hidden" name="set_filter" value="y" />
    <input type="text" placeholder="Поиск" name="q" value="<?=$arResult["REQUEST"]["QUERY"]?>" class="form-control">
    <button type="submit" class="search-form__submit">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
             class="icon icon-loupe">
            <use xlink:href="#loupe"></use>
        </svg>
        <span>Найти</span>
    </button>
</form>
