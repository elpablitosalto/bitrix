<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

CJSCore::Init(array('popup', 'window'));
?>

<? if ($arResult["FORM_TYPE"] == "login") : ?>


    <form name="system_auth_form<?= $arResult["RND"] ?>" method="post" class="dp-form dp-form-auth" id="form-auth" action="<?= $arResult["AUTH_URL"] ?>">
        <? if ($arResult["BACKURL"] <> '') : ?>
            <input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>" />
        <? endif ?>
        <? foreach ($arResult["POST"] as $key => $value) : ?>
            <input type="hidden" name="<?= $key ?>" value="<?= $value ?>" />
        <? endforeach ?>
        <input type="hidden" name="AUTH_FORM" value="Y" />
        <input type="hidden" name="TYPE" value="AUTH" />
        <div class="dp-form__body">
            <div class="dp-field dp-form-auth-field-email">
                <div class="dp-field-editable">
                    <input type="email" name="USER_LOGIN" placeholder="E-mail" value="<?= htmlspecialcharsbx($_REQUEST["USER_LOGIN"]) ?>" required>
                    <button class="dp-field-editable__btn" type="button">Изменить e-mail</button>
                </div>
            </div>
            <div class="dp-field dp-form-auth-field-password">
                <input type="password" name="USER_PASSWORD" placeholder="Пароль" required>
            </div>
            <div class="dp-field dp-form-auth-field-remember">
                <input id="dpfa-remember" type="checkbox" name="remember">
                <label for="dpfa-remember">Запомнить меня на этом устройстве</label>
            </div>
        </div>
        <div class="dp-form__footer">
            <div class="dp-form__actions">
                <button class="dp-btn dp-btn_orange dp-form__next" type="button">Далее</button>
                <button class="dp-btn dp-btn_orange dp-form__submit" type="submit">Войти</button>
            </div>
            <div class="dp-modal-sign-forgott-link"><a href="/auth/?forgot_password=yes">Забыли пароль?</a></div>
        </div>
        <?
        if ($arResult['SHOW_ERRORS'] === 'Y' && $arResult['ERROR'] && !empty($arResult['ERROR_MESSAGE']) && $_REQUEST["AUTH_FORM"] == "Y") {
        ?>

            <div class="auth-errors">
                <?
                ShowMessage($arResult['ERROR_MESSAGE']);
                ?>
            </div>
            <script>
                var $formAuth = $('#form-auth');
                var $nextBtn = $formAuth.find('.dp-form__next');
                var $submitBtn = $formAuth.find('.dp-form__submit');
                var $emailField = $formAuth.find('.dp-form-auth-field-email');
                var $emailFieldInput = $emailField.find('input');
                var $emailFieldEditBtn = $emailField.find('.dp-field-editable__btn');
                var $passwordField = $formAuth.find('.dp-form-auth-field-password');
                var $rememberField = $formAuth.find('.dp-form-auth-field-remember');
                $emailFieldInput.attr('disabled', 'disabled');
                $nextBtn.hide();
                $passwordField.show();
                $rememberField.show();
                $submitBtn.show();
                $submitBtn.on('click', function(e) {
                    var $form = $(this).closest('form');
                    if (!validateForm($form[0], true)) {
                        e.preventDefault();
                    } else {
                        $emailFieldInput.removeAttr('disabled');
                        ym(88122786, 'reachGoal', 'authorization-site-LK');
                        console.log('authorization-site-LK');
                        if ($('#js_buy_link').attr('data-go-link') == 'Y') {
                            window.open($('#js_buy_link').val(), '_blank').focus();
                        }
                    }
                });
                $emailFieldEditBtn.on('click', function() {
                    $emailFieldInput.removeAttr('disabled');
                });
            </script>
        <?
        }
        ?>
    </form>

    <? if ($arResult["AUTH_SERVICES"]) : ?>
        <?
        $APPLICATION->IncludeComponent(
            "bitrix:socserv.auth.form",
            "flat",
            array(
                "AUTH_SERVICES" => $arResult["AUTH_SERVICES"],
                "CURRENT_SERVICE" => $arResult["CURRENT_SERVICE"],
                "AUTH_URL" => $arResult["AUTH_URL"],
                "POST" => $arResult["POST"],
                "SHOW_TITLES" => $arResult["FOR_INTRANET"] ? 'N' : 'Y',
                "FOR_SPLIT" => $arResult["FOR_INTRANET"] ? 'Y' : 'N',
                "AUTH_LINE" => $arResult["FOR_INTRANET"] ? 'N' : 'Y',
            ),
            $component,
            array("HIDE_ICONS" => "Y")
        );
        ?>
    <? endif ?>


<?
else :

?>
    <div class="auth-errors">Вы успешно авторизованы!</div>
    <script>
        window.location.href = "<?= $arResult["BACKURL"] ?>";
    </script>

<? endif ?>