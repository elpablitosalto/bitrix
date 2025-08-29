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

<? if (!empty($arResult["ITEMS"])) { ?>

    <section class="pickup-section">
        <h2>Самовывоз</h2>

        <ul class="delivery__slider-list">
            <? foreach ($arResult["ITEMS"] as $key => $arItem) { ?>
                <li class="delivery__slider-item<?if ($key == 0):?> delivery__slider-item_active<?endif;?>">
                    <?= $arItem['NAME']; ?>
                </li>
            <? } ?>
        </ul>
        <div class="delivery__slider">
            <div class="delivery__slider-wrapper">
                <? foreach ($arResult["ITEMS"] as $key => $arItem) { ?>
                    <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                    <div class="contacts__address" id="<?= $this->GetEditAreaId($arItem['ID']); ?>" itemscope
                         itemtype="https://schema.org/Organization">
                        <div class="contacts__maps">
                            <h2 itemprop="name"><?= $arItem['NAME']; ?></h2>
                            <div class="contacts__map-wrapper">
                                <div class="contacts__map-address" itemprop="address" itemscope
                                     itemtype="http://schema.org/PostalAddress">
                                    <p class="contacts__map-metro">
                                        <?= $arItem['DISPLAY_PROPERTIES']['ADDRESS_1']['VALUE'] ?>
                                    </p>
                                    <p itemprop="streetAddress">
                                        <?= $arItem['DISPLAY_PROPERTIES']['ADDRESS_2']['VALUE'] ?>
                                    </p>
                                    <p class="contacts__map-note">
                                        <? if (!empty($arItem['DISPLAY_PROPERTIES']['IMPORTANT_MESSAGE']['VALUE'])) { ?>
                                            <span>!</span> <?= $arItem['DISPLAY_PROPERTIES']['IMPORTANT_MESSAGE']['VALUE'] ?>
                                        <? } ?>
                                    </p>
                                </div>
                                <div class="contacts__map-schedule">
                                    <p>
                                        <? if (!empty($arItem['DISPLAY_PROPERTIES']['SCHEDULE']['VALUE'])) { ?>
                                            <span datetime="<?= $arItem['DISPLAY_PROPERTIES']['SCHEDULE']['VALUE'] ?>">График работы:</span> <?= $arItem['DISPLAY_PROPERTIES']['SCHEDULE']['VALUE'] ?>
                                        <? } ?>
                                    </p>
                                </div>
                                <div class="contacts__map-constact">
                                    <? foreach ($arItem['PHONES']['arSources'] as $k => $phone) { ?>
                                        <a class="contacts__map-phone" itemprop="telephone"
                                           href="tel:<?= $arItem['PHONES']['arValuesForLink'][$k] ?>"><span
                                                itemprop="telephone"><?= $phone; ?></span></a>
                                    <? } ?>
                                    <? if (!empty($arItem['DISPLAY_PROPERTIES']['EMAIL']['VALUE'])) { ?>
                                        <a itemprop="email"
                                           href="mailto:<?= $arItem['DISPLAY_PROPERTIES']['EMAIL']['VALUE'] ?>"><?= $arItem['DISPLAY_PROPERTIES']['EMAIL']['VALUE'] ?></a>
                                    <? } ?>
                                </div>
                            </div>
                            <div class="contacts__manager">
                                <? if (!empty($arItem['MANAGER_PHOTO'])) { ?>
                                    <div class="contacts__manager-image">
                                        <img src="<?= $arItem['MANAGER_PHOTO']['SRC'] ?>"
                                             alt="<?= $arItem['MANAGER_PHOTO']['ALT'] ?>"
                                             title="<?= $arItem['MANAGER_PHOTO']['TITLE'] ?>"/>
                                    </div>
                                <? } ?>
                                <div class="contacts__manager-name">
                                    <? if (!empty($arItem['DISPLAY_PROPERTIES']['MANAGER']['VALUE'])) { ?>
                                        <span>Менеджер</span> <?= $arItem['DISPLAY_PROPERTIES']['MANAGER']['VALUE'] ?>
                                    <? } ?>
                                    <? if (!empty($arItem['WHATSAPP_PHONE_FOR_LINK'])) { ?>
                                        <a class="contacts__button-messenger" target="_blank"
                                           href="https://wa.me/<?= $arItem['WHATSAPP_PHONE_FOR_LINK']; ?>">Cвязаться в Whatsapp
                                            <svg width="30" height="30">
                                                <use
                                                    xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/icons/sprite/svg-sprite.svg#whatsapp"></use>
                                            </svg>
                                        </a>
                                    <? } ?>
                                </div>
                            </div>
                            <div class="contacts__maps-wrapper">
                                <? if ($arItem['DISPLAY_PROPERTIES']['NEED_ORDER_PASS']['VALUE_XML_ID'] == 'Y' && !empty($arItem['WHATSAPP_PHONE_FOR_LINK'])) { ?>
                                    <div class="contacts__map-pass">
                                        Не забудьте заказать пропуск
                                        <a class="contacts__button-pass" target="_blank"
                                           href="https://wa.me/<?= $arItem['WHATSAPP_PHONE_FOR_LINK']; ?>">Заказать пропуск</a>
                                    </div>
                                <? } ?>
                                <? if (!empty($arItem['DISPLAY_PROPERTIES']['ROAD_MAP']['VALUE'])) { ?>
                                    <a class="contacts__button-map" target="_blank"
                                       href="<?= $arItem['DISPLAY_PROPERTIES']['ROAD_MAP']['VALUE']; ?>" target="_blank">Карта
                                        проезда</a>
                                <? } ?>
                                <? if (!empty($arItem['DISPLAY_PROPERTIES']['LONGITUDE']['VALUE']) && !empty($arItem['DISPLAY_PROPERTIES']['LATITUDE']['VALUE'])) { ?>
                                    <a class="contacts__button-route" target="_blank"
                                       href="https://yandex.ru/maps/?rtext=~<?= $arItem['DISPLAY_PROPERTIES']['LONGITUDE']['VALUE']; ?>,<?= $arItem['DISPLAY_PROPERTIES']['LATITUDE']['VALUE'] ?>&rtt=auto">
                                        <svg width="24" height="24">
                                            <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/icons/sprite/svg-sprite.svg#route"></use>
                                        </svg>
                                        Построить машрут
                                    </a>
                                <? } ?>
                            </div>
                            <div class="map-wrapper js_maps_contacts" id="<?= md5($arItem['ID']); ?>"
                                 data-marker-img="<?= SITE_TEMPLATE_PATH ?>/img/design/marker-map.svg"
                                 data-hint="<?= $arItem['NAME']; ?>"
                                 data-longitude="<?= $arItem['DISPLAY_PROPERTIES']['LONGITUDE']['VALUE']; ?>"
                                 data-latitude="<?= $arItem['DISPLAY_PROPERTIES']['LATITUDE']['VALUE'] ?>"></div>
                        </div>
                        <? if (!empty($arItem['DISPLAY_PROPERTIES']['HOW_TO_GET_CAR']['~VALUE']) || !empty($arItem['DISPLAY_PROPERTIES']['HOW_TO_GET_PT']['~VALUE'])) { ?>
                            <div class="contacts__route">
                                <h2 class="contacts__route-title">Как добраться</h2>
                                <div class="contacts__route-wrapper">
                                    <? if (!empty($arItem['DISPLAY_PROPERTIES']['HOW_TO_GET_CAR']['~VALUE']['TEXT'])) { ?>
                                        <h3>На автомобиле</h3>
                                        <p><?= $arItem['DISPLAY_PROPERTIES']['HOW_TO_GET_CAR']['~VALUE']['TEXT']; ?></p>
                                    <? } ?>
                                    <? if (!empty($arItem['DISPLAY_PROPERTIES']['HOW_TO_GET_PT']['~VALUE']['TEXT'])) { ?>
                                        <h3>На общественном транспорте</h3>
                                        <p><?= $arItem['DISPLAY_PROPERTIES']['HOW_TO_GET_PT']['~VALUE']['TEXT']; ?></p>
                                    <? } ?>
                                </div>
                            </div>
                        <? } ?>
                    </div>
                <? } ?>
            </div>
        </div>
    </section>

<? } ?>