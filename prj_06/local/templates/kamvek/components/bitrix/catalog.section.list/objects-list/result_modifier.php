<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

foreach ($arResult['SECTIONS'] as &$arSection) {
	// -->
	$arSection["SECTION_PAGE_URL"] = str_replace( 
		array('/catalog/tekhnologiya-color-mix/', '/catalog/tekhnologiya-stone-top/'), 
		array('/tekhnologiya-color-mix/', '/tekhnologiya-stone-top/'), 
		$arSection["SECTION_PAGE_URL"] 
	);
	// <--
}
