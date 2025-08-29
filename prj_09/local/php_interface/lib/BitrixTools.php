<?php

use Bitrix\Sale,
    Bitrix\Main\Loader,
    Bitrix\Main\Data\Cache,
    Bitrix\Main\Application;

class BitrixTools
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

    public static function getAllGroupsOfElement($elID) {
        $db_old_groups = CIBlockElement::GetElementGroups($elID, true);
        $arGroups = [];
        while($ar_group = $db_old_groups->Fetch()) {
            $arGroups[] = $ar_group['ID'];
        }
        
        return $arGroups;
    }

    public static function getImageFormatted($arParams)
    {
        $arResult = array();

        $arResult['FILE_VALUE'] = $arParams['FILE_VALUE'];
        $noPhotoSrc = '/img/common/no_photo.png';
        if (strlen($arParams['NO_IMAGE_DEFAULT']) > 0) {
            $noPhotoSrc = $arParams['NO_IMAGE_DEFAULT'];
        }

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
        //echo 'SRC = '.$_SERVER["DOCUMENT_ROOT"] . $arResult['FILE_VALUE']['SRC'].'<br />';
        //echo 'is_file = '.is_file($_SERVER["DOCUMENT_ROOT"] . $arResult['FILE_VALUE']['SRC']).'<br />';
        //echo '<br />';
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

    /**
     * Возвращает отформатированную цену
     */
    public static function getPriceFormatted($price, $currency = "RUB", $showFrom = "N", $addCurrency = "Y")
    {
        $priceFormatted = '';
        if ($showFrom == "Y")
            $priceFormatted = 'от&nbsp;';

        if ($price == preg_replace('![^0-9]+!', '', $price)) {
            $priceFormatted .= number_format($price, 0, ',', '&nbsp;');
            /* Нужно убрать знак «₽»  из авто подписи – будет вставляться вручную  (т.к. может быть не только цена но и % )*/
            if ($addCurrency == "Y") {
                if ($currency == 'RUB') {
                    $priceFormatted .= '&nbsp;₽';
                }
            }
        } else {
            $ar = explode(' ', $price);
            if (!empty($ar)) {
                foreach ($ar as $part) {
                    $part_format = $part;

                    $part_digits = preg_replace('![^0-9]+!', '', $part);
                    if ($part == $part_digits) {
                        $part_format = number_format($part_digits, 0, ',', '&nbsp;');
                    }

                    $priceFormatted .= $part_format . ' ';
                }
            }
            //    
        }

        return $priceFormatted;
    }

    // $entity_id - имя объекта (у нас "BLOG_RATING")
    // $value_id - идентификатор элемента (вероятно, ID элемента, свойство которого мы сохраняем или получаем. в нашем случае, это ID комментария)
    // $uf_id - имя пользовательского свойства (в нашем случае UF_RATING)
    // $uf_value - значение, которое сохраняем
    public static function SetUserField($entity_id, $value_id, $uf_id, $uf_value)
    { //запись значения

        return $GLOBALS["USER_FIELD_MANAGER"]->Update(
            $entity_id,
            $value_id,
            array($uf_id => $uf_value)
        );
    }

    public static function GetUserField($entity_id, $value_id, $uf_id)
    { //считывание значения

        $arUF = $GLOBALS["USER_FIELD_MANAGER"]->GetUserFields($entity_id, $value_id);
        return $arUF[$uf_id]["VALUE"];
    }

    /**
     * Возвращает склонение слова в зависимости от числа
     */
    public static function num2word($num = 0, $words = array(), $useNum = true)
    {
        $num = (int) $num;
        $cases = array(2, 0, 1, 1, 1, 2);
        $return = '';
        if ($useNum) {
            $return .= $num . ' ';
        }
        $return .= $words[($num % 100 > 4 && $num % 100 < 20) ? 2 : $cases[min($num % 10, 5)]];
        return $return;
    }

    /**
     * Возвращает склонение слова в зависимости от числа
     */
    public static function num2wordStr($num = 0, $words = array())
    {
        $num = (int) $num;
        $cases = array(2, 0, 1, 1, 1, 2);
        return str_replace('#NUM#', $num, $words[($num % 100 > 4 && $num % 100 < 20) ? 2 : $cases[min($num % 10, 5)]]);
    }

    function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }

        return $bytes;
    }
}
