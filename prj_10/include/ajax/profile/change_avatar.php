<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Context,
    Bitrix\Main\Loader,
    Bitrix\Main\Web\Json,
    Bitrix\Main\UserTable;

function cleanDir($dir) {
    $files = glob($dir."*");
    $c = count($files);
    if (count($files) > 0) {
        foreach ($files as $file) {
            if (file_exists($file)) {
                unlink($file);
            }
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $request = Context::getCurrent()->getRequest();
    $server = Context::getCurrent()->getServer();

    //print_r($_POST);

    // Название <input type="file">
    $input_name = 'file';

// Разрешенные расширения файлов.
    $allow = array(
        'gif', 'jpeg', 'jpg', 'png', 'bmp', 'webp', 'GIF', 'JPEG', 'JPG', 'PNG', 'BMP', 'WEBP'
    );

// Запрещенные расширения файлов.
    $deny = array(

    );

// Директория куда будут загружаться файлы.
    if(!is_dir($_SERVER['DOCUMENT_ROOT'] . '/upload/user_avatars')) {
        mkdir($_SERVER['DOCUMENT_ROOT'] . '/upload/user_avatars', 0777, true);
    }

    if(!empty($_POST['USER_ID'])){
        if(!is_dir($_SERVER['DOCUMENT_ROOT'] . '/upload/user_avatars/' . $_POST['USER_ID'])) {
            mkdir($_SERVER['DOCUMENT_ROOT'] . '/upload/user_avatars/' . $_POST['USER_ID'], 0777, true);
        }
    } else {
        echo json_encode(array('status' => false, 'error_text' => 'Не задан пользователь', 'post' => 1));
        exit();
    }
    $path = $_SERVER['DOCUMENT_ROOT'] . '/upload/user_avatars/' . $_POST['USER_ID'] . '/';

    if(!is_dir($_SERVER['DOCUMENT_ROOT'] . '/upload/user_avatars/' . $_POST['USER_ID'] . '/tmp')) {
        mkdir($_SERVER['DOCUMENT_ROOT'] . '/upload/user_avatars/' . $_POST['USER_ID'] . '/tmp', 0777, true);
    }

    $path_tmp = $_SERVER['DOCUMENT_ROOT'] . '/upload/user_avatars/' . $_POST['USER_ID'] . '/tmp/';

    $error = $success = '';
    if (!isset($_FILES[$input_name])) {
        $error = 'Файл не загружен.';
    } else {
        $file = $_FILES[$input_name];

        // Проверим на ошибки загрузки.
        if (!empty($file['error']) || empty($file['tmp_name'])) {
            $error = 'Не удалось загрузить файл.';
        } elseif ($file['tmp_name'] == 'none' || !is_uploaded_file($file['tmp_name'])) {
            $error = 'Не удалось загрузить файл.';
        } else {
            // Оставляем в имени файла только буквы, цифры и некоторые символы.
            $pattern = "[^a-zа-яё0-9,~!@#%^-_\$\?\(\)\{\}\[\]\.]";
            $name = mb_eregi_replace($pattern, '-', $file['name']);
            $name = mb_ereg_replace('[-]+', '-', $name);
            $parts = pathinfo($name);

            if (empty($name) || empty($parts['extension'])) {
                $error = 'Недопустимый тип файла';
            } elseif (!empty($allow) && !in_array(strtolower($parts['extension']), $allow)) {
                $error = 'Недопустимый тип файла';
            } elseif (!empty($deny) && in_array(strtolower($parts['extension']), $deny)) {
                $error = 'Недопустимый тип файла';
            } else {
                //if(file_exists($path . $name)){
                    //unlink($path . $name);
                //}

                //if(file_exists($path_tmp . $name)){
                    //unlink($path_tmp . $name);
                //}

                cleanDir($path_tmp);
                cleanDir($path);

                if(!is_dir($_SERVER['DOCUMENT_ROOT'] . '/upload/user_avatars/' . $_POST['USER_ID'] . '/tmp')) {
                    mkdir($_SERVER['DOCUMENT_ROOT'] . '/upload/user_avatars/' . $_POST['USER_ID'] . '/tmp', 0777, true);
                }

                // Перемещаем файл в директорию.
                if (move_uploaded_file($file['tmp_name'], $path . $name)) {
                    // Далее можно сохранить название файла в БД и т.п.
                    $success = 'Файл «' . $name . '» успешно загружен.';

                    $user_photo_file = CFile::MakeFileArray($path . $name);
                    //$ledf = CFile::saveFile($legal_entity_details_file,$path);

                    $user = new CUser;
                    $fields = Array(
                        'PERSONAL_PHOTO' => $user_photo_file
                    );

                    if($user->Update($_POST['USER_ID'], $fields)){
                        echo json_encode(array('status' => true));
                    } else {
                        $error = $user->LAST_ERROR;
                        echo json_encode(array('status' => false, 'error_text' => $error));
                    }

                    exit;

                } else {
                    $error = 'Не удалось загрузить файл.';
                }
            }
        }
    }

// Вывод сообщения о результате загрузки.
    if (!empty($error)) {
        $error = $error;
        $data = array('status' => false, 'error_text' => $error);
    } else {
        $data = array('status' => true);
    }


    //header('Content-Type: application/json');
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit();

    ?>

    <?
} else {
    http_response_code(405);
    die('Method not Allowed');
}
?>