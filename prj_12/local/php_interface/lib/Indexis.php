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

    /**
     * Возвращает "30 января 2025" по строке с датой 
     */
    public static function getDateFormatted($date)
    {
        $months = array(1 => 'января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря');

        $timestamp = strtotime($date);

        $result = date('j ' . $months[date('n', $timestamp)] . ' Y', $timestamp);

        return $result;
    }

    public static function getImageFormatted($arParams)
    {
        $arResult = array();

        $arResult['FILE_VALUE'] = $arParams['FILE_VALUE'];
        $noPhotoSrc = '/local/templates/nebolno/img/design/no_photo.png';

        $arPicture = [];
        if ($arParams['RESIZE'] == 'Y') {
            $arFileResized = CFile::ResizeImageGet(
                $arResult['FILE_VALUE']['ID'],
                array('width' => $arParams['WIDTH'], 'height' => $arParams['HEIGHT']),
                $arParams['RESIZE_TYPE'],
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
