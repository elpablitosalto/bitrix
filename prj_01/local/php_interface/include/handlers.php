<?php

use Bitrix\Main\EventManager;

EventManager::getInstance()->addEventHandler("main", "OnBeforeEventAdd", ["IndexisEvents", "OnBeforeEventAddHandler"]);
EventManager::getInstance()->addEventHandler("main", "OnBeforeUserRegister",  ["IndexisEvents", "OnBeforeUserRegisterHandler"]);
EventManager::getInstance()->addEventHandler("main", "OnAfterUserRegister",  ["IndexisEvents", "OnAfterUserRegisterHandler"]);
EventManager::getInstance()->addEventHandler("main", "OnAfterUserAdd",  ["IndexisEvents", "OnAfterUserAddHandler"]);
EventManager::getInstance()->addEventHandler("main", "OnAfterUserUpdate",  ["IndexisEvents", "OnAfterUserUpdateHandler"]);
EventManager::getInstance()->addEventHandler("main", "OnBeforeUserUpdate",  ["IndexisEvents", "OnBeforeUserUpdateHandler"]);

EventManager::getInstance()->addEventHandlerCompatible('form', 'onFormValidatorBuildList', [
	'Disweb\FormValidatorPhone',
	'getDescription',
]);