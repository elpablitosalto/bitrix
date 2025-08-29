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

$strReturn .= '<div class="page__breadcrumbs">
                <div class="page__container">
                    <!-- begin .breadcrumbs-->
                    <div class="breadcrumbs">
                        <ul class="breadcrumbs__list" itemscope="itemscope" itemtype="https://schema.org/BreadcrumbList">';

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
                </div>
            </div>';

return $strReturn;
