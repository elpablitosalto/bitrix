<?

namespace NoboringFinance;

use \Bitrix\Main\Loader;
use Bitrix\Main\Context,
    Bitrix\Currency\CurrencyManager,
    Bitrix\Sale\Order,
    Bitrix\Sale\Basket,
    Bitrix\Sale\Delivery,
    Bitrix\Sale\PaySystem,
    Bitrix\Sale\DiscountCouponsManager;
use Bitrix\Main\Type\DateTime;

class Agents
{
    public static function changeEventDate()
    {
        if (\Bitrix\Main\Loader::includeModule("iblock")) {
            \NoboringFinance\General::changeEventDate();
        }
        return "\NoboringFinance\Agents::changeEventDate();";
    }

    public static function cleanExpireCache($path = "")
    {
        if (!class_exists("CFileCacheCleaner")) {
            require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/classes/general/cache_files_cleaner.php");
        }
        $curentTime = time();
        if (defined("BX_CRONTAB") && BX_CRONTAB === true) $endTime = time() + 5; //Если на кроне, то работаем 5 секунд
        else $endTime = time() + 1; //Если на хитах, то не более секунды
        //Работаем со всем кешем
        $obCacheCleaner = new \CFileCacheCleaner("all");
        if (!$obCacheCleaner->InitPath($path)) {
            //Произошла ошибка
            return "\NoboringFinance\Agents::cleanExpireCache();";
        }
        $obCacheCleaner->Start();
        while ($file = $obCacheCleaner->GetNextFile()) {
            if (is_string($file)) {
                $date_expire = $obCacheCleaner->GetFileExpiration($file);
                if ($date_expire) {
                    if ($date_expire < $curentTime) {
                        unlink($file);
                    }
                }
                if (time() >= $endTime) break;
            }
        }
        if (is_string($file)) {
            return "\NoboringFinance\Agents::cleanExpireCache(\"" . $file . "\");";
        } else {
            return "\NoboringFinance\Agents::cleanExpireCache();";
        }
    }
}
