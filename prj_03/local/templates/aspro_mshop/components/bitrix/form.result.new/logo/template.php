<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? $frame = $this->createFrame()->begin('') ?>
<div class="form inline <?= $arResult["arForm"]["SID"] ?>">
    <!--noindex-->
    <? if ($arResult["isFormErrors"] == "Y" || strlen($arResult["FORM_NOTE"])): ?>
        <div class="form_result <?= ($arResult["isFormErrors"] == "Y" ? 'error' : 'success') ?>">
            <? if ($arResult["isFormErrors"] == "Y"): ?>
                <?= $arResult["FORM_ERRORS_TEXT"] ?>
            <? else: ?>
                <script type="text/javascript">
                    $(document).ready(function () {
                        // Вызываем модалку с успешной отправкой
                        let searchParams = new URLSearchParams(window.location.search)
                        if(localStorage.getItem("logoPageFormResult") != searchParams.get('RESULT_ID')) {
                            Fancybox.show([{src: "#form__final", type: "inline"}]);
                            localStorage.setItem("logoPageFormResult", searchParams.get('RESULT_ID'));
                            if (arMShopOptions['COUNTERS']['USE_FORMS_GOALS'] !== 'NONE') {
                                var eventdata = {goal: 'goal_webform_success' + (arMShopOptions['COUNTERS']['USE_FORMS_GOALS'] === 'COMMON' ? '' : '_<?=$arParams['WEB_FORM_ID']?>'), <?/*params: <?=CUtil::PhpToJSObject($arParams, false)?>, result: <?=CUtil::PhpToJSObject($arResult, false)?>*/?>};
                                BX.onCustomEvent('onCounterGoals', [eventdata]);
                            }
                        }
                    });
                </script>
                <?/* $successNoteFile = SITE_DIR . "include/form/success_{$arResult["arForm"]["SID"]}.php"; */?><!--
                <?/* if (file_exists($_SERVER["DOCUMENT_ROOT"] . $successNoteFile)): */?>
                    <?/* $APPLICATION->IncludeFile($successNoteFile, array(), array("MODE" => "html", "NAME" => "Form success note")); */?>
                <?/* else: */?>
                    <?/*= GetMessage("FORM_SUCCESS"); */?>
                --><?/* endif; */?>
            <? endif; ?>
        </div>
    <? endif; ?>
    <?= str_replace('<form', '<form class="form form_role_logo" id="logo-page-form"', $arResult["FORM_HEADER"]) ?>
    <div class="form__main">
        <div class="form__inputs">
            <? if (is_array($arResult["QUESTIONS"])): ?>
                <? foreach ($arResult["arQuestions"] as $fieldCode => $arField): ?>
                    <?
                    if ($fieldCode == "PERSONAL_DATA") {
                        continue;
                    }
                    if ($fieldCode == "EMAIL"){
                        $arField["TITLE_TYPE"] = "email";
                    }
                    $arFieldDetail = is_array($arResult["arAnswers"][$fieldCode]) ? current($arResult["arAnswers"][$fieldCode]) : $arResult["arAnswers"][$fieldCode];
                    ?>
                    <? if ($fieldCode == "COMMENT") { ?>
                        <div class="form__line">
                            <!-- begin .form-control-->
                            <div class="form-control form-control_type_area">
                                <label class="form-control__holder">
                                    <span class="form-control__field">
                                        <!-- Modifiers-->
                                        <!-- form-control__input_state_invalid - red border, one of the two options to show invalid field-->
                                        <span class="form__label">
                                           <?=$arField["TITLE"]?>
                                        </span>
                                        <textarea
                                                data-sid="<?=$arField["SID"]?>"
                                                id="form_textarea_<?=$arField["ID"]?>"
                                                name="form_textarea_<?=$arField["ID"]?>"
                                                cols="30"
                                                rows="5"
                                                <?if($arField["REQUIRED"] == "Y"):?>required="required"<?endif;?>
                                        ></textarea>
                                    </span>
                                    <span class="form-control__messages">
                                        <span style="display: none"
                                              class="form-control__message form-control__message_style_error">
                                                Ошибка поля
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <!-- end .form-control-->
                        </div>
                    <? } elseif ($fieldCode == "FILES") { ?>
                        <div class="form__line">
                            <!-- begin .form-control-->
                            <div class="form-control form-control_type_borderless">
                                <label class="form-control__holder">
                                    <span class="form-control__field">
                                        <span class="form-control__file">
                                            <!-- begin .file-input-->
                                            <span class="file-input">
                                                <span class="file-input__panel">
                                                    <div class="list-of-files"></div>
                                                    <!-- begin .file-panel-->
                                                    <span class="file-panel">
                                                            <label class="file-panel__wrapper">
                                                                <input type="file"
                                                                       data-sid="<?=$arField["SID"]?>"
                                                                       class="file-panel__input js-multiple-file-input"
                                                                       accept="jpg,jpeg,png*"
                                                                       multiple="multiple"
                                                                       id="form_file_<?=$arField["ID"]?>"
                                                                       name="files[]">
                                                                <span class="file-panel__control">
                                                                    <!-- begin .button-->
                                                                    <span class="button button_width_full button_style_outline">
                                                                        <span class="button__holder">
                                                                                Прикрепить фото
                                                                        </span>
                                                                    </span>
                                                                    <!-- end .button-->
                                                                </span>
                                                                <span class="file-panel__note"><?=$arField["TITLE"]?></span>
                                                            </label>
                                                    </span>
                                                    <!-- end .file-panel-->
                                                </span>
                                            </span>
                                            <!-- end .file-input-->
                                        </span>
                                    </span>
                                    <span class="form-control__messages">
                                        <span style="display: none"
                                              class="form-control__message form-control__message_style_error">
                                                Ошибка поля
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <!-- end .form-control-->
                        </div>
                    <? } else { ?>
                        <div class="form-group bg">
                            <div class="wrap_md">
                                <div class="iblock label_block">
                                    <label for="form_<?=$arField["TITLE_TYPE"]?>_<?=$arField["ID"]?>"><?=$arField["TITLE"]?> <?if($arField["REQUIRED"] == "Y"):?><span class="star">*</span><?endif;?></label>
                                    <input
                                           type="<?=$arField["TITLE_TYPE"]?>"
                                           data-sid="<?=$arField["SID"]?>"
                                           id="form_<?=$arField["TITLE_TYPE"]?>_<?=$arField["ID"]?>"
                                           name="form_<?=$arField["TITLE_TYPE"]?>_<?=$arField["ID"]?>"
                                           <?if($arField["REQUIRED"] == "Y"):?>required="required"<?endif;?>
                                           value=""
                                           aria-required="true"
                                           <?if($fieldCode == "PHONE"):?>class="phone"<?endif;?>
                                    />
                                </div>
                            </div>
                        </div>
                    <? } ?>
                <? endforeach; ?>
            <? endif; ?>
        </div>
        <? if (!empty($arResult["arQuestions"]["PERSONAL_DATA"])): ?>
            <div class="form__confirmation-check">
                <!-- begin .check-elem-->
                <label class="check-elem check-elem_text-size_s">
                    <input type="checkbox" class="check-elem__input" id="licenses_inline" checked
                           name="form_checkbox_PERSONAL_DATA[]" required
                           value="<?= $arResult["arQuestions"]["PERSONAL_DATA"]["ID"] ?>">
                    <span class="check-elem__label">
                    <? $APPLICATION->IncludeFile(SITE_DIR . "include/licenses_text.php", Array(), Array("MODE" => "html", "NAME" => "LICENSES")); ?>
                </span>
                </label>
                <!-- end .check-elem-->
            </div>
        <? endif; ?>
        <div class="form__controls">
            <div class="form__submit form__submit_width_l">
                <!-- begin .button-->
                <input type="hidden" class="button medium" value="<?= $arResult["arForm"]["BUTTON"] ?>" name="web_form_submit">
                <button class="button button_width_full button_size_l button_role_send" type="submit">
                    <span class="button__holder">Отправить</span>
                </button>
                <!-- end .button-->
            </div>
        </div>
    </div>
    <div class="form_footer">
        <script type="text/javascript">
            $(document).ready(function () {
                if (arMShopOptions['THEME']['PHONE_MASK'].length) {
                    var base_mask = arMShopOptions['THEME']['PHONE_MASK'].replace(/(\d)/g, '_');
                    $('form[name=<?=$arResult["arForm"]["VARNAME"]?>] input.phone').inputmask('mask', {'mask': arMShopOptions['THEME']['PHONE_MASK']});
                    $('form[name=<?=$arResult["arForm"]["VARNAME"]?>] input.phone').blur(function () {
                        if ($(this).val() == base_mask || $(this).val() == '') {
                            if ($(this).hasClass('required')) {
                                $(this).parent().find('label.error').html(BX.message('JS_REQUIRED'));
                            }
                        }
                    });
                }
            });
        </script>
    </div>
    <div id="form__final" class="modal">
        Ваша заявка отправлена
    </div>
    <div id="wrong__size" class="modal">
        Превышен максимальный размер файла
    </div>
    <div id="wrong__length" class="modal">
        Превышено максимальное кол-во файлов
    </div>
    <div id="wrong__ext" class="modal">
        Добавлен файл с неверным форматом
    </div>
    <?= $arResult["FORM_FOOTER"] ?>
    <!--/noindex-->
</div>
<? $frame->end() ?>