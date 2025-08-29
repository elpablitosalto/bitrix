<?
define('PAGE_TYPE', 4);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Регистрация");
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

        <? if (!($USER->IsAuthorized())) { ?>
            <? $APPLICATION->IncludeComponent(
                "bitrix:main.register",
                "dirui",
                array(
                    "AUTH" => "N",
                    "REQUIRED_FIELDS" => array("EMAIL", "NAME", 'PERSONAL_MOBILE'),
                    "SET_TITLE" => "N",
                    "SHOW_FIELDS" => array('NAME', 'LAST_NAME', 'WORK_COMPANY', "WORK_POSITION", 'PERSONAL_MOBILE', 'EMAIL', "PASSWORD", "CONFIRM_PASSWORD"),
                    //"SUCCESS_PAGE" => "/personal/profile/",
                    "SUCCESS_PAGE" => '',
                    "USER_PROPERTY" => array(),
                    "USER_PROPERTY_NAME" => "",
                    "USE_BACKURL" => "N"
                )
            ); ?>
        <? } else { ?>
            Вы успешно зарегистрировались на сайте!
        <? } ?>
    </div>
</section>
<div class="popup popup-confirmation">
    <?
    $APPLICATION->IncludeComponent(
        "bitrix:main.include",
        "",
        array(
            "AREA_FILE_SHOW" => "file",
            "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/static/success_reg.php"
        )
    );
    ?>
    <button class="popup_close" type="button"></button>
</div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>