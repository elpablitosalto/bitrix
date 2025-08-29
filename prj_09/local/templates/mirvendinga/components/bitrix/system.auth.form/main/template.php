<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
CJSCore::Init();

$backURL = !empty($_GET['actionurl']) ? $_GET['actionurl'] : '';
$backURLParam = $backURL !== '' ? '?actionurl='.$backURL : '';
$actionURL = $backURL ?: $arResult["AUTH_URL"];
?>
<!-- begin .form-->
<form id="loginForm" name="system_auth_form<?= $arResult["RND"] ?>" method="post" target="_top" class="form form_type_centered <?php if($arResult['ERROR']): ?>form_messages_shown<?php endif;?>" action="<?//= $actionURL ?>">
    <!-- messages can be placed before or after the form-->
    <!-- Modifiers-->
    <?php if($arResult['ERROR']): ?>
        <div class="form__messages">
            <div class="form__message form__message_style_error">
                <?php ShowMessage($arResult['ERROR_MESSAGE']); ?>
            </div>
        </div>
    <?php endif; ?>
    <div class="form__main">
        <?if ($arResult["BACKURL"] <> ''): ?>
            <input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>" />
        <?endif ?>
        <?foreach ($arResult["POST"] as $key => $value): ?>
            <input type="hidden" name="<?= $key ?>" value="<?= $value ?>" />
        <?endforeach?>
        <input type="hidden" name="AUTH_FORM" value="Y" />
        <input type="hidden" name="TYPE" value="AUTH" />
        <div class="form__inputs">
            <div class="form__line">
                <!-- begin .form-control-->
                <div class="form-control">
                    <label class="form-control__holder">
                        <span class="form-control__label">Логин</span>
                        <span class="form-control__field">
                            <!-- Modifiers-->
                            <!-- form-control__input_state_invalid - red border, one of the two options to show invalid field-->
                            <input
                                type="text"
                                name="USER_LOGIN"
                                class="form-control__input"
                                maxlength="50"
                                value=""
                                placeholder="Введите логин"
                                required="required"
                            />
                            <script>
                                BX.ready(function () {
                                    var loginCookie = BX.getCookie("<?=CUtil::JSEscape($arResult["~LOGIN_COOKIE_NAME"])?>");
                                    if (loginCookie) {
                                        var form = document.forms["system_auth_form<?=$arResult["RND"]?>"];
                                        var loginInput = form.elements["USER_LOGIN"];
                                        loginInput.value = loginCookie;
                                    }
                                });
                            </script>
                        </span>
                        <span class="form-control__messages">
                            <span
                                style="display: none"
                                class="form-control__message form-control__message_style_error"
                            >
                                Ошибка поля
                            </span>
                        </span>
                    </label>
                </div>
                <!-- end .form-control-->
            </div>
            <div class="form__line">
                <!-- begin .form-control-->
                <div class="form-control">
                    <label class="form-control__holder">
                        <span class="form-control__label">Пароль</span>
                        <span class="form-control__field">
                            <!-- Modifiers-->
                            <input type="password" class="form-control__input" name="USER_PASSWORD" maxlength="255" required="required" autocomplete="off"/>
                            <button
                                type="button"
                                class="form-control__trigger form-control__trigger_type_password js-show-password"
                            >
                                Показать / скрыть пароль
                            </button>
                        </span>
                        <span class="form-control__links">
                            <!-- begin .link-->
                            <a class="link" href="<?=PASSWORD_RECOVERY_URL.$backURLParam?>">
                                Забыли пароль?
                            </a>
                            <!-- end .link-->
                        </span>
                        <span class="form-control__messages">
                            <span
                                style="display: none"
                                class="form-control__message form-control__message_style_error"
                            >
                                Ошибка поля
                            </span>
                        </span>
                    </label>
                </div>
                <!-- end .form-control-->
            </div>
        </div>
        <div class="form__controls">
            <div class="form__submit form__submit_width_s">
                <!-- begin .button-->
                <button class="button button_width_full button_size_s" name="Login" type="submit">
                    <span class="button__holder">Войти</span>
                </button>
                <!-- end .button-->
            </div>
            <?if($arResult["NEW_USER_REGISTRATION"] == 'Y'):?>
                <div class="form__note">
                    У вас нет аккаунта?
                    <a class="link" href="<?= $arResult["AUTH_REGISTER_URL"].'&actionurl='.$actionURL ?>">Зарегистрируйтесь.</a>
                </div>
            <?endif?>
        </div>
    </div>
</form>
<!-- end .form-->