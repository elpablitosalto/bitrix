<?
use \Bitrix\Main\Context;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Руководители проектов");
$request = Context::getCurrent()->getRequest();
$project = $request->get("project");
$city = $request->get("city");
$extParams = ["CITY" => $city, "PROJECT" => $project];

if(empty($project)) {
	if(!empty($city)) {
		$arCityProjects = $APPLICATION->IncludeComponent(
			"indexis:projects.specialist.filter",
			"",
			Array(
				"arFilter" => ['CITY' => $city],
				"DISABLE_TEMPLATE" => "Y",
				"AJAX_URL" => "",
			 	"AJAX_RESULT" => ""
			)
		  );
		$GLOBALS["arSpecProjects"] = ["PROPERTY_PROJECT_LINK" => array_keys($arCityProjects["PROJECTS"])];
	} else {
		$GLOBALS["arSpecProjects"] = ["!PROPERTY_PROJECT_LINK" => false]; // если не указаны ни project, ни city, выбираем всех специалистов, у которых поле Проекты заполнено
	}
} else {
	$GLOBALS["arSpecProjects"] = ["PROPERTY_PROJECT_LINK" => $project];

}

?>
<div class="page-content contacts-page">
	<?$APPLICATION->IncludeComponent("bitrix:main.include","",Array(
        "AREA_FILE_SHOW" => "sect", 
        "AREA_FILE_SUFFIX" => "inc", 
        "AREA_FILE_RECURSIVE" => "Y", 
        "EDIT_TEMPLATE" => "" 
    	)
	);?>
</div>
<section class="contacts-managers">
 <div class="container">
  <h3 class="section__title">Кураторы проектов</h3>
  <?$APPLICATION->IncludeComponent(
		"indexis:projects.specialist.filter",
		"contacts_filter",
		Array(
			"AJAX_URL" => "/contacts/projects_managers/ajax.php",
		 	"AJAX_RESULT" => "ajax_result"
	)
  );?>
  <div id="ajax_result">
<? 
   global $NavNum;
   $curentAjaxBlock = $NavNum+1;
   if ($request->get("AJAX_LOAD") == "Y" && $request->get("PAGEN_".$curentAjaxBlock)) {
   	$GLOBALS['APPLICATION']->RestartBuffer();
   }

   $APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"contacts_managers",
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
		"FILTER_NAME" => "arSpecProjects",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => Indexis::getIblockId("specialists", "content", "s1"),
		"IBLOCK_TYPE" => "content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "6",
		"PAGER_BASE_LINK_ENABLE" => "Y",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "show_more",
		"PAGER_TITLE" => "",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array("EMAIL","POSITION","PHONE","PROJECT_LINK"),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "NAME",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"extParams" => $extParams
	)
  );?>
<?
	if ($request->get("AJAX_LOAD") == "Y" && $request->get("PAGEN_" . $curentAjaxBlock)) {
    	die();
   	}
?>
  </div>
 </div>
</section>
<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");?>