<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Type\DateTime;

/**
 * @global CMain $APPLICATION
 */
global $APPLICATION;
?>
<? if (!empty($arResult["EVENTS"])): ?>
<div class="section" id="our_events_wrapper">
    <div class="section__header section__header_type_inline">
        <div class="section__title">
            <!-- begin .title-->
            <h2 class="title title_size_sh2">
                <div class="highlight">Как проходят</div>
                наши мероприятия
            </h2>
            <!-- end .title-->
        </div>
        <div class="section__extra">
            <div class="section__link-item">
                <?
                //$link = 'https://leads.noboring-finance.ru/events';
                $link = '/our_events/?our_events=Y#events_tags';
                ?>
                <!-- begin .link-item--><a
                    class="link-item link-item_text-size_l link-item_icon-size_l link-item_icon-offset_l link-item_style_primary"
                    href="<?=$link;?>"><span class="link-item__label">Мероприятия НФ</span>
                    <svg width="14" height="10" viewBox="0 0 14 10" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 5.08348L4.95774 9.04226L13 1" stroke="#E31513" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
                <!-- end .link-item-->
            </div>
        </div>
        <div class="section__subtitle">Для наших клиентов и друзей мы регулярно <br>проводим живые
            мероприятия
        </div>
    </div>
    <div class="section__content">

        <div class="section__events-panel">
            <!-- begin .activity-carousel-->
            <div class="activity-carousel">
                <div class="activity-carousel__tags">
                    <!-- begin .tag-list-->
                    <div class="tag-list activity-carousel__tag-list">
                        <div class="tag-list__container">
                            <button class="tag-list__mobile-trigger js-toggle" type="button" data-toggle-scope=".tag-list" data-toggle-class="tag-list_state_open">
                                Открыть список
                            </button>
                            <div class="tag-list__tags">
                                <? foreach ($arResult["EVENTS"] as $eventId => $arEvent): ?>
                                <a
                                    href="?our_event_id=<?= $arEvent["ID"] ?>"
                                    class="tag-list__tag <?= ($eventId == $arResult["CURRENT_EVENT_ID"] ? "tag-list__tag_state_active" : "") ?>">
                                    <?= $arEvent["NAME"] ?>
                                </a>
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
                <div class="activity-carousel__container swiper js-activity-carousel">
                    <div class="activity-carousel__wrapper swiper-wrapper">
                        <? if (!empty($arResult["EVENTS"][$arResult["CURRENT_EVENT_ID"]]["GALLERY"])): ?>
                        <?
                            $obEventDate = !empty($arItem["ACTIVE_FROM"]) ? (new DateTime($arItem["ACTIVE_FROM"], 'd.m.Y H:i:s')) : (new DateTime($arItem["DATE_CREATE"], 'd.m.Y H:i:s'));
                        ?>
                        <? foreach ($arResult["EVENTS"][$arResult["CURRENT_EVENT_ID"]]["GALLERY"] as $index => $arImage): ?>
                        <div class="activity-carousel__slide swiper-slide">
                            <!-- begin .activity-item-->
                            <div class="activity-item">
                                <a class="activity-item__container js-modal"
                                    href="<?= $arImage["SRC"] ?>"
                                    data-fancybox="gallery">
                                    <span class="activity-item__illustration">
                                        <picture class="activity-item__picture">
                                            <? $renderImage = CFile::ResizeImageGet(
                                                $arImage["ID"],
                                                array("width" => 1110, "height" => 792),
                                                BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
                                                true
                                            ); ?>
                                            <img src="<?= $renderImage["src"] ?>"
                                                alt="<?= $arImage["ORIGINAL_NAME"] ?>"
                                                class="activity-item__image"
                                                loading="lazy" />
                                        </picture>
                                    </span>
                                    <span class="activity-item__title"><?= $arImage["DESCRIPTION"] ?></span>
                                    <span class="activity-item__date"><?= $obEventDate->format("Y") ?></span>
                                </a>
                            </div>
                            <!-- end .activity-item-->
                        </div>
                        <? endforeach; ?>
                        <? endif; ?>
                    </div>
                </div>
                <div class="activity-carousel__navigation">
                    <div class="activity-carousel__pagination">
                        <!-- begin .bullet-pagination-->
                        <div class="bullet-pagination bullet-pagination_role_activity">
                        </div>
                        <!-- end .bullet-pagination-->
                    </div>
                    <div class="activity-carousel__arrows">
                        <!-- begin .carousel-nav-->
                        <div class="carousel-nav carousel-nav_position_sides js-carousel-nav"
                            data-nav-scope=".activity-carousel" data-nav-target=".swiper">
                            <div class="carousel-nav__control">
                                <!-- begin .button-->
                                <button class="button button_role_navigation js-carousel-nav-prev"
                                    type="button"><span class="button__holder">
                                        <svg class="button__icon" width="10" height="17" viewBox="0 0 10 17" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9 1L1.33333 8.66667L9 16.3333" fill="transparent" stroke="currentColor"></path>
                                        </svg></span>
                                </button>
                                <!-- end .button-->
                            </div>
                            <div class="carousel-nav__control">
                                <!-- begin .button-->
                                <button class="button button_role_navigation js-carousel-nav-next"
                                    type="button"><span class="button__holder">
                                        <svg class="button__icon" width="16" height="17" viewBox="0 0 16 17" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M4 16L11.6667 8.33333L4 0.666667" fill="transparent" stroke="currentColor"></path>
                                        </svg></span>
                                </button>
                                <!-- end .button-->
                            </div>
                        </div>
                        <!-- end .carousel-nav-->
                    </div>
                </div>
            </div>
            <!-- end .activity-carousel-->
        </div>
    </div>
</div>
<? endif; ?>