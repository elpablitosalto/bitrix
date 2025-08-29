<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => 'targeted-assistance.filter',
	"DESCRIPTION" => 'targeted-assistance.filter',
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