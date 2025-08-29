<?
define('PAGE_TYPE', 3);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Профиль");
$APPLICATION->SetPageProperty("PAGE_BODY_CLASS", 'dp-page-lk-profile');
$APPLICATION->SetPageProperty("PAGE_SECTION_CLASS", 'lk lk-offer');
$APPLICATION->SetPageProperty("PAGE_HEADER_CLASS", 'lk__title');

require($_SERVER["DOCUMENT_ROOT"] . "/personal/head.php");
?>

<? if (!($USER->IsAuthorized())) { ?>
    <?
    $APPLICATION->IncludeComponent(
        "bitrix:main.include",
        "",
        array(
            "AREA_FILE_SHOW" => "file",
            "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/personal/need_auth.php"
        )
    );
    ?>
<? } else { ?>
    <?
    //$arResultFunc = CPersonal::isPartner();
    //$isPartner = $arResultFunc['isPartner'];
    ?>
    <div class="page-wrapper">
        <?
        $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            array(
                "AREA_FILE_SHOW" => "file",
                "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/personal/left.php"
            )
        );
        ?>
        <? $APPLICATION->IncludeComponent(
            "bitrix:main.profile",
            "dirui",
            array(
                "USER_PROPERTY_NAME" => "",
                "SET_TITLE" => "N",
                "AJAX_MODE" => "N",
                "USER_PROPERTY" => array(),
                "SEND_INFO" => "Y",
                "CHECK_RIGHTS" => "Y",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "AJAX_OPTION_HISTORY" => "N"
            )
        ); ?>
    </div>
<? } ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>