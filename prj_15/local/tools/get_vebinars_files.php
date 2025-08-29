<?
//set_time_limit(20);

/*
if (!file_exists($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php'))
    $_SERVER['DOCUMENT_ROOT'] = '/home/t/techinm8/geropharm.techinm8.beget.tech/public_html';
*/

if (strlen($_SERVER["DOCUMENT_ROOT"]) <= 0 && is_file(__DIR__ . "/document_root.php")) {
    include(__DIR__ . "/document_root.php");
}

require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule('iblock');

function formatSizeUnits($bytes)
{
    if ($bytes >= 1073741824) {
        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576) {
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024) {
        $bytes = number_format($bytes / 1024, 2) . ' KB';
    } elseif ($bytes > 1) {
        $bytes = $bytes . ' bytes';
    } elseif ($bytes == 1) {
        $bytes = $bytes . ' byte';
    } else {
        $bytes = '0 bytes';
    }

    return $bytes;
}
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
    "CODE" => "get_vebinars_files"
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
        "last_id" => 0,
        "round" => 0,
    );
}
// <-- Получим статус загрузки

// Получим ID конвертации вебинара, последнего поставленного на конвертацию -->
$arlastIdConvertStatus = array();
$arSelect = array("ID", "NAME", "PREVIEW_TEXT");
$arFilter = array(
    "IBLOCK_ID" => Indexis::getIblockId('statuses', 'service'),
    "ACTIVE_DATE" => "Y",
    "ACTIVE" => "Y",
    "CODE" => "last_id_convert"
);
$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
if ($ob = $res->GetNextElement()) {
    $arFields = $ob->GetFields();
    $arlastIdConvertStatus['ELEMENT_ID'] = $arFields['ID'];

    $str = strip_tags($arFields['PREVIEW_TEXT']);
    $str = html_entity_decode($str);

    //echo 'PREVIEW_TEXT = '.$str.'<br />';

    if (strlen($str) > 0) {
        //$arStatus = json_decode($arFields['PREVIEW_TEXT'], true);
        $arlastIdConvertStatus['STATUS'] = unserialize($str);
    }
    //vardump($arStatus);
}
if (empty($arlastIdConvertStatus['STATUS'])) {
    $arlastIdConvertStatus['STATUS'] = array(
        "ID_CONVERT" => false,
    );
}
// <--

//vardump($arStatus);

// Получим список вебинаров из БД -->
$limit = 1;
//$pages = 1;
$arVebinarsDB = array();
$arSelect = array(
    "ID", "IBLOCK_ID", "NAME",
    "PROPERTY_API_ID", "PROPERTY_API_LINK", "PROPERTY_EVENTSESSION_ID",
    "PROPERTY_API_ID_CONVERT"
);
$arFilter = array(
    "IBLOCK_ID" => Indexis::getIblockId('webinars', 'content'),
    "ACTIVE_DATE" => "Y",
    "ACTIVE" => "Y",
    'PROPERTY_FILE' => false,
    '!PROPERTY_API_ID' => false,
    '>ID' => $arStatus['last_id'],
);
//$arNavStartParams = array('nTopCount' => $limit, 'nOffset' => $arStatus['page']);
$arNavStartParams = array('nPageSize' => $limit);
$res = CIBlockElement::GetList(array('id' => 'asc'), $arFilter, false, $arNavStartParams, $arSelect);
while ($ob = $res->GetNextElement()) {
    $arFields = $ob->GetFields();
    if (strlen($arFields['PROPERTY_API_LINK_VALUE']) > 0 && strlen($arFields['PROPERTY_API_ID_VALUE']) > 0) {

        // EventsessionID -->
        $eventsessionID = $arFields['PROPERTY_EVENTSESSION_ID_VALUE'];
        if (strlen($eventsessionID) <= 0) {
            $stack = explode("/", $arFields['PROPERTY_API_LINK_VALUE']);
            $eventsessionID = array_pop($stack);
        }
        // <-- EventsessionID

        $arVebinarsDB[$arFields['PROPERTY_API_ID_VALUE']] = array(
            'ID' => $arFields['ID'],
            'IBLOCK_ID' => $arFields['IBLOCK_ID'],
            'API_ID' => $arFields['PROPERTY_API_ID_VALUE'],
            'EVENTSESSION_ID' => $eventsessionID,
            'API_LINK' => $arFields['PROPERTY_API_LINK_VALUE'],
            //'SEND_TO_CONVERT' => $arFields['PROPERTY_SEND_TO_CONVERT_VALUE'],
            'API_ID_CONVERT' => $arFields['PROPERTY_API_ID_CONVERT_VALUE'],
        );
    }
}
// <-- Получим список вебинаров из БД

// Загрузим файлы -->
if (!empty($arVebinarsDB)) {
    foreach ($arVebinarsDB as $key => $arVebinar) {
        echo 'Вебинар:<br />';
        vardump($arVebinar);
        echo '<hr />';

        // Запрос к API -->
        if (false) {
            $url = "https://userapi.webinar.ru/v3/records?from=2010-01-01&to=2119-05-01";
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
            die();
        } else if (false) {
            if (!empty($arVebinar['API_ID_CONVERT'])) {
                $url = "https://userapi.webinar.ru/v3/fileSystem/file/" . $arVebinar['API_ID_CONVERT'];
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
            }
            //die();
        } else if (false) {
            //$url = "https://userapi.webinar.ru/v3/fileSystem/files?parent=19040857";
            $url = "https://userapi.webinar.ru/v3/fileSystem/files?user=3531593&parent=19040861";
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
            die();
        } else {
            $url = "https://userapi.webinar.ru/v3/eventsessions/" . $arVebinar['EVENTSESSION_ID'] . "/converted-records";
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
        }
        // <-- Запрос к API

        echo 'Получим запись вебинара:<br />';
        echo 'url = ' . $url . '<br />';
        vardump($result);
        //vardump($info);
        //vardump($result['convertedRecords']);
        echo '<hr />';
        $bFilesPresent = false;
        if (empty($result['error']) && !empty($result)) {
            foreach ($result as $key => $val) {
                if (!empty($val['downloadUrl'])) {
                    $bFilesPresent = true;
                }
            }
        }
        //echo '$bFilesPresent = '.$bFilesPresent.'<br />';

        if ($bFilesPresent) {
            foreach ($result as $key => $val) {
                if (!empty($val['downloadUrl'])) {
                    $fileUrl = $val['downloadUrl'];
                    $arFile = CFile::MakeFileArray($fileUrl);
                    CIBlockElement::SetPropertyValuesEx(
                        $arVebinar['ID'],
                        $arVebinar['IBLOCK_ID'],
                        array('FILE' => $arFile)
                    );

                    // Вывод -->
                    vardump($arFile);
                    echo 'URL файла = ' . $fileUrl . '<br />';
                    echo 'Размер файла = ' . formatSizeUnits($arFile['size']) . '<br />';
                    // <-- Вывод
                }
            }
        } else {
            //echo '!!!';
            // Получим статус по последнему ID конвертации -->
            //$state = '';
            $bMakeQueryToConvert = true;
            if (!empty($arlastIdConvertStatus['STATUS']["ID_CONVERT"]) && strlen($arlastIdConvertStatus['STATUS']["ID_CONVERT"]) > 0) {
                $url = 'https://userapi.webinar.ru/v3/records/conversions/' . $arlastIdConvertStatus['STATUS']["ID_CONVERT"];
                $process = curl_init($url);
                //curl_setopt($process, CURLOPT_POST, 1);
                //curl_setopt($process, CURLOPT_POSTFIELDS, $json );
                curl_setopt($process, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($process, CURLINFO_HEADER_OUT, true);
                curl_setopt($process, CURLOPT_HTTPHEADER, [
                    'x-auth-token: 60567c4e684b9059d077912929cac02d',
                    'Content-Type: application/x-www-form-urlencoded'
                ]);
                //$params = array();
                //$params['quality'] = '720';
                //curl_setopt($process, CURLOPT_POSTFIELDS, http_build_query($params, '', '&'));
                $result = curl_exec($process);
                $info = curl_getinfo($process);
                curl_close($process);
                $result = json_decode($result, true);
                $state = $result['state'];

                echo 'Запросим статус по ID конвертации:<br />';
                echo '<br />';
                echo 'url = ' . $url . '<br />';
                vardump($result);
                echo '<hr />';

                $arNeedStatuses = array('waiting', 'processing');
                if (in_array($state, $arNeedStatuses)) {
                    $bMakeQueryToConvert = false;
                }
            }
            // <-- Получим статус по последнему ID конвертации

            // Поставим текущий вебинар на конвертацию -->
            if ($bMakeQueryToConvert == true) {
                $bStartConvertCurrent = true;
                // Получим статус конвертации у текущего вебинара -->
                if (!empty($arVebinar['API_ID_CONVERT'])) {
                    $url = 'https://userapi.webinar.ru/v3/records/conversions/' . $arVebinar['API_ID_CONVERT'];
                    $process = curl_init($url);
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
                    $state = $result['state'];

                    $arNeedStatuses = array('waiting', 'processing', 'completed');
                    if (in_array($state, $arNeedStatuses)) {
                        $bStartConvertCurrent = false;
                    }
                }
                // <-- Получим статус конвертации у текущего вебинара

                if ($bStartConvertCurrent == true) {
                    // Запрос к API -->
                    $url = 'https://userapi.webinar.ru/v3/eventsessions/' . $arVebinar['EVENTSESSION_ID'] . '/records/conversions';
                    $process = curl_init($url);
                    curl_setopt($process, CURLOPT_POST, 1);
                    //curl_setopt($process, CURLOPT_POSTFIELDS, $json );
                    curl_setopt($process, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($process, CURLINFO_HEADER_OUT, true);
                    curl_setopt($process, CURLOPT_HTTPHEADER, [
                        'x-auth-token: 60567c4e684b9059d077912929cac02d',
                        'Content-Type: application/x-www-form-urlencoded'
                    ]);
                    $params = array();
                    $params['quality'] = '720';
                    curl_setopt($process, CURLOPT_POSTFIELDS, http_build_query($params, '', '&'));
                    $result = curl_exec($process);
                    $info = curl_getinfo($process);
                    curl_close($process);
                    $result = json_decode($result, true);
                    $idConvert = $result['id'];

                    echo 'Поставим запись вебинара на конвертацию:<br />';
                    echo 'Параметры конвертации: ';
                    vardump($params);
                    echo '<br />';
                    echo 'url = ' . $url . '<br />';
                    vardump($result);
                    echo '<hr />';
                    // <-- Запрос к API

                    // Запишем ID конвертации (API) -->
                    if (!empty($idConvert)) {
                        $arlastIdConvertStatus['STATUS']["ID_CONVERT"] = $idConvert;
                        CIBlockElement::SetPropertyValuesEx(
                            $arVebinar['ID'],
                            false,
                            array('API_ID_CONVERT' => $idConvert)
                        );
                    } else {
                        $arlastIdConvertStatus['STATUS']["ID_CONVERT"] = false;
                    }
                    // <-- Запишем ID конвертации (API)
                } else {
                    $arlastIdConvertStatus['STATUS']["ID_CONVERT"] = false;
                }
            } else {
                if (!empty($arlastIdConvertStatus['STATUS']["ID_CONVERT"])) {
                    echo 'В очереди уже есть запись вебинара на конвертацию. ID конвертации = ' . $arlastIdConvertStatus['STATUS']["ID_CONVERT"];
                } else {
                    $arlastIdConvertStatus['STATUS']["ID_CONVERT"] = false;
                }
            }
            // <-- Поставим текущий вебинар на конвертацию
        }
        $arStatus['last_id'] = $arVebinar['ID'];

        //vardump($arVebinar);
    }
}
// <-- 

//vardump($arStatus);
//vardump($arVebinarsDB);

// Сброс статуса -->
if (empty($arVebinarsDB)) {
    $arStatus['page'] = 0;
    $arStatus['last_id'] = 0;
    $arStatus['round'] = intval($arStatus['round'] + 1);
}
// <-- Сброс статуса

// Запишем статус -->
//echo 'statusElId = ' . $statusElId . '<br />';
if (intval($statusElId) > 0) {
    $el = new CIBlockElement;
    //vardump($arStatus);
    $arLoadProductArray = array(
        'PREVIEW_TEXT' => serialize($arStatus),
    );
    $res = $el->Update($statusElId, $arLoadProductArray);

    //vardump($arStatus);
}
// <-- Запишем статус

// Запишем последний ID конвертации -->
//echo 'statusElId = ' . $statusElId . '<br />';
if (intval($arlastIdConvertStatus['ELEMENT_ID']) > 0) {
    $el = new CIBlockElement;
    $arLoadProductArray = array(
        'PREVIEW_TEXT' => serialize($arlastIdConvertStatus['STATUS']),
    );
    $res = $el->Update($arlastIdConvertStatus['ELEMENT_ID'], $arLoadProductArray);

    //vardump($arlastIdConvertStatus['STATUS']);
}
// <-- Запишем последний ID конвертации
?>

<?
require_once($_SERVER["DOCUMENT_ROOT"]  . "/bitrix/modules/main/include/epilog_after.php");
?>