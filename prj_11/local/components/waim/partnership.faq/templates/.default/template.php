<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}
/** @var array $arParams */
/** @var array $arResult */
/** @var CMain $APPLICATION */
/** @var CUser $USER */
/** @var CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
?>
<div class="page__section">
	<div class="page__holder">
		<!-- begin .section-->
		<div class="section">
			<div class="section__header">
				<div class="section__title">
					<!-- begin .title-->
					<h2 class="title title_size_h2"><?=$arParams["TITLE"]?></h2>
					<!-- end .title-->
				</div>
			</div>
			<div class="section__content">
				<?if(!empty($arParams["IBLOCK_ID"])):?>
					<?$APPLICATION->IncludeComponent(
						"bitrix:news.list",
						"accordion_group",
						array(
						"ACTIVE_DATE_FORMAT" => "M j, Y",	// Формат показа даты
							"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
							"AJAX_MODE" => "N",	// Включить режим AJAX
							"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
							"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
							"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
							"AJAX_OPTION_SHADOW" => "Y",
							"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
							"BACKGROUND_IMAGE" => "/upload/medialibrary/a85/pses4656pqs8fcim7kh9uwfekfct7878.png",
							"BACKGROUND_IMAGE_L" => "/upload/medialibrary/57b/80ts3st2ghubvy3k62vevazt61q5aubr.png",
							"BACKGROUND_IMAGE_M" => "/upload/medialibrary/619/hp918zh9setquza1r74h4wc0iby6f7iv.png",
							"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
							"CACHE_GROUPS" => "Y",	// Учитывать права доступа
							"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
							"CACHE_TYPE" => "A",	// Тип кеширования
							"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
							"COMPONENT_TEMPLATE" => "about_team",
							"DESCRIPTION" => "Нам важно, чтобы клиенты и команда получали пользу и радовались жизни               ",
							"DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
							"DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
							"DISPLAY_PANEL" => "N",
							"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
							"FIELD_CODE" => array(	// Поля
								0 => "NAME",
								1 => "",
								2 => "",
							),
							"FILTER_NAME" => "",	// Фильтр
							"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
							"IBLOCK_ID" => $arParams["IBLOCK_ID"],	// Код информационного блока
							"IBLOCK_TYPE" => "",	// Тип информационного блока (используется только для проверки)
							"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
							"INCLUDE_SUBSECTIONS" => "N",	// Показывать элементы подразделов раздела
							"MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
							"NEWS_COUNT" => !empty($arParams["COUNT"]) ? $arParams["COUNT"] : 6,	// Количество новостей на странице
							"PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
							"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
							"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000000",	// Время кеширования страниц для обратной навигации
							"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
							"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
							"PAGER_TEMPLATE" => "",	// Шаблон постраничной навигации
							"PAGER_TITLE" => "News",	// Название категорий
							"PARENT_SECTION" => "",	// ID раздела
							"PARENT_SECTION_CODE" => "",	// Код раздела
							"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
							"PROPERTY_CODE" => array(	// Свойства
								0 => "IMAGE",
								1 => "IMAGE_XS",
								2 => "IMAGE_S",
								3 => "IMAGE_M",
								4 => "SHOW_FORM_BUTTON",
								5 => "DESCRIPTION",
								6 => "LIST",
								7 => "",
							),
							"SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
							"SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
							"SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
							"SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
							"SET_STATUS_404" => "N",	// Устанавливать статус 404
							"SET_TITLE" => "N",	// Устанавливать заголовок страницы
							"SHOW_404" => "N",	// Показ специальной страницы
							"SORT_BY1" => "ID",	// Поле для первой сортировки новостей
							"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
							"SORT_ORDER1" => "ASC",	// Направление для первой сортировки новостей
							"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
							"STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела для показа списка
						)
					);?>
				<?endif;?>
			</div>
		</div>
		<!-- end .section-->
	</div>
</div>