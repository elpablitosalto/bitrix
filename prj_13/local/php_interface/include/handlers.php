<?php

use Bitrix\Main\EventManager;

EventManager::getInstance()->addEventHandler("iblock", "OnAfterIBlockElementUpdate",  ["IndexisEvents", "ElementUpdater"]);
EventManager::getInstance()->addEventHandler("iblock", "OnAfterIBlockElementAdd",  ["IndexisEvents", "ElementUpdater"]);
EventManager::getInstance()->addEventHandler("sale", "OnSaleComponentOrderOneStepProcess",  ["IndexisEvents", "OnSaleComponentOrderOneStepProcessHandler"]);
EventManager::getInstance()->addEventHandler("sale", "OnSalePaymentEntitySaved",  ["IndexisEvents", "OnSalePaymentEntitySavedHandler"]);
EventManager::getInstance()->addEventHandler("search", "BeforeIndex",  ["IndexisEvents", "BeforeIndexHandler"]);
EventManager::getInstance()->addEventHandler("form", "onAfterResultAdd",  ["IndexisEvents", "onAfterResultAddHandler"]);
EventManager::getInstance()->addEventHandler("sale", "OnOrderNewSendEmail",  ["IndexisEvents", "OnOrderNewSendEmailHandler"]);

/*
EventManager::getInstance()->addEventHandler("main", "OnEpilog",  ["IndexisEvents", "OnEpilogHandler"]);
*/