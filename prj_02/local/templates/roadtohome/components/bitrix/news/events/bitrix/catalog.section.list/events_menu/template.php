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

<div class="nav-tabs-container projects-categories">
    <ul class="text-size-lg nav-tabs">
        <li><a href="<?= $arParams["SEF_FOLDER"] ?>" <? if (!mb_strlen($arParams["CURRENT_CODE"])) { ?> class="active" <? } ?>>Все акции</a></li>
        <? foreach ($arResult["SECTIONS"] as $section) { ?>
            <li><a target="_self" href="<?= $section["SECTION_PAGE_URL"] ?>" <? if ($arParams["CURRENT_CODE"] == $section["CODE"]) { ?> class="active" <? } ?>><?= $section["NAME"] ?></a></li>
        <? } ?>
    </ul>
</div>