<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Type\DateTime;

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
<div class="page__section page__section_style_secondary page__section_no_overflow">
    <div class="page__holder">
        <div class="section section_header_space-half section_space_bottom-close">
            <div class="section__header section__header_type_inline">
                <div class="section__title">
                    <!-- begin .title-->
                    <h2 class="title title_size_h2">Мероприятия
                    </h2>
                    <!-- end .title-->
                </div>
                <div class="section__extra">
                    <div class="section__link-item">
                        <!-- begin .link-item-->
                        <a
                                class="link-item link-item_text-size_l link-item_icon-size_l link-item_icon-offset_l link-item_style_primary"
                                href="/our_events/"
                        >
                            <span class="link-item__label">Ко всем мероприятиям</span>
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
                <div class="section__events-panel">
                    <!-- begin .events-panel-->
                    <div class="events-panel">
                        <div class="events-panel__container">
                            <div class="events-panel__wrapper">
                                <? foreach ($arResult["ITEMS"] as $arItem): ?>
                                <?
                                $obNewsDate = !empty($arItem["ACTIVE_FROM"]) ? (new DateTime($arItem["ACTIVE_FROM"], 'd.m.Y H:i:s')) : (new DateTime($arItem["DATE_CREATE"], 'd.m.Y H:i:s'));
                                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                                ?>
                                    <div class="events-panel__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                                        <!-- begin .event-item-->
                                        <div class="event-item">
                                            <div class="event-item__container">
                                                <div class="event-item__wrapper">
                                                  <div class="event-item__date">
                                                        <?if(!empty($arItem["PROPERTIES"]["PERFORMANCE_DATE"]["VALUE"])):?>
                                                          <!-- begin .date-->
                                                          <div class="date">
                                                              <?= $arItem["PROPERTIES"]["PERFORMANCE_DATE"]["VALUE"] ?>
                                                          </div>
                                                          <!-- end .date-->
                                                        <?endif;?>
                                                      </div>
                                                    <div class="event-item__content">
                                                        <div class="event-item__text">
                                                            <div class="event-item__title">
                                                                <?= $arItem["NAME"] ?>
                                                            </div>
                                                            <div class="event-item__text">
                                                                <?= htmlspecialchars_decode($arItem["PREVIEW_TEXT"]) ?>
                                                            </div>
                                                        </div>
                                                        <div class="event-item__controls">
                                                            <?
                                                                $moreButtonText = !empty($arItem["PROPERTIES"]["DETAIL_BUTTON_TEXT"]["VALUE"]) ? $arItem["PROPERTIES"]["DETAIL_BUTTON_TEXT"]["VALUE"] : "Подробнее";
                                                                $moreButtonLink = !empty($arItem["PROPERTIES"]["DETAIL_BUTTON_LINK"]["VALUE"]) ? $arItem["PROPERTIES"]["DETAIL_BUTTON_LINK"]["VALUE"] : "";
                                                            ?>
                                                            <?if(!empty($moreButtonText) && !empty($moreButtonLink)):?>
                                                                <div class="event-item__control">
                                                                    <!-- begin .button-->
                                                                    <a class="button button_size_m" href="<?= $moreButtonLink ?>" target="_blank">
                                                                        <span class="button__holder">
                                                                            <span class="button__text"><?=$moreButtonText?></span>
                                                                        </span>
                                                                    </a>
                                                                    <!-- end .button-->
                                                                </div>
                                                            <?endif;?>
                                                            <?/*
                                                                <!-- *Временно скрыли исходя из task/45781* -->
                                                                <div class="event-item__control">
                                                                    <!-- begin .button-->
                                                                    <a class="button button_size_m js-modal" href="#modalEvents" data-modal-callback="setEventName<?=$arItem["ID"]?>">
                                                                        <span class="button__holder">
                                                                            <span class="button__text">Записаться</span>
                                                                        </span>
                                                                    </a>
                                                                    <!-- end .button-->
                                                                </div>
                                                            */?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end .event-item-->
                                    </div>
                                        <script>
                                            window['setEventName<?=$arItem["ID"]?>'] = function(fancybox, modalEl, formEl) {
                                                const eventName = '<?=$arItem["NAME"]?>',
                                                eventNameInput = formEl.querySelector('.form_entity_name');
                                                if(eventNameInput) {
                                                    eventNameInput.value = eventName;
                                                }
                                            }
                                        </script>
                                <? endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <!-- end .events-panel-->
                </div>
            </div>
        </div>
    </div>
</div>
<? endif; ?>