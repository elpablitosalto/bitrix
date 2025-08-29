<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?
global $USER;
$userGroups = $USER->GetUserGroupArray();
?>
<? if ($arParams['NO_FILTER_TABS'] != 'Y') : ?>
    <div class="container">
        <div class="filter" data-filter="<?= $arResult['CODE'] ?>Slider">
            <? if (count($arResult['SECTIONS']) > 1) { ?>
                <? foreach ($arResult['SECTIONS'] as $code => $sec) : ?>
                    <? if (!in_array($sec['ID'], $userGroups) && $code != 'all') continue; ?>
                    <button class="filter__button<?= ($code == 'all') ? ' _active' : '' ?>" data-filter-type="<?= $code ?>"><?= $sec['TITLE'] ?></button>
                <? endforeach; ?>
            <? } else { ?>
                <a class="filter__button _active" href="/press-center/<?= $arResult['CODE'] ?>/"><?= $arResult['SECTIONS']['all']['TITLE'] ?></a>
            <? } ?>
            <div class="navigation">
                <!-- Add Arrows -->
                <div class="swiper-button-next">
                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M9.83111 21.4207C9.6856 21.2756 9.57016 21.1032 9.49139 20.9133C9.41262 20.7235 9.37207 20.52 9.37207 20.3145C9.37207 20.1089 9.41262 19.9054 9.49139 19.7156C9.57016 19.5258 9.6856 19.3534 9.83111 19.2082L18.103 10.9395L9.83111 2.67072C9.53772 2.37732 9.37289 1.97939 9.37289 1.56447C9.37289 1.14954 9.53772 0.751614 9.83111 0.458218C10.1245 0.164822 10.5224 -3.86498e-06 10.9374 -3.88312e-06C11.3523 -3.90126e-06 11.7502 0.164822 12.0436 0.458218L21.4186 9.83322C21.5641 9.97836 21.6796 10.1508 21.7583 10.3406C21.8371 10.5304 21.8777 10.7339 21.8777 10.9395C21.8777 11.145 21.8371 11.3485 21.7583 11.5383C21.6796 11.7282 21.5641 11.9006 21.4186 12.0457L12.0436 21.4207C11.8985 21.5662 11.726 21.6817 11.5362 21.7604C11.3464 21.8392 11.1429 21.8798 10.9374 21.8798C10.7318 21.8798 10.5283 21.8392 10.3385 21.7604C10.1487 21.6817 9.97626 21.5662 9.83111 21.4207Z" fill="#3333CC" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M-6.8299e-08 10.9395C-8.64131e-08 10.5251 0.16462 10.1276 0.457646 9.8346C0.750671 9.54157 1.1481 9.37695 1.5625 9.37695L17.1875 9.37695C17.6019 9.37695 17.9993 9.54157 18.2924 9.8346C18.5854 10.1276 18.75 10.5251 18.75 10.9395C18.75 11.3539 18.5854 11.7513 18.2924 12.0443C17.9993 12.3373 17.6019 12.502 17.1875 12.502L1.5625 12.502C1.1481 12.502 0.750672 12.3373 0.457646 12.0443C0.16462 11.7513 -5.0185e-08 11.3539 -6.8299e-08 10.9395Z" fill="#959595" />
                    </svg>
                </div>
                <div class="swiper-button-prev">
                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12.0466 21.4207C12.1921 21.2756 12.3075 21.1032 12.3863 20.9133C12.4651 20.7235 12.5056 20.52 12.5056 20.3145C12.5056 20.1089 12.4651 19.9054 12.3863 19.7156C12.3075 19.5258 12.1921 19.3534 12.0466 19.2082L3.7747 10.9395L12.0466 2.67072C12.34 2.37732 12.5048 1.97939 12.5048 1.56447C12.5048 1.14954 12.34 0.751614 12.0466 0.458218C11.7532 0.164822 11.3552 -3.86498e-06 10.9403 -3.88312e-06C10.5254 -3.90126e-06 10.1275 0.164822 9.83407 0.458218L0.459073 9.83322C0.313563 9.97836 0.198118 10.1508 0.119347 10.3406C0.0405774 10.5304 3.10048e-05 10.7339 3.09958e-05 10.9395C3.09868e-05 11.145 0.0405774 11.3485 0.119347 11.5383C0.198118 11.7282 0.313563 11.9006 0.459073 12.0457L9.83407 21.4207C9.97922 21.5662 10.1516 21.6817 10.3415 21.7604C10.5313 21.8392 10.7348 21.8798 10.9403 21.8798C11.1458 21.8798 11.3493 21.8392 11.5392 21.7604C11.729 21.6817 11.9014 21.5662 12.0466 21.4207Z" fill="#959595" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M21.8777 10.9395C21.8777 10.5251 21.7131 10.1276 21.42 9.8346C21.127 9.54157 20.7296 9.37695 20.3152 9.37695L4.69019 9.37695C4.27579 9.37695 3.87836 9.54157 3.58533 9.8346C3.29231 10.1276 3.12769 10.5251 3.12769 10.9395C3.12769 11.3539 3.29231 11.7513 3.58533 12.0443C3.87836 12.3373 4.27579 12.502 4.69019 12.502L20.3152 12.502C20.7296 12.502 21.127 12.3373 21.42 12.0443C21.7131 11.7513 21.8777 11.3539 21.8777 10.9395Z" fill="#959595" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
<? endif; ?>
<div class="container">
    <div class="default-slider-wrapper">
        <div id="<?= $arResult['CODE'] ?>Slider" data-default-slider class="<?= $arResult['CODE'] ?>-slider swiper-container">
            <div class="swiper-wrapper">
                <? foreach ($arResult['ITEMS'] as $code => $arItem) : ?>
                    <?php $CURRENT_DATE = '';
                    $CURRENT_DATE = $arItem['PROPERTIES']['START_DATE']['VALUE']; ?>
                    <? if (!$USER->isAuthorized() && !empty($arItem['SECTION']['CODE'])) continue; ?>
                    <? $pic = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width' => 270, 'height' => 240), BX_RESIZE_IMAGE_PROPORTIONAL, true); ?>
                    <div class="news-slider__slide swiper-slide" data-filter-type="<?= (!empty($arItem['SECTION']['CODE'])) ? $arItem['SECTION']['CODE'] : 'none' ?>">
                        <div class="news-slider__slide-image">
                            <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>">
                                <img class="js_lazy" data-src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>" loading="lazy" alt="<?= $pic['ALT'] ?>" title="<?= $pic['TITLE'] ?>" />
                            </a>
                        </div>
                        <div class="news-slider__slide-description">
                            <a class="news-slider__slide-description--link" href="<?= $arItem['DETAIL_PAGE_URL'] ?>"><?= $arItem['NAME'] ?></a>
                            <span class="news-slider__slide-description--date"><?= FormatDate('j F Y года', strtotime($CURRENT_DATE)) ?></span>
                        </div>
                        <div class="navigation">
                            <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" class="button _empty">Подробнее</a>
                        </div>
                    </div>
                <? endforeach; ?>
            </div>
        </div>
    </div>
</div>