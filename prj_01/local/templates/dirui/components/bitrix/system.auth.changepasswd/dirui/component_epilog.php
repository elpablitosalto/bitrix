<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if ($arResult['bNoError'] == true) {
    if (!empty($arResult['LAST_LOGIN'])) {

        $rsUser = CUser::GetByLogin($arResult['LAST_LOGIN']);
        $arUser = $rsUser->Fetch();

        if (!empty($arUser['EMAIL'])) {

            $arEventFields = array(
                'EMAIL' => $arUser['EMAIL'],
            );
            $siteId = "s1";
            //$res = CEvent::SendImmediate("USER_INFO", $siteId, $arEventFields);
            $res = CEvent::Send("CHANGE_PASSWORD", $siteId, $arEventFields);

            /*
            file_put_contents(
                $_SERVER["DOCUMENT_ROOT"] . "/local/tmp/OnAfterUserChangePassword.txt",
                print_r($arEventFields, true)
            );
            file_put_contents(
                $_SERVER["DOCUMENT_ROOT"] . "/local/tmp/OnAfterUserChangePassword_2.txt",
                print_r($arResult, true)
            );
            file_put_contents(
                $_SERVER["DOCUMENT_ROOT"] . "/local/tmp/OnAfterUserChangePassword_3.txt",
                print_r($APPLICATION->arAuthResult, true)
            );
            */
        }
    }
}
