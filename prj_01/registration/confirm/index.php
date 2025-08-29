<?
define('PAGE_TYPE', 4);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Подтверждение регистрации");
$APPLICATION->SetPageProperty("PAGE_BODY_CLASS", 'dp-page-registration');
?>

<section class="registration">
    <div class="registration__wrapper">
        <?
        $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            array(
                "AREA_FILE_SHOW" => "file",
                "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/static/what_reg_give.php"
            )
        );
        ?>

        <? $APPLICATION->IncludeComponent(
            "bitrix:system.auth.confirmation",
            "dirui",
            array(
                "USER_ID" => "confirm_user_id",
                "CONFIRM_CODE" => "confirm_code",
                "LOGIN" => "login"
            )
        ); ?>
    </div>
</section>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>