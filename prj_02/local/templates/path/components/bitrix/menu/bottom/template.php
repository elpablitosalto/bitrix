<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)) { ?>

    <div class="rs__footer--menu-box">
        <div class="rs__footer--menu-list">
            <? foreach ($arResult as $item) { ?>
                <div class="rs__footer--menu-item">
                    <a class="rs__footer--menu-link" href="<?= $item["LINK"] ?>"
                       title="<?= $item["TEXT"] ?>"><?= $item["TEXT"] ?></a>
                </div>
            <? } ?>
        </div>
    </div>

<? } ?>