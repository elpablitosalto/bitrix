<?
class COrder
{
    public static function getBasketItems($arParams = array())
    {
        $arResult = array();

        $arResult['BASKET_ITEMS'] = array();
        $arResult['arProductsIds'] = array();
        if (intval($arParams['IBLOCK_ID_BASKET']) > 0 && intval($arParams['USER_ID']) > 0) {
            $arSelect = false;
            $arFilter = array(
                "IBLOCK_ID" => $arParams['IBLOCK_ID_BASKET'],
                "ACTIVE_DATE" => "Y",
                "ACTIVE" => "Y",
                "PROPERTY_USER" => $arParams['USER_ID'],
            );
            $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
            while ($ob = $res->GetNextElement()) {
                $arFields = $ob->GetFields();
                $arFields['PROPERTIES'] = $ob->GetProperties();

                if ($arFields['PROPERTIES']['STATUS']['VALUE_XML_ID'] == 'NEW') {
                    $arItem = array(
                        'ID' => $arFields['ID'],
                        'USER' => $arFields['PROPERTIES']['USER']['VALUE'],
                        'REAGENT' => $arFields['PROPERTIES']['REAGENT']['VALUE'],
                        'COUNT' => $arFields['PROPERTIES']['COUNT']['VALUE'],
                        'STATUS_XML_ID' => $arFields['PROPERTIES']['STATUS']['VALUE_XML_ID'],
                    );

                    $arResult['arProductsIds'][] = $arFields['PROPERTIES']['REAGENT']['VALUE'];

                    //$arResult['BASKET_ITEMS'][$arFields['ID']] = $arItem;
                    $arResult['BASKET_ITEMS'][$arFields['PROPERTIES']['REAGENT']['VALUE']] = $arItem;
                }
            }
        }

        return $arResult;
    }

    public static function getCountInBasket($arParams = array())
    {
        $arResult = array();
        $arResult['countBasketItems'] = 0;
        $arResult['countBasketItemsStr'] = '';

        if (!empty($_SESSION['PARTNER']['BASKET']['COUNT_ITEMS'])) {
            $countBasketItems = $_SESSION['PARTNER']['BASKET']['COUNT_ITEMS'];
        } else {
            $arResultFunc = COrder::getBasketItems(array(
                'IBLOCK_ID_BASKET' => Indexis::getIblockId('orders_reagents', 'orders'),
                'USER_ID' => $arParams['USER_ID'],
            ));
            $countBasketItems = 0;
            //$arResult['BASKET_ITEMS'] = $arResultFunc['BASKET_ITEMS'];
            if (!empty($arResultFunc['BASKET_ITEMS'])) {
                $countBasketItems = count($arResultFunc['BASKET_ITEMS']); 
            }
            $_SESSION['PARTNER']['BASKET']['COUNT_ITEMS'] = $countBasketItems;
        }

        if (intval($countBasketItems) > 99) {
            $countBasketItemsStr = '99+';
        } else {
            $countBasketItemsStr = $countBasketItems;
        }
        if (intval($countBasketItems) > 0) {
            $arResult['countBasketItems'] = $countBasketItems;
        }
        if (!empty($countBasketItemsStr)) {
            $arResult['countBasketItemsStr'] = $countBasketItemsStr;
        }

        return $arResult;
    }

    public static function getIblocksDirections($arParams = array())
    {
        $arResult = array();

        $arResult['DIRECTIONS'] = array();
        $res = CIBlock::GetList(
            array('sort' => 'asc'),
            array(
                'TYPE' => 'reagents',
                'SITE_ID' => SITE_ID,
                'ACTIVE' => 'Y',
                "CNT_ACTIVE" => "Y",
                'CODE' => array('hematology', 'biochemistry', 'analysis', 'veterinary'),
            ),
            true
        );
        while ($arFields = $res->Fetch()) {
            $arItem = array(
                'ID' => $arFields['ID'],
                'NAME' => $arFields['NAME'],
            );
            $arResult['DIRECTIONS'][$arFields['ID']] = $arItem;
        }

        return $arResult;
    }

    public static function getProducts($arParams = array())
    {
        $arResult = array();

        $arResult['PRODUCTS'] = array();
        //$arResult['PRODUCT_TYPES'] = array();
        if (!empty($arParams['arProductsIds'])) {
            $arSelect = false;
            $arFilter = array(
                "ACTIVE_DATE" => "Y",
                "ACTIVE" => "Y",
                "ID" => $arParams['arProductsIds'],
            );
            if (!empty($arParams['CUR_DIRECTION'])) {
                $arFilter['IBLOCK_ID'] = $arParams['CUR_DIRECTION'];
            }
            if (!empty($arParams['CUR_PRODUCT_TYPE'])) {
                $arFilter['PROPERTY_PRODUCT_TYPE'] = $arParams['CUR_PRODUCT_TYPE'];
            }
            $arResult['arFilter'] = $arFilter;
            //vardump($arFilter);
            $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
            while ($ob = $res->GetNextElement()) {
                $arFields = $ob->GetFields();
                $arFields['PROPERTIES'] = $ob->GetProperties();

                foreach ($arFields['PROPERTIES'] as $prop) {
                    if (
                        (is_array($prop["VALUE"]) && count($prop["VALUE"]) > 0)
                        || (!is_array($prop["VALUE"]) && $prop["VALUE"] <> '')
                    ) {
                        $arFields["DISPLAY_PROPERTIES"][$prop['CODE']] = CIBlockFormatProperties::GetDisplayValue($arFields, $prop);
                    }
                }

                //vardump()
                $PRODUCT_TYPE_ID = $arFields["PROPERTIES"]['PRODUCT_TYPE']['VALUE'];
                $PRODUCT_TYPE_NAME = $arFields["DISPLAY_PROPERTIES"]['PRODUCT_TYPE']['DISPLAY_VALUE'];

                $arItem = array(
                    'ID' => $arFields['ID'],
                    'IBLOCK_ID' => $arFields['IBLOCK_ID'],
                    'NAME' => $arFields['NAME'],
                    'NUMBER' => $arFields["PROPERTIES"]['NUMBER']['VALUE'],
                    'COUNT' => $arParams['BASKET_ITEMS'][$arFields['ID']]['COUNT'],
                    'PRODUCT_TYPE_ID' => $PRODUCT_TYPE_ID,
                    'PRODUCT_TYPE_NAME' => $PRODUCT_TYPE_NAME,
                );

                $arResult['PRODUCTS'][$arFields['ID']] = $arItem;
            }
        }

        return $arResult;
    }

    public static function getProductsOutput($arParams = array())
    {
        $arResult = array();

        $arResult['ITEMS'] = array();
        if (!empty($arParams['DIRECTIONS']) && !empty($arParams['PRODUCTS'])) {
            foreach ($arParams['DIRECTIONS'] as $arDirection) {
                foreach ($arParams['PRODUCTS'] as $arProduct) {
                    if ($arDirection['ID'] == $arProduct['IBLOCK_ID']) {
                        $arResult['ITEMS'][$arDirection['ID']][$arProduct['PRODUCT_TYPE_ID']][$arProduct['ID']] = $arProduct;
                    }
                }
            }
        }

        return $arResult;
    }

    public static function getSmartFilter($arParams = array())
    {
        $arResult = array();

        if (!empty($arParams['arProductsIds'])) {
            $arPresentDirections = array();
            $arSelect = false;
            $arFilter = array(
                "ACTIVE_DATE" => "Y",
                "ACTIVE" => "Y",
                "ID" => $arParams['arProductsIds'],
            );
            $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
            while ($ob = $res->GetNextElement()) {
                $arFields = $ob->GetFields();
                $arFields['PROPERTIES'] = $ob->GetProperties();

                foreach ($arFields['PROPERTIES'] as $prop) {
                    if (
                        (is_array($prop["VALUE"]) && count($prop["VALUE"]) > 0)
                        || (!is_array($prop["VALUE"]) && $prop["VALUE"] <> '')
                    ) {
                        $arFields["DISPLAY_PROPERTIES"][$prop['CODE']] = CIBlockFormatProperties::GetDisplayValue($arFields, $prop);
                    }
                }

                $PRODUCT_TYPE_ID = $arFields["PROPERTIES"]['PRODUCT_TYPE']['VALUE'];
                $PRODUCT_TYPE_NAME = $arFields["DISPLAY_PROPERTIES"]['PRODUCT_TYPE']['DISPLAY_VALUE'];

                $arResult['PRODUCT_TYPES'][$PRODUCT_TYPE_ID] = array(
                    'ID' => $PRODUCT_TYPE_ID,
                    'NAME' => $PRODUCT_TYPE_NAME,
                );

                $arPresentDirections[] = $arFields['IBLOCK_ID'];
                //$arPresentTypes[] = $PRODUCT_TYPE_ID;
            }
            if (!empty($arParams['DIRECTIONS'])) {
                $arResult['DIRECTIONS'] = $arParams['DIRECTIONS'];
                $arTmp = array();
                foreach ($arParams['DIRECTIONS'] as $key => $val) {
                    if (in_array($key, $arPresentDirections)) {
                        $arTmp[$key] = $val;
                    }
                }
                $arResult['DIRECTIONS'] = $arTmp;
            }
        }

        return $arResult;
    }

    public static function changeStatusBasketItems($arParams = array())
    {
        $arResult = array();

        $bError = false;

        // Список товаров в корзине -->
        $arResultFunc = COrder::getBasketItems(array(
            'IBLOCK_ID_BASKET' => $arParams['IBLOCK_ID_BASKET'],
            'USER_ID' => $arParams['USER_ID'],
        ));
        $arResult['BASKET_ITEMS'] = $arResultFunc['BASKET_ITEMS'];
        //$arProductsIds = $arResultFunc['arProductsIds'];
        // <-- Список товаров в корзине

        // Статусы элементов корзины -->
        $arStatuses = array();
        if (intval($arParams['IBLOCK_ID_BASKET']) > 0) {
            $property_enums = CIBlockPropertyEnum::GetList(
                array("DEF" => "DESC", "SORT" => "ASC"),
                array("IBLOCK_ID" => $arParams['IBLOCK_ID_BASKET'], "CODE" => "STATUS")
            );
            while ($enum_fields = $property_enums->GetNext()) {
                //echo $enum_fields["ID"] . " - " . $enum_fields["VALUE"] . "<br>";
                $arStatuses[$enum_fields["XML_ID"]] = $enum_fields;
            }
        }
        // <-- Статусы элементов корзины

        if (!empty($arResult['BASKET_ITEMS']) && !empty($arStatuses)) {
            foreach ($arResult['BASKET_ITEMS'] as $key => $arItem) {
                CIBlockElement::SetPropertyValues(
                    $arItem['ID'],
                    $arParams['IBLOCK_ID_BASKET'],
                    $arStatuses['SENT']['ID'],
                    'STATUS'
                );
            }
        }

        if (!$bError) {
            $arResult['RESULT'] = 'SUCCESS';
        }

        return $arResult;
    }

    public static function sendMessages($arParams = array())
    {
        $arResult = array();

        $bError = false;

        $arUser = $arParams['USER'];

        // Письмо менеджеру -->
        $arEventFields = array(
            'USER_LEGAL_ENTITY' => $arUser['WORK_COMPANY'],
            'DATE_SEND_FORM' => date('d.m.Y'),
            'NAME' => $arUser['NAME'],
            'LAST_NAME' => $arUser['LAST_NAME'],
            'TIME_SEND_FORM' => date('H:i'),
            'LINK_WEB_FORM_RESULT' => '/bitrix/admin/form_result_edit.php?lang=ru&WEB_FORM_ID=3&RESULT_ID=' . $arParams['WEBFORM_RESULT_ID'] . '&WEB_FORM_NAME=ORDERS',
        );
        $arFiles = array($arParams['FILE']);
        CEvent::Send('NEW_ORDER_MANAGER', SITE_ID, $arEventFields, 'Y', '', $arFiles);
        // <-- Письмо менеджеру


        // Письмо пользователю -->
        $arEventFields = array(
            'DATE_SEND_FORM' => date('d.m.Y'),
            'TIME_SEND_FORM' => date('H:i'),
            'NAME' => $arUser['NAME'],
            'LAST_NAME' => $arUser['LAST_NAME'],
            'BUYER_LEGAL_ENTITY' => $arParams['BUYER_LEGAL_ENTITY'],
        );
        $arFiles = array($arParams['FILE']);
        CEvent::Send('NEW_ORDER_BUYER', SITE_ID, $arEventFields, 'Y', '', $arFiles);
        // <-- Письмо пользователю


        if (!$bError) {
            $arResult['RESULT'] = 'SUCCESS';
        }

        return $arResult;
    }

    public static function getOrderFile($arParams = array())
    {
        $arResult = array();

        $arUser = $arParams['USER'];

        // Список товаров в корзине -->
        $arResultFunc = COrder::getBasketItems(array(
            'IBLOCK_ID_BASKET' => $arParams['IBLOCK_ID_BASKET'],
            'USER_ID' => $arParams['USER_ID'],
        ));
        $arResult['BASKET_ITEMS'] = $arResultFunc['BASKET_ITEMS'];
        $arProductsIds = $arResultFunc['arProductsIds'];
        // <-- Список товаров в корзине

        // Направления -->
        $arResultFunc = COrder::getIblocksDirections();
        $arResult['DIRECTIONS'] = $arResultFunc['DIRECTIONS'];
        // <-- Направления

        // Товары -->
        $arResultFunc = COrder::getProducts(array(
            'arProductsIds' => $arProductsIds,
            'CUR_DIRECTION' => $arParams['CUR_DIRECTION'],
            'CUR_PRODUCT_TYPE' => $arParams['CUR_PRODUCT_TYPE'],
            'BASKET_ITEMS' => $arResult['BASKET_ITEMS'],
        ));
        $arResult['PRODUCTS'] = $arResultFunc['PRODUCTS'];
        $arResult['PRODUCT_TYPES'] = $arResultFunc['PRODUCT_TYPES'];
        $arResult['arFilter'] = $arResultFunc['arFilter'];
        // <-- Товары

        // Элементы для вывода -->
        $arResultFunc = COrder::getProductsOutput(array(
            'DIRECTIONS' => $arResult['DIRECTIONS'],
            'PRODUCTS' => $arResult['PRODUCTS'],
        ));
        $arResult['ITEMS'] = $arResultFunc['ITEMS'];
        //vardump($arResult['ITEMS']);
        // <-- Элементы для вывода

        /*
        $output = '<!DOCTYPE html><html lang="ru"><head>';
        $output .= '<meta http-equiv="Content-Type" content="application/vnd.ms-excel" />';
        //$output .= '<meta http-equiv="Content-Disposition" content="application/vnd.ms-excel" />';
        $output .= '</head><body>';
        */

        $output = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
         <head>
             <meta http-equiv="content-type" content="text/html; charset=utf-8" />
             <meta name="author" content="dirui" />
             <title>Заказ</title>
         </head>
         <body>';

        // Данные заказчика -->
        $output .= '<table>';

        $output .= '<tr>';
        $output .= '<td>Дата и время отправления</td>';
        $output .= '<td>' . date('d.m.Y H:i:s') . '</td>';
        $output .= '</tr>';

        $output .= '<tr>';
        $output .= '<td>Пользователь, отправивший заявку</td>';
        $output .= '<td>' . $arUser['NAME'] . ' ' . $arUser['LAST_NAME'] . '</td>';
        $output .= '</tr>';

        $output .= '<tr>';
        $output .= '<td>Юр.лицо пользователя</td>';
        $output .= '<td>' . $arUser['WORK_COMPANY'] . '</td>';
        $output .= '</tr>';

        $output .= '<tr>';
        $output .= '<td>Юр. лицо конечного заказчика</td>';
        $output .= '<td>' . $arParams['BUYER_LEGAL_ENTITY'] . '</td>';
        $output .= '</tr>';

        $output .= '</table>';
        // <-- Данные заказчика

        // Товары -->
        $output .= '<table>';
        $output .= '<tr>';
        $output .= '<td>Название</td>';
        $output .= '<td>Номер</td>';
        $output .= '<td>Количество</td>';
        $output .= '</tr>';
        foreach ($arResult['ITEMS'] as $idDirect => $arDirection) {
            foreach ($arDirection as $idType => $arType) {
                foreach ($arType as $arItem) {
                    $output .= '<tr>';
                    $output .= '<td>' . $arItem['NAME'] . '</td>';
                    $output .= '<td>' . $arItem['NUMBER'] . '</td>';
                    $output .= '<td>' . $arItem['COUNT'] . '</td>';
                    $output .= '</tr>';
                }
            }
        }
        $output .= '</table>';
        // <-- Товары

        $output .= '</body></html>';

        // Сохранение в файл -->
        $dir = "/upload/orders/";
        $dirFull = $_SERVER['DOCUMENT_ROOT'] . $dir;
        if (!is_dir($dirFull)) {
            mkdir($dirFull, BX_DIR_PERMISSIONS, true);
        }
        $fileName = date('YmdHis') . '_' . $arUser['ID'] . '.xls';
        $filePath = $dir . $fileName;
        $filePathFull = $dirFull . $fileName;
        if (file_put_contents($filePathFull, $output)) {
            $arResult['RESULT'] = 'SUCCESS';
            $arResult['filePath'] = $filePath;
            $arResult['filePathFull'] = $filePathFull;
        } else {
            $arResult['RESULT'] = 'ERROR';
        }
        // <-- Сохранение в файл

        return $arResult;
    }
}
