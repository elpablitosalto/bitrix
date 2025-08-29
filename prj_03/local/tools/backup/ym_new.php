<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function() {
        'use strict';

        // Флаг, что Метрика уже загрузилась.
        var loadedMetrica = false,
            // Ваш идентификатор сайта в Яндекс.Метрика.
            metricaId = 36139370,
            // Переменная для хранения таймера.
            timerId;

        // Для бота Яндекса грузим Метрику сразу без "отложки",
        // чтобы в панели Метрики были зелёные кружочки
        // при проверке корректности установки счётчика.
        if (navigator.userAgent.indexOf('YandexMetrika') > -1) {
            loadMetrica();
        } else {
            // Подключаем Метрику, если юзер начал скроллить.
            window.addEventListener('scroll', loadMetrica, {
                passive: true
            });

            // Подключаем Метрику, если юзер коснулся экрана.
            window.addEventListener('touchstart', loadMetrica);

            // Подключаем Метрику, если юзер дернул мышкой.
            document.addEventListener('mouseenter', loadMetrica);

            // Подключаем Метрику, если юзер кликнул мышкой.
            document.addEventListener('click', loadMetrica);

            // Подключаем Метрику при полной загрузке DOM дерева,
            // с "отложкой" в 1 секунду через setTimeout,
            // если пользователь ничего вообще не делал (фоллбэк).
            //document.addEventListener('DOMContentLoaded', loadFallback);
        }

        function loadFallback() {
            timerId = setTimeout(loadMetrica, 1000);
        }

        function loadMetrica(e) {

            // Пишем отладку в консоль браузера.
            if (e && e.type) {
                console.log(e.type);
            } else {
                console.log('DOMContentLoaded');
            }

            // Если флаг загрузки Метрики отмечен,
            // то ничего более не делаем.
            if (loadedMetrica) {
                return;
            }

            // Код метрики -->
            (function(m, e, t, r, i, k, a) {
                m[i] = m[i] || function() {
                    (m[i].a = m[i].a || []).push(arguments)
                };
                m[i].l = 1 * new Date();
                for (var j = 0; j < document.scripts.length; j++) {
                    if (document.scripts[j].src === r) {
                        return;
                    }
                }
                k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
            })(window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");
            ym(36139370, "init", {
                clickmap: true,
                trackLinks: true,
                accurateTrackBounce: true,
                webvisor: true,
                ecommerce: "dataLayer"
            });
            console.log('Yandex.Metrica has loaded');
            // <-- Код метрики

            // Отмечаем флаг, что Метрика загрузилась,
            // чтобы не загружать её повторно при других
            // событиях пользователя и старте фоллбэка.
            loadedMetrica = true;

            // Очищаем таймер, чтобы избежать лишних утечек памяти.
            clearTimeout(timerId);

            // Отключаем всех наших слушателей от всех событий,
            // чтобы избежать утечек памяти.
            window.removeEventListener('scroll', loadMetrica);
            window.removeEventListener('touchstart', loadMetrica);
            document.removeEventListener('mouseenter', loadMetrica);
            document.removeEventListener('click', loadMetrica);
            document.removeEventListener('DOMContentLoaded', loadFallback);
        }
    })()
</script>

<noscript>
    <div><img src="https://mc.yandex.ru/watch/36139370" style="position:absolute; left:-9999px;" alt="" /></div>
</noscript> <!-- /Yandex.Metrika counter -->