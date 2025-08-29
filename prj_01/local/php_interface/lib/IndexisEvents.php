<?
class IndexisEvents
{
    public static function OnBeforeEventAddHandler(&$event, &$lid, &$arFields, &$messageId, &$files, &$languageId)
    {
        //замена email для формы
        if (isset($arFields["RS_FORM_ID"]) && $arFields["RS_FORM_ID"] == 1) {

            if ($arFields["SIMPLE_QUESTION_617_RAW"] == "Вопросы сервиса и обслуживания") {
                $arFields["EMAIL_TO"] = "customer2@dirui.com.ru";
            } elseif ($arFields["SIMPLE_QUESTION_617_RAW"] == "Приобрести продукцию") {
                $arFields["EMAIL_TO"] = "coordinator@dirui.com.ru";
            } else {
                $arFields["EMAIL_TO"] = "Info@dirui.com.ru";
            }
        }
    }

    public static function OnAfterUserRegisterHandler(&$arFields)
    {
        $arEventFields = $arFields;
        $arFiles = array();
        CEvent::Send('NEW_USER', "s1", $arEventFields, 'Y', '', $arFiles);

        $sendTemplate = 'NEW_USER_CONFIRM_CUSTOM';
        $arEventFields_2 = $arFields;
        if (intval($arFields["ID"]) > 0) {
            $arEventFields_2["USER_ID"] = $arFields["ID"];
        }
        if (strlen($arFields["UF_PARTNER"]) > 0) {
            $sendTemplate = 'NEW_USER_PARTNER';
        }
        if (empty($arEventFields_2["USER_ID"]) && !empty($arEventFields_2["LOGIN"])) {
            $rsUser = CUser::GetByLogin($arEventFields_2["LOGIN"]);
            $arUser = $rsUser->Fetch();
            $arEventFields_2["USER_ID"] = $arUser['ID'];
        }
        CEvent::SendImmediate($sendTemplate, "s1", $arEventFields_2);

        file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/local/tmp/OnAfterUserRegisterHandler.txt", print_r($arEventFields_2, true));
    }

    public static function OnAfterUserAddHandler(&$arFields)
    {
        if ($arFields["ID"] > 0) {
            if (strlen($arFields["UF_PARTNER"]) > 0) {
                $arGroups = CUser::GetUserGroup($arFields["ID"]);
                $arGroups[] = 8;
                CUser::SetUserGroup($arFields["ID"], $arGroups);
            }
        }

        //file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/local/tmp/OnAfterUserAddHandler.txt", print_r($arFields, true));
    }

    public static function OnBeforeUserUpdateHandler(&$arFields)
    {
        if ($arFields["ID"] > 0) {
            $rsUser = CUser::GetByID($arFields["ID"]);
            $arUser = $rsUser->Fetch();

            $arGroups = CUser::GetUserGroup($arFields["ID"]);

            //file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/local/tmp/OnBeforeUserUpdateHandler_arUser.txt", print_r($arUser, true));
            //file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/local/tmp/OnBeforeUserUpdateHandler_arGroups.txt", print_r($arGroups, true));
            //file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/local/tmp/OnBeforeUserUpdateHandler_arFields.txt", print_r($arFields, true));

            if ($arUser['ACTIVE'] != 'Y' && $arFields["ACTIVE"] == 'Y' && in_array(8, $arGroups) /*&& $arFields["UF_PARTNER"] == 'Y'*/) {
                $GLOBALS['PARTNER_ACTIVE'] = 'Y';
            }
        }

        //file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/local/tmp/OnBeforeUserUpdateHandler.txt", print_r($arFields, true));
    }

    public static function OnAfterUserUpdateHandler(&$arFields)
    {
        if ($arFields["ID"] > 0) {
            if ($arFields["RESULT"]) {
                if ($GLOBALS['PARTNER_ACTIVE'] == 'Y') {
                    //$arEventFields_2 = $arFields;
                    $arEventFields_2 = array(
                        'EMAIL' => $arFields['EMAIL'],
                        'USER_ID' => $arFields["ID"],
                        'NAME' => $arFields["NAME"],
                        'LAST_NAME' => $arFields["LAST_NAME"],
                        'CHECKWORD' => $arFields["CHECKWORD"],
                        'LOGIN' => $arFields["LOGIN"],
                    );
                    $siteId = "s1";
                    $res = CEvent::SendImmediate("NEW_USER_PARTNER_CONFIRM", $siteId, $arEventFields_2);

                    $arEventFields_2['RES'] = $res;

                    file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/local/tmp/NEW_USER_PARTNER_CONFIRM.txt", print_r($arEventFields_2, true));
                }
            }
        }

        //file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/local/tmp/OnAfterUserUpdateHandler.txt", print_r($arFields, true));
    }

    public static function OnBeforeUserRegisterHandler(&$args)
    {
        if (!empty($args['EMAIL'])) {
            $args['LOGIN'] = $args['EMAIL'];
        }
        return true;
    }
}
