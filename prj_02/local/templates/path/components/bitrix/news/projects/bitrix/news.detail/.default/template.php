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
?>
<?
$this->AddEditAction($arResult['ID'], $arResult['EDIT_LINK'], CIBlock::GetArrayByID($arResult["IBLOCK_ID"], "ELEMENT_EDIT"));
$this->AddDeleteAction($arResult['ID'], $arResult['DELETE_LINK'], CIBlock::GetArrayByID($arResult["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
?>

            <div class="rs__content--top">
                <h1 class="rs__title"><?= $arResult["NAME"] ?></h1>
            </div>
            <div class="rs__content--top-box">
                <? if ($arResult["DETAIL_TEXT"] <> '') { ?>
                    <div class="rs__title--info">
                        <? echo $arResult["DETAIL_TEXT"]; ?>
                    </div>
                <? } else { ?>
                    <div class="rs__title--info">
                        <? echo $arResult["PREVIEW_TEXT"]; ?>
                    </div>
                <? } ?>
                <? if ($arResult["DETAIL_PICTURE"]["DETAIL_PICTURE_RESIZED"]) { ?>
                    <div class="rs__title--pic">
                        <picture>
                            <img src="<?= $arResult["DETAIL_PICTURE"]["DETAIL_PICTURE_RESIZED"] ?>"
                                 class="rs__title--img" alt="<?= $arResult["DETAIL_PICTURE"]["ALT"] ?>"
                                 title="<?= $arResult["DETAIL_PICTURE"]["TITLE"] ?>">
                        </picture>
                    </div>
                <? } ?>
            </div>
        </div>
    </div>
</section>
<section class="wrapper rs__project--detail" id="<?= $this->GetEditAreaId($arResult['ID']); ?>">
    <div class="container">
        <div class="rs__content">
            <div class="rs__content--top">
                <div class="rs__section--title">О проекте</div>
            </div>
            <? if (mb_strlen($arResult["DISPLAY_PROPERTIES"]["ABOUT"]["DISPLAY_VALUE"]) > 0) { ?>
                <div class="rs__project--block">
                    <div class="rs__project--item rs__project--item--full">
                        <div class="rs__project--text"><?= $arResult["DISPLAY_PROPERTIES"]["ABOUT"]["DISPLAY_VALUE"] ?>
                        </div>
                    </div>
                </div>
                <!--<div class="rs__button__group">
                    <div class="rs__link rs__project--link">Читать описание полностью</div>
                </div>-->
            <? } ?>

            <? if (!empty($arResult["DISPLAY_PROPERTIES"]["FOR_WHOM"]["DISPLAY_VALUE"]) || !empty($arResult["DISPLAY_PROPERTIES"]["DOCS"]["VALUE"])) { ?>
                <div class="rs__project--block">
                    <? if (!empty($arResult["DISPLAY_PROPERTIES"]["FOR_WHOM"]["DISPLAY_VALUE"])) { ?>
                        <div class="rs__project--item">
                            <div class="rs__project--title">Для кого предназначен:</div>
                            <ul class="rs__project--list is-count">
                                <? foreach ($arResult["DISPLAY_PROPERTIES"]["FOR_WHOM"]["DISPLAY_VALUE"] as $val) { ?>
                                    <li><?= $val ?></li>
                                <? } ?>
                            </ul>
                        </div>
                    <? } ?>
                    <? if (!empty($arResult["DISPLAY_PROPERTIES"]["DOCS"]["VALUE"])) { ?>
                        <div class="rs__project--item">
                            <div class="rs__project--title">Документы проекта:</div>
                            <ul class="rs__project--list is-pdf">
                                <? foreach ($arResult["DISPLAY_PROPERTIES"]["DOCS"]["FULL_FILES"] as $arFile) {
                                    $sizeKb = $arFile["FILE_SIZE"] / 1024;
                                    if ($sizeKb > 1024) {
                                        $showSize = number_format($sizeKb / 1024, 2, '.', '') . " mB";
                                    } else {
                                        $showSize = number_format($sizeKb, 0, '.', '') . " kB";
                                    }
                                    ?>
                                    <li>
                                        <a class="ico-download rs__pdf-link" href="<?= $arFile["SRC"] ?>"
                                           data-size="<?= $showSize ?>" download>
                                            <span><?= ($arFile["DESCRIPTION"]) ? htmlspecialcharsbx($arFile["DESCRIPTION"]) : htmlspecialcharsbx($arFile["FILE_NAME"]); ?></span>
                                        </a>
                                    </li>
                                <? } ?>
                            </ul>
                        </div>
                    <? } ?>
                </div>
            <? } ?>
        </div>
    </div>
</section>

<? if (!empty($arResult["DISPLAY_PROPERTIES"]["PROJECT_NUMBERS"]["DISPLAY_VALUE"])) { ?>
    <section class="wrapper wrapper--bg rs__nor">
        <div class="container">
            <div class="rs__content">
                <div class="rs__nor--box">
                    <div class="rs__nor--slider">
                        <div class="js--nor-slider rs__nor--info">
                            <div class="rs__nor--block">
                                <? foreach ($arResult["DISPLAY_PROPERTIES"]["PROJECT_NUMBERS"]["DISPLAY_VALUE"] as $num => $val) { ?>
                                    <div class="rs__nor--info-item">
                                        <div class="rs__nor--info-qut"><?= $val ?></div>
                                        <div class="rs__nor--info-text"><?= $arResult["DISPLAY_PROPERTIES"]["PROJECT_NUMBERS"]["DESCRIPTION"][$num] ?></div>
                                    </div>
                                <? } ?>
                            </div>
                        </div>
                        <div class="is-hidden-tablet swiper-pagination"></div>
                    </div>
                    <picture class="rs__nor--pic">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/icon/ico-arrow-big.svg" class="rs__nor--img">
                    </picture>
                </div>
            </div>
        </div>
    </section>
<? } elseif (!empty($arResult["DISPLAY_PROPERTIES"]["PROJECT_BUDGET"]["DISPLAY_VALUE"])) { ?>
    <section class="wrapper wrapper--bg rs__nor">
        <div class="container">
            <div class="rs__content">
                <div class="rs__nor--box">
                    <div class="rs__nor--slider">
                        <div class="js--nor-slider rs__nor--info">
                            <div class="rs__nor--block">
                                <? foreach ($arResult["DISPLAY_PROPERTIES"]["PROJECT_BUDGET"]["DISPLAY_VALUE"] as $arVal) { ?>
                                    <div class="rs__nor--info-item">
                                        <div class="rs__nor--info-qut"><?= $arVal["SUB_VALUES"]["PROJECT_BUDGET_NUM"]["DISPLAY_VALUE"] ?></div>
                                        <div class="rs__nor--info-text"><?= $arVal["SUB_VALUES"]["PROJECT_BUDGET_TEXT"]["DISPLAY_VALUE"] ?></div>
                                    </div>
                                <? } ?>
                            </div>
                        </div>
                        <div class="is-hidden-tablet swiper-pagination"></div>
                    </div>
                    <picture class="rs__nor--pic">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/icon/ico-arrow-big.svg" class="rs__nor--img">
                    </picture>
                </div>
            </div>
        </div>
    </section>
<? } ?>


<? if (!empty($arResult["DISPLAY_PROPERTIES"]["HOW_WE_HELP"]["DISPLAY_VALUE"])) {
    ?>
    <section class="wrapper rs__project--detail">
        <div class="container">
            <div class="rs__content">
                <div class="rs__content--top">
                    <div class="rs__section--title">Как мы работаем</div>
                </div>
                <div class="rs__project--block">
                    <div class="rs__project--item rs__project--item--full">
                        <ul class="rs__project--list">
                            <? foreach ($arResult["DISPLAY_PROPERTIES"]["HOW_WE_HELP"]["DISPLAY_VALUE"] as $val) { ?>
                                <li><?= $val ?>
                                </li>
                            <? } ?>
                        </ul>
                    </div>
                </div>
                <div class="rs__button__group rs__section--nav">
                    <a class="rs__button__default rs__button--icon ico-arrow-main rs__button--icon-right"
                       href="program-projects.html">Присоединиться к проекту</a>
                </div>
            </div>
        </div>
    </section>
<? } ?>
<? if (!empty($arResult["DISPLAY_PROPERTIES"]["GALERY"]["DISPLAY_VALUE"])) { ?>
    <section class="wrapper rs__gallery rs__gallery--big">
        <div class="container">
            <div class="rs__content">
                <div class="rs__content--top">
                    <h3 class="rs__section--title">Галерея</h3>
                    <div class="rs__slider--control">
                        <div class="rs__slider--control-prev"></div>
                        <div class="rs__slider--control-next"></div>
                    </div>
                </div>
                <div class="swiper js--gallery-big-slider">
                    <div class="swiper-wrapper rs__gallery--block">
                        <? foreach ($arResult["DISPLAY_PROPERTIES"]["GALERY"]["VALUE"] as $fileID) {
                            $arFile = CFile::GetFileArray($fileID);
                            ?>
                            <div class="swiper-slide">
                                <div class="js--gallery-it rs__gallery--item is-img" data-img="<?= $arFile["SRC"] ?>">
                                    <div class="rs__gallery--pic">
                                        <picture>
                                            <img src="<?= $arFile["SRC"] ?>" class="rs__gallery--img">
                                        </picture>
                                    </div>
                                </div>
                            </div>
                        <? } ?>
                    </div>
                    <div class="is-hidden-tablet swiper-pagination"></div>
                </div>
            </div>
        </div>
    </section>
<? } ?>
