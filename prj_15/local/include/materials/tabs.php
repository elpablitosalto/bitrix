<? if (!empty($arParams["IBLOCKS"])) {
    $articles = Indexis::getIblockId("articles", "content");
    $webinars = Indexis::getIblockId("webinars", "content");
    $mc = Indexis::getIblockId("master-class", "content");
    ?>

    <div class="dp-tab-menu-section">
        <div class="dp-tab-menu">
            <ul class="dp-tab-menu__list">
                <? if (in_array($webinars, $arParams["IBLOCKS"])) { ?>
                    <li class="dp-tab-menu__item"><a
                                class="dp-tab-menu__link <? if ($arParams['MATERIAL_TYPE'] == 'WEBINARS') { ?>dp-tab-menu__link_active<? } ?>"
                                href="/favorites/webinars/">Записи вебинаров</a></li>
                <? } ?>
                <? if (in_array($articles, $arParams["IBLOCKS"])) { ?>
                    <li class="dp-tab-menu__item"><a
                                class="dp-tab-menu__link <? if ($arParams['MATERIAL_TYPE'] == 'ARTICLES') { ?>dp-tab-menu__link_active<? } ?>"
                                href="/favorites/blog/">Статьи</a></li>
                <? } ?>
                <? if (in_array($mc, $arParams["IBLOCKS"])) { ?>
                    <li class="dp-tab-menu__item"><a
                                class="dp-tab-menu__link <? if ($arParams['MATERIAL_TYPE'] == 'MASTER_CLASSES') { ?>dp-tab-menu__link_active<? } ?>"
                                href="/favorites/master_classes/">Мастер-классы</a></li>
                <? } ?>
            </ul>
        </div>
        <select class="dp-form-select dp-tab-menu-select" onchange="document.location = this.value;">
            <? if (in_array($webinars, $arParams["IBLOCKS"])) { ?>
                <option value="/favorites/webinars/"
                        <? if ($arParams['MATERIAL_TYPE'] == 'WEBINARS') { ?>selected="selected"<? } ?>>Записи вебинаров
                </option>
            <? } ?>
            <? if (in_array($articles, $arParams["IBLOCKS"])) { ?>
                <option value="/favorites/blog/"
                        <? if ($arParams['MATERIAL_TYPE'] == 'ARTICLES') { ?>selected="selected"<? } ?>>Статьи
                </option>
            <? } ?>
            <? if (in_array($mc, $arParams["IBLOCKS"])) { ?>
                <option value="/favorites/master_classes/"
                        <? if ($arParams['MATERIAL_TYPE'] == 'MASTER_CLASSES') { ?>selected="selected"<? } ?>>
                    Мастер-классы
                </option>
            <? } ?>
        </select>
    </div>
<? } ?>