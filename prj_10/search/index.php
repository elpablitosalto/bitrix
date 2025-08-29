<?
define('CUSTOM_LAYOUT_PAGE', true);
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
?>

<? $APPLICATION->IncludeComponent(
    "bitrix:main.include", ".default",
    array(
        "AREA_FILE_SHOW" => "file",
        "COMPONENT_TEMPLATE" => ".default",
        "EDIT_TEMPLATE" => "",
        "PATH" => SITE_DIR . "/include/search/search_page.php"
    )
); ?>



<?
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
?>

