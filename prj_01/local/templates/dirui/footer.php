<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<?
if (!defined('PAGE_TYPE')) {
    define('PAGE_TYPE', 1);
}
?>
<? if (PAGE_TYPE == 2 || PAGE_TYPE == 3) { ?>
    </section>
<? } ?>
<?
$APPLICATION->ShowViewContent('ADD_PAGE_CONTENT');
?>

<div class="popup popup__order js_popup_order"></div>

<? if ($GLOBALS['isPartner']) { ?>
    <div class="popup popup__order js_popup_order_send_success">
        Ваш заказ успешно отправлен.<br />
        Заказ продублирован на вашу почту <?= $GLOBALS['arUser']['EMAIL']; ?>.<br />
        Наш менеджер свяжется с вами и отправит счет на оплату.<br />
        <button class="popup_close js_popup_close_order_send_success" type="button"></button>
    </div>
<? } ?>

<div class="popup popup__order js_popup_offer_success">
    Ваша заявка успешно отправлена. В ближайшее время с вами свяжется наш менеджер для уточнения деталей
    <button class="popup_close js_popup_offer_success_close" type="button"></button>
</div>

<?/*?>
<div class="popup popup__order js_popup_del_account_success">
    Аккаунт успешно удалён.
    <button class="popup_close js_popup_del_account_success_close" type="button"></button>
</div>

<div class="popup popup__order js_popup_del_account_error">
    Не удалось удалить аккаунт.
    <button class="popup_close js_popup_del_account_error_close" type="button"></button>
</div>
<?*/ ?>

<div class="popup popup__video">
    <div class="local-video">
        <video preload="metadata" controls autoplay>
            <source src="/img/content/reagents/reagents.mp4" type="video/mp4">
        </video>
    </div>
    <div class="youtube-video">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/ik-k6Nr6-iI?si=if7QKFjUh6EqLggL" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
    </div>
    <button class="popup_close" type="button"></button>
</div>

<div class="popup popup-reagent js_popup_reagent">
    <div class="popup-reagent__title">
        <h2></h2>
    </div>
    <div class="popup-reagent__body">
        <div class="popup-reagent__wrapper">
            <div class="popup-reagent__description">
                <div class="popup-reagent__image"><img src="<?= SITE_TEMPLATE_PATH ?>/img/common/no_photo.png" alt=""></div>
                <div class="popup-reagent__characteristics">
                    <div class="popup-reagent__characteristics-list">
                        <?/*?>
                    <dl>
                        <dt>SAP №</dt>
                        <dd>3003096</dd>
                    </dl>
                    <dl>
                        <dt>Срок годности в закрытом виде</dt>
                        <dd>18 месяцев</dd>
                    </dl>
                    <dl>
                        <dt>Условия хранения</dt>
                        <dd>2-30℃</dd>
                    </dl>
                    <dl>
                        <dt>Срок годности после вскрытия</dt>
                        <dd>60</dd>
                    </dl>
                    <dl>
                        <dt>Спецификация</dt>
                        <dd>20 л</dd>
                    </dl>
                    <?*/ ?>
                    </div>
                    <div class="popup-reagent__add">
                        <button class="link-button_rose" type="button"></button>
                    </div>
                </div>
            </div>
            <div class="popup-reagent__documentation">
                <h3>Документы:</h3>
                <ul class="comparison__list">
                    <li class="comparison__item">
                        <a class="comparison__link" href="#" download>
                            <div class="recommendation__title"></div>
                            <div class="recommendation__file"></div>
                            <div class="recommendation__download">
                                <svg width="16" height="16">
                                    <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/icons/sprite/svg-sprite.svg#downward"></use>
                                </svg>
                            </div>
                        </a>
                    </li>
                    <li class="comparison__item">
                        <a class="comparison__link" href="#" download>
                            <div class="recommendation__title"></div>
                            <div class="recommendation__file"></div>
                            <div class="recommendation__download">
                                <svg width="16" height="16">
                                    <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/icons/sprite/svg-sprite.svg#downward"></use>
                                </svg>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="c-form--select">
                <select>
                    <option></option>
                    <option></option>
                    <option></option>
                </select>
            </div>
            <div class="popup-reagent__for">
                <h3></h3>
                <ul class="popup-reagent__list">
                    <li class="popup-reagent__item"><a href="#">
                            <div class="popup-reagent__picture"><img src="<?= SITE_TEMPLATE_PATH ?>/img/common/no_photo.png" alt=""></div>
                        </a></li>
                    <li class="popup-reagent__item"><a href="#">
                            <div class="popup-reagent__picture"><img src="<?= SITE_TEMPLATE_PATH ?>/img/common/no_photo.png" alt=""></div>
                        </a></li>
                    <li class="popup-reagent__item"><a href="#">
                            <div class="popup-reagent__picture"><img src="<?= SITE_TEMPLATE_PATH ?>/img/common/no_photo.png" alt=""></div>
                        </a></li>
                </ul>
            </div>
        </div>
    </div>
    <button class="popup_close"></button>
</div>

<div class="popup popup-authorization">
    <? $APPLICATION->IncludeComponent(
        "bitrix:system.auth.form",
        "popup",
        array(
            "REGISTER_URL" => "register.php",
            "FORGOT_PASSWORD_URL" => "",
            "PROFILE_URL" => "profile.php",
            "SHOW_ERRORS" => "Y"
        )
    ); ?>
    <button class="popup_close" type="button"></button>
</div>

</main>

<?/*?><footer class="footer" itemscope itemtype="https://schema.org/WPFooter"><?*/ ?>
<footer itemscope itemtype="https://schema.org/WPFooter">
    <div class="container">
        <div class="footer">
            <a class="footer__logo" href="/">
                <img src="<?= SITE_TEMPLATE_PATH ?>/img/favicons/logo.svg" alt="">
            </a>
            <div class="footer__info">
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/common/footer_contacts_phone.php"
                    )
                ); ?>
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/common/footer_contacts_email.php"
                    )
                ); ?>
                <a class="link-button_rose" href="/catalog/">Подобрать оборудование</a>
                <p>По будням с 9:00 до 18:00 по МСК</p>
                <div class="footer__middle">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "bottom",
                        array(
                            "ROOT_MENU_TYPE" => "bottom",
                            "MAX_LEVEL" => "1",
                            "CHILD_MENU_TYPE" => "",
                            "USE_EXT" => "Y",
                            "DELAY" => "N",
                            "ALLOW_MULTI_SELECT" => "N",
                            "MENU_CACHE_TYPE" => "N",
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "MENU_CACHE_GET_VARS" => ""
                        )
                    ); ?>
                </div>
            </div>
        </div>
        <div class="footer__main">
            <a href="/about/">О компании</a>
            <a href="/support_doc/">Поддержка и документация</a>
            <a href="/knowledge/">База знаний</a>
            <a href="/news/">Новости</a>
            <a href="/contacts/">Контакты</a>
            <a href="/contacts/#callback">Стать партнером</a>
        </div>
        <div class="footer__bottom"><span>ООО «Дируи Медикал» © 2023</span><a href="/politics/">Политика конфиденциальности</a><span>Разработано в <a target="_blank" href="https://indexis.ru/">Indexis</a></span></div>
    </div>
</footer>

<div class="overlay"></div>

</div>
</body>

</html>