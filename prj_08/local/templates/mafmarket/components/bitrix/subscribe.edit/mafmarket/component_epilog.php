
<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Sale\Internals;

CModule::IncludeModule("catalog");
CModule::IncludeModule("iblock");
CModule::IncludeModule("sale");

//vardump($_REQUEST);
//echo 'REQUEST_METHOD = ' . $_SERVER["REQUEST_METHOD"] . '<br />';
//echo 'check_bitrix_sessid = ' . check_bitrix_sessid() . '<br />';
//vardump($_GET);
//vardump($_REQUEST);

//if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_REQUEST["PostAction"]) && check_bitrix_sessid()) {
$S_ID = $_GET['ID'];
if (intval($S_ID) > 0 && $_GET['mess_code'] == 'SENT') {

    // Параметры подписки -->
    $obSubscription = new CSubscription;
    $arSubscription = array();

    $arFilter['ID'] = $S_ID;
    $arFilter['!CONFIRMED'] = 'Y';
    $res = $obSubscription->GetList(array(), $arFilter, false);
    if ($arFields = $res->GetNext()) {
        //$arFields = $ob->GetFields();
        //vardump($arFields);
        $arSubscription = $arFields;
    }
    // <-- Параметры подписки

    // Подписка подтверждена -->
    if (!empty($arSubscription)) {
        $obSubscription->Update($S_ID, array("CONFIRMED" => 'Y'));
    }
    // <-- Подписка подтверждена

    /*
    // Новый купон -->
    if (!empty($arSubscription)) {
        $IBLOCK_ID = Indexis::getIblockId('coupons', 'service');
        $bAddCoupon = false;

        if (intval($IBLOCK_ID) > 0 && !empty($arSubscription)) {
            if (strlen($arSubscription['EMAIL']) > 0) {
                $bAddCoupon = true;
                $arSelect = array("ID", "NAME", "PROPERTY_EMAIL");
                $arFilter = array(
                    "IBLOCK_ID" => $IBLOCK_ID,
                    "ACTIVE_DATE" => "Y",
                    "ACTIVE" => "Y",
                    "PROPERTY_EMAIL" => $arSubscription['EMAIL'],
                );
                $res = CIBlockElement::GetList(array(), $arFilter, false, array("nPageSize" => 50), $arSelect);
                if ($ob = $res->GetNextElement()) {
                    $arFields = $ob->GetFields();
                    $bAddCoupon = false;
                }
            }
        }

        if ($bAddCoupon == true) {
            $discountID = $GLOBALS['arSiteConfig']['BASKET']['DISCOUNT_SUBSCRIBE_COUPON_RULE_ID'];
            // генерируем новый код купона
            $codeCoupon = CatalogGenerateCoupon();

            $couponFields = array(
                "DISCOUNT_ID" => $discountID, // ID правила скидок
                "COUPON" => $codeCoupon,
                "ACTIVE" => "Y",
                "TYPE" => 2,
                "MAX_USE" => 0,
            );
            $USER_ID = $USER->GetID();
            if (intval($USER_ID) > 0) {
                $couponFields["USER_ID"] = $USER_ID;
            }

            // добавляем новый купон
            $addCouponRes = Internals\DiscountCouponTable::add($couponFields);
            if ($addCouponRes->isSuccess()) {
                $el = new CIBlockElement;
                $PROP = array();
                $PROP['EMAIL'] = $arSubscription['EMAIL'];
                if (intval($USER_ID) > 0) {
                    $PROP["USER"] = $USER_ID;
                }
                $arLoadProductArray = Array(  
                    "MODIFIED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем  
                    "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела  
                    "IBLOCK_ID"      => $IBLOCK_ID,  
                    "PROPERTY_VALUES"=> $PROP,  
                    "NAME"           => $codeCoupon,  
                    "ACTIVE"         => "Y",            // активен  
                );
                if($PRODUCT_ID = $el->Add($arLoadProductArray))
                {
                }
            }
        }
    }
    // <-- Новый купон
    */

    // Отправить письма -->
    if (!empty($arSubscription)) {
        if (strlen($arSubscription['EMAIL']) > 0) {
            $arEventFields = array('EMAIL' => $arSubscription['EMAIL']);
            CEvent::Send('NEW_SUBSCRIBER', SITE_ID, $arEventFields, 'Y', '', $arFiles);

            /*
            if (strlen($codeCoupon) > 0) {
                $arEventFields['COUPON'] = $codeCoupon;
                CEvent::Send('NEW_SUBSCRIBER_COUPON', SITE_ID, $arEventFields, 'Y', '', $arFiles);
            }
            */
        }
    }
    // <-- Отправить письма
} else if (intval($S_ID) > 0 && $_GET['mess_code'] == 'UNSUBSCRIBE' && strlen($_GET['_back_url']) > 0) {
    $obSubscription = new CSubscription;
    $obSubscription->Delete($S_ID);
    //echo '!';
    //die();
    LocalRedirect(urldecode($_GET['_back_url']));
}

if (strlen($arParams['H1_TITILE_IN_EPILOG']) > 0) {
}

?>