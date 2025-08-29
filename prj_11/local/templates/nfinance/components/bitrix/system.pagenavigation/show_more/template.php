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

//vardump($arParams);
//vardump($arResult);
?>
<div class="cards-panel__pagination">

    <div class="pagination">
        <ul class="pagination__list">
            <? if ($arResult["NavPageNomer"] > 1) { ?>
                <li class="pagination__item pagination__item_type_prev">
                    <a
                        target="_self"
                        data-nav-num="<?= $arResult["NavNum"] ?>"
                        data-add-url-param-name="PAGEN_<?= $arResult["NavNum"] ?>"
                        data-add-url-param-value="<?= ($arResult["NavPageNomer"] - 1) ?>"
                        class="js_pagination_link pagination__link js_pagination_link <?/*?>pagination__link_state_inactive<?*/ ?>"
                        href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] - 1) ?>">
                        Предыдущая страница
                    </a>
                </li>
            <? } ?>
            <? if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]) { ?>
                <li class="pagination__item pagination__item_type_next">
                    <a
                        target="_self"
                        data-nav-num="<?= $arResult["NavNum"] ?>"
                        data-add-url-param-name="PAGEN_<?= $arResult["NavNum"] ?>"
                        data-add-url-param-value="<?= ($arResult["NavPageNomer"] + 1) ?>"
                        class="js_pagination_link pagination__link"
                        href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>">
                        Следующая страница
                    </a>
                </li>
            <? } ?>
            <? while ($arResult["nStartPage"] <= $arResult["nEndPage"]) { ?>
                <li class="pagination__item">
                    <? if ($arResult["nStartPage"] == $arResult["NavPageNomer"]): ?>
                        <div class="pagination__label pagination__label_state_active">
                            <?= $arResult["nStartPage"] ?>
                        </div>
                    <? elseif ($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false): ?>
                        <a
                            target="_self"
                            data-nav-num="<?= $arResult["NavNum"] ?>"
                            data-add-url-param-name="PAGEN_<?= $arResult["NavNum"] ?>"
                            data-add-url-param-value="<?= $arResult["nStartPage"] ?>"
                            class="js_pagination_link pagination__link"
                            href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>">
                            <span class="pagination__label"><?= $arResult["nStartPage"] ?></span>
                        </a>
                    <? else: ?>
                        <a
                            target="_self"
                            data-nav-num="<?= $arResult["NavNum"] ?>"
                            data-add-url-param-name="PAGEN_<?= $arResult["NavNum"] ?>"
                            data-add-url-param-value="<?= $arResult["nStartPage"] ?>"
                            class="js_pagination_link pagination__link"
                            href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["nStartPage"] ?>">
                            <span class="pagination__label"><?= $arResult["nStartPage"] ?></span>
                        </a>
                    <? endif ?>
                    <? $arResult["nStartPage"]++ ?>
                </li>
            <? } ?>
        </ul>
    </div>
</div>

<? if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]) { ?>
    <div class="cards-panel__controls" id="<?= $idNav ?>">
        <div class="cards-panel__control">
            <!-- begin .button-->
            <a
                target="_self"
                class="button button_width_full button_size_m button_style_secondary js_more_items"
                <?/*?>
                href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_LM_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>"
                <?*/ ?>
                data-id-nav="<?= $idNav ?>"
                data-nav-num="<?= $arResult["NavNum"] ?>"
                data-page-nomer="<?= $arResult["NavPageNomer"] ?>"
                data-max-page="<?= $arResult["NavPageCount"] ?>"
                data-add-url-param-name="PAGEN_<?= $arResult["NavNum"] ?>"
                data-add-url-param-value="<?= ($arResult["NavPageNomer"]+1) ?>">
                <span class="button__holder">
                    <span class="button__text">Показать еще</span>
                </span>
            </a>
            <!-- end .button-->
        </div>
    </div>
<? } ?>