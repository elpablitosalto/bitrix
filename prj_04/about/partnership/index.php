<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Как начать сотрудничество с брендом | Профессиональная косметика для волос CONCEPT");
$APPLICATION->SetPageProperty("description", "Хотите начать сотрудничество с брендом проверенной профессиональной косметики для волос?? Выбирайте свой стартовый пакет сотрудничества и получайте приятные подарки от компании. Читайте правила и принимайте участие!");
$APPLICATION->SetTitle("Как начать сотрудничество");
?><? $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "partnership-banner",
        array(
            "ACTIVE_DATE_FORMAT" => "d.m.Y",
            "ADD_SECTIONS_CHAIN" => "N",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "CACHE_FILTER" => "N",
            "CACHE_GROUPS" => "Y",
            "CACHE_TIME" => "36000000",
            "CACHE_TYPE" => "A",
            "CHECK_DATES" => "Y",
            "COMPONENT_TEMPLATE" => "partnership-banner",
            "DETAIL_URL" => "",
            "DISPLAY_BOTTOM_PAGER" => "N",
            "DISPLAY_DATE" => "Y",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "DISPLAY_TOP_PAGER" => "N",
            "FIELD_CODE" => array(
                0 => "ID",
                1 => "CODE",
                2 => "PREVIEW_PICTURE",
                3 => "DETAIL_PICTURE",
                4 => "",
            ),
            "FILTER_NAME" => "",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "IBLOCK_ID" => "27",
            "IBLOCK_TYPE" => "banners",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "INCLUDE_SUBSECTIONS" => "Y",
            "MESSAGE_404" => "",
            "NEWS_COUNT" => "20",
            "PAGER_BASE_LINK_ENABLE" => "N",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "N",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_TEMPLATE" => ".default",
            "PAGER_TITLE" => "Новости",
            "PARENT_SECTION" => "",
            "PARENT_SECTION_CODE" => "",
            "PREVIEW_TRUNCATE_LEN" => "",
            "PROPERTY_CODE" => array(
                0 => "",
                1 => "VDEO_URL",
                2 => "VIDEO_FILE",
                3 => "",
            ),
            "SET_BROWSER_TITLE" => "N",
            "SET_LAST_MODIFIED" => "N",
            "SET_META_DESCRIPTION" => "N",
            "SET_META_KEYWORDS" => "N",
            "SET_STATUS_404" => "N",
            "SET_TITLE" => "N",
            "SHOW_404" => "N",
            "SORT_BY1" => "ACTIVE_FROM",
            "SORT_BY2" => "SORT",
            "SORT_ORDER1" => "DESC",
            "SORT_ORDER2" => "ASC",
            "STRICT_SECTION_CHECK" => "N"
        ),
        false
    ); ?>
<div class="container _column">
    <div class="partnership-page">
        <div class="partnership-page__wrapper">
            <div class="partnership-page__main">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    array(
                        "AREA_FILE_SHOW" => "page",
                        "AREA_FILE_SUFFIX" => "intro",
                        "EDIT_TEMPLATE" => ""
                    )
                ); ?>
                <div class="partnership-page__content">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:news.list",
                        "partnership-set-slider",
                        array(
                            "ACTIVE_DATE_FORMAT" => "d.m.Y",
                            "ADD_SECTIONS_CHAIN" => "N",
                            "AJAX_MODE" => "N",
                            "AJAX_OPTION_ADDITIONAL" => "",
                            "AJAX_OPTION_HISTORY" => "N",
                            "AJAX_OPTION_JUMP" => "N",
                            "AJAX_OPTION_STYLE" => "Y",
                            "CACHE_FILTER" => "N",
                            "CACHE_GROUPS" => "Y",
                            "CACHE_TIME" => "36000000",
                            "CACHE_TYPE" => "A",
                            "CHECK_DATES" => "Y",
                            "COMPONENT_TEMPLATE" => "",
                            "DETAIL_URL" => "",
                            "DISPLAY_BOTTOM_PAGER" => "N",
                            "DISPLAY_DATE" => "Y",
                            "DISPLAY_NAME" => "Y",
                            "DISPLAY_PICTURE" => "Y",
                            "DISPLAY_PREVIEW_TEXT" => "Y",
                            "DISPLAY_TOP_PAGER" => "N",
                            "FIELD_CODE" => array(0 => "ID", 1 => "CODE", 2 => "PREVIEW_PICTURE", 3 => "DETAIL_PICTURE", 4 => "",),
                            "FILTER_NAME" => "",
                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                            "IBLOCK_ID" => "36",
                            "IBLOCK_TYPE" => "content",
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                            "INCLUDE_SUBSECTIONS" => "Y",
                            "MESSAGE_404" => "",
                            "NEWS_COUNT" => "20",
                            "PAGER_BASE_LINK_ENABLE" => "N",
                            "PAGER_DESC_NUMBERING" => "N",
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            "PAGER_SHOW_ALL" => "N",
                            "PAGER_SHOW_ALWAYS" => "N",
                            "PAGER_TEMPLATE" => ".default",
                            "PAGER_TITLE" => "Пакеты",
                            "PARENT_SECTION" => "",
                            "PARENT_SECTION_CODE" => "",
                            "PREVIEW_TRUNCATE_LEN" => "",
                            "PROPERTY_CODE" => array(0 => "VDEO_URL", 1 => "VIDEO_FILE",),
                            "SET_BROWSER_TITLE" => "N",
                            "SET_LAST_MODIFIED" => "N",
                            "SET_META_DESCRIPTION" => "N",
                            "SET_META_KEYWORDS" => "N",
                            "SET_STATUS_404" => "N",
                            "SET_TITLE" => "N",
                            "SHOW_404" => "N",
                            "SORT_BY1" => "SORT",
                            "SORT_BY2" => "ID",
                            "SORT_ORDER1" => "ASC",
                            "SORT_ORDER2" => "ASC",
                            "STRICT_SECTION_CHECK" => "N"
                        )
                    ); ?>
                </div>
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    array(
                        "AREA_FILE_SHOW" => "page",
                        "AREA_FILE_SUFFIX" => "outro",
                        "EDIT_TEMPLATE" => ""
                    )
                ); ?>
            </div>
            <div class="partnership-page__aside">
                <div class="partnership-aside">
                    <h3 class="partnership-aside__title">Заявка на сотрудичество</h3>
                    <div class="partnership-aside__fields">
                        <p>Заполните форму, и наши специалисты ответят вам в течение 48 часов</p>
                    </div>
                    <form action="/local/ajax/forms/partnershipRequest.php" data-form-ajax>
                        <input type="hidden" name="PAGE_URL" value="<?= $_SERVER['REQUEST_URI'] ?>">
                        <div class="step">
                            <div class="form-wrapper__item">
                                <label>Ваше имя*</label>
                                <input type="text" name="NAME" required>
                                <span class="error">E-mail введен не корректно, используйте @</span>
                            </div>
                            <div class="form-wrapper__item">
                                <label>Телефон*</label>
                                <input type="phone" placeholder="+7 (_ _ _) _ _ _-_ _-_ _" name="PHONE" required>
                            </div>
                            <div class="form-wrapper__item">
                                <label>Выберите свой пакет*</label>
                                <?
                                $sets = CIBlockElement::GetList(
                                    array(
                                        "SORT" => "ASC"
                                    ),
                                    array(
                                        "IBLOCK_ID" => "36",
                                        "ACTIVE" => "Y"
                                    )
                                );
                                ?>
                                <select name="PACKAGE" id="SET_SELECTION">
                                    <? while ($fields = $sets->getNext()) : ?>
                                        <option value="<?= $fields['ID'] ?>"><?= $fields['NAME'] ?></option>
                                    <? endwhile; ?>
                                </select>
                            </div>
                            <div class="form-wrapper__item">
                                <label>Адрес салона*</label>
                                <div data-address-init-item>
                                    <input type="text" data-address-init id="address" name="ADDRESS" placeholder="Начните вводить город..." required>
                                    <input type="hidden" data-address-init-geo name="GEO_DATA" />
                                </div>
                            </div>
                            <?
                            $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => "/local/include/capcha.php",
                                    "AREA_FILE_RECURSIVE" => "N",
                                    "EDIT_MODE" => "html",
                                ),
                                false,
                                array('HIDE_ICONS' => 'Y')
                            );
                            ?>
                            <div class="form-wrapper__item form-wrapper__item-checkbox">
                                <input id="suggestion" type="checkbox" name="suggestion">
                                <label for="suggestion">Нажимая на кнопку, вы соглашаетесь с условиями
                                    обработки персональных данных.</label>
                                <span class="error">Вы не согласились с условиями обработки персональных данных</span>
                            </div>
                        </div>
                        <div class="step">
                            <div class="form-wrapper__item _flex-column-center">
                                <button class="button _small" type="submit">Отправить заявку</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <div class="container _column">
    <section class="content-text">
        <h1>Как начать сотрудничество</h1>
        <form action="/local/ajax/forms/askQuestion.php" data-form-ajax>
            <input type="hidden" name="PAGE_URL" value="<?= $_SERVER['REQUEST_URI'] ?>">
            <div class="step">
                <div class="form-wrapper__item">
                    <label>Ваше имя*</label>
                    <input type="text" name="NAME" required>
                    <span class="error">E-mail введен не корректно, используйте @</span>
                </div>
                <div class="form-wrapper__item">
                    <label>E-mail*</label>
                    <input type="email" name="EMAIL" required>
                </div>
                <div class="form-wrapper__item">
                    <label>Вопрос*</label>
                    <textarea name="MESSAGE"></textarea>
                </div>
                <?
                /*$APPLICATION->IncludeComponent("bitrix:main.include", "", array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => "/local/include/capcha.php",
                    "AREA_FILE_RECURSIVE" => "N",
                    "EDIT_MODE" => "html",
                ),
                    false,
                    array('HIDE_ICONS' => 'Y')
                );*/
                ?>
                <div class="form-wrapper__item form-wrapper__item-checkbox">
                    <input id="suggestion" type="checkbox" name="suggestion">
                    <label for="suggestion">Нажимая на кнопку, вы соглашаетесь с условиями
                        обработки персональных данных.</label>
                    <span class="error">Вы не согласились с условиями обработки персональных данных</span>
                </div>
            </div>
            <div class="step">
                <div class="form-wrapper__item _flex-column-center">
                    <button class="button _small" onclick="ym(26710119,'reachGoal','b2b_sent'); return true;">Отправить</button>
                </div>
            </div>
        </form>
    </section>
</div> -->

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>