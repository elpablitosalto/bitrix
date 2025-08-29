<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<section class="content">
    <div class="container _inside-page">
        <div class="auth">
            <div class="form-wrapper auth-wrapper">
                <div class="alert-result"><?ShowMessage($arParams["~AUTH_RESULT"]);?></div>
                <form name="bform" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
                    <?
                    if ($arResult["BACKURL"] <> '')
                    {
                        ?>
                        <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
                        <?
                    }
                    ?>
                    <input type="hidden" name="AUTH_FORM" value="Y">
                    <input type="hidden" name="TYPE" value="SEND_PWD">
                    <h1 class="form-title">Восстановление пароля</h1>
                    <div class="step">
                        <div class="form-wrapper__item" style="margin-bottom: 0px">
                            <p><?echo GetMessage("sys_forgot_pass_label")?></p>
                        </div>
                        <div class="form-wrapper__item">
                            <label><?=GetMessage("sys_forgot_pass_login1")?></label>
                            <input type="text" name="USER_LOGIN" value="<?=$arResult["USER_LOGIN"]?>" />
                            <input type="hidden" name="USER_EMAIL" />
                            <div class="form-wrapper__item_forgotpass">
                                <?echo GetMessage("sys_forgot_pass_note_email")?>
                            </div>
                        </div>
                        <div class="form-wrapper__item">
                            <?if($arResult["PHONE_REGISTRATION"]):?>
                            <label><?=GetMessage("sys_forgot_pass_phone")?></label>
                            <input type="text" name="USER_PHONE_NUMBER" value="<?=$arResult["USER_PHONE_NUMBER"]?>" />
                            <div class="form-wrapper__item_forgotpass">
                                <?echo GetMessage("sys_forgot_pass_note_phone")?>
                            </div>
                            <?endif;?>
                        </div>
                        <div class="form-wrapper__item">
                            <?if($arResult["USE_CAPTCHA"]):?>
                                <div>
                                    <input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
                                    <img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
                                </div>
                                <div class="form-wrapper__item_forgotpass">
                                    <?echo GetMessage("system_auth_captcha")?>
                                </div>
                                <div>
                                    <input type="text" name="captcha_word" maxlength="50" value="" />
                                </div>
                            <?endif?>
                        </div>
                    </div>
                    <div class="step">
                        <div class="form-wrapper__item _align-center">
                            <button type="submit" name="send_account_info" value="<?=GetMessage("AUTH_SEND")?>" class="button _small">Выслать</button>
                        </div>
                        <div class="form-wrapper__item _text-center">
                            <p><a href="/personal/auth/"><b><?=GetMessage("AUTH_AUTH")?></b></a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
document.bform.onsubmit = function(){document.bform.USER_EMAIL.value = document.bform.USER_LOGIN.value;};
document.bform.USER_LOGIN.focus();
</script>
