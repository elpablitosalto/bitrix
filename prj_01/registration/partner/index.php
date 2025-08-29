<?
define('PAGE_TYPE', 4);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Регистрация партнёра");
$APPLICATION->SetPageProperty("PAGE_BODY_CLASS", 'dp-page-partners-reg');
?>

<section class="registration">
    <div class="registration__wrapper">
        <?
        $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            array(
                "AREA_FILE_SHOW" => "file",
                "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/static/what_partnership_give.php"
            )
        );
        ?>

        <? $APPLICATION->IncludeComponent(
            "bitrix:main.register",
            "partner",
            array(
                "AUTH" => "N",
                "REQUIRED_FIELDS" => array('NAME', 'LAST_NAME', 'WORK_COMPANY', 'PERSONAL_MOBILE', 'EMAIL'/*, "PASSWORD", "CONFIRM_PASSWORD"*/),
                "SET_TITLE" => "N",
                "SHOW_FIELDS" => array('NAME', 'LAST_NAME', 'WORK_COMPANY', "WORK_POSITION", 'PERSONAL_MOBILE', 'EMAIL', "UF_PARTNER"/*, "PASSWORD", "CONFIRM_PASSWORD"*/),
                //"SUCCESS_PAGE" => "/personal/profile/",
                "SUCCESS_PAGE" => '',
                "USER_PROPERTY" => array(),
                "USER_PROPERTY_NAME" => "",
                "USE_BACKURL" => "N",
                "USER_PROPERTY_NAME" => "UF_PARTNER",
            )
        ); ?>
    </div>
</section>
<div class="popup popup-confirmation">
    <?
    $APPLICATION->IncludeComponent(
        "bitrix:main.include",
        "",
        array(
            "AREA_FILE_SHOW" => "file",
            "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/static/success_reg_partner.php"
        )
    );
    ?>
    <button class="popup_close" type="button"></button>
</div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>