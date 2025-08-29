<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<div class="menu-list menu-list_type_separated">
    <div class="menu-list__container">
        <ul class="menu-list__list">
            <? if (!empty($arResult["ITEMS"])): ?>
                <?
                foreach ($arResult["ITEMS"] as $arItem):
                    if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) continue;
                    ?>
                    <? if ($arItem["SELECTED"]):?>
                    <li class="menu-list__item menu-list__item_role_mobile">
                        <a class="menu-list__link menu-list__link_role_mobile nav__link_state_active" href="#">
                            <svg class="menu-list__icon" width="8" height="11" viewBox="0 0 8 11" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 10L7 5.5L1 1" stroke="#E31513" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg>
                            <span class="menu-list__text"><?= $arItem["TEXT"] ?></span>
                        </a>
                    </li>
                <? else:?>
                    <li class="menu-list__item menu-list__item_role_mobile">
                        <a href="<?= $arItem["LINK"] ?>"
                        class="menu-list__link menu-list__link_role_mobile">
                            <svg class="menu-list__icon" width="8" height="11" viewBox="0 0 8 11" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 10L7 5.5L1 1" stroke="#E31513" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg>
                            <span class="menu-list__text"><?= $arItem["TEXT"] ?></span>
                        </a>
                    </li>
                <? endif ?>
                <? endforeach ?>
            <? endif ?>
            <? if (!empty($arResult["ITEMS_MORE"])): ?>
                <li class="menu-list__item menu-list__item_role_mobile menu-list__item_style_highlight menu-list__item_type_parent">
                    <div class="menu-list__trigger js-toggle" data-toggle-scope=".menu-list__item" data-toggle-class="menu-list__item_state_open" aria-label="">
                        <svg class="menu-list__icon" width="8" height="11" viewBox="0 0 8 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 10L7 5.5L1 1" stroke="#E31513" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        <div class="menu-list__text">
                            Еще
                        </div>
                    </div>
                    <ul class="menu-list__sublist">
                        <? foreach ($arResult["ITEMS_MORE"] as $arItem):
                            if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) continue;
                            ?>
                            <? if ($arItem["SELECTED"]):?>
                            <li class="menu-list__subitem">
                                <a class="menu-list__link nav__link_state_active"><?= $arItem["TEXT"] ?></a>
                            </li>
                        <? else:?>
                            <li class="menu-list__subitem">
                                <a class="menu-list__link" href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a>
                            </li>
                        <? endif ?>
                        <? endforeach; ?>
                    </ul>
                </li>
                <? foreach ($arResult["ITEMS_MORE"] as $arItem):
                    if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) continue;
                    ?>
                    <? if ($arItem["SELECTED"]):?>
                    <li class="menu-list__item menu-list__item_role_desktop ">
                        <a class="menu-list__link menu-list__item_role_desktop nav__link_state_active" href="<?= $arItem["LINK"] ?>">
                            <svg class="menu-list__icon" width="8" height="11" viewBox="0 0 8 11" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 10L7 5.5L1 1" stroke="#E31513" stroke-width="2" stroke-linecap="round"
                                      stroke-linejoin="round"></path>
                            </svg>
                            <span class="menu-list__text"><?= $arItem["TEXT"] ?></span>
                        </a>
                    </li>
                <? else:?>
                    <li class="menu-list__item menu-list__item_role_desktop">
                        <a class="menu-list__link menu-list__item_role_desktop" href="<?= $arItem["LINK"] ?>">
                            <svg class="menu-list__icon" width="8" height="11" viewBox="0 0 8 11" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 10L7 5.5L1 1" stroke="#E31513" stroke-width="2" stroke-linecap="round"
                                      stroke-linejoin="round"></path>
                            </svg>
                            <span class="menu-list__text"><?= $arItem["TEXT"] ?></span>
                        </a>
                    </li>
                <? endif ?>
                <? endforeach ?>
            <? endif ?>
        </ul>
    </div>
</div>
