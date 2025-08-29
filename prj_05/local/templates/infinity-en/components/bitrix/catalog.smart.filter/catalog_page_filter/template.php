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
$templateData = array(
    'TEMPLATE_CLASS' => 'bx-' . $arParams['TEMPLATE_THEME']
);

if (isset($templateData['TEMPLATE_THEME'])) {
    $this->addExternalCss($templateData['TEMPLATE_THEME']);
}
//$action = '/infinity/ajax/infinityCatalogFilter.php';
$action = $APPLICATION->GetCurPage();
?>
<? if (!empty($arResult["ITEMS"])) { ?>
    <form id="catalog-filter-form" name="<? echo $arResult["FILTER_NAME"] . "_form" ?>" action="<?= $action; ?>" method="get" class="js-smart-filter-form">
        <? foreach ($arResult["HIDDEN"] as $arItem): ?>
            <input type="hidden" name="<? echo $arItem["CONTROL_NAME"] ?>" id="<? echo $arItem["CONTROL_ID"] ?>" value="<? echo $arItem["HTML_VALUE"] ?>" />
        <? endforeach; ?>
        <div class="entry-grid__filters">
            <!-- begin .choice-group-->
            <div class="choice-group choice-group_type_solid">
                <ul class="choice-group__list">

                    <? foreach ($arResult["ITEMS"] as $key => $arItem) { ?>
                        <?
                        if ($arItem["CODE"] != "PRODUCT_TYPE" || empty($arItem["VALUES"])) {
                            continue;
                        }
                        if (is_array($arItem["VALUES"])) {
                            $current = current($arItem["VALUES"]);
                        }
                        ?>
                        <li class="choice-group__item">
                            <label class="choice-group__label">
                                <input class="choice-group__input" type="radio" id="id_<? echo $current["CONTROL_NAME_ALT"] ?>" value="" name="<? echo $current["CONTROL_NAME_ALT"] ?>" checked="checked" />
                                <span class="choice-group__panel js_radio_filter_span" data-radio-id="id_<? echo $current["CONTROL_NAME_ALT"] ?>"><?= GetMessage('CT_BCSF_FILTER_ALL_PRODUCTS'); ?></span>
                            </label>
                        </li>
                        <? foreach ($arItem["VALUES"] as $val => $arValue) { ?>
                            <li class="choice-group__item">
                                <label class="choice-group__label" for="<? echo $arValue["CONTROL_ID"] ?>">
                                    <input
                                        class="choice-group__input"
                                        type="radio"
                                        value="<? echo $arValue["URL_ID"] ?>"
                                        name="<? echo $arValue["CONTROL_NAME_ALT"] ?>"
                                        id="<? echo $arValue["CONTROL_ID"] ?>"
                                        <? echo $arValue["CHECKED"] ? 'checked="checked"' : '' ?> />
                                    <span class="choice-group__panel js_radio_filter_span" data-radio-id="<? echo $arValue["CONTROL_ID"]; ?>"><?= $arValue["VALUE"] ?></span>
                                </label>
                            </li>
                        <? } ?>
                    <? } ?>
                </ul>
            </div>
            <!-- end .choice-group-->
        </div>
    </form>
<? } ?>