<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)) { ?>
    <div class="text-size-lg footer__item footer__item--menu">
        <ul class="footer__menu">
            <? foreach ($arResult as $item) { ?>
                <li><a href="<?= $item["LINK"] ?>" target="_self">
                        <u><?= $item["TEXT"] ?></u></a></li>
            <? } ?>
        </ul>
    </div>
<? } ?>