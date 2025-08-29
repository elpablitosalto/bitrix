<?

use Bitrix\Sale,
    Bitrix\Main\Loader,
    Bitrix\Main\Data\Cache,
    Bitrix\Main\Application;

class CMaterials
{
    public static function getFilterMaterials($arParams)
    {
        $arResult = array();

        $arFilterFromComponent = $arParams['arFilterFromComponent'];
        $USER_ID = $arParams['USER_ID'];
        $IBLOCK_ID = $arParams['IBLOCK_ID'];
        $MATERIAL_TYPE = $arParams['MATERIAL_TYPE'];

        // Фильтр по теме -->
        if (!empty($arFilterFromComponent['arFilterDirectory']['topic']) && $arParams['FILTER_BY_THEME'] != 'N') {
            foreach ($arFilterFromComponent['arFilterDirectory']['topic'] as $key => $val) {
                if (strlen($val) > 0) {
                    $arResult['arFilterResult']['PROPERTY_THEME'][] = $val;
                }
            }
        }
        // <-- Фильтр по теме

        // Фильтр по изученному -->
        if ($arFilterFromComponent['arFilter']['hidelearned'] == 'Y' && $arParams['FILTER_BY_LEARNED'] != 'N') {
            if (intval($USER_ID) > 0 && intval($IBLOCK_ID) > 0) {
                /*
                $cache = Cache::createInstance();
                $taggedCache = Application::getInstance()->getTaggedCache();

                $cachePath = '/' . $IBLOCK_ID . '_hidelearned/';
                $cacheTtl = 3600;
                //$cacheTtl = 1;
                $cacheKey = $IBLOCK_ID . '_hidelearned_' . $cacheTtl . $IBLOCK_ID . $USER_ID;

                if ($cache->initCache($cacheTtl, $cacheKey, $cachePath)) {
                    $hideIds = $cache->getVars();
                } elseif ($cache->startDataCache()) {

                    $taggedCache->startTagCache($cachePath);

                    $hideIds = [];

                    $arSelect = array('ID');
                    $arFilter = array(
                        "IBLOCK_ID" => $IBLOCK_ID,
                        "ACTIVE_DATE" => "Y",
                        "ACTIVE" => "Y",
                        'PROPERTY_USERS' => $USER_ID,
                    );
                    $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
                    while ($ob = $res->GetNextElement()) {
                        $arFields = $ob->GetFields();
                        $hideIds[] = $arFields['ID'];
                    }

                    $taggedCache->registerTag('iblock_id_' . $IBLOCK_ID);
                    $taggedCache->endTagCache();
                    $cache->endDataCache($hideIds);
                }

                if (is_array($hideIds)) {
                    $arResult['arFilterResult']['!ID'] = $hideIds;
                }
                */

                $hideIds = [];

                $arSelect = array('ID');
                $arFilter = array(
                    "IBLOCK_ID" => $IBLOCK_ID,
                    "ACTIVE_DATE" => "Y",
                    "ACTIVE" => "Y",
                    'PROPERTY_USERS' => $USER_ID,
                );
                $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
                while ($ob = $res->GetNextElement()) {
                    $arFields = $ob->GetFields();
                    $hideIds[] = $arFields['ID'];
                }
                if (is_array($hideIds)) {
                    $arResult['arFilterResult']['!ID'] = $hideIds;
                }
            }
        }
        // <-- Фильтр по изученному

        // Фильтр по спикеру -->
        if ($MATERIAL_TYPE == 'WEBINARS' && $arParams['FILTER_BY_SPEAKER'] != 'N') {
            if (!empty($arFilterFromComponent['arFilter']['speaker'])) {
                if (intval($arFilterFromComponent['arFilter']['speaker']) > 0) {
                    $arResult['arFilterResult']['PROPERTY_SPEAKER'] = $arFilterFromComponent['arFilter']['speaker'];
                }
            }
        }
        // <-- Фильтр по спикеру

        // С расшифровкой -->
        if ($MATERIAL_TYPE == 'WEBINARS' && $arParams['FILTER_BY_WITH_TRANSCRIPT'] != 'N') {
            if ($arFilterFromComponent['arFilter']['with_transcript'] == 'Y') {
                $arResult['arFilterResult']['PROPERTY_WITH_TRANSCRIPT_VALUE'] = 'Y';
            }
        }
        // <-- С расшифровкой

        return $arResult;
    }

    public static function getSavedMaterials($arParams)
    {
        $arResult = array();

        $USER_ID = $arParams['USER_ID'];
        $MATERIAL_IBLOCK_ID = $arParams['MATERIAL_IBLOCK_ID'];
        $currentIblock = $arParams['CURRENT_IBLOCK_ID'];

        if (intval($USER_ID) > 0 && !empty($MATERIAL_IBLOCK_ID)) {
            $IBLOCK_ID = Indexis::getIblockId('saved_materials', 'service');

            if (intval($USER_ID) > 0 && intval($IBLOCK_ID) > 0) {
                $cache = Cache::createInstance();
                $taggedCache = Application::getInstance()->getTaggedCache();

                $cachePath = '/materials_saved/';
                $cacheTtl = 3600;
                $cacheKey = 'materials_saved_' . $cacheTtl . $currentIblock . $IBLOCK_ID . $USER_ID . serialize( $MATERIAL_IBLOCK_ID);

                if ($cache->initCache($cacheTtl, $cacheKey, $cachePath)) {
                    $vars = $cache->getVars();
                    $savedIds = $vars["savedIds"];
                    $iblocks = $vars["iblocks"];
                } elseif ($cache->startDataCache()) {

                    $taggedCache->startTagCache($cachePath);

                    $savedIds = [];
                    $iblocks = [];

                    $arSelect = array('ID', 'PROPERTY_ARTICLE','PROPERTY_MATERIAL_IBLOCK_ID');
                    $arFilter = array(
                        "IBLOCK_ID" => $IBLOCK_ID,
                        "ACTIVE_DATE" => "Y",
                        "ACTIVE" => "Y",
                        'PROPERTY_USER' => $USER_ID,
                        'PROPERTY_MATERIAL_IBLOCK_ID' => $MATERIAL_IBLOCK_ID,
                        '!PROPERTY_ARTICLE' => false,
                        'PROPERTY_ARTICLE.ACTIVE' => "Y",
                    );
                    /*
                    if (!empty($arParams['MATERIAL_TYPE'])) {
                        $arFilter['PROPERTY_MATERIAL_TYPE'] = $arParams['MATERIAL_TYPE'];
                    }
                    */
                    $res = CIBlockElement::GetList(array('TIMESTAMP_X' => 'desc'), $arFilter, false, false, $arSelect);
                    while ($ob = $res->GetNextElement()) {
                        $arFields = $ob->GetFields();
                        if($currentIblock == $arFields["PROPERTY_MATERIAL_IBLOCK_ID_VALUE"])
                            $savedIds[] = $arFields['PROPERTY_ARTICLE_VALUE'];
                        if(!in_array($arFields["PROPERTY_MATERIAL_IBLOCK_ID_VALUE"], $iblocks))
                            $iblocks[] = $arFields["PROPERTY_MATERIAL_IBLOCK_ID_VALUE"];
                    }

                    $taggedCache->registerTag('iblock_id_' . $IBLOCK_ID);
                    $taggedCache->endTagCache();
                    $cache->endDataCache(["savedIds" => $savedIds, "iblocks" => $iblocks]);
                }

                $arResult["iblocks"] = $iblocks;

                if (is_array($savedIds)) {
                    $arResult['arFilterResult']['ID'] = $savedIds;
                }
            }
        }
        // <-- Фильтр по прочитанному

        return $arResult;
    }
}
