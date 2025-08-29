<?
class CPersonal
{
    public static function getUser($arParams = array())
    {
        global $USER;

        $arResult = array();
        $USER_ID = $USER->GetID();
        if (!empty($USER_ID)) {
            $rsUser = CUser::GetByID($USER_ID);
            $arUser = $rsUser->Fetch();

            $arResult['arUser'] = $arUser;
        }

        // Имя Отчество -->
        $arResult['arUser']['IO'] = '';
        if (!empty($arResult['arUser']['NAME'])) {
            $arResult['arUser']['IO'] = $arResult['arUser']['NAME'];
            if (!empty($arResult['arUser']['SECOND_NAME'])) {
                $arResult['arUser']['IO'] .= ' '.$arResult['arUser']['SECOND_NAME'];
            }
        }
        // <-- Имя Отчество

        $arResultFunc = CPersonal::isPartner();
        $arResult['arUser']['isPartner'] = $arResultFunc['isPartner'];

        // Количество товаров в корзине -->
        if( $arResult['arUser']['isPartner'] )
        {
            $arResultFunc = COrder::getCountInBasket(array(
                'USER_ID' => $arResult['arUser']['ID'],
            ));
            $countBasketItems = $arResultFunc['countBasketItems'];
            $countBasketItemsStr = $arResultFunc['countBasketItemsStr'];
            $arResult['arUser']['countBasketItems'] = $countBasketItems;
            $arResult['arUser']['countBasketItemsStr'] = $countBasketItemsStr;
        }
        // <-- Количество товаров в корзине

        $arResult['arUser']['isAdmin'] = $USER->IsAdmin();
        $arResult['arUser']['isAuthorized'] = $USER->IsAuthorized();

        return $arResult;
    }

    public static function getHello($arParams = array())
    {
        global $USER;

        $arResult = array();

        $USER_ID = $USER->GetID();
        if (!empty($USER_ID)) {
            $hello = 'Здравствуйте';
            $rsUser = CUser::GetByID($USER_ID);
            $arUser = $rsUser->Fetch();
            if (!empty($arUser['NAME'])) {
                $hello .= ', ' . $arUser['NAME'];
            }
            $hello .= '!';

            $arResult['hello'] = $hello;
        }

        return $arResult;
    }

    public static function isPartner($arParams = array())
    {
        global $USER;

        $arResult = array();

        $arResult['isPartner'] = false;
        $USER_ID = $USER->GetID();
        if (!empty($USER_ID)) {
            $arGroups = CUser::GetUserGroup($USER_ID);

            //vardump($arGroups);
            //vardump($GLOBALS['arSiteConfig']['USER']);
            //echo 'in_array = '.in_array($GLOBALS['arSiteConfig']['USER']['PARTNER_GROUP'], $arGroups).'<br />';

            if (in_array($GLOBALS['arSiteConfig']['USER']['PARTNER_GROUP'], $arGroups)) {
                $arResult['isPartner'] = true;
            }
        }

        //vardump($arResult);

        return $arResult;
    }
}
