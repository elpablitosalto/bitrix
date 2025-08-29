<?
set_time_limit(20);

/*
if (!file_exists($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php'))
    $_SERVER['DOCUMENT_ROOT'] = '/home/t/techinm8/geropharm.techinm8.beget.tech/public_html';
*/

if (strlen($_SERVER["DOCUMENT_ROOT"]) <= 0 && is_file(__DIR__ . "/document_root.php")) {
    include(__DIR__ . "/document_root.php");
}

require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

/*
if (!$USER->IsAdmin()) {
    die();
}
*/

/*
// Тестирование -->
//$newName = 'Фармакологический практикум для невролога (часть 1)';
$newName = 'Фармакологический практикум для невролога (часть 1) 2023-11-01 13:34:29';
//$pattern = "/[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01]) [0-9]{2}:[0-9]{2}:[0-9]{2}/";
$pattern = "/[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01]) [0-9]{2}:[0-9]{2}:[0-9]{2}/";
if (preg_match($pattern, $newName, $matches)) {
    if (strlen($matches[0]) == 19) {
        $newName = preg_replace($pattern, '', $newName);
        $bUpdate = true;
    }
}
vardump($matches);
echo 'NEW_NAME = ' . $newName . '<br />';
die();
// <-- Тестирование
*/

CModule::IncludeModule('iblock');

$arStopWords = array(
    "Тест",
    "Встреча",
    "Запись",
    "ЦЦК",
    "Анонс",
    "Прогон",
    "Мероприятие",
    "Вебинар",
    "ЦАГ",
    "Брифинг",
    "ККМ практика",
    "ТЗ по Геткурс",
    "ШКОЛА МОЛОДОГО СПИКЕРА",
    "Калибровка",
    "SFE",
    "Маркетинговая стратегия",
    "Цикловой",
    "Профилирование",
    "совещание",
    "test",
    "онлайн практикум",
    "новый вебинар",
    "валерий петрович",
    "гулиева"
);
?>

<?
// Получим статус загрузки -->
$statusElId = 0;
$arStatus = array();
$arSelect = array("ID", "NAME", "PREVIEW_TEXT");
$arFilter = array(
    "IBLOCK_ID" => Indexis::getIblockId('statuses', 'service'),
    "ACTIVE_DATE" => "Y",
    "ACTIVE" => "Y",
    "CODE" => "get_vebinars"
);
$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
if ($ob = $res->GetNextElement()) {
    $arFields = $ob->GetFields();
    $statusElId = $arFields['ID'];

    $str = strip_tags($arFields['PREVIEW_TEXT']);
    $str = html_entity_decode($str);

    //echo 'PREVIEW_TEXT = '.$str.'<br />';

    if (strlen($str) > 0) {
        //$arStatus = json_decode($arFields['PREVIEW_TEXT'], true);
        $arStatus = unserialize($str);
    }
    //vardump($arStatus);
}
if (empty($arStatus)) {
    $arStatus = array(
        "page" => 0,
    );
}
// <-- Получим статус загрузки

// Получим список вебинаров из БД -->
$arActives = array();
$arDelWebinarsIds = array();
$arVebinarsDB = array();
$arSelect = array("ID", "ACTIVE", "NAME", "PROPERTY_API_ID");
$arFilter = array(
    "IBLOCK_ID" => Indexis::getIblockId('webinars', 'content'),
    //"ACTIVE_DATE" => "Y",
    //"ACTIVE" => "Y"
);
$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
while ($ob = $res->GetNextElement()) {
    $arFields = $ob->GetFields();
    if (strlen($arFields['PROPERTY_API_ID_VALUE']) > 0) {
        $arVebinarsDB[$arFields['PROPERTY_API_ID_VALUE']] = array(
            'ELEMENT_ID' => $arFields['ID'],
            'NAME' => $arFields['NAME'],
            'API_ID' => $arFields['PROPERTY_API_ID_VALUE'],
        );
    }

    // Проверка на стоп-слова -->
    $haystack = mb_strtolower($arFields['NAME']);
    foreach ($arStopWords as $needle) {
        $needle = mb_strtolower($needle);
        if (strpos($haystack, $needle) !== false) {
            $arDelWebinarsIds[] = $arFields['ID'];
            $arDelWebinarsNames[$arFields['ID']][$needle] = $arFields['NAME'];
        }
    }
    // <-- Проверка на стоп-слова

    $arActives[$arFields['ID']] = $arFields['ACTIVE'];

    // Вырежем даты из названий -->
    if ($arFields['ACTIVE'] == 'Y') {
        $bUpdate = false;
        $newName = $arFields['NAME'];
        // 2023-12-08 15:43:40
        //$pattern = "/[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])/";
        $pattern = "/[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01]) [0-9]{2}:[0-9]{2}:[0-9]{2}/";
        if (preg_match($pattern, $newName, $matches)) {
            $newName = preg_replace($pattern, '', $newName);
            $bUpdate = true;
        }

        /*
        //vardump($matches);
        $pattern_2 = '/(?:([01]?\d|2[0-3]):([0-5]?\d):)?([0-5]?\d)/';
        if (preg_match($pattern_2, $newName, $matches)) {
            $newName = preg_replace($pattern_2, '', $newName);
            $bUpdate = true;
        }
        */

        //echo 'NAME = ' . $arFields['NAME'] . '<br />';
        if ($bUpdate) {
            $newName = trim($newName);
            if (strlen($newName) > 0) {
                $el = new CIBlockElement;
                $res_2 = $el->Update($arFields['ID'], array('NAME' => $newName));
            }
            echo 'NEW_NAME = ' . $newName . '<br />';
        }
        //echo '<br />';
    }
    // <-- Вырежем даты из названий
}
// <-- Получим список вебинаров из БД

// Удалим вебинары, которые содержат в названии стоп слова -->
//vardump($arDelWebinarsIds);
//vardump($arDelWebinarsNames);
if (!empty($arDelWebinarsNames)) {
    foreach ($arDelWebinarsNames as $elId => $ar) {
        if ($arActives[$elId] != 'N') {
            foreach ($ar as $word => $name) {
                $el = new CIBlockElement;
                $res = $el->Update($elId, array('ACTIVE' => 'N'));
                CIBlockElement::SetPropertyValuesEx($elId, false, array('STOP_WORD' => $word));
            }
        }
    }
}
// <-- Удалим вебинары, которые содержат в названии стоп слова

// Получим список вебинаров из API -->
$arVebinarsAPI = array();
$limit = 10;
$pages = 10;
$offset = 0;
$pageStart = intval($arStatus['page']);
$pageEnd = (intval($arStatus['page']) + $pages);

echo 'pageStart = ' . $pageStart . '<br />';
echo 'pageEnd = ' . $pageEnd . '<br />';

for ($i = $pageStart; $i < $pageEnd; $i++) {
    $offset = $i * $limit;
    $url = "https://userapi.webinar.ru/v3/records?from=2000-01-01&to=2125-01-01&limit=" . $limit . "&offset=" . $offset;
    echo 'url = ' . $url . '<br />';
    $process = curl_init($url);
    //curl_setopt($process, CURLOPT_POSTFIELDS, $json );
    curl_setopt($process, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($process, CURLINFO_HEADER_OUT, true);
    curl_setopt($process, CURLOPT_HTTPHEADER, [
        'x-auth-token: 60567c4e684b9059d077912929cac02d',
        'Content-Type: application/x-www-form-urlencoded'
    ]);
    $result = curl_exec($process);
    $info = curl_getinfo($process);
    curl_close($process);
    $result = json_decode($result, true);
    vardump($result);

    foreach ($result as $key => $val) {
        if (strlen($val['id']) > 0) {

            // EventsessionID -->
            $eventsessionID = '';
            $stack = explode("/", $val['link']);
            $eventsessionID = array_pop($stack);
            // <-- EventsessionID

            $arVebinarsAPI[$val['id']] = array(
                'id' => $val['id'],
                'eventsessionID' => $eventsessionID,
                'name' => $val['name'],
                'link' => $val['link'],
                'createAt' => $val['createAt'],
                'createUserName' => $val['eventSession']['createUser']['name'] . ' ' . $val['eventSession']['createUser']['secondName'],
                'createUserEmail' => $val['eventSession']['createUser']['email'],
                'page' => $i,
            );
            $arStatus['page'] = $i;
        }
    }
    //vardump($result);
}
// <-- Получим список вебинаров из API

// Загрузим вебинары в БД -->
//vardump($arVebinarsAPI);
if (!empty($arVebinarsAPI)) {
    foreach ($arVebinarsAPI as $key => $arVebinarAPI) {

        $PROPERTY_VALUES = array(
            'ID' => 'vebinar' . $arVebinarAPI['id'],
            'API_ID' => $arVebinarAPI['id'],
            'EVENTSESSION_ID' => $arVebinarAPI['eventsessionID'],
            'API_NAME' => $arVebinarAPI['name'],
            'API_LINK' => $arVebinarAPI['link'],
            'API_CREATOR_NAME' => $arVebinarAPI['createUserName'],
            'API_CREATOR_EMAIL' => $arVebinarAPI['createUserEmail'],
            'API_DATE_CREATE' => $arVebinarAPI['createAt'],
        );

        if (empty($arVebinarsDB[$arVebinarAPI['id']]) && !empty($arVebinarAPI['id'])) {

            $bAdd = true;

            // Проверка на стоп-слова -->
            $haystack = mb_strtolower($arVebinarAPI['name']);
            foreach ($arStopWords as $needle) {
                $needle = mb_strtolower($needle);
                if (strpos($haystack, $needle) !== false) {
                    $bAdd = false;
                }
            }
            // <-- Проверка на стоп-слова

            if ($bAdd == true) {
                $el = new CIBlockElement;

                $arLoadProductArray = array(
                    "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела  
                    "IBLOCK_ID"      => Indexis::getIblockId('webinars', 'content'),
                    "PROPERTY_VALUES" => $PROPERTY_VALUES,
                    "NAME"           => $arVebinarAPI['name'],
                    "ACTIVE"         => "Y",            // активен  
                );
                vardump($arLoadProductArray);
                if ($PRODUCT_ID = $el->Add($arLoadProductArray)) {
                    //echo "New ID: " . $PRODUCT_ID;
                    $arStatus['page'] = $arVebinarAPI['page'];
                } else {
                    echo "Error: " . $el->LAST_ERROR . '<br />';
                }
            }
        } else {
            $ELEMENT_ID = $arVebinarsDB[$arVebinarAPI['id']]['ELEMENT_ID'];
            $ELEMENT_NAME = $arVebinarsDB[$arVebinarAPI['id']]['NAME'];
            if (intval($ELEMENT_ID) > 0) {
                CIBlockElement::SetPropertyValuesEx($ELEMENT_ID, false, $PROPERTY_VALUES);

                if (strlen($arVebinarAPI['name']) > 0) {
                    $newName = $arVebinarAPI['name'];
                    // 2023-12-08 15:43:40
                    $pattern = "/[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01]) [0-9]{2}:[0-9]{2}:[0-9]{2}/";
                    if (preg_match($pattern, $newName, $matches)) {
                        $newName = preg_replace($pattern, '', $newName);
                        //echo 'newName = '.$newName.'<br />';
                    }
                    /*
                    echo 'newName = ' . $newName . '<br />';
                    echo 'ELEMENT_NAME = ' . $ELEMENT_NAME . '<br />';
                    echo 'ELEMENT_NAME = ' . (trim($newName) == trim($ELEMENT_NAME)) . '<br />';
                    echo '<br />';
                    */
                    if (
                        strlen($newName) > 0
                        && strlen($ELEMENT_NAME) > 0
                        && trim($newName) != trim($ELEMENT_NAME)
                    ) {
                        $el = new CIBlockElement;
                        $res_2 = $el->Update($ELEMENT_ID, array('NAME' => $newName));
                    }
                }
            }
        }
    }
}
// <-- Загрузим вебинары в БД
//die();

// Сброс статуса -->
if (empty($arVebinarsAPI)) {
    $arStatus['page'] = 0;
} else {
    if (count($arVebinarsAPI) < ($limit * $pages)) {
        $arStatus['page'] = 0;
    }
}
//echo 'count = ' . count($arVebinarsAPI) . '<br />';
//echo 'limit = ' . $limit . '<br />';
// <-- Сброс статуса

// Запишем статус -->
//echo 'statusElId = ' . $statusElId . '<br />';
if (intval($statusElId) > 0) {
    $el = new CIBlockElement;
    $arLoadProductArray = array(
        //'PREVIEW_TEXT' => json_encode($arStatus),
        'PREVIEW_TEXT' => serialize($arStatus),
    );
    $res = $el->Update($statusElId, $arLoadProductArray);

    vardump($arStatus);
}
// <-- Запишем статус
?>

<?
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");
?>