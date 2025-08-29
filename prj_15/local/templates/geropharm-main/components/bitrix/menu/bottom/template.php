<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)) { ?>
    <? foreach ($arResult as $item) {
        ?>
        <li class="dp-footer-menu__item">
            <a
                class="dp-footer-menu__link"
                <?if(isset($item["PARAMS"]["target"])) echo " ".$item["PARAMS"]["target"];?>
                href="<?= $item["LINK"] ?>"
            ><?= $item["TEXT"] ?></a>
        </li>
    <? } ?>
<? } ?>