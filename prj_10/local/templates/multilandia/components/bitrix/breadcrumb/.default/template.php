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
$strReturn .= '<div class="ml-breadcrumbs"><div class="container"><ul class="ml-breadcrumbs__list">';

$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);

	if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
	{
		$strReturn .= '
			<li class="ml-breadcrumbs__item">
				<a href="'.$arResult[$index]["LINK"].'" title="'.$title.'" class="ml-breadcrumbs__link">
					<span itemprop="name">'.$title.'</span>
				</a>
			</li>';
	}
	else
	{
		$strReturn .= '
			<li class="ml-breadcrumbs__item">
				<span class="ml-breadcrumbs__link">'.$title.'</span>
			</li>';
	}
}

$strReturn .= '</ul><a class="ml-breadcrumbs__back" href="javascript:history.back();">'.GetMessage('GO_BACK').'</a></div></div>';

return $strReturn;
