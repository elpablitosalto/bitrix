<?

namespace NoboringFinance;

use \Bitrix\Main\Config\Option;
use \Bitrix\Main\Application;

class General
{
    /**
     * Проверяет номер телефона на соответсвие маске +7 (333) 333-33-33
     */
    public static function validatePhoneNumber($phoneNumber)
    {
        // Убираем все символы, кроме цифр
        $phoneNumber = preg_replace('/\D/', '', $phoneNumber);

        // Проверяем длину номера
        if (strlen($phoneNumber) !== 11) {
            return false;
        }

        // Проверяем формат номера телефона
        if (!preg_match('/^7\d{3}\d{3}\d{2}\d{2}$/', $phoneNumber)) {
            return false;
        }

        return true;
    }
    /**
     * Валдицаия по массиву правил
     */
    public static function validateFieldsByRules($arFields, $arRules)
    {
        $result = [];

        foreach ($arRules as $fieldName => $fieldRules) {
            $result[$fieldName] = [];
            $value = $arFields[$fieldName];

            if ($fieldName !== 'agreement') {
                foreach ($fieldRules as $rule) {
                    $invalid = false;
                    if ($rule === 'tel' && !self::validatePhoneNumber($value)) {
                        $invalid = true;
                    }

                    if ($rule === 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                        $invalid = true;
                    }

                    if ($rule === 'required' && empty($value)) {
                        $invalid = true;
                    }

                    if ($invalid) {
                        $result[$fieldName][$rule] = 'invalid';
                    }
                }
            }
        }

        return $result;
    }
    /**
     * Базовая проверка формы
     * @return bool
     * @throws \Bitrix\Main\ArgumentException
     */
    public static function formValidate()
    {
        $errors = [];
        $request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();

        if (!empty($request->getPost('form_message'))) {
            return false;
        }

        if ($request->getRequestMethod() === 'POST' && !empty($request->getPost('validate_rules'))) {
            $arRules = json_decode($request->getPost('validate_rules'));
            $arFields = $request->getPostList()->toArray();

            if (!empty($arRules)) {
                $errors = self::validateFieldsByRules($arFields, $arRules);
            }
        }

        // Чистка от пустых значений
        $errors = array_filter($errors);

        return !empty($errors) ? false : true;
    }
    /**
     * Проверка ответа reCAPTCHA
     * @return bool
     * @throws \Bitrix\Main\ArgumentException
     */
    public static function recaptchaCheck()
    {
        $GLOBALS['RECAPTCHA_ANSWER'] = '';

        $request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
        // Не проверяем капчу для локалки и авторизованных
        if (strstr($request->getServer()->getServerName(), ".local") !== false || $GLOBALS["USER"]->IsAuthorized()) {
            return true;
        } else {
            $GLOBALS['RECAPTCHA_ANSWER'] = '1';
        }
        // form_message - скрытое поле. Должно быть пустым, если нет то вероятнее всего это спам
        if ($request->getRequestMethod() === 'POST' && !empty($request->getPost('recaptcha_response')) && empty($request->getPost('form_message'))) {
            // Создаем POST запрос
            $recaptchaUrl = 'https://www.google.com/recaptcha/api/siteverify';
            $recaptchaSecret = \Bitrix\Main\Config\Option::get("main", "recaptcha_secret_code", CAPTCHA_SECRET_KEY);
            $recaptchaResponse = $request->getPost('recaptcha_response');

            // Отправляем POST запрос и декодируем результаты ответа
            $recaptcha = file_get_contents($recaptchaUrl . '?secret=' . $recaptchaSecret . '&response=' . $recaptchaResponse);
            $GLOBALS['RECAPTCHA_ANSWER'] = $recaptcha;
            $recaptcha = \Bitrix\Main\Web\Json::decode($recaptcha);


            // Принимаем меры в зависимости от полученного результата
            if ($recaptcha["success"] && $recaptcha["score"] >= CAPTCHA_SCORE) {
                return true;
            } else {
                $GLOBALS['RECAPTCHA_ANSWER'] = '2';
            }
        } else {
            $GLOBALS['RECAPTCHA_ANSWER'] = \Bitrix\Main\Web\Json::encode(array(
                'type' => 3,
                'getRequestMethod' => $request->getRequestMethod(),
                'recaptcha_response' => $request->getPost('recaptcha_response'),
                'form_message' => $request->getPost('form_message'),
            ));
        }
        return false;
    }

    /**
     * Исправляет поломанные внешние ссылки в меню, которым битрикс добавляет SITE_DIR и удаляет слеш из протокола
     */
    public static function fixExternalLink($link = '')
    {
        if (strpos($link, '/https:/') === 0) {
            $link = ltrim($link, '/https:/');
            $link = 'https://' . $link;
        }

        if (strpos($link, '/http:/') === 0) {
            $link = ltrim($link, '/http:/');
            $link = 'http://' . $link;
        }

        return $link;
    }

    /**
     * Определяет нужно ли показывать поиск
     */
    public static function showSearch()
    {
        return stripos($_SERVER['REQUEST_URI'], '/gazeta') !== false || stripos($_SERVER['REQUEST_URI'], '/search') !== false ? true : false;
    }


    /**
     * Изменить дату мероприятия
     */
    public static function changeEventDate()
    {
        if (defined('IBLOCK_ID_EVENTS') && \Bitrix\Main\Loader::includeModule('iblock')) {

            $arSelect = array("ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_PERFORMANCE_DATE");
            $arFilter = array(
                "IBLOCK_ID" => IBLOCK_ID_EVENTS,
                "ACTIVE" => "Y",
                "ACTIVE_DATE" => "Y",
                "PROPERTY_REGULAR_VALUE" => 'Да'
            );
            $res = \CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
            while ($arFields = $res->GetNext()) {
                $eventDate = $arFields['PROPERTY_PERFORMANCE_DATE_VALUE'];

                if (empty($eventDate)) {
                    $eventDate = date('d.m.Y');
                }

                $eventDateTimestamp = strtotime(date('d.m.Y', strtotime($eventDate)));
                $todayDateTimestamp = strtotime(date('d.m.Y', time()));
                $tomorrowDateTimestamp = strtotime(date('d.m.Y', time()+86400));

                if ($eventDateTimestamp < $todayDateTimestamp) {
                    $eventDateTimestamp = $todayDateTimestamp;
                }
                if ($eventDateTimestamp >= $tomorrowDateTimestamp) {
                    $eventDateTimestamp = $todayDateTimestamp;
                }

                $newEventDate = date('d.m.Y', ($eventDateTimestamp + 86400));

                \CIBlockElement::SetPropertyValuesEx(
                    $arFields['ID'],
                    IBLOCK_ID_EVENTS,
                    array('PERFORMANCE_DATE' => $newEventDate)
                );
            }
        }
    }
}
