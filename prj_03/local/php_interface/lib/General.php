<?

namespace First;

use \Bitrix\Main\Loader;
use Bitrix\Main\Context,
    Bitrix\Currency\CurrencyManager,
    Bitrix\Sale\Order,
    Bitrix\Sale\Basket,
    Bitrix\Sale\Delivery,
    Bitrix\Sale\PaySystem,
    Bitrix\Sale\DiscountCouponsManager;
use Bitrix\Main\Type\DateTime;

class General
{
    /**
     * Проверка ответа reCAPTCHA
     * @return bool
     * @throws \Bitrix\Main\ArgumentException
     */
    public static function recaptchaCheck()
    {
        $request = \Bitrix\Main\Context::getCurrent()->getRequest();
        $arPost = $request->getPostList()->toArray(); // массив post параметров
        $GLOBALS['REC_RESP']['POST'] = $arPost;
        
        $request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
        if ($request->getRequestMethod() === 'POST' && !empty($request->getPost('recaptcha_response'))) {
            // Не проверяем капчу для локалки и авторизованных
            if (strstr($request->getServer()->getServerName(), ".local") !== false || $GLOBALS["USER"]->IsAuthorized()) {
                return true;
            }
            // Создаем POST запрос
            $recaptchaUrl = 'https://www.google.com/recaptcha/api/siteverify';
            $recaptchaSecret = \Bitrix\Main\Config\Option::get("main", "recaptcha_secret_code", RECAPTCHA_3_PRIVATE_KEY);
            $recaptchaResponse = $request->getPost('recaptcha_response');

            // Отправляем POST запрос и декодируем результаты ответа
            $recaptcha = file_get_contents($recaptchaUrl . '?secret=' . $recaptchaSecret . '&response=' . $recaptchaResponse);
            $recaptcha = \Bitrix\Main\Web\Json::decode($recaptcha);

            $GLOBALS['REC_RESP']['recaptcha'] = $recaptcha;

            // Принимаем меры в зависимости от полученного результата
            if ($recaptcha["success"] && $recaptcha["score"] >= 0.5) {
                return true;
            }
        }
        return false;
    }
}
