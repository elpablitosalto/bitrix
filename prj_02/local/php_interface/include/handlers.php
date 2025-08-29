<?php

use Bitrix\Main\EventManager;

EventManager::getInstance()->addEventHandler("iblock", "OnBeforeIBlockElementDelete", ["IndexisEvents", "OnBeforeIBlockElementDeleteHandler"]);

EventManager::getInstance()->addEventHandler("iblock", "OnAfterIBlockElementUpdate", ["IndexisEvents", "OnAfterIBlockElementUpdateHandler"]);

EventManager::getInstance()->addEventHandler("iblock", "OnAfterIBlockElementAdd", ["IndexisEvents", "OnAfterIBlockElementAddHandler"]);

EventManager::getInstance()->addEventHandler("main", "OnEpilog",  ["IndexisEvents", "OnEpilogHandler"]);

/*<?
AddEventHandler("iblock", "OnBeforeIBlockElementDelete", Array("ContactsClass", "OnBeforeIBlockElementDeleteHandler"));

class ContactsClass
{
    // Запрет удаления элемента инфоблока "Контакты" с символьным кодом "contacts"
    public static function OnBeforeIBlockElementDeleteHandler($ID)
    {   
		$arFields = CIBlockElement::GetByID($ID)->Fetch();
        if(($arFields["CODE"] == 'contacts') && ($arFields["IBLOCK_ID"] == Indexis::getIblockId("contacts", "content", "s1")))
        {
            global $APPLICATION;
            $APPLICATION->throwException('Данный элемент запрещено удалять');
            return false;
        }  
    }
}
*/