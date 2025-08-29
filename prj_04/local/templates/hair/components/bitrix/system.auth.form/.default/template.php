<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $USER;
if($_GET['login'] == 'yes' || $USER->IsAuthorized())
    LocalRedirect("/personal/");
CJSCore::Init();
?>

<section class="content">
    <div class="container _inside-page">
        <div class="breadcrumbs">
            <ul class="breadcrumbs-list">
                <li class="breadcrumbs-list__item"><a href="#">Главная</a></li>
                <li class="breadcrumbs-list__item">Вход</li>
            </ul>
        </div>
        <div class="auth">
            <?
            if ($arResult['SHOW_ERRORS'] == 'Y' && $arResult['ERROR'])
                ShowMessage($arResult['ERROR_MESSAGE']);
            ?>
            <div class="form-wrapper auth-wrapper">
                <form id="authForm" name="system_auth_form<?=$arResult["RND"]?>" method="post" target="_top" data-ajax-url="/local/ajax/personal/backend.php" action="<?=$arResult["AUTH_URL"]?>">
                    <?if($arResult["BACKURL"] <> ''):?>
                        <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
                    <?endif?>
                    <?foreach ($arResult["POST"] as $key => $value):?>
                        <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
                    <?endforeach?>
                    <input type="hidden" name="AUTH_FORM" value="Y" />
                    <input type="hidden" name="TYPE" value="auth" />
                    <h1 class="form-title">Войти в личный кабинет</h1>
                    <div class="step">
                        <div class="form-wrapper__item">
                            <label>E-mail*</label>
                            <input type="email" name="USER_LOGIN" required/>
                            <span class="error">E-mail введен не корректно, используйте @</span>
                            <script>
                                BX.ready(function() {
                                    var loginCookie = BX.getCookie("<?=CUtil::JSEscape($arResult["~LOGIN_COOKIE_NAME"])?>");
                                    if (loginCookie)
                                    {
                                        var form = document.forms["system_auth_form<?=$arResult["RND"]?>"];
                                        var loginInput = form.elements["USER_LOGIN"];
                                        loginInput.value = loginCookie;
                                    }
                                });
                            </script>
                        </div>
                        <div class="form-wrapper__item">
                            <label>Пароль</label>
                            <input type="password" name="USER_PASSWORD" required/>
                            <span>E-mail введен не корректно, используйте @</span>
                        </div>
                        <div class="form-wrapper__item _text-right">
                            <a href="/personal/?forgot_password=yes" class="forgot-password">Забыли пароль?</a>
                        </div>
                    </div>
                    <div class="step">
                        <div class="form-wrapper__item _text-center">
                            <p>Нет аккаунта? <a href="/personal/register/">Пройдите регистрацию</a></p>
                        </div>
                        <div class="form-wrapper__item form-wrapper__item-checkbox">
                            <input id="suggestion" type="checkbox" name="suggestion" required>
                            <label for="suggestion">Нажимая на кнопку, вы соглашаетесь с <a href="#">условиями обработки персональных данных.</a></label>
                        </div>
                    </div>
                    <div class="step">
                        <p class="block-title">Войти с помощью социальных сетей</p>
                        <?
                        $APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "hair", 
                            array(
                                "AUTH_SERVICES"=>$arResult["AUTH_SERVICES"],
                                "SUFFIX"=>"form",
                            ), 
                            $component, 
                            array("HIDE_ICONS"=>"Y")
                        );
                        ?>
                    </div>
                    <div class="step">
                        <div class="form-wrapper__item _align-center">
                            <button type="submit" form="authForm" class="button _small">Вход</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>