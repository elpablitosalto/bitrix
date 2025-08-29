<?php

use Bitrix\Sale;
use Bitrix\Main\Loader;
use Bitrix\Main\Application;
use Bitrix\Main\Page\Asset;
use Bitrix\Main\Data\Cache;

Loader::includeModule('iblock');
define('RTH_SITE_TEMPLATE_PATH', '/local/templates/roadtohome');

class IndexisEvents
{
    // ������ �������� ��������� ��������� ���������� 
    public static function OnBeforeIBlockElementDeleteHandler($ID)
    {
        $arElements = [
            Indexis::getIblockId("contacts", "content", "s1") => [
                'contacts' => true
            ],

            Indexis::getIblockId("requisites", "content", "s1") => [
                'requisites' => true
            ],
        ];
        $arFields = CIBlockElement::GetByID($ID)->Fetch();
        if (isset($arElements[$arFields["IBLOCK_ID"]][$arFields["CODE"]])) {
            //AddMessage2Log(print_r($arFields,true), "contacts");
            global $APPLICATION;
            $APPLICATION->throwException('������ ������� ��������� �������');
            return false;
        }
    }

    // создаем обработчик события "OnAfterIBlockElementUpdate"
    public static function OnAfterIBlockElementUpdateHandler(&$arFields)
    {
        IndexisEvents::SetPublicDate($arFields);
        IndexisEvents::SetSearchTextForDocs($arFields);
    }

    // создаем обработчик события "OnAfterIBlockElementAdd"
    public static function OnAfterIBlockElementAddHandler(&$arFields)
    {
        IndexisEvents::SetPublicDate($arFields);
        IndexisEvents::SetSearchTextForDocs($arFields);
    }

    public static function SetSearchTextForDocs(&$arFields)
    {
        if (intval($arFields["IBLOCK_ID"]) > 0 && intval($arFields["ID"]) > 0) {
            if (
                $arFields["IBLOCK_ID"] == Indexis::getIblockId("documents")
            ) {
                $arSelect = false;
                $arFilter = array("ID" => $arFields["ID"]);
                $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
                if ($ob = $res->GetNextElement()) {
                    $arCurElement = $ob->GetFields();
                    $arCurElement["PROPERTIES"] = $ob->GetProperties();

                    $s = "";
                    //vardump($arCurElement["PROPERTIES"]["FILE"]);
                    foreach ($arCurElement["PROPERTIES"]["FILE"]["VALUE"] as $key => $val) {
                        $ar_file = CFile::GetFileArray($val);
                        $s .= " " . $ar_file["ORIGINAL_NAME"];
                        $s .= " " . $ar_file["DESCRIPTION"];
                        //vardump($ar_file);
                    }
                    //die();

                    /* */
                    CIBlockElement::SetPropertyValuesEx(
                        $arFields["ID"],
                        $arFields["IBLOCK_ID"],
                        array("TEXT_FOR_SEARCH" => array("TEXT" => $s))
                    );
                    /**/
                }
            }
        }
    }

    public static function SetPublicDate(&$arFields)
    {
        if (intval($arFields["IBLOCK_ID"]) > 0 && intval($arFields["ID"]) > 0) {
            if (
                $arFields["IBLOCK_ID"] == Indexis::getIblockId("news")
                || $arFields["IBLOCK_ID"] == Indexis::getIblockId("materials")
            ) {
                $arSelect = false;
                $arFilter = array("ID" => $arFields["ID"]);
                $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
                if ($ob = $res->GetNextElement()) {
                    $arCurElement = $ob->GetFields();
                    //$arCurElement["PROPERTIES"] = $ob->GetProperties();

                    CIBlockElement::SetPropertyValuesEx(
                        $arFields["ID"],
                        $arFields["IBLOCK_ID"],
                        array("PUBLIC_DATE" => $arCurElement["ACTIVE_FROM"])
                    );
                }
            }
        }
    }

    public static function OnEpilogHandler()
    {
        // Конструктор -->
        IndexisEvents::FieldsConstuctorPages();
        // <-- Конструктор

        // Поле "Привязка к конструктору" -->
        IndexisEvents::FieldBindToConstuctor();
        // <--
    }

    public static function FieldBindToConstuctor()
    {
        $context = Application::getInstance()->getContext();
        $request = $context->getRequest();
        $server = $context->getServer();
        $isIblockElementEditPage = $server->getPhpSelf() == '/bitrix/admin/iblock_element_edit.php';
        $cur_iblock_id = $request->get('IBLOCK_ID');
        $news_iblock_id = Indexis::getIblockId('news', 'content');
        $materials_iblock_id = Indexis::getIblockId('materials', 'content');

        if (
            $isIblockElementEditPage
            &&
            ($cur_iblock_id == $news_iblock_id || $cur_iblock_id == $materials_iblock_id)
        ) {
            $prop_id = 208;
            if ($cur_iblock_id == $news_iblock_id) {
                $prop_id = 191;
            }

            $jsCode = "<script>
            $(document).ready(function() {
                $('select[name=\"PROP[" . $prop_id . "][]\"] option').each(function(){
                    $(this).html( '[' + $(this).attr('value') + '] ' + this.text );
                });

                $('select[name=\"PROP[" . $prop_id . "][]\"]').select2({
                    placeholder: 'Выберите привязку к конструктору',
                    maximumSelectionLength: 2,
                    language: 'ru'
                });
                //$('input[select=\"PROP[" . $prop_id . "][]\"]').css('display', 'none');
            });
            </script>";
            Asset::getInstance()->addString($jsCode);

            /*
            $cssStyles = '<style>';
            //$cssStyles .= implode(",", $arDefaultHideSelectors);
            $cssStyles .= 'select[name="PROP['.$prop_id.'][]"]{ display: none; }';
            $cssStyles .= '</style>';
            Asset::getInstance()->addString($cssStyles);
            */

            //Asset::getInstance()->addCss(RTH_SITE_TEMPLATE_PATH . "/libs/select2/4.1.0/dist/css/select2.min.css");
            Asset::getInstance()->addString('<link rel="stylesheet" href="' . RTH_SITE_TEMPLATE_PATH . "/libs/select2/4.1.0/dist/css/select2.min.css" . '">');

            CJSCore::Init(array("jquery"));
            Asset::getInstance()->addJs(RTH_SITE_TEMPLATE_PATH . "/libs/select2/4.1.0/dist/js/select2.min.js");
            Asset::getInstance()->addJs(RTH_SITE_TEMPLATE_PATH . "/libs/select2/4.1.0/dist/js/i18n/ru.js");
        }
    }

    public static function FieldsConstuctorPages()
    {
        global $APPLICATION;
        global $CACHE_MANAGER;

        $context = Application::getInstance()->getContext();
        $request = $context->getRequest();
        $server = $context->getServer();
        $isIblockElementEditPage = $server->getPhpSelf() == '/bitrix/admin/iblock_element_edit.php';


        if (
            $isIblockElementEditPage
            && $request->get('IBLOCK_ID') == Indexis::getIblockId('pages', 'constructor')
        ) {
            $arDefaultShowPropCodes = [
                'BLOCK_ID',
            ];
            $arDefaultHideSelectors = [];
            $arDisplayPropertyForBlocks = [];
            $arAvailableBlockCodes = [];
            $arNotDisplayPropertyIdsForBlocks = [];

            $cacheDir = '/';
            $cacheTime = 86400 * 7;

            $cache = Cache::createInstance();
            if ($cache->initCache($cacheTime, 'constructor_blocks', $cacheDir)) {
                $arVars = $cache->getVars();

                $arDefaultHideSelectors = $arVars['arDefaultHideSelectors'];
                $arDisplayPropertyForBlocks = $arVars['arDisplayPropertyForBlocks'];
            } elseif ($cache->startDataCache()) {
                $CACHE_MANAGER->StartTagCache($cacheDir);
                $constructorIblockId = Indexis::getIblockId('blocks', 'constructor');

                $res = CIBlockElement::GetList(['SORT' => 'ASC'], [
                    'IBLOCK_ID' => $constructorIblockId,
                    'ACTIVE_DATE' => 'Y',
                    'ACTIVE' => 'Y',
                ], false, false, [
                    'ID',
                    'CODE'
                ]);

                while ($ob = $res->GetNextElement()) {
                    $arFields = $ob->GetFields();
                    $arAvailableBlockCodes[toUpper(trim($arFields['CODE']))] = $arFields['ID'];
                }

                // Массив ID свойств, входящих в составные -->
                $res = CIBlock::GetProperties(Indexis::getIblockId('pages', 'constructor'), ['NAME' => 'DESC'], ['ACTIVE' => 'Y']);
                while ($arProperty = $res->Fetch()) {
                    if ($arProperty['USER_TYPE'] == 'simai_complex' && is_array($arProperty['USER_TYPE_SETTINGS']['SUBPROPS'])) {
                        foreach ($arProperty['USER_TYPE_SETTINGS']['SUBPROPS'] as $propertyId) {
                            $arNotDisplayPropertyIdsForBlocks[] = $propertyId;
                        }
                    }
                }
                // <-- Массив ID свойств, входящих в составные 

                $res = CIBlock::GetProperties(Indexis::getIblockId('pages', 'constructor'), ['NAME' => 'DESC'], ['ACTIVE' => 'Y']);
                while ($arProperty = $res->Fetch()) {
                    if (is_array($arDefaultShowPropCodes)) {
                        if (in_array($arProperty['CODE'], $arDefaultShowPropCodes))
                            continue;
                    }

                    $arDefaultHideSelectors[] = '#tr_PROPERTY_' . $arProperty['ID'] . ':not(.show-property-row)';

                    // Не показывать свойства, входящие в составные    
                    if (is_array($arNotDisplayPropertyIdsForBlocks)) {
                        if (in_array($arProperty['ID'], $arNotDisplayPropertyIdsForBlocks)) {
                            //echo "id = ".$arProperty['ID']."<br />"; 
                            continue;
                        }
                    }

                    $blockCode = implode('_', array_slice(explode('_', $arProperty['CODE']), 0, 2));
                    //echo "blockCode = ".$blockCode."<br />";
                    $arDisplayPropertyForBlocks[$arAvailableBlockCodes[$blockCode]][] = $arProperty['ID'];

                    if ($arProperty['USER_TYPE'] == 'simai_complex' && is_array($arProperty['USER_TYPE_SETTINGS']['SUBPROPS'])) {
                        //echo "SUBPROPS:";echo "<pre>";print_r($arProperty['USER_TYPE_SETTINGS']['SUBPROPS']);echo "</pre>";
                        foreach ($arProperty['USER_TYPE_SETTINGS']['SUBPROPS'] as $propertyId) {
                            $propertyIndex = array_search($propertyId, $arDisplayPropertyForBlocks[$arAvailableBlockCodes[$blockCode]]);
                            //echo "propertyIndex = ".$propertyIndex."<br />";
                            if ($propertyIndex !== false) {
                                unset($arDisplayPropertyForBlocks[$arAvailableBlockCodes[$blockCode]][$propertyIndex]);
                            }
                        }

                        sort($arDisplayPropertyForBlocks[$arAvailableBlockCodes[$blockCode]]);
                    }
                }

                //vardump($arDisplayPropertyForBlocks);

                $CACHE_MANAGER->RegisterTag('iblock_id_' . $constructorIblockId);
                $CACHE_MANAGER->EndTagCache();

                $cache->endDataCache([
                    'arDefaultHideSelectors' => $arDefaultHideSelectors,
                    'arDisplayPropertyForBlocks' => $arDisplayPropertyForBlocks,
                ]);
            }

            if (is_array($arDefaultHideSelectors)) {
                if (count($arDefaultHideSelectors) > 0) {
                    $cssStyles = '<style>';
                    $cssStyles .= implode(",", $arDefaultHideSelectors);
                    $cssStyles .= '{ display: none; }';
                    $cssStyles .= '</style>';
                    Asset::getInstance()->addString($cssStyles);
                }
            }

            if (is_array($arDisplayPropertyForBlocks)) {
                if (count($arDisplayPropertyForBlocks) > 0) {
                    Asset::getInstance()->addString('<script>window.pageConstructorPropertyRelation = ' . json_encode($arDisplayPropertyForBlocks) . '; if (typeof initPageConstructor == "function") initPageConstructor();</script>');
                }
            }
        }

        if ($APPLICATION->showPanelWasInvoked || $isIblockElementEditPage) {
            Asset::getInstance()->addJs(RTH_SITE_TEMPLATE_PATH . "/js/admin.js");
        }
    }
}
