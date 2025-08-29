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
        return $num . ' ' . $words[($num % 100 > 4 && $num % 100 < 20) ? 2 : $cases[min($num % 10, 5)]];
    }

    /**
     * Проверяем правильность временной зоны
     */
    public static function isValidTimezoneId($timezoneId)
    {
        try {
            new DateTimeZone($timezoneId);
        } catch (Exception $e) {
            return false;
        }

        return true;
    }

    // Декодирование emoji в UTF-8 (используется в рег.выражении)  -->
    function unichr($i)
    {
        return iconv('UCS-4LE', 'UTF-8', pack('V', $i));
    }

    // Конвертация emoji из UTF-8 в HTML -->
    function encode_emoji($content)
    {
        $emoji = Indexis::emoji_list('partials');

        foreach ($emoji as $emojum) {
            $emoji_char = html_entity_decode($emojum);
            if (false !== strpos($content, $emoji_char)) {
                $content = preg_replace("/$emoji_char/", $emojum, $content);
            }
        }

        return $content;
    }
    
    // HTML-коды emoji
    function emoji_list($type)
    {
        $ar = array(
            "&#128578;",
            "&#128521;",
            "&#128523;",
            "&#129321;",
            "&#128516;",
            "&#128549;",
            "&#128542;",
            "&#128548;",
            "&#128563;",
            "&#128053;",
            "&#128151;",
            "&#128536;",
            "&#128077;",
            "&#128078;",
        );

        return $ar;
    }
}