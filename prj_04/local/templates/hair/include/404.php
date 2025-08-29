<section class="content">
    <section class="pnf">
        <div class="container">
            <div class="pnf-interesting">
                <div class="interesting-container">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:news.list",
                        "404",
                        array(
                            "ACTIVE_DATE_FORMAT" => "d.m.Y",    // Формат показа даты
                            "ADD_SECTIONS_CHAIN" => "N",    // Включать раздел в цепочку навигации
                            "AJAX_MODE" => "N",    // Включить режим AJAX
                            "AJAX_OPTION_ADDITIONAL" => "",    // Дополнительный идентификатор
                            "AJAX_OPTION_HISTORY" => "N",    // Включить эмуляцию навигации браузера
                            "AJAX_OPTION_JUMP" => "N",    // Включить прокрутку к началу компонента
                            "AJAX_OPTION_STYLE" => "Y",    // Включить подгрузку стилей
                            "CACHE_FILTER" => "N",    // Кешировать при установленном фильтре
                            "CACHE_GROUPS" => "Y",    // Учитывать права доступа
                            "CACHE_TIME" => "36000000",    // Время кеширования (сек.)
                            "CACHE_TYPE" => "N",    // Тип кеширования
                            "CHECK_DATES" => "Y",    // Показывать только активные на данный момент элементы
                            "DETAIL_URL" => "",    // URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
                            "DISPLAY_BOTTOM_PAGER" => "N",    // Выводить под списком
                            "DISPLAY_DATE" => "Y",    // Выводить дату элемента
                            "DISPLAY_NAME" => "Y",    // Выводить название элемента
                            "DISPLAY_PICTURE" => "Y",    // Выводить изображение для анонса
                            "DISPLAY_PREVIEW_TEXT" => "Y",    // Выводить текст анонса
                            "DISPLAY_TOP_PAGER" => "N",    // Выводить над списком
                            "FIELD_CODE" => array(    // Поля
                                0 => "",
                                1 => "",
                            ),
                            "FILTER_NAME" => "",    // Фильтр
                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",    // Скрывать ссылку, если нет детального описания
                            "IBLOCK_ID" => "24",    // Код информационного блока
                            "IBLOCK_TYPE" => "content",    // Тип информационного блока (используется только для проверки)
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",    // Включать инфоблок в цепочку навигации
                            "INCLUDE_SUBSECTIONS" => "Y",    // Показывать элементы подразделов раздела
                            "MESSAGE_404" => "",    // Сообщение для показа (по умолчанию из компонента)
                            "NEWS_COUNT" => "1",    // Количество новостей на странице
                            "PAGER_BASE_LINK_ENABLE" => "N",    // Включить обработку ссылок
                            "PAGER_DESC_NUMBERING" => "N",    // Использовать обратную навигацию
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",    // Время кеширования страниц для обратной навигации
                            "PAGER_SHOW_ALL" => "N",    // Показывать ссылку "Все"
                            "PAGER_SHOW_ALWAYS" => "N",    // Выводить всегда
                            "PAGER_TEMPLATE" => ".default",    // Шаблон постраничной навигации
                            "PAGER_TITLE" => "Новости",    // Название категорий
                            "PARENT_SECTION" => "",    // ID раздела
                            "PARENT_SECTION_CODE" => "",    // Код раздела
                            "PREVIEW_TRUNCATE_LEN" => "",    // Максимальная длина анонса для вывода (только для типа текст)
                            "PROPERTY_CODE" => array(    // Свойства
                                0 => "",
                                1 => "",
                            ),
                            "SET_BROWSER_TITLE" => "N",    // Устанавливать заголовок окна браузера
                            "SET_LAST_MODIFIED" => "N",    // Устанавливать в заголовках ответа время модификации страницы
                            "SET_META_DESCRIPTION" => "N",    // Устанавливать описание страницы
                            "SET_META_KEYWORDS" => "N",    // Устанавливать ключевые слова страницы
                            "SET_STATUS_404" => "Y",    // Устанавливать статус 404
                            "SET_TITLE" => "N",    // Устанавливать заголовок страницы
                            "SHOW_404" => "Y",    // Показ специальной страницы
                            "SORT_BY1" => "RAND",    // Поле для первой сортировки новостей
                            "SORT_BY2" => "SORT",    // Поле для второй сортировки новостей
                            "SORT_ORDER1" => "rand",    // Направление для первой сортировки новостей
                            "SORT_ORDER2" => "ASC",    // Направление для второй сортировки новостей
                            "STRICT_SECTION_CHECK" => "N",    // Строгая проверка раздела для показа списка
                        ),
                        false
                    ); ?>
                </div>
            </div>
            <div class="pnf-text-container">
                <div class="pnf-text">
                    <p class="pnf-text__title">404</p>
                    <p class="pnf-text__subtitle">СТРАНИЦА НЕ НАЙДЕНА</p>
                    <p>Запрашиваемая страница не существует или была перемещена по другому адресу.</p>
                    <a href="/" class="button _small">На главную</a>
                </div>
            </div>
        </div>
    </section>
    <section class="novelties">
        <div class="container">
            <h2>Новинки</h2>
        </div>
        <?
        global $arrNoveltiesFilter;
        $arrNoveltiesFilter['!PROPERTY_NEW'] = false;
        $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "novelties",
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
                "FILTER_NAME" => "arrNoveltiesFilter",
                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                "IBLOCK_ID" => "2",
                "IBLOCK_TYPE" => "catalog",
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
                    0 => "PRODUCT_FEATURE",
                    1 => "PRODUCT_PROPS",
                    2 => "PRODUCT_COMPOSITION",
                    3 => "PRODUCT_TYPE",
                    4 => "",
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
                "STRICT_SECTION_CHECK" => "N",
                "COMPONENT_TEMPLATE" => "novelties"
            ),
            false
        ); ?>
    </section>
</section>