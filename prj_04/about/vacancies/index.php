<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Вакансии");
?>
<section class="content">
    <div class="container _inside-page">
        <? $APPLICATION->IncludeComponent(
            "bitrix:breadcrumb",
            "hair.crumbs",
            array(
                "START_FROM" => "0",
                "PATH" => "",
                "SITE_ID" => "s1"
            )
        ); ?>
        <h1 class="_small">СТАТЬ ЧАСТЬЮ КОМАНДЫ</h1>
        <? $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "vacancies",
            array(
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "ADD_SECTIONS_CHAIN" => "Y",
                "AJAX_MODE" => "Y",
                "AJAX_OPTION_ADDITIONAL" => "",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "CACHE_FILTER" => "N",
                "CACHE_GROUPS" => "Y",
                "CACHE_TIME" => "36000000",
                "CACHE_TYPE" => "A",
                "CHECK_DATES" => "Y",
                "DETAIL_URL" => "",
                "DISPLAY_BOTTOM_PAGER" => "Y",
                "DISPLAY_DATE" => "Y",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "Y",
                "DISPLAY_TOP_PAGER" => "N",
                "FIELD_CODE" => array(
                    0 => "",
                    1 => "",
                ),
                "FILTER_NAME" => "",
                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                "IBLOCK_ID" => "18",
                "IBLOCK_TYPE" => "content",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "INCLUDE_SUBSECTIONS" => "Y",
                "MESSAGE_404" => "",
                "NEWS_COUNT" => "0",
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
                    0 => "RESPONSIBILITIES",
                    1 => "HH_LINK",
                    2 => "REQUIREMENTS",
                    3 => "",
                ),
                "SET_BROWSER_TITLE" => "Y",
                "SET_LAST_MODIFIED" => "N",
                "SET_META_DESCRIPTION" => "Y",
                "SET_META_KEYWORDS" => "Y",
                "SET_STATUS_404" => "N",
                "SET_TITLE" => "Y",
                "SHOW_404" => "N",
                "SORT_BY1" => "ACTIVE_FROM",
                "SORT_BY2" => "SORT",
                "SORT_ORDER1" => "DESC",
                "SORT_ORDER2" => "ASC",
                "STRICT_SECTION_CHECK" => "N",
                "COMPONENT_TEMPLATE" => "vacancies"
            ),
            false
        ); ?>
    </div>
</section>

<div id="vacanciesPopup" class="popup mfp-hide">
    <div class="popup_header">
        <h3>ОТПРАВИТЬ РЕЗЮМЕ</h3>
        <p>Заполните форму и прикрепите свое резюме</p>
    </div>
    <div class="popup_content">
        <form action="/local/ajax/forms/rezume.php" data-form-with-file>
            <input id="vacancyID" type="hidden" name="VACANCY" value="" />
            <div class="step">
                <div class="form-wrapper__item">
                    <label>ФИО*</label>
                    <input type="text" name="NAME" required>
                    <span class="error"></span>
                </div>
                <div class="form-wrapper__item">
                    <label>Телефон*</label>
                    <input type="phone" name="PHONE" required placeholder="+7 (_ _ _) _ _ _-_ _-_ _">
                    <span class="error"></span>
                </div>
                <div class="form-wrapper__item">
                    <label>E-mail*</label>
                    <input type="email" name="EMAIL" required placeholder="pochta@mail.ru">
                    <span class="error">E-mail введен не корректно</span>
                </div>
                <div class="form-wrapper__item">
                    <label>Желаемая должность*</label>
                    <input type="text" name="POSITION" required>
                    <span class="error"></span>
                </div>
                <div class="form-wrapper__item form-wrapper__item-file__default">
                    <div class="add-file">
                        <div class="add-file-button">Прикрепить файл</div>
                        <div class="add-file-text">Файл не выбран</div>
                        <input id="rezumeFile" type="file" name="REZUME_FILE" accept=".txt,.doc,.pdf,.jpeg,.png">
                    </div>
                    <label>Допустимые форматы файла: text, doc, pdf, jpeg, png</label>
                    <span class="error"></span>
                </div>
                <div class="form-wrapper__item">
                    <label>Текст резюме*</label>
                    <textarea name="REZUME_TEXT" required></textarea>
                    <span>E-mail введен не корректно, используйте @</span>
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
                    <span class="error"></span>
                </div>
            </div>
            <div class="step">
                <div class="form-wrapper__item _flex-column-center">
                    <button class="button _small">Отправить</button>
                </div>
            </div>
        </form>
    </div>
</div>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>