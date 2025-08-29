<script>
    function initCaptcha() {
        grecaptcha.ready(function () {
            if(window.recaptchaCode) {
                grecaptcha.execute(window.recaptchaCode, {action: 'sendForm'}).then(function (token) {
                    var recaptchaResponseFields = document.getElementsByClassName('recaptchaResponse');
                    for (let index = 0; index < recaptchaResponseFields.length; index++) {
                        recaptchaResponseFields[index].value = token;
                    }
                });
            }
        });
    }
    $(document).ready(function(){
        initCaptcha();
        if(BX) {
            BX.addCustomEvent('onAjaxSuccess', function () {
                initCaptcha();
            });
        }

        $(document).on('captcha_has_expired', function() {
            initCaptcha();
        });

        setInterval(function() {
            initCaptcha();
        }, 100000);
    });
    window.recaptchaCode = <?=CUtil::PhpToJSObject(Bitrix\Main\Config\Option::get("main", "recaptcha_code", CAPTCHA_SITE_KEY))?>
</script>
<style>
    .grecaptcha-badge{
        display: none;
    }
</style>
<input type="hidden" name="recaptcha_response" class="recaptchaResponse">