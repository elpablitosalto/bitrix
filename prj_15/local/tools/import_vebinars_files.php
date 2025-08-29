<?
if (!file_exists($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php'))
    $_SERVER['DOCUMENT_ROOT'] = '/home/t/techinm8/geropharm.techinm8.beget.tech/public_html';

require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule('iblock');

// Получим статус загрузки -->
$statusElId = 0;
$arStatus = array();
$arSelect = array("ID", "NAME", "PREVIEW_TEXT");
$arFilter = array(
    "IBLOCK_ID" => Indexis::getIblockId('statuses', 'service'),
    "ACTIVE_DATE" => "Y",
    "ACTIVE" => "Y",
    "CODE" => "import_vebinars_files"
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

// Получим список вебинаров из БД -->
$limit = 1;
//$pages = 1;
$arVebinarsDB = array();
$arSelect = array("ID", "IBLOCK_ID", "NAME", "PROPERTY_API_ID", "PROPERTY_API_LINK", "PROPERTY_EVENTSESSION_ID");
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

        $arVebinarsDB[$arFields['NAME']] = array(
            'ID' => $arFields['ID'],
            'NAME' => $arFields['NAME'],
            'IBLOCK_ID' => $arFields['IBLOCK_ID'],
            'API_ID' => $arFields['PROPERTY_API_ID_VALUE'],
            'EVENTSESSION_ID' => $eventsessionID,
            'API_LINK' => $arFields['PROPERTY_API_LINK_VALUE'],
        );
    }
}
// <-- Получим список вебинаров из БД

// Данные из файлов -->
$arFilesData = array();
$arFilesNames = array(
    'response_gotovye_zapisi_Parvina',
    'response_gotovye_zapisi_Vdala_B'
    //'response_spisok_onlajn_meroprijatij_Parvina.txt',
    //'responsespisok_onlajn_meroprijatij_Vlada.txt'
);
foreach ($arFilesNames as $fileName) {
    $file_name_full = __DIR__ . '/import_files/' . $fileName;

    $content = file_get_contents($file_name_full);

    $result = json_decode($content, true);

    //vardump($result);

    foreach ($result as $key => $val) {
        if (strlen($val['name']) > 0) {
            $arFilesData[$val['name']] = $val;
        }
    }
}
vardump($arFilesData);
// <-- Данные из файлов

// Загрузим файлы -->
if (!empty($arVebinarsDB)) {
    foreach ($arVebinarsDB as $key => $arVebinar) {
        echo 'Вебинар:<br />';
        vardump($arVebinar);
        echo '<hr />';
        echo 'empty = '.empty($arFilesData[$key]).'<br />';

        if (!empty($arFilesData[$key])) {
            $fileUrl = $val['downloadUrl'];
            echo 'URL файла = ' . $fileUrl . '<br />';

            /*
            $arFile = CFile::MakeFileArray($fileUrl);
            vardump($arFile);
            echo 'Размер файла = ' . formatSizeUnits($arFile['size']) . '<br />';

            CIBlockElement::SetPropertyValuesEx(
                $arVebinar['ID'],
                $arVebinar['IBLOCK_ID'],
                array('FILE' => $arFile)
            );
            */
        }


        $arStatus['last_id'] = $arVebinar['ID'];
    }
}
// <-- Загрузим файлы


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
    $arLoadProductArray = array(
        //'PREVIEW_TEXT' => json_encode($arStatus),
        'PREVIEW_TEXT' => serialize($arStatus),
    );
    $res = $el->Update($statusElId, $arLoadProductArray);

    vardump($arStatus);
}
// <-- Запишем статус

require_once($_SERVER["DOCUMENT_ROOT"]  . "/bitrix/modules/main/include/epilog_after.php");
