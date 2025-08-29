<?
define('PAGE_TYPE', 2);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Сохранённые мастер-классы");
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
            "SEF_FOLDER" => "/master-class/",
            "SEF_MODE" => "N",
            "SEF_URL_TEMPLATES" => array(
                //"detail" => "#SECTION_CODE#/#ELEMENT_CODE#/",
                "detail" => "#ELEMENT_CODE#/",
                "news" => "",
                "section" => "#SECTION_CODE#/",
                "search" => "search/"
            ),
            "CUSTOM_DETAIL_URL" => "/master-class/#ELEMENT_CODE#/",
            "SHOW_BACK_TO_RECOMMEND" => "N",
            "SHOW_FILTER" => "N",
            "SHOW_SORT_PANEL" => "N",
            "SHOW_TABS" => "Y",
            "SHOW_SAVED" => "Y",
            "IBLOCK_ID" => Indexis::getIblockId("master-class", "content"),
            "DETAIL_PROPERTY_CODE" => array('THEME', 'SPECIALITY', 'USERS'),
            "LIST_PROPERTY_CODE" => array('THEME', 'DATE_START', 'DATE_END', 'COUNT_MODULES', 'BUY_LINK'),
            "DETAIL_TEMPLATE" => "master_class",
            "LIST_TEMPLATE" => "master_classes",
            'MATERIAL_TYPE' => "MASTER_CLASSES",
        )
    ); ?>

<? } ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>