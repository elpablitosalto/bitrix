<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)) { ?>
    <ul class="c-menu__links">
        <? foreach ($arResult as $item) {?>
            <li><a class="c-menu__link" href="<?= $item["LINK"] ?>"><?= $item["TEXT"] ?></a></li>
        <? } ?>
    </ul>
<? } ?>