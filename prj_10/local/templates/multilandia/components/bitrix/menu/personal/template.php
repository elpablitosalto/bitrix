<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>

<?php
$currentUrl = explode("?", $_SERVER['REQUEST_URI']);
$currentUrl = $currentUrl[0];
?>

<? if (!empty($arResult)): ?>
    <ul class="ml-page-menu__list">
        <? foreach($arResult as $arItem): ?>
            <li class="ml-page-menu__item <? echo ($currentUrl === $arItem['LINK']) ? 'ml-page-menu__item_active' : ''; ?>">
                <a class="ml-page-menu__link" href="<?=$arItem["LINK"]?>">
                    <?=$arItem["TEXT"]?>
                </a>
            </li>
        <? endforeach; ?>
    </ul>
<? endif; ?>