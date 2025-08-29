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

$strReturn .= '<div class="breadcrumbs">';
$strReturn .= '<ul class="breadcrumbs-list" itemscope itemtype="https://schema.org/BreadcrumbList">';
$strReturn .= '<li id="bx_breadcrumb" class="breadcrumbs-list__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="/" itemprop="item"><span itemprop="name">Главная</span></a><meta itemprop="position" content="0"></li>';

$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	$arrow = ($index > 0? '<i class="fa fa-angle-right"></i>' : '');

	if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
	{
		$strReturn .= '<li id="bx_breadcrumb_'.$index.'" class="breadcrumbs-list__item" class="breadcrumbs-list__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="'.$arResult[$index]["LINK"].'" itemprop="item"><span itemprop="name">'.$title.'</span></a><meta itemprop="position" content="'.($index + 1).'" /></li>';
	}
	else
	{
		$strReturn .= '<li class="breadcrumbs-list__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><span itemprop="item"><span itemprop="name">'.$title.'</span></span><meta itemprop="position" content="'.($index + 2).'" /></li>';
	}
}
$strReturn .= '</ul>';
$strReturn .= '</div>';

return $strReturn;
