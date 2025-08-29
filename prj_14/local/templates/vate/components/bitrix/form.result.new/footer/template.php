<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
if ($arResult["isFormNote"] != "Y") {
?>

    <?= str_replace('<form', '<form id="footerFeedbackForm" class="form form_style_outline ' . $arResult["WEB_FORM_NAME"] . '"', $arResult["FORM_HEADER"]) ?>
    <script>
        (function() {
            window.addEventListener('load', function() {
                ajaxFooterFeedbackForm('<?= $templateFolder ?>/ajax.php')
            });
        })();
    </script>
    <!-- form_messages_shown for show messages-->
    <? if ($arResult["isFormErrors"] == "Y"): ?>
        <div class="form__messages">
            <?
            if ($arResult["isFormErrors"] == "Y"): ?>
                <div class="form__message form__message_style_error">
                    <?= $arResult["FORM_ERRORS_TEXT"]; ?>
                </div>
            <? endif; ?>
        </div>
    <? endif; ?>
    <?
    if ($arResult["isFormDescription"] == "Y" && !empty($arResult["FORM_DESCRIPTION"])) {
    ?>
        <p class="form__description"><?= $arResult["FORM_DESCRIPTION"] ?></p>
    <?
    }
    ?>
    <div class="form__main">
        <div class="form__title form__title_align_center">
            <!-- begin .title-->
            <h4 class="title title_size_h4">У вас остались вопросы?
            </h4>
            <!-- end .title-->
        </div>
        <div class="form__inputs">
            <?
            foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion) {
                switch ($arQuestion['STRUCTURE'][0]['FIELD_TYPE']) {
                    case "hidden":
                        echo $arQuestion["HTML_CODE"];
                        break;
                    case "text":
                    case "email":
            ?>
                        <!-- TODO: убрать костыль -->
                        <? if ($arQuestion['CAPTION'] === 'Имя'): ?>
                            <div class="form__lines">
                            <? endif; ?>
                            <div class="form__line">
                                <!-- begin .form-control-->
                                <div class="form-control form-control_width_full<? if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])): ?>form-control_state_invalid<? endif; ?>">
                                    <label class="form-control__holder">
                                        <span class="form-control__field">
                                            <!-- Modifiers-->
                                            <!-- form-control__input_state_invalid - red border, one of the two options to show invalid field-->
                                            <input
                                                placeholder="<?= $arQuestion["CAPTION"]; ?>"
                                                <? if (!empty($arResult["arQuestions"][$FIELD_SID]["COMMENTS"]) && $arResult["arQuestions"][$FIELD_SID]["COMMENTS"] == "PHONE"): ?>
                                                type="tel"
                                                class="form-control__input form-control__input form-control__input_style_transparent form-control__input form-control__input_size_s js-phone-input"
                                                <? else: ?>
                                                type="<?= $arQuestion['STRUCTURE'][0]['FIELD_TYPE'] ?>"
                                                class="form-control__input form-control__input form-control__input_style_transparent form-control__input form-control__input_size_s"
                                                <? endif; ?>
                                                id="<?= $arResult["arForm"]["SID"] ?>_<?= $FIELD_SID ?>"
                                                <? if ($arQuestion["REQUIRED"] == "Y"): ?>required="required" <? endif; ?>
                                                name="form_<?= strtolower($arQuestion["STRUCTURE"][0]["FIELD_TYPE"]) ?>_<?= $arQuestion["STRUCTURE"][0]["ID"] ?>"
                                                <? if (
                                                    !empty($arResult["arrVALUES"]["form_" . strtolower($arQuestion["STRUCTURE"][0]["FIELD_TYPE"]) . "_" . $arQuestion["STRUCTURE"][0]["ID"]])
                                                ): ?>
                                                value="<?= $arResult["arrVALUES"]["form_" . strtolower($arQuestion["STRUCTURE"][0]["FIELD_TYPE"]) . "_" . $arQuestion["STRUCTURE"][0]["ID"]] ?>"
                                                <? endif; ?> />
                                            <svg class="form-control__icon form-control__icon_success" width="13" height="9" viewBox="0 0 13 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1.91284 3.30769L5.72237 7L11.9128 1" stroke="black" stroke-width="2" stroke-linecap="round"></path>
                                            </svg>
                                            <!-- Иконка показывается, когда поле не прошло валидацию и инпут имеет класс form-control__input_state_error-->
                                            <svg class="form-control__icon form-control__icon_error" width="9" height="8" viewBox="0 0 9 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1.91284 1L7.91284 7" stroke="#FF0000" stroke-width="2" stroke-linecap="round"></path>
                                                <path d="M7.91284 1L1.91284 7" stroke="#FF0000" stroke-width="2" stroke-linecap="round"></path>
                                            </svg>
                                        </span>
                                        <span class="form-control__messages">
                                            <span style="display: none" class="form-control__message form-control__message_style_error">
                                                <? if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])): ?>
                                                    <?= htmlspecialcharsbx($arResult["FORM_ERRORS"][$FIELD_SID]) ?>
                                                <? endif; ?>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                                <!-- end .form-control-->
                            </div>
                        <?
                        break;
                    case "dropdown":
                        ?>
                            <div class="form__line">
                                <!-- begin .form-control-->
                                <div class="form-control form-control_style_outline <? if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])): ?>form-control_state_invalid<? endif; ?>">
                                    <label class="form-control__holder">
                                        <span class="form-control__label"><?= $arQuestion["CAPTION"] ?></span>
                                        <span class="form-control__field">
                                            <select
                                                id="<?= $arResult["arForm"]["SID"] ?>_<?= $FIELD_SID ?>"
                                                <? if ($arQuestion["REQUIRED"] == "Y"): ?>required="required" <? endif; ?>
                                                name="form_<?= strtolower($arQuestion["STRUCTURE"][0]["FIELD_TYPE"]) ?>_<?= $FIELD_SID ?>"
                                                class="form-control__select js-select">
                                                <option
                                                    value=""
                                                    selected="selected"
                                                    disabled="disabled"
                                                    hidden="hidden"
                                                    class="form-control__option">
                                                    <?= $arQuestion["CAPTION"] ?>
                                                </option>
                                                <? foreach ($arQuestion["STRUCTURE"] as $option): ?>
                                                    <option value="<?= $option["ID"] ?>"
                                                        class="form-control__option"
                                                        <? if (
                                                            !empty($arResult["arrVALUES"]["form_" . strtolower($arQuestion["STRUCTURE"][0]["FIELD_TYPE"]) . "_" . $FIELD_SID]) &&
                                                            $arResult["arrVALUES"]["form_" . strtolower($arQuestion["STRUCTURE"][0]["FIELD_TYPE"]) . "_" . $FIELD_SID] == $option["ID"]
                                                        ): ?>
                                                        selected="selected"
                                                        <? endif; ?>>
                                                        <?= $option["MESSAGE"] ?>
                                                    </option>
                                                <? endforeach; ?>
                                            </select>
                                        </span>
                                        <span class="form-control__messages">
                                            <span style="display: none" class="form-control__message form-control__message_style_error">
                                                <? if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])): ?>
                                                    <?= htmlspecialcharsbx($arResult["FORM_ERRORS"][$FIELD_SID]) ?>
                                                <? endif; ?>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                                <!-- end .form-control-->
                            </div>
                        <?
                        break;
                    case "file":
                        ?>
                            <div class="form__line">
                                <!-- begin .form-control-->
                                <!-- Modifiers-->
                                <!-- form-control_state_invalid - red border, one of the two options to show invalid field-->
                                <div class="form-control form-control_style_outline">
                                    <label class="form-control__holder">
                                        <span class="form-control__label">
                                            <?= htmlspecialchars_decode($arQuestion["CAPTION"]) ?>
                                        </span>
                                        <span class="form-control__field">
                                            <span class="form-control__file">
                                                <!-- begin .file-panel-->
                                                <span class="file-panel file-panel_type_form-control">
                                                    <label class="file-panel__wrapper">
                                                        <input type="file"
                                                            class="file-panel__input js-file-input"
                                                            <? //accept=".doc,.pdf"
                                                            ?>
                                                            id="<?= $arResult["arForm"]["SID"] ?>_<?= $FIELD_SID ?>"
                                                            name="form_<?= strtolower($arQuestion["STRUCTURE"][0]["FIELD_TYPE"]) ?>_<?= $arQuestion["STRUCTURE"][0]["ID"] ?>"
                                                            data-default-label="">
                                                        <span class="file-panel__content">
                                                            <span class="file-panel__label"></span>
                                                        </span>
                                                        <span class="file-panel__control">
                                                            <!-- begin .button-->
                                                            <span class="button button_size_xs button_size_xs">
                                                                <span class="button__holder">Обзор...</span>
                                                            </span>
                                                            <!-- end .button-->
                                                        </span>
                                                    </label>
                                                </span>
                                                <!-- end .file-panel-->
                                            </span>
                                        </span>
                                        <span class="form-control__messages">
                                            <span style="display: none" class="form-control__message form-control__message_style_error">
                                                <? if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])): ?>
                                                    <?= htmlspecialcharsbx($arResult["FORM_ERRORS"][$FIELD_SID]) ?>
                                                <? endif; ?>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                                <!-- end .form-control-->
                            </div>
                    <?
                        break;
                }
                    ?>
                    <!-- TODO: убрать костыль -->
                    <? if ($arQuestion['CAPTION'] === 'Телефон'): ?>
                            </div>
                        <? endif; ?>
                    <? } //endwhile
                    ?>
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_TEMPLATE_PATH . "/include/forms/personal_data.php",
                            "AREA_FILE_RECURSIVE" => "N",
                            "EDIT_MODE" => "html",
                        ),
                        false
                    );
                    ?>
        </div>
        <?
        // if($arResult["isUseCaptcha"] == "Y")
        //{
        $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            array(
                "AREA_FILE_SHOW" => "file",
                "PATH" => SITE_TEMPLATE_PATH . "/include/forms/capcha.php",
                "AREA_FILE_RECURSIVE" => "N",
                "EDIT_MODE" => "html",
            ),
            false,
            array('HIDE_ICONS' => 'Y')
        );
        //} // isUseCaptcha
        ?>
        <div class="form__message"></div>
        <div class="form__confirmation-check">
            <!-- begin .check-elem-->
            <label class="check-elem check-elem_style_light">
                <input class="check-elem__input js-disabling-checkbox" type="checkbox" name="agreement" required="required" /><span class="check-elem__label">Согласен с<a class="link" href="/privacy/" target="_blank"> политикой конфиденциальности</a></span>
            </label>
            <!-- end .check-elem-->
        </div>
        <div class="form__controls">
            <div class="form__control">
                <!-- begin .button-->
                <button class="button button_size_xs button_size_xs" type="submit">
                    <span class="button__holder">Отправить</span>
                </button>
                <!-- end .button-->
                <input type="hidden" name="web_form_submit" value="<?= htmlspecialcharsbx(trim($arResult["arForm"]["BUTTON"]) == '' ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]); ?>" />
            </div>
        </div>
    </div>
    <div class="form__final">
        <div class="form__message-wrapper">
            <div class="form__title">
                <!-- begin .title-->
                <h3 class="title title_size_h4">Ваша заявка успешно отправлена!</h3>
                <!-- end .title-->
            </div>
            <div class="form__text">Ожидайте обратного звонка</div>
        </div>
    </div>
    <?= $arResult["FORM_FOOTER"] ?>
<?
} else {  //endif (isFormNote)
?>

<?
}
?>