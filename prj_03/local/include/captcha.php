<script>
    function initCaptcha() {
        console.log('recaptcha1');
        grecaptcha.ready(function () {
            console.log('recaptcha2');
            console.log(window.recaptchaCode);
            if(window.recaptchaCode) {
                console.log('recaptcha3');
                grecaptcha.execute(window.recaptchaCode, {action: 'homepage'}).then(function (token) {
                    console.log('recaptcha4');
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
    window.recaptchaCode = <?=CUtil::PhpToJSObject(Bitrix\Main\Config\Option::get("main", "recaptcha_code", RECAPTCHA_3_SITE_KEY))?>
</script>
<style>
    .grecaptcha-badge{
        display: none;
    }
</style>
<input type="hidden" name="recaptcha_response" class="recaptchaResponse">