<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @global CMain $APPLICATION
 */
global $APPLICATION;
?>
<div class="search">
        <div class="search__header">
                <div class="search__field">
                        <? $APPLICATION->IncludeComponent(
                                "waim:search.form",
                                "inner",
                                array(
                                        'SEARCH_PAGE' => '/search/',
                                        'PLACEHOLDER' => 'Поиск по сайту'
                                )
                        ); ?>
                </div>
                <div class="search__message">По вашему запросу ничего не найдено.</div>
        </div>
</div>