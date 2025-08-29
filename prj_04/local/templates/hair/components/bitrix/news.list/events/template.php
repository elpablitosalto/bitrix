<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>

<?php if (!empty($arResult['ITEMS'])): ?>
    <section class="events">
        <div class="container">
            <h2>Мероприятия</h2>
        </div>
        <div class="container">
            <div class="events-wrapper">
                <div class="desktop-events">
                    <?php if (count($arResult['ITEMS']) >= 2) {
                        $count = 2;
                    } else {
                        $count = count($arResult['ITEMS']);
                    } ?>
                    <? for ($i = 0; $i < $count; $i++): ?>
                        <?
                        $pic = CFile::ResizeImageGet($arResult['ITEMS'][$i]['PREVIEW_PICTURE'], array('width' => 500, 'height' => 288), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                        $locationID = $arResult['ITEMS'][$i]['DISPLAY_PROPERTIES']['LOCATION']['VALUE'][0];
                        ?>
                        <div class="event-item<?= (isset($arResult['ITEMS'][$i]['DISPLAY_PROPERTIES']['STATUS'])) ? ' _active' : '' ?>">
                            <a href="<?= $arResult['ITEMS'][$i]['DETAIL_PAGE_URL'] ?>"
                               class="col-lg-5 event-item__image">
                                <div class="event-item__image-container">
                                    <img src="<?= $pic['src'] ?>" alt role="presentation" class="event-item__img">
                                    <!--                        <div class="event-item__image-date">-->
                                    <!--                            <p>-->
                                    <? //=$arItem['DISPLAY_PROPERTIES']['EVENT_TIME']['DISPLAY_VALUE']?><!--</p>-->
                                    <!--                            <p>-->
                                    <? //=FormatDate('j F Y года',strtotime($arItem['ACTIVE_FROM']))?><!--, -->
                                    <? //=$arItem['DISPLAY_PROPERTIES']['LOCATION']['LINK_SECTION_VALUE'][$locationID]['NAME']?><!--</p>-->
                                    <!--                        </div>-->
                                    <!--                        -->
                                    <? //if(isset($arItem['DISPLAY_PROPERTIES']['STATUS'])):?><!--<div class="event-item__image-tag">Завершен</div>--><? //endif;?>
                                </div>
                            </a>
                            <div class="col-lg-5 event-item__description">
                                <h3><?= $arResult['ITEMS'][$i]['NAME'] ?></h3>
                                <div class="event-item__description-date">
                                    <p><?= $arResult['ITEMS'][$i]['PROPERTIES']['START_DATE']['VALUE'] ?></p>
                                    <p><? if ($arResult['ITEMS'][$i]['PROPERTIES']['EVENT_TIME']['VALUE']) {
                                            echo $arResult['ITEMS'][$i]['PROPERTIES']['EVENT_TIME']['VALUE'];
                                        } ?></p>
                                </div>
                                <div class="event-item__description-text">
                                    <?= $arResult['ITEMS'][$i]['PREVIEW_TEXT'] ?>
                                </div>
                                <a href="<?= $arResult['ITEMS'][$i]['DETAIL_PAGE_URL'] ?>" class="button _small">Подробнее</a>
                            </div>
                        </div>
                    <? endfor; ?>
                    <div class="navigation">
                        <a href="/press-center/events/" class="learn-more">Смотреть все </a>
                    </div>
                </div>

                <? if (count($arResult['ITEMS']) == 1):?>
                    <div class="mobile-events">
                        <div class="one-event">
                            <? foreach ($arResult['ITEMS'] as $item): ?>
                                <?
                                $locationID = $item['DISPLAY_PROPERTIES']['LOCATION']['VALUE'][0];
                                ?>
                                <div class="event-item<?= (isset($item['DISPLAY_PROPERTIES']['STATUS'])) ? ' _active' : '' ?>">
                                    <a href="<?= $item['DETAIL_PAGE_URL'] ?>" class="col-lg-5 event-item__image">
                                        <div class="event-item__image-container">
                                            <img src="<?= $pic['src'] ?>" alt role="presentation" class="event-item__img">
                                        </div>
                                    </a>
                                    <div class="col-lg-5 event-item__description">
                                        <h3><?= $item['NAME'] ?></h3>
                                        <div class="event-item__description-date">
                                            <p><?= FormatDate('j F Y года', strtotime($item['ACTIVE_FROM'])) ?>
                                                , <?= $item['DISPLAY_PROPERTIES']['LOCATION']['LINK_SECTION_VALUE'][$locationID]['NAME'] ?></p>
                                            <p><?= $item['DISPLAY_PROPERTIES']['EVENT_TIME']['DISPLAY_VALUE'] ?></p>
                                        </div>
                                        <div class="event-item__description-text">
                                            <?= $item['PREVIEW_TEXT'] ?>
                                        </div>
                                        <div class="bottom-button-wrapper">
                                            <a href="<?= $item['DETAIL_PAGE_URL'] ?>"
                                               class="button _small mobile-slider-button">Подробнее</a>
                                        </div>
                                    </div>
                                </div>
                            <? endforeach; ?>
                        </div>
                    </div>
                <?else:?>
                    <div class="mobile-events" data-mobile_news-slider>
                    <div class="swiper newsMobileSwiper">
                        <div class="swiper-wrapper">
                            <? foreach ($arResult['ITEMS'] as $item): ?>
                                <div class="swiper-slide">
                                    <?
                                    $pic = CFile::ResizeImageGet($item['PREVIEW_PICTURE'], array('width' => 500, 'height' => 288), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                                    $locationID = $item['DISPLAY_PROPERTIES']['LOCATION']['VALUE'][0];
                                    ?>
                                    <div class="event-item<?= (isset($item['DISPLAY_PROPERTIES']['STATUS'])) ? ' _active' : '' ?>">
                                        <a href="<?= $item['DETAIL_PAGE_URL'] ?>" class="col-lg-5 event-item__image">
                                            <div class="event-item__image-container">
                                                <img src="<?= $pic['src'] ?>" alt role="presentation" class="event-item__img">
                                            </div>
                                        </a>
                                        <div class="col-lg-5 event-item__description">
                                            <h3><?= $item['NAME'] ?></h3>
                                            <div class="event-item__description-date">
                                                <p><?= FormatDate('j F Y года', strtotime($item['ACTIVE_FROM'])) ?>
                                                    , <?= $item['DISPLAY_PROPERTIES']['LOCATION']['LINK_SECTION_VALUE'][$locationID]['NAME'] ?></p>
                                                <p><?= $item['DISPLAY_PROPERTIES']['EVENT_TIME']['DISPLAY_VALUE'] ?></p>
                                            </div>
                                            <div class="event-item__description-text">
                                                <?= $item['PREVIEW_TEXT'] ?>
                                            </div>
                                            <div class="bottom-button-wrapper">
                                                <a href="<?= $item['DETAIL_PAGE_URL'] ?>"
                                                   class="button _small mobile-slider-button">Подробнее</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <? endforeach; ?>
                        </div>
                    </div>
                </div>
                <?endif;?>
            </div>
        </div>
    </section>
<?php endif; ?>