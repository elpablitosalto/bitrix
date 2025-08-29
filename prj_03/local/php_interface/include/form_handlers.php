<?
use \Bitrix\Main\Loader;
use \Bitrix\Main\Web\Json;
use \Bitrix\Iblock;

// 41861 Обработка файлов в форме
AddEventHandler("form", "onAfterResultAdd", function ($WEB_FORM_ID, $RESULT_ID){
    if($WEB_FORM_ID == 8){
        $arFiles = [];
        if(!empty($_FILES["files"])){
            $max_size = \COption::GetOptionString("form", "MAX_FILESIZE");
            $upload_dir = \COption::GetOptionString("form", "NOT_IMAGE_UPLOAD_DIR");
            \CForm::GetDataByID($WEB_FORM_ID, $arForm, $arQuestions, $arAnswers, $arDropDown, $arMultiSelect);
            if(!empty($arAnswers["FILES"])){
                foreach ($arAnswers["FILES"] as $index => $arAnswer){
                    if(!empty($_FILES["files"]["tmp_name"][$index])) {
                        $originalName = $_FILES["files"]["name"][$index];
                        $arFile = [
                            "name" => $_FILES["files"]["name"][$index],
                            "full_path" => $_FILES["files"]["full_path"][$index],
                            "type" => $_FILES["files"]["type"][$index],
                            "tmp_name" => $_FILES["files"]["tmp_name"][$index],
                            "error" => $_FILES["files"]["error"][$index],
                            "size" => $_FILES["files"]["size"][$index],
                            "MODULE_ID" => "form",
                        ];
                        if($fileId = \CFile::SaveFile($arFile, $upload_dir, $max_size)){
                            $arFiles[] = $fileId;
                            $arFields = array(
                                "RESULT_ID" => $RESULT_ID,
                                "FORM_ID" => $WEB_FORM_ID,
                                "FIELD_ID" => $arAnswer["FIELD_ID"],
                                "ANSWER_ID" => $arAnswer["ID"],
                                "ANSWER_TEXT" => trim($arAnswer["MESSAGE"]),
                                "ANSWER_VALUE" => $arAnswer["VALUE"],
                                "USER_FILE_ID" => $fileId,
                            );
                            $arFields["USER_FILE_NAME"] = $originalName;
                            $arFields["USER_FILE_IS_IMAGE"] = "N";
                            $arFields["USER_FILE_HASH"] = md5(uniqid(mt_rand(), true) . time());
                            $arFields["USER_FILE_SIZE"] = $_FILES["files"]["size"][$index];
                            \CFormResult::AddAnswer($arFields);
                        }
                    }
                }
            }
        }
        // 41882
        $sendMail = "store@firstltd.ru";
        if(!empty($GLOBALS["USER"]->GetID()) && \CSite::InGroup([12])){
            $rsUser = \CUser::GetByID($GLOBALS["USER"]->GetID());
            if($arUser = $rsUser->Fetch()){
                if(!empty($arUser["UF_OPT_MANAGER"]) && is_array($arUser["UF_OPT_MANAGER"])){
                    foreach($arUser["UF_OPT_MANAGER"] as $managerId){
                        $rsManager = \CUser::GetByID($managerId);
                        if($arManager = $rsManager->Fetch()){
                            if(!empty($arManager["EMAIL"])){
                                $sendMail .= ",".$arManager["EMAIL"];
                            }
                        }
                    }
                }
            }
        }
        //
        $arValues = \CFormResult::GetDataByIDForHTML($RESULT_ID, "Y");
        $sendResult = \Bitrix\Main\Mail\Event::send([
            "EVENT_NAME" => "NEW_LOGO_REQUEST",
            "LID" => "s1",
            "C_FIELDS" => [
                "SEND_MAIL" => $sendMail,
                "USER_NAME" => $arValues["form_text_".$arQuestions["FIO"]["ID"]],
                "EMAIL" => $arValues["form_email_".$arQuestions["EMAIL"]["ID"]],
                "PHONE" => $arValues["form_text_".$arQuestions["PHONE"]["ID"]],
                "COMMENT" => $arValues["form_textarea_".$arQuestions["COMMENT"]["ID"]]
            ],
            "FILE" => $arFiles
        ]);
    }
    return true;
});