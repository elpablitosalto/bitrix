<?
define('CUSTOM_LAYOUT_PAGE', true);
define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Бонусы и скидки");
$APPLICATION->SetPageProperty("PAGE_SECTION_CLASS", "page-title__red");
?>

<?
$APPLICATION->IncludeFile(
    SITE_DIR . 'include/personal/menu.php',
    array(),
    array('SHOW_BORDER' => false)
);
?>

<?
$APPLICATION->IncludeComponent(
    "indexis:bonus.manage",
    "",
    Array(
        'USER_ID' => $USER->GetID(),
        'MIN_WITHDRAW' => $GLOBALS['arSiteConfig']['BONUS_MIN_WITHDRAW']
    )
);
?>

<?
$APPLICATION->IncludeComponent(
    "indexis:bonus.transaction.list",
    "",
    Array(
        'USER_ID' => $USER->GetID(),
        'TRANSACTION_COUNT' => 20
    )
);
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>