<?php

use Bitrix\Main\EventManager;

EventManager::getInstance()->addEventHandler("main", "OnBeforeUserRegister", ["IndexisEvents", "OnBeforeUserRegisterHandler"]);

EventManager::getInstance()->addEventHandler("socialservices", "OnUserLoginSocserv", ["IndexisEvents", "OnUserLoginSocservHandler"]);
