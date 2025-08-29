<?php

use Bitrix\Main\EventManager;

EventManager::getInstance()->addEventHandler("main", "OnEndBufferContent",  ["IndexisEvents", "OnEndBufferContentHandler"]);
EventManager::getInstance()->addEventHandler("iblock", "OnAfterIBlockElementUpdate",  ["IndexisEvents", "OnAfterGuideChangeHandler"]);
EventManager::getInstance()->addEventHandler("iblock", "OnAfterIBlockElementAdd",  ["IndexisEvents", "OnAfterGuideChangeHandler"]);
EventManager::getInstance()->addEventHandler("iblock", "OnAfterIBlockElementAdd",  ["IndexisEvents", "OnAfterParticipantsChangeHandler"]);
EventManager::getInstance()->addEventHandler("iblock", "OnAfterIBlockElementUpdate",  ["IndexisEvents", "OnAfterParticipantsChangeUpdateHandler"]);
EventManager::getInstance()->addEventHandler("iblock", "OnBeforeIBlockElementUpdate",  ["IndexisEvents", "OnBeforeParticipantsChangeHandler"]);