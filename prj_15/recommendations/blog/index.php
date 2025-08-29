<?
define('PAGE_TYPE', 2);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Рекомендованные статьи");
$APPLICATION->SetPageProperty("PAGE_BODY_CLASS", 'dp-page-account dp-page-account-recommendations');
$APPLICATION->SetPageProperty("PAGE_H1", 'Рекомендованные статьи');
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
            "SEF_FOLDER" => "/blog/",
            "SEF_MODE" => "N",
            "SEF_URL_TEMPLATES" => array(
                //"detail" => "#SECTION_CODE#/#ELEMENT_CODE#/",
                "detail" => "#ELEMENT_CODE#/",
                "news" => "",
                "section" => "#SECTION_CODE#/",
                "search" => "search/"
            ),
            "CUSTOM_DETAIL_URL" => "/blog/#ELEMENT_CODE#/",
            "SHOW_BACK_TO_RECOMMEND" => "Y",
            "IBLOCK_ID" => Indexis::getIblockId("articles", "content"),
            "DETAIL_PROPERTY_CODE" => array('THEME', 'SPECIALITY', 'USERS', 'AUTHOR'),
            "LIST_PROPERTY_CODE" => array('THEME'),
            "DETAIL_TEMPLATE" => "article",
            "LIST_TEMPLATE" => "articles",
            'MATERIAL_TYPE' => "ARTICLES",
            )
    ); ?>
<? } ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>