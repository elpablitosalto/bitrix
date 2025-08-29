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

$strReturn .= '<ul itemscope="itemscope" itemtype="http://schema.org/BreadcrumbList" class="rs__breadcrumb">';

$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	$arrow = ""; //($index > 0? '<i class="fa fa-angle-right"></i>' : '');

	if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
	{
		$strReturn .= '
			<li itemprop="itemListElement" class="rs__breadcrumb-item" itemscope="itemscope" itemtype="http://schema.org/ListItem">
				'.$arrow.'
				<a href="'.$arResult[$index]["LINK"].'" class="rs__breadcrumb-item--link" title="'.$title.'" itemscope="itemscope" itemtype="http://schema.org/Thing" itemprop="item">
					<span itemprop="name">'.$title.'</span>
					<meta itemprop="position" content="'.($index + 1).'" />
				</a>
			</li>';
	}
	else
	{
		$strReturn .= '
			<li itemprop="itemListElement" class="rs__breadcrumb-item" itemscope="itemscope" itemtype="http://schema.org/ListItem">
				'.$arrow.'
				<span class="rs__breadcrumb-item--link"><span itemprop="name">'.$title.'</span></span>
			</li>';
	}
}

$strReturn .= '</ul>';

return $strReturn;