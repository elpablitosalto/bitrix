<?php

use Bitrix\Sale;
use Bitrix\Main\Loader;

class Indexis
{
    /**
     * Возвращаем id инфоблока по символьному коду
     */
    public static function getIblockId($code, $type = '')
    {
        if (Loader::includeModule('iblock')) {
            $arrFilter = [
                'ACTIVE' => 'Y',
                'CODE' => $code
            ];

            if ($type)
                $arrFilter['TYPE'] = $type;

            $res = CIBlock::GetList(["SORT" => "ASC"], $arrFilter, false);
            if ($ar_res = $res->Fetch())
                return $ar_res['ID'];
        }

        return false;
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

    public static function getCleanPhoneNumber($phone)
    {
        return preg_replace('/[^0-9\+]/', '', $phone);
    }

    /**
     * Возвращает отформатированную цену
     */
    public static function getPriceFormatted($price, $currency = "RUB", $showFrom = "N")
    {

        $priceFormatted = '';
        if ($showFrom == "Y")
            $priceFormatted = 'от&nbsp;';

        $priceFormatted .= number_format($price, 0, ',', '&nbsp;');

        if ($currency == 'RUB')
            $priceFormatted .= '&nbsp;₽';

        return $priceFormatted;
    }

    /**
     * Возвращает "30 января 2025" по строке с датой 
     */
    public static function getDateFormatted($date)
    {
        $months = array(0 => 'января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря');

        $timestamp = strtotime($date);

        $result = date('j ' . $months[date('n')] . ' Y', $timestamp);

        return $result;
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

    public static function getImageFormatted_del($arParams)
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

    // Snippet from PHP Share: http://www.phpshare.org
    public static function formatSizeUnits($bytes)
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

    public static function getExtension($str)
    {
        $i = explode('.', $str);
        return strtolower(end($i));
    }
}
