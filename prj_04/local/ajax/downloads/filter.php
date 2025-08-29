<?

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
use Bitrix\Main\Loader;
Loader::includeModule("iblock");

$arFilter['IBLOCK_ID'] = MATERIALS;
foreach($_REQUEST as $code => $value):
    if(strpos($code,'arrFilter') !== false) {
        $fitlerExpl = explode('_',$code);
        $arFilter['PROPERTY_'.$fitlerExpl[1]][] = $value;
    }
endforeach;

$ids = [];
$ob = CIBlockElement::GetList(false,$arFilter,false,false,['ID']);
while($res = $ob->GetNext()) {
    $ids[] = $res['ID'];
}

$errors = [];
global $ajaxDownloadsFilter;
if(!empty($ids))
    $ajaxDownloadsFilter['ID'] = $ids;
else 
    $errors[] = '<h3 class="error">По заданному фильтру элементов не найдено</h3>';

if(isset($_REQUEST['NAME']) && !empty($_REQUEST['NAME']))
    $ajaxDownloadsFilter['%NAME'] = $_REQUEST['NAME'];


if(!empty($errors)) {
    foreach($errors as $error):
        echo $error;
    endforeach;
} else {
    $APPLICATION->IncludeComponent(
        "bitrix:news.list", 
        "downloads.page", 
        array(
            "ACTIVE_DATE_FORMAT" => "d.m.Y",
            "ADD_SECTIONS_CHAIN" => "Y",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "CACHE_FILTER" => "N",
            "CACHE_GROUPS" => "Y",
            "CACHE_TIME" => "36000000",
            "CACHE_TYPE" => "A",
            "CHECK_DATES" => "Y",
            "DETAIL_URL" => "",
            "DISPLAY_BOTTOM_PAGER" => "Y",
            "DISPLAY_DATE" => "Y",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "DISPLAY_TOP_PAGER" => "N",
            "FIELD_CODE" => array(
                0 => "",
                1 => "",
            ),
            "FILTER_NAME" => "ajaxDownloadsFilter",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "IBLOCK_ID" => "4",
            "IBLOCK_TYPE" => "materials",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
            "INCLUDE_SUBSECTIONS" => "Y",
            "MESSAGE_404" => "",
            "NEWS_COUNT" => "15",
            "PAGER_BASE_LINK_ENABLE" => "N",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "N",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_TEMPLATE" => ".default",
            "PAGER_TITLE" => "Новости",
            "PARENT_SECTION" => "",
            "PARENT_SECTION_CODE" => "",
            "PREVIEW_TRUNCATE_LEN" => "",
            "PROPERTY_CODE" => array(
                0 => "PRODUCT_LINES",
                1 => "MATERIAL_TYPE",
                2 => "MATERIAL_FORMAT",
                3 => "",
            ),
            "SET_BROWSER_TITLE" => "Y",
            "SET_LAST_MODIFIED" => "N",
            "SET_META_DESCRIPTION" => "Y",
            "SET_META_KEYWORDS" => "Y",
            "SET_STATUS_404" => "N",
            "SET_TITLE" => "Y",
            "SHOW_404" => "Y",
            "SORT_BY1" => "ACTIVE_FROM",
            "SORT_BY2" => "SORT",
            "SORT_ORDER1" => "DESC",
            "SORT_ORDER2" => "ASC",
            "STRICT_SECTION_CHECK" => "N",
            "COMPONENT_TEMPLATE" => "downloads.page"
        ),
        false
    );
}