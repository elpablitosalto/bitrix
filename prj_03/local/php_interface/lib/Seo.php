<?

namespace First;

use BitrixTools;

class Seo
{
    public static function makeUniqProductsSymbolCodes()
    {
        \Bitrix\Main\Loader::includeModule('iblock');

        $iblockId = BitrixTools::getIblockId('catalog', 'aspro_mshop_catalog');
        if (empty($iblockId)) {
            $iblockId = 34;
        }
        $arCodesAll = array();
        $arCodesDuplicate = array();
        $arCodesStackDuplicate = array();

        if (intval($iblockId) > 0) {

            $arSelect = array("ID", "CODE");
            $arFilter = array("IBLOCK_ID" => $iblockId);
            $res = \CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
            while ($ob = $res->GetNextElement()) {
                $arFields = $ob->GetFields();

                $elCode = $arFields['CODE'];

                if (!empty($elCode)) {
                    $arCodesAll[$arFields['ID']] = $elCode;
                }
            }
        }

        //vardump($arCodesAll);

        $arCodesAll_2 = $arCodesAll;
        $i = 0;
        foreach ($arCodesAll as $key => $val) {
            $flag = false;
            foreach ($arCodesAll_2 as $key_2 => $val_2) {
                if ($val == $val_2 && $key_2 != $key && !in_array($val_2, $arCodesStackDuplicate)) {
                    $flag = true;
                    $arCodesDuplicate[$i][$key_2] = $val_2;
                    $arCodesStackDuplicate[] = $val_2;
                }
            }
            if ($flag) {
                $arCodesDuplicate[$i][$key] = $val;
                $i++;
            }
        }

        foreach ($arCodesDuplicate as $key => $val) {
            foreach ($val as $key_2 => $val_2) {
                $el = new \CIBlockElement;
                $arLoadProductArray = array(
                    'CODE' => $val_2 . '_' . $key_2
                );
                $res = $el->Update($key_2, $arLoadProductArray);
            }
        }

        //vardump($arCodesDuplicate);
    }

    public static function reIndexSearch()
    {
        if (\CModule::IncludeModule("search") && \CModule::IncludeModule("iblock")) {

            // Включаем индексацию -->
            $ib = new \CIBlock;
            $arFields = array(
                'INDEX_ELEMENT' => 'Y',
                'INDEX_SECTION' => 'Y',
            );
            $iblockId = BitrixTools::getIblockId('catalog', 'aspro_mshop_catalog');
            if (empty($iblockId)) {
                $iblockId = 34;
            }
            $res = $ib->Update($iblockId, $arFields);
            // <-- Включаем индексацию

            $Result = false;

            $max_execution_time = 10000; // все элементы индексируются только при большом шаге

            $Result = \CSearch::ReIndexAll(false, $max_execution_time);

            while (is_array($Result)) {

                $Result = \CSearch::ReIndexAll(false, $max_execution_time, $Result);
            }

            // Отключаем индексацию -->
            $arFields = array(
                'INDEX_ELEMENT' => 'N',
                'INDEX_SECTION' => 'N',
            );
            $res = $ib->Update($iblockId, $arFields);
            // <-- Отключаем индексацию
        }
    }
}
