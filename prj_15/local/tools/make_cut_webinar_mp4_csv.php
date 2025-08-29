<?
if (strlen($_SERVER["DOCUMENT_ROOT"]) <= 0 && is_file(__DIR__ . "/document_root.php")) {
    include(__DIR__ . "/document_root.php");
}

require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule('iblock');

// Получим список вебинаров из БД -->
$arVebinarsDB = array();
$arSelect = array(
    "ID", "IBLOCK_ID", "NAME",
    "PROPERTY_FILE",
    /*
    "PROPERTY_API_LINK", 
    "PROPERTY_EVENTSESSION_ID",
    "PROPERTY_API_ID_CONVERT"
    */
);
$arFilter = array(
    "IBLOCK_ID" => Indexis::getIblockId('webinars', 'content'),
    "ACTIVE_DATE" => "Y",
    "ACTIVE" => "Y",
    '!PROPERTY_FILE' => false,
    'PROPERTY_FILE_SHORT' => false,
);
//$arNavStartParams = array('nTopCount' => $limit, 'nOffset' => $arStatus['page']);
//$arNavStartParams = array('nPageSize' => $limit);
$arNavStartParams = false;
$res = CIBlockElement::GetList(array('id' => 'asc'), $arFilter, false, $arNavStartParams, $arSelect);
while ($ob = $res->GetNextElement()) {
    $arFields = $ob->GetFields();
    if (intval($arFields['PROPERTY_FILE_VALUE']) > 0 && intval($arFields['PROPERTY_FILE_SHORT_VALUE']) <= 0) {

        $arFile = CFile::GetFileArray($arFields["PROPERTY_FILE_VALUE"]);
        $sourceFullPath = $_SERVER["DOCUMENT_ROOT"] . $arFile["SRC"];

        $info = pathinfo($sourceFullPath);
        $destFullPath = /*$_SERVER["DOCUMENT_ROOT"] . */ $info['dirname'] . '/' . $info['filename'] . '_short' . '.' . $info['extension'];

        if (file_exists($destFullPath)) {
            $arFileDest = CFile::MakeFileArray($destFullPath);
            $res_2 = CIBlockElement::SetPropertyValueCode($arFields['ID'], "FILE_SHORT", $arFileDest);
            if ($res_2 === true) {
                $db_props = CIBlockElement::GetProperty(
                    $arFields['IBLOCK_ID'],
                    $arFields['ID'],
                    array("sort" => "asc"),
                    array("CODE" => "FILE_SHORT")
                );
                if ($ar_props = $db_props->Fetch()) {
                    $arFileTmp = CFile::GetFileArray($ar_props["VALUE"]);
                    $pathTmp = $_SERVER["DOCUMENT_ROOT"] . $arFileTmp["SRC"];
                    if (file_exists($pathTmp)) {
                        unlink($destFullPath);
                    }
                }
            }
        } else {
            $arVebinarsDB[$arFields['ID']] = array(
                'SOURCE_FULL_PATH' => $sourceFullPath,
                'DEST_FULL_PATH' => $destFullPath,
            );
        }
    }
}
// <-- Получим список вебинаров из БД

// Составим CSV -->
if (!empty($arVebinarsDB)) {
    $start = "0";
    $end = "30";
    $arCSV = array();
    foreach ($arVebinarsDB as $idEl => $arEl) {
        $arCSV[] = array(
            $arEl['SOURCE_FULL_PATH'],
            $start,
            $end,
            $arEl['DEST_FULL_PATH'],
        );
    }
    if (!empty($arCSV)) {
        $filename = $_SERVER["DOCUMENT_ROOT"] . '/upload/files_convert.csv';
        $fp = fopen($filename, 'w');
        if ($fp !== false) {
            foreach ($arCSV as $fields) {
                if (is_array($fields)) {
                    fputcsv($fp, $fields, '@', '"');
                    //fputcsv($fp, $fields, '@');
                    //$new_str = implode('@', $fields);
                    //file_put_contents($filename, PHP_EOL . $new_str, FILE_APPEND);
                }
            }
            fclose($fp);
        }
    }
}
// <-- Составим CSV

// Пометим вебинары, у которых есть тизер -->
// <-- Пометим вебинары, у которых есть тизер