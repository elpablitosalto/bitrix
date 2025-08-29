<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Page\Asset;

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

if (!function_exists('sort_names')) {
    function sort_names($a, $b)
    {
        if ($a["VALUE"] == $b["VALUE"]) {
            return 0;
        }
        return ($a["VALUE"] < $b["VALUE"]) ? -1 : 1;
    }
}

?>

<div class="col-12">
    <div id="projects-filter" class="projects-filter<? if ($arParams["SET_FILTER"] == "Y") echo " active"; ?>">

        <form id="filter-form" name="<? echo $arResult["FILTER_NAME"] . "_form" ?>" action="<?= $arParams["ACTION"] ?>" method="get" class="filter-form">

            <div class="row align-items-center">
                <? foreach ($arResult["HIDDEN"] as $arItem) : ?>
                    <?
                    if ($arItem["CONTROL_NAME"] == "input-search")
                        continue;
                    ?>
                    <input type="hidden" name="<? echo $arItem["CONTROL_NAME"] ?>" id="<? echo $arItem["CONTROL_ID"] ?>" value="<? echo $arItem["HTML_VALUE"] ?>" />
                <? endforeach; ?>

                <?
                //vardump($arResult["ITEMS"]);
                foreach ($arResult["ITEMS"] as $key => $arItem) {
                    if (
                        empty($arItem["VALUES"])
                        || isset($arItem["PRICE"])
                    )
                        continue;

                    if (
                        $arItem["DISPLAY_TYPE"] == "A"
                        && ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0
                        )
                    )
                        continue;

                    if (is_array($arParams["SKIP_PROPS"])) {
                        if (in_array($arItem["CODE"], $arParams["SKIP_PROPS"]))
                            continue;
                    }

                    switch ($arItem["CODE"]) {
                            //спецфильтры
                        case "SPEC";
                            break;
                            //для всего остального
                        default:
                            switch ($arItem["DISPLAY_TYPE"]) {
                                case "P": //DROPDOWN
                                    usort($arItem["VALUES"], "sort_names");
                                    $checkedItemExist = false;
                                    $arCur = current($arItem["VALUES"]);
                ?>
                                    <div class="col-sm-6 col-lg-4">
                                        <div class="form-group">

                                            <input style="display: none" type="checkbox" name="<?= $arCur["CONTROL_NAME"] ?>" id="<? echo "all_" . $arCur["CONTROL_ID"] ?>" value="" />
                                            <?
                                            foreach ($arItem["VALUES"] as $val => $ar) : ?>
                                                <input style="display: none" type="checkbox" value="<? echo $ar["HTML_VALUE"] ?>" name="<? echo $ar["CONTROL_NAME"] ?>" id="<? echo $ar["CONTROL_ID"] ?>" <? echo $ar["CHECKED"] ? 'checked="checked"' : '' ?> />
                                            <?
                                            endforeach;
                                            ?>
                                            <?
                                            $bFirstSelected = true;
                                            foreach ($arItem["VALUES"] as $keyItem => $arValue) {
                                                if ($arValue["CHECKED"]) {
                                                    $bFirstSelected = false;
                                                }
                                            }
                                            ?>

                                            <select multiple id="filter_prop_<?= $arItem["CODE"] ?>" id="pf-1" name="pf-1" class="form-control filter-select">
                                                <option disabled <? if ($bFirstSelected) { ?>selected<? } ?> value="<?= "all_" . $arCur["CONTROL_ID"] ?>" class="placeholder-option"><?= $arItem["NAME"] ?></option>
                                                <?/*?><option value="<?= "all_" . $arCur["CONTROL_ID"] ?>"><?= $arItem["NAME"] ?></option><?*/ ?>
                                                <? foreach ($arItem["VALUES"] as $keyItem => $arValue) : ?>
                                                    <option value="<?= CUtil::JSEscape($arValue["CONTROL_ID"]) ?>" <? if ($arValue["CHECKED"]) : ?>selected<? endif; ?>><?= $arValue["VALUE"]; ?></option>
                                                <? endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                <?
                                    break;
                                default:
                                ?>
                                    <div class="col-sm-6 col-lg-4">
                                        <?
                                        foreach ($arItem["VALUES"] as $val => $ar) : ?>
                                            <div class="form-group">
                                                <input type="checkbox" class="custom-checkbox" value="<? echo $ar["HTML_VALUE"] ?>" name="<? echo $ar["CONTROL_NAME"] ?>" id="<? echo $ar["CONTROL_ID"] ?>" <? echo $ar["DISABLED"] ? 'disabled' : '' ?> <? echo $ar["CHECKED"] ? 'checked="checked"' : '' ?> onclick="smartFilter.click(this)" />
                                                <label data-role="label_<?= $ar["CONTROL_ID"] ?>" for="<? echo $ar["CONTROL_ID"] ?>" class="custom-checkbox-label"><?= $ar["VALUE"]; ?></label>
                                            </div>
                                        <? endforeach; ?>
                                    </div>
                <?
                                    break;
                            }
                            break;
                    }
                }
                ?>
            </div>
        </form>


        <div style="display: none" class="bx-filter-popup-result" id="modef" style="display:none">
            <a></a>
        </div>
        <div style="display: none" class="row">
            <div class="col-xs-12 bx-filter-button-box">
                <div class="bx-filter-block">
                    <div class="bx-filter-parameters-box-container">
                        <input class="btn btn-themes" type="submit" id="set_filter" name="set_filter" value="<?= GetMessage("CT_BCSF_SET_FILTER") ?>" />
                        <input class="btn btn-link" type="submit" id="del_filter" name="del_filter" value="<?= GetMessage("CT_BCSF_DEL_FILTER") ?>" />
                        <div class="bx-filter-popup-result <? if ($arParams["FILTER_VIEW_MODE"] == "VERTICAL") echo $arParams["POPUP_POSITION"] ?>" id="modef" <? if (!isset($arResult["ELEMENT_COUNT"])) echo 'style="display:none"'; ?> style="display: inline-block;">
                            <? echo GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span id="modef_num">' . intval($arResult["ELEMENT_COUNT"]) . '</span>')); ?>
                            <span class="arrow"></span>
                            <br />
                            <a href="<? echo $arResult["FILTER_URL"] ?>" target=""><? echo GetMessage("CT_BCSF_FILTER_SHOW") ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </form>

    </div>
</div>

<? // Очистить фильтр --> 
?>
<? if ($arResult["bShowUnsetAll"]) { ?>
    <div class="col-12 news-filter__bottom order-sm-last">
        <div class="form-group">
            <div class="buttons-line">
                <a id="filter_reset_link" target="_self" href="<?= $arResult["URL_UNSET_ALL"]; ?>" style="display:none;"></a>
                <button id="filter_reset" type="reset" data-href="<?= $arResult["URL_UNSET_ALL"]; ?>" class="btn news-filter__btn-reset">Очистить фильтр
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-close">
                        <use xlink:href="#close"></use>
                    </svg>
                </button>
            </div>
        </div>
    </div>
<? } ?>
<? // <-- Очистить фильтр 
?>

<script type="text/javascript">
    var smartFilter = new JCSmartFilter('<? echo CUtil::JSEscape($arResult["FORM_ACTION"]) ?>', '<?= CUtil::JSEscape($arParams["FILTER_VIEW_MODE"]) ?>', <?= CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"]) ?>);
    $(document).ready(function() {
        $("#filter_reset").on("click", function(e) {
            // $('#filter_reset_link').click();
            window.location.href = $(this).attr('data-href');
        });

        InitSelects();
        $(".filter-select").parents(".selectric-wrapper").find(".selectric-scroll li").on("click", function() {
            var index = $(this).data("index") + 1;
            if (index == 1) {
                $(this).parents(".selectric-wrapper").find("option:selected").each(function() {
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