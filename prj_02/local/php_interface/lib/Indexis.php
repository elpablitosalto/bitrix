<?php

use Bitrix\Sale,
    Bitrix\Main\Loader,
    Bitrix\Main\Data\Cache,
    Bitrix\Main\Application;

class Indexis
{
    /**
     * Get Iblock Id.
     *
     * @param $code
     * @param $type
     * @param $siteId
     * @param $cacheTime
     * @return bool|null
     */
    public static function getIblockId($code, $type = '', $siteId = 's1', $cacheTime = '9999999')
    {
        if (!$code || !$siteId) {
            return false;
        }

        $obCache = new CPHPCache();
        $cacheDir = "/iblock_helper/iblock/{$code}-{$type}-{$siteId}";

        $id = null;
        if ($obCache->initCache($cacheTime, $cacheDir, $cacheDir)) {
            $id = $obCache->getVars();
        } else if ($obCache->startDataCache()) {
            if (is_numeric($code)) {
                $arFilter["ID"] = $code;
            } else {
                $arFilter["CODE"] = $code;
            }

            if (!empty($type)) $arFilter["TYPE"] = $type;
            $arFilter["SITE_ID"] = $siteId;

            Loader::includeModule('iblock');

            $iblock = new CIBlock();
            $dbIblock = $iblock->GetList(array(), $arFilter, false);
            if ($arIblock = $dbIblock->Fetch()) {
                $id = $arIblock["ID"];

                global $CACHE_MANAGER;

                $CACHE_MANAGER->startTagCache($cacheDir);
                $CACHE_MANAGER->registerTag("iblock_id_" . $id);
                $CACHE_MANAGER->endTagCache();

                $obCache->endDataCache($id);
            } else {
                $obCache->abortDataCache();
            }
        }

        return $id;
    }

    public static function reverse_parse_url(array $parts)
    {
        $url = '';
        if (!empty($parts['scheme'])) {
            $url .= $parts['scheme'] . ':';
        }
        if (!empty($parts['user']) || !empty($parts['host'])) {
            $url .= '//';
        }
        if (!empty($parts['user'])) {
            $url .= $parts['user'];
        }
        if (!empty($parts['pass'])) {
            $url .= ':' . $parts['pass'];
        }
        if (!empty($parts['user'])) {
            $url .= '@';
        }
        if (!empty($parts['host'])) {
            $url .= $parts['host'];
        }
        if (!empty($parts['port'])) {
            $url .= ':' . $parts['port'];
        }
        if (!empty($parts['path'])) {
            $url .= $parts['path'];
        }
        if (!empty($parts['query'])) {
            if (is_array($parts['query'])) {
                $url .= '?' . http_build_query($parts['query']);
            } else {
                $url .= '?' . $parts['query'];
            }
        }
        if (!empty($parts['fragment'])) {
            $url .= '#' . $parts['fragment'];
        }

        return $url;
    }

    /**
     * Возвращает склонение слова в зависимости от числа
     */
    public static function num2word($num = 0, $words = array())
    {
        $num = (int) $num;
        $cases = array(2, 0, 1, 1, 1, 2);
        return str_replace('#NUM#', $num, $words[($num % 100 > 4 && $num % 100 < 20) ? 2 : $cases[min($num % 10, 5)]]);
    }

    public static function FileSizeConvert($bytes)
    {
        $bytes = floatval($bytes);
        $arBytes = array(
            0 => array(
                "UNIT" => "Тб",
                "VALUE" => pow(1024, 4)
            ),
            1 => array(
                "UNIT" => "Гб",
                "VALUE" => pow(1024, 3)
            ),
            2 => array(
                "UNIT" => "Мб",
                "VALUE" => pow(1024, 2)
            ),
            3 => array(
                "UNIT" => "Кб",
                "VALUE" => 1024
            ),
            4 => array(
                "UNIT" => "Б",
                "VALUE" => 1
            ),
        );

        foreach ($arBytes as $arItem) {
            if ($bytes >= $arItem["VALUE"]) {
                $result = $bytes / $arItem["VALUE"];
                $result = str_replace(".", ",", strval(round($result, 2))) . " " . $arItem["UNIT"];
                break;
            }
        }
        return $result;
    }

    ## Сортировка объектов/массивов находящихся в массиве, по указанным полям.
    public static function sort_nested_arrays($array, $args = array('votes' => 'desc'))
    {
        usort($array, function ($a, $b) use ($args) {
            $res = 0;

            $a = (object) $a;
            $b = (object) $b;

            foreach ($args as $k => $v) {
                if ($a->$k == $b->$k) continue;

                $res = ($a->$k < $b->$k) ? -1 : 1;
                if ($v == 'desc') $res = -$res;
                break;
            }

            return $res;
        });

        return $array;
    }

    ## Программа "Путь к успеху"
    public static function getProgramForPath()
    {
        $projVal = $programId = false;
        $cache = Cache::createInstance();
        $taggedCache = Application::getInstance()->getTaggedCache();

        Loader::includeModule('iblock');

        $cachePath = '/main/';
        $cacheTtl = 360000;
        $progIb = Indexis::getIblockId("programs", "content", "s1");
        $cacheKey = 'program_id_' . $progIb;

        if ($cache->initCache($cacheTtl, $cacheKey, $cachePath)) {
            $programId = $cache->getVars();
        } elseif ($cache->startDataCache()) {

            $taggedCache->startTagCache($cachePath);
            $taggedCache->registerTag('iblock_id_' . $progIb);

            $arSelect = array("ID");
            $arFilter = array("IBLOCK_ID" => $progIb, "=CODE" => "programma-put-k-uspekhu");
            $data = CIBlockElement::GetList(array(), $arFilter, false, ["nTopCount" => 1], $arSelect)->Fetch();
            $programId = $data["ID"];

            $taggedCache->endTagCache();
            $cache->endDataCache($programId);
        }

        //раздел "путь к успеху"
        $cachePath = '/main/';
        $cacheTtl = 360000;
        $projIb = Indexis::getIblockId("projects", "content", "s1");
        $cacheKey = 'projectsVal__' . $projIb;

        if ($cache->initCache($cacheTtl, $cacheKey, $cachePath)) {
            $projVal = $cache->getVars();
        } elseif ($cache->startDataCache()) {

            $taggedCache->startTagCache($cachePath);

            $arFilter = Array('IBLOCK_ID'=>$projIb, '=CODE' => 'programma-put-k-uspekhu', 'ACTIVE' => 'Y');
            $db_list = CIBlockSection::GetList(Array($by=>$order), $arFilter, false, ['ID'], ['nTopCount' => 1]);
            if($ar_result = $db_list->GetNext())
            {
                $projVal = $ar_result["ID"];
            }

            $taggedCache->registerTag('iblock_id_' . $projIb);

            $taggedCache->endTagCache();
            $cache->endDataCache($projVal);
        }

        return ["ELEMENT" => $programId, "DIR" => $projVal];
    }

    public static function getImageFormatted($arParams)
    {
        $arResult = array();

        $arResult['FILE_VALUE'] = $arParams['FILE_VALUE'];
        $noPhotoSrc = '/img/common/no_photo.png';

        $arPicture = [];
        if ($arParams['RESIZE'] == 'Y') {
            $arFileResized = CFile::ResizeImageGet(
                $arResult['FILE_VALUE']['ID'],
                array('width' => $arParams['WIDTH'], 'height' => $arParams['HEIGHT']),
                BX_RESIZE_IMAGE_PROPORTIONAL,
                true
            );
            $arPicture['SRC'] = $arFileResized['src'];
            $arPicture['WIDTH'] = $arFileResized['width'];
            $arPicture['HEIGHT'] = $arFileResized['height'];
        } else {
            $arPicture['SRC'] = $arResult['FILE_VALUE']['SRC'];
            $arPicture['WIDTH'] = $arResult['FILE_VALUE']['WIDTH'];
            $arPicture['HEIGHT'] = $arResult['FILE_VALUE']['HEIGHT'];
        }
        if (!is_file($_SERVER["DOCUMENT_ROOT"] . $arResult['FILE_VALUE']['SRC']) && is_file($_SERVER["DOCUMENT_ROOT"] . $noPhotoSrc)) {
            $arPicture['SRC'] = $noPhotoSrc;
            $arPicture['WIDTH'] = $arParams['WIDTH'];
            $arPicture['HEIGHT'] = $arParams['HEIGHT'];
        }
        $arResult['PICTURE'] = array(
            'SRC' => $arPicture['SRC'],
            'ALT' => ('' != $arResult['FILE_VALUE']['ALT']
                ? $arResult['FILE_VALUE']['ALT']
                : $arParams['DEFAULT_ALT_TITLE']
            ),
            'TITLE' => ('' != $arResult['FILE_VALUE']['TITLE']
                ? $arResult['FILE_VALUE']['TITLE']
                : $arParams['DEFAULT_ALT_TITLE']
            ),
            'WIDTH' => $arPicture['WIDTH'],
            'HEIGHT' => $arPicture['HEIGHT'],
            'FILE_VALUE_SOURCE' => $arResult['FILE_VALUE'],
        );

        return $arResult;
    }
}
