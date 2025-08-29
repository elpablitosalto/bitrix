<?php
/**
 * Created by @copyright QSOFT.
 */
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Main\LoaderException;

class CatalogMindbox extends CBitrixComponent
{
    public function __construct(CBitrixComponent $component = null)
    {
        if (!$this->loadModule()) {
            return;
        }

        parent::__construct($component);

    }

    public function onPrepareComponentParams($params)
    {
        $params["OPTIONS"] = Mindbox\Options::getSDKOptions();
        $params["OPTIONS"]["PREFIX"] = Mindbox\Options::getPrefix();
        $params["LOGS_DIR"] = $_SERVER["DOCUMENT_ROOT"]."/upload/logs/";

        if(!$params["OPTIONS"]["secretKey"] || !$params["OPTIONS"]["endpointId"]  || !$params["OPTIONS"]["domain"])
            die(1);

        return $params;
    }

    public function executeComponent()
    {
        $this->includeComponentTemplate();
    }

    private function loadModule()
    {
        try {
            return Loader::includeModule('mindbox.marketing');
        } catch (LoaderException $e) {
            return false;
        }
    }
}