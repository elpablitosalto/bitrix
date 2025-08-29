<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */
global $APPLICATION;
?>

<!-- begin .icon-control-->
<span class="tab-bar-panel__illustration">
	<svg class="tab-bar-panel__icon" width="28" height="25" viewBox="0 0 28 25" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M19.7548 0C17.3842 0 15.109 1.10354 13.624 2.8406C12.139 1.10354 9.86376 0 7.49319 0C3.29019 0 0 3.29019 0 7.49319C0 12.6362 4.63215 16.8392 11.6485 23.2084L13.624 25L15.5995 23.2084C22.6158 16.8392 27.248 12.6362 27.248 7.49319C27.248 3.29019 23.9578 0 19.7548 0ZM13.767 21.1921L13.624 21.3215L13.4809 21.1921C7.00273 15.3134 2.7248 11.4305 2.7248 7.49319C2.7248 4.7752 4.7752 2.7248 7.49319 2.7248C9.59128 2.7248 11.6349 4.08038 12.3501 5.94005H14.891C15.6131 4.08038 17.6567 2.7248 19.7548 2.7248C22.4728 2.7248 24.5232 4.7752 24.5232 7.49319C24.5232 11.4305 20.2452 15.3134 13.767 21.1921Z" fill="currentColor"></path>
	</svg>
	<span class="tab-bar-panel__badge js-favorite-count"><?=intval(count($arResult))?></span>
</span>
<span class="tab-bar-panel__label">Избранное</span>

<!-- end .icon-control-->
