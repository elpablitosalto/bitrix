<?
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2014 Bitrix
 */

/**
 * Bitrix vars
 * @param array $arParams
 * @param array $arResult
 * @param CBitrixComponentTemplate $this
 * @global CUser $USER
 * @global CMain $APPLICATION
 */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

if ($arResult["SHOW_SMS_FIELD"] == true) {
    CJSCore::Init('phone_auth');
}
$hiddenFields = !empty($arParams['HIDDEN_FIELDS']) ? $arParams['HIDDEN_FIELDS'] : [];

$backURL = !empty($_GET['actionurl']) ? $_GET['actionurl'] : '';
$backURLParam = $backURL !== '' ? '?actionurl='.$backURL : '';
?>

<?if($USER->IsAuthorized()):?>
<p><?echo GetMessage("MAIN_REGISTER_AUTH")?></p>
<?else:?>
    <?
        $errorList = [];
        if (count($arResult["ERRORS"]) > 0) {
            foreach ($arResult["ERRORS"] as $key => $error)
                if (intval($key) == 0 && $key !== 0)
                    $errorList[$key] = str_replace("#FIELD_NAME#", "&quot;".GetMessage("REGISTER_FIELD_".$key)."&quot;", $error);

            // ShowError(implode("<br />", $arResult["ERRORS"]));

        } elseif($arResult["USE_EMAIL_CONFIRMATION"] === "Y") {
            $errorList['EWBS'] = GetMessage("REGISTER_EMAIL_WILL_BE_SENT");
        }
    ?>

    <form method="post" action="<?= POST_FORM_ACTION_URI ?>" enctype="multipart/form-data" class="form form_type_centered <?=(count($errorList) ? 'form_messages_shown' : '')?>" id="formRegistration">
        <?=bitrix_sessid_post()?>
        <input type="hidden" name="register_submit_button" value="Y"/>

        <?if ($arResult["BACKURL"] <> ''):?>
            <input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>"/>
        <?endif?>

        <div class="form__messages">
        <div class="form__message"></div>
    </div>

        <div class="form__main">
            <div class="form__inputs">
                <?foreach ($arResult["SHOW_FIELDS"] as $FIELD):?>
                    <?
                        $type = 'text';
                        if($FIELD === 'EMAIL') $type = 'email';
                        if($FIELD === 'PASSWORD' || $FIELD === 'CONFIRM_PASSWORD') $type = 'password';

                        $name = 'REGISTER['.$FIELD.']';
                    ?>
                    <div class="form__line">
                        <!-- begin .form-control-->
                        <div class="form-control">
                            <?if(in_array($FIELD, $hiddenFields)):?>
                                <input
                                    type='hidden'
                                    name="<?=$name?>"
                                />
                            <?else:?>
                                <label class="form-control__holder">
                                    <span class="form-control__label">
                                        <?=GetMessage("REGISTER_FIELD_".$FIELD)?>:<?if ($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y"):?><span class="form-control__starrequired">*</span><?endif?>
                                    </span>
                                    <span class="form-control__field">
                                        <?if($FIELD === 'PHONE_NUMBER'):?>
                                            <input
                                                type="text"
                                                class="form-control__input js-phone-input <?=(!empty($errorList[$FIELD]) ? 'form-control__input_state_invalid' : '')?>"
                                                name="<?=$name?>"
                                                inputmode="text"
                                                <?=($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y") ? 'required' : ''?>
                                            />
                                        <?else:?>
                                            <input
                                                type="<?=$type?>"
                                                class="form-control__input <?=(!empty($errorList[$FIELD]) ? 'form-control__input_state_invalid' : '')?>"
                                                name="<?=$name?>"
                                                inputmode="text"
                                                <?=($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y") ? 'required' : ''?>
                                            />
                                        <?endif;?>
                                    </span>
                                    <span class="form-control__messages">
                                        <span <?=(!empty($errorList[$FIELD]) ? '' : 'style="display: none"')?> class="form-control__message form-control__message_style_error">
                                            <?=$errorList[$FIELD]?>
                                        </span>
                                    </span>
                                </label>
                            <?endif?>
                        </div>
                        <!-- end .form-control-->
                    </div>
                <?endforeach?>
            </div>

            <?
            /* CAPTCHA */
            if ($arResult["USE_CAPTCHA"] == "Y")
            {
                ?>
                    <div class="form__line">
                        <!-- begin .form-control-->
                        <div class="form-control">
                            <label class="form-control__holder">
                                <span class="form-control__label"><?=GetMessage("REGISTER_CAPTCHA_TITLE")?></span>
                                <div class="form-control__captcha">
                                    <img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" class="form-control__captcha-image" />
                                </div>
                                <span class="form-control__field">
                                    <input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
                                    <input type="text" name="captcha_word" maxlength="50" value="" autocomplete="off" class="form-control__input" />
                                </span>
                                <span class="form-control__messages">
                                    <span style="display: none" class="form-control__message form-control__message_style_error">
                                        Ошибка поля
                                    </span>
                                </span>
                            </label>
                        </div>
                        <!-- end .form-control-->
                    </div>
                <?
            }
            /* !CAPTCHA */
            ?>
            <div class="form__confirmation-check">
                <!-- begin .check-elem-->
                <label class="check-elem check-elem_text-size_s">
                    <input class="check-elem__input js-disabling-checkbox" type="checkbox" name="agreement" required="required">
                    <span class="check-elem__label">
                        Я даю согласие на обработку
                        <a class="link" href="<?=PERSONAL_DATA_LINK?>" target="_blank">
                            персональных данных
                        </a>
                    </span>
                </label>
                <!-- end .check-elem-->
            </div>
            <div class="form__controls">
                <div class="form__submit form__submit_width_l">
                    <!-- begin .button-->
                    <button class="button button_width_full button_size_s" type="submit" name="register_submit_button"
                            value="<?= GetMessage("AUTH_REGISTER") ?>">
                        <span class="button__holder">Зарегистрироваться</span>
                    </button>
                    <!-- end .button-->
                </div>
                <div class="form__note">
                    Уже есть аккаунт?
                    <a class="link" href="<?=AUTH_URL.$backURLParam?>">Войти</a>.
                </div>
            </div>
        </div>
        <div class="form__final">
            <div class="form__illustration">
                <img src="<?=SITE_TEMPLATE_PATH?>/mockup/dist/assets/blocks/form/images/check.svg" alt="Успех!" class="form__image" title="">
            </div>
            <div class="form__message-wrapper">
                <div class="form__title">
                    <!-- begin .title-->
                    <h3 class="title title_size_h4">Регистрация прошла успешно!</h3>
                    <!-- end .title-->
                </div>
                <div class="form__text">Пароль для входа был отправлен на ваш e-mail.</div>
                <div class="form__controls">
                    <div class="form__control">
                        <!-- begin .button-->
                        <a class="button button_width_full" href="<?=AUTH_URL.$backURLParam?>">
                            <span class="button__holder">Продолжить покупки</span>
                        </a>
                        <!-- end .button-->
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script>
        (function() {
            window.addEventListener('load', function () {
                ajaxRegisterForm('<?=$templateFolder?>/ajax.php', '<?=$arParams['SUCCESS_URL']?>');
            });
        })();
    </script>
<?endif?>
