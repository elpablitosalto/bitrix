<?
class CPopupContestReg
{
	static function SaveSendInfo($arParams)
	{
		global $DB;

		$arResult = array();

		$UPLOAD_DIR_PATH = $arParams["UPLOAD_DIR_PATH"];
		if (strlen($UPLOAD_DIR_PATH) <= 0) {
			$UPLOAD_DIR_PATH = '/upload/temp/';
		}

		// Проверка отправлена ли форма -->
		{
			$arResult["SEND_FORM"] = "N";
			/*if (array_key_exists("contest_reg_button", $arParams["POST"])) {*/
			if ($arParams["POST"]["SEND_FORM"] == "Y") {
				$arResult["SEND_FORM"] = "Y";
			}
		}
		// <-- Проверка отправлена ли форма

		// Код инфоблока -->
		{
			$arResult["IBLOCK_CODE"] = $arParams["IBLOCK_CODE"];
			if (strlen($arResult["IBLOCK_CODE"]) <= 0) {
				$arResult["IBLOCK_CODE"] = $arParams["POST"]["IBLOCK_CODE"];
			}
			if (strlen($arResult["IBLOCK_CODE"]) <= 0) {
				$arResult["arErrors"][] = "Не указан код инфоблока";
			}
		}
		// <-- Код инфоблока

		// Данные конкурса -->
		if (intval($arParams["POST"]["CONTEST_ELEMENT_ID"]) > 0) {
			$arSelect = false;
			$arFilter = array(
				"ID" => $arParams["POST"]["CONTEST_ELEMENT_ID"],
			);
			$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
			if ($ob = $res->GetNextElement()) {
				$arFields = $ob->GetFields();
				$arFields["PROPERTIES"] = $ob->GetProperties();

				//echo "arFields:";echo "<pre>";print_r($arFields);echo "</pre>";

				// Проверка конкурса на даты -->
				{
					$ar_result = CPopupContestReg::ContestCheckDates(
						array(
							"DATE_START" => $arFields["PROPERTIES"]["DATE_START"]["VALUE"],
							"DATE_END" => $arFields["PROPERTIES"]["DATE_END"]["VALUE"],
						)
					);
					if ($ar_result["RESULT"] == "SUCCESS") {
					} else if ($ar_result["RESULT"] == "ERROR") {
						foreach ($ar_result["arErrors"] as $key => $val) {
							$arResult["arErrors"][] = $val;
						}
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

		// -->
		if ($arResult["SEND_FORM"] != "Y") {
			$arResult["arErrors"][] = "Ошибка отправки формы";
		}
		// <--

		// Подготовка данных -->
		if (empty($arResult["arErrors"])) {
			$arData = array();

			$arData["FIELDS_VALUES"]["NAME"] = $arParams["POST"]["participantLastName"] . " " . $arParams["POST"]["participantFirstName"];
			$arData["FIELDS_VALUES"]["ACTIVE_FROM"] = date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time());
			$arData["FIELDS_VALUES"]["PREVIEW_TEXT"] = $arParams["POST"]["desc"];
			$arData["FIELDS_VALUES"]["PREVIEW_PICTURE_SOURCE"]
				= $_SERVER["DOCUMENT_ROOT"] . $UPLOAD_DIR_PATH . $arParams["POST"]["CONTEST_UPLOAD_FILE_NAME"];

			$arData["PROPERTY_VALUES"]["PARTICIPANT_LAST_NAME"] = $arParams["POST"]["participantLastName"];
			$arData["PROPERTY_VALUES"]["PARTICIPANT_FIRST_NAME"] = $arParams["POST"]["participantFirstName"];
			$arData["PROPERTY_VALUES"]["REPRESENTATIVE_LAST_NAME"] = $arParams["POST"]["representativeLastName"];
			$arData["PROPERTY_VALUES"]["REPRESENTATIVE_FIRST_NAME"] = $arParams["POST"]["representativeFirstName"];
			$arData["PROPERTY_VALUES"]["REPRESENTATIVE_MIDDLE_NAME"] = $arParams["POST"]["representativeMiddleName"];
			$arData["PROPERTY_VALUES"]["PARTICIPANT_AGE"] = $arParams["POST"]["participantAge"];
			$arData["PROPERTY_VALUES"]["PHONE"] = $arParams["POST"]["phone"];
			$arData["PROPERTY_VALUES"]["EMAIL"] = $arParams["POST"]["email"];
			$arData["PROPERTY_VALUES"]["CITY"] = $arParams["POST"]["city"];
			$arData["PROPERTY_VALUES"]["PERSONAL_DATA_PROCESSING"] = $arParams["POST"]["personalDataProcessing"];
			$arData["PROPERTY_VALUES"]["CONTEST_RULES"] = $arParams["POST"]["contestRules"];
			$arData["PROPERTY_VALUES"]["SUBSCRIBE"] = $arParams["POST"]["subscribe"];
			$arData["PROPERTY_VALUES"]["CONTEST"] = $arParams["POST"]["CONTEST_ELEMENT_ID"];
			$arData["PROPERTY_VALUES"]["USER_ID"] = $arParams["POST"]["USER_ID"];
		}
		// <-- Подготовка данных

		// Валидация -->
		if (empty($arResult["arErrors"])) {
			$ar_result = CPopupContestReg::Validate(
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
			$ar_result = CPopupContestReg::AddDataToIblock($ar_params);
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
			if ($date_start_ts > $now_ts) {
				$arResult["arErrors"][] = "Конкурс еще не начался";
			}
		}
		// <--

		// -->
		if (strlen($date_end_s) > 0) {
			$date_end_ts = strtotime($date_end_s);
			if ($date_end_ts <= $now_ts) {
				$arResult["arErrors"][] = "Конкурс закончился";
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

		if (strlen($arData["PROPERTY_VALUES"]["PARTICIPANT_LAST_NAME"]) <= 0) {
			$arResult["arErrors"][] = "Необходимо заполнить поле Фамилия участника";
		}
		if (strlen($arData["PROPERTY_VALUES"]["PARTICIPANT_FIRST_NAME"]) <= 0) {
			$arResult["arErrors"][] = "Необходимо заполнить поле Имя участника";
		}
		if (strlen($arData["PROPERTY_VALUES"]["REPRESENTATIVE_LAST_NAME"]) <= 0) {
			$arResult["arErrors"][] = "Необходимо заполнить поле Фамилия законного представителя участника";
		}
		if (strlen($arData["PROPERTY_VALUES"]["REPRESENTATIVE_FIRST_NAME"]) <= 0) {
			$arResult["arErrors"][] = "Необходимо заполнить поле Имя законного представителя участника";
		}
		if (strlen($arData["PROPERTY_VALUES"]["REPRESENTATIVE_MIDDLE_NAME"]) <= 0) {
			$arResult["arErrors"][] = "Необходимо заполнить поле Отчество законного представителя участника";
		}
		if (strlen($arData["PROPERTY_VALUES"]["PARTICIPANT_AGE"]) <= 0) {
			$arResult["arErrors"][] = "Необходимо заполнить поле Возраст участника";
		} else if (!is_numeric($arData["PROPERTY_VALUES"]["PARTICIPANT_AGE"])) {
			$arResult["arErrors"][] = "Поле Возраст участника должно быть числом";
		}
		if (strlen($arData["PROPERTY_VALUES"]["PHONE"]) <= 0) {
			$arResult["arErrors"][] = "Необходимо заполнить поле Номер телефона";
		} else if (!preg_match("/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/", $arData["PROPERTY_VALUES"]["PHONE"])) {
			$arResult["arErrors"][] = "Необходимо правильно заполнить поле Номер телефона";
		}
		if (strlen($arData["PROPERTY_VALUES"]["EMAIL"]) <= 0) {
			$arResult["arErrors"][] = "Необходимо заполнить поле Email";
		} else if (!check_email($arData["PROPERTY_VALUES"]["EMAIL"])) {
			$arResult["arErrors"][] = "В поле Email ошибка";
		}
		if (strlen($arData["PROPERTY_VALUES"]["PARTICIPANT_FIRST_NAME"]) <= 0) {
			$arResult["arErrors"][] = "Необходимо заполнить поле Имя участника";
		}
		if (strlen($arData["PROPERTY_VALUES"]["CITY"]) <= 0) {
			$arResult["arErrors"][] = "Необходимо заполнить поле Город участника";
		}
		if (strlen($arData["FIELDS_VALUES"]["PREVIEW_TEXT"]) <= 0) {
			$arResult["arErrors"][] = "Необходимо заполнить поле Описание работы";
		}
		if (strlen($arData["PROPERTY_VALUES"]["PERSONAL_DATA_PROCESSING"]) <= 0) {
			$arResult["arErrors"][] = "Необходимо указать Согласие на обработку персональных данных";
		}
		if (strlen($arData["PROPERTY_VALUES"]["CONTEST_RULES"]) <= 0) {
			$arResult["arErrors"][] = "Необходимо указать Согласие с правилами конкурса";
		}
		// Картинка -->
		if (strlen($arData["FIELDS_VALUES"]["PREVIEW_PICTURE_SOURCE"]) <= 0) {
			$arResult["arErrors"][] = "Необходимо загрузить изображение";
		} else if (!is_file($arData["FIELDS_VALUES"]["PREVIEW_PICTURE_SOURCE"])) {
			$arResult["arErrors"][] = "Файл не удалось загрузить на сайт";
		} else {
			$arFile = CFile::MakeFileArray($arData["FIELDS_VALUES"]["PREVIEW_PICTURE_SOURCE"]);
			if ($arFile["size"] > $CONTEST_REG_MAX_FILE_SIZE) {
				$arResult["arErrors"][] = "Файл превысил допустимый вес";
			} else {
				//$detectedType = exif_imagetype($arData["FIELDS_VALUES"]["PREVIEW_PICTURE_SOURCE"]);
				//if (!in_array($detectedType, $allowedPictureTypes)) {
				//	$arResult["arErrors"][] = "Загружен файл недопустимого типа";
				//}
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

		// Подписка -->
		if (strlen($arData["PROPERTY_VALUES"]["SUBSCRIBE"]) > 0) {
			// Список значений свойства "Подписка" -->
			if (intval($IBLOCK_ID) > 0) {
				$arEnumParams = array();
				$property_enums = CIBlockPropertyEnum::GetList(
					array("DEF" => "DESC", "SORT" => "ASC"),
					array(
						"IBLOCK_ID" => $IBLOCK_ID,
						"CODE" => "SUBSCRIBE"
					)
				);
				while ($enum_fields = $property_enums->GetNext()) {
					$arEnumParams[$enum_fields["XML_ID"]] = $enum_fields;
				}
			}
			// <-- Список значений свойства "Подписка"

			$enumId = $arEnumParams["Y"]["ID"];
			if (intval($enumId) > 0) {
				$arData["PROPERTY_VALUES"]["SUBSCRIBE"] = $enumId;
			}
		}
		// <-- Подписка

		if (intval($IBLOCK_ID) > 0) {
			$el = new CIBlockElement;

			$PREVIEW_PICTURE_SOURCE = $arData["FIELDS_VALUES"]["PREVIEW_PICTURE_SOURCE"];
			$PREVIEW_PICTURE = CFile::MakeFileArray($PREVIEW_PICTURE_SOURCE);

			$arLoadProductArray = array(
				"IBLOCK_ID" => $IBLOCK_ID,
				"NAME" => $arData["FIELDS_VALUES"]["NAME"],
				"ACTIVE" => "N",
				"PREVIEW_TEXT" => $arData["FIELDS_VALUES"]["PREVIEW_TEXT"],

				// Обязательные поля -->
				"ACTIVE_FROM" => $arData["FIELDS_VALUES"]["ACTIVE_FROM"],
				"PREVIEW_PICTURE" => $PREVIEW_PICTURE,
				// <-- Обязательные поля

				"PROPERTY_VALUES" => $arData["PROPERTY_VALUES"],
			);
			if ($NEW_ELEMENT_ID = $el->Add($arLoadProductArray)) {
				$arResult["NEW_ELEMENT_ID"] = $NEW_ELEMENT_ID;
				unlink($PREVIEW_PICTURE_SOURCE);
			} else {
				$arResult["arErrors"][] = $el->LAST_ERROR;
			}
		}

		if (empty($arResult["arErrors"])) {
			$arResult["RESULT"] = "SUCCESS";
		} else {
			$arResult["RESULT"] = "ERROR";
		}

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
					$arResult["CONTEST_UPLOAD_FILE_NAME"] = basename($uploadfile);
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

	static function CurUserContestRegExists($arParams)
	{
		$arResult = array();

		if
		( 
			intval( $arParams["USER_ID"] ) <= 0 
			|| strlen( $arParams["IBLOCK_CODE"] ) <= 0 
			|| intval( $arParams["CONTEST"] ) <= 0 
		)
		{
			return $arResult;
		}

		$arResult["REG_EXIST"] = "N";

		$arSelect = array( "ID" );
		$arFilter = array(
			"PROPERTY_USER_ID" => $arParams["USER_ID"],
			"PROPERTY_CONTEST" => $arParams["CONTEST"],
			"IBLOCK_CODE" => $arParams["IBLOCK_CODE"],
		);
		$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
		if ($ob = $res->GetNextElement()) {
			//$arFields = $ob->GetFields();
			//$arFields["PROPERTIES"] = $ob->GetProperties();

			$arResult["REG_EXIST"] = "Y";
		}	

		return $arResult;
	}

}
?>