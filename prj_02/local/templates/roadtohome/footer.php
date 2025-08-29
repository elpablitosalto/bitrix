<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
</main>
<footer id="footer" class="footer">
    <div class="footer__top">
        <div class="container">
            <div class="footer__inner">
                <div class="footer__item footer__item--logo"><a href="https://dorogakdomu.ru/" target="_self" class="footer__logo">
                        <picture><img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= SITE_TEMPLATE_PATH ?>/images/logo-full-white.svg" loading="lazy" alt="Дорога к дому" title="Дорога к дому" />
                        </picture>
                    </a></div>
                <div class="footer__item footer__item--partner-logo"><a href="https://severstal.com/rus/" target="_blank" class="footer__partner-logo">
                        <picture><img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= SITE_TEMPLATE_PATH ?>/images/partner-logo-white.svg" loading="lazy" alt="Северсталь" title="Северсталь" />
                        </picture>
                    </a></div>
            </div>
        </div>
    </div>
    <div class="footer__middle">
        <div class="container">
            <div class="footer__inner">
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
                <div class="text-size-lg footer__item footer__item--contacts">
                    <ul class="footer__contacts">
                        <li>Адрес: <span class="footer-contact-value">г. Череповец, ул. Менделеева, 3</span></li>
                        <li>Экстренная помощь: <span class="footer-contact-value"><a href="tel:88202288588"><u>8 (8202) 28-85-88</u></a></span>
                        </li>
                        <li>Информационный сектор: <span class="footer-contact-value"><a href="tel:88202448200"><u>8 (8202) 44-82-00</u></a></span>
                        </li>
                        <li>E-mail: <span class="footer-contact-value"><a href="mailto:info@dorogakdomu.ru"><u>info@dorogakdomu.ru</u></a></span>
                        </li>
                    </ul>
                </div>
                <div class="footer__item footer__item--help"><a href="/how_to_help/" class="btn btn-white footer__btn-help">Пожертвовать
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-heart">
                            <use xlink:href="#heart"></use>
                        </svg>
                    </a></div>
                <div class="text-size-lg footer__item footer__item--soc">
                    <div class="footer__soc">
                        <div class="title">Присоединяйтесь к нам в соцсетях:</div>
                        <ul class="soc-list">
                            <li><a href="https://www.youtube.com/user/dorogakdomu" target="_blank" title="Наш канал на Youtube">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-yt">
                                        <use xlink:href="#yt"></use>
                                    </svg>
                                </a></li>
                            <li><a href="https://vk.com/dorogakdomy" target="_blank" title="Наша группа ВКонтакте">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-vk">
                                        <use xlink:href="#vk"></use>
                                    </svg>
                                </a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer__bottom">
        <div class="container">
            <div class="footer__inner">
                <div class="footer__item footer__item--copyright text-size-sm">
                    <div class="footer__copyright">© Программа «Дорога к дому»</div>
                </div>
                <div class="footer__item footer__item--data-policy text-size-sm">
                    <div class="footer__data-policy"><a href="/docs/politika_v_otnoshenii_obrabotki_pd.pdf" target="_blank"><u>Политика обработки персональных данных</u></a></div>
                </div>
                <div class="footer__item footer__item--developer text-size-sm">
                    <div class="footer__developer">Разработано в <a target="_blank" href="https://indexis.ru/"><u>INDEXIS</u></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<? $APPLICATION->IncludeComponent(
    "bitrix:search.form",
    "modal",
    array(
        "URL_SEARCH" => "/search/",
        //"PAGE" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["search"],
    ),
    false
); ?>

<?
//echo " = ".SITE_TEMPLATE_PATH . "/include/common/counters.php"."<br />";
$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    array(
        "AREA_FILE_SHOW" => "file",
        "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/common/counters.php"
        //"PATH" => SITE_TEMPLATE_PATH . "/include/blocks/common/information_dissemination.php"
    )
); ?>

<? if (!isset($_COOKIE["cookie_agree"])) { ?>
    <?/*<div class="agree_cookie" style="display: block;">
        <div class="agree_cookie_container">
            <div class="agree_cookie_text">
                Настоящим, продолжая работу на сайте, я выражаю свое согласие Благотворительному фонду «Дорога к дому»
                (далее - Общество), на автоматизированную обработку, а также без использования средств автоматизации
                моих персональных данных (файлы cookie, сведения о действиях пользователя на сайте, сведения об
                оборудовании пользователя, дата и время сессии), в т.ч. с использованием метрических программ
                Яндекс.Метрика, Google Analytics, CloudPayments, с совершением действий: сбор, запись, систематизация,
                накопление, хранение, уточнение (обновление, изменение), извлечение, использование, обезличивание,
                блокирование, удаление, уничтожение, передача (предоставление, доступ) Партнерам Общества,
                предоставляющим сервис по указанным метрическим программам. Обработка персональных данных осуществляется
                в целях улучшения работы сайта, совершенствования продуктов и услуг Общества, определения предпочтений
                пользователя, предоставления целевой информации по продуктам и услугам Общества и Партнеров Общества.
                Настоящее согласие действует с момента его предоставления и в течение всего периода использования сайта.
                В случае отказа от обработки персональных данных метрическими программами я проинформирован о
                необходимости прекратить использование сайта или отключить файлы cookie в настройках браузера.
            </div>
            <span onclick="agree_cookies()" class="agree_cookie_button">Принять</span>
        </div>
    </div>*/ ?>
    <div class="agree_cookie" style="display: block;">
        <div class="container-fluid">
            <div class="agree_cookie_container">
                <div class="agree_cookie_text">
                    Благотворительный фонд «Дорога к дому» использует файлы «cookie» с целью персонализации сервисов и повышения удобства пользования веб-сайтом. Продолжая использовать наш сайт, вы даете согласие на обработку файлов cookie. Если вы не хотите использовать файлы «cookie», измените настройки браузера.
                </div>
                <div class="buttons-line">
                    <a href="/terms-cookies/" class="btn btn-transparent terms_cookie_link">Подробнее</a>
                    <button type="button" onclick="agree_cookies()" class="agree_cookie_button btn">Согласен</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function agree_cookies() {
            $(".agree_cookie").hide();
            var cookieDate = new Date(new Date().getTime() + 1000 * 3600 * 24 * 365 * 1000).toUTCString();
            document.cookie = "cookie_agree=y ; secure" + "; path=/; expires=" + cookieDate + ";";
        }
    </script>
<? } ?>

<script data-skip-moving="true">
    (function(w, d, u) {
        var s = d.createElement('script');
        s.async = true;
        s.src = u + '?' + (Date.now() / 60000 | 0);
        var h = d.getElementsByTagName('script')[0];
        h.parentNode.insertBefore(s, h);
    })(window, document, 'https://cdn-ru.bitrix24.ru/b10761230/crm/site_button/loader_3_7jki78.js');
</script>

</body>

</html>