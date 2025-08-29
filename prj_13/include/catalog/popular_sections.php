<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
?>

<?
$GLOBALS['arPopularSectionFilter'] = [
    '!UF_POPULAR' => false
];

$APPLICATION->IncludeComponent(
    "bitrix:catalog.section.list",
    "popular_sections",
    Array(
        "VIEW_MODE" => "TILE",	// Вид списка подразделов
        "SHOW_PARENT_NAME" => "Y",	// Показывать название раздела
        "IBLOCK_TYPE" => "catalog",	// Тип инфоблока
        "IBLOCK_ID" => Indexis::getIblockId('catalog', 'catalog'),	// Инфоблок
        "SECTION_ID" => "",	// ID раздела
        "SECTION_CODE" => "",	// Код раздела
        "SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
        "COUNT_ELEMENTS" => "Y",	// Показывать количество элементов в разделе
        "COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",	// Показывать количество
        "HIDE_SECTIONS_WITH_ZERO_COUNT_ELEMENTS" => "N",	// Скрывать разделы с нулевым количеством элементов
        "TOP_DEPTH" => "5",	// Максимальная отображаемая глубина разделов
        "SECTION_FIELDS" => array(	// Поля разделов
            0 => "",
            1 => "",
        ),
        "SECTION_USER_FIELDS" => array(	// Свойства разделов
            0 => "UF_POPULAR_ICON",
            1 => "",
        ),
        "ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
        "CACHE_TYPE" => "A",	// Тип кеширования
        "CACHE_TIME" => "36000000",	// Время кеширования (сек.)
        "CACHE_NOTES" => "",
        "CACHE_GROUPS" => "Y",	// Учитывать права доступа
        "COMPONENT_TEMPLATE" => "",
        "ADDITIONAL_COUNT_ELEMENTS_FILTER" => "additionalCountFilter",	// Дополнительный фильтр для подсчета количества элементов в разделе
        "FILTER_NAME" => "arPopularSectionFilter",	// Имя массива со значениями фильтра разделов
        "HIDE_SECTION_NAME" => "N",	// Не показывать названия подразделов
        "CACHE_FILTER" => "Y",	// Кешировать при установленном фильтре
        "CUSTOM_SECTION_SORT" => array("UF_POPULAR_SORT" => "ASC")
    ),
    false
);
?>