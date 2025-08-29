<?
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

require_once(__DIR__ . "/classes.php");

//echo "_POST:";echo "<pre>";print_r($_POST);echo "</pre>";

$arResult = array();
$PICTURE_INPUT_NAME = "file";
$arResult["POST"] = $_POST;

// Отправка файла через dropzone -->
if ($action == "send_file") {

    // Сохранение данных -->
    $ar_result = CModalContestWorksSlidesComponent::UploadPicture(
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
        $arResult["UPLOAD_FILE_NAME"] = $ar_result["UPLOAD_FILE_NAME"];
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
    $ar_result_save_info = CModalContestWorksSlidesComponent::SaveSendInfo(
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