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

    public static function num2word_2($num = 0, $words = array())
    {
        $num = (int) $num;
        $cases = array(2, 0, 1, 1, 1, 2);
        return str_replace('#NUM#', $num, $words[($num % 100 > 4 && $num % 100 < 20) ? 2 : $cases[min($num % 10, 5)]]);
    }

    public static function isUserPassword($userId, $password)
    {
        $userData = CUser::GetByID($userId)->Fetch();
        $login = $userData['LOGIN']; //получаем логин текущего юзера
        $USERcheck = new CUser;
        $check = $USERcheck->Login($login, $password, 'N', 'Y'); //проверяем верный ли пароль

        //echo 'login = '.$login.'<br />';
        //vardump($check);

        $result = $check == 1 && !is_array($check);
        //echo 'result = '.$result.'<br />';

        return $result;
    }
}
