<?
define('PAGE_TYPE', 2);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

if (!$USER->IsAuthorized())
    LocalRedirect("/");

$APPLICATION->SetTitle("Профиль");
$APPLICATION->SetPageProperty("PAGE_BODY_CLASS", 'dp-page-account');
$APPLICATION->SetPageProperty("PAGE_H1", 'Профиль');
?>

<? $APPLICATION->IncludeComponent(
    "indexis:profile",
    "",
    array(
    )
); ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>