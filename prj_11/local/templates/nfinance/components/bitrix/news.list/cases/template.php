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
<? if (!empty($arResult["ITEMS"])): ?>
    <div class="section section_space_bottom-close">
        <div class="section__header section__header_type_inline">
            <div class="section__title">
                <!-- begin .title-->
                <h2 class="title title_size_h2">
                    Кейсы
                </h2>
                <!-- end .title-->
            </div>
            <div class="section__extra">
                <div class="section__link-item">
                    <!-- begin .link-item-->
                    <a
                        class="link-item link-item_text-size_l link-item_icon-size_l link-item_icon-offset_l link-item_style_primary"
                        href="/gazeta/cases">
                            <span class="link-item__label">Все кейсы</span>
                            <svg width="13" height="8" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.3536 4.35355C12.5488 4.15829 12.5488 3.84171 12.3536 3.64645L9.17157 0.464465C8.97631 0.269203 8.65973 0.269203 8.46447 0.464465C8.2692 0.659728 8.2692 0.97631 8.46447 1.17157L11.2929 4L8.46447 6.82843C8.2692 7.02369 8.2692 7.34027 8.46447 7.53553C8.65973 7.7308 8.97631 7.7308 9.17157 7.53553L12.3536 4.35355ZM4.37114e-08 4.5L12 4.5L12 3.5L-4.37114e-08 3.5L4.37114e-08 4.5Z" fill="#E31513"/>
                            </svg>
                    </a>
                    <!-- end .link-item-->
                </div>
            </div>
        </div>
        <div class="section__content">
            <div class="section__cards-panel">
                <!-- no modifiers - panels take all available width, divinging equally up to three in one row-->
                <!-- promo-group_layout_l - one panel per row-->
                <!-- promo-group_layout_m - two panels per row-->
                <!-- promo-group_layout_s - three panels per row-->
                <!-- promo-group_layout_mixed - three panels every odd row, two panels every even row-->
                <!-- begin .cards-panel-->
                <div class="cards-panel cards-panel_layout_s">
                    <div class="cards-panel__container">
                        <div class="cards-panel__wrapper">
                            <? foreach ($arResult["ITEMS"] as $arItem): ?>
                                <?
                                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                                ?>
                                <div class="cards-panel__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                                    <!-- begin .case-item-->
                                    <div class="case-item">
                                        <div class="case-item__content">
                                            <? if (!empty($arItem["AUTHOR_DATA"])): ?>
                                                <?$arAuthor = $arItem["AUTHOR_DATA"]?>
                                                    <div class="case-item__header">
                                                        <div class="case-item__illustration">
                                                            <?if(!empty($arAuthor["DETAIL_PICTURE"])):?>
                                                                <picture class="case-item__picture">
                                                                    <?$renderImage = CFile::ResizeImageGet(
                                                                        $arAuthor["DETAIL_PICTURE"],
                                                                        Array("width" => 158, "height" => 158),
                                                                        BX_RESIZE_IMAGE_PROPORTIONAL_ALT , true
                                                                    );?>
                                                                    <img
                                                                        src="<?=$renderImage["src"] ?>"
                                                                        alt="<?= $arAuthor["NAME"] ?>" class="case-item__image"
                                                                        title=""
                                                                        loading="lazy"
                                                                    />
                                                                </picture>
                                                            <?endif;?>
                                                        </div>
                                                        <div class="case-item__text">
                                                            <div class="case-item__name">
                                                                <?=$arAuthor["NAME"]?>
                                                            </div>
                                                            <div class="case-item__role">
                                                                <?=$arAuthor["PREVIEW_TEXT"]?>
                                                            </div>
                                                        </div>
                                                    </div>
                                            <? endif; ?>
                                            <div class="case-item__main">
                                                <? if (!empty($arItem["PROPERTIES"]["INDUSTRY"]["VALUE"])): ?>
                                                    <div class="case-item__type">
                                                        <?= $arItem["PROPERTIES"]["INDUSTRY"]["VALUE"] ?>
                                                    </div>
                                                <? endif; ?>
                                                <div class="case-item__title">
                                                    <?= $arItem["NAME"] ?>
                                                </div>
                                                <div class="case-item__description">
                                                    <?= htmlspecialchars_decode($arItem["PREVIEW_TEXT"]) ?>
                                                </div>
                                            </div>
                                            <div class="case-item__footer">
                                                <div class="case-item__controls">
                                                    <div class="case-item__control">
                                                        <!-- begin .button-->
                                                        <a
                                                                class="button button_style_borderless button_width_fit"
                                                                href="<?= $arItem["DETAIL_PAGE_URL"] ?>"
                                                        >
                                                            <span class="button__holder"><span class="button__text">Читать дальше</span>
                                                              <svg class="button__icon" width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                                  xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M14.3536 8.35355C14.5488 8.15829 14.5488 7.84171 14.3536 7.64645L11.1716 4.46447C10.9763 4.2692 10.6597 4.2692 10.4645 4.46447C10.2692 4.65973 10.2692 4.97631 10.4645 5.17157L13.2929 8L10.4645 10.8284C10.2692 11.0237 10.2692 11.3403 10.4645 11.5355C10.6597 11.7308 10.9763 11.7308 11.1716 11.5355L14.3536 8.35355ZM2 8.5L14 8.5L14 7.5L2 7.5L2 8.5Z"
                                                                      fill="currentColor"></path>
                                                              </svg>
                                                            </span>
                                                        </a>
                                                        <!-- end .button-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end .case-item-->
                                </div>
                            <? endforeach; ?>
                        </div>
                    </div>
                </div>
                <!-- end .cards-panel-->
            </div>
        </div>
    </div>
<? endif; ?>