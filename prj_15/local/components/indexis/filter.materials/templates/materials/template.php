<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
} ?>

<? if (!empty($arResult['USER_ID'])) { ?>
    <form class="dp-hide-switch js_hide_show_learned_form" action="<?= $arResult['ACTION']; ?>" method="post">
        <input type="hidden" value="<?=urlencode($arResult['REDIRECT_URL_TEMPLATE']);?>" name="redirect_url" />
        <input type="hidden" value="Y" name="set_filter" />
        <input type="hidden" value="hide_show_learned" name="filter_type" />
        <div class="dp-hide-switch__input">
            <input id="hide-switch-input" class="js_hide_show_learned" type="checkbox" name="hide_show_learned" value="Y" <? if ($arResult['hidelearned'] == 'Y') { ?> checked <? } ?> />
            <label for="hide-switch-input">Скрывать изученное</label>
        </div>
    </form>
<? } ?>
<? if (!empty($arResult['ITEMS'])) { ?>
    <div class="dp-filter-section">
        <div class="dp-filter">
            <p class="dp-filter__title">Тема</p>
            <div class="dp-modal dp-filter__modal">
                <div class="dp-modal__overlay"></div>
                <button class="dp-modal__close" type="button">
                    <svg class="icon icon-cross ">
                        <use xlink:href="#cross"></use>
                    </svg>
                </button>
                <div class="dp-modal__dialog">
                    <form class="dp-filter-form dp-filter-form-topic js_themes_form" action="<?= $arResult['ACTION']; ?>" method="post">
                    <input type="hidden" value="<?=urlencode($arResult['REDIRECT_URL_TEMPLATE']);?>" name="redirect_url" />
                        <input type="hidden" value="Y" name="set_filter" />
                        <input type="hidden" value="topic" name="filter_type" />
                        <p class="dp-filter-form__title">Тема</p>
                        <div class="dp-filter-form__body">
                            <div class="dp-filter-form__list">
                                <? foreach ($arResult['ITEMS'] as $key => $arItem) { ?>
                                    <div class="dp-filter-form__item">
                                        <input class="js_themes_checkbox" id="ff-topic-<?= $arItem['ID'] ?>" type="checkbox" name="topic[<?= $arItem['ID'] ?>]" value="<?= $arItem['ID'] ?>" <? if ($arItem['CHECKED'] == 'Y') { ?> checked <? } ?> />
                                        <label for="ff-topic-<?= $arItem['ID'] ?>"><?= $arItem['UF_NAME'] ?></label>
                                    </div>
                                <? } ?>
                                <?/*?>
                                <div class="dp-filter-form__item">
                                    <button class="dp-btn dp-btn_m dp-btn_orange" type="submit">Применить</button>
                                </div>
                                <?*/ ?>
                            </div>
                        </div>
                        <div class="dp-filter-form__actions">
                            <button class="dp-btn dp-btn_m dp-btn_orange" type="submit">Применить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<? } ?>