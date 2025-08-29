<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
?>

<? if (!empty($arResult["ITEMS"])): ?>
    <? if (!empty($request->get("industry"))) { ?>
        <input type="hidden" value="<?=$request->get("industry")?>" id="js_cur_case" />
    <? } ?>
    <div class="section__tags">
        <!-- begin .tag-list-->
        <? if (!empty($arResult["INDUSTRY"])): ?>
            <div class="tag-list section__tags-list">
                <div class="tag-list__container">
                    <button class="tag-list__mobile-trigger js-toggle" type="button" data-toggle-scope=".tag-list" data-toggle-class="tag-list_state_open">
                        Открыть список
                    </button>
                    <div class="tag-list__tags">
                        <div
                            onclick="BX.ajax.insertToNode('?industry=&bxajaxid=<?= $arParams["AJAX_ID"] ?>', 'comp_<?= $arParams["AJAX_ID"] ?>');  updateParamUrl('industry', ''); return false;"
                            class="tag-list__tag <?= ((!$request->isAjaxRequest() || empty($request->get("industry"))) ? "tag-list__tag_state_active" : "") ?>">
                            Все индустрии
                        </div>
                        <? foreach ($arResult["INDUSTRY"] as $valueId => $valueName): ?>
                            <div
                                id="js_gazeta_cases_button_<?= $valueId ?>"
                                onclick="BX.ajax.insertToNode('?industry=<?= $valueId ?>&bxajaxid=<?= $arParams["AJAX_ID"] ?>', 'comp_<?= $arParams["AJAX_ID"] ?>'); updateParamUrl('industry', '<?= $valueId ?>'); return false;"
                                class="tag-list__tag <?= (($request->isAjaxRequest() && $request->get("industry") == $valueId) ? "tag-list__tag_state_active" : "") ?>">
                                <?= $valueName ?>
                            </div>
                        <? endforeach; ?>
                    </div>
                    <button class="tag-list__close js-toggle" type="button" data-toggle-scope=".tag-list" data-toggle-class="tag-list_state_open">
                        <div class="tag-list__icon">
                            Закрыть список
                        </div>
                    </button>
                </div>
            </div>
        <? endif; ?>
        <!-- end .tag-list-->
    </div>
    <div class="section__content">
        <div class="section__cards-panel">
            <div class="cards-panel cards-panel_layout_m cards-panel_role_articles cards-panel_panel-height_m">
                <div class="cards-panel__container">
                    <div class="cards-panel__wrapper">
                        <? foreach ($arResult["ITEMS"] as $arItem): ?>
                            <?
                            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                            
                            if (!empty($arItem["PROPERTIES"]["FAVORITE_IMAGE"]["VALUE"])) {
                                $backgroundImg = \CFile::GetPath($arItem["PROPERTIES"]["FAVORITE_IMAGE"]["VALUE"]);
                            }
                            if (!is_file($_SERVER["DOCUMENT_ROOT"] . $backgroundImg)) {
                                $backgroundImg = SITE_TEMPLATE_PATH . "/assets/blocks/service-item/images/16.png";
                            }
                            ?>
                            <a class="cards-panel__item cards-panel__item_type_service" href="<?= $arItem["DETAIL_PAGE_URL"] ?>" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                                <!-- begin .service-item-->
                                <span class="service-item service-item_style_primary service-item_role_articles cards-panel__panel">
                                    <span class="service-item__content">
                                        <? if (!empty($backgroundImg)): ?>
                                            <span class="service-item__background">
                                                <picture class="service-item__picture">
                                                    <img
                                                        src="<?= $backgroundImg ?>"
                                                        alt="<?= $arItem["NAME"] ?>"
                                                        class="service-item__image" title="" />
                                                </picture>
                                            </span>
                                        <? endif; ?>
                                        <span class="service-item__header">
                                            <span class="service-item__tags">
                                                <span class="service-item__tag">
                                                    <!-- begin .label-->
                                                    <? if (!empty($arItem["SECTION_NAME"])): ?>
                                                        <div class="label label_style_dashed">
                                                            <?= $arItem["SECTION_NAME"] ?>
                                                        </div>
                                                    <? endif; ?>
                                                    <!-- end .label-->
                                                </span>
                                            </span>
                                        </span>
                                        <span class="service-item__favorite">
                                            <!-- begin .button-->
                                            <? if (!empty($arItem["PROPERTIES"]["FAVORITE"]["VALUE"])): ?>
                                                <button class="button button_size_sm button_style_bright" type="button"
                                                    aria-label="В избранное">
                                                    <span class="button__holder">
                                                        <svg class="button__icon" x="0px"
                                                            y="0px" viewBox="-3 -3 30 30">
                                                            <path
                                                                class="button__icon-fill"
                                                                d="M10.2,1.6c0.7-1.5,2.9-1.5,3.6,0L15.9,6c0.3,0.6,0.9,1,1.5,1.1l4.8,0.7c1.6,0.2,2.3,2.3,1.1,3.4l-3.5,3.4c-0.5,0.5-0.7,1.1-0.6,1.8l0.8,4.8c0.3,1.6-1.4,2.9-2.9,2.1L12.9,21c-0.6-0.3-1.3-0.3-1.9,0l-4.3,2.3c-1.5,0.8-3.2-0.5-2.9-2.1l0.8-4.8c0.1-0.6-0.1-1.3-0.6-1.8l-3.5-3.4C-0.6,10,0.1,8,1.7,7.8l4.8-0.7C7.2,7,7.8,6.6,8.1,6L10.2,1.6z" />
                                                            <path
                                                                fill="transparent" stroke="currentColor" stroke-width="2"
                                                                d="M11.1,2.1c0.4-0.7,1.4-0.7,1.8,0L15,6.4c0.4,0.9,1.3,1.5,2.3,1.6l4.8,0.7c0.8,0.1,1.1,1.1,0.6,1.7l-3.5,3.4c-0.7,0.7-1,1.7-0.9,2.7l0.8,4.8c0.1,0.8-0.7,1.4-1.5,1.1l-4.3-2.3c-0.9-0.5-1.9-0.5-2.8,0l-4.3,2.3c-0.7,0.4-1.6-0.2-1.5-1.1l0.8-4.8c0.2-1-0.2-2-0.9-2.7l-3.5-3.4C0.7,9.9,1.1,8.9,1.9,8.8l4.8-0.7c1-0.1,1.8-0.8,2.3-1.6L11.1,2.1z" />
                                                        </svg>
                                                    </span>
                                                </button>
                                            <? endif ?>
                                            <!-- end .button-->
                                        </span>
                                        <span class="service-item__main">
                                            <span class="service-item__format"><?= $arItem["PROPERTIES"]["FORMAT"]["VALUE"] ?></span>
                                            <span class="service-item__title">
                                                <?= $arItem["NAME"] ?>
                                            </span>
                                            <span class="service-item__controls">
                                                <span class="service-item__control">
                                                    <!-- begin .button-->
                                                    <span class="button button_role_article">
                                                        <span class="button__holder">
                                                            <span class="button__text">Читать</span>
                                                        </span>
                                                    </span>
                                                    <!-- end .button-->
                                                </span>
                                            </span>
                                        </span>
                                    </span>
                                </span>
                                <!-- end .service-item-->
                            </a>
                        <? endforeach; ?>
                    </div>
                    <? if (!empty($arResult["NAV_RESULT"]->NavPageCount) && $arResult["NAV_RESULT"]->NavPageCount > 0): ?>
                        <?= $arResult["NAV_STRING"] ?>
                    <? endif; ?>
                </div>
            </div>
        </div>
    </div>
<? endif; ?>