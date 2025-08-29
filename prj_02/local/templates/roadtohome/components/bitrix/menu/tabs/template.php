<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? if (!empty($arResult)) { ?>
    <div class="nav-tabs-container projects-categories">
        <ul class="text-size-lg nav-tabs">
            <? foreach ($arResult as $arItem) { ?>
                <li><a href="<?= $arItem["LINK"] ?>" class="<?if ($arItem["SELECTED"] || $arItem["PARAMS"]["SELECTED"]=="Y") echo 'active'?>"><?= $arItem["TEXT"] ?></a></li>
            <? } ?>
        </ul>
    </div>
<? } ?>