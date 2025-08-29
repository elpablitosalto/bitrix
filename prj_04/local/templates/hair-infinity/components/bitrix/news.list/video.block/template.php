<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Hair\General;

?>
<? if (!empty($arResult['ITEMS'])) : ?>
    <div class="section section_role_videos">
        <div class="section__header">
            <div class="section__container page__container">
                <div class="section__title">
                    <!-- begin .title-->
                    <h2 class="title title_size_h3 title_style_dependent">Видео-материалы</h2>
                    <!-- end .title-->
                </div>
            </div>
        </div>
        <div class="section__content">
            <div class="page__container">
                <div class="section__video-group">
                    <!-- begin .video-group-->
                    <div class="video-group">
                        <ul class="video-group__list">
                            <? foreach ($arResult['ITEMS'] as $video) : ?>
                                <li class="video-group__item">
                                    <!-- begin .video-card-->
                                    <div class="video-card">
                                        <a data-youtube="" href="<?= $video['PROPERTIES']['VIDEO_LINK']['VALUE'] ?>" class="video-card__illustration js-modal">
                                            <picture class="video-card__picture">
                                                <img class="video-card__image js_lazy" data-src="<?= $video['PICTURE']['DESKTOP']['SRC'] ?>" width="<?= $video['PICTURE']['DESKTOP']['WIDTH'] ?>" height="<?= $video['PICTURE']['DESKTOP']['HEIGHT'] ?>" alt="<?= $video["NAME"] ?>" title="<?= $video["NAME"] ?>" />
                                                <?/*?>
                                                <img src="<?= \CFile::GetPath($video['PROPERTIES']['VIDEO_PREVIEW']['VALUE']) ?>" alt="<?= $video["NAME"] ?>" class="video-card__image" title="<?= $video["NAME"] ?>" />
                                                <?*/ ?>
                                            </picture>
                                            <svg class="video-card__icon" width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M60.7507 38.8987L31.4174 18.8987C31.008 18.6213 30.48 18.5907 30.0427 18.8213C29.6067 19.052 29.3334 19.5053 29.3334 20V60C29.3334 60.4947 29.6067 60.948 30.044 61.1787C30.2387 61.2827 30.4534 61.3333 30.6667 61.3333C30.9294 61.3333 31.192 61.2547 31.4174 61.1013L60.7507 41.1013C61.1147 40.8533 61.3334 40.4413 61.3334 40C61.3334 39.5587 61.1147 39.1467 60.7507 38.8987ZM32 57.476V22.524L57.6334 40L32 57.476Z" />
                                                <path d="M40 0C17.944 0 0 17.944 0 40C0 62.056 17.944 80 40 80C62.056 80 80 62.056 80 40C80 17.944 62.056 0 40 0ZM40 77.3333C19.4147 77.3333 2.66667 60.5853 2.66667 40C2.66667 19.4147 19.4147 2.66667 40 2.66667C60.5853 2.66667 77.3333 19.4147 77.3333 40C77.3333 60.5853 60.5853 77.3333 40 77.3333Z" />
                                            </svg>
                                        </a>
                                        <div class="video-card__content">
                                            <div class="video-card__caption">
                                                <a href="<?= $video['PROPERTIES']['VIDEO_LINK']['VALUE'] ?>" data-youtube="" class="video-card__link js-modal">
                                                    <?= $video["NAME"] ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end .video-card-->
                                </li>
                            <? endforeach; ?>
                        </ul>
                    </div>
                    <!-- end .video-group-->
                </div>
            </div>
        </div>
    </div>
<? endif; ?>