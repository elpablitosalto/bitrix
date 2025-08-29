<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Hair\General;
?>
<? if (!empty($arResult['ITEMS'])) { ?>
    <div class="page__section">
        <!-- begin .section-->
        <div class="section section_role_products">
            <div class="section__main">
                <div class="section__header">
                    <div class="section__header-container page__container">
                        <div class="section__title">
                            <!-- begin .title-->
                            <h2 class="title title_size_h3-s title_case_upper title_style_primary">
                                <?= GetMessage('RELATED_PRODUCT_SEE_ALSO'); ?>
                            </h2>
                            <!-- end .title-->
                        </div>
                    </div>
                </div>
                <div class="section__content">
                    <div class="page__container">
                        <div class="section__entry-grid">
                            <!-- begin .entry-grid-->
                            <div class="entry-grid js-entry-grid">
                                <ul class="entry-grid__list js_nav_result_<?= $arResult['NAV_RESULT']->NavNum ?>">
                                    <? foreach ($arResult['ITEMS'] as $k => $arItem) { ?>
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
                                                    <a class="entry-snippet__link js-modal" href="<?= $arItem['DETAIL_PICTURE']['SRC']; ?>">
                                                        <?= $arItem['NAME']; ?>
                                                    </a>
                                                </div>
                                                <a class="entry-snippet__illustration js-modal" href="<?= $arItem['DETAIL_PICTURE']['SRC']; ?>">
                                                    <picture class="entry-snippet__picture">
                                                        <img src="<?= $arItem['PREVIEW_PICTURE_SLIDER']['SRC']; ?>" alt="<?= $arItem['PREVIEW_PICTURE_SLIDER']["ALT"] ?>" title="<?= $arItem['PREVIEW_PICTURE_SLIDER']["TITLE"] ?>" class="entry-snippet__image" />
                                                    </picture>
                                                </a>
                                            </div>
                                            <!-- end .entry-snippet-->
                                        </li>
                                    <? } ?>
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
                            <!-- end .entry-grid-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end .section-->
    </div>
<? } ?>