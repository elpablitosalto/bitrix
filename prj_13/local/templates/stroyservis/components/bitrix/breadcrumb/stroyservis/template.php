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
$strReturn .= '<div class="breadcrumbs"><ul class="breadcrumbs__list" itemscope="itemscope" itemtype="https://schema.org/BreadcrumbList">';

$itemSize = count($arResult);
$parentSectionTitle = '';
$parentSectionUrl = '';
for ($index = 0; $index < $itemSize; $index++) {
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	if ($arResult[$index]["LINK"] <> "" && ($index != $itemSize - 1)) {
		$strReturn .= '
			<li class="breadcrumbs__item" itemprop="itemListElement" itemscope="itemscope" itemtype="https://schema.org/ListItem">
				<a class="breadcrumbs__link" title="' . $title . '" itemprop="item" href="' . $arResult[$index]["LINK"] . '">
					<span itemprop="name">' . $title . '</span>
					<meta itemprop="position" content="' . $index . '" />
				</a>
			</li>
	  	';
        $parentSectionTitle = $title;
        $parentSectionUrl = $arResult[$index]["LINK"];
	} else {
		if (($index != $itemSize - 1)) {
			$strReturn .= '<li class="breadcrumbs__item">' . $title . '</li>';
		}
	}
}
$strReturn .= '</ul></div><a class="page-title__back" href="' . $parentSectionUrl . '">' . $parentSectionTitle . '</a>';

return $strReturn;
