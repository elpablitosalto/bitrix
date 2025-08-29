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

$strReturn .= '<div class="breadcrumbs"><ul class="breadcrumbs__list" itemscope="itemscope" itemtype="https://schema.org/BreadcrumbList">';

$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	$arrow = ""; //($index > 0? '<i class="fa fa-angle-right"></i>' : '');

	if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
	{
		$strReturn .= '
			<li class="breadcrumbs__item" itemprop="itemListElement" itemscope="itemscope" itemtype="http://schema.org/ListItem">
				'.$arrow.'
				<a class="breadcrumbs__link" href="'.$arResult[$index]["LINK"].'" title="'.$title.'" itemscope="itemscope" itemtype="http://schema.org/Thing" itemprop="item">
					<span itemprop="name">'.$title.'</span>
					<meta itemprop="position" content="'.($index + 1).'" />
				</a>
			</li>';
	}
	else
	{
		$strReturn .= '
			<li class="breadcrumbs__item" itemprop="itemListElement" itemscope="itemscope" itemtype="http://schema.org/ListItem">
				'.$arrow.'
				<span itemprop="name">'.$title.'</span>
				<meta itemprop="position" content="'.($index + 1).'" />
			</li>';
	}
}

$strReturn .= '</ul></div>';

return $strReturn;
