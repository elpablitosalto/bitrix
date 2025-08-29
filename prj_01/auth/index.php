<?
define('PAGE_TYPE', 4);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Авторизация");
$APPLICATION->SetPageProperty("PAGE_BODY_CLASS", 'dp-page-authorization');
?>

<section class="authorization">
    <? $APPLICATION->IncludeComponent(
        "bitrix:system.auth.form",
        "popup",
        array(
            "REGISTER_URL" => "register.php",
            "FORGOT_PASSWORD_URL" => "",
            "PROFILE_URL" => "profile.php",
            "SHOW_ERRORS" => "Y",
            "CHECK_AUTH" => "Y",
        )
    ); ?>

    <?/*?>
    <form class="authorization-form">
        <div class="authorization-form__wrapper">
            <h2>Войти</h2>
            <div class="registration-form__group-item">
                <label class="registration-label">
                    <input class="registration-input" type="text" name="login" placeholder="Логин">
                </label>
            </div>
            <div class="registration-form__group-item">
                <label class="registration-label">
                    <input class="registration-input" type="password" name="password" placeholder="Пароль" required><span class="registration-form__show-password">
                        <svg width="22" height="16">
                            <use xlink:href="/img/icons/sprite/svg-sprite.svg#eye"></use>
                        </svg></span><span class="registration-form__hide-password display-none">
                        <svg width="22" height="16">
                            <use xlink:href="/img/icons/sprite/svg-sprite.svg#eye2"></use>
                        </svg></span>
                </label>
            </div>
            <button class="link-button_rose" type="submit">Войти</button>
            <div class="authorization-buttons__wrapper"><a class="link-button_grey" href="/registration.html">Зарегистрироваться</a><a class="link-button_grey" href="/partners-reg.html">Стать партнером</a></div>
        </div>
    </form>
    <?*/?>
</section>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>