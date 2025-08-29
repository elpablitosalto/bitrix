<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}
\Bitrix\Main\Page\Asset::getInstance()->addJs($templateFolder  . "/assets/moment.min.js");
\Bitrix\Main\Page\Asset::getInstance()->addJs($templateFolder  . "/assets/daterangepicker.js");
\Bitrix\Main\Page\Asset::getInstance()->addCss($templateFolder  . "/assets/daterangepicker.css");