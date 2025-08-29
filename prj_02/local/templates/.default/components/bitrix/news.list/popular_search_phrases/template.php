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

<? if (!empty($arResult["ITEMS"])) { ?>

    <div class="search-line__popular">
        <div class="search-popular__title">Популярное:</div>
        <div class="search-popular__tags">
            <? foreach ($arResult["ITEMS"] as $key => $res) {
                $active = "";
                if (urldecode($_GET["q"]) == urldecode($res["NAME"])) {
                    $active = "active";
                }
                $url = $arParams["URL_SEARCH"]."?q=".$res["NAME"]
            ?>
                <a href="<?= $url; ?>" class="<?= $active; ?>">#<?= $res["NAME"] ?></a>
            <? } ?>
        </div>
    </div>


<? } ?>