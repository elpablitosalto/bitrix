<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
<? if (!empty($arResult['ITEMS'])) { ?>
    <?/*?>
    <input type="hidden" id="js_filter_form_data_serialize" />
    <?*/ ?>

    <div data-ajax-container>

        <ul class="entry-grid__list js_nav_result_<?= $arResult['NAV_RESULT']->NavNum ?>">
            <? foreach ($arResult["ITEMS"] as $arItem) { ?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <li class="entry-grid__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                    <!-- begin .entry-snippet-->
                    <div class="entry-snippet entry-grid__snippet">
                        <?/*?>
                    <div class="entry-snippet__background">
                        <picture class="entry-snippet__picture">
                            <img src="<?= $arItem['DETAIL_PICTURE_SLIDER']['SRC']; ?>" alt="<?= $arItem['DETAIL_PICTURE_SLIDER']["ALT"] ?>" title="<?= $arItem['DETAIL_PICTURE_SLIDER']["TITLE"] ?>" class="entry-snippet__image" />
                        </picture>
                    </div>
                    <?*/ ?>
                        <?/*?>
                    <div class="entry-snippet__label">
                        Excellence Acivators
                    </div>
                    <?*/ ?>
                        <div class="entry-snippet__title">
                            <a class="entry-snippet__link" href="<?= $arItem["DETAIL_PAGE_URL"] ?>">
                                <?= $arItem["NAME"] ?>
                            </a>
                        </div>
                        <a class="entry-snippet__illustration" href="<?= $arItem["DETAIL_PAGE_URL"] ?>">
                            <picture class="entry-snippet__picture">
                                <img src="<?= $arItem['PREVIEW_PICTURE_SLIDER']['SRC']; ?>" alt="<?= $arItem['PREVIEW_PICTURE_SLIDER']["ALT"] ?>" title="<?= $arItem['PREVIEW_PICTURE_SLIDER']["TITLE"] ?>" class="entry-snippet__image" />
                            </picture>
                        </a>
                        <? if (!empty($arItem["PRODUCT_VARIANTS"]) && !empty($arItem["PRODUCT_VARIANTS"]["PROPERTY_VALUES"])) { ?>
                            <div class="entry-snippet__choice-group">
                                <!-- begin .choice-group-->
                                <div class="choice-group">
                                    <ul class="choice-group__list">
                                        <? foreach ($arItem["PRODUCT_VARIANTS"]["PROPERTY_VALUES"] as $propValue) { ?>
                                            <?
                                            $checked = true;
                                            ?>
                                            <li class="choice-group__item">
                                                <label class="choice-group__label <?= ($checked ? "choice-group__label_state_active" : "") ?>">
                                                    <span class="choice-group__tooltip"><?= $arItem["PRODUCT_VARIANTS"]["PROPERTY_NAME"] ?></span>
                                                    <span class="choice-group__panel"><?= $propValue["UF_NAME"] ?></span>
                                                </label>
                                            </li>
                                            <?/*?>
                                        <li class="choice-group__item">
                                            <label class="choice-group__label">
                                                <span class="choice-group__tooltip"><?= $arItem["PRODUCT_VARIANTS"]["PROPERTY_NAME"] ?></span>
                                                <input <?= ($checked ? "checked" : "") ?> class="choice-group__input" type="radio" name="product-filter-<?= $arItem["ID"] ?>-<?= $arItem["PRODUCT_VARIANTS"]["PROPERTY_CODE"] ?>" />
                                                <span class="choice-group__panel"><?= $propValue["UF_NAME"] ?></span>
                                            </label>
                                        </li>
                                        <?*/ ?>
                                        <? } ?>
                                    </ul>
                                </div>
                                <!-- end .choice-group-->
                            </div>
                        <? } ?>
                    </div>
                    <!-- end .entry-snippet-->
                </li>
            <? } ?>
            <?
            //vardump($arResult['NAV_STRING']);
            ?>
        </ul>

        <?
        $navNum = $arResult['NAV_RESULT']->NavNum;
        ?>
        <div class="js_nav_string <?= "js_nav_string_" . $navNum; ?>">
            <?
            echo $arResult["NAV_STRING"];
            ?>
        </div>

    </div>
<? } ?>