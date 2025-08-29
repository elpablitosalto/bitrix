<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("О компании");
?><div class="page__content-top">
	<div class="page__holder">
		<div class="page__top-wrapper">
			<div class="page__breadcrumbs">
				 <!-- begin .breadcrumbs--> <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "main",
                    Array(
                        "START_FROM" => "0",
                        "SITE_ID" => "s1"
                    )
                ); ?> <!-- end .breadcrumbs-->
			</div>
		</div>
	</div>
</div>
<div class="page__section">
	<div class="page__holder">
		 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"about_team",
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
			1 => "PREVIEW_TEXT",
			2 => "",
		),
		"FILTER_NAME" => "",	// Фильтр
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
		"IBLOCK_ID" => "20",	// Код информационного блока
		"IBLOCK_TYPE" => "content",	// Тип информационного блока (используется только для проверки)
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
		"INCLUDE_SUBSECTIONS" => "N",	// Показывать элементы подразделов раздела
		"MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
		"NEWS_COUNT" => "20",	// Количество новостей на странице
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
			0 => "LEFT_POSITION",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
		"SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
		"SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
		"SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
		"SET_STATUS_404" => "N",	// Устанавливать статус 404
		"SET_TITLE" => "N",	// Устанавливать заголовок страницы
		"SHOW_404" => "N",	// Показ специальной страницы
		"SORT_BY1" => "SORT",	// Поле для первой сортировки новостей
		"SORT_BY2" => "ID",	// Поле для второй сортировки новостей
		"SORT_ORDER1" => "ASC",	// Направление для первой сортировки новостей
		"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
		"STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела для показа списка
		"TITLE" => "Нескучные финансы"
	)
);?>
	</div>
</div>
<div class="page__section">
	<div class="page__holder">
		 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"quote_list",
	array(
	"ACTIVE_DATE_FORMAT" => "M j, Y",	// Формат показа даты
		"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
		"AJAX_MODE" => "N",	// Включить режим AJAX
		"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_SHADOW" => "Y",
		"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
		"BACKGROUND_IMAGE" => "/upload/medialibrary/e97/4c22kdxvtywsj7jgdl4or52p9pt43uy8.png",
		"BACKGROUND_IMAGE_L" => "/upload/medialibrary/f00/jg76h8t2eb8ncgn0l3c2t7t2govhh3t3.png",
		"BACKGROUND_IMAGE_M" => "/upload/medialibrary/ce4/8knbtx5j04crhfszyang9qtcaz2o5e29.png",
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
			1 => "PREVIEW_TEXT",
			2 => "",
		),
		"FILTER_NAME" => "",	// Фильтр
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
		"IBLOCK_ID" => "21",	// Код информационного блока
		"IBLOCK_TYPE" => "content",	// Тип информационного блока (используется только для проверки)
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
		"INCLUDE_SUBSECTIONS" => "N",	// Показывать элементы подразделов раздела
		"MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
		"NEWS_COUNT" => "20",	// Количество новостей на странице
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
			0 => "PHOTO",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
		"SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
		"SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
		"SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
		"SET_STATUS_404" => "N",	// Устанавливать статус 404
		"SET_TITLE" => "N",	// Устанавливать заголовок страницы
		"SHOW_404" => "N",	// Показ специальной страницы
		"SORT_BY1" => "SORT",	// Поле для первой сортировки новостей
		"SORT_BY2" => "ID",	// Поле для второй сортировки новостей
		"SORT_ORDER1" => "ASC",	// Направление для первой сортировки новостей
		"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
		"STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела для показа списка
		"TITLE" => "Нескучные финансы"
	)
);?>
	</div>
</div>
<div class="page__section page__section_decoration_bottom">
	 <!-- begin .section-->
	<div class="section section_space_close">
		<div class="section__content">
			<div class="section__following">
				 <!-- begin .following-->
				<div class="following">
					<div class="following__container swiper js-following-carousel">
						<div class="following__wrapper swiper-wrapper">
							 <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/include/text_carousel/main.php",
                                Array(),
                                Array("MODE" => "html", "NAME" => "TEXT_CAROUSEL")
                            );?>
						</div>
					</div>
				</div>
				 <!-- end .following-->
			</div>
		</div>
	</div>
	 <!-- end .section-->
</div>
<div class="page__section page__section_style_secondary">
	<div class="page__holder">
		 <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/include/about/chain_group.php",
        Array(),
        Array("MODE" => "html", "NAME" => "FOOTER_PHONE")
    );?>
	</div>
</div>
 <?
  $APPLICATION->IncludeComponent("bitrix:news.list", "video_carousel", array(
      "TITLE" => "Атмосфера",
      "TITLE_POSTFIX" => "наших встреч",
      "IBLOCK_TYPE" => "content",
      "IBLOCK_ID" => "22",
      "NEWS_COUNT" => "30",
      "SORT_BY1" => "SORT",
      "SORT_ORDER1" => "ASC",
      "SORT_BY2" => "ID",
      "SORT_ORDER2" => "ASC",
      "FILTER_NAME" => "",
      "FIELD_CODE" => array(
          "NAME",
          "PREVIEW_PICTURE",
          "PREVIEW_TEXT",
      ),
      "PROPERTY_CODE" => array(
          "YOUTUBE_LINK",
          "TITLE",
      ),
      "CHECK_DATES" => "Y",
      "DETAIL_URL" => "",
      "AJAX_MODE" => "N",
      "AJAX_OPTION_SHADOW" => "Y",
      "AJAX_OPTION_JUMP" => "N",
      "AJAX_OPTION_STYLE" => "Y",
      "AJAX_OPTION_HISTORY" => "N",
      "CACHE_TYPE" => "A",
      "CACHE_TIME" => "36000000",
      "CACHE_FILTER" => "N",
      "CACHE_GROUPS" => "Y",
      "ACTIVE_DATE_FORMAT" => "M j, Y",
      "DISPLAY_PANEL" => "N",
      "SET_TITLE" => "N",
      "SET_STATUS_404" => "N",
      "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
      "ADD_SECTIONS_CHAIN" => "N",
      "HIDE_LINK_WHEN_NO_DETAIL" => "N",
      "PARENT_SECTION" => "",
      "PARENT_SECTION_CODE" => "",
      "DISPLAY_TOP_PAGER" => "N",
      "DISPLAY_BOTTOM_PAGER" => "N",
      "PAGER_TITLE" => "News",
      "PAGER_SHOW_ALWAYS" => "N",
      "PAGER_TEMPLATE" => "",
      "PAGER_DESC_NUMBERING" => "N",
      "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000000",
      "PAGER_SHOW_ALL" => "N",
      "AJAX_OPTION_ADDITIONAL" => ""
  ),
      false
  );
?> <?
  $APPLICATION->IncludeComponent("bitrix:news.list", "about_advantages", array(
      "TITLE" => "Почему нас выбирают",
      "IBLOCK_TYPE" => "content",
      "IBLOCK_ID" => "23",
      "NEWS_COUNT" => "30",
      "SORT_BY1" => "SORT",
      "SORT_ORDER1" => "ASC",
      "SORT_BY2" => "ID",
      "SORT_ORDER2" => "ASC",
      "FILTER_NAME" => "",
      "FIELD_CODE" => array(
          "NAME",
          "PREVIEW_TEXT",
      ),
      "PROPERTY_CODE" => array(
          "ICON",
      ),
      "CHECK_DATES" => "Y",
      "DETAIL_URL" => "",
      "AJAX_MODE" => "N",
      "AJAX_OPTION_SHADOW" => "Y",
      "AJAX_OPTION_JUMP" => "N",
      "AJAX_OPTION_STYLE" => "Y",
      "AJAX_OPTION_HISTORY" => "N",
      "CACHE_TYPE" => "A",
      "CACHE_TIME" => "36000000",
      "CACHE_FILTER" => "N",
      "CACHE_GROUPS" => "Y",
      "ACTIVE_DATE_FORMAT" => "M j, Y",
      "DISPLAY_PANEL" => "N",
      "SET_TITLE" => "N",
      "SET_STATUS_404" => "N",
      "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
      "ADD_SECTIONS_CHAIN" => "N",
      "HIDE_LINK_WHEN_NO_DETAIL" => "N",
      "PARENT_SECTION" => "",
      "PARENT_SECTION_CODE" => "",
      "DISPLAY_TOP_PAGER" => "N",
      "DISPLAY_BOTTOM_PAGER" => "N",
      "PAGER_TITLE" => "News",
      "PAGER_SHOW_ALWAYS" => "N",
      "PAGER_TEMPLATE" => "",
      "PAGER_DESC_NUMBERING" => "N",
      "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000000",
      "PAGER_SHOW_ALL" => "N",
      "AJAX_OPTION_ADDITIONAL" => ""
  ),
      false
  );
?>
<div class="page__section">
	<div class="page__holder page__holder_mobile-gutter_s">
		 <!-- begin .section--> <?
      $GLOBALS["excursionBannersFilter"] = [
          "PROPERTY_TYPE_VALUE" => "Баннер-панель"
      ];
      $APPLICATION->IncludeComponent("bitrix:news.list", "excursion_banners", array(
          "IBLOCK_TYPE" => "content",
          "IBLOCK_ID" => "27",
          "NEWS_COUNT" => "30",
          "SORT_BY1" => "SORT",
          "SORT_ORDER1" => "ASC",
          "SORT_BY2" => "ID",
          "SORT_ORDER2" => "ASC",
          "FILTER_NAME" => "excursionBannersFilter",
          "FIELD_CODE" => array(),
          "PROPERTY_CODE" => array(
              0 => "TYPE",
          ),
          "CHECK_DATES" => "Y",
          "DETAIL_URL" => "",
          "AJAX_MODE" => "N",
          "AJAX_OPTION_SHADOW" => "Y",
          "AJAX_OPTION_JUMP" => "N",
          "AJAX_OPTION_STYLE" => "Y",
          "AJAX_OPTION_HISTORY" => "N",
          "CACHE_TYPE" => "A",
          "CACHE_TIME" => "36000000",
          "CACHE_FILTER" => "N",
          "CACHE_GROUPS" => "Y",
          "ACTIVE_DATE_FORMAT" => "M j, Y",
          "DISPLAY_PANEL" => "N",
          "SET_TITLE" => "N",
          "SET_STATUS_404" => "N",
          "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
          "ADD_SECTIONS_CHAIN" => "N",
          "HIDE_LINK_WHEN_NO_DETAIL" => "N",
          "PARENT_SECTION" => "",
          "PARENT_SECTION_CODE" => "",
          "DISPLAY_TOP_PAGER" => "N",
          "DISPLAY_BOTTOM_PAGER" => "N",
          "PAGER_TITLE" => "News",
          "PAGER_SHOW_ALWAYS" => "N",
          "PAGER_TEMPLATE" => "",
          "PAGER_DESC_NUMBERING" => "N",
          "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000000",
          "PAGER_SHOW_ALL" => "N",
          "AJAX_OPTION_ADDITIONAL" => ""
      ),
          false
      );
      ?> <!-- end .section-->
	</div>
</div>
<div class="page__section page__section_decoration_bottom">
	 <!-- begin .section-->
	<div class="section section_space_close">
		<div class="section__content">
			<div class="section__following">
				 <!-- begin .following-->
				<div class="following">
					<div class="following__container swiper js-following-carousel">
						<div class="following__wrapper swiper-wrapper">
							 <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/include/text_carousel/main.php",
                                Array(),
                                Array("MODE" => "html", "NAME" => "TEXT_CAROUSEL")
                            );?>
						</div>
					</div>
				</div>
				 <!-- end .following-->
			</div>
		</div>
	</div>
	 <!-- end .section-->
</div><? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>