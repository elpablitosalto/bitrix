<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)) { ?>
    <ul class="header__list">
        <!--li.header__item.header__item_active-->
        <li class="header__item">
            <a href="/catalog/">Вся продукция</a>
        </li>
        <? foreach ($arResult as $item) {
            /* */
            if($item["TEXT"] == "Ещё...")
                continue;
            /**/
            ?>
            <li class="header__item"><a href="<?= $item["LINK"] ?>"><?= $item["TEXT"] ?></a></li>
        <? } ?>
        <li class="header__item"><a class="js_show_mega_menu" href="#">Ещё...</a></li>
    </ul>
<? } ?>