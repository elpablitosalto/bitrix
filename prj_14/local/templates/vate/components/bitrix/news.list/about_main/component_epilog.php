<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
<? if (!empty($arResult["ITEMS"])) { ?>
    <div class="page__section">
        <div class="page__container">
            <? foreach ($arResult["ITEMS"] as $arItem) { ?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <!-- begin .section-->
                <div class="section" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                    <div class="section__main">
                        <div class="section__content">
                            <div class="section__info-panel">
                                <!-- begin .info-block-->
                                <div class="info-panel">
                                    <div class="info-panel__content">
                                        <div class="info-panel__title">
                                            <!-- begin .title-->
                                            <h2 class="title title_style_gradient title_size_h1 title_case_upper">
                                                <?= $arItem['DISPLAY_PROPERTIES']['HEADER_MAIN']['VALUE'] ?>
                                            </h2>
                                            <!-- end .title-->
                                        </div>
                                        <div class="info-panel__main">
                                            <div class="info-panel__text">
                                                <?= $arItem['DISPLAY_PROPERTIES']['TEXT_MAIN']['~VALUE']['TEXT'] ?>
                                            </div>
                                            <div class="info-panel__illustration">
                                                <picture class="info-panel__picture">
                                                    <img src="<?= $arItem['IMG_MAIN']['SRC']; ?>" alt="<?= $arItem['IMG_MAIN']["ALT"] ?>" title="<?= $arItem['IMG_MAIN']["TITLE"] ?>" class="info-panel__image" />
                                                </picture>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end .info-block-->
                            </div>

                            <div class="section__info-grid">
                                <!-- begin .info-grid-->
                                <div class="info-grid">
                                    <div class="info-grid__container">
                                        <? if (!empty($arItem['DISPLAY_PROPERTIES']['FEATURES_MAIN']['VALUE'])) { ?>
                                            <?
                                            $i = 0;
                                            foreach ($arItem['DISPLAY_PROPERTIES']['FEATURES_MAIN']['VALUE'] as $key => $arFeature) { ?>
                                                <?
                                                $addClass = '';
                                                if ($i == 0) {
                                                    $addClass = 'info-grid__item_style_filled';
                                                }
                                                ?>
                                                <div class="info-grid__item <?= $addClass; ?>">
                                                    <picture class="info-grid__picture">
                                                        <source srcset="<?= $arFeature['SUB_VALUES']['FEATURES_MAIN_IMG']['PICTURE']['SRC'] ?>" type="image/svg+xml" media="(max-width: 1439px)" class="info-grid__source" />
                                                        <img src="<?= $arFeature['SUB_VALUES']['FEATURES_MAIN_IMG']['PICTURE']['SRC']; ?>" alt="<?= $arFeature['SUB_VALUES']['FEATURES_MAIN_IMG']['PICTURE']["ALT"] ?>" title="<?= $arFeature['SUB_VALUES']['FEATURES_MAIN_IMG']['PICTURE']["TITLE"] ?>" class="info-grid__image" />
                                                    </picture>
                                                    <div class="info-grid__text"><?= $arFeature['SUB_VALUES']['FEATURES_MAIN_TEXT']['VALUE']['TEXT']; ?>
                                                    </div>
                                                </div>
                                            <?
                                                $i++;
                                            } ?>
                                        <? } ?>
                                        <div class="info-grid__item info-grid__item_size_l">
                                          <? $APPLICATION->IncludeComponent(
                                            "bitrix:news.list",
                                            "partners_slider_main",
                                            array(
                                                "IBLOCK_ID" => PARTNERS_IB_ID,
                                                "IBLOCK_TYPE" => "content",
                                                "DISPLAY_DATE" => "Y",
                                                "DISPLAY_NAME" => "Y",
                                                "DISPLAY_PICTURE" => "Y",
                                                "DISPLAY_PREVIEW_TEXT" => "Y",
                                                "AJAX_MODE" => "N",
                                                "NEWS_COUNT" => "20",
                                                "SORT_BY2" => "ACTIVE_FROM",
                                                "SORT_ORDER2" => "DESC",
                                                "SORT_BY1" => "SORT",
                                                "SORT_ORDER1" => "ASC",
                                                "FILTER_NAME" => "",
                                                "FIELD_CODE" => array("ID", "NAME", "DETAIL_PAGE_URL", "PREVIEW_PICTURE"),
                                                "PROPERTY_CODE" => array(""),
                                                "CHECK_DATES" => "Y",
                                                "DETAIL_URL" => "",
                                                "PREVIEW_TRUNCATE_LEN" => "",
                                                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                                                "SET_TITLE" => "Y",
                                                "SET_BROWSER_TITLE" => "Y",
                                                "SET_META_KEYWORDS" => "Y",
                                                "SET_META_DESCRIPTION" => "Y",
                                                "SET_LAST_MODIFIED" => "Y",
                                                "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                                                "ADD_SECTIONS_CHAIN" => "Y",
                                                "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
                                                "PARENT_SECTION" => "",
                                                "PARENT_SECTION_CODE" => "",
                                                "INCLUDE_SUBSECTIONS" => "Y",
                                                "CACHE_TYPE" => "A",
                                                "CACHE_TIME" => "3600",
                                                "CACHE_FILTER" => "Y",
                                                "CACHE_GROUPS" => "Y",
                                                "DISPLAY_TOP_PAGER" => "Y",
                                                "DISPLAY_BOTTOM_PAGER" => "Y",
                                                "PAGER_TITLE" => "Новости",
                                                "PAGER_SHOW_ALWAYS" => "Y",
                                                "PAGER_TEMPLATE" => "",
                                                "PAGER_DESC_NUMBERING" => "Y",
                                                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                                "PAGER_SHOW_ALL" => "Y",
                                                "PAGER_BASE_LINK_ENABLE" => "Y",
                                                "SET_STATUS_404" => "Y",
                                                "SHOW_404" => "Y",
                                                "MESSAGE_404" => "",
                                                "PAGER_BASE_LINK" => "",
                                                "PAGER_PARAMS_NAME" => "arrPager",
                                                "AJAX_OPTION_JUMP" => "N",
                                                "AJAX_OPTION_STYLE" => "Y",
                                                "AJAX_OPTION_HISTORY" => "N",
                                                "AJAX_OPTION_ADDITIONAL" => ""
                                            )
                                          ); ?>
                                        </div>

                                    </div>
                                </div>
                                <!-- end .info-grid-->
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end .section-->
            <? } ?>
        </div>
    </div>
<? } ?>