<?
define('PAGE_TYPE', 2);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Вебинары");
$APPLICATION->SetPageProperty("PAGE_BODY_CLASS", 'dp-page-account dp-page-account-recommendations');
$APPLICATION->SetPageProperty("PAGE_H1", 'Рекомендованные вебинары');
?>

<? if (!$USER->IsAuthorized()) { ?>
    <? ShowError('Необходимо авторизоваться'); ?>
<? } else { ?>
    <? $APPLICATION->IncludeComponent(
        "bitrix:main.include",
        "",
        array(
            "AREA_FILE_SHOW" => "file",
            "PATH" => SITE_DIR . "/local/include/materials/materials_compl_comp.php",
            "SEF_FOLDER" => "/webinars/",
            "SEF_MODE" => "N",
            "SEF_URL_TEMPLATES" => array(
                //"detail" => "#SECTION_CODE#/#ELEMENT_CODE#/",
                "detail" => "#ELEMENT_ID#/",
                "news" => "",
                "section" => "#SECTION_CODE#/",
                "search" => "search/"
            ),
            "CUSTOM_DETAIL_URL" => "/webinars/#ELEMENT_ID#/",
            "SHOW_BACK_TO_RECOMMEND" => "Y",
            "IBLOCK_ID" => Indexis::getIblockId("webinars", "content"),
            "DETAIL_PROPERTY_CODE" => array('THEME', 'SPECIALITY', 'USERS', 'AUTHOR', 'SHOW_PRICE'),
            "LIST_PROPERTY_CODE" => array('THEME', 'PRICE', 'BUY_LINK', 'SHOW_PRICE'),
            "DETAIL_TEMPLATE" => "webinar",
            "LIST_TEMPLATE" => "webinars",
            'MATERIAL_TYPE' => "WEBINARS",
            'NEWS_COUNT' => 20,
            'USER_ORDERS' => $GLOBALS['USER_ORDERS'],
            )
    ); ?>
<? } ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>