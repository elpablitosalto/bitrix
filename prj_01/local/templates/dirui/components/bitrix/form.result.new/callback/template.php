<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arQuestions = $arResult["arQuestions"]; ?>

<section class="c-form c-form--callback" id="callback">
    <?= str_replace("<form", "<form class=\"c-form__wrapper c-form--select\"", $arResult["FORM_HEADER"]) ?>

    <?
    foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion) {
        //vardump($arQuestion);
        if (isset($arParams[$FIELD_SID]) /*&& $arParams[$FIELD_SID]['VALUE']*/ && $arParams[$FIELD_SID]['AUTOCOMPLETE'] == 'Y') {
            
            if ($arQuestion['CODE'] == 'SIMPLE_QUESTION_795') {
                $replaceStr = 'class="js_phone_class"';
            } else {
                $replaceStr = 'class=""';
            }
            $replaceStr .= ' value="' . $arParams[$FIELD_SID]['VALUE'] . '" name=';
            //$replaceStr 
            $arQuestion['HTML_CODE'] = str_replace('name=', $replaceStr, $arQuestion['HTML_CODE']);
            echo $arQuestion["HTML_CODE"];
        }
    }
    ?>

    <h3 class="c-form__title">Свяжитесь с нами</h3>
    <div class="c-form__group-input">
        <input name="<?= $arQuestions["NAME"]["INPUT_CODE"] ?>" placeholder="<?= $arQuestions["NAME"]["TITLE"] ?>" value="<?= $arQuestions["NAME"]["CURRENT_VALUE"] ?>">
        <input class="c-form--error" name="<?= $arQuestions["EMAIL"]["INPUT_CODE"] ?>" placeholder="<?= $arQuestions["EMAIL"]["TITLE"] ?>" value="<?= $arQuestions["EMAIL"]["CURRENT_VALUE"] ?>">
        <input class="js_phone_class" name="<?= $arQuestions["PHONE"]["INPUT_CODE"] ?>" placeholder="<?= $arQuestions["PHONE"]["TITLE"] ?>" value="<?= $arQuestions["PHONE"]["CURRENT_VALUE"] ?>">
        <input name="<?= $arQuestions["COMPANY"]["INPUT_CODE"] ?>" placeholder="<?= $arQuestions["COMPANY"]["TITLE"] ?>" value="<?= $arQuestions["COMPANY"]["CURRENT_VALUE"] ?>">
    </div>
    <div class="c-form__selectric">
        <select name="<?= $arQuestions["THEME"]["INPUT_CODE"] ?>">
            <? foreach ($arQuestions["THEME"]["ANSWERS"] as $answer) { ?>
                <option<? if ($arQuestions["THEME"]["CURRENT_VALUE"] == $answer["ID"]) echo " selected"; ?> value="<?= $answer["ID"] ?>"><?= $answer["MESSAGE"] ?></option>
                <? } ?>
        </select>
    </div>
    <textarea placeholder="<?= $arQuestions["MESSAGE"]["TITLE"] ?>" name="<?= $arQuestions["MESSAGE"]["INPUT_CODE"] ?>" class="c-form__textarea" rows="6"><?= $arQuestions["MESSAGE"]["CURRENT_VALUE"] ?></textarea>
    <div class="c-form__personal">Нажимая на кнопку «Отправить», вы соглашаетесь с <a href="/politics/">политикой
            обработки персональных данных</a>
    </div>
    <div class="c-form__submit">
        <button name="web_form_submit" class="btn btn--large btn--rose btn-form js_send_form_callback">Отправить</button>
    </div>

    <?
    //vardump($arResult);
    //echo 'FORM_ERRORS_TEXT = ' . $arResult["FORM_ERRORS_TEXT"] . '<br />';
    ?>

    <div class="result js_result_form_callback">
        <? if ($arResult["isFormErrors"] == "Y") { ?>
            <?= $arResult["FORM_ERRORS_TEXT"]; ?>
        <? } else { ?>
            <?= $arResult["FORM_NOTE"] ?>
        <? } ?>
    </div>

    <input type="hidden" name="web_form_apply" value="Y" />

    <?= $arResult["FORM_FOOTER"] ?>

</section>

<script>
    initSelectrics();
</script>