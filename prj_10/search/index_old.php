<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Поиск");
?><?$APPLICATION->IncludeComponent(
	"bitrix:search.page", 
	"search-page-indexis", 
	array(
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "N",
		"DEFAULT_SORT" => "rank",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FILTER_NAME" => "",
		"NO_WORD_LOGIC" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "",
		"PAGE_RESULT_COUNT" => (empty($_GET["where"])?"999999":16),
		"RESTART" => "Y",
		"SHOW_WHEN" => "N",
		"SHOW_WHERE" => "Y",
		"USE_LANGUAGE_GUESS" => "Y",
		"USE_SUGGEST" => "Y",
		"USE_TITLE_RANK" => "N",
		"arrFILTER" => array(
			0 => "main",
			1 => "iblock_guide",
			2 => "iblock_movies",
			3 => "iblock_contests",
		),
		"arrFILTER_iblock_guide" => array(
			0 => "2",
		),
		"arrFILTER_iblock_movies" => array(
			0 => "1",
		),
		"arrFILTER_iblock_rest_entity" => array(
			0 => "all",
		),
		"arrFILTER_main" => array(
			0 => "/about/",
			1 => "/partners/",
			2 => "",
		),
		"arrWHERE" => array(
			0 => "iblock_guide",
			1 => "iblock_movies",
			2 => "iblock_contests",
		),
		"COMPONENT_TEMPLATE" => "search-page-indexis",
		"arrFILTER_iblock_contests" => array(
			0 => "4",
		)
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>