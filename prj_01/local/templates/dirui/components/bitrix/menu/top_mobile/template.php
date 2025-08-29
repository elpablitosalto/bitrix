<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)) { ?>

    <div class="c-menu__category">
        <div class="c-menu__box">
            <ul class="c-menu__category-list">
                <li><a class="c-menu__category-item" href="/catalog/" data-menu-link-id="1">Вся продукция</a></li>
                <? foreach ($arResult as $item) {
                    ?>
                    <li><a class="c-menu__category-item"  href="<?= $item["LINK"] ?>"><?= $item["TEXT"] ?></a></li>
                <? } ?>
            </ul>
        </div>
        <a href="/catalog/" class="link-button_rose">Подобрать оборудование</a>
    </div>

<? } ?>