<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arResultCacheKeys = array();
foreach ($arResult as $key => $val) {
    $arResultCacheKeys[] = $key;
}

$this->__component->SetResultCacheKeys($arResultCacheKeys);
?>