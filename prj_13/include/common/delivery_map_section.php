<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Page\Asset;
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/mapDeliveryCalc.js");
?>
<section class="delivery-map-section">
    <div class="delivery-map-calculator">
        <p class="delivery-map-calculator__title">Рассчитать стоимость</p>
        <div class="delivery-map-calculator-section">
            <p class="delivery-map-calculator-section__title">Адрес доставки</p>
            <form class="delivery-map-calculator-search" id="delivery-map-calculator-search">
                <input class="delivery-map-calculator-search__input" id="delivery-address" type="text" placeholder="Введите адрес">
                <button class="delivery-map-calculator-search__submit" type="button">
                    <svg width="19" height="19">
                        <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons/sprite/svg-sprite.svg#search"></use>
                    </svg>
                </button>
            </form>
        </div>
        <div id="delivery-map-calculator"></div>
    </div>
    <div class="delivery-map" id="delivery-map"></div>
</section>
