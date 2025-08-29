<?
use \Bitrix\Main\Context;
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

if (CModule::IncludeModule("iblock")) {

$baseLink = $_POST["baseLink"];
if (mb_strpos($baseLink,'?') === false) {
	$delim = '?';
} else {
	$delim = '&';
}

$request = Context::getCurrent()->getRequest();
$thCategory = $_POST["th"];
$needCategory = $_POST["need"];
$extParams = ["NEED_CATEGORY" => $needCategory, "ITEM_CATEGORY" => $thCategory];  
$GLOBALS['helpFilter'] = ['PROPERTY_CLOSED_VALUE' => 'Да'];

if(strlen($needCategory) > 0) {
	$GLOBALS['helpFilter']["PROPERTY_NEED_CATEGORY"] = $needCategory;
}
if(strlen($thCategory) > 0) {
	$GLOBALS['helpFilter']["PROPERTY_ITEM_CATEGORY"] = $thCategory;
}

// фильтр, как должен был выглядеть

/*TODO*/
// При установке фильтра по множественному значению типа справочник для news.list получаю ошибку:
// MySQL Query Error!
// Ниже "заплатка". CIBlockElement::GetList с этим фильтром работает корректно, необходимо дальнейшее выяснение причины 

	$IDs = [];
	$arFilter = [
	    "IBLOCK_ID"=> Indexis::getIblockId("targeted-assistance", "content", "s1"),   
	];
    $arFilter = array_merge($arFilter, $GLOBALS['helpFilter']);
    $arSelect = ["ID"];
    $res = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);

	while($item = $res->fetch()) {  
		$IDs[] = $item['ID'];
	}

	if (count($IDs)<1) {$IDs = false;}
	$GLOBALS['helpFilter'] = ['ID' => $IDs];

/*TODO*/


 global $NavNum;
 $curentAjaxBlock = $NavNum+1;
 if ($request->get("AJAX_LOAD") == "Y" && $request->get("PAGEN_".$curentAjaxBlock)) {
    $GLOBALS['APPLICATION']->RestartBuffer();
 }

$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"how_to_help",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
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
		"FIELD_CODE" => array("",""),
		"FILTER_NAME" => "helpFilter",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => Indexis::getIblockId("targeted-assistance","content"),
		"IBLOCK_TYPE" => "content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "9",
		"PAGER_BASE_LINK_ENABLE" => "Y",
		"PAGER_BASE_LINK" => $baseLink,
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "show_more",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array("CLOSED","ITEM","ITEM_CATEGORY","ITEM_NAME","ITEM_CLOSED",""),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "ACTIVE_FROM",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "DESC",
		"STRICT_SECTION_CHECK" => "N",
		"extParams" => $extParams
	)
  );

}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");

?>

