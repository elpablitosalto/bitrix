<script>
    <? if (true) { ?>
        var recaptchaCode = '<?=CAPTCHA_SITE_KEY?>';

        var loadScripts = true;
        $(document).ready(function() {
            $(document).on({
                'scroll touchstart mouseenter click': function() {
                    if (loadScripts == true) {
                        $.getScript("<?= "https://www.google.com/recaptcha/api.js?render=" . Bitrix\Main\Config\Option::get("main", "recaptcha_code", CAPTCHA_SITE_KEY); ?>")
                            .done(function(script, textStatus) {
                                initCaptchaCustom();
                                //initCaptcha();
                                console.log(textStatus);
                                loadScripts = false;
                            })
                            .fail(function(jqxhr, settings, exception) {
                                console.log(exception);
                            });
                    }
                }
            });
        });

        function initCaptchaCustom() {
            grecaptcha.ready(function() {
                grecaptcha.execute('6LeiX3cfAAAAAAHbgfoOoQrQNZSgOawPhjUT9b0K', {
                <?/*?>grecaptcha.execute('<?=CAPTCHA_SITE_KEY?>', {<?*/?>
                    action: 'sendForm'
                }).then(function(token) {                    
                    var recaptchaResponse = document.getElementById('recaptchaResponse');
                    recaptchaResponse.value = token;
                });
            });
        }
    <? } else if (false) { ?>
        var loadScripts = true;
        $(document).ready(function() {
            $(document).on({
                'scroll touchstart mouseenter click': function() {
                    if (loadScripts == true) {
                        loadRecaptcha();
                    }
                }
            });

            $('.ask-question__button a[data-popup]').on({
                'click': function() {
                    //loadRecaptcha();
                    initCaptcha();
                    console.log('click');
                }
            });
        });

        function loadRecaptcha() {
            $.getScript("<?= "https://www.google.com/recaptcha/api.js?render=" . Bitrix\Main\Config\Option::get("main", "recaptcha_code", CAPTCHA_SITE_KEY); ?>")
                .done(function(script, textStatus) {
                    initCaptcha();
                    console.log(textStatus);
                    loadScripts = false;
                })
                .fail(function(jqxhr, settings, exception) {
                    console.log(exception);
                });
        }
    <? } else if (false) { ?>
        $(document).ready(function() {
            $.getScript("<?= "https://www.google.com/recaptcha/api.js?render=" . Bitrix\Main\Config\Option::get("main", "recaptcha_code", CAPTCHA_SITE_KEY); ?>")
                .done(function(script, textStatus) {
                    initCaptcha();
                    console.log(textStatus);
                })
                .fail(function(jqxhr, settings, exception) {
                    console.log(exception);
                });
        });
    <? } else if (false) { ?>
        $(document).ready(function() {
            initCaptcha();
        });
        window.recaptchaCode = <?= CUtil::PhpToJSObject(Bitrix\Main\Config\Option::get("main", "recaptcha_code", CAPTCHA_SITE_KEY)) ?>
    <? } ?>
</script>
<style>
    .grecaptcha-badge {
        display: none;
    }
</style>