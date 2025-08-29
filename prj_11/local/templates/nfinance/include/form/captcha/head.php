<script>
    function initCaptcha() {
        grecaptcha.ready(function () {
            if(window.recaptchaCode) {
                grecaptcha.execute(window.recaptchaCode, {action: 'sendForm'}).then(function (token) {
                    var recaptchaResponseFields = document.getElementsByClassName('recaptcha-response');
                    for (let index = 0; index < recaptchaResponseFields.length; index++) {
                        recaptchaResponseFields[index].value = token;
                    }
                });
            }
        });
    }

    function init() {
        initCaptcha();

        if(BX) {
            BX.addCustomEvent('onAjaxSuccess', function () {
                initCaptcha(); // Обновляем после каждого запроса
            });
        }

        setInterval(function() {
            initCaptcha(); // Обновляем по времени
        }, 100000);

        document.addEventListener('recaptchaReloadEvent', function () {
            initCaptcha(); // Обновляем после каждого запроса
        });
    }

    document.addEventListener("DOMContentLoaded", function() {
        document.body.addEventListener('click', function () {
            if (typeof grecaptcha !== 'undefined') {
                init();
            } else if (window.resourceLoader) {
                document.body.addEventListener('recaptcha-js-load', function () {
                    init();
                });

                window.resourceLoader.load('recaptcha');
            }
        });
    });
    window.recaptchaCode = <?=CUtil::PhpToJSObject(Bitrix\Main\Config\Option::get("main", "recaptcha_code", CAPTCHA_SITE_KEY))?>
</script>
<style>
    .grecaptcha-badge {
        display: none;
    }
</style>