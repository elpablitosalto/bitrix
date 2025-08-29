<?
define('PAGE_TYPE', 3);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Сделать заказ");
$APPLICATION->SetPageProperty("PAGE_BODY_CLASS", 'dp-page-lk-price');
$APPLICATION->SetPageProperty("PAGE_SECTION_CLASS", 'lk lk-order');
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
    $arResultFunc = CPersonal::isPartner();
    $isPartner = $arResultFunc['isPartner'];
    ?>
    <? if (!$isPartner) { ?>
        <?
        $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            array(
                "AREA_FILE_SHOW" => "file",
                "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/personal/need_auth_partner.php"
            )
        );
        ?>
    <? } else { ?>
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
            <?
            $APPLICATION->IncludeComponent(
                "dirui:order",
                "",
                array(
                    "IBLOCK_ID_BASKET" => Indexis::getIblockId('orders_reagents', 'orders'),
                    //"IBLOCK_ID_PRODUCTS" => Indexis::getIblockId('orders_reagents', 'orders'),
                    "USER_ID" => $USER->GetID(),
                    "CUR_DIRECTION" => $_REQUEST['DIRECTION'],
                    "CUR_PRODUCT_TYPE" => $_REQUEST['PRODUCT_TYPE'],
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "3600",
                )
            );
            ?>
        </div>
    <? } ?>
<? } ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>