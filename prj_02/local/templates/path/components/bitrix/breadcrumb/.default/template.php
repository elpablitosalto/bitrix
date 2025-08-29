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

$strReturn .= '<ul itemscope="itemscope" itemtype="http://schema.org/BreadcrumbList" class="breadcrumb">';

$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	$arrow = ""; //($index > 0? '<i class="fa fa-angle-right"></i>' : '');

	if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
	{
		$strReturn .= '
			<li itemprop="itemListElement" itemscope="itemscope" itemtype="http://schema.org/ListItem">
				'.$arrow.'
				<a href="'.$arResult[$index]["LINK"].'" title="'.$title.'" itemscope="itemscope" itemtype="http://schema.org/Thing" itemprop="item">
					<u itemprop="name">'.$title.'</u>
					<meta itemprop="position" content="'.($index + 1).'" />
				</a>
			</li>';
	}
	else
	{
		$strReturn .= '
			<li itemprop="itemListElement" itemscope="itemscope" itemtype="http://schema.org/ListItem">
				'.$arrow.'
				<span>'.$title.'</span>
			</li>';
	}
}

$strReturn .= '</ul>';

return $strReturn;
