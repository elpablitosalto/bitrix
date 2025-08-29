<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
if ($arResult["isFormNote"] != "Y")
{
?>
    <?= str_replace('<form', '<form id="'.$arResult['arForm']['SID'].'" class="form '.$arResult["WEB_FORM_NAME"].'"', $arResult["FORM_HEADER"]) ?>
        <script>
            (function() {
                window.addEventListener('load', function () {
                    var eventName = '<?=(!empty($arParams['JS_SUCCESS_EVENT']) ? $arParams['JS_SUCCESS_EVENT'] : 'form_success')?>';
                    ajaxFeedbackForm('<?=$templateFolder?>/ajax.php', '<?=$arResult['arForm']['SID']?>', eventName);
                });
            })();
        </script>
        <!-- form_messages_shown for show messages-->
        <?if ($arResult["isFormErrors"] == "Y"):?>
            <!--<div class="form_messages__wrapper form_messages_shown">-->
            <div class="form_messages__wrapper">
                <div class="form__messages">
                    <!-- Modifiers-->
                    <!-- form__message_style_error - red color-->
                    <?
                    if ($arResult["isFormErrors"] == "Y"):?>
                        <div class="form__message form__message_style_error">
                            <?= $arResult["FORM_ERRORS_TEXT"]; ?>
                        </div>
                    <? endif; ?>
                </div>
            </div>
        <?endif;?>
        <?
            if ($arResult["isFormDescription"] == "Y" && !empty($arResult["FORM_DESCRIPTION"])) {
                ?>
                <p class="form__description"><?= $arResult["FORM_DESCRIPTION"] ?></p>
                <?
            }
        ?>
        <div class="form__main">
            <div class="form__inputs">
                <?
                    foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion) {
                        switch ($arQuestion['STRUCTURE'][0]['FIELD_TYPE']){
                            case "hidden":
                                echo $arQuestion["HTML_CODE"];
                                break;
                            case ("text"):
                                ?>
                                <div class="form__line">
                                    <!-- begin .form-control-->
                                    <div class="form-control form-control_color_light form-control_style_outline-dark <?if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])):?>form-control_state_invalid<?endif;?>">
                                        <label class="form-control__holder">
                                            <span class="form-control__label"><?=$arQuestion["CAPTION"]?><?if ($arQuestion["REQUIRED"] == "Y"):?>*<?endif;?></span>
                                            <span class="form-control__field">
                                                <!-- Modifiers-->
                                                <!-- form-control__input_state_invalid - red border, one of the two options to show invalid field-->
                                                <?if(!empty($arResult["arQuestions"][$FIELD_SID]["COMMENTS"]) && $arResult["arQuestions"][$FIELD_SID]["COMMENTS"] == "MESSAGE"):?>
                                                    <textarea
                                                        class="form-control__textarea"
                                                        id="<?=$arResult["arForm"]["SID"]?>_<?=$FIELD_SID?>"
                                                        <?if ($arQuestion["REQUIRED"] == "Y"):?>required="required"<?endif;?>
                                                        name="form_<?=strtolower($arQuestion["STRUCTURE"][0]["FIELD_TYPE"])?>_<?=$arQuestion["STRUCTURE"][0]["ID"]?>"
                                                    ></textarea>
                                                <?else:?>
                                                    <input
                                                            <?if(!empty($arResult["arQuestions"][$FIELD_SID]["COMMENTS"]) && $arResult["arQuestions"][$FIELD_SID]["COMMENTS"] == "PHONE"):?>
                                                                type="tel"
                                                                class="form-control__input js-phone-input"
                                                                placeholder="+7(___) ___-__-__"
                                                            <?elseif(!empty($arResult["arQuestions"][$FIELD_SID]["COMMENTS"]) && $arResult["arQuestions"][$FIELD_SID]["COMMENTS"] == "OBJECT"):?>
                                                                type="hidden"
                                                                id="formOrderProductName"
                                                            <?elseif(!empty($arResult["arQuestions"][$FIELD_SID]["COMMENTS"]) && $arResult["arQuestions"][$FIELD_SID]["COMMENTS"] == "EMAIL"):?>
                                                                type="email"
                                                                class="form-control__input"
                                                            <?else:?>
                                                                type="text"
                                                                class="form-control__input"
                                                            <?endif;?>
                                                            id="<?=$arResult["arForm"]["SID"]?>_<?=$FIELD_SID?>"
                                                            <?if ($arQuestion["REQUIRED"] == "Y"):?>required="required"<?endif;?>
                                                            name="form_<?=strtolower($arQuestion["STRUCTURE"][0]["FIELD_TYPE"])?>_<?=$arQuestion["STRUCTURE"][0]["ID"]?>"
                                                            <?if(
                                                                !empty($arResult["arrVALUES"]["form_".strtolower($arQuestion["STRUCTURE"][0]["FIELD_TYPE"])."_".$arQuestion["STRUCTURE"][0]["ID"]])
                                                            ):?>
                                                                value="<?=$arResult["arrVALUES"]["form_".strtolower($arQuestion["STRUCTURE"][0]["FIELD_TYPE"])."_".$arQuestion["STRUCTURE"][0]["ID"]]?>"
                                                            <?endif;?>
                                                    />
                                                <?endif;?>
                                            </span>
                                            <span class="form-control__messages">
                                                <span style="display: none" class="form-control__message form-control__message_style_error">
                                                    <?if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])):?>
                                                        <?=htmlspecialcharsbx($arResult["FORM_ERRORS"][$FIELD_SID])?>
                                                    <?endif;?>
                                                </span>
                                            </span>
                                        </label>
                                    </div>
                                    <!-- end .form-control-->
                                </div>
                                <?
                                break;
                            case ("email"):
                                ?>
                                <div class="form__line">
                                    <!-- begin .form-control-->
                                    <div class="form-control form-control_color_light form-control_style_outline-dark <?if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])):?>form-control_state_invalid<?endif;?>">
                                        <label class="form-control__holder">
                                            <span class="form-control__label"><?=$arQuestion["CAPTION"]?><?if ($arQuestion["REQUIRED"] == "Y"):?>*<?endif;?></span>
                                            <span class="form-control__field">
                                                <!-- Modifiers-->
                                                <!-- form-control__input_state_invalid - red border, one of the two options to show invalid field-->
                                                <?if(!empty($arResult["arQuestions"][$FIELD_SID]["COMMENTS"]) && $arResult["arQuestions"][$FIELD_SID]["COMMENTS"] == "MESSAGE"):?>
                                                    <textarea
                                                        class="form-control__textarea"
                                                        id="<?=$arResult["arForm"]["SID"]?>_<?=$FIELD_SID?>"
                                                        <?if ($arQuestion["REQUIRED"] == "Y"):?>required="required"<?endif;?>
                                                        name="form_<?=strtolower($arQuestion["STRUCTURE"][0]["FIELD_TYPE"])?>_<?=$arQuestion["STRUCTURE"][0]["ID"]?>"
                                                    ></textarea>
                                                <?else:?>
                                                    <input
                                                        type="email"
                                                        class="form-control__input"
                                                        id="<?=$arResult["arForm"]["SID"]?>_<?=$FIELD_SID?>"
                                                        <?if ($arQuestion["REQUIRED"] == "Y"):?>required="required"<?endif;?>
                                                        name="form_<?=strtolower($arQuestion["STRUCTURE"][0]["FIELD_TYPE"])?>_<?=$arQuestion["STRUCTURE"][0]["ID"]?>"
                                                        <?if(
                                                            !empty($arResult["arrVALUES"]["form_".strtolower($arQuestion["STRUCTURE"][0]["FIELD_TYPE"])."_".$arQuestion["STRUCTURE"][0]["ID"]])
                                                        ):?>
                                                            value="<?=$arResult["arrVALUES"]["form_".strtolower($arQuestion["STRUCTURE"][0]["FIELD_TYPE"])."_".$arQuestion["STRUCTURE"][0]["ID"]]?>"
                                                        <?endif;?>
                                                    />
                                                <?endif;?>
                                            </span>
                                            <span class="form-control__messages">
                                                <span style="display: none" class="form-control__message form-control__message_style_error">
                                                    <?if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])):?>
                                                        <?=htmlspecialcharsbx($arResult["FORM_ERRORS"][$FIELD_SID])?>
                                                    <?endif;?>
                                                </span>
                                            </span>
                                        </label>
                                    </div>
                                    <!-- end .form-control-->
                                </div>
                                <?
                                break;
                            case "textarea":
                                ?>
                                <div class="form__line">
                                    <!-- begin .form-control-->
                                    <div class="form-control form-control_color_light form-control_style_outline-dark <?if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])):?>form-control_state_invalid<?endif;?>">
                                        <label class="form-control__holder">
                                            <span class="form-control__label"><?=$arQuestion["CAPTION"]?></span>
                                            <span class="form-control__field">
                                                <textarea
                                                    class="form-control__textarea js-expanding-textarea"
                                                    placeholder="введите ваше сообщение"
                                                    <?if ($arQuestion["REQUIRED"] == "Y"):?>required="required"<?endif;?>
                                                    name="form_<?=strtolower($arQuestion["STRUCTURE"][0]["FIELD_TYPE"])?>_<?=$arQuestion["STRUCTURE"][0]["ID"]?>"
                                                ></textarea>
                                                <!-- Modifiers-->
                                            </span>
                                            <span class="form-control__messages">
                                                <span style="display: none" class="form-control__message form-control__message_style_error">
                                                    <?if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])):?>
                                                        <?=htmlspecialcharsbx($arResult["FORM_ERRORS"][$FIELD_SID])?>
                                                    <?endif;?>
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
                                    <div class="form-control form-control_style_outline <?if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])):?>form-control_state_invalid<?endif;?>">
                                        <label class="form-control__holder">
                                            <span class="form-control__label"><?=$arQuestion["CAPTION"]?></span>
                                            <span class="form-control__field">
                                                <select
                                                        id="<?=$arResult["arForm"]["SID"]?>_<?=$FIELD_SID?>"
                                                        <?if ($arQuestion["REQUIRED"] == "Y"):?>required="required"<?endif;?>
                                                        name="form_<?=strtolower($arQuestion["STRUCTURE"][0]["FIELD_TYPE"])?>_<?=$FIELD_SID?>"
                                                        class="form-control__select js-select"
                                                >
                                                    <option
                                                            value=""
                                                            selected="selected"
                                                            disabled="disabled"
                                                            hidden="hidden"
                                                            class="form-control__option"
                                                    >
                                                        <?=$arQuestion["CAPTION"]?>
                                                    </option>
                                                    <?foreach($arQuestion["STRUCTURE"] as $option):?>
                                                        <option value="<?=$option["ID"]?>"
                                                                class="form-control__option"
                                                                <?if(
                                                                    !empty($arResult["arrVALUES"]["form_".strtolower($arQuestion["STRUCTURE"][0]["FIELD_TYPE"])."_".$FIELD_SID]) &&
                                                                    $arResult["arrVALUES"]["form_".strtolower($arQuestion["STRUCTURE"][0]["FIELD_TYPE"])."_".$FIELD_SID] == $option["ID"]
                                                                ):?>
                                                                    selected="selected"
                                                                <?endif;?>
                                                        >
                                                            <?=$option["MESSAGE"]?>
                                                        </option>
                                                    <?endforeach;?>
                                                </select>
                                            </span>
                                            <span class="form-control__messages">
                                                <span style="display: none" class="form-control__message form-control__message_style_error">
                                                    <?if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])):?>
                                                       <?=htmlspecialcharsbx($arResult["FORM_ERRORS"][$FIELD_SID])?>
                                                    <?endif;?>
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
                                                <?=htmlspecialchars_decode($arQuestion["CAPTION"])?>
                                            </span>
                                            <span class="form-control__field">
                                                <span class="form-control__file">
                                                    <!-- begin .file-panel-->
                                                    <span class="file-panel file-panel_type_form-control">
                                                        <label class="file-panel__wrapper">
                                                            <input type="file"
                                                                class="file-panel__input js-file-input"
                                                                accept=".pdf,.txt,.doc,.png,.jpeg,.jpg"
                                                                id="<?=$arResult["arForm"]["SID"]?>_<?=$FIELD_SID?>"
                                                                name="form_<?=strtolower($arQuestion["STRUCTURE"][0]["FIELD_TYPE"])?>_<?=$arQuestion["STRUCTURE"][0]["ID"]?>"
                                                                data-default-label=""
                                                            >
                                                            <span class="file-panel__content">
                                                                <span class="file-panel__label"></span>
                                                            </span>
                                                            <span class="file-panel__note">Допустимые форматы .pdf, .txt, .doc, .png, .jpeg, .jpg</span>
                                                            <span class="file-panel__control">
                                                                <!-- begin .button-->
                                                                <span class="button button_width_full button_style_outline button_weight_normal">
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
                                                     <?if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])):?>
                                                         <?=htmlspecialcharsbx($arResult["FORM_ERRORS"][$FIELD_SID])?>
                                                     <?endif;?>
                                                </span>
                                            </span>
                                        </label>
                                    </div>
                                    <!-- end .form-control-->
                                </div>
                                <?
                                break;
                        }
                    } //endwhile
                ?>
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
            </div>
            <?
            if(false && $arResult["isUseCaptcha"] == "Y")
            {
                $APPLICATION->IncludeComponent("bitrix:main.include", "", array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => SITE_TEMPLATE_PATH."/include/forms/capcha.php",
                    "AREA_FILE_RECURSIVE" => "N",
                    "EDIT_MODE" => "html",
                ),
                    false,
                    array('HIDE_ICONS' => 'Y')
                );
            } // isUseCaptcha
            ?>
            <div class="form__message"></div>
            <div class="form__submit form__submit_width_l">
                <div class="form__submit-control">
                    <!-- begin .button-->
                    <button
                        id="<?=$arResult['arForm']['SID']?>Submit"
                        class="button button_width_full button_size_s"
                        data-type="submit"
                        type="submit"
                        name="web_form_submit"
                        disabled
                        value="<?= htmlspecialcharsbx(trim($arResult["arForm"]["BUTTON"]) == '' ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]); ?>"
                    >
                        <span class="button__holder">Отправить</span>
                    </button>
                    <!-- end .button-->
                </div>
            </div>
        </div>
        <div class="form__final">
            <div class="form__illustration">
                <img src="<?= SITE_TEMPLATE_PATH ?>/mockup/dist/assets/blocks/form/images/check.svg" alt="Успех!" class="form__image" title="" />
            </div>
            <div class="form__message-wrapper">
                <div class="form__title">Ваше сообщение отправлено</div>
                <div class="form__text">Мы свяжемся с вами в ближайшее время</div>
            </div>
        </div>
        <?php
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
    <?= $arResult["FORM_FOOTER"] ?>
<?
}else{  //endif (isFormNote)
    ?>

    <?
}
?>