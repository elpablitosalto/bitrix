<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
<? $APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "photogallery",
    array(
        "DISPLAY_DATE" => "N",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "N",
        "AJAX_MODE" => "N",
        "IBLOCK_TYPE" => "content",
        "IBLOCK_ID" => Indexis::getIblockId("photogallery"),
        "NEWS_COUNT" => "200",
        "SORT_BY1" => "SORT",
        "SORT_ORDER1" => "ASC",
        "SORT_BY2" => "SORT",
        "SORT_ORDER2" => "ASC",
        "FILTER_NAME" => "",
        "FIELD_CODE" => array("ID", "NAME", "PREVIEW_PICTURE", "DETAIL_PICTURE"),
        "PROPERTY_CODE" => array(""),
        "CHECK_DATES" => "Y",
        "DETAIL_URL" => "",
        "PREVIEW_TRUNCATE_LEN" => "",
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "SET_TITLE" => "N",
        "SET_BROWSER_TITLE" => "N",
        "SET_META_KEYWORDS" => "N",
        "SET_META_DESCRIPTION" => "N",
        "SET_LAST_MODIFIED" => "N",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "ADD_SECTIONS_CHAIN" => "N",
        "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
        "PARENT_SECTION" => "",
        "PARENT_SECTION_CODE" => "",
        "INCLUDE_SUBSECTIONS" => "Y",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
        "CACHE_FILTER" => "Y",
        "CACHE_GROUPS" => "Y",
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "N",
        "PAGER_TITLE" => "Новости",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => "",
        "PAGER_DESC_NUMBERING" => "Y",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "PAGER_BASE_LINK_ENABLE" => "Y",
        "SET_STATUS_404" => "N",
        "SHOW_404" => "N",
        "MESSAGE_404" => "",
        "PAGER_BASE_LINK" => "",
        "PAGER_PARAMS_NAME" => "arrPager",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
    )
); ?>
<?
$APPLICATION->IncludeFile(
    SITE_DIR . 'include/form/popup_make_app.php',
    array(
        "FORM_CODE" => "FORM_POPUP",
        //"DOCTOR_ID" => $elementId
    ),
    array('SHOW_BORDER' => false)
);
?>
<?
$APPLICATION->IncludeFile(
	SITE_DIR . 'include/form/popup_doctor.php',
	array(
		"FORM_CODE" => "FORM_POPUP_DOCTOR",
		"DOCTOR_ID" => $GLOBALS['DOCTOR_ID_POPUP']
	),
	array('SHOW_BORDER' => false)
);
?>
<?
$APPLICATION->IncludeFile(
    SITE_DIR . 'include/form/popup_success.php',
    array(
        //"FORM_CODE" => "FORM_POPUP",
        //"DOCTOR_ID" => $elementId
    ),
    array('SHOW_BORDER' => false)
);
?>
<?
$APPLICATION->IncludeFile(
    SITE_DIR . 'include/form/popup_success_feedback.php',
    array(
        //"FORM_CODE" => "FORM_POPUP",
        //"DOCTOR_ID" => $elementId
    ),
    array('SHOW_BORDER' => false)
);
?>
</main>
<footer class="nb-footer">
    <div class="container">
        <div class="row">
            <div class="col nb-col-logo">
                <? if ($isHome) : ?>
                    <span class="nb-footer-logo">
                    <? else : ?>
                        <a class="nb-footer-logo" href="<?= SITE_DIR ?>">
                        <? endif; ?>
                        <img class="nb-footer-logo__img" src="<?= SITE_TEMPLATE_PATH ?>/img/design/logo_w.png" alt="Белый кролик" width="245" height="64" />
                        <? if ($isHome) : ?>
                    </span>
                <? else : ?>
                    </a>
                <? endif; ?>
            </div>
            <div class="col nb-col-contacts">
                <ul class="nb-footer-contacts">
                    <li class="nb-footer-contacts-item">
                        <?
                        $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "bottom_phone",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_DIR . "include/common/phone.php",
                            )
                        );
                        ?>
                    </li>
                    <li class="nb-footer-contacts-item d-none d-sm-block">
                        <?
                        $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "bottom_email",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_DIR . "include/common/email.php",
                            )
                        );
                        ?>
                    </li>
                </ul>
            </div>
            <div class="col nb-col-search">
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:search.form",
                    "bottom_search",
                    array(
                        "USE_SUGGEST" => "N",
                        "PAGE" => "#SITE_DIR#search/"
                    )
                );
                ?>
            </div>
            <div class="col nb-col-social">
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "social_links",
                    array(
                        "ROOT_MENU_TYPE" => "social",    // Тип меню для первого уровня
                        "MAX_LEVEL" => "1",    // Уровень вложенности меню
                        "CHILD_MENU_TYPE" => "social",    // Тип меню для остальных уровней
                        "USE_EXT" => "N",    // Подключать файлы с именами вида .тип_меню.menu_ext.php
                        "DELAY" => "N",    // Откладывать выполнение шаблона меню
                        "ALLOW_MULTI_SELECT" => "N",    // Разрешить несколько активных пунктов одновременно
                        "MENU_CACHE_TYPE" => "A",    // Тип кеширования
                        "MENU_CACHE_TIME" => "36000000",    // Время кеширования (сек.)
                        "MENU_CACHE_USE_GROUPS" => "N",    // Учитывать права доступа
                        "MENU_CACHE_GET_VARS" => "",    // Значимые переменные запроса
                        "MENU_CLASS" => "nb-footer-social"
                    ),
                    false
                );
                ?>
            </div>
            <div class="col nb-col-locations">
                <?
                $APPLICATION->IncludeFile(
                    SITE_DIR . 'include/common/list_locations.php',
                    array("TEMPLATE_NAME" => "bottom_locations"),
                    array('SHOW_BORDER' => false)
                );
                ?>
            </div>
            <div class="col nb-col-main-menu">
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "bottom_links",
                    array(
                        "ROOT_MENU_TYPE" => "bottom1",    // Тип меню для первого уровня
                        "MAX_LEVEL" => "1",    // Уровень вложенности меню
                        "CHILD_MENU_TYPE" => "left",    // Тип меню для остальных уровней
                        "USE_EXT" => "N",    // Подключать файлы с именами вида .тип_меню.menu_ext.php
                        "DELAY" => "N",    // Откладывать выполнение шаблона меню
                        "ALLOW_MULTI_SELECT" => "N",    // Разрешить несколько активных пунктов одновременно
                        "MENU_CACHE_TYPE" => "A",    // Тип кеширования
                        "MENU_CACHE_TIME" => "36000000",    // Время кеширования (сек.)
                        "MENU_CACHE_USE_GROUPS" => "N",    // Учитывать права доступа
                        "MENU_CACHE_GET_VARS" => "",    // Значимые переменные запроса
                        "ADDITIONAL_CLASS" => "nb-footer-menu__list_disc"
                    ),
                    false
                );
                ?>
            </div>
            <div class="col nb-col-services-menu">
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "bottom_links",
                    array(
                        "ROOT_MENU_TYPE" => "bottom2",    // Тип меню для первого уровня
                        "MAX_LEVEL" => "2",    // Уровень вложенности меню
                        "CHILD_MENU_TYPE" => "left",    // Тип меню для остальных уровней
                        "USE_EXT" => "Y",    // Подключать файлы с именами вида .тип_меню.menu_ext.php
                        "DELAY" => "N",    // Откладывать выполнение шаблона меню
                        "ALLOW_MULTI_SELECT" => "N",    // Разрешить несколько активных пунктов одновременно
                        "MENU_CACHE_TYPE" => "A",    // Тип кеширования
                        "MENU_CACHE_TIME" => "36000000",    // Время кеширования (сек.)
                        "MENU_CACHE_USE_GROUPS" => "N",    // Учитывать права доступа
                        "MENU_CACHE_GET_VARS" => "",    // Значимые переменные запроса
                    ),
                    false
                );
                ?>
            </div>
            <div class="col nb-col-legal-menu">
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "bottom_links",
                    array(
                        "ROOT_MENU_TYPE" => "bottom3",    // Тип меню для первого уровня
                        "MAX_LEVEL" => "1",    // Уровень вложенности меню
                        "CHILD_MENU_TYPE" => "left",    // Тип меню для остальных уровней
                        "USE_EXT" => "N",    // Подключать файлы с именами вида .тип_меню.menu_ext.php
                        "DELAY" => "N",    // Откладывать выполнение шаблона меню
                        "ALLOW_MULTI_SELECT" => "N",    // Разрешить несколько активных пунктов одновременно
                        "MENU_CACHE_TYPE" => "A",    // Тип кеширования
                        "MENU_CACHE_TIME" => "36000000",    // Время кеширования (сек.)
                        "MENU_CACHE_USE_GROUPS" => "N",    // Учитывать права доступа
                        "MENU_CACHE_GET_VARS" => "",    // Значимые переменные запроса
                    ),
                    false
                );
                ?>
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "bottom_links",
                    array(
                        "ROOT_MENU_TYPE" => "bottom4",    // Тип меню для первого уровня
                        "MAX_LEVEL" => "1",    // Уровень вложенности меню
                        "CHILD_MENU_TYPE" => "left",    // Тип меню для остальных уровней
                        "USE_EXT" => "N",    // Подключать файлы с именами вида .тип_меню.menu_ext.php
                        "DELAY" => "N",    // Откладывать выполнение шаблона меню
                        "ALLOW_MULTI_SELECT" => "N",    // Разрешить несколько активных пунктов одновременно
                        "MENU_CACHE_TYPE" => "A",    // Тип кеширования
                        "MENU_CACHE_TIME" => "36000000",    // Время кеширования (сек.)
                        "MENU_CACHE_USE_GROUPS" => "N",    // Учитывать права доступа
                        "MENU_CACHE_GET_VARS" => "",    // Значимые переменные запроса
                        "ADDITIONAL_CLASS" => "nb-footer-menu__list_disc"
                    ),
                    false
                );
                ?>
            </div>
        </div>
    </div>

<div class="container" style="padding-top: 50px; font-size: 13px; text-align: center;">
	<p><a class="nb-footer-location__map-link" href="/dokumenty/">  Лицензия</a>
<a class="nb-footer-location__map-link" href="/dokumenty/"> Согласие на обработку персональных данных</a>
<a class="nb-footer-location__map-link" href="/dokumenty/"> Техническая документация</a>
	</p>

<p>Мы используем cookie-файлы для вашего удобства. Оставаясь на сайте, вы соглашаетесь с использованием файлов cookie.
Материалы, размещённые на сайте, не предназначены для постановки диагноза и лечения и не заменяют приём врача.
	Имеются противопоказания. Необходима консультация специалиста.</p>
	</div>
</footer>
</div><?php // .nb-wrapper-right 
        ?>
</div>
<?php // .nb-wrapper 
?>
<div class="nb-modals"></div>
<script type="application/ld+json">
{
	"@context": "http://schema.org",
	"@type": "WebSite",
	"url": "https://rabbitstom.ru/",
	"potentialAction": {
		"@type": "SearchAction",
		"target": "https://rabbitstom.ru/search/?q={query}",
		"query-input": "required name=query"
	}
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "MedicalOrganization",
  "name": "Клиника Белый кролик",
  "url": "https://rabbitstom.ru/",
  "logo": "https://rabbitstom.ru/local/templates/nebolno/img/design/logo.png"
}
</script>
</body>

</html>