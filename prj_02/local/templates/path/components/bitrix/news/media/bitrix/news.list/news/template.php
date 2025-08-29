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
//vardump($arResult["ITEMS"]);

?>

<? if ($arParams["AJAX_LOAD"] != "Y" || TRUE) { ?>
    <div class="rs__materials--block <?= "nav_result_" . $arResult['NAV_RESULT']->NavNum; ?>">
<? } ?>
<?
foreach ($arResult["ITEMS"] as $arItem) {
    $show_type = 1;
    if (strlen($arItem["SHOW_TYPE"]) > 0) {
        $show_type = $arItem["SHOW_TYPE"];
    }
    ?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>
    <? if ($show_type == 1) { ?>

        <div class="rs__materials--item">
            <picture class="rs__materials--pic">
                <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"]; ?>" class="rs__materials--img">
            </picture>
            <div class="rs__materials--info">
                <div class="rs__materials--chapter"><?=FormatDate("j F Y", MakeTimeStamp($arItem["DISPLAY_PROPERTIES"]["PUBLIC_DATE"]["VALUE"]));?></div>
                <div class="rs__materials--title"><a target="_self" href="<?= $arItem["DETAIL_PAGE_URL"]; ?>"><?= $arItem["NAME"]; ?></a></div>
                <a target="_self" href="<?= $arItem["DETAIL_PAGE_URL"]; ?>" class="rs__link rs__materials--link"><?= $arItem["DISPLAY_PROPERTIES"]["PUBLICATION_TYPE"]["VALUE"]; ?></a>
            </div>
        </div>

    <? } ?>
    <? if ($show_type == 2) { ?>
        <div class="rs__materials--item no-pic" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
            <div class="rs__materials--info">
                <div class="rs__materials--chapter"><? echo FormatDate("j F Y", MakeTimeStamp($arItem["DISPLAY_PROPERTIES"]["PUBLIC_DATE"]["VALUE"])); ?></div>
                <div class="rs__materials--title"><a target="_self" href="<?= $arItem["DETAIL_PAGE_URL"]; ?>"><?= $arItem["NAME"]; ?></a>
                </div>
                <a class="rs__link rs__materials--link" href="<?= $arItem["DETAIL_PAGE_URL"]; ?>"><?= $arItem["DISPLAY_PROPERTIES"]["PUBLICATION_TYPE"]["VALUE"]; ?></a>
            </div>
            <div class="rs__materials--ico">
                                    <span class="ico-arrow-big">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </span>
            </div>
        </div>
    <? } ?>
    <? if ($show_type == 3) { ?>
        <div style="background-color: #fd5300;" class="rs__materials--item no-pic" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
            <div class="rs__materials--info">
                <div class="rs__materials--chapter"><? echo FormatDate("j F Y", MakeTimeStamp($arItem["DISPLAY_PROPERTIES"]["PUBLIC_DATE"]["VALUE"])); ?></div>
                <div class="rs__materials--title"><a target="_self" href="<?= $arItem["DETAIL_PAGE_URL"]; ?>"><?= $arItem["NAME"]; ?></a>
                </div>
                <a class="rs__link rs__materials--link" href="<?= $arItem["DETAIL_PAGE_URL"]; ?>"><?= $arItem["DISPLAY_PROPERTIES"]["PUBLICATION_TYPE"]["VALUE"]; ?></a>
            </div>
            <div class="rs__materials--ico">
                                    <span class="ico-arrow-big">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </span>
            </div>
        </div>
    <? } ?>
    <? if ($show_type == 4) { ?>
        <div class="rs__materials--item is-bg bg-orange">
            <picture class="rs__materials--pic">
                <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"]; ?>" class="rs__materials--img">
            </picture>
            <div class="rs__materials--info">
                <div class="rs__materials--label">
                    <div class="rs__materials--label-text"><a target="_self" href="<?= $arItem["DETAIL_PAGE_URL"]; ?>"><?= $arItem["NAME"]; ?></a></div>
                    <div class="ico-video rs__materials--label-ico"></div>
                </div>
                <div class="rs__materials--chapter"><? echo FormatDate("j F Y", MakeTimeStamp($arItem["DISPLAY_PROPERTIES"]["PUBLIC_DATE"]["VALUE"])); ?></div>
                <div class="rs__materials--title"><a target="_self" href="<?= $arItem["DETAIL_PAGE_URL"]; ?>"><?= $arItem["NAME"]; ?></a></div>
                <a target="_self" href="<?= $arItem["DETAIL_PAGE_URL"]; ?>"> class="rs__link rs__materials--link"><?= $arItem["DISPLAY_PROPERTIES"]["PUBLICATION_TYPE"]["VALUE"]; ?></a>
            </div>
        </div>
    <? } ?>
    <? if ($show_type == 5) { ?>
        <div class="rs__materials--item is-bg bg-blue">
            <picture class="rs__materials--pic">
                <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"]; ?>" class="rs__materials--img">
            </picture>
            <div class="rs__materials--info">
                <div class="rs__materials--label">
                    <div class="rs__materials--label-text"><a target="_self" href="<?= $arItem["DETAIL_PAGE_URL"]; ?>"><?= $arItem["NAME"]; ?></a></div>
                    <div class="ico-video rs__materials--label-ico"></div>
                </div>
                <div class="rs__materials--chapter"><? echo FormatDate("j F Y", MakeTimeStamp($arItem["DISPLAY_PROPERTIES"]["PUBLIC_DATE"]["VALUE"])); ?></div>
                <div class="rs__materials--title"><a target="_self" href="<?= $arItem["DETAIL_PAGE_URL"]; ?>"><?= $arItem["NAME"]; ?></a></div>
                <a target="_self" href="<?= $arItem["DETAIL_PAGE_URL"]; ?>"> class="rs__link rs__materials--link"><?= $arItem["DISPLAY_PROPERTIES"]["PUBLICATION_TYPE"]["VALUE"]; ?></a>
            </div>
        </div>
    <? } ?>
<? } ?>
<? if ($arParams["AJAX_LOAD"] != "Y" || TRUE) { ?>
    </div>
<? } ?>

<? if ($arParams["DISPLAY_BOTTOM_PAGER"] || TRUE) : ?>
    <div class="<?= "nav_string_" . $arResult['NAV_RESULT']->NavNum; ?>">
        <br/><?= $arResult["NAV_STRING"] ?>
    </div>
<? endif; ?>