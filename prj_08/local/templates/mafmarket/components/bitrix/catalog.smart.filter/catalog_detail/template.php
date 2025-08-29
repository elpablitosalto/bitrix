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

use Bitrix\Iblock\SectionPropertyTable;

$this->setFrameMode(true);

$this->setViewTarget('detail_filter');
?>

    <form name="<? echo $arResult["FILTER_NAME"] . "_form" ?>" action="<? echo $arResult["FORM_ACTION"] ?>" method="get"
          class="smartfilter">


        <? foreach ($arResult["HIDDEN"] as $arItem): ?>
            <input type="hidden" name="<? echo $arItem["CONTROL_NAME"] ?>" id="<? echo $arItem["CONTROL_ID"] ?>"
                   value="<? echo $arItem["HTML_VALUE"] ?>"/>
        <? endforeach; ?>

        <div class="dp-series-models__short-filter">
            <div class="row">
                <div class="col-sm-24 d-lg-none">
                    <div class="row">
                        <div class="col-sm-auto"><a class="dp-btn dp-btn_select-like" href="#"
                                                    data-modal="#modal-series-models"><span>Модели</span></a></div>
                    </div>
                </div>

                <?
                //not prices
                foreach ($arResult["ITEMS"] as $key => $arItem) {
                    if (
                        empty($arItem["VALUES"])
                        || isset($arItem["PRICE"])
                    )
                        continue;

                    if (in_array($arItem["CODE"], $arParams["HIDDEN_FILTERS"]))
                        continue;

                    if (
                        $arItem["DISPLAY_TYPE"] === SectionPropertyTable::NUMBERS_WITH_SLIDER
                        && ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0)
                    )
                        continue;
                    ?>

                    <?
                    $arCur = current($arItem["VALUES"]);
                    $nonChecked = true;
                    $allCount = 0;
                    foreach ($arItem["VALUES"] as $val => $ar) {
                        $allCount += intval($ar["ELEMENT_COUNT"]);
                        if ($ar["CHECKED"]) {
                            $nonChecked = false;
                        }
                    }
                    switch ($arItem["DISPLAY_TYPE"]) {
                        default://CHECKBOXES

                            ?>

                            <input
                                    style="display: none"
                                    type="radio"
                                    name="<?= $arCur["CONTROL_NAME_ALT"] ?>"
                                    id="<? echo "all_" . $arCur["CONTROL_ID"] ?>"
                                    value=""
                            />
                            <?
                            foreach ($arItem["VALUES"] as $val => $ar):?>
                                <input
                                        style="display: none"
                                        type="radio"
                                        name="<?= $ar["CONTROL_NAME_ALT"] ?>"
                                        id="<?= $ar["CONTROL_ID"] ?>"
                                        value="<? echo $ar["HTML_VALUE_ALT"] ?>"
                                    <? echo $ar["CHECKED"] ? 'checked="checked"' : '' ?>
                                />
                            <?
                            endforeach ?>

                            <div class="col-sm-auto">
                                <select class="dp-select filter-select">
                                    <option
                                            value="<?= "all_" . $arCur["CONTROL_ID"] ?>"><?= $arItem["NAME"] ?></option>
                                    <?
                                    foreach ($arItem["VALUES"] as $keyItem => $arValue):?>
                                        <option
                                                value="<?= CUtil::JSEscape($arValue["CONTROL_ID"]) ?>" <?
                                        if ($arValue["CHECKED"]): ?>selected<?
                                        endif;
                                        ?>><?= $arValue["VALUE"]; ?></option>
                                    <? endforeach; ?>
                                </select>
                            </div>

                        <?
                    }
                    ?>

                    <?
                }
                ?>

                <script type="text/javascript">
                    var smartFilter = new JCSmartFilter('<? echo CUtil::JSEscape($arResult["FORM_ACTION"]) ?>', '<?= CUtil::JSEscape($arParams["FILTER_VIEW_MODE"]) ?>', <?= CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"]) ?>);
                    $(document).ready(function () {
                        $(".filter-select").parents(".selectric-wrapper").find(".selectric-scroll li").on("click", function () {
                            var index = $(this).data("index") + 1;
                            if (index == 1) {
                                $(this).parents(".selectric-wrapper").find("option:selected").each(function () {
                                    var curOpt = $(this);
                                    $("#" + curOpt.val()).click();
                                    smartFilter.keyup(BX(curOpt.val()));
                                });
                            } else {
                                var curOpt = $(this).parents(".selectric-wrapper").find("option:nth-child(" + index + ")")
                                $("#" + curOpt.val()).click();
                                smartFilter.keyup(BX(curOpt.val()));
                            }
                        });
                    });
                </script>

                <div class="col-sm-auto"><a
                            class="dp-btn dp-btn_sm dp-btn_white dp-series-models-aside-filter-toggler<?if($_REQUEST["set_filter"] == "y") echo ' active';?>"
                            href="#"><span class="text-show">Все фильтры</span><span
                                class="text-hide">Скрыть фильтры</span>
                        <svg class="icon icon-filter ">
                            <use xlink:href="#filter"></use>
                        </svg>
                        <svg class="icon icon-close ">
                            <use xlink:href="#close"></use>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="dp-series-models-aside-filter<?if($_REQUEST["set_filter"] == "y") echo ' active';?>">
            <div class="row">
                <!--
                <div class="col-24">
                    <div class="row">
                        <div class="col-sm-8 col-lg-auto">
                            <div class="dp-series-models-aside-filter__item">
                                <select class="dp-select filter-select">
                                    <option value="">Модели</option>
                                    <option value="">Модели1</option>
                                    <option value="">Модели2</option>
                                    <option value="">Модели3</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-8 col-lg-auto">
                            <div class="dp-series-models-aside-filter__item">
                                <select class="dp-select filter-select">
                                    <option value="">Модели</option>
                                    <option value="">Модели1</option>
                                    <option value="">Модели2</option>
                                    <option value="">Модели3</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                -->


                <?
                //sliders
                foreach ($arResult["ITEMS"] as $key => $arItem) {
                    if (
                        empty($arItem["VALUES"])
                        || isset($arItem["PRICE"])
                    )
                        continue;

                    if ($arItem["DISPLAY_TYPE"] != "A" || !in_array($arItem["CODE"], $arParams["HIDDEN_FILTERS"]))
                        continue;

                    if (
                        $arItem["DISPLAY_TYPE"] === SectionPropertyTable::NUMBERS_WITH_SLIDER
                        && ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0)
                    )
                        continue;
                    ?>

                    <?
                    $arCur = current($arItem["VALUES"]);
                    $nonChecked = true;
                    $allCount = 0;
                    foreach ($arItem["VALUES"] as $val => $ar) {
                        $allCount += intval($ar["ELEMENT_COUNT"]);
                        if ($ar["CHECKED"]) {
                            $nonChecked = false;
                        }
                    }
                    ?>

                    <div class="col-sm-12 col-lg-8">
                        <div class="dp-series-models-aside-filter__item">
                            <div class="dp-range-block">
                                <div class="dp-range-block__title"><?= $arItem["NAME"] ?>:</div>
                                <div class="dp-range-block__inputs">
                                    <div class="dp-range-block__input">
                                        <label>от</label>
                                        <input
                                                class="dp-input"
                                                type="text"
                                                name="<? echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"] ?>"
                                                id="<? echo $arItem["VALUES"]["MIN"]["CONTROL_ID"] ?>"
                                                value="<? echo $arItem["VALUES"]["MIN"]["HTML_VALUE"] ?>"
                                                onchange="smartFilter.keyup(this)"
                                        >
                                    </div>
                                    <div class="dp-range-block__input">
                                        <label>до</label>
                                        <input
                                                class="dp-input"
                                                type="text"
                                                name="<? echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"] ?>"
                                                id="<? echo $arItem["VALUES"]["MAX"]["CONTROL_ID"] ?>"
                                                value="<? echo $arItem["VALUES"]["MAX"]["HTML_VALUE"] ?>"
                                                size="5"
                                                onchange="smartFilter.keyup(this)"
                                        >
                                    </div>
                                </div>
                                <?
                                $precision = $arItem["DECIMALS"] ? $arItem["DECIMALS"] : 0;
                                $step = ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"]) / 4;
                                $value1 = number_format($arItem["VALUES"]["MIN"]["VALUE"], $precision, ".", "");
                                $value2 = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step, $precision, ".", "");
                                $value3 = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step * 2, $precision, ".", "");
                                $value4 = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step * 3, $precision, ".", "");
                                $value5 = number_format($arItem["VALUES"]["MAX"]["VALUE"], $precision, ".", "");
                                ?>
                                <div class="dp-ui-slider" data-limits="<?= $value1 ?>,<?= $value5 ?>"
                                     data-values="<? echo $arItem["VALUES"]["MIN"]["HTML_VALUE"] ?>,<? echo $arItem["VALUES"]["MAX"]["HTML_VALUE"] ?>"></div>
                            </div>
                        </div>
                    </div>
                <? } ?>

            </div>
        </div>


    </form>

<? $this->endViewTarget(); ?>