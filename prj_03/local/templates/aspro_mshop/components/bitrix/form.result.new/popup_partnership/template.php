<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
?>
<div class="js_partnership_form">
    <?
    //$arResult['FORM_HEADER'] = str_replace('<form ', '<form onsubmit="yaCounter36139370.reachGoal(\'goal_webform_success\')" ', $arResult['FORM_HEADER']);
    ?>
    <a href="#" class="close jqmClose"><i></i></a>
    <div class="form <?= $arResult["arForm"]["SID"] ?>">
        <!--noindex-->
        <div class="form_head">
            <? if ($arResult["isFormTitle"] == "Y") : ?>
                <h2><?= $arResult["FORM_TITLE"] ?></h2>
            <? endif; ?>
            <? if ($arResult["isFormDescription"] == "Y") : ?>
                <div class="form_desc"><?= $arResult["FORM_DESCRIPTION"] ?></div>
            <? endif; ?>
        </div>
        <?
        //if ($arResult["isFormErrors"] == "Y" || strlen($arResult["FORM_NOTE"])) {
        if (strlen($arResult["FORM_NOTE"])) {
        ?>
            <div class="form_result <?= ($arResult["isFormErrors"] == "Y" ? 'error' : 'success') ?>">
                <? if ($arResult["isFormErrors"] == "Y") : ?>
                    <?= $arResult["FORM_ERRORS_TEXT"] ?>
                <? else : ?>
                    <?/*?>
                    <script type="text/javascript">
                        $(document).ready(function() {
                            if (arMShopOptions['COUNTERS']['USE_FORMS_GOALS'] !== 'NONE') {
                                var eventdata = {
                                    goal: 'goal_webform_success' + (arMShopOptions['COUNTERS']['USE_FORMS_GOALS'] === 'COMMON' ? '' : '_<?= $arParams['WEB_FORM_ID'] ?>')
                                };
                                BX.onCustomEvent('onCounterGoals', [eventdata]);
                            }
                        });
                    </script>
                    <?*/ ?>
                    <? $successNoteFile = SITE_DIR . "include/form/success_{$arResult["arForm"]["SID"]}.php"; ?>
                    <? if (file_exists($_SERVER["DOCUMENT_ROOT"] . $successNoteFile)) : ?>
                        <? $APPLICATION->IncludeFile($successNoteFile, array(), array("MODE" => "html", "NAME" => "Form success note")); ?>
                    <? else : ?>
                        <?= GetMessage("FORM_SUCCESS"); ?>
                    <? endif; ?>
                <? endif; ?>
            </div>
        <? } else { ?>
            <?= $arResult["FORM_HEADER"] ?>
            <?= bitrix_sessid_post(); ?>
            <div class="form_body s33">
                <? if (is_array($arResult["QUESTIONS"])) : ?>
                    <? foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion) : ?>
                        <?
                        //vardump($arQuestion);
                        ?>
                        <?/*?>
                        <? CMShop::drawFormField($FIELD_SID, $arQuestion); ?>
                        <?*/ ?>
                        <?
                        if (isset($arParams[$FIELD_SID]) && $arParams[$FIELD_SID]['VALUE'] && $arParams[$FIELD_SID]['AUTOCOMPLETE'] == 'Y') {
                            $arQuestion['HTML_CODE'] = str_replace('name=', 'value="' . $arParams[$FIELD_SID]['VALUE'] . '" name=', $arQuestion['HTML_CODE']);
                        }
                        //vardump($arQuestion);
                        if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden') {
                            echo $arQuestion["HTML_CODE"];
                        } else {
                            $type = $arQuestion["STRUCTURE"][0]["FIELD_TYPE"];
                            $field_id = $arQuestion["STRUCTURE"][0]["ID"];
                            $name = 'form_' . $type . '_' . $field_id;
                            if (true) {
                                $valid_type = '';
                                $star = '';
                                $required = '';
                                $add_class = '';
                                $form__input_class = '';
                                if ($arQuestion["REQUIRED"] == 'Y') {
                                    $star = '*';
                                    $required = 'required';
                                }
                                $phone_class = '';

                                switch ($FIELD_SID) {
                                    case 'NAME':
                                        $add_class = '';
                                        $form__input_class = '';
                                        $valid_type = 'NAME';
                                        break;
                                    case 'EMAIL':
                                        $valid_type = 'EMAIL';
                                        break;
                                    case 'INN':
                                        $valid_type = 'INN';
                                        break;
                                    case 'PHONE':
                                        $phone_class = 'js_phone_class';
                                        $valid_type = 'PHONE';
                                        break;
                                    case 'MESSAGE':
                                        $valid_type = 'QUESTION';
                                        $form__input_class = '';
                                        break;
                                }
                            }

                            if ($type == 'text' || $type == 'textarea') {
                            } else {
                                $type == 'text';
                            }


                            // Для валидации -->
                            $strValidateAttrs = '';
                            $arValidateAttrs = [];
                            if ($arQuestion["REQUIRED"] == 'Y') {
                                $arValidateAttrs[] = 'data-rule-required="true"';
                                $requiredTextError =  ($valid_type == 'PHONE') ? 'FS_FIELD_ERROR_REQUIRED_PHONE' : 'FS_FIELD_ERROR_REQUIRED';
                                $arValidateAttrs[] = 'data-msg-required="' . Loc::getMessage($requiredTextError) . '"';

                                switch ($valid_type) {
                                    case 'NAME':
                                        $arValidateAttrs[] = 'data-rule-minlength="2"';
                                        $arValidateAttrs[] = 'data-msg-minlength="' . Loc::getMessage('FS_NAME_ERROR_MINLEN') . '"';
                                        break;
                                    case 'EMAIL':
                                        $arValidateAttrs[] = 'data-rule-email="true"';
                                        $arValidateAttrs[] = 'data-msg-email="' . Loc::getMessage('FS_EMAIL_ERROR_INCORRECT') . '"';
                                        break;
                                    case 'PHONE':
                                        $arValidateAttrs[] = 'data-rule-phone="true"';
                                        $arValidateAttrs[] = 'data-msg-phone="' . Loc::getMessage('FS_PHONE_ERROR_INCORRECT') . '"';
                                        break;
                                    case 'INN':
                                        $arValidateAttrs[] = 'data-rule-minlength="10"';
                                        $arValidateAttrs[] = 'data-msg-minlength="' . Loc::getMessage('FS_ENTER_INN_TEN_DIGITS') . '"';
                                        $arValidateAttrs[] = 'data-rule-digits="10"';
                                        $arValidateAttrs[] = 'data-msg-digits="' . Loc::getMessage('FS_ENTER_ONLY_DIGITS') . '"';
                                        break;
                                    case 'QUESTION':
                                        $arValidateAttrs[] = 'data-rule-minlength="1"';
                                        $arValidateAttrs[] = 'data-msg-minlength="' . Loc::getMessage('FS_ENTER_QUESTION_TEXT') . '"';
                                        break;
                                }
                            } else {
                                switch ($valid_type) {
                                    case 'EMAIL':
                                        $arValidateAttrs[] = 'data-rule-email="true"';
                                        $arValidateAttrs[] = 'data-msg-email="' . Loc::getMessage('FS_EMAIL_ERROR_INCORRECT') . '"';
                                        break;
                                }
                            }
                            if ($type == 'text' || $type == 'textarea') {
                                $arValidateAttrs[] = 'data-rule-notonlyspaces="true"';
                                $arValidateAttrs[] = 'data-msg-notonlyspaces="В тексте не должны быть только пробелы"';
                            }
                            if (count($arValidateAttrs) > 0) {
                                $strValidateAttrs = ' ' . implode(' ', $arValidateAttrs);
                            }
                            // <-- Для валидации

                            //echo 'type = '.$type.'<br />';
                        ?>
                            <div class="form__input <?= $form__input_class; ?>">
                                <?
                                if ($type == "textarea") { ?>
                                    <label class="visually-hidden" for="partnership-form__textarea"><?/*?><?= $arQuestion["CAPTION"]; ?><?= $star ?><?*/ ?></label>
                                    <textarea id="partnership-form__textarea" <?= $strValidateAttrs; ?> <?= $add_class; ?>" name="<?= $name ?>" placeholder="<?= $arQuestion["CAPTION"]; ?><?= $star ?>" <?= $required; ?>><?= $arQuestion['VALUE']; ?></textarea>
                                <? } else { ?>
                                    <label class="visually-hidden" for="<?= $name ?>"><?/*?><?= $arQuestion["CAPTION"]; ?><?= $star ?><?*/ ?></label>
                                    <input value="<?= $arQuestion['VALUE']; ?>" <?= $strValidateAttrs; ?> class="partnership-form__input <?= $phone_class; ?> <?= $add_class; ?>" id="<?= $name ?>" type="<?= $type; ?>" name="<?= $name ?>" placeholder="<?= $arQuestion["CAPTION"]; ?><?= $star ?>" <?= $required; ?>>
                                <?
                                }
                                ?>
                            </div>
                        <?
                        }
                        ?>
                    <? endforeach; ?>
                <? endif; ?>
                <div class="clearboth"></div>
                <? if ($arResult["isUseCaptcha"] == "Y") : ?>
                    <div class="form-control captcha-row clearfix">
                        <label><span><?= GetMessage("FORM_CAPRCHE_TITLE") ?>&nbsp;<span class="star">*</span></span></label>
                        <div class="captcha_image">
                            <img src="/bitrix/tools/captcha.php?captcha_sid=<?= htmlspecialcharsbx($arResult["CAPTCHACode"]) ?>" border="0" />
                            <input type="hidden" name="captcha_sid" value="<?= htmlspecialcharsbx($arResult["CAPTCHACode"]) ?>" />
                            <div class="captcha_reload"></div>
                        </div>
                        <div class="captcha_input">
                            <?
                            $strValidateAttrs = '';
                            $arValidateAttrs = [];
                            $arValidateAttrs[] = 'data-rule-required="true"';
                            $arValidateAttrs[] = 'data-msg-required="' . Loc::getMessage('FS_FIELD_ERROR_REQUIRED') . '"';
                            $strValidateAttrs = ' ' . implode(' ', $arValidateAttrs);
                            ?>
                            <input <?= $strValidateAttrs; ?> type="text" class="inputtext captcha" name="captcha_word" size="30" maxlength="50" value="" required />
                        </div>
                    </div>
                <? endif; ?>
                <div class="clearboth"></div>
            </div>
            <div class="form_footer">
                <? if (false) { ?>
                    <? if (COption::GetOptionString("aspro.mshop", "SHOW_LICENCE", "N") == "Y") : ?>
                        <div class="licence_block filter label_block">
                            <input type="checkbox" id="licenses_popup" <?= (COption::GetOptionString("aspro.mshop", "LICENCE_CHECKED", "N") == "Y" ? "checked" : ""); ?> name="licenses_popup" required value="Y">
                            <label for="licenses_popup">
                                <? $APPLICATION->IncludeFile(SITE_DIR . "include/licenses_text.php", array(), array("MODE" => "html", "NAME" => "LICENSES")); ?>
                            </label>
                        </div>
                    <? endif; ?>
                <? } ?>
                <div class="licence_block filter label_block">
                    <?
                    $strValidateAttrs = '';
                    $arValidateAttrs = [];
                    $arValidateAttrs[] = 'data-rule-required="true"';
                    $arValidateAttrs[] = 'data-msg-required="' . Loc::getMessage('FS_AGREE_INCORRECT') . '"';
                    $strValidateAttrs = ' ' . implode(' ', $arValidateAttrs);
                    ?>
                    <input <?= $strValidateAttrs; ?> type="checkbox" id="licenses_popup" checked name="licenses_popup" required value="Y">
                    <label for="licenses_popup">
                        <? $APPLICATION->IncludeFile(SITE_DIR . "include/licenses_text_form.php", array(), array("MODE" => "html", "NAME" => "LICENSES")); ?>
                    </label>
                </div>
                <div class="licence_block filter label_block">
                    <input type="checkbox" id="subscription_popup" checked name="subscription_popup" value="Y">
                    <label for="subscription_popup">
                        <? $APPLICATION->IncludeFile(SITE_DIR . "include/subscription_text.php", array(), array("MODE" => "html", "NAME" => "LICENSES")); ?>
                    </label>
                </div>
                <?
                // Google Recaptcha v.3 -->
                ?>
                <?
                if (RECAPTCHA_3_USE == 'Y') {
                    $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => "/local/include/captcha.php",
                            "AREA_FILE_RECURSIVE" => "N",
                            "EDIT_MODE" => "html",
                        ),
                        false,
                        array('HIDE_ICONS' => 'Y')
                    );
                }
                ?>
                <?
                // <-- Google Recaptcha v.3
                ?>
                <div class="licence_block filter label_block js_errors_block">
                    <? if ($arResult["isFormErrors"] == "Y") { ?>
                        <?= $arResult["FORM_ERRORS_TEXT"] ?>
                    <? } ?>
                </div>
                <? /* <button type="submit" class="rd-button rd-button_style_light" value="Y" name="web_form_submit" ><span><?=$arResult["arForm"]["BUTTON"]?></span></button> */ ?>
                <input type="submit" class="rd-button rd-button_style_light" value="<?= $arResult["arForm"]["BUTTON"] ?>" name="web_form_submit">

                <?/*?>
                <button type="reset" class="rd-button rd-button_style_light transparent" value="reset" name="web_form_reset"><span><?= GetMessage('FORM_CLOSE') ?></span></button>
                <?*/ ?>

                <?/*?>
                <p class="mt-3">Нажимая кнопку &laquo;<?= $arResult["arForm"]["BUTTON"] ?>&raquo; Вы соглашаетесь с <a href="/politika-konfidentsialnosti.php" target="_blank">политикой конфиденциальности в полном объёме</a>.</p>
                <?*/ ?>
            </div>
            <?= $arResult["FORM_FOOTER"] ?>
        <? } ?>
        <!--/noindex-->
    </div>
</div>


<?/*?>
<script type="text/javascript">
    $(document).ready(function() {
        $('form[name="<?= $arResult["arForm"]["VARNAME"] ?>"]').validate({
            highlight: function(element) {
                $(element).parent().addClass('error');
            },
            unhighlight: function(element) {
                $(element).parent().removeClass('error');
            },
            submitHandler: function(form) {
                if ($('form[name="<?= $arResult["arForm"]["VARNAME"] ?>"]').valid()) {
                    // form.submit();

                    var eventdata = {
                        type: 'form_submit',
                        form: form,
                        form_name: '<?= $arResult["arForm"]["VARNAME"] ?>'
                    };
                    BX.onCustomEvent('onSubmitForm', [eventdata]);

                    setTimeout(function() {
                     $(form).find('button[type="submit"]').attr("disabled", "disabled");
                     }, 300);
                }
            },
            errorPlacement: function(error, element) {
                error.insertBefore(element);
            },
            messages: {
                licenses_popup: {
                    required: BX.message('JS_REQUIRED_LICENSES')
                }
            }
        });

        if (arMShopOptions['THEME']['PHONE_MASK'].length) {
            var base_mask = arMShopOptions['THEME']['PHONE_MASK'].replace(/(\d)/g, '_');
            $('form[name=<?= $arResult["arForm"]["VARNAME"] ?>] input.phone').inputmask('mask', {
                'mask': arMShopOptions['THEME']['PHONE_MASK']
            });
            $('form[name=<?= $arResult["arForm"]["VARNAME"] ?>] input.phone').blur(function() {
                if ($(this).val() == base_mask || $(this).val() == '') {
                    if ($(this).hasClass('required')) {
                        $(this).parent().find('label.error').html(BX.message('JS_REQUIRED'));
                    }
                }
            });
        }

        //$('.popup').jqmAddClose('a.jqmClose');
        $('.jqmClose').on('click', function(e) {
            e.preventDefault();
            $(this).closest('.popup').jqmHide();
        });
        $('.popup').jqmAddClose('button[name="web_form_reset"]');
    });
</script>
<script>
    const phoneInputs = document.getElementsByClassName('phone_mask');
    var getInputNumbersValue = function(input) {
        // Return stripped input value — just numbers
        return input.value.replace(/\D/g, '');
    }

    var onPhonePaste = function(e) {
        var input = e.target,
            inputNumbersValue = getInputNumbersValue(input);
        var pasted = e.clipboardData || window.clipboardData;
        if (pasted) {
            var pastedText = pasted.getData('Text');
            if (/\D/g.test(pastedText)) {
                // Attempt to paste non-numeric symbol — remove all non-numeric symbols,
                // formatting will be in onPhoneInput handler
                input.value = inputNumbersValue;
                return;
            }
        }
    }

    var onPhoneInput = function(e) {
        var input = e.target,
            inputNumbersValue = getInputNumbersValue(input),
            selectionStart = input.selectionStart,
            formattedInputValue = "";

        if (!inputNumbersValue) {
            return input.value = (e.data == "+") ? "+" : "";
        }

        if (input.value.length != selectionStart) {
            // Editing in the middle of input, not last symbol
            if (input.value[0] != '+') { // Add "+" if input value startswith not "+"
                var oldSelectionStart = input.selectionStart
                input.value = '+' + input.value;
                input.selectionStart = input.selectionEnd = oldSelectionStart + 1
            }
            if (e.data && /\D/g.test(e.data)) {
                // Attempt to input non-numeric symbol
                input.value = inputNumbersValue;
            }
            return;
        }

        if (["7", "8", "9"].indexOf(inputNumbersValue[0]) > -1) {
            if (inputNumbersValue[0] == "9")
                inputNumbersValue = "7" + inputNumbersValue;
            var firstSymbols = (inputNumbersValue[0] == "8") ? "8" : "+7";
            formattedInputValue = input.value = firstSymbols + " ";
            if (inputNumbersValue.length > 1) {
                formattedInputValue += '(' + inputNumbersValue.substring(1, 4);
            }
            if (inputNumbersValue.length >= 5) {
                formattedInputValue += ') ' + inputNumbersValue.substring(4, 7);
            }
            if (inputNumbersValue.length >= 8) {
                formattedInputValue += '-' + inputNumbersValue.substring(7, 9);
            }
            if (inputNumbersValue.length >= 10) {
                formattedInputValue += '-' + inputNumbersValue.substring(9, 11);
            }
        } else {
            formattedInputValue = '+' + inputNumbersValue.substring(0, 16);
        }
        input.value = formattedInputValue;
    }
    var onPhoneKeyDown = function(e) {
        // Clear input after remove last symbol
        var inputValue = e.target.value.replace(/\D/g, '');
        if (e.keyCode == 8 && inputValue.length == 1) {
            // Clear input after remove last symbol
            e.target.value = "";
        } else if ([8, 46].indexOf(e.keyCode) > -1 && inputValue.length > 1) {
            // Prevent when removing service symbols
            var symToClear
            switch (e.keyCode) {
                case 8: // BackSpace key
                    symToClear = e.target.value[e.target.selectionStart - 1];
                    break;
                case 46: // Delete key
                    symToClear = e.target.value[e.target.selectionStart];
                    break;
            }
            if (symToClear && /\D/.test(symToClear))
                e.preventDefault();
        }

    }
    for (var phoneInput of phoneInputs) {
        phoneInput.addEventListener('keydown', onPhoneKeyDown);
        phoneInput.addEventListener('input', onPhoneInput, false);
        phoneInput.addEventListener('paste', onPhonePaste, false);
    }
</script>
<?*/ ?>