<?
define('CUSTOM_LAYOUT_PAGE', true);
define('PAGE_TYPE', 6);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "");
$APPLICATION->SetPageProperty("PAGE_SECTION_CLASS", 'about');
$APPLICATION->SetTitle("Обработка персональных данных");
?>

<? $APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    array(
        "AREA_FILE_SHOW" => "file",
        "PATH" => SITE_DIR . 'include/static/privacy.php',
    )
); ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>