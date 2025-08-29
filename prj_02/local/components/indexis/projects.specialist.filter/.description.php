<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => 'projects.specialist.filter',
	"DESCRIPTION" => 'projects.specialist.filter',
	"ICON" => "/images/search_form.gif",
	"CACHE_PATH" => "Y",
	"PATH" => array(
		"ID" => "utility",
		"CHILD" => array(
			"ID" => "search",
			"NAME" => 'search'
		)
	),
);

?>