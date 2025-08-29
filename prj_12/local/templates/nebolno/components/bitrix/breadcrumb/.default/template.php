<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

//delayed function must return a string
if(empty($arResult))
	return "";

$strReturn = '';

$strReturn .= '<div class="nb-breadcrumbs"><div class="container"><ul class="nb-breadcrumbs__list" itemscope itemtype="http://schema.org/BreadcrumbList">';

$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);

	if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
	{
		$strReturn .= '
			<li class="nb-breadcrumbs__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
				'.$arrow.'
				<a href="'.$arResult[$index]["LINK"].'" class="nb-breadcrumbs__link" itemprop="name">'.$title.'</a>
			</li>';
	}
	else
	{
		$strReturn .= '
			<li class="nb-breadcrumbs__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
				'.$arrow.'
				<span class="nb-breadcrumbs__link" itemprop="name">'.$title.'</span>
			</li>';
	}
}

$strReturn .= '</ul><a class="nb-breadcrumbs__back" href="javascript:window.history.back();">На предыдущую страницу</a></div></div>';

return $strReturn;
