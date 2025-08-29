<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

$this->setFrameMode(true);
?>
<? $APPLICATION->IncludeComponent(
  "bitrix:news.detail",
  "about",
  array(
    "DISPLAY_DATE" => "N",
    "DISPLAY_NAME" => "N",
    "DISPLAY_PICTURE" => "Y",
    "DISPLAY_PREVIEW_TEXT" => "N",
    "USE_SHARE" => "N",
    "SHARE_HIDE" => "Y",
    "SHARE_TEMPLATE" => "",
    "SHARE_HANDLERS" => array("delicious"),
    "SHARE_SHORTEN_URL_LOGIN" => "",
    "SHARE_SHORTEN_URL_KEY" => "",
    "AJAX_MODE" => "N",
    "IBLOCK_TYPE" => 'catalog',
    "IBLOCK_ID" => Indexis::getIblockId('intro', 'catalog'),
    "ELEMENT_ID" => "",
    "ELEMENT_CODE" => "catalog_intro",
    "CHECK_DATES" => "Y",
    "FIELD_CODE" => array("ID", 'NAME', 'DETAIL_PICTURE', 'DETAIL_TEXT'),
    "PROPERTY_CODE" => array("H_2", 'IMAGES'),
    "IBLOCK_URL" => "news.php?ID=#IBLOCK_ID#\"",
    "DETAIL_URL" => "",
    "SET_TITLE" => "Y",
    "SET_CANONICAL_URL" => "Y",
    "SET_BROWSER_TITLE" => "Y",
    "BROWSER_TITLE" => "-",
    "SET_META_KEYWORDS" => "Y",
    "META_KEYWORDS" => "-",
    "SET_META_DESCRIPTION" => "Y",
    "META_DESCRIPTION" => "-",
    "SET_STATUS_404" => "N",
    "SET_LAST_MODIFIED" => "N",
    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
    "ADD_SECTIONS_CHAIN" => "N",
    "ADD_ELEMENT_CHAIN" => "N",
    "ACTIVE_DATE_FORMAT" => "d.m.Y",
    "USE_PERMISSIONS" => "N",
    "GROUP_PERMISSIONS" => array("1"),
    "CACHE_TYPE" => "A",
    "CACHE_TIME" => "3600",
    "CACHE_GROUPS" => "Y",
    "DISPLAY_TOP_PAGER" => "N",
    "DISPLAY_BOTTOM_PAGER" => "N",
    "PAGER_TITLE" => "Страница",
    "PAGER_TEMPLATE" => "",
    "PAGER_SHOW_ALL" => "N",
    "PAGER_BASE_LINK_ENABLE" => "Y",
    "SHOW_404" => "N",
    "MESSAGE_404" => "",
    "STRICT_SECTION_CHECK" => "Y",
    "PAGER_BASE_LINK" => "",
    "PAGER_PARAMS_NAME" => "arrPager",
    "AJAX_OPTION_JUMP" => "N",
    "AJAX_OPTION_STYLE" => "Y",
    "AJAX_OPTION_HISTORY" => "N"
  )
); ?>

<?
//vardump($_REQUEST);
//vardump($arResult);
$SECTION_CODE = $arResult['VARIABLES']['SECTION_CODE'];
?>

<? $APPLICATION->IncludeComponent(
  "bitrix:catalog.section.list",
  "catalog_main",
  array(
    "ADDITIONAL_COUNT_ELEMENTS_FILTER" => "additionalCountFilter",
    "VIEW_MODE" => "TEXT",
    "SHOW_PARENT_NAME" => "Y",
    "IBLOCK_TYPE" => "",
    "IBLOCK_ID" => Indexis::getIblockId("products", 'catalog'),
    "SECTION_ID" => "",
    "SECTION_CODE" => $SECTION_CODE,
    "SECTION_URL" => "",
    "COUNT_ELEMENTS" => "N",
    "COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
    "HIDE_SECTIONS_WITH_ZERO_COUNT_ELEMENTS" => "Y",
    "TOP_DEPTH" => "1",
    "SECTION_FIELDS" => "",
    "SECTION_USER_FIELDS" => "",
    "ADD_SECTIONS_CHAIN" => "N",
    "CACHE_TYPE" => "A",
    "CACHE_TIME" => "36000000",
    "CACHE_NOTES" => "",
    "CACHE_GROUPS" => "Y"
  )
); ?>