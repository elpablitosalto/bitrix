<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $APPLICATION;
?>
<?$this->setFrameMode(false);?>
<div class="modal__header">
    <div class="modal__title">
        <!-- begin .title-->
        <h3 class="title title_size_h3">Выберите город</h3>
        <!-- end .title-->
    </div>
</div>
<div class="modal__content">
    <div class="modal__search">
        <!-- begin .search-form-->
        <form class="search-form">
            <div class="search-form__field">
                <input
                        type="text"
                        class="search-form__input js-search-with-results"
                        placeholder="Введите город"
                />
                <div class="search-form__clear-control">
                    <button type="button" class="search-form__clear js-search-clear">Очистить</button>
                </div>
                <div class="search-form__control">
                    <button type="submit" class="search-form__submit">
                        <svg
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                                class="search-form__icon"
                        >
                            <path
                                    d="M18.031 16.617L22.314 20.899L20.899 22.314L16.617 18.031C15.0237 19.3082 13.042 20.0029 11 20C6.032 20 2 15.968 2 11C2 6.032 6.032 2 11 2C15.968 2 20 6.032 20 11C20.0029 13.042 19.3082 15.0237 18.031 16.617ZM16.025 15.875C17.2941 14.5699 18.0029 12.8204 18 11C18 7.132 14.867 4 11 4C7.132 4 4 7.132 4 11C4 14.867 7.132 18 11 18C12.8204 18.0029 14.5699 17.2941 15.875 16.025L16.025 15.875Z"
                            ></path>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="search-form__results">
                <!-- begin .search-results-->
                <!--<div class="search-results">
                    <div class="search-results__message">Совпадений не найдено</div>
                    <div class="search-results__matches">
                        <ul class="search-results__list">
                            <li class="search-results__item">
                                <a href="#" class="search-results__link">
                                    <span class="highlight">Вендинг</span>
                                    овые автоматы
                                </a>
                            </li>
                            <li class="search-results__item">
                                <a href="#" class="search-results__link">
                                    Все о
                                    <span class="highlight">вендинг</span>
                                    е
                                </a>
                            </li>
                            <li class="search-results__item">
                                <a href="#" class="search-results__link">
                                    Запчасти для
                                    <span class="highlight">вендинг</span>
                                    ового автомата
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>-->
                <!-- end .search-results-->
            </div>
        </form>
        <!-- end .search-form-->
    </div>
    <div class="modal__geo-list">
        <?if(!empty($arResult["TOP_REGIONS"])):?>
            <!-- begin .geo-list-->
            <div class="geo-list">
                <div class="geo-list__links">
                    <!-- begin .link-->
                    <!--<a class="link" href="#">Определить город автоматически</a>-->
                    <!-- end .link-->
                </div>
                <ul class="geo-list__list">
                    <?foreach ($arResult["TOP_REGIONS"] as $region):?>
                        <li class="geo-list__item">
                            <a class="geo-list__link <?if($region["ID"] == $arResult["CURRENT_REGION"]["ID"]):?>geo-list__link_state_active<?endif;?>" data-region-id="<?=$region["ID"]?>">
                                <span class="geo-list__label"><?=$region["NAME"]?></span>
                                <span class="geo-list__icon-wrapper">
                                        <svg
                                            width="24"
                                            height="24"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="geo-list__icon"
                                        >
                                        <path d="M8.9999 16.2001L4.7999 12.0001L3.3999 13.4001L8.9999 19.0001L20.9999 7.0001L19.5999 5.6001L8.9999 16.2001Z"></path>
                                        </svg>
                                </span>
                            </a>
                        </li>
                    <?endforeach;?>
                </ul>
            </div>
            <!-- end .geo-list-->
        <?endif;?>
    </div>
</div>
<?if($arResult["SHOW_POPUP"]):?>
    <!-- begin .modal-->
    <div class="modal modal_size_xs modal_close_hidden" id="modalGeoPrompt">
        <div class="modal__content">
            <div class="modal__text"><p>Ваш город <?=$arResult["CURRENT_REGION"]["NAME"]?>?</p></div>
            <div class="modal__controls">
                <div class="modal__control">
                    <!-- begin .button-->
                    <button class="button button_width_full button_size_s js-fancybox-close" type="submit">
                        <span class="button__holder">Все верно</span>
                    </button>
                    <!-- end .button-->
                </div>
                <div class="modal__control">
                    <!-- begin .button-->
                    <a
                            class="button button_width_full button_size_s button_style_light js-geo-select-modal"
                            href="#modalGeoSelect"
                    >
                        <span class="button__holder">Выбрать город</span>
                    </a>
                    <!-- end .button-->
                </div>
            </div>
        </div>
    </div>
    <!-- end .modal-->
    <script>
        (function () {
            window.addEventListener('load', function () {
                var showSelectTrigger = false;

                Fancybox.show([
                    {
                        src: '#modalGeoPrompt'
                    }
                ], {
                    closeExisting: true,
                    autoFocus: false,
                    touch: false,
                    on: {
                        destroy: function (fancybox, slide) {
                            if (showSelectTrigger) {
                                Fancybox.show([
                                    {
                                        src: showSelectTrigger.attributes.href ? showSelectTrigger.attributes.href.value : '#modalGeoSelect'
                                    }
                                ], {
                                    closeExisting: true,
                                    autoFocus: false,
                                    touch: false,
                                    trapFocus: false
                                });
                            }else{
                                let result = window.BX.ajax.runComponentAction("waim:geo.search", "confirmCity", {
                                    mode: 'class',
                                    data: {
                                        currentCityId: <?=intval($arResult["CURRENT_REGION"]["ID"])?>
                                    }
                                });
                            }
                        }
                    }
                });

                document.body.addEventListener('click', function (e) {
                    var trigger = e.target.closest('.js-geo-select-modal');
                    if (trigger) {
                        showSelectTrigger = trigger;
                        Fancybox.getInstance().close();
                    }
                });
            }, false);
        })();
    </script>
<?endif;?>