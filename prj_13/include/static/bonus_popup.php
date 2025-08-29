<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

global $USER;
?>

<div class="popup order-bonus">
    <h2>Получайте стройбонусы</h2>
    <p>Чтобы получить бонусы нужно:</p>
    <ol class="order-bonus__list">
        <li>Зарегистрируйтесь на сайте;</li>
        <li>Оформите заказ товара по розничным ценам;</li>
        <li>Оплатить заказ;</li>
        <li>Следите за поступлением стройбонусов в личном кабинете!</li>
    </ol>
    <?if ($USER->IsAuthorized()):?>
        <a target="_blank" class="button-orange" href="<?=SITE_DIR?>personal/bonuses/">Узнать количество бонусов</a>
    <?else:?>
        <a class="button-orange order-bonus-registration" href="#">Зарегистрироваться</a>
    <?endif;?>
    <button class="popup-form__popup_close"></button>
</div>