<?php

use Bitrix\Sale;
use Bitrix\Main\Loader;
use Bitrix\Main\Application;
use Bitrix\Main\Page\Asset;
use Bitrix\Main\Data\Cache;

define('MAFM_SITE_TEMPLATE_PATH', '/local/templates/mafmarket');


class IndexisEvents
{
    /*
    public static function OnBeforeUserRegisterHandler(&$arFields)
    {
    }
    */

    public static function OnAfterUserRegisterHandler(&$arFields)
    {
        $arEventFields = $arFields;
        CEvent::Send('NEW_USER', SITE_ID, $arEventFields, 'Y', '', $arFiles);
    }

    public static function OnBeforeUserRegisterHandler(&$args)
    {
        if (!empty($args['EMAIL'])) {
            $args['LOGIN'] = $args['EMAIL'];
        }
        return true;
    }

    public static function OnEpilogHandler()
    {
        //echo '!!!';
        // Конструктор -->
        IndexisEvents::FieldsConstuctorPages();
        // <-- Конструктор

        // Поле "Привязка к конструктору" -->
        //IndexisEvents::FieldBindToConstuctor();
        // <--
    }

    public static function FieldsConstuctorPages()
    {
        global $APPLICATION;
        global $CACHE_MANAGER;

        $context = Application::getInstance()->getContext();
        $request = $context->getRequest();
        $server = $context->getServer();
        $isIblockElementEditPage = $server->getPhpSelf() == '/bitrix/admin/iblock_element_edit.php';

        //echo 'IblockId = '.Indexis::getIblockId('pages', 'constructor').'<br />';    

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

            //echo '!!';

            $cache = Cache::createInstance();
            if ($cache->initCache($cacheTime, 'constructor_blocks', $cacheDir)) {
                $arVars = $cache->getVars();

                $arDefaultHideSelectors = $arVars['arDefaultHideSelectors'];
                $arDisplayPropertyForBlocks = $arVars['arDisplayPropertyForBlocks'];
            } elseif ($cache->startDataCache()) {
                //echo '!!';
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

            //vardump($arDefaultHideSelectors);
            //vardump($arDisplayPropertyForBlocks);

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

        //echo 'showPanelWasInvoked = '.$APPLICATION->showPanelWasInvoked.'<br />';
        //echo 'isIblockElementEditPage = '.$isIblockElementEditPage.'<br />';

        if ($APPLICATION->showPanelWasInvoked || $isIblockElementEditPage) {
            Asset::getInstance()->addJs(MAFM_SITE_TEMPLATE_PATH . "/js/admin.js");
        }
    }

    public static function FieldBindToConstuctor()
    {
        $context = Application::getInstance()->getContext();
        $request = $context->getRequest();
        $server = $context->getServer();
        $isIblockElementEditPage = $server->getPhpSelf() == '/bitrix/admin/iblock_element_edit.php';
        $cur_iblock_id = $request->get('IBLOCK_ID');
        $iblock_id = Indexis::getIblockId('content', 'content');

        if (
            $isIblockElementEditPage
            &&
            ($cur_iblock_id == $iblock_id)
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
}
