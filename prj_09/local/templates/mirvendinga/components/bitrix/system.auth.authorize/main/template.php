<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
CJSCore::Init();
?>
<div class="page__auth-form">
    <!-- begin .section-->
    <div class="section section_spacing_top-close">
        <div class="section__header">
            <div class="section__container page__container">
                <div class="section__title">
                    <!-- begin .title-->
                    <h2 class="title title_size_h2 title_align_center"><?$APPLICATION->ShowTitle()?></h2>
                    <!-- end .title-->
                </div>
            </div>
        </div>
        <div class="section__content">
            <div class="page__container">
                <div class="section__auth-form">
                    <form name="system_auth_form<?= $arResult["RND"] ?>" method="post" target="_top" class="auth-form"
      action="<?= $arResult["AUTH_URL"] ?>">
    <?
    if ($arResult["BACKURL"] <> ''): ?>
        <input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>"/>
    <?endif ?>
    <?
    foreach ($arResult["POST"] as $key => $value): ?>
        <input type="hidden" name="<?= $key ?>" value="<?= $value ?>"/>
    <?endforeach ?>
    <input type="hidden" name="AUTH_FORM" value="Y"/>
    <input type="hidden" name="TYPE" value="AUTH"/>
    <?
    if ($arResult['SHOW_ERRORS'] == 'Y' && $arResult['ERROR'])
        ShowMessage($arResult['ERROR_MESSAGE']);
    ?>
    <div class="auth-form__inputs">
        <div class="auth-form__line">
            <!-- begin .form-control-->
            <!-- Modifiers-->
            <!-- form-control_state_invalid - red border, one of the two options to show invalid field-->
            <div class="form-control form-control_style_outline">
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
                            Ошибка поля "Логин"
                        </span>
                    </span>
                </label>
            </div>
            <!-- end .form-control-->
        </div>
        <div class="auth-form__line">
            <!-- begin .form-control-->
            <!-- Modifiers-->
            <!-- form-control_state_invalid - red border, one of the two options to show invalid field-->
            <div class="form-control form-control_style_outline">
                <label class="form-control__holder">
                    <span class="form-control__label">Пароль</span>
                    <span class="form-control__field">
                    <!-- Modifiers-->
                    <!-- form-control__input_state_invalid - red border, one of the two options to show invalid field-->
                        <input type="password" class="form-control__input" name="USER_PASSWORD" maxlength="255" required="required" autocomplete="off"/>
                    </span>
                    <span class="form-control__messages">
                        <span
                                style="display: none"
                                class="form-control__message form-control__message_style_error"
                        >
                            Ошибка поля "Пароль"
                        </span>
                    </span>
                </label>
            </div>
            <!-- end .form-control-->
        </div>
        <div class="auth-form__line">
            <!-- begin .form-control-->
            <? $APPLICATION->IncludeComponent("bitrix:main.include",
                "",
                Array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => SITE_TEMPLATE_PATH."/include/forms/personal_data.php",
                    "AREA_FILE_RECURSIVE" => "N",
                    "EDIT_MODE" => "html",
                ), false
            );
            ?>
            <!-- end .form-control-->
        </div>
    </div>
    <?
    if ($arResult["CAPTCHA_CODE"]): ?>
        <?
            $APPLICATION->IncludeComponent("bitrix:main.include", "", array(
                "AREA_FILE_SHOW" => "file",
                "PATH" => SITE_TEMPLATE_PATH."/include/forms/capcha.php",
                "AREA_FILE_RECURSIVE" => "N",
                "EDIT_MODE" => "html",
            ),
                false,
                array('HIDE_ICONS' => 'Y')
            );
        ?>
    <?endif ?>
    <div class="auth-form__controls">
        <div class="auth-form__control">
            <!-- begin .button-->
            <button class="button button_width_full" name="Login" type="submit">
                <span class="button__holder"><?= GetMessage("AUTH_LOGIN_BUTTON") ?></span>
            </button>
            <!-- end .button-->
        </div>
    </div>
    <?
    if ($arResult["NEW_USER_REGISTRATION"] == "Y"): ?>
        <div class="auth-form__note">
            У вас нет аккаунта?
            <a class="link" href="<?= $arResult["AUTH_REGISTER_URL"] ?>">Зарегистрируйтесь.</a>
        </div>
    <?endif ?>
    <?if ($arResult["AUTH_SERVICES"]): ?>
    <div class="auth-form__social">
        <div class="auth-form__subtitle">Или войдите через социальные сети:</div>
        <div class="auth-form__social-nav">
            <!-- begin .social-nav-->
            <div class="social-nav social-nav_type_fill social-nav_type_panel social-nav_align_center">
                <?
                $APPLICATION->IncludeComponent("bitrix:socserv.auth.form",
                    "main",
                    array(
                        "AUTH_SERVICES" => $arResult["AUTH_SERVICES"],
                        "SUFFIX" => "form",
                    ),
                    $component,
                    array("HIDE_ICONS" => "Y")
                );
                ?>
            </div>
            <!-- end .social-nav-->
        </div>
    </div>
    <?endif ?>
</form>
                </div>
            </div>
        </div>
    </div>
    <!-- end .section-->
</div>