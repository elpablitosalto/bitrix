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
$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
if($request->isAjaxRequest() && !empty($request->get("PAGEN_LM_".$arResult["NavNum"]))){
    $arResult["NavPageNomer"] = intval($request->get("PAGEN_LM_".$arResult["NavNum"]));
}
if(!empty($GLOBALS["PAGEN_LM_DEFAULT_COUNT_".$arResult["NavNum"]])){
    $arResult["NavPageSize"] = intval($GLOBALS["PAGEN_LM_DEFAULT_COUNT_".$arResult["NavNum"]]);
    $arResult["NavPageCount"] = ceil($arResult["NavRecordCount"] / $arResult["NavPageSize"]);
}
$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");
?>
<?if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
    <div class="event-list__controls">
        <div class="event-list__control">
            <!-- begin .button-->
             <a
                class="button button_width_full button_size_m button_style_secondary"
                href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_LM_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"] + 1)?>"
            >
                <span class="button__holder">
                    <span class="button__text">Показать еще</span>
                </span>
            </a>
            <!-- end .button-->
        </div>
    </div>
<?endif?>