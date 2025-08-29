<? require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Application,
    Bitrix\Main\Context,
    Bitrix\Main\Request,
    Bitrix\Main\Localization\Loc,
    Bitrix\Main\Loader,
    Bitrix\Main\Web\Json,
    Bitrix\Main\Data\Cache;

$code = $APPLICATION->CaptchaGetCode();

$res = Json::encode(['CAPTCHA_SID' => $code, 'CAPTCHA_IMG_SRC' => '/bitrix/tools/captcha.php?captcha_sid=' . $code]);

echo $res;

//die();

require_once($_SERVER["DOCUMENT_ROOT"] . BX_ROOT . "/modules/main/include/epilog_after.php");
