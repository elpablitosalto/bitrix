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
$templateData = array(
	'TEMPLATE_CLASS' => 'bx-'.$arParams['TEMPLATE_THEME']
);

if (isset($templateData['TEMPLATE_THEME']))
{
	$this->addExternalCss($templateData['TEMPLATE_THEME']);
}

?>
<form id="events-filter-form" name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="/infinity/ajax/infinityDownloadsFilter.php" method="get" class="smart-filter-form">
    <?foreach($arResult["HIDDEN"] as $arItem):?>
        <input type="hidden" name="<?echo $arItem["CONTROL_NAME"]?>" id="<?echo $arItem["CONTROL_ID"]?>" value="<?echo $arItem["HTML_VALUE"]?>" />
    <?endforeach;?>
    <?
    foreach($arResult["ITEMS"] as $key => $arItem):
        if (empty($arItem["VALUES"]) || isset($arItem["PRICE"]))
            continue;

        if ($arItem["CODE"] != "PRODUCT_LINES")
            continue;
        ?>
        <?
        $arCur = current($arItem["VALUES"]);
        ?>
        <div class="entity-grid__select">
            <!-- begin .choices-select-->
            <div class="choices-select">
                <select class="choices-select__select js-select" name="<?=$arCur["CONTROL_NAME"] ?>" id="<?=$arCur["CONTROL_ID"] ?>">
                    <option value="0" class="choices-select__option">
                        Тип материалов
                    </option>
                    <?foreach($arItem["VALUES"] as $val => $ar):?>
                        <?$label = preg_replace('/[^a-zа-я -:\/\\ ]/ui', '', $ar["VALUE"])?>
                        <option
                            value="<?=$val ?>"
                            class="choices-select__option"
                            <?=$ar["CHECKED"]? 'selected="selected"': '' ?>
                            <?=$ar["DISABLED"] ? 'disabled': '' ?>
                        >
                            <?=$label;?>
                        </option>
                    <?endforeach;?>
                </select>
            </div>
            <!-- end .choices-select-->
        </div>
    <?endforeach;?>
</form>