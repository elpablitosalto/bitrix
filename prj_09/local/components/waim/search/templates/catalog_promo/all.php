<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @global CMain $APPLICATION
 */
global $APPLICATION;
?>

<div class="search">
    <?
    require_once(__DIR__ . '/include/tabs.php');
    ?>
    <? $APPLICATION->IncludeComponent(
        "waim:search.form",
        "inner",
        array(
            'SEARCH_PAGE' => '/search/',
            'PLACEHOLDER' => 'Поиск по сайту'
        )
    ); ?>
    <?
    if ($arResult["TYPE"] == 'catalog') {
        require_once(__DIR__ . '/include/catalog.php');
    }
    ?>
    <?
    if ($arResult["TYPE"] == 'promo') {
        require_once(__DIR__ . '/include/promo.php');
    }
    ?>
</div>