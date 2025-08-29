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

?>

<? if ($USER->IsAuthorized()) :
?>
    <p class="auth-errors"><? echo GetMessage("MAIN_REGISTER_AUTH") ?></p>
    <script>
        <?/*?>
        <?if($_REQUEST["REGISTER"]["UF_REG_POINT"] == "Кнопка [Получить подборку] блок [Вебинары и курсы для врачей] на главной странице"){?>
            ym(88122786,'reachGoal','form-registrationLK-poluchit-podborku');
            console.log('form-registrationLK-poluchit-podborku');
        <?}?>
        <?*/ ?>
        ym(88122786, 'reachGoal', 'form-registrationLK');
        console.log('form-registrationLK');
        if ($('#js_buy_link').attr('data-go-link') == 'Y') {
            window.open($('#js_buy_link').val(), '_blank').focus();
        } else {  
        }
        window.location.href = "<?= $arResult["BACKURL"] ?>";
    </script>

<? else : ?>


    <form class="dp-form dp-form-registration" id="form-registration" method="post" action="<?= POST_FORM_ACTION_URI ?>" name="regform" enctype="multipart/form-data">
        <?/*?>
        <input type="hidden" id="js_country_phone_code" name="country_phone_code" value="" />
        <?*/?>
        <?
        if ($arResult["BACKURL"] <> '') :
        ?>
            <input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>" />
        <?
        endif;
        ?>
        <?
        // костыль для main.register, который обязательно требует поле логина
        ?>
        <input type="hidden" name="REGISTER[LOGIN]" value="<?= ($arResult["VALUES"]["EMAIL"]) ? $arResult["VALUES"]["EMAIL"] : "----"; ?>" />
        <?
        if (!empty($arResult["ERRORS"])) {
            foreach ($arResult["ERRORS"] as $key => $error)
                if (intval($key) == 0 && $key !== 0)
                    $arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "&quot;" . GetMessage("REGISTER_FIELD_" . $key) . "&quot;", $error);
            if (isset($arResult["ERRORS"]["UF_AGREEMENT"])) {
                $arResult["ERRORS"]["UF_AGREEMENT"] = "Необходимо согласие на обработку персональных данных";
            }
            //if(isset($arResult["ERRORS"]["LOGIN"])){
            //unset($arResult["ERRORS"]["LOGIN"]);
            //}
        }
        ?>
        <input class="dp-mb-called-place" name="REGISTER[UF_REG_POINT]" type="hidden" value="<?= htmlspecialcharsbx($_REQUEST["REGISTER"]["UF_REG_POINT"]) ?>">
        <div class="dp-form__body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="dp-field">
                        <input <? if (isset($arResult["ERRORS"]["NAME"])) { ?>class="nb-input-error" <? } ?> type="text" name="REGISTER[NAME]" placeholder="Имя" value="<?= $arResult["VALUES"]["NAME"] ?>" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="dp-field">
                        <input <? if (isset($arResult["ERRORS"]["LAST_NAME"])) { ?>class="nb-input-error" <? } ?> type="text" name="REGISTER[LAST_NAME]" placeholder="Фамилия" value="<?= $arResult["VALUES"]["LAST_NAME"] ?>" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="dp-field">
                        <input <? if (isset($arResult["ERRORS"]["EMAIL"])) { ?>class="nb-input-error" <? } ?> type="email" name="REGISTER[EMAIL]" placeholder="E-mail" value="<?= $arResult["VALUES"]["EMAIL"] ?>" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="dp-field js_phone_mask_container" id="js_phone_country_container">
                        <input class="iti-input js_phone_country <?/*?>js-phone js-iti-input<?*/ ?><? if (isset($arResult["ERRORS"]["PERSONAL_PHONE"])) { ?> nb-input-error<? } ?>" type="text" name="REGISTER[PERSONAL_PHONE]" placeholder="Номер телефона" value="<?= $arResult["VALUES"]["PERSONAL_PHONE"] ?>">
                        <div class="dp-field-tooltip">
                            <button class="dp-field-tooltip__btn" type="button">
                                <svg class="icon icon-tooltip ">
                                    <use xlink:href="#tooltip"></use>
                                </svg>
                            </button>
                            <div class="dp-field-tooltip__desc">Введите номер телефона, если вы хотите получать персональные уведомления о&nbsp;ближайших мероприятиях</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="dp-field">
                        <select class="dp-form-select" name="REGISTER[UF_SPECIALITY]" required>
                            <?
                            $i = 0;
                            foreach ($arResult["SPECIALITY"] as $speciality) {
                            ?>
                                <option value="<?= $speciality["ID"] ?>" <? if ($i === 0) echo " selected"; ?>><?= $speciality["VALUE"] ?></option>
                            <?
                                $i++;
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="dp-field dp-field-password">
                        <input <? if (isset($arResult["ERRORS"]["PASSWORD"])) { ?>class="nb-input-error" <? } ?> type="password" name="REGISTER[PASSWORD]" placeholder="Пароль" required>
                        <button class="dp-field-password-toggle-btn" type="button">
                            <svg class="icon icon-eye ">
                                <use xlink:href="#eye"></use>
                            </svg>
                            <svg class="icon icon-eye-hidden ">
                                <use xlink:href="#eye-hidden"></use>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="dp-field dp-field-password">
                        <input <? if (isset($arResult["ERRORS"]["CONFIRM_PASSWORD"])) { ?>class="nb-input-error" <? } ?> type="password" name="REGISTER[CONFIRM_PASSWORD]" placeholder="Повторите пароль" required>
                        <button class="dp-field-password-toggle-btn" type="button">
                            <svg class="icon icon-eye ">
                                <use xlink:href="#eye"></use>
                            </svg>
                            <svg class="icon icon-eye-hidden ">
                                <use xlink:href="#eye-hidden"></use>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="dp-field dp-form-auth-field-agreement">
                        <input id="dpfr-agreement" type="checkbox" name="REGISTER[UF_AGREEMENT]" value="Y" <? if (isset($arResult["VALUES"]["UF_AGREEMENT"]) && mb_strlen($arResult["VALUES"]["UF_AGREEMENT"])) echo " checked"; ?>>
                        <label for="dpfr-agreement">Даю согласие на обработку персональных данных</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="dp-form__footer">
            <div class="dp-form__actions">
                <button class="dp-btn dp-btn_orange dp-form__submit" type="submit">Завершить регистрацию
                </button>
                <input type="hidden" name="register_submit_button" value="<?= GetMessage("AUTH_REGISTER") ?>">
            </div>
            <? if (!empty($arResult["ERRORS"])) { ?>
                <div class="auth-errors">
                    <? ShowError(implode("<br />", $arResult["ERRORS"])); ?>
                </div>
                <script>
                    $('.dp-field-password-toggle-btn').on('click', function() {

                        var $btn = $(this);
                        var $input = $btn.siblings('input');

                        if ($input.length) {
                            if (!$btn.hasClass('dp-field-password-toggle-btn_active')) {
                                $btn.addClass('dp-field-password-toggle-btn_active');
                                $input.attr('type', 'text');
                            } else {
                                $btn.removeClass('dp-field-password-toggle-btn_active');
                                $input.attr('type', 'password');
                            }
                        }
                    });
                    var $select = $('.dp-form-select');
                    if ($select.length) {
                        $select.selectric({
                            nativeOnMobile: false
                        });
                    }
                </script>
            <? } ?>
        </div>
    </form>

<? endif; ?>