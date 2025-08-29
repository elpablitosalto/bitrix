<?php
use Bitrix\Sale;
use Bitrix\Main\Loader;
use Bitrix\Main\Application;
use Bitrix\Main\Page\Asset;

Loader::includeModule('iblock');

class IndexisEvents
{
    /*
     * Не даем деактивировать элементы цен, которые отсутствуют в файле выгрузке, но при этом были добавлены вручную через сайт
     */
    function PriceUpdater(&$arFields)
    {
        if (
            $arFields['IBLOCK_ID'] == Indexis::getIblockId('pricelist', 'services')
            && $_SERVER['SCRIPT_NAME'] == '/bitrix/admin/kda_import_excel.php'
            && $arFields['ACTIVE'] == 'N'
        ) {
            $dbProps = CIBlockElement::GetProperty($arFields['IBLOCK_ID'], $arFields['ID'], array("sort" => "asc"), Array("CODE"=>"PRICE_FROM_SITE"));
            if ($arProp = $dbProps->Fetch()) {
                if ($arProp['VALUE_XML_ID'] == 'Y')
                    $arFields['ACTIVE'] = 'Y';
            }
        }
    }

    function ElementUpdater($arFields)
    {
        if (
            $arFields['IBLOCK_ID'] == Indexis::getIblockId('our_doctors', 'our_doctors')
            || $arFields['IBLOCK_ID'] == Indexis::getIblockId('reviews', 'our_doctors')
            || $arFields['IBLOCK_ID'] == Indexis::getIblockId('promotions', 'services')
        ) {
            $arSpecializationIds = [];
            $res = CIBlockElement::GetProperty($arFields['IBLOCK_ID'], $arFields['ID'], "sort", "asc", array("CODE" => "SHOW_SERVICES"));
            while ($arService = $res->GetNext()) {
                $nav = CIBlockSection::GetNavChain(Indexis::getIblockId('services', 'services'), $arService['VALUE']);
                if ($arSpecialization = $nav->GetNext()) {
                    $arSpecializationIds[] = $arSpecialization['ID'];
                }
            }

            CIBlockElement::SetPropertyValuesEx($arFields['ID'], $arFields['IBLOCK_ID'], array('FILTER_SERVICES' => (count($arSpecializationIds) > 0 ? $arSpecializationIds : false)));
        }

        if ($arFields['IBLOCK_ID'] == Indexis::getIblockId('pages', 'constructor')) {

            $arPricesInput = [];
            $arPricesOutput = [];
            $arPricesToSave = [];

            $res = CIBlockElement::GetProperty($arFields['IBLOCK_ID'], $arFields['ID'], "sort", "asc", array("CODE" => "S_2"));
            while ($arItem = $res->GetNext())
            {
                if (empty($arItem['VALUE']))
                    continue;

                $arDescription = unserialize($arItem["~DESCRIPTION"]);
                $currentDescription = isset($arDescription[1]) ? trim($arDescription[1]) : '';
                $currentSort = isset($arDescription[2]) ? intval(trim($arDescription[2])) : 100;

                $arPricesInput[] = [
                    'VALUE' => $arItem['VALUE'],
                    'DESCRIPTION' => $currentDescription,
                    'SORT' => $currentSort
                ];
            }

            if (count($arPricesInput) > 0) {
                usort($arPricesInput, function ($a, $b) {
                    if ($a['SORT'] == $b['SORT'])
                        return 0;

                    return ($a['SORT'] < $b['SORT']) ? -1 : 1;
                });

                $currentAccordeonText = false;
                foreach ($arPricesInput as $arPrice) {
                    if ($arPrice['DESCRIPTION'] != $currentAccordeonText && mb_strlen($arPrice['DESCRIPTION']) > 0 || $currentAccordeonText === false)
                        $currentAccordeonText = $arPrice['DESCRIPTION'];

                    $arPricesOutput[$currentAccordeonText][] = $arPrice;
                }
            }

            if (count($arPricesOutput) > 0) {
                foreach ($arPricesOutput as $currentDescription => $arPriceSection) {
                    foreach ($arPriceSection as $index => $arPrice) {
                        $arPriceDesc = ($index == 0) ? [1 => $currentDescription] : [1 => ""];
                        $arPriceDesc[2] = $arPrice['SORT'];

                        $arPricesToSave[] = [
                            'VALUE' => $arPrice['VALUE'],
                            'DESCRIPTION' => $arPriceDesc,
                        ];
                    }
                }

                CIBlockElement::SetPropertyValuesEx($arFields['ID'], $arFields['IBLOCK_ID'], array('S_2' => $arPricesToSave));
            }
        }
    }

    function OnEpilogHandler()
    {
        global $APPLICATION;

        $context = Application::getInstance()->getContext();
        $request = $context->getRequest();
        $server = $context->getServer();
        $isIblockElementEditPage = $server->getPhpSelf() == '/bitrix/admin/iblock_element_edit.php';
        $isIblockSectionEditPage = $server->getPhpSelf() == '/bitrix/admin/iblock_section_edit.php';

        if (
            $isIblockSectionEditPage
            && $request->get('IBLOCK_ID') == Indexis::getIblockId('services', 'services')
        ) {
            $rsSect = CIBlockSection::GetList(
                ['ID' => 'ASC'],
                ['IBLOCK_ID' => $request->get('IBLOCK_ID'), 'ID' => $request->get('ID')],
                false,
                ['ID', 'SECTION_PAGE_URL']
            );

            if ($arSect = $rsSect->GetNext()) {
                Asset::getInstance()->addString('
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            var $targetField = document.querySelector(".adm-detail-toolbar-right");
                            if ($targetField) {
                                var $sectionPageLink = document.createElement("a");
                                var $linkText = document.createTextNode("Открыть раздел на сайте");
                                $sectionPageLink.appendChild($linkText);
                                $sectionPageLink.className = "adm-btn";
                                $sectionPageLink.setAttribute("href", "'.$arSect['SECTION_PAGE_URL'].'");
                                $sectionPageLink.setAttribute("target", "_blank");
                                $targetField.appendChild($sectionPageLink);
                            }
                        });
                    </script>
                ');
            }
        }

        if (
            $isIblockElementEditPage
            && $request->get('IBLOCK_ID') == Indexis::getIblockId('pages', 'constructor')
        ) {
            $arDefaultShowPropCodes = [
                'BLOCK_ID',
                'NAME_ANCHOR_DESKTOP',
                'NAME_ANCHOR_MOBILE',
                'SHOW_ANCHOR',
                'H_FST_PART_D',
                'H_SEC_PART_D',
                'H_THD_PART_D',
                'H_FST_PART_M',
                'H_SEC_PART_M',
                'H_THD_PART_M',
                'HIDE_BLOCK_TITLE'
            ];
            $arDefaultHideSelectors = [];
            $arDisplayPropertyForBlocks = [];
            $arAvailableBlockCodes = [];
            $arAvailableBlockSettings = [];
            $arNotDisplayPropertyIdsForBlocks = [];
            $arComplexItemCounts = [];

            $constructorIblockId = Indexis::getIblockId('blocks', 'constructor');

            $res = CIBlockElement::GetList(['SORT' => 'ASC'], [
                'IBLOCK_ID' => $constructorIblockId,
                'ACTIVE_DATE' => 'Y',
                'ACTIVE' => 'Y',
            ], false, false, [
                'ID',
                'CODE',
                'PROPERTY_SETTINGS'
            ]);

            while ($ob = $res->GetNextElement()) {
                $arFields = $ob->GetFields();
                $arAvailableBlockCodes[toUpper(trim($arFields['CODE']))] = $arFields['ID'];
                $arSettings = json_decode($arFields['~PROPERTY_SETTINGS_VALUE'], true);
                if (!is_array($arSettings))
                    $arSettings = [];
                $arAvailableBlockSettings[$arFields['ID']] = $arSettings;
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
                if (in_array($arProperty['CODE'], $arDefaultShowPropCodes))
                    continue;

                $arDefaultHideSelectors[] = '#tr_PROPERTY_' . $arProperty['ID'] . ':not(.show-property-row)';

                // Не показывать свойства, входящие в составные
                if (in_array($arProperty['ID'], $arNotDisplayPropertyIdsForBlocks))
                    continue;

                $blockCode = implode('_', array_slice(explode('_', $arProperty['CODE']), 0, 2));
                $arDisplayPropertyForBlocks[$arAvailableBlockCodes[$blockCode]][] = $arProperty['ID'];

                if ($arProperty['USER_TYPE'] == 'simai_complex' && is_array($arProperty['USER_TYPE_SETTINGS']['SUBPROPS'])) {

                    $defaultComplexItemCount = intval($arProperty['HINT']);
                    if ($defaultComplexItemCount > 0)
                        $arComplexItemCounts[$arProperty['ID']] = $defaultComplexItemCount;

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

            if (count($arDefaultHideSelectors) > 0) {
                $cssStyles = '<style>';
                $cssStyles .= implode(",", $arDefaultHideSelectors);
                $cssStyles .= '{ display: none; }';
                $cssStyles .= '.hide-property-row { display: none !important; }';
                $cssStyles .= '</style>';
                Asset::getInstance()->addString($cssStyles);
            }

            if (count($arDisplayPropertyForBlocks) > 0) {
                Asset::getInstance()->addString('<script>window.blockId = ' . intval($request->get('ID')) . '; window.pageConstructorComplexItemCounts = ' . json_encode($arComplexItemCounts) . '; window.pageConstructorPropertyRelation = ' . json_encode($arDisplayPropertyForBlocks) . '; window.pageConstructorPropertySettings = ' . json_encode($arAvailableBlockSettings) . '; if (typeof initPageConstructor == "function") initPageConstructor();</script>');
            }
        }

        if ($APPLICATION->showPanelWasInvoked || $isIblockElementEditPage) {
            Asset::getInstance()->addJs("/local/templates/nebolno/js/admin.js");
        }
    }
}