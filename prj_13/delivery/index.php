<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Доставка и самовывоз строительных материалов в Москве и Московской области. Широкий ассортимент, выгодные цены. ☎ +7 (495) 229-30-20");
$APPLICATION->SetTitle("Доставка и самовывоз");
$APPLICATION->SetPageProperty("PAGE_SECTION_CLASS", 'delivery-page');
?>

<p>В данном разделе вы можете рассчитать приблизительную стоимость доставки. На стоимость доставки по Москве и Московской области влияют: <span class="font-weight-middle">вес заказа, зона доставки и удаленность от МКАД</span>.
</p>

<?
$APPLICATION->IncludeFile(
    SITE_DIR . 'include/common/delivery_map_section.php',
    array(),
    array('SHOW_BORDER' => false)
);
?>

<section class="delivery-info-section">
    <h2>Доставка</h2>
    <h3>Экспресс доставка по Москве и Московской область</h3>
    <p>Нашим клиентам доступна экспресс доставка Яндекс.GO в день оплаты. Оплатите заказ и закажите Яндекс.GO — обычное или грузовое такси. Мы передадим курьеру товар и все необходимые документы</p>
    <ul class="delivery__list">
        <li><img src="<?=SITE_TEMPLATE_PATH?>/img/content/delivery/delline.png" alt="Деловые линии"></li>
        <li><img src="<?=SITE_TEMPLATE_PATH?>/img/content/delivery/magictrans.png" alt="MagicTrans"></li>
        <li><img src="<?=SITE_TEMPLATE_PATH?>/img/content/delivery/pek.png" alt="ПЭК"></li>
    </ul>
    <h3>Доставка транспортной компанией</h3>
    <p>Отправляем заказы транспортными компаниями-партнерами, заказы весом до 60-ти тонн вагонами, до 20-ти тонн евро-фурами. Сотрудничаем с ТК «Деловые линии», «Magic Trans», «ПЭК», «СДЭК»</p>
    <h3>Бесплатная доставка по Москве и Москвоской области</h3>
    <p>При заказе товара на сумму более 60000 рублей мы осуществляем бесплатную доставку по Москве и в пределах 2-х км от МКАД, товара весом не более 2000 кг</p>
    <div class="delivery__information">
        <h3>Дополнительная информация</h3>
        <p>Мы доставляем товары только по общественным дорогам, где может проехать грузовой транспорт. Дорога должна быть покрыта асфальтом или грунтом, а покрытие указано на карте. Мы не сможем доставить заказ, если проезд недоступен из-за сложных погодных условий. Если к месту разгрузки невозможно подъехать, мы остановимся как можно ближе, без нарушений ПДД и повреждений транспорта. Водитель паркуется так, чтобы выгрузить товары безопасно, не мешая пешеходам и другим машинам.На разгрузку выделяется 30 минут с момента приезда машины для транспортных средств (ТС) до 1,5 т включительно и 60 минут для ТС от 1,5 т. Далее оплачивается простой: 1200 р./час для ТС до 1,5 т и 2400 р./час для ТС от 1,5 т</p>
    </div>
</section>

<?
$GLOBALS['arPickupFilter'] = [
    '!PROPERTY_IS_PICKUP' => false
];
?>
<? $APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "pickup_section",
    array(
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "AJAX_MODE" => "N",
        "IBLOCK_TYPE" => "content",
        "IBLOCK_ID" => Indexis::getIblockId("contacts", "content"),
        "NEWS_COUNT" => "100",
        //"NEWS_COUNT" => "3",
        "SORT_BY1" => "SORT",
        "SORT_ORDER1" => "ASC",
        "SORT_BY2" => "ACTIVE_FROM",
        "SORT_ORDER2" => "DESC",
        "FILTER_NAME" => "arPickupFilter",
        "FIELD_CODE" => array("ID", "NAME", "DETAIL_PICTURE"),
        "PROPERTY_CODE" => array('ADDRESS_1', 'ADDRESS_2', 'SCHEDULE', 'PHONE', 'EMAIL', 'MANAGER', 'MANAGER_PHOTO', 'PHONE_WHATSAPP', 'NEED_ORDER_PASS', 'LATITUDE', 'LONGITUDE', 'HOW_TO_GET_CAR', 'HOW_TO_GET_PT', 'IMPORTANT_MESSAGE', 'ROAD_MAP'),
        "CHECK_DATES" => "Y",
        "DETAIL_URL" => "",
        "PREVIEW_TRUNCATE_LEN" => "",
        "ACTIVE_DATE_FORMAT" => "d F Y",
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
        "CACHE_TIME" => "360000",
        "CACHE_FILTER" => "Y",
        "CACHE_GROUPS" => "Y",
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "PAGER_TITLE" => "Сертификаты",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => "stroyservis",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "PAGER_BASE_LINK_ENABLE" => "Y",
        "SET_STATUS_404" => "N",
        "SHOW_404" => "N",
        "MESSAGE_404" => "",
        "PAGER_BASE_LINK" => "",
        "PAGER_PARAMS_NAME" => "",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
    )
); ?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>