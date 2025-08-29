<?
if (empty($_SERVER['DOCUMENT_ROOT'])) {
    require_once(__DIR__ . '/document_root.php');
}

require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

\Bitrix\Main\Loader::includeModule('iblock');

$arItems = array();

$bUseD7 = true;
$bTestMode = true;

$IBLOCK_ID = Indexis::getIblockId('webinars', 'content');

if ($bUseD7 == false) {
    if (!empty($IBLOCK_ID)) {
        $arSelect = false;
        $arFilter = array("IBLOCK_ID" => $IBLOCK_ID, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
        $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
        while ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            $arFields['PROPERTIES'] = $ob->GetProperties();

            $count = 0;
            if (!empty($arFields['PROPERTIES']['USERS']['VALUE'])) {
                $count = count($arFields['PROPERTIES']['USERS']['VALUE']);
            }

            CIBlockElement::SetPropertyValuesEx(
                $arFields['ID'],
                $arFields['IBLOCK_ID'],
                array('NUM_USERS' => $count)
            );

            $arItems[] = array(
                'API_ID' => $arFields['PROPERTIES']['API_ID']['VALUE'],
                'EVENTSESSION_ID' => $arFields['PROPERTIES']['EVENTSESSION_ID']['VALUE'],
                'NUM_USERS' => $count,
            );
        }
    }
} else {
    if (!empty($IBLOCK_ID)) {
        \Bitrix\Iblock\Iblock::wakeUp($IBLOCK_ID)->getEntityDataClass();

        // Свойства ИБ -->
        $arProps = array();
        $res = \Bitrix\Iblock\PropertyTable::getList(array(
            // сортировка
            'order' => array('SORT' => 'ASC'),
            // выбираемые поля без свойств, свойства можно получать только при обращении к ORM классу, конкретного инфоблока
            'select' => array('ID', 'CODE'),
            // фильтр только по полям элемента
            'filter' => array('IBLOCK_ID' => $IBLOCK_ID),
            // группировка по полю, order должен быть пустой
            'group' => array(),
            // ограничение выбираемого кол-ва
            'limit' => false,
            // число, указывающее номер первого столбца в результате
            'offset' => 0,
            // дает возможность получить кол-во элементов через метод getCount()
            'count_total' => 0,
            // массив полей сущности, создающихся динамически
            'runtime' => array(),
            // разрешает получение нескольких одинаковых записей
            'data_doubling' => false,
            // кеш запроса
            'cache' => array(
                'ttl' => 3600,
                'cache_joins' => true
            ),
        ));
        while ($arItem = $res->fetch()) {
            $arProps[$arItem['CODE']] = $arItem['ID'];
        }
        //vardump($arProps);
        // <-- Свойства ИБ

        $filter = array('IBLOCK_ID' => $IBLOCK_ID, 'ACTIVE' => 'Y');
        /*
        if ($bTestMode == true) {
            $filter['ID'] = 1787;
        }
        */
        $res = \Bitrix\Iblock\ElementTable::getList(array(
            // сортировка
            'order' => array('SORT' => 'ASC'),
            // выбираемые поля без свойств, свойства можно получать только при обращении к ORM классу, конкретного инфоблока
            'select' => array('ID', 'NAME', 'IBLOCK_ID', 'SORT', 'TAGS'),
            // фильтр только по полям элемента
            'filter' => $filter,
            // группировка по полю, order должен быть пустой
            'group' => array(),
            // ограничение выбираемого кол-ва
            'limit' => false,
            // число, указывающее номер первого столбца в результате
            'offset' => 0,
            // дает возможность получить кол-во элементов через метод getCount()
            'count_total' => 0,
            // массив полей сущности, создающихся динамически
            'runtime' => array(),
            // разрешает получение нескольких одинаковых записей
            'data_doubling' => false,
            // кеш запроса
            'cache' => array(
                'ttl' => 3600,
                'cache_joins' => true
            ),
        ));

        while ($arItem = $res->fetch()) {

            // Подсчёт количества пользователей -->
            $count = 0;
            $dbPropValues = \Bitrix\Iblock\ElementPropertyTable::getList(array(
                'order' => array('ID' => 'asc'),
                'select' => array('*'),
                'filter' => array(
                    'IBLOCK_PROPERTY_ID' => $arProps['USERS'],
                    'IBLOCK_ELEMENT_ID' => $arItem['ID'],
                ),
                // кеш запроса
                'cache' => array(
                    'ttl' => 3600,
                    'cache_joins' => true
                ),
            ));
            //$count = $dbPropValues->getCount();
            //echo 'count = '.$count.'<br />';
            //echo 'count = '.($dbPropValues->getCount()).'<br />';
            while ($arValue = $dbPropValues->fetch()) {
                //$arIblockProp['ENUM_LIST'][$arEnum['ID']] = $arEnum;
                //vardump($arValue);
                if (intval($arValue['VALUE']) > 0) {
                    $count++;
                }
            }
            // <-- Подсчёт количества пользователей

            // Редактирование количества пользователей в БД -->
            $dbPropValues = \Bitrix\Iblock\ElementPropertyTable::getList(array(
                'order' => array('ID' => 'asc'),
                'select' => array('ID'),
                'filter' => array(
                    'IBLOCK_PROPERTY_ID' => $arProps['NUM_USERS'],
                    'IBLOCK_ELEMENT_ID' => $arItem['ID'],
                ),
                // кеш запроса
                'cache' => array(
                    'ttl' => 3600,
                    'cache_joins' => true
                ),
            ));
            if ($arValue = $dbPropValues->fetch()) {
                //vardump($arValue);
                \Bitrix\Iblock\ElementPropertyTable::update($arValue['ID'], array('VALUE' => $count));
            } else {
                \Bitrix\Iblock\ElementPropertyTable::add(
                    array(
                        'IBLOCK_PROPERTY_ID' => $arProps['NUM_USERS'],
                        'IBLOCK_ELEMENT_ID' => $arItem['ID'],
                        'VALUE' => $count,
                        'VALUE_TYPE' => 'N',
                    )
                );
            }
            // <-- Редактирование количества пользователей в БД

            // API ID -->
            $API_ID = false;
            $EVENTSESSION_ID = false;
            $dbPropValues = \Bitrix\Iblock\ElementPropertyTable::getList(array(
                'order' => array('ID' => 'asc'),
                'select' => array('*'),
                'filter' => array(
                    'IBLOCK_PROPERTY_ID' => array($arProps['API_ID'], $arProps['EVENTSESSION_ID']),
                    'IBLOCK_ELEMENT_ID' => $arItem['ID'],
                ),
                // кеш запроса
                'cache' => array(
                    'ttl' => 3600,
                    'cache_joins' => true
                ),
            ));
            while ($arValue = $dbPropValues->fetch()) {
                //$arIblockProp['ENUM_LIST'][$arEnum['ID']] = $arEnum;
                //vardump($arValue);
                switch ($arValue['IBLOCK_PROPERTY_ID']) {
                    case $arProps['API_ID']:
                        $API_ID = $arValue['VALUE'];
                        break;
                    case $arProps['EVENTSESSION_ID']:
                        $EVENTSESSION_ID = $arValue['VALUE'];
                        break;
                }
            }
            // <-- API ID

            if (!empty($API_ID) && !empty($EVENTSESSION_ID)) {
                $arItems[] = array(
                    'API_ID' => $API_ID,
                    'EVENTSESSION_ID' => $EVENTSESSION_ID,
                    'NUM_USERS' => $count,
                );
            }
        }
    }
}

//vardump($arItems);

if (!empty($arItems)) {
    if ($bTestMode == false) {
        $fileNameFull = $_SERVER['DOCUMENT_ROOT'] . '/upload/webinars_studied_by_users.csv';
    } else {
        $fileNameFull = $_SERVER['DOCUMENT_ROOT'] . '/upload/webinars_studied_by_users_test.csv';
    }
    $buffer = fopen($fileNameFull, 'w');
    if ($buffer !== false) {
        fputs($buffer, chr(0xEF) . chr(0xBB) . chr(0xBF));
        fputcsv($buffer, array('API_ID', 'EVENTSESSION_ID', 'NUM_USERS'), ';');
        foreach ($arItems as $val) {
            fputcsv($buffer, $val, ';');
        }
        fclose($buffer);
    }
}

require_once($_SERVER["DOCUMENT_ROOT"] . BX_ROOT . "/modules/main/include/epilog_after.php");
