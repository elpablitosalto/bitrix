<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

use Bitrix\Main\Application;
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

    public function executeComponent()
    {
        $this->includeComponentLang('class.php');

        if (!Loader::includeModule('iblock') || !$this->checkParams())
            return;

        // Массив $_POST -->    
        $arPost = array();
        $request = \Bitrix\Main\Context::getCurrent()->getRequest();
        //$arPost = $request->getPostList()->toArray();
        $arPost = $request->getQueryList()->toArray();
        $this->arResult['POST'] = $arPost;
        // <-- Массив $_POST


        $this->arResult['ITEMS'] = [];
        $this->arResult['ANCHORS'] = [];

        //		if ($this->startResultCache(false))
//		{
        $arSelect = [
            'ID',
            'NAME',
            'IBLOCK_ID',
            'PREVIEW_PICTURE',
            'PREVIEW_TEXT',
        ];
        $arSelect = false;
        $res = CIBlockElement::GetList(
            ['SORT' => 'ASC', 'NAME' => 'ASC'], 
            [
            'IBLOCK_ID' => $this->arParams['IBLOCK_ID'],
            'ACTIVE_DATE' => 'Y',
            'ACTIVE' => 'Y',
            'SECTION_ID' => $this->arParams['SECTION_ID'],
            ], 
            false, false, $arSelect
        );

        while ($ob = $res->GetNextElement()) {
            $arItem = $ob->GetFields();
            $arItem['PROPERTIES'] = $ob->GetProperties();
            //echo "NAME = ".$arItem["NAME"]."<br />";
            //vardump($arItem['PROPERTIES']);

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

            /*
            if ($arItem["DISPLAY_PROPERTIES"]["SHOW_ANCHOR"]["VALUE_XML_ID"] == "Y") {
                $this->arResult['ANCHORS'][] = [
                    'ID' => $arItem['ID'],
                    'NAME' => mb_strlen($arItem["DISPLAY_PROPERTIES"]["NAME_ANCHOR_DESKTOP"]["DISPLAY_VALUE"]) ? $arItem["DISPLAY_PROPERTIES"]["NAME_ANCHOR_DESKTOP"]["DISPLAY_VALUE"] : strip_tags($arItem['~NAME'])
                ];
            }
            */

            /*
            // 1-я, 2-я и 3-я часть заголовка для десктоп -->
            $H_FST_PART_D = $arItem['~NAME'];
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
            }
            if (strlen($H_THD_PART_M) > 0) {
                $arItem["H_THD_PART_M"] = $H_THD_PART_M;
            }
            // <--
            */

            $this->arResult['ITEMS'][] = $arItem;
        }
        // }

        $this->includeComponentTemplate();
    }
}
