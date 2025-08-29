<?
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

require_once(__DIR__ . "/classes.php");

//echo "POST:";echo "<pre>";print_r($_POST);echo "</pre>";
//echo "_FILES:";echo "<pre>";print_r($_FILES);echo "</pre>";
$arResult = array();
$PICTURE_INPUT_NAME = "file";
$action = $_POST["action"];

// Отправка файла через dropzone -->
if ($action == "send_file") {

    // Сохранение данных -->
    //file_put_contents($_SERVER["DOCUMENT_ROOT"] . UPLOAD_DIR_PATH . "1.txt", "1");
    $ar_result = CPopupContestReg::UploadPicture(
        array(
            "PICTURE_INPUT_NAME" => $PICTURE_INPUT_NAME,
            "UPLOAD_DIR_PATH" => UPLOAD_DIR_PATH,
            "CONTEST_REG_MAX_FILE_SIZE" => CONTEST_REG_MAX_FILE_SIZE,
        )
    );
    // <-- Сохранение данных

    // Обработка результата -->
    $arResult["RESULT"] = $ar_result["RESULT"];
    if ($arResult["RESULT"] == "SUCCESS") {
        $arResult["CONTEST_UPLOAD_FILE_NAME"] = $ar_result["CONTEST_UPLOAD_FILE_NAME"];
    } else if ($arResult["RESULT"] == "ERROR") {
        foreach ($ar_result_save_info["arErrors"] as $key => $val) {
            $arResult["ERROR_HTML"] .= $val . "<br />";
        }
    }
    // <-- Обработка результата

    // Вывод результата -->
    {
        $json_str = json_encode($arResult, JSON_UNESCAPED_UNICODE);
        //ob_end_clean(); // Очистка буфера
        //header('Content-Type: application/json');
        echo $json_str;
        //exit();
    }
    // <-- Вывод результата   
}
// <-- Отправка файла через dropzone

if ($action == "send_form") {

    // Сохранение данных -->
    $ar_result_save_info = CPopupContestReg::SaveSendInfo(
        array(
            "POST" => $_POST,
            "PICTURE_INPUT_NAME" => $PICTURE_INPUT_NAME,
            "UPLOAD_DIR_PATH" => UPLOAD_DIR_PATH,
            "CONTEST_REG_MAX_FILE_SIZE" => CONTEST_REG_MAX_FILE_SIZE,
            //"IBLOCK_CODE" => $arParams["CONTEST_REG_IBLOCK_CODE"],
        )
    );
    // <-- Сохранение данных 

    // Обработка результата -->
    $arResult["RESULT"] = $ar_result_save_info["RESULT"];
    if ($arResult["RESULT"] == "SUCCESS") {
    } else if ($arResult["RESULT"] == "ERROR") {
        foreach ($ar_result_save_info["arErrors"] as $key => $val) {
            $arResult["ERROR_HTML"] .= $val . "<br />";
        }
    }
    // <-- Обработка результата

    // Вывод результата -->
    {
        $json_str = json_encode($arResult, JSON_UNESCAPED_UNICODE);
        //ob_end_clean(); // Очистка буфера
        //header('Content-Type: application/json');
        echo $json_str;
        //exit();
    }
    // <-- Вывод результата   
}

require_once($_SERVER["DOCUMENT_ROOT"] . BX_ROOT . "/modules/main/include/epilog_after.php");
?>