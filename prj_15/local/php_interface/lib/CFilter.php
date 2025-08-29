<?
use \Bitrix\Main\Data\Cache;
use \Bitrix\Highloadblock as HL;
use \Bitrix\Main\Application;
class CFilter
{
    static public function getFilterThemes($arParams)
    {
        $arResult = array();

        //global $USER;
        $cache = Cache::createInstance();

        //свойства тем
        $filterIblocks = $arParams['filterIblocks'];

        $cachePath = 'filter_theme';
        $cacheTtl = 60 * 60 * 24;
        $cacheKey = 'filter_theme';
        $taggedCache = Application::getInstance()->getTaggedCache(); // Служба пометки кеша тегами

        if ($cache->initCache($cacheTtl, $cacheKey, $cachePath)) {
            $arInput = $cache->getVars(); // Получаем переменные

            $arResult['arInput'] = $arInput;
        } elseif ($cache->startDataCache()) {

            $arInput["VISIBLE_THEMES"] = [];

            //ib
            $arInput["IBLOCKS"] = [];
            $arInput["IBLOCKS_ID"] = [];
            $iblock = new CIBlock();
            $dbIblock = $iblock->GetList(array('sort' => 'asc'), ["CODE" => $filterIblocks], false);
            while ($arIblock = $dbIblock->Fetch()) {
                $arInput["IBLOCKS"][$arIblock["ID"]] = $arIblock;
                $arInput["IBLOCKS_ID"][$arIblock["CODE"]] = $arIblock["ID"];
            }

            //themes
            $rsData = HL\HighloadBlockTable::getList(['filter' => ['=NAME' => 'Themes']]);
            if ($hldata = $rsData->fetch()) {

                $arInput["THEMES"] = [];
                HL\HighloadBlockTable::compileEntity($hldata);
                $hlDataClass = $hldata['NAME'] . 'Table';
                $res = $hlDataClass::getList(
                    [
                        'filter' => [
                            '!UF_SHOW_NEW_MATERIALS' => false
                        ],
                        'select' => [
                            "UF_XML_ID",
                            "UF_NAME",
                        ],
                        'order' => ['UF_SORT' => 'asc', 'UF_NAME' => 'asc']
                    ]
                );
                while ($row = $res->fetch()) {
                    $arInput["VISIBLE_THEMES"][] = $row['UF_XML_ID'];
                    $arInput["THEMES"][$row['UF_XML_ID']] = $row;
                }

                $arInput["THEMES_SELECTION"] = [];
                HL\HighloadBlockTable::compileEntity($hldata);
                $hlDataClass = $hldata['NAME'] . 'Table';
                $res = $hlDataClass::getList(
                    [
                        'filter' => [
                            'LOGIC' => 'OR',
                            ['!UF_SHOW_PERSONAL_SELECTION' => false],
                            ['!UF_THEMES_EFECTIVNESS' => false],
                            ['!UF_SHOW_PERSONAL_SELECTION' => false],
                        ],
                        'select' => [
                            "UF_XML_ID",
                            "UF_NAME",
                            "UF_SHOW_PERSONAL_SELECTION",
                            "UF_THEMES_EFECTIVNESS",
                            "UF_SHOW_PERSONAL_SELECTION"
                        ],
                        'order' => ['UF_SORT' => 'asc', 'UF_NAME' => 'asc']
                    ]
                );
                while ($row = $res->fetch()) {
                    if ($row['UF_SHOW_PERSONAL_SELECTION'])
                        $arInput["THEMES_SELECTION"][$row['UF_XML_ID']] = $row['UF_XML_ID'];
                    if ($row['UF_THEMES_EFECTIVNESS'])
                        $arInput["THEMES_EFECTIVNESS"][$row['UF_XML_ID']] = $row['UF_XML_ID'];
                    if ($row['UF_SHOW_PERSONAL_SELECTION'])
                        $arInput["PERSONAL_SELECTION"][$row['UF_XML_ID']] = $row['UF_XML_ID'];
                }
            }

            $arResult['arInput'] = $arInput;

            $cache->endDataCache($arInput);
        }

        return $arResult;
    }
}
