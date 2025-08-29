<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>

<div class="faq-section">
    <div class="faq-section__wrapper">
        <div class="faq-section__main">
            <div class="faq-group">
                <ul class="faq-group__list">
                    <?foreach($arResult['GROUPS'] as $k => $arGroup):?>
                        <?if(!empty($arGroup['SECTION']['NAME']) && !empty($arGroup['ITEMS'])):?>
                            <? $arSection = $arGroup['SECTION']; ?>
                            <li class="faq-group__item">
                                <div class="faq-item" id="faq-item-<?=$arSection['ID']?>">
                                    <div class="faq-item__header">
                                        <a href="#faq-item-<?=$arSection['ID']?>" class="faq-item__trigger js-faq-trigger"><?=$arSection['NAME']?></a>
                                        <h2 class="faq-item__title"><?=$arSection['NAME']?></h2>
                                    </div>
                                    <div class="faq-item__body">
                                        <ul class="faq-item__list">
                                            <?foreach($arGroup['ITEMS'] as $k => $arItem):?>
                                                 <div class="faq-item__accordeon">
                                                    <div class="faq-accordeon" id="faq-accordeon-<?=$arItem['ID']?>">
                                                        <div class="faq-accordeon__header">
                                                            <a href="#faq-accordeon-<?=$arItem['ID']?>" class="faq-accordeon__trigger js-faq-acc-trigger">
                                                                <?=$arItem['NAME']?>
                                                            </a>
                                                        </div>
                                                        <div class="faq-accordeon__body">
                                                            <div class="faq-accordeon__fields">
                                                                <?=$arItem['DETAIL_TEXT']?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                 </div>
                                            <?endforeach;?>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        <?endif;?>
                    <?endforeach;?>
                </ul>
            </div>
        </div>
        <div class="faq-section__aside">
            <div class="faq-section__sidebar">
                <div class="faq-section__controls">
                    <div class="control-group js-scroll-spy-container" data-scrollspy-active-class="control-group__button_state_active">
                        <?foreach($arResult['GROUPS'] as $k => $arGroup):?>
                            <?if(!empty($arGroup['SECTION']['NAME']) && !empty($arGroup['ITEMS'])):?>
                                <? $arSection = $arGroup['SECTION']; ?>
                                <div class="control-group__item js-scroll-spy-item">
                                    <a href="#faq-item-<?=$arSection['ID']?>" class="control-group__button js-scroll-spy-link">
                                        <?=$arSection['NAME']?>
                                    </a>
                                </div>
                            <?endif;?>
                        <?endforeach;?>
                    </div>
                </div>
                <div class="faq-section__form">
                    <div class="sidebar-form">
                        <div class="sidebar-form__fields">
                            Остались вопросы? <br>Свяжитесь с нами
                        </div>
                        <div class="sidebar-form__contacts">
                            <div class="sidebar-form__contact">
                                <a href="tel:+74959376932" class="sidebar-form__phone">
                                    <svg class="sidebar-form__icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20.487 17.14L16.422 13.444C16.2299 13.2693 15.9774 13.1762 15.7178 13.1842C15.4583 13.1922 15.212 13.3008 15.031 13.487L12.638 15.948C12.062 15.838 10.904 15.477 9.71204 14.288C8.52004 13.095 8.15904 11.934 8.05204 11.362L10.511 8.968C10.6974 8.78712 10.8062 8.54082 10.8142 8.2812C10.8222 8.02159 10.7289 7.76904 10.554 7.57699L6.85904 3.51299C6.68408 3.32035 6.44092 3.2035 6.18119 3.18725C5.92146 3.17101 5.66564 3.25665 5.46804 3.42599L3.29804 5.28699C3.12515 5.46051 3.02196 5.69145 3.00804 5.93599C2.99304 6.18599 2.70704 12.108 7.29904 16.702C11.305 20.707 16.323 21 17.705 21C17.907 21 18.031 20.994 18.064 20.992C18.3085 20.9783 18.5394 20.8747 18.712 20.701L20.572 18.53C20.742 18.333 20.8283 18.0774 20.8124 17.8177C20.7966 17.558 20.6798 17.3148 20.487 17.14Z"/>
                                    </svg>
                                    <span>+7 (495) 937-69-32</span>
                                </a>
                            </div>
                        </div>
                        <div class="sidebar-form__controls">
                            <div class="sidebar-form__control">
                                <a href="#askQuestion" data-popup="askQuestion" class="button">Написать нам</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>