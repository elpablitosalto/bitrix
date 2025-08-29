<?
use Bitrix\Main\EventManager;


// Обработчики событий
EventManager::getInstance()->addEventHandler("main", "OnEpilog",  ["\Mirvendinga\Events", "OnEpilogHandler"]);

EventManager::getInstance()->addEventHandler("catalog", "OnSuccessCatalogImport1C",  ["\Mirvendinga\Events", "OnSuccessCatalogImport1C"]);

/*AddEventHandler('search', 'BeforeIndex', ["\Mirvendinga\Events", "beforeIndexHandler"]);
AddEventHandler('iblock', 'OnBeforeIBlockSectionDelete', ["\Mirvendinga\Events", "servicesSectionDeleteProtect"]);
AddEventHandler('iblock', 'OnBeforeIBlockSectionUpdate', ["\Mirvendinga\Events", "servicesSectionUpdateProtect"]);
AddEventHandler('iblock', 'OnBeforeIBlockElementUpdate', ["\Mirvendinga\Events", "servicesUpdateProtect"]);
AddEventHandler('iblock', 'OnBeforeIBlockElementDelete', ["\Mirvendinga\Events", "servicesDeleteProtect"]);*/