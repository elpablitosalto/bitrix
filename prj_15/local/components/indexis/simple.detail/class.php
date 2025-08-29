<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main,
    \Bitrix\Main\Loader;

class SimpleDetail extends CBitrixComponent
{

    public function onPrepareComponentParams($arParams)
    {
        if(!isset($arParams["CACHE_TIME"]))
            $arParams["CACHE_TIME"] = 60*60*24;

        return $arParams;
    }

    public function executeComponent()
    {
        Loader::includeModule('iblock');

        $this->arResult = [];
        $arFilter = array("IBLOCK_ID" => $this->arParams["IBLOCK_ID"], "=CODE" => $this->arParams["CODE"]);
        $res = CIBlockElement::GetList(array(), $arFilter, false, array("nPageSize" => 1), []);
        if ($ob = $res->GetNextElement()) {
            $this->arResult = $ob->GetFields();
            $this->arResult["PROPERTIES"] = $ob->GetProperties();

            $arButtons = CIBlock::GetPanelButtons(
                $this->arParams["IBLOCK_ID"],
                $this->arResult["ID"],
                0,
                array("SECTION_BUTTONS"=>false, "SESSID"=>false)
            );
            $this->arResult["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
            $this->arResult["DELETE_LINK"] = $arButtons["edit"]["delete_element"]["ACTION_URL"];
        }

        $this->includeComponentTemplate();

    }
}

;
