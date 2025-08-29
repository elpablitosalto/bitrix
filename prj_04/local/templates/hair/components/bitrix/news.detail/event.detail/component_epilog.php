<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<section class="content">
    <div class="container _inside-page">
        <?$APPLICATION->IncludeComponent("bitrix:breadcrumb","hair.crumbs",Array(
                "START_FROM" => "0",
                "PATH" => "",
                "SITE_ID" => "s1"
            )
        );?>
        <h1 class="_small"><?=$arResult['PROPERTIES']['TITLE']['VALUE']?></h1>
        <div class="seminar-detail__short-info">
            <h3><?=$arResult['PROPERTIES']['SUBTITLE']['VALUE']?></h3>
            <p class="_blue _icon">
                <svg width="10" height="14" viewBox="0 0 10 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9.66665 5.00004C9.66665 4.38721 9.54594 3.78037 9.31142 3.21418C9.0769 2.648 8.73315 2.13355 8.29981 1.70021C7.86647 1.26687 7.35202 0.923125 6.78584 0.688603C6.21965 0.454081 5.61282 0.333374 4.99998 0.333374C4.38714 0.333374 3.78031 0.454081 3.21412 0.688603C2.64794 0.923125 2.13349 1.26687 1.70015 1.70021C1.26681 2.13355 0.923064 2.648 0.688542 3.21418C0.45402 3.78037 0.333313 4.38721 0.333313 5.00004C0.333313 5.92471 0.606646 6.78471 1.06998 7.51004H1.06465C2.63798 9.97337 4.99998 13.6667 4.99998 13.6667L8.93531 7.51004H8.93065C9.41092 6.76095 9.66635 5.88987 9.66665 5.00004ZM4.99998 7.00004C4.46955 7.00004 3.96084 6.78933 3.58577 6.41425C3.21069 6.03918 2.99998 5.53047 2.99998 5.00004C2.99998 4.46961 3.21069 3.9609 3.58577 3.58583C3.96084 3.21075 4.46955 3.00004 4.99998 3.00004C5.53041 3.00004 6.03912 3.21075 6.41419 3.58583C6.78927 3.9609 6.99998 4.46961 6.99998 5.00004C6.99998 5.53047 6.78927 6.03918 6.41419 6.41425C6.03912 6.78933 5.53041 7.00004 4.99998 7.00004Z" fill="#3333CC"/>
                </svg>
                <span class="non-active-city"><?=$arResult['DISPLAY_PROPERTIES']['LOCATION']['DISPLAY_VALUE']?></span>
            </p>
            <p class="_blue _icon">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11.6666 1.66671H10.3333V1.00004C10.3333 0.82323 10.2631 0.65366 10.1381 0.528636C10.013 0.403612 9.84346 0.333374 9.66665 0.333374C9.48984 0.333374 9.32027 0.403612 9.19524 0.528636C9.07022 0.65366 8.99998 0.82323 8.99998 1.00004V1.66671H4.99998V1.00004C4.99998 0.82323 4.92974 0.65366 4.80472 0.528636C4.67969 0.403612 4.51012 0.333374 4.33331 0.333374C4.1565 0.333374 3.98693 0.403612 3.86191 0.528636C3.73688 0.65366 3.66665 0.82323 3.66665 1.00004V1.66671H2.33331C1.80288 1.66671 1.29417 1.87742 0.9191 2.25249C0.544027 2.62757 0.333313 3.13627 0.333313 3.66671V11.6667C0.333313 12.1971 0.544027 12.7058 0.9191 13.0809C1.29417 13.456 1.80288 13.6667 2.33331 13.6667H11.6666C12.1971 13.6667 12.7058 13.456 13.0809 13.0809C13.4559 12.7058 13.6666 12.1971 13.6666 11.6667V3.66671C13.6666 3.13627 13.4559 2.62757 13.0809 2.25249C12.7058 1.87742 12.1971 1.66671 11.6666 1.66671ZM12.3333 11.6667C12.3333 11.8435 12.2631 12.0131 12.1381 12.1381C12.013 12.2631 11.8435 12.3334 11.6666 12.3334H2.33331C2.1565 12.3334 1.98693 12.2631 1.86191 12.1381C1.73688 12.0131 1.66665 11.8435 1.66665 11.6667V7.00004H12.3333V11.6667ZM12.3333 5.66671H1.66665V3.66671C1.66665 3.4899 1.73688 3.32033 1.86191 3.1953C1.98693 3.07028 2.1565 3.00004 2.33331 3.00004H3.66665V3.66671C3.66665 3.84352 3.73688 4.01309 3.86191 4.13811C3.98693 4.26314 4.1565 4.33337 4.33331 4.33337C4.51012 4.33337 4.67969 4.26314 4.80472 4.13811C4.92974 4.01309 4.99998 3.84352 4.99998 3.66671V3.00004H8.99998V3.66671C8.99998 3.84352 9.07022 4.01309 9.19524 4.13811C9.32027 4.26314 9.48984 4.33337 9.66665 4.33337C9.84346 4.33337 10.013 4.26314 10.1381 4.13811C10.2631 4.01309 10.3333 3.84352 10.3333 3.66671V3.00004H11.6666C11.8435 3.00004 12.013 3.07028 12.1381 3.1953C12.2631 3.32033 12.3333 3.4899 12.3333 3.66671V5.66671Z" fill="#3333CC"/>
                </svg>
                <span><?=$arResult['PROPERTIES']['START_DATE']['VALUE']?></span>
            </p>
            <?if($arResult['DISPLAY_PROPERTIES']['EVENT_TIME']['DISPLAY_VALUE']):?>
            <p class="_blue _icon">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8 1C4.13438 1 1 4.13438 1 8C1 11.8656 4.13438 15 8 15C11.8656 15 15 11.8656 15 8C15 4.13438 11.8656 1 8 1ZM8 13.8125C4.79063 13.8125 2.1875 11.2094 2.1875 8C2.1875 4.79063 4.79063 2.1875 8 2.1875C11.2094 2.1875 13.8125 4.79063 13.8125 8C13.8125 11.2094 11.2094 13.8125 8 13.8125Z" fill="#3333CC"/>
                    <path d="M10.7297 9.97812L8.50156 8.36719V4.5C8.50156 4.43125 8.44531 4.375 8.37656 4.375H7.625C7.55625 4.375 7.5 4.43125 7.5 4.5V8.80313C7.5 8.84375 7.51875 8.88125 7.55156 8.90469L10.1359 10.7891C10.1922 10.8297 10.2703 10.8172 10.3109 10.7625L10.7578 10.1531C10.7984 10.0953 10.7859 10.0172 10.7297 9.97812Z" fill="#3333CC"/>
                </svg>
                <span><?=$arResult['DISPLAY_PROPERTIES']['EVENT_TIME']['DISPLAY_VALUE']?></span>
            </p>
            <?endif;?>
            <a href="#learning" data-popup seminar-name="<?=$arResult['NAME']?>" seminar-type="<?=$arResult['PROPERTIES']['TYPE']['VALUE']?>" class="button _free-size">Записаться на <?=$arResult['PROPERTIES']['TYPE']['VALUE']?></a>
        </div>
        <section class="content-text">
            <?=$arResult['~DETAIL_TEXT']?>
        </section>
        <section class="content-text">
            <h3><?if(count($arResult['LEADER_TEST'])>1){echo 'Технологи семинара';}else echo 'Технолог семинара';?></h3>
<!--            --><?php //if($USER->isAdmin()){p($arResult['LEADER_TEST']);}?>
            <div class="test" style="display: flex">
                <?php foreach($arResult['LEADER_TEST'] as $current_item):?>
                    <?$leaderPic = CFile::ResizeImageGet($current_item['FIELDS']['DETAIL_PICTURE'], array('width'=>285, 'height'=>332), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
                <div class="seminar-detail__who-leads">
                    <div class="seminar-detail__who-leads--picture">
                        <div class="seminar-detail__who-leads-image">
                            <a href="#"><img src="<?=$leaderPic['src']?>" alt="<?=$leaderPic['ALT']?>" title="<?=$leaderPic['TITLE']?>"></a>
                        </div>
                        <div class="seminar-detail__who-leads--image-description">
                            <a class="seminar-detail__who-leads--image-description-link" href="#"><?=$current_item['FIELDS']['NAME']?></a>
                            <span class="seminar-detail__who-leads--image-description-post"><?=$current_item['PROPERTIES']['POSITION']['VALUE_ENUM']?></span>
<!--                            <span class="seminar-detail__who-leads--image-description-city">--><?//=$current_item['PROPERTIES']['LOCATION']['DISPLAY_ARRAY']['NAME']?><!--</span>-->
                        </div>
                    </div>
                    <div class="seminar-detail__who-leads-description">
                        <?=$current_item['FIELDS']['~DETAIL_TEXT']?>
                    </div>
                </div>
                <?endforeach;?>
            </div>
        </section>
        <? if(!empty($arResult['LEADER']['PROPERTIES']['REWARDS']['VALUE'])):?>
        <p>Награды и дипломы технологов</p>
        <section class="images-list">
            <?php foreach($arResult['LEADER_TEST'] as $current_item):?>
                <?foreach($current_item['PROPERTIES']['REWARDS']['VALUE'] as $sert):?>
                    <?
                        $pic = CFile::ResizeImageGet($sert, array('width'=>183, 'height'=>259), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                        $picFull = CFile::GetPath($sert);
                    ?>
                    <a data-image-popup="" href="<?=$picFull?>"><img src="<?=$pic['src']?>"></a>
                <?endforeach;?>
            <?endforeach;?>
        </section>
        <? endif;?>
    </div>
    <?if(!empty($arResult['PROPERTIES']['PRODUCT_LINE']['VALUE'])):?>
        <section class="product-lines">
            <div class="container">
                <section class="content-text">
                    <h3>ДЛЯ СЕМИНАРА БУДУТ ИСПОЛЬЗОВАТЬСЯ ЛИНЕЙКИ ПРОДУКЦИИ «CONCEPT»  </h3>
                </section>
            </div>
            <?
            global $arrSectionListFilter;
            $arrSectionListFilter['ID'] = $arResult['PROPERTIES']['PRODUCT_LINE']['VALUE'];
            $APPLICATION->IncludeComponent(
                    "bitrix:catalog.section.list",
                    "products-line.slider",
                    array(
                        "VIEW_MODE" => "TEXT",
                        "SHOW_PARENT_NAME" => "Y",
                        "IBLOCK_TYPE" => "catalog",
                        "IBLOCK_ID" => "2",
                        "SECTION_ID" => "",
                        "SECTION_CODE" => "",
                        "SECTION_URL" => "",
                        "COUNT_ELEMENTS" => "N",
                        "TOP_DEPTH" => "2",
                        "SECTION_FIELDS" => array(
                            0 => "ID",
                            1 => "CODE",
                            2 => "NAME",
                            3 => "DESCRIPTION",
                            4 => "DETAIL_PICTURE",
                            5 => "",
                        ),
                        "SECTION_USER_FIELDS" => array(
                            0 => "UF_TO_MAIN",
                            1 => "UF_SLIDER_TEXT",
                            2 => "",
                        ),
                        "ADD_SECTIONS_CHAIN" => "Y",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "36000000",
                        "CACHE_NOTES" => "",
                        "CACHE_GROUPS" => "Y",
                        "COMPONENT_TEMPLATE" => ".default",
                        "COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
                        "FILTER_NAME" => "arrSectionListFilter",
                        "CACHE_FILTER" => "N",
                        "INCLUDE_EXTRA_SLIDES" => "N"
                    ),
                    false
                );
            ?>
        </section>
    <?endif;?>
    <?if(!empty($arResult['PROPERTIES']['PRODUCT']['VALUE'])):?>
        <section class="novelties">
            <div class="container">
                    <h2>ПРОДУКТЫ ДЛЯ СЕМИНАРА</h2>
            </div>
            <?
            global $arrNoveltiesFilter;
            $arrNoveltiesFilter['ID'] = $arResult['PROPERTIES']['PRODUCT']['VALUE'];
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
            );
            ?>
        </section>
    <?endif;?>
    <?
    // 41861
    if(!empty($arResult['PROPERTIES']['PRODUCT_INFINITY']['VALUE'])):
        global $arrNoveltiesInfinityFilter;
        $arrNoveltiesInfinityFilter['ID'] = $arResult['PROPERTIES']['PRODUCT_INFINITY']['VALUE'];
        if(empty($arResult['PROPERTIES']['PRODUCT']['VALUE'])):?>
            <div class="container">
                <h2>ПРОДУКТЫ ДЛЯ СЕМИНАРА</h2>
            </div>
        <?endif;?>
        <?
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
                "FILTER_NAME" => "arrNoveltiesInfinityFilter",
                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                "IBLOCK_ID" => "45",
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
        );
        ?>
    <?endif;?>
    <?$APPLICATION->IncludeComponent("bitrix:news.list", "slider_banner_seminar", Array(
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
		"DISPLAY_DATE" => "N",	// Выводить дату элемента
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
		"IBLOCK_ID" => "26",	// Код информационного блока
		"IBLOCK_TYPE" => "content",	// Тип информационного блока (используется только для проверки)
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
		"INCLUDE_SUBSECTIONS" => "N",	// Показывать элементы подразделов раздела
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
			0 => "",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
		"SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
		"SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
		"SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
		"SET_STATUS_404" => "Y",	// Устанавливать статус 404
		"SET_TITLE" => "N",	// Устанавливать заголовок страницы
		"SHOW_404" => "N",	// Показ специальной страницы
		"SORT_BY1" => "ACTIVE_FROM",	// Поле для первой сортировки новостей
		"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
		"SORT_ORDER1" => "DESC",	// Направление для первой сортировки новостей
		"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
		"STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела для показа списка
	),
	false
);?><br>
<!--    <section id="fullPageSlider-1" data-full-page-slider class="full-page-slider swiper-container">-->
<!--        --><?//
//        $APPLICATION->IncludeComponent(
//            "bitrix:news.list",
//            "fullPage.slider",
//            array(
//                "ACTIVE_DATE_FORMAT" => "d.m.Y",
//                "ADD_SECTIONS_CHAIN" => "N",
//                "AJAX_MODE" => "N",
//                "AJAX_OPTION_ADDITIONAL" => "",
//                "AJAX_OPTION_HISTORY" => "N",
//                "AJAX_OPTION_JUMP" => "N",
//                "AJAX_OPTION_STYLE" => "Y",
//                "CACHE_FILTER" => "N",
//                "CACHE_GROUPS" => "Y",
//                "CACHE_TIME" => "36000000",
//                "CACHE_TYPE" => "A",
//                "CHECK_DATES" => "Y",
//                "DETAIL_URL" => "",
//                "DISPLAY_BOTTOM_PAGER" => "N",
//                "DISPLAY_DATE" => "Y",
//                "DISPLAY_NAME" => "Y",
//                "DISPLAY_PICTURE" => "Y",
//                "DISPLAY_PREVIEW_TEXT" => "Y",
//                "DISPLAY_TOP_PAGER" => "N",
//                "FIELD_CODE" => array(
//                    0 => "ID",
//                    1 => "CODE",
//                    2 => "PREVIEW_PICTURE",
//                    3 => "DETAIL_PICTURE",
//                    4 => "",
//                ),
//                "FILTER_NAME" => "arrSliderFilter",
//                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
//                "IBLOCK_ID" => "7",
//                "IBLOCK_TYPE" => "banners",
//                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
//                "INCLUDE_SUBSECTIONS" => "Y",
//                "MESSAGE_404" => "",
//                "NEWS_COUNT" => "20",
//                "PAGER_BASE_LINK_ENABLE" => "N",
//                "PAGER_DESC_NUMBERING" => "N",
//                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
//                "PAGER_SHOW_ALL" => "N",
//                "PAGER_SHOW_ALWAYS" => "N",
//                "PAGER_TEMPLATE" => ".default",
//                "PAGER_TITLE" => "Новости",
//                "PARENT_SECTION" => "",
//                "PARENT_SECTION_CODE" => "",
//                "PREVIEW_TRUNCATE_LEN" => "",
//                "PROPERTY_CODE" => array(
//                    0 => "",
//                    1 => "",
//                    2 => "",
//                    3 => "",
//                    4 => "",
//                ),
//                "SET_BROWSER_TITLE" => "N",
//                "SET_LAST_MODIFIED" => "N",
//                "SET_META_DESCRIPTION" => "N",
//                "SET_META_KEYWORDS" => "N",
//                "SET_STATUS_404" => "N",
//                "SET_TITLE" => "N",
//                "SHOW_404" => "N",
//                "SORT_BY1" => "ACTIVE_FROM",
//                "SORT_BY2" => "SORT",
//                "SORT_ORDER1" => "DESC",
//                "SORT_ORDER2" => "ASC",
//                "STRICT_SECTION_CHECK" => "N",
//                "COMPONENT_TEMPLATE" => "fullPage.slider"
//            ),
//            false
//        );?>
<!--    </section> -->
    <section class="ask-question">
        <div class="container">
            <div class="ask-question__text">
<!--                <p>Вы всегда можете написать нам по любому интересующему Вас вопросу. Для этого необходимо заполнить форму и отправить её. Наши специалисты ответят Вам в течение 24 часов.</p>-->
                <p>Для записи на семинар заполните заявку. Наш менеджер свяжется с вами для уточнения деталей.</p>
            </div>
            <div class="ask-question__button"><a href="#askQuestion" data-popup class="button _big">Задать вопрос</a></div>
        </div>
    </section>
</section>