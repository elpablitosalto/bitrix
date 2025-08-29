<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Карта дистрибьюторов");
use Bitrix\Main\Page\Asset;
$asset = Asset::getInstance();
$asset->addJs(SITE_TEMPLATE_PATH . '/js/map-distributors.js');
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_TEMPLATE_PATH."/include/seo/seo.php",
		"AREA_FILE_RECURSIVE" => "N",
		"EDIT_MODE" => "html",
		"SEO_ID" => "4745",
		"TARGET_URI" => "/distributors/",
		"TARGET_ROOT" => '',
		"PAGE_URI" => $_SERVER['REQUEST_URI'],
		"PAGE_QUERY" => $_SERVER['QUERY_STRING']
	),
	false,
);?>
<section class="content">
    <div class="container _inside-page">
        <div class="breadcrumbs">
            <ul class="breadcrumbs-list">
                <li class="breadcrumbs-list__item"><a href="/">Главная</a></li>
                <li class="breadcrumbs-list__item"><a href="/about/">О компании</a></li>
                <li class="breadcrumbs-list__item">Дистрибьюторы</li>
            </ul>
        </div>
        <h1>Дистрибьюторы</h1><br>
        <div class="map-distributors">
            <div class="map-distributors__header">
                <div class="map-distributors__field-group">
                    <div class="map-distributors__select">
                        <select id="distributorsCountry" class="map-distributors__select-field">
                            <option disabled selected>Выбор страны</option>
                            <option value="RU">Россия</option>
                            <option value="BY">Беларусь</option>
                            <option value="KZ">Казахстан</option>
                            <option value="KG">Киргизия</option>
                            <option value="AM">Армения</option>
                            <option value="AZ">Азербайджан</option>
                            <option value="MD">Молдавия</option>
                            <option value="UZ">Узбекистан</option>
                            <option value="GE_AB">Абхазия</option>
                        </select>
                    </div>
                    <div class="map-distributors__search">
                        <div class="map-distributors__search-field">
                            <input type="text" class="map-distributors__input js-map-distributors-search" placeholder="Введите название региона">
                            <button class="map-distributors__search-button" type="submit">
                                <svg class="map-distributors__search-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10 18C11.775 17.9996 13.4988 17.4054 14.897 16.312L19.293 20.708L20.707 19.294L16.311 14.898C17.405 13.4997 17.9996 11.7754 18 10C18 5.589 14.411 2 10 2C5.589 2 2 5.589 2 10C2 14.411 5.589 18 10 18ZM10 4C13.309 4 16 6.691 16 10C16 13.309 13.309 16 10 16C6.691 16 4 13.309 4 10C4 6.691 6.691 4 10 4Z" fill="#959595"/>
                                </svg>
                            </button>
                        </div>
                        <div class="map-distributors__search-results js-map-distributors-results">
                            <ul class="map-distributors__list js-map-distributors-list">
                                <li class="map-distributors__item js-map-distributors-item" hidden><a href="#" class="map-distributors__link js-map-distributors-result"></a></li>
                                <li class="map-distributors__item js-map-distributors-message" hidden>Подходящих результатов не найдено</li>
                            </ul>
                        </div>
                    </div>
                </div>
                 <div class="map-distributors__links">
                    <div class="map-distributors__link-item">
                        <?
                            $arFile = \CIBlockElement::GetList([], ["IBLOCK_ID" => 32, "ACTIVE" => "Y"], false, ["nPageSize" => 1], ["ID", "NAME", "PROPERTY_DISTRIBUTORS_FILE"])->GetNext();
                        ?>
                        <a href="<?=\CFile::GetPath($arFile["PROPERTY_DISTRIBUTORS_FILE_VALUE"])?>" download="<?=$arFile["NAME"]?>.pdf">
                           <svg class="map-distributors__icon" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M11.9999 16C11.7949 16 11.5989 15.916 11.4579 15.768L6.20794 10.268C5.75294 9.792 6.09094 9 6.74994 9H9.49994V3.25C9.49994 2.561 10.0609 2 10.7499 2H13.2499C13.9389 2 14.4999 2.561 14.4999 3.25V9H17.2499C17.9089 9 18.2469 9.792 17.7919 10.268L12.5419 15.768C12.4009 15.916 12.2049 16 11.9999 16Z"/>
                                <path d="M22.25 22H1.75C0.785 22 0 21.215 0 20.25V19.75C0 18.785 0.785 18 1.75 18H22.25C23.215 18 24 18.785 24 19.75V20.25C24 21.215 23.215 22 22.25 22Z"/>
                            </svg>

                            <span class="map-distributors__link-label">
                                Скачать список дистрибьюторов
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="map-distributors__panel" id="map-distributors">
                <?require_once('include/map.php');?>
                <div class="region-tooltip" data-default>
                    <a href="#" class="close-button"></a>
                    <div class="region-tooltip__container">
                        <div class="region-tooltip__header">
                            <p class="region-tooltip__header-title"></p>
                            <p class="region-tooltip__header-region"></p>
                        </div>
                        <div class="swiper-container region-tooltip-slider">
                            <div class="swiper-wrapper">
                            </div>
                        </div>
                        <div class="navigation">
                            <div class="swiper-pagination swiper-pagination-fraction">
                                <span class="swiper-pagination-current">1</span>&nbsp;из<span class="swiper-pagination-total">0</span>
                            </div>
                            <div class="navigation-buttons">
                                <div class="swiper-button-prev">
                                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12.0466 21.4207C12.1921 21.2756 12.3075 21.1032 12.3863 20.9133C12.4651 20.7235 12.5056 20.52 12.5056 20.3145C12.5056 20.1089 12.4651 19.9054 12.3863 19.7156C12.3075 19.5258 12.1921 19.3534 12.0466 19.2082L3.7747 10.9395L12.0466 2.67072C12.34 2.37732 12.5048 1.97939 12.5048 1.56447C12.5048 1.14954 12.34 0.751614 12.0466 0.458218C11.7532 0.164822 11.3552 -3.86498e-06 10.9403 -3.88312e-06C10.5254 -3.90126e-06 10.1275 0.164822 9.83407 0.458218L0.459073 9.83322C0.313563 9.97836 0.198118 10.1508 0.119347 10.3406C0.0405774 10.5304 3.10048e-05 10.7339 3.09958e-05 10.9395C3.09868e-05 11.145 0.0405774 11.3485 0.119347 11.5383C0.198118 11.7282 0.313563 11.9006 0.459073 12.0457L9.83407 21.4207C9.97922 21.5662 10.1516 21.6817 10.3415 21.7604C10.5313 21.8392 10.7348 21.8798 10.9403 21.8798C11.1458 21.8798 11.3493 21.8392 11.5392 21.7604C11.729 21.6817 11.9014 21.5662 12.0466 21.4207Z" fill="#959595"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M21.8777 10.9395C21.8777 10.5251 21.7131 10.1276 21.42 9.8346C21.127 9.54157 20.7296 9.37695 20.3152 9.37695L4.69019 9.37695C4.27579 9.37695 3.87836 9.54157 3.58533 9.8346C3.29231 10.1276 3.12769 10.5251 3.12769 10.9395C3.12769 11.3539 3.29231 11.7513 3.58533 12.0443C3.87836 12.3373 4.27579 12.502 4.69019 12.502L20.3152 12.502C20.7296 12.502 21.127 12.3373 21.42 12.0443C21.7131 11.7513 21.8777 11.3539 21.8777 10.9395Z" fill="#959595"></path>
                                    </svg>
                                </div>
                                <div class="swiper-button-next">
                                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M9.83111 21.4207C9.6856 21.2756 9.57016 21.1032 9.49139 20.9133C9.41262 20.7235 9.37207 20.52 9.37207 20.3145C9.37207 20.1089 9.41262 19.9054 9.49139 19.7156C9.57016 19.5258 9.6856 19.3534 9.83111 19.2082L18.103 10.9395L9.83111 2.67072C9.53772 2.37732 9.37289 1.97939 9.37289 1.56447C9.37289 1.14954 9.53772 0.751614 9.83111 0.458218C10.1245 0.164822 10.5224 -3.86498e-06 10.9374 -3.88312e-06C11.3523 -3.90126e-06 11.7502 0.164822 12.0436 0.458218L21.4186 9.83322C21.5641 9.97836 21.6796 10.1508 21.7583 10.3406C21.8371 10.5304 21.8777 10.7339 21.8777 10.9395C21.8777 11.145 21.8371 11.3485 21.7583 11.5383C21.6796 11.7282 21.5641 11.9006 21.4186 12.0457L12.0436 21.4207C11.8985 21.5662 11.726 21.6817 11.5362 21.7604C11.3464 21.8392 11.1429 21.8798 10.9374 21.8798C10.7318 21.8798 10.5283 21.8392 10.3385 21.7604C10.1487 21.6817 9.97626 21.5662 9.83111 21.4207Z" fill="#3333CC"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M-6.8299e-08 10.9395C-8.64131e-08 10.5251 0.16462 10.1276 0.457646 9.8346C0.750671 9.54157 1.1481 9.37695 1.5625 9.37695L17.1875 9.37695C17.6019 9.37695 17.9993 9.54157 18.2924 9.8346C18.5854 10.1276 18.75 10.5251 18.75 10.9395C18.75 11.3539 18.5854 11.7513 18.2924 12.0443C17.9993 12.3373 17.6019 12.502 17.1875 12.502L1.5625 12.502C1.1481 12.502 0.750672 12.3373 0.457646 12.0443C0.16462 11.7513 -5.0185e-08 11.3539 -6.8299e-08 10.9395Z" fill="#959595"></path>
                                    </svg>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="map-distributors__region-label js-map-distributors-region-lable"></div>
            </div>
        </div>
        <?$APPLICATION->IncludeComponent("bitrix:news.list", "banner-cooperation", Array(
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
            "IBLOCK_ID" => "27",	// Код информационного блока
            "IBLOCK_TYPE" => "banners",	// Тип информационного блока (используется только для проверки)
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
            "PROPERTY_CODE" => array(0=>"LINK",1=>"MOBILE_IMAGE",2=>"TABLET_IMAGE",3=>"DESKTOP_IMAGE",4=>"",),
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
        );?>
    </div>
</section>
<script>
    // var url = '/local/ajax/distributors/map.php';
    // var data = {
    //     'TYPE': 'distributors',
    //     'CODE':'MOW'
    // };
    // function ajaxCall(data,url) {
    //     return $.ajax({
    //         url: url,
    //         type: "POST",
    //         data: data
    //     })
    // }
    // var request = ajaxCall(data,url);
    // request.done(function(resp) {
    //     var response = JSON.parse(resp);
    //     console.log(response);
    // });
</script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>