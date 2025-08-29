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
    <div class="section">
        <div class="section__header section__header_type_inline">
            <div class="section__title">
                <!-- begin .title-->
                <h2 class="title title_size_sh2">
                    <div class="highlight">Получайте пользу</div>
                    уже сейчас
                </h2>
                <!-- end .title-->
            </div>
            <div class="section__extra">
                <div class="section__link-item">
                    <!-- begin .link-item-->
                    <a
                            class="link-item link-item_text-size_l link-item_icon-size_l link-item_icon-offset_l link-item_style_primary"
                            href="/services/?category=17">
                        <span class="link-item__label">Еще больше пользы</span>
                        <svg width="13" height="8" viewBox="0 0 13 8" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.3536 4.35355C12.5488 4.15829 12.5488 3.84171 12.3536 3.64645L9.17157 0.464465C8.97631 0.269203 8.65973 0.269203 8.46447 0.464465C8.2692 0.659728 8.2692 0.97631 8.46447 1.17157L11.2929 4L8.46447 6.82843C8.2692 7.02369 8.2692 7.34027 8.46447 7.53553C8.65973 7.7308 8.97631 7.7308 9.17157 7.53553L12.3536 4.35355ZM4.37114e-08 4.5L12 4.5L12 3.5L-4.37114e-08 3.5L4.37114e-08 4.5Z"
                                  fill="#E31513"/>
                        </svg>
                    </a>
                    <!-- end .link-item-->
                </div>
            </div>
        </div>
        <div class="section__content">
            <div class="section__cards-panel">
                <!-- no modifiers - panels take all available width, divinging equally up to three in one row-->
                <!-- cards-panel_layout_l - one panel per row-->
                <!-- cards-panel_layout_m - two panels per row-->
                <!-- cards-panel_layout_s - three panels per row-->
                <!-- cards-panel_layout_mixed - three panels every odd row, two panels every even row-->
                <!-- begin .cards-panel-->
                <div class="cards-panel cards-panel_layout_s cards-panel_style_indents">
                    <div class="cards-panel__container">
                        <div class="cards-panel__wrapper">
                            <? foreach ($arResult["ITEMS"] as $arItem): ?>
                                <?
                                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                                ?>
                                <div class="cards-panel__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                                    <!-- begin .service-item-->
                                    <div class="service-item">
                                        <div class="service-item__content">
                                            <div class="service-item__header">
                                                <?if(!empty($arItem['PROPERTIES']['IMAGE']['VALUE'])):?>
                                                    <div class="service-item__illustration">
                                                        <picture class="service-item__picture">
                                                            <?
                                                              $resizeImage = CFile::ResizeImageGet($arItem['PROPERTIES']['IMAGE']['VALUE'],
                                                              array('width'=>400, 'height'=>310),
                                                              BX_RESIZE_IMAGE_EXACT, true);
                                                            ?>
                                                            <img
                                                                src="<?= $resizeImage['src']?>"
                                                                alt="<?=$arItem['NAME']?>"
                                                                class="service-item__image"
                                                                title=""
                                                                loading="lazy"
                                                            />
                                                        </picture>
                                                    </div>
                                                <?endif;?>
                                                <div class="service-item__tag">
                                                    <!-- begin .label-->
                                                    <div class="label label_style_dashed">
                                                        бесплатно
                                                    </div>
                                                    <!-- end .label-->
                                                </div>
                                            </div>
                                            <div class="service-item__favorite">
                                              <!-- begin .button-->
                                              <button class="button button_type_favorite" type="button" aria-label="В избранное"><span class="button__holder"><svg width="20" height="18" viewBox="0 0 20 18" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M13.7 1C16.87 1 19 3.98 19 6.76C19 12.39 10.16 17 10 17C9.84 17 1 12.39 1 6.76C1 3.98 3.13 1 6.3 1C8.12 1 9.31 1.91 10 2.71C10.69 1.91 11.88 1 13.7 1Z" stroke="#E31513" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" /></svg></span>
                                              </button>
                                              <!-- end .button-->
                                            </div>
                                            <div class="service-item__main">
                                                <div class="service-item__title">
                                                    <?=$arItem['NAME']?>
                                                </div>
                                                <div class="service-item__description">
                                                    <?=htmlspecialchars_decode($arItem['PREVIEW_TEXT'])?>
                                                </div>
                                                <div class="service-item__controls">
                                                    <div class="service-item__controls">
                                                        <!-- begin .button-->
                                                        <a
                                                            href="<?=(!empty($arItem["PROPERTIES"]["LINK"]["VALUE"]) ? $arItem["PROPERTIES"]["LINK"]["VALUE"] : $arItem['DETAIL_PAGE_URL'])?>"
                                                            class="button button_style_borderless button_width_fit"
                                                        >
                                                            <span class="button__holder">
                                                                <span class="button__text">Подробнее</span>
                                                                <span class="button__icon">
                                                                    <svg width="13"
                                                                        height="8"
                                                                        viewBox="0 0 13 8"
                                                                        fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg"><path
                                                                        d="M12.3536 4.35355C12.5488 4.15829 12.5488 3.84171 12.3536 3.64645L9.17157 0.464465C8.97631 0.269203 8.65973 0.269203 8.46447 0.464465C8.2692 0.659728 8.2692 0.97631 8.46447 1.17157L11.2929 4L8.46447 6.82843C8.2692 7.02369 8.2692 7.34027 8.46447 7.53553C8.65973 7.7308 8.97631 7.7308 9.17157 7.53553L12.3536 4.35355ZM4.37114e-08 4.5L12 4.5L12 3.5L-4.37114e-08 3.5L4.37114e-08 4.5Z"
                                                                        fill="#E31513"/></svg>
                                                                </span>
                                                            </span>
                                                        </a>
                                                        <!-- end .button-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end .service-item-->
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