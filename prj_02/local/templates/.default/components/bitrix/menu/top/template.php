<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)) { ?>
    <div class="header__item header__item--menu">
        <ul class="header__menu">
            <? foreach ($arResult as $item) { ?>
                <li>
                    <? if (!empty($item["CHILD"]) && $item["TEXT"]=="Программы") { ?>
                        <a href="#" onclick="return false;" target="_self">
                    <? } else { ?>
                        <a href="<?= $item["LINK"] ?>" target="_self">
                    <? } ?>
                    
                        <u><?= $item["TEXT"] ?></u>
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-drop">
                            <use xlink:href="#drop"></use>
                        </svg>
                    </a>
                    <? if (!empty($item["CHILD"])) { ?>
                        <div class="submenu">
                            <ul>
                                <? foreach ($item["CHILD"] as $child) { ?>
                                    <li><a target="_self" href="<?= $child["LINK"] ?>">
                                            <u><?= $child["TEXT"] ?></u></a></li>
                                    <li>
                                    <? } ?>
                            </ul>
                        </div>
                    <? } ?>
                </li>
            <? } ?>
        </ul>
    </div>
<? } ?>