<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
{
	die();
}
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
$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();

$authorID = $APPLICATION->IncludeComponent(
	"bitrix:news.detail",
	"",
	[
		"DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
		"DISPLAY_NAME" => $arParams["DISPLAY_NAME"],
		"DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
		"DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"FIELD_CODE" => $arParams["DETAIL_FIELD_CODE"],
		"PROPERTY_CODE" => $arParams["DETAIL_PROPERTY_CODE"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"META_KEYWORDS" => $arParams["META_KEYWORDS"],
		"META_DESCRIPTION" => $arParams["META_DESCRIPTION"],
		"BROWSER_TITLE" => $arParams["BROWSER_TITLE"],
		"SET_CANONICAL_URL" => $arParams["DETAIL_SET_CANONICAL_URL"],
		"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
		"SET_TITLE" => $arParams["SET_TITLE"],
		"MESSAGE_404" => $arParams["MESSAGE_404"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"SHOW_404" => $arParams["SHOW_404"],
		"FILE_404" => $arParams["FILE_404"],
		"INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
		"ADD_SECTIONS_CHAIN" => $arParams["ADD_SECTIONS_CHAIN"],
		"ACTIVE_DATE_FORMAT" => $arParams["DETAIL_ACTIVE_DATE_FORMAT"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
		"GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
		"DISPLAY_TOP_PAGER" => $arParams["DETAIL_DISPLAY_TOP_PAGER"],
		"DISPLAY_BOTTOM_PAGER" => $arParams["DETAIL_DISPLAY_BOTTOM_PAGER"],
		"PAGER_TITLE" => $arParams["DETAIL_PAGER_TITLE"],
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => $arParams["DETAIL_PAGER_TEMPLATE"],
		"PAGER_SHOW_ALL" => $arParams["DETAIL_PAGER_SHOW_ALL"],
		"CHECK_DATES" => $arParams["CHECK_DATES"],
		"ELEMENT_ID" => $arResult["VARIABLES"]["ELEMENT_ID"],
		"ELEMENT_CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"],
		"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
		"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
		"IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
		"USE_SHARE" => $arParams["USE_SHARE"],
		"SHARE_HIDE" => $arParams["SHARE_HIDE"],
		"SHARE_TEMPLATE" => $arParams["SHARE_TEMPLATE"],
		"SHARE_HANDLERS" => $arParams["SHARE_HANDLERS"],
		"SHARE_SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
		"SHARE_SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
		"ADD_ELEMENT_CHAIN" => $arParams["ADD_ELEMENT_CHAIN"],
		'STRICT_SECTION_CHECK' => $arParams['STRICT_SECTION_CHECK'],
	],
	$component
);?>

<div id="expertContent_<?=$authorID?>" class="page__section">
	<!-- begin .section-->
	<div class="section">
			<div class="section__header">
					<div class="section__title">
							<!-- begin .title-->
							<h2 class="title title_size_h2">Статьи автора</h2>
							<!-- end .title-->
					</div>
			</div>
			<div class="section__content">
					<div class="section__cards-panel">
							<!-- no modifiers - panels take all available width, divinging equally up to three in one row-->
							<!-- promo-group_layout_l - one panel per row-->
							<!-- promo-group_layout_m - two panels per row-->
							<!-- promo-group_layout_s - three panels per row-->
							<!-- promo-group_layout_mixed - three panels every odd row, two panels every even row-->
							<!-- begin .cards-panel-->
							<?
							$GLOBALS["gazetaAuthorFilter"] = [
									"PROPERTY_AUTHORS" => [$authorID]
							];
							$GLOBALS["PAGEN_LM_DEFAULT_COUNT_1"] = !empty($arParams["NEWS_COUNT"]) ? intval($arParams["NEWS_COUNT"]) : 20;
							$newsDefaultCount = $GLOBALS["PAGEN_LM_DEFAULT_COUNT_1"];
							if($request->isAjaxRequest() && !empty($request->get("PAGEN_LM_2"))){
									$newsDefaultCount *= intval($request->get("PAGEN_LM_2"));
							}
							$APPLICATION->IncludeComponent("bitrix:news.list", "gazeta_section", array(
									"IBLOCK_TYPE" => "newspaper",
									"IBLOCK_ID" => "4",
									"NEWS_COUNT" => $newsDefaultCount,
									"SORT_BY1" => "SORT",
									"SORT_ORDER1" => "ASC",
									"SORT_BY2" => "ID",
									"SORT_ORDER2" => "ASC",
									"FILTER_NAME" => "gazetaAuthorFilter",
									"FIELD_CODE" => array(
											"NAME",
											"PREVIEW_PICTURE",
											"PREVIEW_TEXT",
									),
									"PROPERTY_CODE" => array(
											"FORMAT",
											"FAVORITE_IMAGE",
									),
									"CHECK_DATES" => "Y",
									"DETAIL_URL" => "",
									"AJAX_MODE" => "Y",
									"AJAX_OPTION_SHADOW" => "Y",
									"AJAX_OPTION_JUMP" => "N",
									"AJAX_OPTION_STYLE" => "Y",
									"AJAX_OPTION_HISTORY" => "N",
									"CACHE_TYPE" => "A",
									"CACHE_TIME" => "36000000",
									"CACHE_FILTER" => "N",
									"CACHE_GROUPS" => "Y",
									"ACTIVE_DATE_FORMAT" => "M j, Y",
									"DISPLAY_PANEL" => "N",
									"SET_TITLE" => "N",
									"SET_STATUS_404" => "N",
									"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
									"ADD_SECTIONS_CHAIN" => "N",
									"HIDE_LINK_WHEN_NO_DETAIL" => "N",
									"PARENT_SECTION" => "",
									"PARENT_SECTION_CODE" => "",
									"DISPLAY_TOP_PAGER" => "N",
									"DISPLAY_BOTTOM_PAGER" => "Y",
									"PAGER_TITLE" => "News",
									"PAGER_SHOW_ALWAYS" => "N",
									"PAGER_TEMPLATE" => "load_more",
									"PAGER_DESC_NUMBERING" => "N",
									"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000000",
									"PAGER_SHOW_ALL" => "N",
									"AJAX_OPTION_ADDITIONAL" => ""
							),
									false
							);
							?>
							<!-- end .cards-panel-->
					</div>
			</div>
	</div>
	<!-- end .section-->
</div>