<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Context,
    Bitrix\Main\Loader,
    Bitrix\Main\Web\Json,
    Bitrix\Main\UserTable;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $request = Context::getCurrent()->getRequest();
    $server = Context::getCurrent()->getServer();
    if (isset($_POST['LOGIN']) && !empty($_POST['LOGIN'])) {

        if (mb_strlen($_POST['LOGIN']) > LOGIN_MAX_LENGTH && intval(LOGIN_MAX_LENGTH) > 0) {
            echo json_encode(array('status' => false, 'error_text' => 'Длина ника превышает допустимую длину', 'USER_ALREADY_EXISTS' => false));
        } else {
            if (!isset($_POST['USER_ID']) || empty($_POST['USER_ID'])) {
                $dbUser = CUser::GetList(($by = "id"), ($order = "asc"), array("LOGIN" => $_POST['LOGIN']), array());
            } else {
                $dbUser = CUser::GetList(($by = "id"), ($order = "asc"), array("LOGIN" => $_POST['LOGIN'], "!ID" => $_POST['USER_ID']), array());
            }
            while ($arUser = $dbUser->GetNext()) {
                $id = $arUser["ID"];
            }

            // Проверим, есть ли другой юзер с таким логином -->
            if (strlen($_POST['LOGIN']) > 0 && strlen($_POST['USER_ID']) > 0) {
                $bOtherLoginPresent = false;
                $dbUser_2 = CUser::GetList(($by = "id"), ($order = "asc"), array("LOGIN" => $_POST['LOGIN'], "!ID" => $_POST['USER_ID']), array());
                if ($arUser = $dbUser->GetNext()) {
                    $bOtherLoginPresent = true;
                }
            }
            // <--

            if (isset($id) && $id) {
                echo json_encode(array('status' => false, 'error_text' => 'Пользователь с таким ником уже существует', 'USER_ALREADY_EXISTS' => true));
            } else {
                if (!empty($_POST['USER_ID'])) {
                    if (
                        empty($_POST['NO_CHANGE_LOGIN'])
                        || !$_POST['NO_CHANGE_LOGIN']
                        || $bOtherLoginPresent == true
                    ) {
                        $user = new CUser;
                        $fields = array(
                            "LOGIN" => $_POST['LOGIN'],
                        );
                        //global $USER;
                        if ($user->Update($_POST['USER_ID'], $fields)) {
                            echo json_encode(array('status' => true));
                        } else {
                            $strError = $user->LAST_ERROR;
                            echo json_encode(array('status' => false, 'error_text' => $strError));
                        }
                    } else {
                        echo json_encode(array('status' => true, 'USER_ALREADY_EXISTS' => false));
                    }
                } else {
                    echo json_encode(array('status' => false, 'error_text' => 'Не задан id пользователя', 'USER_ALREADY_EXISTS' => false));
                }
            }
        }
    } else {
        echo json_encode(array('status' => false, 'error_text' => 'Не задан ник пользователя', 'USER_ALREADY_EXISTS' => false));
    }
?>

<?
} else {
    http_response_code(405);
    die('Method not Allowed');
}
?>