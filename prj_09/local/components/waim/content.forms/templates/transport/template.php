<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */
global $APPLICATION;
?>
<script type="module" crossorigin src="<?=$templateFolder?>/dist/plugin.js"></script>
<main id="app" class="page__section"></main>
<script>
    var initData = <?=\CUtil::PhpToJSObject($arResult);?>;
    console.log(initData);
</script>