<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if($arResult["PHONE_REGISTRATION"])
{
	CJSCore::Init('phone_auth');
}
?>
<section class="content">
    <div class="container _inside-page">
        <div class="auth">
            <div class="form-wrapper auth-wrapper">
                <?
                ShowMessage($arParams["~AUTH_RESULT"]);
                ?>
                <?if($arResult["SHOW_FORM"]):?>
                <form method="post" action="<?=$arResult["AUTH_URL"]?>" name="bform">
                    <?if ($arResult["BACKURL"] <> ''): ?>
                    <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
                    <? endif ?>
                    <input type="hidden" name="AUTH_FORM" value="Y">
                    <input type="hidden" name="TYPE" value="CHANGE_PWD">
                    <h1 class="form-title"><?=GetMessage("AUTH_CHANGE_PASSWORD")?></h1>
                    <div class="step">
                        <div class="form-wrapper__item" style="margin-bottom: 0px">
                        <?if($arResult["PHONE_REGISTRATION"]):?>
                            <p><?echo GetMessage("sys_auth_chpass_phone_number")?></p>
                        </div>
                        <div class="form-wrapper__item">
                            <input type="text" value="<?=htmlspecialcharsbx($arResult["USER_PHONE_NUMBER"])?>" disabled="disabled" />
                            <input type="hidden" name="USER_PHONE_NUMBER" value="<?=htmlspecialcharsbx($arResult["USER_PHONE_NUMBER"])?>" />
                        </div>
                        <div class="form-wrapper__item">
                            <label><span class="starrequired">*</span><?echo GetMessage("sys_auth_chpass_code")?></label>
                           <input type="text" name="USER_CHECKWORD" maxlength="50" value="<?=$arResult["USER_CHECKWORD"]?>" autocomplete="off" />
                        </div>
                        <?else:?>
                        <div class="form-wrapper__item">
                            <label><span class="starrequired">*</span><?=GetMessage("AUTH_LOGIN")?></label>
                             <input type="text" name="USER_LOGIN" maxlength="50" value="<?=$arResult["LAST_LOGIN"]?>"/>
                        </div>
                        <?
                            if($arResult["USE_PASSWORD"]):
                        ?>
                        <div class="form-wrapper__item">
                            <label><span class="starrequired">*</span><?echo GetMessage("sys_auth_changr_pass_current_pass")?></label>
                            <input type="password" name="USER_CURRENT_PASSWORD" maxlength="255" value="<?=$arResult["USER_CURRENT_PASSWORD"]?>" autocomplete="new-password" />
                        </div>
                        <?
                            else:
                        ?>
                        <div class="form-wrapper__item">
                            <label><span class="starrequired">*</span><?=GetMessage("AUTH_CHECKWORD")?></label>
                            <input type="text" name="USER_CHECKWORD" maxlength="50" value="<?=$arResult["USER_CHECKWORD"]?>" autocomplete="off" />
                        </div>
                        <?
                            endif
                        ?>
                    <?endif?>
                        <div class="form-wrapper__item">
                            <label><span class="starrequired">*</span><?=GetMessage("AUTH_NEW_PASSWORD_REQ")?></label>
                            <input type="password" name="USER_PASSWORD" maxlength="255" value="<?=$arResult["USER_PASSWORD"]?>" autocomplete="new-password" />
                            <?if($arResult["SECURE_AUTH"]):?>
                                <span class="bx-auth-secure" id="bx_auth_secure" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
                                    <div class="bx-auth-secure-icon"></div>
                                </span>
                                <noscript>
                                <span class="bx-auth-secure" title="<?echo GetMessage("AUTH_NONSECURE_NOTE")?>">
                                    <div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
                                </span>
                                </noscript>
                                <script type="text/javascript">
                                    document.getElementById('bx_auth_secure').style.display = 'inline-block';
                                </script>
                            <?endif?>
                        </div>
                        <div class="form-wrapper__item">
                            <label><span class="starrequired">*</span><?=GetMessage("AUTH_NEW_PASSWORD_CONFIRM")?></label>
                            <input type="password" name="USER_CONFIRM_PASSWORD" maxlength="255" value="<?=$arResult["USER_CONFIRM_PASSWORD"]?>" autocomplete="new-password" />
                        </div>
                        <?if($arResult["USE_CAPTCHA"]):?>
                            <div>
                                <input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
                                <img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
                            </div>
                            <label><span class="starrequired">*</span><?echo GetMessage("system_auth_captcha")?></label>
                            <div>
                                <input type="text" name="captcha_word" maxlength="50" value="" autocomplete="off" />
                            </div>
                        <?endif?>
                    </div>
                    <div class="step">
                        <div class="form-wrapper__item _align-center">
                            <button type="submit" name="change_pwd" value="<?=GetMessage("AUTH_CHANGE")?>" class="button _small">Изменить пароль</button>
                        </div>
                    </div>
                </form>
            </div>
            <p>
                <?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?>
            </p>
            <p>
                <span class="starrequired">*</span><?=GetMessage("AUTH_REQ")?>
            </p>
            <?if($arResult["PHONE_REGISTRATION"]):?>
            <div id="bx_chpass_error" style="display:none">
                <?ShowError("error")?>
            </div>
            <div id="bx_chpass_resend"></div>
            <?endif?>
            <?endif?>
            <p>
                <a href="/personal/auth/"><b><?=GetMessage("AUTH_AUTH")?></b></a>
            </p>
        </div>
    </div>
</section>

<script type="text/javascript">
    new BX.PhoneAuth({
        containerId: 'bx_chpass_resend',
        errorContainerId: 'bx_chpass_error',
        interval: <?=$arResult["PHONE_CODE_RESEND_INTERVAL"]?>,
        data:
            <?=CUtil::PhpToJSObject([
                'signedData' => $arResult["SIGNED_DATA"]
            ])?>,
        onError:
            function(response)
            {
                var errorDiv = BX('bx_chpass_error');
                var errorNode = BX.findChildByClassName(errorDiv, 'errortext');
                errorNode.innerHTML = '';
                for(var i = 0; i < response.errors.length; i++)
                {
                    errorNode.innerHTML = errorNode.innerHTML + BX.util.htmlspecialchars(response.errors[i].message) + '<br>';
                }
                errorDiv.style.display = '';
            }
    });
</script>