<?php

use Bitrix\Main\EventManager;

EventManager::getInstance()->addEventHandler("main", "OnEpilog",  ["IndexisEvents", "OnEpilogHandler"]);
EventManager::getInstance()->addEventHandler("main", "OnBeforeUserRegister",  ["IndexisEvents", "OnBeforeUserRegisterHandler"]);
EventManager::getInstance()->addEventHandler("main", "OnAfterUserRegister",  ["IndexisEvents", "OnAfterUserRegisterHandler"]);

//EventManager::getInstance()->addEventHandler("main", "OnBeforeUserRegister", ["IndexisEvents", "OnBeforeUserRegisterHandler"]);
