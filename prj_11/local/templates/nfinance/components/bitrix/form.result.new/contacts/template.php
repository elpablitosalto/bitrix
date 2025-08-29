<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
CAjax::Init();
if ($arResult["FORM_RESULT"] != "addok")
{
?>
    <div class="panel-form section__panel-form">
        <div class="panel-form__content">
            <div class="panel-form__illustration">
                <div class="panel-form__icon-wrapper"><svg class="panel-form__icon" width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M12.0009 27.6667L15.4 32.2C16.2 33.2667 17.8 33.2667 18.6 32.2L21.9991 27.6667H27.6667C30.6124 27.6667 33 25.2791 33 22.3333V6.33333C33 3.38756 30.6124 1 27.6667 1H6.33333C3.38756 1 1 3.38756 1 6.33333V22.3333C1 25.2791 3.38756 27.6667 6.33333 27.6667H12.0009Z" stroke="#1D24CD" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path fill-rule="evenodd" clip-rule="evenodd" d="M17 9.63262C17.6347 8.91617 18.7333 8.11084 20.4062 8.11084C23.3342 8.11084 25.2969 10.758 25.2969 13.2255C25.2969 18.3811 18.6409 22.3331 17 22.3331C15.3591 22.3331 8.70312 18.3811 8.70312 13.2255C8.70312 10.758 10.6658 8.11084 13.5938 8.11084C15.2667 8.11084 16.3653 8.91617 17 9.63262Z" stroke="#1D24CD" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
            </div>
            <div class="panel-form__title">
                <!-- begin .title-->
                <h2 class="title title_size_h2">Остались вопросы?
                </h2>
                <!-- end .title-->
            </div>
            <div class="panel-form__text"><span class="highlight">Свяжитесь с нами,</span> мы с радостью ответим на ваши вопросы
            </div>
        </div>
        <div class="panel-form__form">
            <!-- begin .form-->
            <!-- Modifiers-->
            <!-- form_messages_shown - display the messages element. this will automatically display all the .form__message elements-->
            <? $arResult["FORM_HEADER"] = preg_replace('/action="\/[^"]*"/', 'action="trap.php"', $arResult["FORM_HEADER"]); ?>
            <?=str_replace('<form', '<form class="form form_spacing_l" id="'.$arParams["FORM_ID"].'"', $arResult["FORM_HEADER"])?>
                <?foreach ($arResult["arQuestions"] as $fieldCode => $arField){
                    $arQuestion = $arResult['QUESTIONS'][$fieldCode];
                    $fieldID = $arQuestion['STRUCTURE'][0]['ID'];
                    $fieldName = sprintf('form_%s_%s', $arField["TITLE_TYPE"], $fieldID);
                    $arFieldDetail = is_array($arResult["arAnswers"][$fieldCode]) ? current($arResult["arAnswers"][$fieldCode]) : $arResult["arAnswers"][$fieldCode];
                    if ($arFieldDetail["FIELD_TYPE"] == "hidden"){
                        ?><input type="hidden" name="form_<?=$fieldName?>" /><?
                        unset($arResult["arQuestions"][$fieldCode]);
                    }
                }?>
                <input type="hidden" name="web_form_submit" value="Y" />
                <!-- messages can be placed before or after the form-->
                <div class="form__messages">
                    <!-- Modifiers-->
                    <!-- form__message_style_error - red color-->
                    <div class="form__message">
                        <?=$arResult["FORM_ERRORS_TEXT"]?>
                    </div>
                </div>
                <div class="form__main">
                    <div class="form__inputs">
                        <?foreach ($arResult["arQuestions"] as $fieldCode => $arField):?>
                            <?
                            $class = "";
                            $type = "text";
                            if ($arField["TITLE"] == "PHONE"){
                                $arField["TITLE"] = "+7 (999) 999-99-99";
                                $type = "tel";
                                $class = " js-phone-input";
                            }
                            if ($arField["TITLE"] == "E-mail"){
                                $type = "email";
                                $arField["TITLE_TYPE"] = $type;
                                $class = " js-email-input";
                            }
                            $arQuestion = $arResult['QUESTIONS'][$fieldCode];
                            $fieldID = $arQuestion['STRUCTURE'][0]['ID'];
                            $fieldName = sprintf('form_%s_%s', $arField["TITLE_TYPE"], $fieldID);
                            ?>
                            <div class="form__line">
                                <!-- begin .form-control-->
                                <div class="form-control">
                                    <label class="form-control__holder">
                                        <span class="form-control__field">
                                            <!-- Modifiers-->
                                            <!-- form-control__input_state_invalid - red border, one of the two options to show invalid field-->
                                            <input
                                                    class="form-control__input<?=$class?>"
                                                    name="form_<?=$fieldName?>"
                                                    type="<?=$type?>"
                                                    placeholder="<?=$arField["TITLE"]?>"
                                                    <?if($arField["REQUIRED"] == "Y"):?>required="required"<?endif;?>
                                            />
                                            <!-- Иконка показывается, когда поле прошло валидацию и инпут имеет класс form-control__input_state_success-->
                                            <svg class="form-control__icon form-control__icon_success" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                              <path d="M16 10L11 15L8 12M12 21C7.029 21 3 16.971 3 12C3 7.029 7.029 3 12 3C16.971 3 21 7.029 21 12C21 16.971 16.971 21 12 21Z" stroke="#1D1814" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                            <!-- Иконка показывается, когда поле не прошло валидацию и инпут имеет класс form-control__input_state_error-->
                                            <svg class="form-control__icon form-control__icon_error" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                              <path d="M14.83 9.17L9.17 14.83M14.83 14.83L9.17 9.17M12 21C7.029 21 3 16.971 3 12C3 7.029 7.029 3 12 3C16.971 3 21 7.029 21 12C21 16.971 16.971 21 12 21Z" stroke="#1D1814" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </span>
                                        <span class="form-control__messages">
                                            <span class="form-control__message form-control__message_style_error" style="display: none;">Ошибка поля</span>
                                        </span>
                                    </label>
                                </div>
                                <!-- end .form-control-->
                            </div>
                        <?endforeach;?>
                    </div>
                    <div class="form__confirmation-check">
                        <!-- begin .check-elem-->
                        <label class="check-elem check-elem_text-size_s">
                            <input class="check-elem__input" type="checkbox" name="agreement" required="required"/>
                            <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/include/form/confirmation_check.php",
                                Array(),
                                Array("MODE" => "html", "NAME" => "CONFIRMATION_CHECK")
                            );?>
                        </label>
                        <!-- end .check-elem-->
                    </div>
                    <div class="form__controls">
                        <div class="form__control">
                            <!-- begin .button-->
                            <button class="button button_width_full" type="submit">
                                <span class="button__holder">
                                      <span class="button__text">Отправить</span>
                                </span>
                            </button>
                            <!-- end .button-->
                        </div>
                    </div>
                </div>
                <input class="form__ps-message" name="form_message" />
            <?=$arResult["FORM_FOOTER"]?>
            <!-- end .form-->
        </div>
    </div>
<?
}else{
    $APPLICATION->RestartBuffer();
    ?>
   <div class="modal modal_padding_standard" id="modalSubmitSuccess">
        <div class="modal__header">
            <div class="modal__title">
                <!-- begin .title-->
                <h3 class="title title_size_h3 title_style_bold">
                    <span class="highlight">Спасибо! Мы получили вашу заявку!</span>
                </h3>
                <!-- end .title-->
            </div>
            <div class="modal__text">
                В ближайшее время наш менеджер свяжется с вами
            </div>
        </div>
    </div>
    <?
    exit(200);
}
?>