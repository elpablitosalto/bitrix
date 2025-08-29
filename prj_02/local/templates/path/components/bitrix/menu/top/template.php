<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)) { ?>


    <div class="rs__menu">
        <? foreach ($arResult as $item) { ?>
            <div class="rs__menu--item<? if (!empty($item["CHILD"])) { ?> rs__menu--item-sub<? } ?>">
                <a class="rs__menu--link" href="<?= $item["LINK"] ?>" title="<?= $item["TEXT"] ?>"><?= $item["TEXT"] ?></a>
                <? if (!empty($item["CHILD"])) { ?>
                    <div class="rs__menu--submenu">
                        <? foreach ($item["CHILD"] as $child) { ?>
                            <div class="rs__menu--submenu-item">
                                <a class="rs__menu--submenu-link" href="<?= $child["LINK"] ?>" title="<?= $child["TEXT"] ?>"><?= $child["TEXT"] ?></a>
                            </div>
                        <? } ?>
                    </div>
                <? } ?>
            </div>
        <? } ?>
    </div>
    <label class="rs__menu--burger" for="MenuMobile">
        <span></span>
        <span></span>
        <span></span>
    </label>
<? } ?>