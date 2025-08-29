<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Grid\Declension;

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
<? if (!empty($arResult["ITEMS"])) {
?>


    <? if ($arParams["AJAX_LOAD"] != "Y") { ?>

        <section class="awards-main">
            <div class="container nav_result_<?= $arResult['NAV_RESULT']->NavNum ?>">
            <? } ?>

            <?
            foreach ($arResult["ITEMS"] as $key => $item) {
                $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>

                <div class="section__content" id="<?= $this->GetEditAreaId($item['ID']); ?>">
                    <h3 class="section__title"><?= $item["NAME"] ?></h3>
                    <div class="items-list awards-list">
                        <div class="row align-items-height">
                            <? foreach ($item["DISPLAY_PROPERTIES"]["AWARD"]["VALUE"] as $arVal) { ?>
                                <div class="col-sm-6 col-lg-4">
                                    <?
                                    if (mb_strlen($arVal["SUB_VALUES"]["LINK"]["VALUE"]) > 0) {
                                    ?>
                                        <a target="_blank" href="<?= $arVal["SUB_VALUES"]["LINK"]["VALUE"]; ?>" class="list-item awards-item">
                                        <?
                                    } else {
                                        ?>
                                            <a data-fancybox href="<?= CFile::GetPath($arVal["SUB_VALUES"]["PICTURE"]["VALUE"]) ?>" class="list-item awards-item">
                                            <?
                                        }
                                            ?>
                                            <?/*?>
                                    <a data-fancybox href="<?= (mb_strlen($arVal["SUB_VALUES"]["LINK"]["VALUE"]) > 0) ? $arVal["SUB_VALUES"]["LINK"]["VALUE"] : "#"; ?>" class="list-item awards-item">
                                    <?*/ ?>
                                            <div class="h5 awards-item__title"><?= $arVal["SUB_VALUES"]["NAME"]["VALUE"] ?></div>
                                            <div class="awards-item__text"><?= $arVal["SUB_VALUES"]["DESCRIPTION"]["~VALUE"]["TEXT"] ?></div>
                                            <picture class="awards-item__icon">
                                                <img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= ($arVal["SUB_VALUES"]["TYPE"]["VALUE_XML_ID"] == "TYPE1") ? SITE_TEMPLATE_PATH . "/images/certificate.svg" : SITE_TEMPLATE_PATH . "/images/cup.svg"; ?>" loading="lazy" alt="<?= $arVal["SUB_VALUES"]["NAME"]["VALUE"] ?>" title="<?= $arVal["SUB_VALUES"]["NAME"]["VALUE"] ?>" />
                                            </picture>
                                            <div class="awards-item__cover">
                                                <? if ($arVal["SUB_VALUES"]["PICTURE"]["VALUE"] > 0) { ?>
                                                    <picture class="awards-item__image">
                                                        <img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= CFile::GetPath($arVal["SUB_VALUES"]["PICTURE"]["VALUE"]) ?>" loading="lazy" alt="<?= $arVal["SUB_VALUES"]["NAME"]["VALUE"] ?>" title="<?= $arVal["SUB_VALUES"]["NAME"]["VALUE"] ?>" />
                                                    </picture>
                                                <? } ?>
                                                <? if (mb_strlen($arVal["SUB_VALUES"]["LINK"]["VALUE"]) > 0) { ?>
                                                    <div class="awards-item__block-more">
                                                        Подробнее
                                                    </div>
                                                <? } ?>
                                            </div>
                                            </a>
                                </div>
                            <? } ?>
                        </div>
                    </div>
                </div>

            <? } ?>

            <?= $arResult['NAV_STRING'] ?>

            <? if ($arParams["AJAX_LOAD"] != "Y") { ?>
            </div>
        </section>
    <? } ?>



<? } ?>