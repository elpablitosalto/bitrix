<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
$APPLICATION->SetTitle("Авторы");

/*
Нужно для редиректа при переходе на статьи из хлебных крошек страницы эксперта
Переменная задается в local/templates/nfinance/components/bitrix/news/gazeta/detail.php
*/

if($APPLICATION->GetCurPage() === "/gazeta/authors/") {
	$url = !empty($_SESSION['LAST_ARTICLE']) ? $_SESSION['LAST_ARTICLE'] : "/gazeta/";
	LocalRedirect($url);
}

?>
	<div class="page__content-top">
		<div class="page__holder">
			<div class="page__top-wrapper">
				<div class="page__breadcrumbs">
					<!-- begin .breadcrumbs-->
					<? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "main",
						Array(
							"START_FROM" => "0",
							"SITE_ID" => "s1"
						)
					); ?>
					<!-- end .breadcrumbs-->
				</div>
				<div class="page__search">
					<!-- begin .search-panel-->
					<? $APPLICATION->IncludeComponent(
						"bitrix:search.title",
						"gazeta",
						array(
							"SHOW_INPUT" => "Y",
							"SHOW_OTHERS" => "N",
							"INPUT_ID" => "gazeta-body-search-input",
							"CONTAINER_ID" => "gazeta-body-search",
							"PRICE_VAT_INCLUDE" => "Y",
							"PREVIEW_TRUNCATE_LEN" => "150",
							"SHOW_PREVIEW" => "Y",
							"PREVIEW_WIDTH" => "75",
							"PREVIEW_HEIGHT" => "75",
							"CONVERT_CURRENCY" => "Y",
							"CURRENCY_ID" => "RUB",
							"PAGE" => "#SITE_DIR#search/",
							"NUM_CATEGORIES" => "1",
							"TOP_COUNT" => "10",
							"ORDER" => "date",
							"USE_LANGUAGE_GUESS" => "Y",
							"CHECK_DATES" => "Y",
							"SHOW_OTHERS" => "Y",
							"CATEGORY_0_TITLE" => "Новости",
							"CATEGORY_0" => array(
								0 => "iblock_newspaper",
							),
							"CATEGORY_0_iblock_news" => array(
								0 => "all",
							),
							"CATEGORY_1_TITLE" => "Форумы",
							"CATEGORY_1" => array(
								0 => "forum",
							),
							"CATEGORY_1_forum" => array(
								0 => "all",
							),
							"CATEGORY_2_TITLE" => "Каталоги",
							"CATEGORY_2" => array(
								0 => "iblock_books",
							),
							"CATEGORY_2_iblock_books" => "all",
							"CATEGORY_OTHERS_TITLE" => "Прочее",
							"COMPONENT_TEMPLATE" => "gazeta",
							"CATEGORY_0_iblock_content" => array(
								0 => "all",
							),
							"CATEGORY_0_iblock_newspaper" => array(
								0 => "4",
								1 => "5",
								2 => "6",
							)
						),
						false
					); ?>
					<!-- end .search-panel-->
				</div>
			</div>
		</div>
	</div>
	<div class="page__section">
		<div class="page__holder">
				<div class="section section_space_top-close">
					<div class="section__content">
						<? $APPLICATION->IncludeComponent("bitrix:news", "authors", Array(
								"IBLOCK_TYPE" => "newspaper",	// Тип инфоблока
								"IBLOCK_ID" => "5",	// Инфоблок
								"NEWS_COUNT" => "20",	// Количество новостей на странице
								"USE_SEARCH" => "N",	// Разрешить поиск
								"USE_RSS" => "N",	// Разрешить RSS
								"USE_RATING" => "N",	// Разрешить голосование
								"USE_CATEGORIES" => "N",	// Выводить материалы по теме
								"USE_FILTER" => "N",	// Показывать фильтр
								"SORT_BY1" => "ACTIVE_FROM",	// Поле для первой сортировки новостей
								"SORT_ORDER1" => "DESC",	// Направление для первой сортировки новостей
								"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
								"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
								"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
								"SEF_MODE" => "Y",	// Включить поддержку ЧПУ
								"SEF_FOLDER" => "/gazeta/authors/",	// Каталог ЧПУ (относительно корня сайта)
								"AJAX_MODE" => "N",	// Включить режим AJAX
								"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
								"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
								"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
								"CACHE_TYPE" => "A",	// Тип кеширования
								"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
								"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
								"CACHE_GROUPS" => "Y",	// Учитывать права доступа
								"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
								"SET_STATUS_404" => "Y",	// Устанавливать статус 404
								"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
								"ADD_SECTIONS_CHAIN" => "Y",	// Включать раздел в цепочку навигации
								"ADD_ELEMENT_CHAIN" => "Y",	// Включать название элемента в цепочку навигации
								"USE_PERMISSIONS" => "N",	// Использовать дополнительное ограничение доступа
								"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
								"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
								"LIST_FIELD_CODE" => array(	// Поля
									0 => "ID",
									1 => "CODE",
									2 => "XML_ID",
									3 => "NAME",
									4 => "",
								),
								"LIST_PROPERTY_CODE" => array(	// Свойства
									0 => "",
									1 => "",
								),
								"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
								"DISPLAY_NAME" => "N",	// Выводить название элемента
								"META_KEYWORDS" => "-",	// Установить ключевые слова страницы из свойства
								"META_DESCRIPTION" => "-",	// Установить описание страницы из свойства
								"BROWSER_TITLE" => "-",	// Установить заголовок окна браузера из свойства
								"DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
								"DETAIL_FIELD_CODE" => array(	// Поля
									0 => "ID",
									1 => "CODE",
									2 => "XML_ID",
									3 => "NAME",
									4 => "TAGS",
									5 => "SORT",
									6 => "PREVIEW_TEXT",
									7 => "PREVIEW_PICTURE",
									8 => "DETAIL_TEXT",
									9 => "DETAIL_PICTURE",
									10 => "DATE_ACTIVE_FROM",
									11 => "ACTIVE_FROM",
									12 => "DATE_ACTIVE_TO",
									13 => "ACTIVE_TO",
									14 => "SHOW_COUNTER",
									15 => "SHOW_COUNTER_START",
									16 => "IBLOCK_TYPE_ID",
									17 => "IBLOCK_ID",
									18 => "IBLOCK_CODE",
									19 => "IBLOCK_NAME",
									20 => "IBLOCK_EXTERNAL_ID",
									21 => "DATE_CREATE",
									22 => "CREATED_BY",
									23 => "CREATED_USER_NAME",
									24 => "TIMESTAMP_X",
									25 => "MODIFIED_BY",
									26 => "USER_NAME",
									27 => "",
								),
								"DETAIL_PROPERTY_CODE" => array(	// Свойства
									0 => "SHORT_PARAMETERS",
									1 => "PARAMETERS",
									2 => "",
								),
								"DETAIL_DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
								"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
								"DETAIL_PAGER_TITLE" => "Страница",	// Название категорий
								"DETAIL_PAGER_TEMPLATE" => "",	// Название шаблона
								"DETAIL_PAGER_SHOW_ALL" => "Y",	// Показывать ссылку "Все"
								"PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
								"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
								"DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
								"PAGER_TITLE" => "Новости",	// Название категорий
								"PAGER_SHOW_ALWAYS" => "Y",	// Выводить всегда
								"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
								"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
								"PAGER_SHOW_ALL" => "Y",	// Показывать ссылку "Все"
								"DISPLAY_DATE" => "Y",	// Выводить дату элемента
								"DISPLAY_PICTURE" => "Y",	// Выводить изображение для анонса
								"DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса
								"USE_SHARE" => "N",	// Отображать панель соц. закладок
								"SHOW_TAGS" => "Y",
								"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
								"COMPONENT_TEMPLATE" => ".default",
								"USE_REVIEW" => "N",	// Разрешить отзывы
								"SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
								"STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела
								"DETAIL_SET_CANONICAL_URL" => "N",	// Устанавливать канонический URL
								"PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
								"SHOW_404" => "N",	// Показ специальной страницы
								"MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
								"SEF_URL_TEMPLATES" => array(
									"news" => "index.php",
									"section" => "#SECTION_CODE_PATH#",
									"detail" => "#ELEMENT_CODE#",
								)
							),
							false
						);?>
					</div>
				</div>
		</div>
	</div>
<? require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');?>