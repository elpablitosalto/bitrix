<?if( !$_SERVER["DOCUMENT_ROOT"] ){$_SERVER["DOCUMENT_ROOT"] = realpath(dirname(__FILE__)."/../../");}

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use \Bitrix\Main\Loader;
use \Bitrix\Catalog\PriceTable;

if (!Loader::includeModule('iblock')){ return false; }
if (!Loader::includeModule('catalog')){ return false; }

#Путь до файла с параметрами парсера
$arFileJson = $_SERVER["DOCUMENT_ROOT"].'/local/cron/exchange_params.json';

#Время начало обмена
$startDateImport = date("d-m-Y_H-i-s");

#Путь до файла обмена
$wayFileExchange = $_SERVER["DOCUMENT_ROOT"].'/upload/1c_remains/1c_remains.csv';

#Путь до бекапа (файлы обмена которые прошли обработку и логов)
$wayBackup = $_SERVER["DOCUMENT_ROOT"].'/upload/1c_remains/backup/';

#Название файла обмена который прошл обработку
$nameFileExchangeBackup = '1c_remains_'.$startDateImport.'.csv';

#Путь до файла с логам
$wayFileLog = $_SERVER["DOCUMENT_ROOT"].'/local/cron/exchange_log.txt';

#Название файла лога обмена который прошл обработку
$nameFileLogBackup = 'exchange_log_'.$startDateImport.'.txt';

#ID Каталог товаров
$catalogiIblockId = '7';

#ID Пакет предложений (Каталог товаров)
$offerIblockId = '8';

#ID цены которую нужно обновлять (ID = 1 - Розничная рубли)
$arResult["BASE_PRICE"]["ID"] = '1';

#Удаляем стары log
unlink($wayFileLog);

#даные фала json
$fileJson = file_get_contents($arFileJson);
$arDataJson = json_decode($fileJson, true);

if ($arDataJson["exchange_ended"] == "Y")
{
    #говорим что парсер начался
    $arDataJson = array("exchange_ended" => "N");
    $obDataJson = json_encode($arDataJson);
    file_put_contents($arFileJson, $obDataJson);

    $dataLog .= $arResult["MESSAGE"]["OK"][] = '============== Начало обмена остатков и цен '.$startDateImport.' =============='.PHP_EOL;

    #Получаем данные из файла
    if (file_exists($wayFileExchange))
    {
        if (($fileCsv = fopen($wayFileExchange, "r")))
        {
            $arResult["COUNT"] = 0;
            #Проверка на формат файла
            while (($arData = fgetcsv($fileCsv, 1000, ";")) !== FALSE)
            {
                foreach ($arData as $key => $item)
                    $arData[$key] = iconv("Windows-1251", "UTF-8", $item);

                if (!$arData[0])
                {
                    $dataLog .= $arResult["MESSAGE"]["ERROR"][] = 'Ошибка: у элемента нет идентификатора SKU - '.$arData[0].' | кол-во - '.$arData[1].' | цена - '.$arData[2].PHP_EOL;
                    continue;
                }

                $arNewData = array(
                    "SKU" => $arData[0],
                    "QUANTITY" => intval($arData[1]),
                    "PRICE" => intval($arData[2]),
                );

                $arResult["ITEMS_FILE"][$arData[0]] = $arNewData;
                
                $arResult["COUNT"]++;
            }
            fclose($fileCsv);

            if ($arResult["ITEMS_FILE"] && $arResult["COUNT"])
                $dataLog .= $arResult["MESSAGE"]["OK"][] = 'Обработано элементов '.$arResult["COUNT"].PHP_EOL;
        }
        else
        {
            $dataLog .= $arResult["MESSAGE"]["ERROR"][] = 'Ошибка: файл '.$wayFileExchange.' не открылся'.PHP_EOL;
        }
    }
    else
    {
        $dataLog .= $arResult["MESSAGE"]["ERROR"][] = 'Ошибка: файл '.$wayFileExchange.' не найден'.PHP_EOL;
    }

    #Получаем товары по фильтру SKU
    if ($arResult["ITEMS_FILE"])
    {
        foreach ($arResult["ITEMS_FILE"] as $arItem)
            $filterPropSku[] = $arItem["SKU"];

        #получаем простые товары
        $obElementList = \CIBlockElement::GetList(
            array("SORT"=>"ASC"),
            array("IBLOCK_ID" => $catalogiIblockId,"PROPERTY_SKU" => $filterPropSku),
            false,
            false,
            array("ID","IBLOCK_ID","IBLOCK_SECTION_ID","NAME","CODE","PROPERTY_SKU")
        );
        while($arElement = $obElementList->Fetch())
        {
            $arElementSku[] = $arElement["PROPERTY_SKU_VALUE"];

            // $arParamsProduct = CCatalogProduct::GetByID($arElement["ID"]);
            $arParamsProduct = \Bitrix\Catalog\ProductTable::getList(
                array(
                    'filter' => array('=ID' => $arElement["ID"]),
                    'select' => array('ID','QUANTITY','TYPE')
                )
            )->Fetch();

            $arElement["PARAMS_PRODUCT"] = array(
                "QUANTITY" => $arParamsProduct["QUANTITY"],
                "TYPE" => $arParamsProduct["TYPE"],
            );
            $arElement["DATA_FILE"] = $arResult["ITEMS_FILE"][$arElement["PROPERTY_SKU_VALUE"]];
            $arResult["ITEMS"][] = $arElement;
        }

        #получаем торговые предложения
        $obOfferList = \CIBlockElement::GetList(
            array("SORT"=>"ASC"),
            array("IBLOCK_ID" => $offerIblockId,"PROPERTY_SKU" => $filterPropSku),
            false,
            false,
            array("ID","IBLOCK_ID","IBLOCK_SECTION_ID","NAME","CODE","PROPERTY_SKU")
        );
        while($arOffer = $obOfferList->Fetch())
        {
            $arElementSku[] = $arOffer["PROPERTY_SKU_VALUE"];

            // $arParamsProduct = CCatalogProduct::GetByID($arElement["ID"]);
            $arParamsProduct = \Bitrix\Catalog\ProductTable::getList(
                array(
                    'filter' => array('=ID' => $arOffer["ID"]),
                    'select' => array('ID','QUANTITY','TYPE')
                )
            )->Fetch();

            $arOffer["PARAMS_PRODUCT"] = array(
                "QUANTITY" => $arParamsProduct["QUANTITY"],
                "TYPE" => $arParamsProduct["TYPE"],
            );
            $arOffer["DATA_FILE"] = $arResult["ITEMS_FILE"][$arOffer["PROPERTY_SKU_VALUE"]];
            $arResult["OFFER"][] = $arOffer;
        }

        foreach ($filterPropSku as $sku)
        {
            if (!in_array($sku, $arElementSku))
                $dataLog .= $arResult["MESSAGE"]["ERROR"][] = 'Ошибка: в каталоге не найдено элемента с идентификатором SKU - '.$sku.PHP_EOL;
        }

        unset($arResult["ITEMS_FILE"]);
    }

    #Обнавляем данные простого товара
    if ($arResult["ITEMS"])
    {
        #Получаем базовую цену
        // $arResult["BASE_PRICE"] = \CCatalogGroup::GetList(array(),array("BASE"=>"Y"),false,false,array("ID","NAME","NAME_LANG"))->Fetch();
        if (!$arResult["BASE_PRICE"]["ID"])
            $dataLog .= $arResult["MESSAGE"]["ERROR"][] = 'Ошибка: базовая цена не найдена'.PHP_EOL;

        $arResult["COUNT_UPDATE_ITEMS"] = 0;
        foreach ($arResult["ITEMS"] as $arItem)
        {
            if ($arItem["PARAMS_PRODUCT"]["TYPE"] != '1')
            {
                $dataLog .= $arResult["MESSAGE"]["ERROR"][] = 'Ошибка: этот товар с идентификатором SKU - '.$arItem["PROPERTY_SKU_VALUE"].' с торговом предложением'.PHP_EOL;
                continue;
            }

            #Обновления/добавления цены
            if ($arResult["BASE_PRICE"]["ID"] && $arItem["DATA_FILE"]["PRICE"])
            {
                $obPriceList = PriceTable::getList(
                    array(
                        'select' => array("*"),
                        'filter' => array("PRODUCT_ID" => $arItem["ID"],"CATALOG_GROUP_ID" => $arResult["BASE_PRICE"]["ID"]),
                        'order' => array("ID" => "ASC"),
                        'limit' => 1
                    )
                );
                if ($itemPrice = $obPriceList->Fetch())
                {
                    if (intval($itemPrice["PRICE"]) != $arItem["DATA_FILE"]["PRICE"])
                    {
                        $resUpdatePrice = PriceTable::update(
                            $itemPrice["ID"],
                            array(
                                "PRICE" => $arItem["DATA_FILE"]["PRICE"],
                                "PRICE_SCALE" => $arItem["DATA_FILE"]["PRICE"]
                            )
                        );
                        $success = $resUpdatePrice->isSuccess();
                        if (!$success)
                            $dataLog .= $arResult["MESSAGE"]["ERROR"][] = 'Ошибка: у товара с идентификатором SKU - '.$arItem["PROPERTY_SKU_VALUE"].' цена не обновилась'.PHP_EOL;
                    }
                }
                else
                {
                    $resAddPrice = PriceTable::add(array(
                        "PRODUCT_ID" => $arItem["ID"],
                        "CATALOG_GROUP_ID" => $arResult["BASE_PRICE"]["ID"],
                        "PRICE" => $arItem["DATA_FILE"]["PRICE"],
                        "PRICE_SCALE" => $arItem["DATA_FILE"]["PRICE"],
                        "CURRENCY" => "RUB"
                    ));
                    $success = $resAddPrice->isSuccess();
                    if (!$success)
                        $dataLog .= $arResult["MESSAGE"]["ERROR"][] = 'Ошибка: у товара с идентификатором SKU - '.$arItem["PROPERTY_SKU_VALUE"].' цена не добавилась'.PHP_EOL;
                }
            }

            #Обновления доступного количества товаров
            if ($arItem["DATA_FILE"]["QUANTITY"] > 0)
                \CCatalogProduct::Update($arItem["ID"], array('QUANTITY' => $arItem["DATA_FILE"]["QUANTITY"]));
            else if ($arItem["DATA_FILE"]["QUANTITY"] == 0)
                \CCatalogProduct::Update($arItem["ID"], array('QUANTITY' => 0));

            $arResult["COUNT_UPDATE_ITEMS"]++;
        }

        $dataLog .= $arResult["MESSAGE"]["OK"][] = 'Обновлено элементов (простые товары) '.$arResult["COUNT_UPDATE_ITEMS"].PHP_EOL;
    }

    #Обнавляем данные торговыого предложения
    if ($arResult["OFFER"])
    {
        #Получаем базовую цену
        // $arResult["BASE_PRICE"] = \CCatalogGroup::GetList(array(),array("BASE"=>"Y"),false,false,array("ID","NAME","NAME_LANG"))->Fetch();
        if (!$arResult["BASE_PRICE"]["ID"])
            $dataLog .= $arResult["MESSAGE"]["ERROR"][] = 'Ошибка: базовая цена не найдена'.PHP_EOL;

        $arResult["COUNT_UPDATE_OFFER"] = 0;
        foreach ($arResult["OFFER"] as $arItem)
        {
            if ($arItem["PARAMS_PRODUCT"]["TYPE"] != '4')
            {
                $dataLog .= $arResult["MESSAGE"]["ERROR"][] = 'Ошибка: этот товар с идентификатором SKU - '.$arItem["PROPERTY_SKU_VALUE"].' не является торговым предложением'.PHP_EOL;
                continue;
            }

            #Обновления/добавления цены
            if ($arResult["BASE_PRICE"]["ID"] && $arItem["DATA_FILE"]["PRICE"])
            {
                $obPriceList = PriceTable::getList(
                    array(
                        'select' => array("*"),
                        'filter' => array("PRODUCT_ID" => $arItem["ID"],"CATALOG_GROUP_ID" => $arResult["BASE_PRICE"]["ID"]),
                        'order' => array("ID" => "ASC"),
                        'limit' => 1
                    )
                );
                if ($itemPrice = $obPriceList->Fetch())
                {
                    if (intval($itemPrice["PRICE"]) != $arItem["DATA_FILE"]["PRICE"])
                    {
                        $resUpdatePrice = PriceTable::update(
                            $itemPrice["ID"],
                            array(
                                "PRICE" => $arItem["DATA_FILE"]["PRICE"],
                                "PRICE_SCALE" => $arItem["DATA_FILE"]["PRICE"]
                            )
                        );
                        $success = $resUpdatePrice->isSuccess();
                        if (!$success)
                            $dataLog .= $arResult["MESSAGE"]["ERROR"][] = 'Ошибка: у товара с идентификатором SKU - '.$arItem["PROPERTY_SKU_VALUE"].' цена не обновилась'.PHP_EOL;
                    }
                }
                else
                {
                    $resAddPrice = PriceTable::add(array(
                        "PRODUCT_ID" => $arItem["ID"],
                        "CATALOG_GROUP_ID" => $arResult["BASE_PRICE"]["ID"],
                        "PRICE" => $arItem["DATA_FILE"]["PRICE"],
                        "PRICE_SCALE" => $arItem["DATA_FILE"]["PRICE"],
                        "CURRENCY" => "RUB"
                    ));
                    $success = $resAddPrice->isSuccess();
                    if (!$success)
                        $dataLog .= $arResult["MESSAGE"]["ERROR"][] = 'Ошибка: у товара с идентификатором SKU - '.$arItem["PROPERTY_SKU_VALUE"].' цена не добавилась'.PHP_EOL;
                }
            }

            #Обновления доступного количества товаров
            if ($arItem["DATA_FILE"]["QUANTITY"] > 0)
                \CCatalogProduct::Update($arItem["ID"], array('QUANTITY' => $arItem["DATA_FILE"]["QUANTITY"]));
            else if ($arItem["DATA_FILE"]["QUANTITY"] == 0)
                \CCatalogProduct::Update($arItem["ID"], array('QUANTITY' => 0));

            $arResult["COUNT_UPDATE_OFFER"]++;
        }

        $dataLog .= $arResult["MESSAGE"]["OK"][] = 'Обновлено элементов (торговых предложений) '.$arResult["COUNT_UPDATE_OFFER"].PHP_EOL;
    }

    $dataLog .= $arResult["MESSAGE"]["OK"][] = '============== Обмен завершён '.$startDateImport.' - '.date("H-i-s").' =============='.PHP_EOL;

    if (file_exists($wayFileExchange))
    {
        #Копируем файл обмена для истории
        // copy($wayFileExchange, $wayBackup.$nameFileExchangeBackup);

        #Удаляем фалй обмена
        unlink($wayFileExchange);

        # Отправляем уведомление об успешном завершении
        CEvent::Send("EXCHANGE_COMPLETE_SUCCESS", "s1", []);
    }

    $f = fopen($wayFileLog, "a+");
    fwrite($f, print_r($dataLog,true));
    fclose($f);

    #Копируем файл лога для истории
    // copy($wayFileLog, $wayBackup.$nameFileLogBackup);

    #даные фала json (говорим что парсер закончился)
    $fileJson = file_get_contents($arFileJson);
    $arDataJson = json_decode($fileJson, true);
    $arDataJson = array(
        "exchange_ended" => "Y",
        "start_of_exchange" => $startDateImport,
        "end_exchange" => date("H-i-s"),
        "renewed_product" => $arResult["COUNT_UPDATE_ITEMS"],
        "renewed_offer" => $arResult["COUNT_UPDATE_OFFER"]
    );
    $obDataJson = json_encode($arDataJson);
    file_put_contents($arFileJson, $obDataJson);
}
else
{
    echo "parser is running";
}
