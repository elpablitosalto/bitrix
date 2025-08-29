<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
// меняем порядок следования полей
$arResult['SHOW_FIELDS'] = array('NAME', 'LAST_NAME', 'WORK_COMPANY', "WORK_POSITION", 'PERSONAL_MOBILE', 'EMAIL', "PASSWORD", "CONFIRM_PASSWORD");

//vardump($arResult);

// Ошибки -->
$arErrorsTmp = array();
foreach ($arResult["ERRORS"] as $key => $error) {
    $bAdd = true;

    if (intval($key) == 0 && $key !== 0) {
        $arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "&quot;" . GetMessage("REGISTER_FIELD_" . $key) . "&quot;", $error);
    }

    if (strpos($error, 'Пользователь с таким email') !== false) {
        //$bAdd = true;

        $userActive = '';
        if (!empty($arResult['VALUES']['LOGIN'])) {
            $rsUser = CUser::GetByLogin($arResult['VALUES']['LOGIN']);
            $arUser = $rsUser->Fetch();
            $userActive = $arUser['ACTIVE'];
        }

        if ($userActive == 'Y') {
            $error = 'Пользователь с таким email уже существует. Для входа воспользуйтесь <a class="user-error" href="' . $GLOBALS["arSiteConfig"]["LINKS"]['AUTH'] . '">формой авторизации</a>.';
        } else {
            $error = 'Мы уже получили заявку на регистрацию с таким email. Если этот email принадлежит вам, но вы не отправляли заявку, то напишите в поддержку по адресу ' . $GLOBALS['arSiteConfig']['CONTACT']['SUPPORT_EMAIL'] . ' или позвоните по телефону ' . $GLOBALS['arSiteConfig']['CONTACT']['SUPPORT_PHONE'] . '';
        }
        //$error = html_entity_decode($error);
    }

    /*
    if (strpos($error, 'Пользователь с логином') !== false) {
        $bAdd = false;
    }
    */

    if ($bAdd == true) {
        $arErrorsTmp[$key] = $error;
    }
}
$arResult["ERRORS"] = $arErrorsTmp;
// <-- Ошибки


// Сгенерированный пароль -->
$arResult['PASSWORD_GEN'] = Indexis::genPassword();
// <-- Сгенерированный пароль
