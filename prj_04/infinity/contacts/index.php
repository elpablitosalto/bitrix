<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");

use Hair\HL;
?>
<div class="page__breadcrumbs">
    <div class="page__container">
        <!-- begin .breadcrumbs-->
        <?$APPLICATION->IncludeComponent("bitrix:breadcrumb","hair.crumbs",Array(
                "START_FROM" => "0",
                "PATH" => "",
                "SITE_ID" => "s1"
            )
        );?>
        <!-- end .breadcrumbs-->
    </div>
</div>
<div class="page__section">
    <!-- begin .section-->
    <div class="section section_spacing_top-close">
        <div class="section__content">
            <div class="page__container">
                <div class="section__contacts">
                    <!-- begin .contacts-->
                    <div class="contacts">
                        <div class="contacts__wrapper">
                            <div class="contacts__main">
                                <div class="contacts__section">
                                    <div class="contacts__title">
                                        <!-- begin .title-->
                                        <h1 class="title title_size_h4">Адрес</h1>
                                        <!-- end .title-->
                                    </div>
                                    <div class="contacts__text">
                                        <? $APPLICATION->IncludeComponent("bitrix:main.include",
                                            "",
                                            Array(
                                                "AREA_FILE_SHOW" => "file",
                                                "PATH" => SITE_TEMPLATE_PATH."/include/contacts/title.php",
                                                "AREA_FILE_RECURSIVE" => "N",
                                                "EDIT_MODE" => "html",
                                            ), false
                                        );
                                        ?>
                                    </div>
                                    <div class="contacts__note">
                                        <? $APPLICATION->IncludeComponent("bitrix:main.include",
                                            "",
                                            Array(
                                                "AREA_FILE_SHOW" => "file",
                                                "PATH" => SITE_TEMPLATE_PATH."/include/contacts/description.php",
                                                "AREA_FILE_RECURSIVE" => "N",
                                                "EDIT_MODE" => "html",
                                            ), false
                                        );
                                        ?>
                                    </div>
                                </div>
                                <div class="contacts__section" itemscope="" itemtype="https://schema.org/HealthAndBeautyBusiness">
                                    <div class="contacts__subtitle">
                                        <!-- begin .title-->
                                        <h2 class="title title_size_h5 title_style_solid">
                                            Контакты головного офиса
                                        </h2>
                                        <!-- end .title-->
                                    </div>
                                    <div class="contacts__group">
                                        <div class="contacts__icon-wrapper">
                                            <svg
                                                    class="contacts__icon"
                                                    width="16"
                                                    height="16"
                                                    viewBox="0 0 16 16"
                                                    fill="none"
                                                    xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <path
                                                        d="M13.3333 5.33335L8 8.66669L2.66667 5.33335V4.00002L8 7.33335L13.3333 4.00002V5.33335ZM13.3333 2.66669H2.66667C1.92667 2.66669 1.33334 3.26002 1.33334 4.00002V12C1.33334 12.3536 1.47381 12.6928 1.72386 12.9428C1.97391 13.1929 2.31305 13.3334 2.66667 13.3334H13.3333C13.687 13.3334 14.0261 13.1929 14.2761 12.9428C14.5262 12.6928 14.6667 12.3536 14.6667 12V4.00002C14.6667 3.6464 14.5262 3.30726 14.2761 3.05721C14.0261 2.80716 13.687 2.66669 13.3333 2.66669Z"
                                                />
                                            </svg>
                                        </div>
                                        <ul class="contacts__list">
                                            <li class="contacts__item">
                                                <a class="contacts__link" href="mailto:<?=COption::GetOptionString('main','email_from');?>">
                                                    <span class="contacts__link-text">
                                                        <?=COption::GetOptionString('main','email_from');?>
                                                    </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="contacts__group">
                                        <div class="contacts__icon-wrapper">
                                            <svg
                                                    class="contacts__icon"
                                                    width="16"
                                                    height="16"
                                                    viewBox="0 0 16 16"
                                                    fill="none"
                                                    xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <path
                                                        d="M13.658 11.4267L10.948 8.96266C10.8199 8.84623 10.6516 8.78414 10.4785 8.78948C10.3055 8.79483 10.1413 8.86721 10.0207 8.99133L8.42534 10.632C8.04134 10.5587 7.26934 10.318 6.47467 9.52533C5.68 8.73 5.43934 7.956 5.368 7.57466L7.00734 5.97866C7.13161 5.85808 7.2041 5.69388 7.20945 5.5208C7.2148 5.34772 7.15259 5.17936 7.036 5.05133L4.57267 2.342C4.45603 2.21357 4.29392 2.13567 4.12077 2.12484C3.94762 2.11401 3.77707 2.1711 3.64534 2.284L2.19867 3.52466C2.08341 3.64034 2.01462 3.7943 2.00534 3.95733C1.99534 4.124 1.80467 8.072 4.866 11.1347C7.53667 13.8047 10.882 14 11.8033 14C11.938 14 12.0207 13.996 12.0427 13.9947C12.2057 13.9855 12.3596 13.9164 12.4747 13.8007L13.7147 12.3533C13.828 12.222 13.8855 12.0516 13.8749 11.8785C13.8644 11.7053 13.7865 11.5432 13.658 11.4267Z"
                                                />
                                            </svg>
                                        </div>
                                        <?$APPLICATION->IncludeComponent("bitrix:news.list", "contact_mainoffice", Array(
                                            "ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
                                            "ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
                                            "AJAX_MODE" => "N",	// Включить режим AJAX
                                            "AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
                                            "AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
                                            "AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
                                            "AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
                                            "CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
                                            "CACHE_GROUPS" => "Y",	// Учитывать права доступа
                                            "CACHE_TIME" => "36000000",	// Время кеширования (сек.)
                                            "CACHE_TYPE" => "A",	// Тип кеширования
                                            "CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
                                            "DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
                                            "DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
                                            "DISPLAY_DATE" => "Y",	// Выводить дату элемента
                                            "DISPLAY_NAME" => "Y",	// Выводить название элемента
                                            "DISPLAY_PICTURE" => "Y",	// Выводить изображение для анонса
                                            "DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса
                                            "DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
                                            "FIELD_CODE" => array(	// Поля
                                                0 => "",
                                                1 => "",
                                            ),
                                            "FILTER_NAME" => "",	// Фильтр
                                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
                                            "IBLOCK_ID" => "28",	// Код информационного блока
                                            "IBLOCK_TYPE" => "content",	// Тип информационного блока (используется только для проверки)
                                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
                                            "INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
                                            "MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
                                            "NEWS_COUNT" => "20",	// Количество новостей на странице
                                            "PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
                                            "PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
                                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
                                            "PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
                                            "PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
                                            "PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
                                            "PAGER_TITLE" => "Новости",	// Название категорий
                                            "PARENT_SECTION" => "",	// ID раздела
                                            "PARENT_SECTION_CODE" => "",	// Код раздела
                                            "PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
                                            "PROPERTY_CODE" => array(	// Свойства
                                                0 => "TELEPHONE_NUMBER",
                                                1 => "",
                                            ),
                                            "SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
                                            "SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
                                            "SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
                                            "SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
                                            "SET_STATUS_404" => "Y",	// Устанавливать статус 404
                                            "SET_TITLE" => "N",	// Устанавливать заголовок страницы
                                            "SHOW_404" => "Y",	// Показ специальной страницы
                                            "SORT_BY1" => "ACTIVE_FROM",	// Поле для первой сортировки новостей
                                            "SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
                                            "SORT_ORDER1" => "DESC",	// Направление для первой сортировки новостей
                                            "SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
                                            "STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела для показа списка
                                        ),
                                            false
                                        );?>
                                    </div>
                                </div>
                                <div class="contacts__section">
                                    <div class="contacts__label">Мы в социальных сетях:</div>
                                    <div class="contacts__social-nav">
                                        <!-- begin .social-nav-->
                                        <div class="social-nav">
                                            <ul class="social-nav__list">
                                                <?
                                                $hl = new HL();
                                                $items = $hl->getList(SOCIALS,['*'],[],['UF_SORT_VALUE' => 'asc']);
                                                foreach($items as $item):
                                                    $icon = CFile::GetPath($item['UF_ICON']);
                                                    ?>
                                                    <li class="social-nav__item <?=$item['UF_CODE']?>">
                                                        <a class="social-nav__link" href="<?=$item['UF_LINK']?>">
                                                            <?=file_get_contents($_SERVER["DOCUMENT_ROOT"].$icon)?>
                                                        </a>
                                                    </li>
                                                <?
                                                endforeach;
                                                ?>
                                            </ul>
                                        </div>
                                        <!-- end .social-nav-->
                                    </div>
                                </div>
                                <div class="contacts__section">
                                    <div class="contacts__links">
                                        <div class="contacts__link-item">
                                            <!-- begin .icon-link-->
                                            <? $APPLICATION->IncludeComponent("bitrix:main.include",
                                                "",
                                                Array(
                                                    "AREA_FILE_SHOW" => "file",
                                                    "PATH" => SITE_TEMPLATE_PATH."/include/contacts/requisites_left.php",
                                                    "AREA_FILE_RECURSIVE" => "N",
                                                    "EDIT_MODE" => "html",
                                                ), false
                                            );
                                            ?>
                                            <!-- end .icon-link-->
                                        </div>
                                        <div class="contacts__link-item contacts__link-item_right">
                                            <!-- begin .icon-link-->
                                            <? $APPLICATION->IncludeComponent("bitrix:main.include",
                                                "",
                                                Array(
                                                    "AREA_FILE_SHOW" => "file",
                                                    "PATH" => SITE_TEMPLATE_PATH."/include/contacts/requisites_right.php",
                                                    "AREA_FILE_RECURSIVE" => "N",
                                                    "EDIT_MODE" => "html",
                                                ), false
                                            );
                                            ?>
                                            <!-- end .icon-link-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="contacts__form-panel">
                                <div class="contacts__subtitle">
                                    <!-- begin .title-->
                                    <h2 class="title title_size_h5 title_style_solid">НАПИСАТЬ НАМ</h2>
                                    <!-- end .title-->
                                </div>
                                <div class="contacts__form">
                                    <!-- begin .form-->
                                    <?$APPLICATION->IncludeComponent(
                                        "bitrix:iblock.element.add.form",
                                        "contacts",
                                        array(
                                            "SEF_MODE" => "Y",
                                            "IBLOCK_TYPE" => "forms",
                                            "IBLOCK_ID" => "12",
                                            "PROPERTY_CODES" => array(
                                                0 => "58",
                                                1 => "59",
                                                3 => "61",
                                            ),
                                            "PROPERTY_CODES_REQUIRED" => array(
                                                0 => "58",
                                                1 => "59",
                                                3 => "61",
                                            ),
                                            "GROUPS" => array(
                                                0 => "2",
                                            ),
                                            "STATUS_NEW" => "N",
                                            "STATUS" => "ANY",
                                            "LIST_URL" => "",
                                            "ELEMENT_ASSOC" => "CREATED_BY",
                                            "ELEMENT_ASSOC_PROPERTY" => "",
                                            "MAX_USER_ENTRIES" => "100000",
                                            "MAX_LEVELS" => "100000",
                                            "LEVEL_LAST" => "Y",
                                            "USE_CAPTCHA" => "Y",
                                            "USER_MESSAGE_EDIT" => "",
                                            "USER_MESSAGE_ADD" => "",
                                            "DEFAULT_INPUT_SIZE" => "30",
                                            "RESIZE_IMAGES" => "Y",
                                            "MAX_FILE_SIZE" => "0",
                                            "PREVIEW_TEXT_USE_HTML_EDITOR" => "Y",
                                            "DETAIL_TEXT_USE_HTML_EDITOR" => "Y",
                                            "CUSTOM_TITLE_NAME" => "",
                                            "CUSTOM_TITLE_TAGS" => "",
                                            "CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
                                            "CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
                                            "CUSTOM_TITLE_IBLOCK_SECTION" => "",
                                            "CUSTOM_TITLE_PREVIEW_TEXT" => "",
                                            "CUSTOM_TITLE_PREVIEW_PICTURE" => "",
                                            "CUSTOM_TITLE_DETAIL_TEXT" => "",
                                            "CUSTOM_TITLE_DETAIL_PICTURE" => "",
                                            "SEF_FOLDER" => "/",
                                            "COMPONENT_TEMPLATE" => "contacts"
                                        ),
                                        false
                                    );?>
                                    <!-- end .form-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end .contacts-->
                </div>
            </div>
        </div>
    </div>
    <!-- end .section-->
</div>

<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>