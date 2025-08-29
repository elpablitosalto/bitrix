<?
define('PAGE_TYPE', 3);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Клинические рекомендации");
$APPLICATION->SetPageProperty("PAGE_SECTION_CLASS", 'recommendation');
$APPLICATION->SetPageProperty("PAGE_BODY_CLASS", 'dp-page-recommendation');
?>

<?
if ($GLOBALS['arUser']['isPartner'] || $GLOBALS['arUser']['isAdmin']) {
?>
    <?
    $APPLICATION->IncludeComponent(
        "bitrix:main.include",
        "",
        array(
            "AREA_FILE_SHOW" => "file",
            "PATH" => SITE_DIR . "/knowledge/clinical/templ.php",
            "IBLOCK_ID" => Indexis::getIblockId("clinical", "knowledge"),
            "FILTER_NAME" => "arrFilterClinical",
        )
    );
    ?>
<? } else { ?>
    <? if (!$GLOBALS['arUser']['isAuthorized']) { ?>
        <? $APPLICATION->IncludeComponent(
            "bitrix:system.auth.form",
            "popup",
            array(
                "REGISTER_URL" => "register.php",
                "FORGOT_PASSWORD_URL" => "",
                "PROFILE_URL" => "profile.php",
                "SHOW_ERRORS" => "Y",
                "CHECK_AUTH" => "Y",
            )
        ); ?>
    <? } else {
    ?>
        <? $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            array(
                "AREA_FILE_SHOW" => "file",
                "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/common/reg_partner.php"
            )
        ); ?>
        <?
    } ?>
<? } ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>