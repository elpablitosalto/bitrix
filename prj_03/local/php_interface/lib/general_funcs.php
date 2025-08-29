<?

/**
 * Функция выводит массив на экран
 * param  $arr  Array Массив данных
 * param  $var_dump Bool Если true, то выводит в массиве и типы данных
 * Void
 */
function vardump($arr = false, $var_dump = false)
{
    echo "<pre >";
    if ($var_dump) {
        var_dump($arr);
    } else {
        print_r($arr);
    }
    echo "</pre>";
}

function pre($data, $flag = true)
{
    if ($flag) {
        $bt =  debug_backtrace();
        $bt = $bt[0];
        $dRoot = $_SERVER["DOCUMENT_ROOT"];
        $dRoot = str_replace("/", "\\", $dRoot);
        $bt["file"] = str_replace($dRoot, "", $bt["file"]);
        $dRoot = str_replace("\\", "/", $dRoot);
        $bt["file"] = str_replace($dRoot, "", $bt["file"]);
?>
        <div style='font-size:12px; color:#000; background:#fff; border:1px dashed #000;'>
            <div style='padding:3px 5px; background:#99CCFF; font-weight:bold;'>File: <?= $bt["file"] ?> [<?= $bt["line"] ?>]</div>
            <pre style='padding:10px;'><? print_r($data) ?></pre>
        </div>
<?
    } else {
        echo '<pre>', print_r($data), '</pre>';
    }
}

// 34392 - Изменить вывод свойств карточек товаров (количество в каталоге)
function getProductQty($arItem)
{
    //$arAvailableStores = [113, 117];
    $arAvailableStores = STORES_AVAILABLE;
    $arOrderStores = STORES_ORDER;
    //vardump($arOrderStores);
    $arResult = [
        "AVAILABLE" => 0,
        "ORDER" => 0,
        "HTML" => '<div class="catalog-qty-title">Доступность:</div>'
    ];
    \Bitrix\Main\Loader::includeModule("catalog");
    $arMeasure = CCatalogMeasure::getList(array(), array("ID" => $arItem["CATALOG_MEASURE"]), false, false, array())->GetNext();
    //
    if (!empty($arItem["OFFERS"])) {  // товары с предложениями
        foreach ($arItem["OFFERS"] as $offer) {
            $rsStoreProduct = \Bitrix\Catalog\StoreProductTable::getList(array(
                'filter' => array('=PRODUCT_ID' => $offer["ID"], 'STORE.ACTIVE' => 'Y'),
                'select' => array('*'),
            ));
            while ($arStoreProduct = $rsStoreProduct->fetch()) {
                $offer["STORES"][$arStoreProduct['STORE_ID']] = $arStoreProduct;
            }
            foreach ($arAvailableStores as $availableStoreId) {
                $arResult["AVAILABLE"] += intval($offer["STORES"][$availableStoreId]["AMOUNT"]);
            }
            foreach ($offer["STORES"] as $store) {
                //if (!in_array($store["STORE_ID"], $arAvailableStores)) {
                if (in_array($store["STORE_ID"], $arOrderStores)) {
                    $arResult["ORDER"] += intval($store["AMOUNT"]);
                }
            }
        }
    } else {  // обычные товары
        $rsStoreProduct = \Bitrix\Catalog\StoreProductTable::getList(array(
            'filter' => array('=PRODUCT_ID' => $arItem["ID"], 'STORE.ACTIVE' => 'Y'),
            'select' => array('*'),
        ));
        while ($arStoreProduct = $rsStoreProduct->fetch()) {
            $arItem["STORES"][$arStoreProduct['STORE_ID']] = $arStoreProduct;
        }
        foreach ($arAvailableStores as $availableStoreId) {
            $arResult["AVAILABLE"] += intval($arItem["STORES"][$availableStoreId]["AMOUNT"]);
        }
        foreach ($arItem["STORES"] as $store) {
            //if (!in_array($store["STORE_ID"], $arAvailableStores)) {
            if (in_array($store["STORE_ID"], $arOrderStores)) {
                $arResult["ORDER"] += intval($store["AMOUNT"]);
            }
        }
    }
    if (($arResult["AVAILABLE"] + $arResult["ORDER"]) > 0) {
        if ($arResult["AVAILABLE"] > 0) {
            $arResult["HTML"] .= '<div class="catalog-qty-desc">' . $arResult["AVAILABLE"] . ' ' . $arMeasure["SYMBOL_RUS"] . ' - в наличии</div>';
        }
        if ($arResult["ORDER"] > 0) {
            $arResult["HTML"] .= '<div class="catalog-qty-desc">' . $arResult["ORDER"] . ' ' . $arMeasure["SYMBOL_RUS"] . ' - под заказ 5-10 дней</div>';
        }
    } else {
        $arResult["HTML"] .= '<div class="catalog-qty-desc">По запросу</div>';
    }
    return $arResult;
}

function isMobileDevice()
{
    $result = false;

    $res_1 = preg_match(
        "/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i",
        $_SERVER["HTTP_USER_AGENT"]
    );

    $res_2 = preg_match(
        "/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i",
        strtolower($_SERVER["HTTP_USER_AGENT"])
    );

    if ($res_1 || $res_2) {
        $result = true;
    }

    return $result;
}

function isPageSpeedBot()
{
    $result = false;
    if (
        stripos(@$_SERVER['HTTP_USER_AGENT'], 'Lighthouse') !== false
        || stripos(@$_SERVER['HTTP_USER_AGENT'], 'Google Page Speed Insights') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Lighthouse') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Google Page Speed Insights') !== false
    ) {
        $result = true;
    }
    return $result;
}
