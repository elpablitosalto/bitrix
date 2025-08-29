<?php

namespace Waim\Components;

use Bitrix\Main\Error;
use Bitrix\Main\Errorable;
use Bitrix\Main\ErrorCollection;
use Bitrix\Main\Loader;
use CBitrixComponent;

class OurEventsComponent extends CBitrixComponent implements Errorable
{
    protected ErrorCollection $errorCollection;

    public function onPrepareComponentParams($arParams)
    {
        $this->_checkModules();
        if(empty($arParams["IBLOCK_ID"])){
            $rsIblock = \Bitrix\Iblock\IblockTable::getList([
                "filter" => [
                    "CODE" => "our_events"
                ]
            ]);
            if($arIBlock = $rsIblock->fetch()){
                $this->arParams["IBLOCK_ID"] = $arIBlock["ID"];
            }
            else{
                throw new \Exception("Не найден инфоблок!");
            }
        }else{
            $this->arParams["IBLOCK_ID"] = intval($arParams["IBLOCK_ID"]);
        }
        if(empty($arParams["CACHE_TIME"])){
            $this->arParams["CACHE_TIME"] = 3600;
        }
        $this->errorCollection = new ErrorCollection();
        return $arParams;
    }

    public function executeComponent()
    {
        if ($this->StartResultCache())
        {
            $arEvents = $this->_getEvents();
            if(!empty($this->request->get("our_event_id")))
            {
                $this->arResult["CURRENT_EVENT_ID"] = intval($this->request->get("our_event_id"));
            }else{
                $this->arResult["CURRENT_EVENT_ID"] = key($arEvents);
            }
            $this->arResult["EVENTS"] = $arEvents;
            $this->includeComponentTemplate();
        }
    }

    public function getErrors(): array
    {
        return $this->errorCollection->toArray();
    }

    public function getErrorByCode($code): Error
    {
        return $this->errorCollection->getErrorByCode($code);
    }

    private function _getEvents() : array
    {
        $arResult = [];
        $iblockEntityClass = \Bitrix\Iblock\Iblock::wakeUp($this->arParams["IBLOCK_ID"])->getEntityDataClass();
        $rsEvents = $iblockEntityClass::getList([
            'select' => ['ID', 'NAME', 'CODE', 'SORT', 'ACTIVE_FROM', 'DATE_CREATE', 'GALLERY_' => 'GALLERY'],
            'filter' => [
                "ACTIVE" => "Y",
                "!GALLERY.VALUE" => false
            ],
            'order' => ["ACTIVE_FROM" => "ASC", "SORT" => "ASC"]
        ]);
        while ($arEvent = $rsEvents->fetch()){
            if(empty($arResult[$arEvent["ID"]]))
            {
                $arResult[$arEvent["ID"]] = [
                    "ID" => $arEvent["ID"],
                    "CODE" => $arEvent["CODE"],
                    "ACTIVE_FROM" => $arEvent["ACTIVE_FROM"],
                    "DATE_CREATE" => $arEvent["DATE_CREATE"],
                    "NAME" => $arEvent["NAME"]
                ];
            }
            $arResult[$arEvent["ID"]]["GALLERY"][] = \CFile::GetFileArray(intval($arEvent["GALLERY_VALUE"]));
        }
        return $arResult;
    }

    private function _checkModules() : bool
    {
        $arModules = ['iblock'];
        foreach ($arModules as $module){
            if(!Loader::includeModule($module))
            {
                throw new \Exception("Не установлен модуль:". $module);
            }
        }
        return true;
    }
}