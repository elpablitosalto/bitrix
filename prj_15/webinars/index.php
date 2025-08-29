<?
define('PAGE_TYPE', 2);
define('SET_OG_MARKING', 'Y');
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Бесплатные вебинары для врачей | Академия «Врач будущего»");
$APPLICATION->SetPageProperty("description", 'Вебинары по самым востребованным темам: от подходов в терапии с разбором клинических случаев до юридических аспектов взаимодействия с пациентом. Вебинары читают опытные спикеры с учеными степенями. Смотрите вебинары — расширяйте свою медицинскую базу знаний.');
$APPLICATION->SetPageProperty("keywords", 'вебинары для врачей, вебинары для врачей бесплатно, мед вебинары для врачей, вебинар по неврологии, гинекология вебинар, вебинар офтальмология');
$APPLICATION->SetPageProperty("PAGE_BODY_CLASS", 'dp-page-account');
$APPLICATION->SetPageProperty("PAGE_H1", 'Вебинары для врачей и медицинских специалистов');
$APPLICATION->SetPageProperty("PAGE_H2", 'Бесплатные вебинары по вашей специальности с разбором клинических случаев');
?>
<?
$request = \Bitrix\Main\Context::getCurrent()->getRequest();
$arGet = $request->getQueryList()->toArray(); // массив get параметров
//vardump($arGet);
//vardump($GLOBALS['USER_ORDERS']);
?>
<?
$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    array(
        "AREA_FILE_SHOW" => "file",
        "PATH" => SITE_DIR . "/local/include/materials/materials_compl_comp.php",
        "SEF_FOLDER" => "/webinars/",
        "SEF_MODE" => "Y",
        "SEF_URL_TEMPLATES" => array(
            //"detail" => "#SECTION_CODE#/#ELEMENT_CODE#/",
            "detail" => "#ELEMENT_ID#/",
            "news" => "",
            "section" => "#SECTION_CODE#/",
            "search" => "search/"
        ),
        "IBLOCK_ID" => Indexis::getIblockId("webinars", "content"),
        "DETAIL_PROPERTY_CODE" => array('THEME', 'SPECIALITY', 'USERS', 'AUTHOR', 'PRICE', 'SHOW_PRICE', 'FILE', 'VIDEO_PREVIEW', 'FILE_SHORT', 'PAID', 'BUY_LINK'),
        "LIST_PROPERTY_CODE" => array('THEME', 'PRICE', 'SHOW_PRICE', 'BUY_LINK'),
        "DETAIL_TEMPLATE" => "webinar",
        "LIST_TEMPLATE" => "webinars",
        'MATERIAL_TYPE' => "WEBINARS",
        'DETAIL_SHOW_USER_AUTHORIZED' => 'N',
        'SHOW_EMPTY_BLOCK' => 'Y',
        'OG' => array(
            'LIST_ELEMENT_CODE' => 'webinars',
            'SET' => 'Y',
        ),
        'USER_ORDERS' => $GLOBALS['USER_ORDERS'],
        'PAYMENT' => $arGet['payment'],
    )
);
?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>