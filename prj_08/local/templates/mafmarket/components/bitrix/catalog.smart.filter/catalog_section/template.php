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

?>

<form name="<? echo $arResult["FILTER_NAME"] . "_form" ?>" action="<? echo $arResult["FORM_ACTION"] ?>" method="get"
      class="smartfilter">

    <div class="dp-catalog-filter">
        <div class="row">


            <? foreach ($arResult["HIDDEN"] as $arItem): ?>
                <input type="hidden" name="<? echo $arItem["CONTROL_NAME"] ?>" id="<? echo $arItem["CONTROL_ID"] ?>"
                       value="<? echo $arItem["HTML_VALUE"] ?>"/>
            <? endforeach; ?>

            <?
            //not prices
            foreach ($arResult["ITEMS"] as $key => $arItem) {
                if (
                    empty($arItem["VALUES"])
                    || isset($arItem["PRICE"])
                )
                    continue;

				if($arItem["DISPLAY_TYPE"] == "A")
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
                $(document).ready(function() {
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

        </div>
    </div>

</form>

