<?
class CModalContestWorksSlidesComponent
{
    static function SaveSendInfo($arParams)
    {
        $arResult = array();

        $UPLOAD_DIR_PATH = $arParams["UPLOAD_DIR_PATH"];
        if (strlen($UPLOAD_DIR_PATH) <= 0) {
            $UPLOAD_DIR_PATH = '/upload/temp/';
        }

        // Проверка отправлена ли форма -->
        if (empty($arResult["arErrors"])) {
            $arResult["SEND_FORM"] = "N";
            if ($arParams["POST"]["SEND_FORM"] == "Y") {
                $arResult["SEND_FORM"] = "Y";
            }
        }
        // <-- Проверка отправлена ли форма

        // Код инфоблока -->
        if (empty($arResult["arErrors"])) {
            $arResult["IBLOCK_CODE"] = $arParams["IBLOCK_CODE"];
            if (strlen($arResult["IBLOCK_CODE"]) <= 0) {
                $arResult["IBLOCK_CODE"] = $arParams["POST"]["IBLOCK_CODE"];
            }
            if (strlen($arResult["IBLOCK_CODE"]) <= 0) {
                $arResult["arErrors"][] = "Не указан код инфоблока";
            }
        }
        // <-- Код инфоблока

        // -->
        if (empty($arResult["arErrors"])) {
            if ($arResult["SEND_FORM"] != "Y") {
                $arResult["arErrors"][] = "Ошибка отправки формы";
            }
        }
        // <--

        // Данные конкурса -->
        if (intval($arParams["POST"]["CUR_WORK_ELEMENT_ID"]) > 0) {
            $arSelect = false;
            $arFilter = array(
                "ID" => $arParams["POST"]["CUR_WORK_ELEMENT_ID"],
            );
            $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
            if ($ob = $res->GetNextElement()) {
                $arFields = $ob->GetFields();
                $arFields["PROPERTIES"] = $ob->GetProperties();

                //echo "arFields:";echo "<pre>";print_r($arFields);echo "</pre>";

                // Проверка конкурса на даты -->
                {
                    $ar_result = CModalContestWorksSlidesComponent::ContestCheckDates(
                        array(
                            "DATE_START" => $arFields["PROPERTIES"]["DATE_START"]["VALUE"],
                            "DATE_END" => $arFields["PROPERTIES"]["DATE_END"]["VALUE"],
                        )
                    );
                    $arResult["CONTEST_START"] = $ar_result["CONTEST_START"];
                    $arResult["CONTEST_END"] = $ar_result["CONTEST_END"];
                    if ($arResult["CONTEST_END"] == "N") {
                        $arResult["arErrors"][] = "Конкурс ещё не закончился";
                    }
                }
                // <-- Проверка конкурса на даты

                if (empty($arResult["arErrors"])) {
                    $arResult["arContest"] = array(
                        "ELEMENT_ID" => $arFields["ID"],
                        //"DATE_START" => $arFields["PROPERTIES"]["DATE_START"]["VALUE"],
                        //"DATE_END" => $arFields["PROPERTIES"]["DATE_END"]["VALUE"],
                    );
                }
            } else {
                $arResult["arErrors"][] = "Конкурс не найден";
            }
        }
        // <-- Данные конкурса 

        // Подготовка данных -->
        if (empty($arResult["arErrors"])) {
            $arData = array();
            $arData["FIELDS_VALUES"]["ID"] = $arParams["POST"]["CUR_WORK_ELEMENT_ID"];
            $arData["PROPERTY_VALUES"]["PHOTO_WITH_PRIZE_SOURCE"]
                = $_SERVER["DOCUMENT_ROOT"] . $UPLOAD_DIR_PATH . $arParams["POST"]["PHOTO_PRIZE_UPLOAD_FILE_NAME"];
        }
        // <-- Подготовка данных

        // Валидация -->
        if (empty($arResult["arErrors"])) {
            $ar_result = CModalContestWorksSlidesComponent::Validate(
                array(
                    "arData" => $arData,
                    "CONTEST_REG_MAX_FILE_SIZE" => $arParams["CONTEST_REG_MAX_FILE_SIZE"],
                )
            );
            if ($ar_result["RESULT"] == "SUCCESS") {
            } else if ($ar_result["RESULT"] == "ERROR") {
                foreach ($ar_result["arErrors"] as $key => $val) {
                    $arResult["arErrors"][] = $val;
                }
            }
        }
        // <-- Валидация

        // Сохранение данных -->
        if (empty($arResult["arErrors"])) {
            $ar_params = array(
                "IBLOCK_CODE" => $arResult["IBLOCK_CODE"],
                "arData" => $arData,
            );
            //$this->AddDataToIblock($ar_params);
            //file_put_contents( $_SERVER["DOCUMENT_ROOT"] . UPLOAD_DIR_PATH . "1.txt", $arResult["IBLOCK_CODE"]."-333" );
            $ar_result = CModalContestWorksSlidesComponent::AddDataToIblock($ar_params);
            foreach ($ar_result["arErrors"] as $key => $val) {
                $arResult["arErrors"][] = $val;
            }
        }
        // <-- Сохранение данных

        // -->
        if (empty($arResult["arErrors"])) {
            $arResult["RESULT"] = "SUCCESS";
        } else {
            $arResult["RESULT"] = "ERROR";
        }
        // <--

        return $arResult;
    }

    static function AddDataToIblock($arParams)
    {
        $arResult = array();

        $arData = $arParams["arData"];
        $IBLOCK_CODE = $arParams["IBLOCK_CODE"];

        // Определение ID инфоблока -->
        if (strlen($IBLOCK_CODE) > 0) {
            $res = CIBlock::GetList(array(), array('CODE' => $IBLOCK_CODE), false);
            if ($ar_res = $res->Fetch()) {
                $IBLOCK_ID = $ar_res["ID"];
            }
        }
        // <-- Определение ID инфоблока

        // ID элемента -->
        $ELEMENT_ID = $arData["FIELDS_VALUES"]["ID"];
        // <-- ID элемента

        //file_put_contents( $_SERVER["DOCUMENT_ROOT"] . UPLOAD_DIR_PATH . "1.txt", $ELEMENT_ID."-444" );
        //file_put_contents( $_SERVER["DOCUMENT_ROOT"] . UPLOAD_DIR_PATH . "1.txt", $IBLOCK_ID."-555" );

        if (intval($IBLOCK_ID) > 0 && intval($ELEMENT_ID) > 0) {
            //$el = new CIBlockElement;

            $PICTURE_SOURCE = $arData["PROPERTY_VALUES"]["PHOTO_WITH_PRIZE_SOURCE"];
            if (!is_file($PICTURE_SOURCE)) {
                $arResult["arErrors"][] = "Нет исходного файла";
            }

            if (empty($arResult["arErrors"])) {

                $PICTURE = CFile::MakeFileArray($PICTURE_SOURCE);
                CIBlockElement::SetPropertyValuesEx(
                    $ELEMENT_ID,
                    $IBLOCK_ID,
                    array("PHOTO_WITH_PRIZE" => $PICTURE)
                );
            }

            // Проверим загрузился ли файл -->
            if (empty($arResult["arErrors"])) {
                $arSelect = false;
                $arFilter = array(
                    "IBLOCK_ID" => $IBLOCK_ID,
                    "ID" => $ELEMENT_ID,
                );
                $arOrder = array("id" => "desc");
                $res = CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelect);
                if ($ob = $res->GetNextElement()) {
                    $arFields = $ob->GetFields();
                    $arFields["PROPERTIES"] = $ob->GetProperties();

                    $file_id = $arFields["PROPERTIES"]["PHOTO_WITH_PRIZE"]["VALUE"];
                    $file_path = $_SERVER["DOCUMENT_ROOT"] . CFile::GetPath($file_id);

                    if (!is_file($file_path)) {
                        $arResult["arErrors"][] = "Нет удалось записать файл в БД";
                    }
                }

            }
            // <-- 
            unlink($PICTURE_SOURCE);
        }

        if (empty($arResult["arErrors"])) {
            $arResult["RESULT"] = "SUCCESS";
        } else {
            $arResult["RESULT"] = "ERROR";
        }

        return $arResult;
    }


    static function Validate($arParams)
    {
        $arResult = array();
        $arData = $arParams["arData"];

        $CONTEST_REG_MAX_FILE_SIZE = $arParams["CONTEST_REG_MAX_FILE_SIZE"];
        if (strlen($CONTEST_REG_MAX_FILE_SIZE) <= 0) {
            $CONTEST_REG_MAX_FILE_SIZE = (10 * 1024 * 1024);
        }
        $allowedPictureTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG);
        //$allowedPictureTypes = array(IMAGETYPE_PNG);

        // Картинка -->
        if (strlen($arData["PROPERTY_VALUES"]["PHOTO_WITH_PRIZE_SOURCE"]) <= 0) {
            $arResult["arErrors"][] = "Необходимо загрузить изображение";
        } else if (!is_file($arData["PROPERTY_VALUES"]["PHOTO_WITH_PRIZE_SOURCE"])) {
            $arResult["arErrors"][] = "Файл не удалось загрузить на сайт";
        } else {
            $arFile = CFile::MakeFileArray($arData["PROPERTY_VALUES"]["PHOTO_WITH_PRIZE_SOURCE"]);
            if ($arFile["size"] > $CONTEST_REG_MAX_FILE_SIZE) {
                $arResult["arErrors"][] = "Файл превысил допустимый вес";
            } else {
                $detectedType = exif_imagetype($arData["PROPERTY_VALUES"]["PHOTO_WITH_PRIZE_SOURCE"]);
                if (!in_array($detectedType, $allowedPictureTypes)) {
                    $arResult["arErrors"][] = "Загружен файл недопустимого типа";
                }
            }
        }
        // <-- Картинка
        //$arResult["arErrors"][] = "Необходимо указать Согласие с правилами конкурса";

        // -->
        if (empty($arResult["arErrors"])) {
            $arResult["RESULT"] = "SUCCESS";
        } else {
            $arResult["RESULT"] = "ERROR";
        }
        // <--

        return $arResult;
    }

    static function GetContestWorks($arParams)
    {
        $arResult = array();

        //echo "arParams:";echo "<pre>";print_r($arParams);echo "</pre>";
        if (
            strlen($arParams["CONTEST_ELEMENT_ID"]) <= 0
            && ($arParams["MODE"] == "WINNERS" || $arParams["MODE"] == "PARTICIPANTS")
        ) {
            return;
        }


        if
        (
            strlen($arParams["CONTEST_WORKS_IBLOCK_CODE"]) > 0
            //&& intval($arParams["CONTEST_ELEMENT_ID"]) > 0
        ) {
            // Определение ID инфоблока конкурсных работ -->
            if (strlen($arParams["CONTEST_WORKS_IBLOCK_CODE"]) > 0) {
                $res = CIBlock::GetList(array(), array('CODE' => $arParams["CONTEST_WORKS_IBLOCK_CODE"]), false);
                if ($ar_res = $res->Fetch()) {
                    $IBLOCK_ID = $ar_res["ID"];
                }
            }
            // <-- Определение ID инфоблока конкурсных работ

            // Определение ID инфоблока конкурсов -->
            if (strlen($arParams["CONTESTS_IBLOCK_CODE"]) > 0) {
                $res = CIBlock::GetList(array(), array('CODE' => $arParams["CONTESTS_IBLOCK_CODE"]), false);
                if ($ar_res = $res->Fetch()) {
                    $CONTESTS_IBLOCK_ID = $ar_res["ID"];
                }
            }
            // <-- Определение ID инфоблока конкурсов

            // Список значений свойства "Победитель" -->
            if (intval($IBLOCK_ID) > 0) {
                $arEnumParams = array();
                $property_enums = CIBlockPropertyEnum::GetList(
                    array("DEF" => "DESC", "SORT" => "ASC"),
                    array(
                        "IBLOCK_ID" => $IBLOCK_ID,
                        "CODE" => "WINNER"
                    )
                );
                while ($enum_fields = $property_enums->GetNext()) {
                    $arEnumParams[$enum_fields["XML_ID"]] = $enum_fields;
                }
            }
            // <-- Список значений свойства "Победитель"

            // Список конкурсов -->
            $arContestsEndIds = array();
            if (strlen($arParams["CONTESTS_IBLOCK_CODE"]) > 0) {
                $ar_result = Multilandia::GetListContests(
                    array(
                        "IBLOCK_CODE" => $arParams["CONTESTS_IBLOCK_CODE"],
                    )
                );
                $arContestsEndIds = $ar_result["arContestsEndIds"];
                $arContests = $ar_result["arContests"];
            }
            // <-- Список конкурсов

            //vardump($arContests, false);

            $arSelect = false;
            $arFilter = array(
                "IBLOCK_CODE" => $arParams["CONTEST_WORKS_IBLOCK_CODE"],
            );
            // Фильтр по конкурсу -->
            if (intval($arParams["CONTEST_ELEMENT_ID"]) > 0) {
                $arFilter["PROPERTY_CONTEST"] = $arParams["CONTEST_ELEMENT_ID"];
            }
            // <-- Фильтр по конкурсу  

            // Фильтр по победителям -->
            if (intval($arEnumParams["Y"]["ID"]) > 0) {
                if ($arParams["MODE"] == "ALL_WINNERS" && !empty($arContestsEndIds)) {
                    $arFilter["PROPERTY_WINNER"] = $arEnumParams["Y"]["ID"];
                    $arFilter["PROPERTY_CONTEST"] = $arContestsEndIds;
                } else if ($arParams["CONTEST_END"] == "Y") {
                    if ($arParams["WINNERS"] == "Y") {
                        $arFilter["PROPERTY_WINNER"] = $arEnumParams["Y"]["ID"];
                    } else if ($arParams["WINNERS"] == "N") {
                        //$arFilter["!PROPERTY_WINNER_ENUM_ID"] = $arEnumParams["Y"]["ID"];
                    }
                }
            }
            // <-- Фильтр по победителям

            // Фильтр по текущим работам пользователя -->
            if( $arParams["MODE"] == "CURRENT_USER" && intval( $arParams["USER_ID"] ) > 0 )
            {
                $arFilter["PROPERTY_USER_ID"] = $arParams["USER_ID"];    
            }
            // <--

            //echo "arFilter:"; echo "<pre>"; print_r($arFilter); echo "</pre>";
            $arOrder = array("id" => "desc");
            //$arOrder = array();
            $res = CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelect);
            while ($ob = $res->GetNextElement()) {
                $arFields = $ob->GetFields();
                $arFields["PROPERTIES"] = $ob->GetProperties();

                //echo "arFields:";echo "<pre>";print_r($arFields);echo "</pre>";

                // Картинка -->
                $PREVIEW_PICTURE_ID = $arFields["PREVIEW_PICTURE"];
                $PHOTO_WITH_PRIZE = $arFields["PROPERTIES"]["PHOTO_WITH_PRIZE"]["VALUE"];
                if (intval($PHOTO_WITH_PRIZE) > 0) {
                    $PREVIEW_PICTURE_ID = $PHOTO_WITH_PRIZE;
                }
                $PREVIEW_PICTURE_PATH = CFile::GetPath($PREVIEW_PICTURE_ID);
                // <-- Картинка

                // Имя, фамилия участника -->
                $PARTICIPANT_FIRST_NAME = $arFields["PROPERTIES"]["PARTICIPANT_FIRST_NAME"]["VALUE"];
                $PARTICIPANT_LAST_NAME = $arFields["PROPERTIES"]["PARTICIPANT_LAST_NAME"]["VALUE"];
                if (strlen($PARTICIPANT_FIRST_NAME) > 0 && strlen($PARTICIPANT_LAST_NAME) > 0) {
                    $PARTICIPANT_FULL_NAME = $PARTICIPANT_FIRST_NAME . " " . $PARTICIPANT_LAST_NAME;
                } else {
                    $PARTICIPANT_FULL_NAME = $arFields["NAME"];
                }
                // <-- Имя, фамилия участника    

                // Кол-во голосов -->
                $arVoted = $arFields["PROPERTIES"]["VOTED"]["VALUE"];
                if (!is_array($arVoted)) {
                    $arVoted = array();
                }
                // <-- Кол-во голосов

                // Описание -->
                $DESCRIPTION = $arFields["PREVIEW_TEXT"];
                // <-- Описание

                // Завершён ли конкурс у этой работы -->
                $CONTEST_END = "N";
                if (
                    $arParams["CONTEST_END"] == "Y"
                    || in_array($arFields["PROPERTIES"]["CONTEST"]["VALUE"], $arContestsEndIds)
                ) {
                    $CONTEST_END = "Y";
                }
                // <-- 

                // Название конкурса -->
                $CONTEST_ID = $arFields["PROPERTIES"]["CONTEST"]["VALUE"];
                if (intval($CONTEST_ID) > 0) {
                    $CONTEST_NAME = $arContests[$CONTEST_ID]["NAME"];
                }
                // <-- Название конкурса

                //echo "CONTEST_NAME = ";vardump($CONTEST_NAME);

                $arResult["arContestWorks"][$arFields["ID"]] = array(
                    "ELEMENT_ID" => $arFields["ID"],
                    "PREVIEW_PICTURE_PATH" => $PREVIEW_PICTURE_PATH,
                    "PARTICIPANT_FULL_NAME" => $PARTICIPANT_FULL_NAME,
                    //"COUNT_VOTES" => count($arVoted),
                    "COUNT_VOTES" => intval( $arFields["PROPERTIES"]["SUM_VOTED"]["VALUE"] ),
                    "USER_ID" => $arFields["PROPERTIES"]["USER_ID"]["VALUE"],
                    "DESCRIPTION" => $DESCRIPTION,
                    "CONTEST_END" => $CONTEST_END,
                    "CONTEST_NAME" => $CONTEST_NAME,
                    //"DETAIL_PAGE_URL" => $arFields["DETAIL_PAGE_URL"],
                    //"URL_TO_CONDITIONS" => $arFields["DETAIL_PAGE_URL"] . "#" . $arResult["ANCHOR_TO_CONTEST_RULES"],
                );
            }
        }

        return $arResult;
    }

    static function ContestCheckDates($arParams)
    {
        $arResult = array();


        $date_start_s = $arParams["DATE_START"];
        $date_end_s = $arParams["DATE_END"];
        $now_ts = time();

        //echo "date_start_s = ".$date_start_s."<br />";
        //echo "date_end_s = ".$date_end_s."<br />";

        // -->
        if (strlen($date_start_s) > 0) {
            $date_start_ts = strtotime($date_start_s);
            if (intval($date_start_ts) > 0 && intval($now_ts) > 0) {
                if ($date_start_ts > $now_ts) {
                    $arResult["arErrors"][] = "Конкурс еще не начался";
                    $arResult["CONTEST_START"] = "N";
                } else {
                    $arResult["CONTEST_START"] = "Y";
                }
            }
        }
        // <--

        // -->
        if (strlen($date_end_s) > 0) {
            $date_end_ts = strtotime($date_end_s);
            if (intval($date_end_ts) > 0 && intval($now_ts) > 0) {
                if ($date_end_ts <= $now_ts) {
                    $arResult["arErrors"][] = "Конкурс закончился";
                    $arResult["CONTEST_END"] = "Y";
                } else {
                    $arResult["CONTEST_END"] = "N";
                }
            }
        }
        // <--


        // -->
        if (empty($arResult["arErrors"])) {
            $arResult["RESULT"] = "SUCCESS";
        } else {
            $arResult["RESULT"] = "ERROR";
        }
        // <--

        return $arResult;
    }


    static function UploadPicture($arParams)
    {
        $arResult = array();

        $PICTURE_INPUT_NAME = $arParams["PICTURE_INPUT_NAME"];

        $UPLOAD_DIR_PATH = $arParams["UPLOAD_DIR_PATH"];
        if (strlen($UPLOAD_DIR_PATH) <= 0) {
            $UPLOAD_DIR_PATH = '/upload/temp/';
        }
        $CONTEST_REG_MAX_FILE_SIZE = $arParams["CONTEST_REG_MAX_FILE_SIZE"];
        if (strlen($CONTEST_REG_MAX_FILE_SIZE) <= 0) {
            $CONTEST_REG_MAX_FILE_SIZE = (10 * 1024 * 1024);
        }

        if (strlen($_FILES[$PICTURE_INPUT_NAME]['name']) > 0) {

            // Проверка на размер -->
            if (
                $_FILES[$PICTURE_INPUT_NAME]['size'] > $CONTEST_REG_MAX_FILE_SIZE
                && $_FILES[$PICTURE_INPUT_NAME]['size'] > 0
                && $CONTEST_REG_MAX_FILE_SIZE > 0
            ) {
                $arResult["arErrors"][] = 'Размер файла превысил допустимый';
            }
            // <-- Проверка на размер

            // Загрузка файла -->
            if (empty($arResult["arErrors"])) {
                $uploaddir = $_SERVER["DOCUMENT_ROOT"] . $UPLOAD_DIR_PATH;
                $uploadfile = $uploaddir . rand(1, 100000) . "_" . basename($_FILES[$PICTURE_INPUT_NAME]['name']);

                if (!is_dir($uploaddir)) {
                    mkdir($uploaddir, BX_DIR_PERMISSIONS);
                }
                if (move_uploaded_file($_FILES[$PICTURE_INPUT_NAME]['tmp_name'], $uploadfile)) {
                    //$arResult["PICTURE_PATH"] = $_SERVER["DOCUMENT_ROOT"] . $UPLOAD_DIR_PATH . basename($uploadfile);
                    $arResult["UPLOAD_FILE_NAME"] = basename($uploadfile);
                } else {
                    $arResult["arErrors"][] = 'Не удалось загрузить изображение';
                }
            }
            // <-- Загрузка файла
        } else {
            $arResult["arErrors"][] = 'Нужно загрузить изображение';
        }

        if (empty($arResult["arErrors"])) {
            $arResult["RESULT"] = "SUCCESS";
        } else {
            $arResult["RESULT"] = "ERROR";
        }

        return $arResult;
    }


    static function GetCacheId($arParams)
    {
        $arResult = array();

        $ar_params = $arParams["arParams"];
        $level = intval($arParams["LEVEL"]);
        $number_arr = intval($arParams["NUMBER_ARR"]);

        ksort($ar_params);

        $num_arr = 0;
        foreach ($ar_params as $key => $val) {
            if (is_array($val)) {
                $ar_res = CPopupContestReg::GetCacheId(
                    array(
                        "arParams" => $val,
                        "LEVEL" => intval(($level + 1)),
                        "NUMBER_ARR" => $num_arr,
                    )
                );
                foreach ($ar_res["arCacheId"] as $k => $v) {
                    $arResult["arCacheId"][$k] = $v;
                }
                $num_arr++;
            } else if (strlen($val) > 0) {
                $arResult["arCacheId"]["L" . $level . ":" . "A" . $number_arr . ":" . $key] = $val;
            }
        }

        $arResult["CACHE_PRE_ID"] = "";
        if (is_array($arResult["arCacheId"]) && count($arResult["arCacheId"]) > 0) {
            $ar = array();
            foreach ($arResult["arCacheId"] as $key => $val) {
                $ar[] = $key . "=" . $val;
            }
            $arResult["CACHE_PRE_ID"] = implode("~", $ar);
        }

        if (strlen($arResult["CACHE_PRE_ID"]) > 0) {
            $arResult["CACHE_ID"] = md5($arResult["CACHE_PRE_ID"]);
        }

        return $arResult;
    }

}
?>