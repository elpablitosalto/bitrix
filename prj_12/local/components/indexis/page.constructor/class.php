<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

use Bitrix\Main\Localization\Loc,
Bitrix\Main\Loader;


class IndexisPageConstructor extends CBitrixComponent
{
    protected function checkParams()
    {
        if (empty($this->arParams['SECTION_ID'])) {
            ShowError(Loc::getMessage('INDEXIS_PAGE_CONSTRUCTOR_NO_SECTION_ID'));
            return false;
        }

        $this->arParams['IBLOCK_ID'] = Indexis::getIblockId('pages', 'constructor');

        if (!isset($this->arParams['CACHE_TIME']))
            $this->arParams['CACHE_TIME'] = 36000000;

        return true;
    }

    protected function getServiceName()
    {
        if (is_array($this->arParams['SERVICE_ID']) && count($this->arParams['SERVICE_ID']) > 0) {

            $arFilter = array(
                'IBLOCK_ID' => Indexis::getIblockId('services', 'services'),
                'ACTIVE' => 'Y',
                'ID' => $this->arParams['SERVICE_ID'][0]
            );

            $rsSect = CIBlockSection::GetList(
                array('id' => 'asc'),
                $arFilter,
                false,
                array('ID', 'NAME')
            );

            while ($arSect = $rsSect->GetNext()) {
                return $arSect['NAME'];
            }
        }

        return '';
    }

    protected function getPromoName()
    {
        $res = CIBlockElement::GetList(['SORT' => 'ASC'], [
            'IBLOCK_ID' => Indexis::getIblockId('promotions', 'services'),
            'ACTIVE_DATE' => 'Y',
            'ACTIVE' => 'Y',
            '=CODE' => $this->arParams['PROMO_CODE'],
        ], false, ['nPageSize' => 1], [
            'ID', 'NAME'
        ]);

        if ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            return $arFields['NAME'];
        }

        return '';
    }

    public function executeComponent()
    {
        $this->includeComponentLang('class.php');

        if (!Loader::includeModule('iblock') || !$this->checkParams())
            return;

        $this->arResult['ITEMS'] = [];
        $this->arResult['ANCHORS'] = [];

        //		if ($this->startResultCache(false))
//		{
        $res = CIBlockElement::GetList(['SORT' => 'ASC', 'NAME' => 'ASC'], [
            'IBLOCK_ID' => $this->arParams['IBLOCK_ID'],
            'ACTIVE_DATE' => 'Y',
            'ACTIVE' => 'Y',
            'SECTION_ID' => $this->arParams['SECTION_ID'],
        ], false, false, [
                'ID',
                'NAME',
                'IBLOCK_ID',
                'PREVIEW_PICTURE',
                'PREVIEW_TEXT',
            ]
        );

        if ($res->SelectedRowsCount() == 0) {
            ShowError(Loc::getMessage('INDEXIS_PAGE_CONSTRUCTOR_NO_SECTION_ID'));
            return false;
        }

        while ($ob = $res->GetNextElement()) {
            $arItem = $ob->GetFields();
            $arItem['PROPERTIES'] = $ob->GetProperties();

            $arButtons = CIBlock::GetPanelButtons(
                $arItem["IBLOCK_ID"],
                $arItem["ID"],
                0,
                array("SECTION_BUTTONS" => false, "SESSID" => false)
            );
            $arItem["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
            $arItem["DELETE_LINK"] = $arButtons["edit"]["delete_element"]["ACTION_URL"];

            foreach ($arItem['PROPERTIES'] as $prop) {
                if (
                    (is_array($prop["VALUE"]) && count($prop["VALUE"]) > 0)
                    || (!is_array($prop["VALUE"]) && $prop["VALUE"] <> '')
                ) {
                    $arItem["DISPLAY_PROPERTIES"][$prop['CODE']] = CIBlockFormatProperties::GetDisplayValue($arItem, $prop);
                }
            }

            if ($arItem["DISPLAY_PROPERTIES"]["SHOW_ANCHOR"]["VALUE_XML_ID"] == "Y") {
                $name_d = mb_strlen($arItem["DISPLAY_PROPERTIES"]["NAME_ANCHOR_DESKTOP"]["DISPLAY_VALUE"]) ? $arItem["DISPLAY_PROPERTIES"]["NAME_ANCHOR_DESKTOP"]["DISPLAY_VALUE"] : strip_tags($arItem['~NAME']);
                $name_m = mb_strlen($arItem["DISPLAY_PROPERTIES"]["NAME_ANCHOR_MOBILE"]["DISPLAY_VALUE"]) ? $arItem["DISPLAY_PROPERTIES"]["NAME_ANCHOR_MOBILE"]["DISPLAY_VALUE"] : $name_d;
                $this->arResult['ANCHORS'][] = [
                    'ID' => $arItem['ID'],
                    'NAME' => $name_d,
                    'NAME_M' => $name_m,
                ];
            }


            // 1-я, 2-я и 3-я часть заголовка для десктоп -->
            //$H_FST_PART_D = $arItem['~NAME'];
            $H_FST_PART_D = mb_strlen($arItem["PROPERTIES"]["H_FST_PART_D"]["VALUE"]) > 0 ? $arItem["PROPERTIES"]["H_FST_PART_D"]["VALUE"] : $arItem["NAME"];
            $H_SEC_PART_D = $arItem["PROPERTIES"]["H_SEC_PART_D"]["VALUE"];
            $H_THD_PART_D = $arItem["PROPERTIES"]["H_THD_PART_D"]["VALUE"];
            if (strlen($H_FST_PART_D) > 0) {
                $arItem["H_FST_PART_D"] = $H_FST_PART_D;
            }
            if (strlen($H_SEC_PART_D) > 0) {
                $arItem["H_SEC_PART_D"] = $H_SEC_PART_D;
            }
            if (strlen($H_THD_PART_D) > 0) {
                $arItem["H_THD_PART_D"] = $H_THD_PART_D;
            }
            // <--

            // 1-я, 2-я и 3-я части заголовка для мобильного -->
            $H_FST_PART_M = $arItem["PROPERTIES"]["H_FST_PART_M"]["VALUE"];
            $H_SEC_PART_M = $arItem["PROPERTIES"]["H_SEC_PART_M"]["VALUE"];
            $H_THD_PART_M = $arItem["PROPERTIES"]["H_THD_PART_M"]["VALUE"];
            if (strlen($H_FST_PART_M) > 0) {
                $arItem["H_FST_PART_M"] = $H_FST_PART_M;
            } else if (strlen($H_FST_PART_D) > 0) {
                $arItem["H_FST_PART_M"] = $H_FST_PART_D;
            }
            if (strlen($H_SEC_PART_M) > 0) {
                $arItem["H_SEC_PART_M"] = $H_SEC_PART_M;
            } else if (strlen($H_SEC_PART_D) > 0) {
                $arItem["H_SEC_PART_M"] = $H_SEC_PART_D;
            }
            if (strlen($H_THD_PART_M) > 0) {
                $arItem["H_THD_PART_M"] = $H_THD_PART_M;
            }
            // <--

            $this->arResult['ITEMS'][] = $arItem;
        }
        // }

//        $this->arResult['FORM_DATA'] = [];
//        if (!empty($this->arParams['SERVICE_ID'])) {
//            $this->arResult['FORM_DATA']['SERVICE']['NAME'] = $this->getServiceName();
//        }
//
//        if (!empty($this->arParams['PROMO_CODE'])) {
//            $this->arResult['FORM_DATA']['PROMO']['NAME'] = $this->getPromoName();
//        }

        $this->includeComponentTemplate();
    }
}
?>