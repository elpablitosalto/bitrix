<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
<div class="page-head">
    <div class="container">
        <div class="section__content">
            <? $APPLICATION->IncludeComponent(
                "bitrix:breadcrumb",
                "",
                array()
            ); ?>
        </div>
        <h1 class="page-title"><? $APPLICATION->ShowTitle(false) ?></h1>
    </div>
</div>