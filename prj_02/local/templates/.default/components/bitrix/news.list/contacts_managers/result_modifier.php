<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */


foreach($arResult["ITEMS"] as &$item){
    if($item["PREVIEW_PICTURE"]["ID"] > 0){
        $file = CFile::ResizeImageGet($item["PREVIEW_PICTURE"]["ID"], array('width'=>370, 'height'=>439), BX_RESIZE_IMAGE_PROPORTIONAL, true);
        $item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"] = $file['src'];
    }
}

// получить названия и адреса проектов
$arCityProjects = $APPLICATION->IncludeComponent(
	"indexis:projects.specialist.filter",
	"",
	Array(
		"DISABLE_TEMPLATE" => "Y",
		"AJAX_URL" => "",
	 	"AJAX_RESULT" => ""
	)
  );
foreach($arCityProjects["CITIES"] as $cityCode => $city) {
	foreach($city["PROJECTS"] as $projectID => $project) {
		if (
			(empty($arParams["extParams"]['CITY']) && empty($arParams["extParams"]['PROJECT'])) 
			||
			(!empty($arParams["extParams"]['CITY']) && ($arParams["extParams"]['CITY'] == $cityCode)) 
			||
			(!empty($arParams["extParams"]['PROJECT']) && ($arParams["extParams"]['PROJECT'] == $projectID)) 
		) {
			$arResult["PROJECTS"][$projectID]["ADDRESS"] = $city["NAME"];
			$arResult["PROJECTS"][$projectID]["NAME"] = $project;
		}
	}
}
?>