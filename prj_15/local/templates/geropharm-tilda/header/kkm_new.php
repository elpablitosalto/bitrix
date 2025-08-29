<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
use \Bitrix\Main\Page\Asset;

Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/kkm-landing-styles.css");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/kkm-landing-script.js");
