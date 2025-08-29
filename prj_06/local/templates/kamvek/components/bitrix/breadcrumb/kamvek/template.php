<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

//delayed function must return a string
if (empty($arResult))
	return "";

//vardump($arResult);

$strReturn = '';

//we can't use $APPLICATION->SetAdditionalCSS() here because we are inside the buffered function GetNavChain()
$strReturn .= '<div id="BreadcrumbTrails" class="noprint">
<ol class="breadcrumbTrail " itemscope="" itemtype="https://schema.org/BreadcrumbList">';

$itemSize = count($arResult);
for ($index = 0; $index < $itemSize; $index++) {
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	if ($arResult[$index]["LINK"] <> "" && $index != $itemSize - 1) {
		$strReturn .= '
			<li itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">
			<a href="' . $arResult[$index]["LINK"] . '" title="' . $title . '" itemscope="" itemtype="https://schema.org/WebPage" itemprop="item" itemid="' . $arResult[$index]["LINK"] . '">
				<span itemprop="name">' . $title . '</span>
			</a>
			<meta itemprop="position" content="' . $index . '">
			›
			</li>
	  	';
	} else {
		//$strReturn .= '<li class="breadcrumbs__item">' . $title . '</li>';
		$strReturn .= '<li itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">';
		if ($arResult[$index]["LINK"] <> "") {
			$strReturn .= '<a href="' . $arResult[$index]["LINK"] . '" title="' . $title . '" itemscope="" itemtype="https://schema.org/WebPage" itemprop="item" itemid="' . $arResult[$index]["LINK"] . '">';
		}
		$strReturn .= '<span itemprop="name">' . $title . '</span>';
		if ($arResult[$index]["LINK"] <> "") {
			$strReturn .= '</a>';
		}
		$strReturn .= '<meta itemprop="position" content="' . $index . '">';
		$strReturn .= '</li>';
	}
}
$strReturn .= '</ol></div>';

return $strReturn;
