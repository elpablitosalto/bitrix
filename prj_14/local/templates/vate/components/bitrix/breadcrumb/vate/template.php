<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

//delayed function must return a string
if (empty($arResult))
	return "";

$strReturn = '';

$addClass = 'breadcrumbs_style_transparent';
if (defined('HIDE_TRANSPARENT_BREADCRUMBS_CLASS')) {
	$addClass = '';
}

$strReturn .= '<div class="page__breadcrumbs">
                <!-- begin .breadcrumbs-->
                <div class="breadcrumbs ' . $addClass . '">
                    <ul class="breadcrumbs__list page__container" itemscope="itemscope" itemtype="https://schema.org/BreadcrumbList">';

$itemSize = count($arResult);
for ($index = 0; $index < $itemSize; $index++) {
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	$arrow = ($index > 0 ? '<i class="fa fa-angle-right"></i>' : '');

	if ($arResult[$index]["LINK"] <> "" && $index != $itemSize - 1) {
		$strReturn .= '
			<li class="breadcrumbs__item" itemprop="itemListElement" itemscope="itemscope" itemtype="https://schema.org/ListItem">
			<a class="breadcrumbs__link" href="' . $arResult[$index]["LINK"] . '" itemprop="name">' . $title . '</a>
                            <meta itemprop="position" content="' . $index . '" />
                        </li>';
	} else {
		$strReturn .= '
			<li class="breadcrumbs__item" itemprop="itemListElement" itemscope="itemscope" itemtype="https://schema.org/ListItem">
			<span class="breadcrumbs__label" itemprop="name">' . $title . '</span>
                            <meta itemprop="position" content="' . $index . '" />
                        </li>';
	}
}

$strReturn .= '</ul>
                </div>
                <!-- end .breadcrumbs-->
            </div>';

return $strReturn;
