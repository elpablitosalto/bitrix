<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
?>
<? $APPLICATION->IncludeComponent(
    "bitrix:form.result.new",
    "question",
    array(
        "SEF_MODE" => "N",
        "WEB_FORM_ID" => $GLOBALS["arSiteConfig"]["WEB_FORM_ID_QUESTION"],
        //"LIST_URL" => "result_list.php",
        "LIST_URL" => "",
        //"EDIT_URL" => "result_edit.php",
        "EDIT_URL" => "",
        "SUCCESS_URL" => "",
        "CHAIN_ITEM_TEXT" => "",
        "CHAIN_ITEM_LINK" => "",
        "IGNORE_CUSTOM_TEMPLATE" => "Y",
        "USE_EXTENDED_ERRORS" => "Y",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
        "SEF_FOLDER" => "/",
        "VARIABLE_ALIASES" => array(),
        /* 
        "AJAX_MODE" => "Y",
        "AJAX_OPTION_SHADOW" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        /**/
    )
); ?>
<?/*?>
<div class="faq-form">
    <p class="faq-form__title">Не нашли ответа на свой вопрос?</p>
    <div class="faq-form__wrapper">
        <label class="visually-hidden" for="faq-form__name">Ваше имя*</label>
        <input class="faq-form__input" id="faq-form__name" type="text" name="name" placeholder="Ваше имя*" required>
        <label class="visually-hidden" for="faq-form__phone">Телефон*</label>
        <input class="faq-form__input" id="faq-form__phone" type="number" name="phone" placeholder="Телефон*" required>
        <label class="visually-hidden" for="faq-form__email">E-mail*</label>
        <input class="faq-form__input" id="faq-form__email" type="email" name="email" placeholder="E-mail*" required>
        <label class="visually-hidden" for="faq-form__textarea">Ваш вопрос</label>
        <textarea class="faq-form__textarea" id="faq-form__textarea" name="text" placeholder="Ваш вопрос"></textarea>
    </div>
    <p class="faq-form__policy">Нажимая кнопку Отправить, вы даете согласие на <a href="#">обработку персональных данных</a>
    </p>
    <button class="faq-form__submit" type="submit">Отправить</button>
</div>
<?*/ ?>