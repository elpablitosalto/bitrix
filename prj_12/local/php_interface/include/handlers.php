<?php

use Bitrix\Main\EventManager;

EventManager::getInstance()->addEventHandler("main", "OnEpilog",  ["IndexisEvents", "OnEpilogHandler"]);
EventManager::getInstance()->addEventHandler("iblock", "OnIBlockPropertyBuildList",  ["ListElementWithDescription", "GetIBlockPropertyDescription"]);
EventManager::getInstance()->addEventHandler("iblock", "OnAfterIBlockElementUpdate",  ["IndexisEvents", "ElementUpdater"]);
EventManager::getInstance()->addEventHandler("iblock", "OnAfterIBlockElementAdd",  ["IndexisEvents", "ElementUpdater"]);
EventManager::getInstance()->addEventHandler("iblock", "OnBeforeIBlockElementUpdate",  ["IndexisEvents", "PriceUpdater"]);