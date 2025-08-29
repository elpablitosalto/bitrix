<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @global CMain $APPLICATION
 */
global $APPLICATION;
?>

<div class="search">
	<? $APPLICATION->IncludeComponent(
		"waim:search.form",
		"inner",
		array(
			'SEARCH_PAGE' => '/search/',
			'PLACEHOLDER' => 'Поиск по сайту'
		)
	); ?>
	<?
	require_once(__DIR__ . '/include/promo.php');
	?>
</div>