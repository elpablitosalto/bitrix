<?
define('PAGE_TYPE', 2);
define('SET_OG_MARKING', 'Y');
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Медицинские статьи для врачей | Академия «Врач будущего»");
$APPLICATION->SetPageProperty("description", 'Делимся информацией о новых подходах в терапии, новостями медицины. Полезными материалами по общению врача с пациентом и методами саморегуляци для медицинских работников. Расширяйте вашу медицинскую базу знаний в своей специальности. Развивайте клиническое мышление.');
$APPLICATION->SetPageProperty("keywords", 'курсы для врачей, бесплатные курсы для врачей, вебинары для врачей, мастер классы для врачей, курсы для докторов, лекции для врачей, курсы для медиков, курсы для терапевтов');
$APPLICATION->SetPageProperty("PAGE_BODY_CLASS", 'dp-page-account');
$APPLICATION->SetPageProperty("PAGE_H1", 'Статьи для врачей и медицинских специалистов');
$APPLICATION->SetPageProperty("PAGE_H2", 'Бесплатная библиотека знаний для врачей и медицинских специалистов');

$filterIblocks = $GLOBALS['arSiteConfig']['FILTER']['IBLOCKS'];
$resultFunc = CFilter::getFilterThemes(array(
    'filterIblocks' => $filterIblocks
));
$arInput = $resultFunc['arInput'];
$articlesFilterEffect = ["PROPERTY_THEME" => $arInput["THEMES_EFECTIVNESS"]];
//vardump($articlesFilterEffect);
?>

<?
$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    array(
        "AREA_FILE_SHOW" => "file",
        "PATH" => SITE_DIR . "/local/include/materials/materials_compl_comp.php",
        "SEF_FOLDER" => "/blog/",
        "SEF_MODE" => "Y",
        "SEF_URL_TEMPLATES" => array(
            //"detail" => "#SECTION_CODE#/#ELEMENT_CODE#/",
            "detail" => "#ELEMENT_CODE#/",
            "news" => "",
            "section" => "#SECTION_CODE#/",
            "search" => "search/"
        ),
        "IBLOCK_ID" => Indexis::getIblockId("articles", "content"),
        "DETAIL_PROPERTY_CODE" => array('THEME', 'SPECIALITY', 'USERS', 'AUTHOR', 'HIDE_DETAIL_FOR_GUESTS'),
        "LIST_PROPERTY_CODE" => array('THEME'),
        "DETAIL_TEMPLATE" => "article",
        "LIST_TEMPLATE" => "articles",
        'MATERIAL_TYPE' => "ARTICLES",
        'SHOW_EMPTY_BLOCK' => 'Y',
        'OG' => array(
            'LIST_ELEMENT_CODE' => 'blog',
            'SET' => 'Y',
        ),
        //'H1' => 'Статьи для врачей и медицинских специалистов',
    )
);
?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>