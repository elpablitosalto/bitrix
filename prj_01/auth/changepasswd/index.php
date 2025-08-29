<?
define('PAGE_TYPE', 4);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Смена пароля");
$APPLICATION->SetPageProperty("PAGE_BODY_CLASS", 'dp-page-password');
?>

<section class="authorization">
    <? $APPLICATION->IncludeComponent(
        "bitrix:system.auth.changepasswd",
        "dirui",
        array("SHOW_ERRORS" => 'Y')
    ); ?>
</section>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>