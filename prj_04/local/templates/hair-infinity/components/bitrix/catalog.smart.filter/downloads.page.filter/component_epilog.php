<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$asset = \Bitrix\Main\Page\Asset::getInstance();
$asset->addCss(SITE_TEMPLATE_PATH . "/mockup/dist/assets/components/choices/styles/choices.min.css");
$asset->addJs(SITE_TEMPLATE_PATH . "/mockup/dist/assets/components/choices/scripts/choices.min.js");