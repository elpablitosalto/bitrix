<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "CONCEPT  | Профессиональная косметика для волос");
$APPLICATION->SetTitle("Форма оставить заявку");
?>
<section class="content">
    <?$APPLICATION->IncludeComponent(
        "bitrix:iblock.element.add.form",
        "order_request",
        array(
            "SEF_MODE" => "Y",
            "IBLOCK_TYPE" => "forms",
            "IBLOCK_ID" => "31",
            "PROPERTY_CODES" => array(
                0 => "116",
                1 => "117",
                2 => "118",
                3 => "119",
                4 => "120",
            ),
            "PROPERTY_CODES_REQUIRED" => array(
                0 => "116",
                1 => "117",
                2 => "118",
                3 => "119",
                4 => "120",
            ),
            "GROUPS" => array(
                0 => "2",
            ),
            "STATUS_NEW" => "N",
            "STATUS" => "ANY",
            "LIST_URL" => "",
            "ELEMENT_ASSOC" => "CREATED_BY",
            "ELEMENT_ASSOC_PROPERTY" => "",
            "MAX_USER_ENTRIES" => "100000",
            "MAX_LEVELS" => "100000",
            "LEVEL_LAST" => "Y",
            "USE_CAPTCHA" => "Y",
            "USER_MESSAGE_EDIT" => "",
            "USER_MESSAGE_ADD" => "",
            "DEFAULT_INPUT_SIZE" => "30",
            "RESIZE_IMAGES" => "Y",
            "MAX_FILE_SIZE" => "0",
            "PREVIEW_TEXT_USE_HTML_EDITOR" => "Y",
            "DETAIL_TEXT_USE_HTML_EDITOR" => "Y",
            "CUSTOM_TITLE_NAME" => "",
            "CUSTOM_TITLE_TAGS" => "",
            "CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
            "CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
            "CUSTOM_TITLE_IBLOCK_SECTION" => "",
            "CUSTOM_TITLE_PREVIEW_TEXT" => "",
            "CUSTOM_TITLE_PREVIEW_PICTURE" => "",
            "CUSTOM_TITLE_DETAIL_TEXT" => "",
            "CUSTOM_TITLE_DETAIL_PICTURE" => "",
            "SEF_FOLDER" => "/",
            "COMPONENT_TEMPLATE" => "order_request"
        ),
        false
    );?>
</section>
<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>