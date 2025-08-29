<?

namespace First;

use \Bitrix\Main\Loader;
use Bitrix\Main\Page\Asset;
use Bitrix\Main\Application;
use Bitrix\Iblock\ElementTable;
use Bitrix\Catalog\MeasureRatioTable;

class Events
{
    public static function OnSuccessCatalogImport1CHandler($arPropertyValues, $ABS_FILE_NAME)
    {
        self::OnSuccessCompleteCatalogImport1C('OnSuccessCatalogImport1C.log');
    }

    public static function OnCompleteCatalogImport1CHandler($arPropertyValues, $ABS_FILE_NAME)
    {
        self::OnSuccessCompleteCatalogImport1C('OnCompleteCatalogImport1C.log');
    }

    public static function OnSuccessCompleteCatalogImport1C($logFileName)
    {
        $dirFullPath = $_SERVER["DOCUMENT_ROOT"] . '/local/php_interface/logs';
        if (!is_dir($dirFullPath)) {
            mkdir($dirFullPath);
        }
        $flog = fopen($dirFullPath . '/' . $logFileName, 'a+');
        fwrite($flog, sprintf('%s - START OnCompleteCatalogImport1C' . "\n", date('d.m.Y H:i:s')));

        \First\Catalog::calcRetailPrices();
        \First\Seo::makeUniqProductsSymbolCodes();
        \First\Agents::reIndexSearch();
        \CBitrixComponent::clearComponentCache('bitrix:catalog.element');
        \CBitrixComponent::clearComponentCache('bitrix:catalog.section');

        fwrite($flog, sprintf('%s - END OnCompleteCatalogImport1C' . "\n", date('d.m.Y H:i:s')));
        fclose($flog);
    }

    public static function OnBasketUpdate($ID, $arFields)
    {
        // Добавить или удалить мелкооптовую упаковку -->
        \First\Catalog::addOrDelSwpInBasket();
        // <-- Добавить или удалить мелкооптовую упаковку
    }

    public static function OnBeforeBasketAdd($arFieldsBasket)
    {
        try {
            Loader::includeModule('iblock');
            Loader::includeModule('catalog');

            if (!empty($arFieldsBasket['PRODUCT_ID'])) {

                // Поиск главного товара у торгового предложения -->
                $mxResult = \CCatalogSku::GetProductInfo(
                    $arFieldsBasket['PRODUCT_ID']
                );
                if (is_array($mxResult)) {
                    $productId = $mxResult['ID'];
                } else {
                    $productId = $arFieldsBasket['PRODUCT_ID'];
                }
                // <--

                if (intval($productId) > 0) {
                    $arSelect = false;
                    $arFilter = array("ID" => $productId);
                    $res = \CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
                    if ($ob = $res->GetNextElement()) {
                        $arFields = $ob->GetFields();
                        $arFields['PROPERTIES'] = $ob->GetProperties();

                        // Неделимое количество в упаковке -->
                        $arFields['INDIVISIBLE_QUANTITY_IN_PACKAGE'] = 0;
                        //echo 'VALUE:';
                        //vardump($arResult['PROPERTIES']['CML2_TRAITS']);
                        if (!empty($arFields['PROPERTIES']['CML2_TRAITS']['VALUE'])) {
                            foreach ($arFields['PROPERTIES']['CML2_TRAITS']['VALUE'] as $key => $val) {
                                if ($arFields['PROPERTIES']['CML2_TRAITS']['DESCRIPTION'][$key] == 'НеделимаяУпаковка') {
                                    $arFields['INDIVISIBLE_QUANTITY_IN_PACKAGE'] = $val;
                                    break;
                                }
                            }
                        }
                        // <-- Неделимое количество в упаковке

                        // Ratio -->
                        if (intval($arFields['INDIVISIBLE_QUANTITY_IN_PACKAGE']) > 0) {
                            $curElementRatio = MeasureRatioTable::getList([
                                'filter' => [
                                    '=PRODUCT_ID' => $arFieldsBasket['PRODUCT_ID'],
                                ],
                            ]);

                            if ($arRatio = $curElementRatio->fetch()) {
                                MeasureRatioTable::update($arRatio['ID'], [
                                    'RATIO' => $arFields['INDIVISIBLE_QUANTITY_IN_PACKAGE'],
                                ]);
                            }
                        }
                        // <--
                    }
                }
            }
        } catch (\Bitrix\Main\SystemException $e) {

            $error = true;
            //die($e->getMessage());
            //vardump($e);

        }
    }

    public static function form_onBeforeResultAdd($WEB_FORM_ID, &$arFields, &$arrVALUES)
    {
        global $APPLICATION;
        // Форма Стать нашим партнером -->
        if ($WEB_FORM_ID == WEB_FORM_ID_BECOME_OUR_PARTNER) {
            if (RECAPTCHA_3_USE == 'Y') {
                if (!\First\General::recaptchaCheck()) {
                    $APPLICATION->ThrowException('Что-то пошло не так. Пожалуйста, повторите попытку позже');
                }

                /*
                $request = \Bitrix\Main\Context::getCurrent()->getRequest();
                $arPost = $request->getPostList()->toArray(); // массив post параметров

                // Составляем POST-запрос, чтобы получить от Google оценку reCAPTCHA v3
                $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
                $recaptcha_secret = RECAPTCHA_3_PRIVATE_KEY; // Insert your secret key here
                $recaptcha_response = $arPost['g-recaptcha-response'];

                // Выполняем POST-запрос
                $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);

                $recaptcha = json_decode($recaptcha);
                // Принимаем действие на основе возвращаемой оценки
                if ($recaptcha->success == true && $recaptcha->score >= 0.5 && $recaptcha->action == 'contact') {
                    // Это человек. Вставляем сообщение в базу данных или отправляем на электронную почту
                    //$success_output = "Your message sent successfully";
                } else {
                    // Оценка меньше 0.5 означает подозрительную активность. Возвращаем ошибку
                    //$error_output = "Something went wrong. Please try again later";
                    $APPLICATION->ThrowException('Что-то пошло не так. Пожалуйста, повторите попытку позже');
                }
                */
            }
        }
    }

    public static function form_onAfterResultAdd($WEB_FORM_ID, $RESULT_ID)
    {
        global $APPLICATION, $USER;
        \Bitrix\Main\Loader::includeModule('subscribe');
        // Форма Стать нашим партнером -->
        if ($WEB_FORM_ID == WEB_FORM_ID_BECOME_OUR_PARTNER) {
            $request = \Bitrix\Main\Context::getCurrent()->getRequest();
            $arPost = $request->getPostList()->toArray(); // массив post параметров

            $EMAIL = $arPost[WEB_FORM_BECOME_OUR_PARTNER_EMAIL_INPUT_NAME];
            $RUB_ID = DEFAULT_SUBSCRIBE_RUBRIC_ID;
            $FORMAT = 'html';

            if (!empty($arPost['subscription_popup']) && !empty($EMAIL) && !empty($RUB_ID)) {
                $arFields = array(
                    "USER_ID" => ($USER->IsAuthorized() ? $USER->GetID() : false),
                    "FORMAT" => ($FORMAT <> "html" ? "text" : "html"),
                    "EMAIL" => $EMAIL,
                    "ACTIVE" => "Y",
                    "RUB_ID" => $RUB_ID
                );
                $subscr = new \CSubscription;

                //can add without authorization
                $ID = $subscr->Add($arFields);
                if ($ID > 0)
                    \CSubscription::Authorize($ID);
                else
                    $strWarning = "Error adding subscription: " . $subscr->LAST_ERROR . "<br>";
            }
        }
    }
}
