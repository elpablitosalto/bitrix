<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? foreach ($arResult as $columnNum => $arColumn) { ?>
    <div class="col-sm-6 col-lg-3">

        <? if ($columnNum == 1) { ?>
            <div class="main-menu__block main-menu__help mobile-visible">
                <div class="buttons-line">
                    <a href="/how_to_help/" class="btn">Пожертвовать</a>
                    <a href="/contacts/" class="text-color-orange">
                        <u>Мне нужна помощь</u></a>
                </div>
            </div>
        <? } ?>

        <? if ($columnNum == 2) { ?>
            <div class="main-menu__block main-menu__help tablet-visible">
                <div class="buttons-line">
                    <a href="/how_to_help/" class="btn">Пожертвовать</a>
                    <a href="/contacts/" class="text-color-orange">
                        <u>Мне нужна помощь</u>
                    </a>
                </div>
            </div>
        <? } ?>

        <? foreach ($arColumn as $arItem) { ?>
            <ul class="main-menu__block main-menu__list">
                <? if ($arItem["PARAMS"]["UF_HIDE_NAME"]) { ?>
                    <? foreach ($arItem["CHILD"] as $child) {
                        $target = "_self";
                        if (strpos($child["LINK"], "http") !== false) {
                            $target = "_blank";
                        }
                    ?>
                        <li><a href="<?= $child["LINK"] ?>" target="<?= $target; ?>" class="text-color-orange"><?= $child["TEXT"] ?></a></li>
                    <? } ?>
                <? } else { ?>
                    <li><a href="<?= $arItem["LINK"] ?>" class="text-color-orange">
                            <u><?= $arItem["TEXT"] ?></u></a></li>
                    <? foreach ($arItem["CHILD"] as $child) { ?>
                        <li><a href="<?= $child["LINK"] ?>"><?= $child["TEXT"] ?></a></li>
                    <? } ?>
                <? } ?>
            </ul>
        <? } ?>


        <? if ($columnNum == 2) { ?>
            <ul class="main-menu__block main-menu__list desktop-visible">
                <li>
                    <a href="/contacts/" class="text-color-orange">
                        <u>Мне нужна помощь</u></a>
                </li>
            </ul>
        <? } ?>


        <? if ($columnNum == 4) { ?>
            <div class="main-menu__block main-menu__contacts">
                <p><span class="title">Экстренная помощь:</span><a href="tel:8 (8202) 288-588" class="text-color-orange">
                        <u>8 (8202) 288-588</u></a></p>
                <p><span class="title">Информационный сектор:</span><a href="tel:8 (8202) 44 82 00" class="text-color-orange">
                        <u>8 (8202) 44 82 00</u></a></p>
                <p><span class="title">E-mail:</span><a href="mailto:info@dorogakdomu.ru" class="text-color-orange">
                        <u>info@dorogakdomu.ru</u></a></p>
                <p><span class="title">Адрес:</span>г. Череповец, ул. Менделеева д.3</p>
            </div>
            <div class="main-menu__block main-menu__soc">
                <div class="title">Наши соцсети</div>
                <ul class="soc-list">
                    <li><a href="https://vk.com/dorogakdomy" target="_blank" title="Наша группа ВКонтакте">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-vk">
                                <use xlink:href="#vk"></use>
                            </svg>
                        </a></li>
                    <li><a href="https://www.youtube.com/user/dorogakdomu" target="_blank" title="Наш канал на Youtube">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-yt">
                                <use xlink:href="#yt"></use>
                            </svg>
                        </a></li>
                </ul>
            </div>
        <? } ?>

    </div>
<? } ?>