<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (!$arResult["NavShowAlways"]) {
    if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
        return;
}

$arResult["NavQueryString"] = str_replace(["AJAX_LOAD=Y"], [""], $arResult["NavQueryString"]);

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"] . "&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?" . $arResult["NavQueryString"] : "");

$idNav = 'nav_' . $arResult["NavNum"] . '_' . md5(mt_rand());

$nPageWindow = 3; //количество отображаемых страниц
if ($arResult["NavPageNomer"] > floor($nPageWindow / 2) + 1 && $arResult["NavPageCount"] > $nPageWindow)
    $nStartPage = $arResult["NavPageNomer"] - floor($nPageWindow / 2);
else
    $nStartPage = 1;

if ($arResult["NavPageNomer"] <= $arResult["NavPageCount"] - floor($nPageWindow / 2) && $nStartPage + $nPageWindow - 1 <= $arResult["NavPageCount"])
    $nEndPage = $nStartPage + $nPageWindow - 1;
else {
    $nEndPage = $arResult["NavPageCount"];
    if ($nEndPage - $nPageWindow + 1 >= 1)
        $nStartPage = $nEndPage - $nPageWindow + 1;
}
$arResult["nStartPage"] = $arResult["nStartPage"] = $nStartPage;
$arResult["nEndPage"] = $arResult["nEndPage"] = $nEndPage;

//vardump($arResult);
?>

<? if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]) { ?>
    <?/*?>
    <div id="<?= $idNav ?>">
        <a class="dp-btn dp-section__link js_more_items" data-id-nav="<?= $idNav ?>" data-nav-num="<?= $arResult["NavNum"] ?>" data-page-nomer="<?= $arResult["NavPageNomer"] ?>" data-max-page="<?= $arResult["NavPageCount"] ?>">Показать еще</a>
    </div>
    <?*/ ?>

    <div id="<?= $idNav ?>">
        <a style="display: none;" class="dp-btn dp-section__link js_more_items" data-id-nav="<?= $idNav ?>" data-nav-num="<?= $arResult["NavNum"] ?>" data-page-nomer="<?= $arResult["NavPageNomer"] ?>" data-max-page="<?= $arResult["NavPageCount"] ?>">Показать еще</a>
        <div class="entry-grid__load-trigger-line js-entry-grid-trigger-line">
            <div class="entry-grid__load-trigger-dot">&nbsp;
            </div>
            <div class="entry-grid__load-trigger-dot">&nbsp;
            </div>
            <div class="entry-grid__load-trigger-dot">&nbsp;
            </div>
        </div>
    </div>

<? } ?>