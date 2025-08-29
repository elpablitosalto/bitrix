<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Application,
	Bitrix\Main\Context,
	Bitrix\Main\Request;

$context = Context::getCurrent();
$request = $context->getRequest();

$currentTabCode = $request->getQuery('tab');

$APPLICATION->IncludeComponent("bitrix:search.page", ".default", Array(
	"COMPONENT_TEMPLATE" => "",
		"arrFILTER" => array(	// Ограничение области поиска
			0 => "main",
			1 => "iblock_movies",
			2 => "iblock_contests",
		),
		"arrFILTER_iblock_movies" => array(	// Искать в информационных блоках типа "iblock_movies"
			0 => Indexis::getIblockId("movies"),
		),
		"arrFILTER_iblock_contests" => array(	// Искать в информационных блоках типа "iblock_contests"
			0 => Indexis::getIblockId("contests"),
		),
		"arrFILTER_main" => array(	// Путь к файлу начинается с любого из перечисленных
			0 => "/about/",
			1 => "/partners/",
		),
		"arrWHERE" => $arFilterParamsByIblockCode,	// Значения для выпадающего списка "Где искать"
		"TAGS_SORT" => "NAME",
		"TAGS_PAGE_ELEMENTS" => "3",
		"TAGS_PERIOD" => "3",
		"TAGS_URL_SEARCH" => "/search/index.php",
		"TAGS_INHERIT" => "Y",
		"FONT_MAX" => "50",
		"FONT_MIN" => "10",
		"COLOR_NEW" => "000000",
		"COLOR_OLD" => "C8C8C8",
		"PERIOD_NEW_TAGS" => "",
		"SHOW_CHAIN" => "Y",
		"COLOR_TYPE" => "Y",
		"WIDTH" => "100%",
		"USE_SUGGEST" => "Y",	// Показывать подсказку с поисковыми фразами
		"SHOW_RATING" => "N",
		"PATH_TO_USER_PROFILE" => "",
		"AJAX_MODE" => "N",	// Включить режим AJAX
		"RESTART" => "Y",	// Искать без учета морфологии (при отсутствии результата поиска)
		"NO_WORD_LOGIC" => "N",	// Отключить обработку слов как логических операторов
		"USE_LANGUAGE_GUESS" => "N",	// Включить автоопределение раскладки клавиатуры
		"CHECK_DATES" => "Y",	// Искать только в активных по дате документах
		"USE_TITLE_RANK" => "Y",	// При ранжировании результата учитывать заголовки
		"DEFAULT_SORT" => "rank",	// Сортировка по умолчанию
		"SHOW_WHERE" => "Y",	// Показывать выпадающий список "Где искать"
		"SHOW_WHEN" => "N",	// Показывать фильтр по датам
		"PAGE_RESULT_COUNT" => "1000",	// Количество результатов на странице
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "3600",	// Время кеширования (сек.)
		"DISPLAY_TOP_PAGER" => "N",	// Выводить над результатами
		"DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под результатами
		"PAGER_TITLE" => "Результаты поиска",	// Название результатов поиска
		"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
		"PAGER_TEMPLATE" => "",	// Название шаблона
		"AJAX_OPTION_SHADOW" => "Y",
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
		"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
		"CURRENT_TAB_CODE" => $currentTabCode,	// Дополнительный идентификатор
	),
	false
);
?>

