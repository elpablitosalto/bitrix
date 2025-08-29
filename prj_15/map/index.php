<?
//define('PAGE_TYPE', 2);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Карта сайта");
$APPLICATION->SetPageProperty("PAGE_BODY_CLASS", 'dp-page-account');
$APPLICATION->SetPageProperty("PAGE_H1", 'Карта сайта');
?>

<? $APPLICATION->IncludeComponent(
    "bitrix:main.map",
    "",
    array(
        "LEVEL" => "3",
        "COL_NUM" => "1",
        "SHOW_DESCRIPTION" => "Y",
        "SET_TITLE" => "Y",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600"
    )
); ?>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>