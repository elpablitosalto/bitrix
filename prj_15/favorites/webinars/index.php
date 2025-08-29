<?
define('PAGE_TYPE', 2);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Сохранённые статьи");
$APPLICATION->SetPageProperty("PAGE_BODY_CLASS", 'dp-page-account');
$APPLICATION->SetPageProperty("PAGE_H1", 'Сохраненное');
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
            "SHOW_BACK_TO_RECOMMEND" => "N",
            "SHOW_FILTER" => "N",
            "SHOW_SORT_PANEL" => "N",
            "SHOW_TABS" => "Y",
            "SHOW_SAVED" => "Y",
            "IBLOCK_ID" => Indexis::getIblockId("webinars", "content"),
            "DETAIL_PROPERTY_CODE" => array('THEME', 'SPECIALITY', 'USERS', 'AUTHOR', 'SHOW_PRICE'),
            "LIST_PROPERTY_CODE" => array('THEME', 'PRICE', 'BUY_LINK', 'SHOW_PRICE'),
            "DETAIL_TEMPLATE" => "webinar",
            "LIST_TEMPLATE" => "webinars",
            'MATERIAL_TYPE' => "WEBINARS",
            'USER_ORDERS' => $GLOBALS['USER_ORDERS'],
        )
    ); ?>

<? } ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>