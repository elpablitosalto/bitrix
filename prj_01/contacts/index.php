<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");
\Bitrix\Main\Page\Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/contacts.js");
\Bitrix\Main\Page\Asset::getInstance()->addString('<script data-skip-moving="true" src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;amp;apikey=&lt;ваш API-ключ&gt;" type="text/javascript"></script>');
?>

    <section class="contacts">
        <h2><? $APPLICATION->ShowTitle(false) ?></h2>
        <h3>Офис</h3>
        <?
        $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            array(
                "AREA_FILE_SHOW" => "file",
                "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/contacts/contacts.php"
            )
        ); ?>
        <div class="contacts-map" id="contacts-map"></div>
    </section>

<? $APPLICATION->IncludeComponent("bitrix:form.result.new", "callback", array(
        "SEF_MODE" => "N",
        "WEB_FORM_ID" => 1,
        "LIST_URL" => "",
        "EDIT_URL" => "",
        "SUCCESS_URL" => "",
        "CHAIN_ITEM_TEXT" => "",
        "CHAIN_ITEM_LINK" => "",
        "IGNORE_CUSTOM_TEMPLATE" => "Y",
        "USE_EXTENDED_ERRORS" => "Y",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
        "VARIABLE_ALIASES" => array(),
        "AJAX_MODE" => "Y",
        "AJAX_OPTION_SHADOW" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
    )
); ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>