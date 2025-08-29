<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Loader;
use \Bitrix\Main\Localization\Loc;

Loader::includeModule("form");

Loc::loadLanguageFile(__FILE__);

$request = \Bitrix\Main\Context::getCurrent()->getRequest();
$arPost = $request->getPostList()->toArray(); // массив post параметров

$arResult = array(
    'ERROR' => 'N',
    'SUCCESS' => 'N',
);

if (!recaptchaCheck()) {
    $arResult['ERROR'] = 'Y';
    $arResult['ERROR_MESSAGE'] = Loc::getMessage("ASK_QUESTION_RECAPTCHA_ERROR");
}

if ($arResult['ERROR'] != 'Y') {
    // ID веб-формы
    $FORM_ID = $arPost['WEB_FORM_ID'];

    // массив значений ответов
    $arValues = array();
    foreach ($arPost as $key => $val) {
        if (strpos($key, 'form_') !== false) {
            $arValues[$key] = $val;
        }
    }
    // создадим новый результат
    if (!empty($arValues) && intval($FORM_ID) > 0) {

        $arResult["FORM_ERRORS"] = CForm::Check($FORM_ID, $arValues, false, "Y", "N");

        if ($arResult["FORM_ERRORS"] == '') {
            if ($RESULT_ID = CFormResult::Add($FORM_ID, $arValues)) {
                $arResult['SUCCESS'] = 'Y';
            } else {
                $arResult['ERROR'] = 'Y';
                global $strError;
                $arResult['ERROR_MESSAGE'] = $strError;
            }
        } else {
            $arResult['ERROR'] = 'Y';
            $arResult['ERROR_MESSAGE'] = $arResult["FORM_ERRORS"];
        }
    }
}

echo json_encode($arResult);
