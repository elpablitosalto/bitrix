<?
$eventManager = \Bitrix\Main\EventManager::getInstance();

AddEventHandler('main', 'OnEpilog', '_Check404Error', 1);
function _Check404Error()
{
    if (defined('ERROR_404') && ERROR_404 == 'Y' || CHTTP::GetLastStatus() == "404 Not Found") {
        global $APPLICATION;
        $APPLICATION->RestartBuffer();
        require $_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/header.php';
        require $_SERVER['DOCUMENT_ROOT'] . '/404.php';
        require $_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/footer.php';
    }
}

/*AddEventHandler("main", "OnEpilog", "Redirect404");
function Redirect404() {
    global $APPLICATION;
    if(defined("ERROR_404") && $APPLICATION->GetCurPage() != '/404.php') {
        LocalRedirect("/404.php", "404 Not Found");
    }
}*/

// 41593 - ТЗ функционала замены заголовков для геолокации
$eventManager->addEventHandler(
    'main',
    'OnEndBufferContent',
    ['\Hair\GeoTemplates', 'replaceTemplates'],
    false,
    10000
);

/* Почтовое уведомление о неудачном бэкапе */
AddEventHandler('main', 'OnAutoBackupError', 'OnAutoBackupError');
AddEventHandler('main', 'OnAutoBackupUnknownError', 'OnAutoBackupError');

function OnAutoBackupError($error)
{
    $arEventFields = array(
        "DATE_CREATE" => date("d.m.Y H:i:s"),
        "ERROR" => $error['ERROR'],
        "ERROR_CODE" => $error['ERROR_CODE'],
        "ITEM_ID" => $error['ITEM_ID'],
    );

    //создаем почтовое событие
    CEvent::Send("BACKUP_UNKNOWN_ERROR", SITE_ID, $arEventFields);
}