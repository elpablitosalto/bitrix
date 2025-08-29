<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)) { ?>
        <? foreach ($arResult as $item) { ?>
        <a class="link-button_grey" href="<?= $item["LINK"] ?>"><?= $item["TEXT"] ?></a>
        <? } ?>
<? } ?>