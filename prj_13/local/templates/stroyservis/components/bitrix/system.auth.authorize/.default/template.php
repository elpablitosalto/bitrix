<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

// ShowMessage($arParams["~AUTH_RESULT"]);
// ShowMessage($arResult['ERROR_MESSAGE']);
?>

<form name="form_auth" method="post" action="<?=SITE_DIR?>" class="popup-authorization__form">
    <input type="hidden" name="AUTH_FORM" value="Y" />
    <input type="hidden" name="TYPE" value="AUTH" />

    <?if (strlen($arResult["BACKURL"]) > 0):?>
        <input type="hidden" name="backurl" data-value="<?=$arResult["BACKURL"]?>" value="<?=$arResult["BACKURL"]?>" />
    <?endif?>

    <?foreach ($arResult["POST"] as $key => $value):?>
        <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
    <?endforeach?>

    <div class="popup-authorization__form-wrapper">
        <p class="popup-authorization__title">Вход</p>
        <p>Нет аккаунта? <a class="popup-authorization__link-create header__registration" href="#">Создать</a>
        </p>
    </div>
    <div class="form__input">
        <label class="visually-hidden" for="login__email">E-mail</label>
        <input class="order__input" id="login__email" type="text" placeholder="Email*" name="USER_LOGIN" value="<?=$arResult["LAST_LOGIN"]?>">
    </div>
    <div class="form__input">
        <label class="visually-hidden" for="login__password">Пароль</label>
        <input class="order__input" id="login__password" type="password" placeholder="Пароль*" name="USER_PASSWORD">
    </div>
    <a class="popup-authorization__link-forgot" href="<?=SITE_DIR?>auth/?forgot_password=yes">Забыли пароль?</a>
    <button class="button-orange" type="submit" name="Login">
        <span class="btn-text">Войти</span>
    </button>
</form>