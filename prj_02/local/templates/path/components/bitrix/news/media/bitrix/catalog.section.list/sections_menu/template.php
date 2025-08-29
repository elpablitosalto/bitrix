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

<div class="media-categories rs__tabs-container">
    <ul class="rs__tabs">
        <li class="rs__tabs__item">
            <a href="/media/" target="_self" <? if (!mb_strlen($arParams["CURRENT_CODE"])) { ?> class="is-acitve" <? } ?>>Вся медиатека</a>
        </li>
        <? foreach ($arResult["SECTIONS"] as $section) { ?>
        <li class="rs__tabs__item">
            <a target="_self" href="<?= $section["SECTION_PAGE_URL"] ?>" <? if ($arParams["CURRENT_CODE"] == $section["CODE"]) { ?> class="is-acitve" <? } ?>><?=$section["NAME"]?></a>
        </li>
        <?}?>
    </ul>
</div>