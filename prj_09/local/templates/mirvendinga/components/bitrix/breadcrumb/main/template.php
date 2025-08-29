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

$strReturn .= '<!-- begin .breadcrumbs--><div class="breadcrumbs"><ul
            itemscope="itemscope"
            itemtype="https://schema.org/BreadcrumbList"
            class="breadcrumbs__list"
    >';

$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
	{
		$strReturn .= '
            <li
                    itemprop="itemListElement"
                    itemscope="itemscope"
                    itemtype="https://schema.org/ListItem"
                    class="breadcrumbs__item"
            >
                <a href="'.$arResult[$index]["LINK"].'" title="'.$title.'" itemprop="item" class="breadcrumbs__link">
                    <span itemprop="name">'.$title.'</span>
                </a>
                <meta itemprop="position" content="'.($index + 1).'" />
            </li>
        ';
	}
	else
	{
		$strReturn .= '
            <li
                    itemprop="itemListElement"
                    itemscope="itemscope"
                    itemtype="https://schema.org/ListItem"
                    class="breadcrumbs__item"
            >
                <span itemprop="name" class="breadcrumbs__label">'.$title.'</span>
                <meta itemprop="position" content="'.($index + 1).'" />
            </li>
        ';
	}
}

$strReturn .= '</ul></div><!-- end .breadcrumbs-->';

return $strReturn;
