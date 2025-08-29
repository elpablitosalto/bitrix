<?
use Bitrix\Main\EventManager;
use \Bitrix\Main\Loader;

EventManager::getInstance()->addEventHandler("catalog", "OnCompleteCatalogImport1C",  ["\First\Events", "OnCompleteCatalogImport1CHandler"]);
EventManager::getInstance()->addEventHandler("catalog", "OnSuccessCatalogImport1C",  ["\First\Events", "OnSuccessCatalogImport1CHandler"]);
EventManager::getInstance()->addEventHandler("sale", "OnBasketUpdate",  ["\First\Events", "OnBasketUpdate"]);
EventManager::getInstance()->addEventHandler("sale", "OnBeforeBasketAdd",  ["\First\Events", "OnBeforeBasketAdd"]);
EventManager::getInstance()->addEventHandler("form", "onBeforeResultAdd",  ["\First\Events", "form_onBeforeResultAdd"]);
EventManager::getInstance()->addEventHandler("form", "onAfterResultAdd",  ["\First\Events", "form_onAfterResultAdd"]);

// Валидаторы форм -->
EventManager::getInstance()->addEventHandlerCompatible('form', 'onFormValidatorBuildList', [
	'Disweb\FormValidatorPhone',
	'getDescription',
]);

EventManager::getInstance()->addEventHandlerCompatible('form', 'onFormValidatorBuildList', [
	'Disweb\FormValidatorEmail',
	'getDescription',
]);

EventManager::getInstance()->addEventHandlerCompatible('form', 'onFormValidatorBuildList', [
	'Disweb\FormValidatorInn',
	'getDescription',
]);
// <--Валидаторы форм


AddEventHandler("iblock", "OnBeforeIBlockSectionUpdate", "DoNotUpdateSect");
function DoNotUpdateSect(&$arFields)
{
    if ($_REQUEST['mode'] == 'import') {

        unset($arFields['ACTIVE']);
    }
}


AddEventHandler("iblock", "OnAfterIBlockElementUpdate", array("EditCatalog", "UpdateSostav"));
AddEventHandler("iblock", "OnAfterIBlockElementAdd", array("EditCatalog", "UpdateSostav"));
class EditCatalog
{

    public static function UpdateSostav(&$arFields)
    {
        // срабатывает после обновления или создания товара
        if (!empty($arFields["PROPERTY_VALUES"][1467])) {
            $pors =    array_shift($arFields["PROPERTY_VALUES"][1467]);
            if (!empty($pors["VALUE"])) {
                $data = explode(PHP_EOL, $pors["VALUE"]);
                if (!empty($data) && count($data) > 1) {
                    CIBlockElement::SetPropertyValueCode($arFields["ID"], "ZASHCHITNYE_SVOYSTVA_1", $data);
                }
                unset($data);
            }
        }
        if (!empty($arFields["PROPERTY_VALUES"][1469])) {
            $pors =    array_shift($arFields["PROPERTY_VALUES"][1469]);
            if (!empty($pors["VALUE"])) {
                $data = explode(PHP_EOL, $pors["VALUE"]);
                if (!empty($data) && count($data) > 1) {
                    CIBlockElement::SetPropertyValueCode($arFields["ID"], "SFERY_DEYATELNOSTI", $data);
                }
                unset($data);
            }
        }
        if (!empty($arFields["PROPERTY_VALUES"][1468])) {
            $pors =    array_shift($arFields["PROPERTY_VALUES"][1468]);
            if (!empty($pors["VALUE"])) {
                $data = explode(PHP_EOL, $pors["VALUE"]);
                if (!empty($data) && count($data) > 1) {
                    CIBlockElement::SetPropertyValueCode($arFields["ID"], "POSTAVSHCHIK", $data);
                }
                unset($data);
            }
        }
    }
}


AddEventHandler("iblock", "OnAfterIBlockElementAdd", array("aspro_import", "FillTheBrands"));
AddEventHandler("iblock", "OnAfterIBlockElementUpdate", array("aspro_import", "FillTheBrands"));
class aspro_import
{
    public static function FillTheBrands($arFields)
    {
        $arFields['IBLOCK_ID'] = intval($arFields['IBLOCK_ID']);
        $arFields['ID'] = intval($arFields['ID']);

        $arCatalogID = array(34);
        if (in_array($arFields['IBLOCK_ID'], $arCatalogID)) {
            $arItem = CIBlockElement::GetList(false, array('IBLOCK_ID' => $arFields['IBLOCK_ID'], 'ID' => $arFields['ID']), false, ['nTopCount'=>1], array('ID', 'PROPERTY_BREND', 'IBLOCK_ID'))->fetch();
            if (strlen($arItem['PROPERTY_BREND_VALUE'])) {
                $arBrand = CIBlockElement::GetList(false, array('IBLOCK_ID' => 8, 'NAME' => $arItem['PROPERTY_BREND_VALUE']), false, ['nTopCount'=>1], ['ID'])->fetch();
                if ($arBrand) {
                    CIBlockElement::SetPropertyValuesEx($arFields['ID'], false, array('BRAND' => $arBrand['ID']));
                } else {
                    $el = new CIBlockElement;
                    $arParams = array("replace_space" => "-", "replace_other" => "-");
                    $id = $el->Add(array(
                        'ACTIVE' => 'Y',
                        'NAME' => $arItem['PROPERTY_BREND_VALUE'],
                        'IBLOCK_ID' => 8,
                        'CODE' => Cutil::translit($arItem['PROPERTY_BREND_VALUE'], "ru", $arParams)
                    ));
                    if ($id) {
                        CIBlockElement::SetPropertyValuesEx($arFields['ID'], false, array('BRAND' => $id));
                    } else {
                        echo $el->LAST_ERROR;
                    }
                }
            }
        }
    }
}

AddEventHandler("main", "OnAfterEpilog", "Prefix_FunctionName");

function Prefix_FunctionName()
{
    global $APPLICATION;

    // Check if we need to show the content of the 404 page
    if (!defined('ERROR_404') || ERROR_404 != 'Y') {
        return;
    }

    // Display the 404 page unless it is already being displayed
    if ($APPLICATION->GetCurPage() != PREFIX_PATH_404) {
        header('X-Accel-Redirect: ' . PREFIX_PATH_404);
        exit();
    }
}

// 31103
AddEventHandler('aspro.mshop', "OnAsproGetTotalQuantityBlock", function ($totalCount, &$arOptions) {
    preg_match('/bx\_[\d]+_([\d]+)\_store\_quantity/i', $arOptions["HTML"], $arMatches);
    if (!empty($arMatches[1]) && \Bitrix\Main\Loader::includeModule("catalog")) {
        $productID = intval($arMatches[1]);
        $arCatalogInfo = \Bitrix\Catalog\ProductTable::getById($productID)->fetch();
        $arCatalogQty = getProductQty($arCatalogInfo);
        if ($arCatalogQty["AVAILABLE"] == 0 && !empty($arCatalogQty["ORDER"])) {
            $arOptions["HTML"] = '<div class="item-stock" id="' . $arMatches[0] . '"><span class="icon order"></span><span class="value">Срок поставки 5-10 дней <span class="store_view">(' . $arCatalogQty["ORDER"] . ')</span></span></div>';
        } elseif ($arCatalogQty["AVAILABLE"] > 0 && !empty($arCatalogQty["ORDER"])) {
            $arOptions["HTML"] = '<div class="item-stock" id="' . $arMatches[0] . '"><span class="icon stock"></span><span class="value">Есть в наличии <span class="store_view">(' . $arCatalogQty["AVAILABLE"] . ')</span></span><span class="value">, срок поставки 5-10 дней <span class="store_view">(' . $arCatalogQty["ORDER"] . ')</span></span></div>';
        } elseif ($arCatalogQty["AVAILABLE"] > 0 && empty($arCatalogQty["ORDER"])) {
            $arOptions["HTML"] = '<div class="item-stock" id="' . $arMatches[0] . '"><span class="icon stock"></span><span class="value">Есть в наличии <span class="store_view">(' . $arCatalogQty["AVAILABLE"] . ')</span></span></div>';
        } elseif (($arCatalogQty["AVAILABLE"] + $arCatalogQty["ORDER"]) == 0) {
            //$str = 'Под заказ';
            $str = 'По запросу';
            $arOptions["HTML"] = '<div class="item-stock" id="' . $arMatches[0] . '"><span class="icon order"></span><span class="value">'.$str.'</span></div>';
        }
    }
    return true;
});

AddEventHandler('aspro.mshop', "OnAsproShowPriceMatrix", function ($arItem, $arParams, $strMeasure, $arAddToBasketData, &$html) {
    $html = '';
    if (isset($arItem['PRICE_MATRIX']) && $arItem['PRICE_MATRIX']) {
        ob_start(); ?>
        <div class="price_matrix_block">
            <?
            $iCountPriceGroup = count($arItem['PRICE_MATRIX']['COLS']);
            $bPriceRows = (count($arItem['PRICE_MATRIX']['ROWS']) > 1); ?>
            <?
            // 39527
            if (!empty($arItem['PRICE_MATRIX']['COLS']) && is_array($arItem['PRICE_MATRIX']['COLS'])) {
                $arItem['PRICE_MATRIX']['COLS'] = array_filter($arItem['PRICE_MATRIX']['COLS'], function ($element) {
                    return $element["ID"] == 4; // ID оптовой цены
                });
            }
            ?>
            <? foreach ($arItem['PRICE_MATRIX']['COLS'] as $arPriceGroup) : ?>
                <? if ($iCountPriceGroup > 1) : ?>
                    <div class="price_group">
                        <div class="price_name"><?= $arPriceGroup["NAME_LANG"]; ?></div>
                    <? endif; ?>
                    <div class="price_matrix_wrapper">
                        <? $iCountPriceInterval = count($arItem['PRICE_MATRIX']['MATRIX'][$arPriceGroup['ID']]); ?>
                        <? foreach ($arItem['PRICE_MATRIX']['MATRIX'][$arPriceGroup['ID']] as $key => $arPrice) : ?>
                            <? if ($iCountPriceInterval > 1) : ?>
                                <div class="price_wrapper_block clearfix">
                                    <?
                                    $quantity_from = $arItem['PRICE_MATRIX']['ROWS'][$key]['QUANTITY_FROM'];
                                    $quantity_to = $arItem['PRICE_MATRIX']['ROWS'][$key]['QUANTITY_TO'];
                                    $text = ($quantity_to ? ($quantity_from ? $quantity_from . '-' . $quantity_to : '<' . $quantity_to) : '>' . $quantity_from);
                                    ?>
                                    <div class="price_interval" title="<?= $text ?><? if (($arParams["SHOW_MEASURE"] == "Y") && $strMeasure) : ?> <?= $strMeasure ?><? endif; ?>">
                                        <?= $text ?><? if (($arParams["SHOW_MEASURE"] == "Y") && $strMeasure) : ?> <?= $strMeasure ?><? endif; ?>
                                    </div>
                                <? endif; ?>
                                <div class="all_prices<?= ($iCountPriceInterval == 1 ? ' one_price' : '') ?>">
                                    <? if ($arPrice["PRICE"] > $arPrice["DISCOUNT_PRICE"]) { ?>
                                        <div class="price" data-currency="<?= $arPrice["CURRENCY"]; ?>" data-value="<?= $arPrice["DISCOUNT_PRICE"]; ?>">
                                            <? if (strlen($arPrice["DISCOUNT_PRICE"])) : ?>
                                                <span class="values_wrapper"><?= \Aspro\Functions\CAsproMShopItem::getCurrentPrice("DISCOUNT_PRICE", $arPrice); ?></span><? if (($arParams["SHOW_MEASURE"] == "Y") && $strMeasure) : ?><span class="price_measure">/<?= $strMeasure ?></span><? endif; ?>
                                            <? endif; ?>
                                        </div>
                                        <? if ($arParams["SHOW_OLD_PRICE"] == "Y") : ?>
                                            <div class="price discount" data-currency="<?= $arPrice["CURRENCY"]; ?>" data-value="<?= $arPrice["PRICE"]; ?>">
                                                <span class="values_wrapper"><?= \Aspro\Functions\CAsproMShopItem::getCurrentPrice("PRICE", $arPrice); ?></span>
                                            </div>
                                        <? endif; ?>
                                    <? } else { ?>
                                        <div class="price" data-currency="<?= $arPrice["CURRENCY"]; ?>" data-value="<?= $arPrice["DISCOUNT_PRICE"]; ?>">
                                            <span><span class="values_wrapper"><?= \Aspro\Functions\CAsproMShopItem::getCurrentPrice("PRICE", $arPrice); ?></span><? if (($arParams["SHOW_MEASURE"] == "Y") && $strMeasure) : ?><span class="price_measure">/<?= $strMeasure ?></span><? endif; ?></span>
                                        </div>
                                    <? } ?>
                                </div>
                                <? if ($iCountPriceInterval > 1) : ?>
                                </div>
                                <? else :
                                    if ($arParams['SHOW_DISCOUNT_PERCENT'] == 'Y' && $arPrice["PRICE"] > $arPrice["DISCOUNT_PRICE"]) : ?>
                                    <? $ratio = (!$bPriceRows ? $arAddToBasketData["MIN_QUANTITY_BUY"] : 1);
                                        $diff = $arPrice["PRICE"] - $arPrice["DISCOUNT_PRICE"];
                                        $percent = round(($diff / $arPrice["PRICE"]) * 100, 0); ?>
                                    <div class="sale_block">
                                        <div class="sale_wrapper">
                                            <div class="value">-<span><?= $percent; ?></span>%</div>
                                            <div class="text"><span class="title"><?= GetMessage("CATALOG_ECONOMY"); ?></span> <span class="values_wrapper" data-currency="<?= $arPrice["CURRENCY"]; ?>" data-value="<?= (($arPrice["PRICE"] - $arPrice["DISCOUNT_PRICE"]) * $ratio); ?>"><?= CAllCurrencyLang::CurrencyFormat($diff, $arPrice['CURRENCY']) ?></span></div>
                                        </div>
                                    </div>
                                <? endif; ?>
                            <? endif; ?>
                        <? endforeach; ?>
                    </div>
                    <? if ($iCountPriceGroup > 1) : ?>
                    </div>
                <? endif; ?>
            <? endforeach; ?>
        </div>
    <? $html = ob_get_contents();
        ob_end_clean();
    }
    return true;
});

// 41408
AddEventHandler('aspro.mshop', "OnAsproSkuShowItemPrices", function ($arParams, $arItem, &$item_id, &$min_price_id, $arItemIDs, $bShort, &$html) {
    $html = '';
    if ((is_array($arParams) && $arParams) && (is_array($arItem) && $arItem)) {
        ob_start();
        // 41408
        $minOptPrice = 0;
        $arOptPrices = [];
        if (!empty($arItem["OFFERS"])) {
            foreach ($arItem["OFFERS"] as $arOffer) {
                $arOptPrices[] = $arOffer["PRICES"]["ИМ БИТРИКС"]["DISCOUNT_VALUE"];
            }
            $minOptPrice = min($arOptPrices);
        }
    ?>
        <div class="price">
            <? if (!empty($minOptPrice)) : ?>
                от <span class="values_wrapper"><?= CurrencyFormat($minOptPrice, 'RUB'); ?></span>
            <? endif; ?>
        </div>

        <? $html = ob_get_contents();
        ob_end_clean();

        return $html; ?>

<? }
    return true;
});

// 35672
AddEventHandler("iblock", "OnBeforeIBlockElementAdd", "updateHitProperty");
AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", "updateHitProperty");
/**
 * Обноаление стандартного свойства "Наши предложения" [HIT] по свойству "спецпредложение" [SPETSPREDLOZHENIE]
 * Обноаление стандартного свойства "Наши предложения" [HIT] по свойству "Признак акция" [PRIZNAK_AKTSIYA]
 * @param $arFields
 * @return bool
 */
function updateHitProperty(array &$arFields): bool
{
    $arSpetspredlozhenie = (!empty($arFields["PROPERTY_VALUES"]["1499"]) && is_array($arFields["PROPERTY_VALUES"]["1499"])) ? array_column($arFields["PROPERTY_VALUES"]["1499"], "VALUE") : [];  // 1499 - SPETSPREDLOZHENIE
    $arSale = (!empty($arFields["PROPERTY_VALUES"]["1494"]) && is_array($arFields["PROPERTY_VALUES"]["1494"])) ? array_column($arFields["PROPERTY_VALUES"]["1494"], "VALUE") : [];  // 1494 - PRIZNAK_AKTSIYA
    $arSpetspredlozhenie = array_filter($arSpetspredlozhenie);
    $arSale = array_filter($arSale);
    if (!empty($arSpetspredlozhenie) || !empty($arSale)) {
        $arFields["PROPERTY_VALUES"]["1071"] = [];
    }
    if (!empty($arSpetspredlozhenie)) {
        $newHitValues = [];
        foreach ($arSpetspredlozhenie as $specPropValue) {
            switch ($specPropValue) {
                case 27714: // Новинка
                    $newHitValues[] = 54733; // новинка
                    break;
                case 27715: // Хит
                    $newHitValues[] = 54732; // Хит
                    break;
            }
        }
        foreach ($newHitValues as $propertyValueId) {
            $arFields["PROPERTY_VALUES"]["1071"][] = ["VALUE" => $propertyValueId];
        }
    }
    // 37096
    if (!empty($arSale)) {
        $newHitValues = [];
        foreach ($arSale as $specPropValue) {
            switch ($specPropValue) {
                case 56271: // Супер цена
                    $newHitValues[] = 56390; // Супер цена
                    break;
            }
        }
        foreach ($newHitValues as $propertyValueId) {
            $arFields["PROPERTY_VALUES"]["1071"][] = ["VALUE" => $propertyValueId];
        }
    }
    return true;
}

// 39529
AddEventHandler("iblock", "OnAfterIBlockElementUpdate", "clearHitProperty");
function clearHitProperty(array $arFields): bool
{
    $arSpetspredlozhenie = (!empty($arFields["PROPERTY_VALUES"]["1499"]) && is_array($arFields["PROPERTY_VALUES"]["1499"])) ? array_filter(array_column($arFields["PROPERTY_VALUES"]["1499"], "VALUE")) : [];  // 1499 - SPETSPREDLOZHENIE
    $arSale = (!empty($arFields["PROPERTY_VALUES"]["1494"]) && is_array($arFields["PROPERTY_VALUES"]["1494"])) ? array_filter(array_column($arFields["PROPERTY_VALUES"]["1494"], "VALUE")) : [];  // 1494 - PRIZNAK_AKTSIYA
    if (empty($arSpetspredlozhenie) && empty($arSale)) {
        \CIBlockElement::SetPropertyValuesEx($arFields["ID"], $arFields["IBLOCK_ID"], array("HIT" => false));
    }
    return true;
}

// 39224 - Регистрация ОПТовых покупателей
AddEventHandler("main", "OnBuildGlobalMenu", "OnBuildGlobalMenuHandler", 1000);
function OnBuildGlobalMenuHandler(&$aGlobalMenu, &$aModuleMenu)
{
    if (\CSite::InGroup([13])) { // Менеджеры ОПТа
        $newModuleMenu = $aModuleMenu;
        $aGlobalMenu = ["global_menu_store" => $aGlobalMenu["global_menu_store"]];
        $aModuleMenu = [];
        foreach ($newModuleMenu as $menuItem) {
            if ($menuItem['parent_menu'] == 'global_menu_store' && ($menuItem["text"] == "Заказы")) {
                $aModuleMenu[] = $menuItem;
            }
        }
    }
}
AddEventHandler("sale", "OnOrderListFilter", "OnOrderListFilterHandler", 1000);
function OnOrderListFilterHandler($arFilter)
{
    if (\CSite::InGroup([13])) { // Менеджеры ОПТа
        $arFilter["USER_ID"] = [];
        $rsUsers = CUser::GetList(($by = "ID"), ($order = "DESC"), array('=UF_OPT_MANAGER' => $GLOBALS["USER"]->GetID()));
        while ($arUser = $rsUsers->GetNext()) {
            $arFilter["USER_ID"][] = $arUser["ID"];
        }
    }
    return $arFilter;
}
AddEventHandler("sale", "OnSaleOrderSaved", "sendMessageToOptManager", 1000);
function sendMessageToOptManager($order)
{
    if ($order && $order->isNew()) {
        $rsUser = \CUser::GetByID($order->getUserId());
        if ($arUser = $rsUser->Fetch()) {
            if (!empty($arUser["UF_OPT_MANAGER"]) && is_array($arUser["UF_OPT_MANAGER"])) {
                $arOrderStatuses = \Bitrix\Sale\OrderStatus::getAllStatusesNames();
                $rsManagers = \Bitrix\Main\UserTable::getList([
                    "filter" => [
                        "ID" => $arUser["UF_OPT_MANAGER"],
                        "ACTIVE" => "Y"
                    ]
                ]);
                while ($arManager = $rsManagers->fetch()) {
                    $sendResult = \Bitrix\Main\Mail\Event::send([
                        "EVENT_NAME" => "OPT_MANAGER_NEW_ORDER",
                        "LID" => $order->getSiteId(),
                        "C_FIELDS" => [
                            "MANAGER_EMAIL" => $arManager["EMAIL"],
                            "FIO" => \CUser::FormatName(\CSite::GetNameFormat(), $arUser),
                            "PHONE" => $arUser["PERSONAL_PHONE"],
                            "EMAIL" => $arUser["EMAIL"],
                            "ORDER_NUM" => $order->getId(),
                            "ORDER_STATUS" => $arOrderStatuses[$order->getField("STATUS_ID")],
                            "ORDER_HREF" => "https://first-ltd.ru/bitrix/admin/sale_order_view.php?lang=ru&ID=" . $order->getId(),
                        ],
                    ]);
                }
            }
        }
    }
    return true;
}

// 39493 - Создать новый статус заказа "Подтверждение менеджером"
AddEventHandler("sale", "OnSaleOrderBeforeSaved", "managerConfirmation", 50);
function managerConfirmation($order)
{
    if ($order) {
        if ($order->isNew()) {
            $needManagerConfirmation = false;
            $basket = $order->getBasket();
            foreach ($basket as $basketItem) {
                $arCatalogInfo = \Bitrix\Catalog\ProductTable::getById($basketItem->getProductId())->fetch();
                $arCatalogQty = getProductQty($arCatalogInfo);
                if ($arCatalogQty["AVAILABLE"] < $basketItem->getQuantity()) {
                    $needManagerConfirmation = true;
                }
            }
            if ($needManagerConfirmation) {
                $order->setField("STATUS_ID", "M");
            }
        } else {
            $arFields = $order->getFields()->getOriginalValues();
            if (!empty($arFields["STATUS_ID"]) && $arFields["STATUS_ID"] == "M" && $arFields["STATUS_ID"] != $order->getField("STATUS_ID")) {
                // письмо покупателю
                $arUser = \Bitrix\Main\UserTable::getById($order->getUserId())->fetch();
                $sendResult = \Bitrix\Main\Mail\Event::send([
                    "EVENT_NAME" => "MANAGER_CONFIRMATION_SUCCESS",
                    "LID" => $order->getSiteId(),
                    "C_FIELDS" => [
                        "ORDER_ID" => $order->getField("ACCOUNT_NUMBER"),
                        "ORDER_DATE" => $order->getDateInsert()->toString(),
                        "EMAIL" => $arUser["EMAIL"],
                        "SALE_EMAIL" => \Bitrix\Main\Config\Option::get("sale", "order_email", "order@" . $_SERVER["SERVER_NAME"]),
                        "ORDER_PUBLIC_URL" => \Bitrix\Sale\Helpers\Order::isAllowGuestView($order) ? \Bitrix\Sale\Helpers\Order::getPublicLink($order) : ""
                    ],
                ]);
            }
        }
    }
    return true;
}

// 39489 - Настроить переход зарегистрированного пользователя в группу ОПТа по триггеру
\Bitrix\Main\EventManager::getInstance()->addEventHandler(
    'sale',
    'OnSaleOrderSaved',
    "setUserOptGroup",
    false,
    1100
);
function setUserOptGroup(\Bitrix\Main\Event $event): bool
{
    $order = $event->getParameter("ENTITY");
    $oldValues = $event->getParameter("VALUES");
    $isNew = $event->getParameter("IS_NEW");
    if ($order && !$isNew && !empty($oldValues["STATUS_ID"]) && in_array($order->getField("STATUS_ID"), ["P", "F"])) {
        $arUserGroups = \CUser::GetUserGroup($order->getUserId());
        if (
            !empty($arUserGroups) && is_array($arUserGroups) &&
            empty(array_intersect($arUserGroups, [12])) &&
            $order->getBasePrice() >= 20000
        ) {
            $newGroups = array_unique(array_merge($arUserGroups, [12]));
            CUser::SetUserGroup($order->getUserId(), $newGroups);
            //
            $rsUser = \Bitrix\Main\UserTable::getById($order->getUserId());
            if ($arUser = $rsUser->fetch()) {
                $sendResult = \Bitrix\Main\Mail\Event::send([
                    'EVENT_NAME' => 'USER_ADD_TO_OPT_GROUP',
                    'LID' => $order->getSiteId(),
                    'C_FIELDS' => [
                        "NAME" => trim($arUser["NAME"] . " " . $arUser["LAST_NAME"]),
                        "EMAIL" => $arUser["EMAIL"]
                    ]
                ]);
            }
        }
    }
    return true;
}

/*
// 41408 - пересчет наценок после импорта
AddEventHandler("catalog", "OnCompleteCatalogImport1C", function ($arParams, $ABS_FILE_NAME) {
    if (\Bitrix\Main\Loader::includeModule("catalog")) {

        $flog = fopen(__DIR__.'/../OnCompleteCatalogImport1C.log', 'a+');
        fwrite($flog, sprintf('%s - START OnCompleteCatalogImport1C'."\n", date('d.m.Y H:i:s')));

        $OPT_PRICE_ID = 4;
        $RETAIL_PRICE_ID = 5;
        $EXTRA_ID = 2;
        set_time_limit(0);
        // выбираем цены
        $arRetailPrices = \Bitrix\Catalog\PriceTable::getList([
            "filter" => [
                "CATALOG_GROUP_ID" => $RETAIL_PRICE_ID
            ]
        ])->fetchAll();
        $arOptPrices = [];
        $rsOptPrices = \Bitrix\Catalog\PriceTable::getList([
            "filter" => [
                "CATALOG_GROUP_ID" => $OPT_PRICE_ID
            ]
        ]);
        while ($optPrice = $rsOptPrices->fetch()) {
            $arOptPrices[$optPrice["PRODUCT_ID"]] = $optPrice["PRICE"];
        }
        $arProductRetailPricesIds = array_column($arRetailPrices, "PRODUCT_ID");
        // Наценка
        $extraValue = 0;
        $rsExtra = \Bitrix\Catalog\ExtraTable::getById($EXTRA_ID);
        if ($arExtra = $rsExtra->fetch()) {
            $extraValue = floatval($arExtra["PERCENTAGE"]) / 100;
        }
        //
        if (!empty($extraValue)) {
            $rsProducts = \Bitrix\Catalog\ProductTable::getList();
            while ($product = $rsProducts->fetch()) {
                if (!empty($product["ID"])) {
                    if (floatval($arOptPrices[$product["ID"]]) > 0) {
                        if (empty($arProductRetailPricesIds) || !in_array($product["ID"], $arProductRetailPricesIds)) {
                            $addResult = \Bitrix\Catalog\PriceTable::add([
                                "PRODUCT_ID" => $product["ID"],
                                "EXTRA_ID" => $EXTRA_ID,
                                "CATALOG_GROUP_ID" => $RETAIL_PRICE_ID,
                                "CURRENCY" => "RUB",
                                "PRICE" => floatval($arOptPrices[$product["ID"]]) + (floatval($arOptPrices[$product["ID"]]) * $extraValue),
                                "PRICE_SCALE" => floatval($arOptPrices[$product["ID"]]) + (floatval($arOptPrices[$product["ID"]]) * $extraValue),
                            ]);
                        }
                    }
                }
            }
        }

        \First\Agents::reIndexSearch();

        \CBitrixComponent::clearComponentCache('bitrix:catalog.element');

        fwrite($flog, sprintf('%s - END OnCompleteCatalogImport1C'."\n", date('d.m.Y H:i:s')));
        fclose($flog);
    }
    return true;
});
*/
?>