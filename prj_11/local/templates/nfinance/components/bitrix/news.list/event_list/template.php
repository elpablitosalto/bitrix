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
$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
?>
<? if (!empty($arResult["ITEMS"])): ?>
  <? if (!empty($arResult["TYPES"])): ?>
    <div class="section__tags section__tags_spacing_top-m">
      <!-- begin .tag-list-->
      <div class="tag-list section__tag-list">
        <div class="tag-list__container">
          <button class="tag-list__mobile-trigger js-toggle" type="button" data-toggle-scope=".tag-list" data-toggle-class="tag-list_state_open">
            Открыть список
          </button>
          <div class="tag-list__tags" id="events_tags">
            <?
            $countTypes = 0;
            if (!empty($arResult["TYPES"])) {
              $countTypes = count($arResult["TYPES"]);
            }
            ?>
            <? if ($countTypes  > 1) { ?>
              <button
                type="button"
                onclick="BX.ajax.insertToNode('?event_type=&bxajaxid=<?= $arParams["AJAX_ID"] ?>', 'comp_<?= $arParams["AJAX_ID"] ?>'); return false;"
                class="tag-list__tag <?= ((!$request->isAjaxRequest() || empty($request->get("event_type"))) ? "tag-list__tag_state_active" : "") ?>">Все мероприятия</button>
            <? } ?>
            <? foreach ($arResult["TYPES"] as $valueId => $valueName): ?>
              <?
              $addClass = '';
              if ($valueName == 'Организатор НФ') {
                $addClass = 'js_our_events_button';
              }
              ?>
              <button
                type="button"
                onclick="BX.ajax.insertToNode('?event_type=<?= $valueId ?>&bxajaxid=<?= $arParams["AJAX_ID"] ?>', 'comp_<?= $arParams["AJAX_ID"] ?>'); return false;"
                class="<?= $addClass; ?> tag-list__tag <?= ((($request->isAjaxRequest() && $request->get("event_type") == $valueId) || $countTypes == 1) ? "tag-list__tag_state_active" : "") ?>" <?= ($countTypes == 1 ? 'disabled' : '') ?>><?= $valueName ?></button>
            <? endforeach; ?>
          </div>
          <button class="tag-list__close js-toggle" type="button" data-toggle-scope=".tag-list" data-toggle-class="tag-list_state_open">
            <div class="tag-list__icon">
              Закыть список
            </div>
          </button>
        </div>
      </div>
      <!-- end .tag-list-->

    </div>
  <? endif; ?>
  <div class="section__content">
    <div class="section__event-list">
      <div class="event-list">
        <div class="event-list__list">
          <? foreach ($arResult["ITEMS"] as $arItem): ?>
            <?
            $moreButtonText = !empty($arItem["PROPERTIES"]["DETAIL_BUTTON_TEXT"]["VALUE"]) ? $arItem["PROPERTIES"]["DETAIL_BUTTON_TEXT"]["VALUE"] : "Подробнее";
            $moreButtonLink = !empty($arItem["PROPERTIES"]["DETAIL_BUTTON_LINK"]["VALUE"]) ? $arItem["PROPERTIES"]["DETAIL_BUTTON_LINK"]["VALUE"] : "";
            ?>
            <?
            $obNewsDate = !empty($arItem["ACTIVE_FROM"]) ? (new DateTime($arItem["ACTIVE_FROM"], 'd.m.Y H:i:s')) : (new DateTime($arItem["DATE_CREATE"], 'd.m.Y H:i:s'));
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="event-list__item">
              <!-- begin .event-card-->
              <div class="event-card">
                <div class="event-card__content">
                  <?
                  $image = !empty($arItem["PREVIEW_PICTURE"]["SRC"]) ? $arItem["PREVIEW_PICTURE"]["SRC"] : $arItem["DETAIL_PICTURE"]["SRC"];
                  ?>
                  <div class="event-card__illustration <? if (empty($image)): ?>event-card__illustration_state_placeholder<? endif; ?>">
                    <? if (!empty($image)): ?>
                      <picture class="event-card__picture">
                        <img src="<?= $image ?>" alt="<?= $arItem["NAME"] ?>" class="event-card__image" />
                      </picture>
                    <? endif; ?>
                  </div>
                  <div class="event-card__main">
                    <div class="event-card__meta">
                      <? if (!empty($arItem["PROPERTIES"]["PERFORMANCE_DATE"]["VALUE"])): ?>
                        <div class="event-card__date">
                          <!-- begin .date-->
                          <div class="date date_size_xs date_style_grey"><?= $arItem["PROPERTIES"]["PERFORMANCE_DATE"]["VALUE"] ?></div>
                          <!-- end .date-->
                        </div>
                      <? endif; ?>
                      <div class="event-card__tags">
                        <? if (!empty($arItem["PROPERTIES"]["EVENT_TYPE"]["VALUE"])): ?>
                          <div class="event-card__tag">
                            <!-- begin .label-->
                            <div class="label label_text-size_s label_size_xs label_shape_speech-br label_style_primary"><?= $arItem["PROPERTIES"]["EVENT_TYPE"]["VALUE"] ?></div>
                            <!-- end .label-->
                          </div>
                        <? endif; ?>
                        <? if (!empty($arItem["PROPERTIES"]["LOCATION_TYPE"]["VALUE"])): ?>
                          <div class="event-card__tag">
                            <!-- begin .label-->
                            <div class="label label_text-size_s label_size_xs label_style_secondary-dashed"><?= $arItem["PROPERTIES"]["LOCATION_TYPE"]["VALUE"]; ?></div>
                            <!-- end .label-->
                          </div>
                        <? endif; ?>
                      </div>
                    </div>
                    <div class="event-card__title"><?= $arItem["NAME"] ?></div>
                    <div class="event-card__text"><?= htmlspecialchars_decode($arItem["PREVIEW_TEXT"]) ?></div>
                    <div class="event-card__controls event-card__controls_role_desktop">
                      <?/*
                                <!-- *Временно скрыли исходя из task/45781* -->
                                <div class="event-card__control">
                                  <!-- begin .button-->
                                  <a class="button button_width_full button_size_m js-modal" href="#modalEvents" data-modal-callback="setEventName<?=$arItem["ID"]?>">
                                    <span class="button__holder">
                                      <span class="button__text">Записаться</span>
                                    </span>
                                  </a>
                                  <!-- end .button-->
                                </div>
                              */ ?>
                      <? if (!empty($moreButtonText) && !empty($moreButtonLink)): ?>
                        <div class="event-card__control">
                          <!-- begin .button-->
                          <a class="button button_width_full button_size_m" href="<?= $moreButtonLink ?>" target="_blank">
                            <span class="button__holder">
                              <span class="button__text"><?= $moreButtonText ?></span>
                            </span>
                          </a>
                          <!-- end .button-->
                        </div>
                      <? endif; ?>
                    </div>
                  </div>
                </div>
                <? if (!empty($arItem["SPEAKERS"])): ?>
                  <div class="event-card__entity-group">
                    <div class="event-card__heading-label">
                      <!-- begin .label-->
                      <div class="label label_text-size_s label_size_m label_style_primary-light label_weight_regular">Спикеры</div>
                      <!-- end .label-->
                    </div>
                    <div class="event-card__entities">
                      <? foreach ($arItem["SPEAKERS"] as $arSpeaker): ?>
                        <div class="event-card__entity">
                          <!-- begin .tippy-->
                          <div class="tippy tippy_position_none tippy_type_illustration tippy_style_secondary-reverse">
                            <div class="tippy__content">
                              <div class="tippy__illustration">
                                <? if (!empty($arSpeaker["IMAGE"])): ?>
                                  <picture class="tippy__picture">
                                    <img src="<?= $arSpeaker["IMAGE"]["src"] ?>" alt="<?= $arSpeaker["NAME"] ?>" class="tippy__image" title="">
                                  </picture>
                                <? endif; ?>
                              </div>
                              <div class="tippy__icon">+
                              </div>
                              <div class="tippy__container">
                                <div class="tippy__name"><?= $arSpeaker["NAME"] ?></div>
                                <div class="tippy__role"><?= $arSpeaker["PREVIEW_TEXT"] ?></div>
                              </div>
                            </div>
                          </div>
                          <!-- end .tippy-->
                        </div>
                      <? endforeach; ?>
                    </div>
                  </div>
                <? endif; ?>
                <div class="event-card__controls event-card__controls_role_mobile">
                  <?/*
                            <!-- *Временно скрыли исходя из task/45781* -->
                            <div class="event-card__control">
                              <!-- begin .button-->
                              <a class="button button_width_full button_size_m js-modal" href="#modalEvents" data-modal-callback="setEventName<?=$arItem["ID"]?>">
                                <span class="button__holder"><span class="button__text">Записаться</span></span>
                              </a>
                              <!-- end .button-->
                            </div>
                          */ ?>
                  <? if (!empty($moreButtonText) && !empty($moreButtonLink)): ?>
                    <div class="event-card__control">
                      <!-- begin .button-->
                      <a class="button button_width_full button_size_m" href="<?= $moreButtonLink ?>" target="_blank">
                        <span class="button__holder">
                          <span class="button__text"><?= $moreButtonText ?></span>
                        </span>
                      </a>
                      <!-- end .button-->
                    </div>
                  <? endif; ?>
                </div>
              </div>
              <!-- end .event-card-->
              <script>
                window['setEventName<?= $arItem["ID"] ?>'] = function(fancybox, modalEl, formEl) {
                  const eventName = '<?= $arItem["NAME"] ?>',
                    eventNameInput = formEl.querySelector('.form_entity_name');
                  if (eventNameInput) {
                    eventNameInput.value = eventName;
                  }
                }
              </script>
            </div>
          <? endforeach; ?>
        </div>
        <? if (!empty($arResult["NAV_RESULT"]->NavPageCount) && $arResult["NAV_RESULT"]->NavPageCount > 0): ?>
          <?= $arResult["NAV_STRING"] ?>
        <? endif; ?>
      </div>
    </div>
  </div>
<? else: ?>
  <div class="section__content">
    <?= (!empty($arParams['NO_ITEMS_MESSAGE']) ? $arParams['NO_ITEMS_MESSAGE'] : 'Мероприятий не найдено') ?>
  </div>
<? endif; ?>