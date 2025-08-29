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
$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
if ($request->isAjaxRequest() && !empty($request->get("PAGEN_LM_" . $arResult["NavNum"]))) {
    $arResult["NavPageNomer"] = intval($request->get("PAGEN_LM_" . $arResult["NavNum"]));
}
if (!empty($GLOBALS["PAGEN_LM_DEFAULT_COUNT_" . $arResult["NavNum"]])) {
    $arResult["NavPageSize"] = intval($GLOBALS["PAGEN_LM_DEFAULT_COUNT_" . $arResult["NavNum"]]);
    $arResult["NavPageCount"] = ceil($arResult["NavRecordCount"] / $arResult["NavPageSize"]);
}
$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"] . "&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?" . $arResult["NavQueryString"] : "");
?>
<? if (FALSE) { ?>
    <!-- begin .pagination-->
    <div class="pagination">
        <ul class="pagination__list">
            <?/*?>
        <? if ($arResult["NavPageNomer"] > 1) { ?>
            <li class="pagination__item pagination__item_type_prev">
                <a
                    class="pagination__link pagination__link_state_inactive"
                    href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_LM_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] - 1) ?>">
                    Предыдущая страница
                </a>
            </li>
        <? } ?>
        <? if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]) { ?>
            <li class="pagination__item pagination__item_type_next">
                <a
                    class="pagination__link"
                    href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_LM_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>">
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
                    <a class="pagination__link" href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>">
                        <span class="pagination__label"><?= $arResult["nStartPage"] ?></span>
                    </a>
                <? else: ?>
                    <a
                        class="pagination__link"
                        href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_LM_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + $arResult["nStartPage"]) ?>">
                        <span class="pagination__label"><?= $arResult["nStartPage"] ?></span>
                    </a>
                <? endif ?>
                <? $arResult["nStartPage"]++ ?>
            </li>
        <? } ?>
        <?*/ ?>
            <?/**/ ?>
            <? if ($arResult["NavPageNomer"] > 1) { ?>
                <li class="pagination__item pagination__item_type_prev">
                    <a class="pagination__link pagination__link_state_inactive" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] - 1) ?>">
                        Предыдущая страница
                    </a>
                </li>
            <? } ?>
            <? if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]) { ?>
                <li class="pagination__item pagination__item_type_next">
                    <a class="pagination__link" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>">
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
                        <a class="pagination__link" href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>">
                            <span class="pagination__label"><?= $arResult["nStartPage"] ?></span>
                        </a>
                    <? else: ?>
                        <a class="pagination__link" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["nStartPage"] ?>">
                            <span class="pagination__label"><?= $arResult["nStartPage"] ?></span>
                        </a>
                    <? endif ?>
                    <? $arResult["nStartPage"]++ ?>
                </li>
            <? } ?>
            <?/**/ ?>
        </ul>
    </div>
    <!-- end .pagination-->

    <?/*?>
    <!-- begin .pagination-->
    <div class="pagination">
        <ul class="pagination__list">
            <li class="pagination__item pagination__item_type_prev"><a class="pagination__link pagination__link_state_inactive" href="#">Предыдущая страница</a>
            </li>
            <li class="pagination__item pagination__item_type_next"><a class="pagination__link" href="#">Следующая страница</a>
            </li>
            <li class="pagination__item">
                <div class="pagination__label pagination__label_state_active">1
                </div>
            </li>
            <li class="pagination__item"><a class="pagination__link" href="#"><span class="pagination__label">2</span></a>
            </li>
            <li class="pagination__item"><a class="pagination__link" href="#"><span class="pagination__label">3</span></a>
            </li>
        </ul>
    </div>
    <!-- end .pagination-->
    <?*/ ?>
<? } ?>

<? if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]): ?>
    <div class="cards-panel__controls">
        <div class="cards-panel__control">
            <!-- begin .button-->
            <a
                class="button button_width_full button_size_m button_style_secondary"
                href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_LM_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>">
                <span class="button__holder">
                    <span class="button__text">Показать еще</span>
                </span>
            </a>
            <!-- end .button-->
        </div>
    </div>
<? endif ?>