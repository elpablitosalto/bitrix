<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Application,
	Bitrix\Main\Context,
	Bitrix\Main\Request,
	Bitrix\Main\Localization\Loc,
	Bitrix\Main\Loader,
	Bitrix\Main\Web\Json,
	Bitrix\Main\Data\Cache;

class IndexisIblockForm extends CBitrixComponent
{
	protected function checkParams()
	{
		if (!isset($this->arParams['IBLOCK_ID'])) {
			ShowError(Loc::getMessage('IBLOCK_FORM_NO_IBLOCK_ID'));
			return;
		}

		if (!isset($this->arParams['FORM_CODE'])) {
			ShowError(Loc::getMessage('IBLOCK_FORM_NO_FORM_CODE'));
			return;
		}

		if (!isset($this->arParams['PROPERTY_CODE']) || !is_array($this->arParams['PROPERTY_CODE'])) {
			$this->arParams['PROPERTY_CODE'] = [];
		}

		$this->arParams['PROPERTY_CODE'] = array_filter($this->arParams['PROPERTY_CODE']);

		if (count($this->arParams['PROPERTY_CODE']) == 0) {
			ShowError(Loc::getMessage('IBLOCK_FORM_NO_PROPERTY_CODE'));
			return;
		}

		if (!isset($this->arParams['CACHE_TIME']))
			$this->arParams['CACHE_TIME'] = 36000000;
	}

	protected function prepareDefaultVars()
	{
		$this->arResult['IBLOCK'] = [];
		$this->arResult['FIELDS'] = [];
		$this->arResult['ERROR'] = [];
		$this->arResult['VALUES'] = [];
		$this->arResult['PROCESSED_VALUES'] = [];
	}

	protected function prepareFormFields()
	{
		$cacheDir = '/';
		$cache = Cache::createInstance();
		if ($cache->initCache($this->arParams['CACHE_TIME'], md5($this->arParams['FORM_CODE'] . $this->arParams['IBLOCK_ID']), $cacheDir)) {
			$this->arResult['FIELDS'] = $cache->getVars();
		} elseif ($cache->startDataCache()) {
			global $CACHE_MANAGER;
			$CACHE_MANAGER->StartTagCache($cacheDir);

			$rsProp = CIBlockProperty::GetList(
				['SORT' => 'ASC', 'NAME' => 'ASC'],
				['ACTIVE' => 'Y', 'IBLOCK_ID' => $this->arParams['IBLOCK_ID']]
			);

			while ($arProp = $rsProp->Fetch()) {
				if (!in_array($arProp['CODE'], $this->arParams['PROPERTY_CODE']))
					continue;

				if ($arProp['PROPERTY_TYPE'] == 'L') {
					$arProp['VALUES'] = [];

					$propertyEnums = CIBlockPropertyEnum::GetList(
						['SORT' => 'ASC'],
						['IBLOCK_ID' => $this->arParams['IBLOCK_ID'], 'CODE' => $arProp['CODE']]
					);

					while ($enumFields = $propertyEnums->GetNext()) {
						$arProp['VALUES'][$enumFields['ID']] = $enumFields;
					}
				} else if ($arProp['PROPERTY_TYPE'] == 'E') {
					$arProp['VALUES'] = [];

					$arFilterElements = [
						'IBLOCK_ID' => $arProp['LINK_IBLOCK_ID'],
						'ACTIVE_DATE' => 'Y',
						'ACTIVE' => 'Y',
					];

					if (isset($this->arParams['PRODUCT_ID'])) {
						$arFilterElements['=ID'] = $this->arParams['PRODUCT_ID'];
					}

					$res = CIBlockElement::GetList(['SORT' => 'ASC', 'NAME' => 'ASC'], $arFilterElements, false, false, [
						'ID',
						'NAME',
					]);

					while ($ob = $res->GetNextElement()) {
						$arItem = $ob->GetFields();
						$arProp['VALUES'][$arItem['ID']] = $arItem;
					}
				}

				$this->arResult['FIELDS'][$arProp['CODE']] = $arProp;
			}

			$CACHE_MANAGER->RegisterTag('iblock_id_' . $this->arParams['IBLOCK_ID']);
			$CACHE_MANAGER->EndTagCache();

			$cache->endDataCache($this->arResult['FIELDS']);
		}
	}

	protected function prepareFormAction()
	{
		global $APPLICATION;
		$this->arResult['ACTION'] = $APPLICATION->GetCurPage();
	}

	protected function testValue($value)
	{
		return htmlspecialcharsbx(trim($value));
	}

	protected function isValidForm($arPost)
	{
		global $APPLICATION;
		foreach ($arPost as $code => $value) {
			$code = $this->testValue($code);
			$value = $processedValue = $this->testValue($value);

			if (!in_array($code, $this->arParams['PROPERTY_CODE']))
				continue;

			if (!isset($this->arResult['FIELDS'][$code])) {
				$this->arResult['ERROR']['UNKNOWN'] = Loc::getMessage('IBLOCK_FORM_UNKNOWN_ERROR');
				break;
			}

			$arField = $this->arResult['FIELDS'][$code];
			if ($arField['IS_REQUIRED'] == 'Y' && mb_strlen($value) === 0) {
				$s = str_replace('#FIELD_NAME#', $arField['NAME'], Loc::getMessage('IBLOCK_FORM_REQUIRED_ERROR'));
				//$s .= " ".$code;
				$this->arResult['ERROR'][$code] = $s;
			}

			if (!isset($this->arResult['ERROR'][$code]) && mb_strlen($value) > 0) {
				if ($arField['PROPERTY_TYPE'] == 'L') {
					if (isset($arField['VALUES'][$value])) {
						$processedValue = $arField['VALUES'][$value]['VALUE'];
					} else {
						$this->arResult['ERROR'][$code] = str_replace('#FIELD_NAME#', $arField['NAME'], Loc::getMessage('IBLOCK_FORM_REQUIRED_ERROR'));
					}
				} else if ($arField['PROPERTY_TYPE'] == 'E') {
					if (isset($arField['VALUES'][$value])) {
						$processedValue = $arField['VALUES'][$value]['NAME'];
					} else {
						//$this->arResult['ERROR'][$code] = str_replace('#FIELD_NAME#', $arField['NAME'], Loc::getMessage('IBLOCK_FORM_REQUIRED_ERROR'));
					}
				} else {
					switch ($code) {
						case 'EMAIL':
							if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
								$this->arResult['ERROR'][$code] = str_replace('#FIELD_NAME#', $arField['NAME'], Loc::getMessage('IBLOCK_FORM_EMAIL_ERROR'));
							}
							break;
						case 'PHONE':
							if (!preg_match("/^\+7\s\([0-9]{3}\)\s[0-9]{3}-[0-9]{2}-[0-9]{2}$/", $value)) {
								$this->arResult['ERROR'][$code] = str_replace('#FIELD_NAME#', $arField['NAME'], Loc::getMessage('IBLOCK_FORM_PHONE_ERROR'));
							}
							break;
						case 'LEGAL_ENTITY':
							if (!preg_match("/^([0-9]{10}|[0-9]{12})$/", $value)) {
								$this->arResult['ERROR'][$code] = str_replace('#FIELD_NAME#', $arField['NAME'], Loc::getMessage('IBLOCK_FORM_LEGAL_ENTITY_ERROR'));
							}
							break;
					}
				}
			}

			if ($arField['USER_TYPE'] == 'HTML') {
				$this->arResult['VALUES'][$code] = [
					'VALUE' => [
						'TEXT' => $value,
						'TYPE' => 'text'
					]
				];
			} else {
				$this->arResult['VALUES'][$code] = $value;
			}

			$this->arResult['PROCESSED_VALUES'][$code] = $processedValue;
		}

		if (isset($arPost['CAPTCHA_SID']) && isset($arPost['CAPTCHA_WORD'])) {
			if (!$APPLICATION->CaptchaCheckCode($arPost['CAPTCHA_WORD'], $arPost['CAPTCHA_SID'])) {
				//echo 'wrong captcha code';
				$this->arResult['ERROR']['CAPTCHA'] = Loc::getMessage('CAPTCHA_ERROR');
			}
		}

		foreach ($this->arResult['FIELDS'] as $arField) {
			if ($arField['PROPERTY_TYPE'] != 'F')
				continue;

			if (isset($_FILES[$arField['CODE']])) {
				$arUploadFiles = $_FILES[$arField['CODE']];
				if ($arField['MULTIPLE'] == 'Y') {
					for ($i = 0; $i < count($arUploadFiles['name']); $i++) {
						if (strlen($arUploadFiles['name'][$i]) > 0) {
							$arUploadFile = array(
								"name" => $arUploadFiles['name'][$i],
								"size" => $arUploadFiles['size'][$i],
								"tmp_name" => $arUploadFiles['tmp_name'][$i],
								"type" => $arUploadFiles['type'][$i]
							);

							$checkMessage = CFile::CheckFile(
								array_merge($arUploadFile, array("del" => $arField['CODE'] . "_del", "MODULE_ID" => "iblock")),
								0,
								false,
								$arField['FILE_TYPE']
							);

							if (mb_strlen($checkMessage) == 0) {
								$mimeType = mime_content_type($arUploadFile['tmp_name']);
								if (strstr($mimeType, "image/") || strstr($mimeType, "video/")) {
									$this->arResult['VALUES'][$arField['CODE']][] = $arUploadFile;
								} else {
									$this->arResult['ERROR'][$arField['CODE']] = Loc::getMessage('IBLOCK_FORM_FILES_MIME_ERROR', array('#FILE_TYPE#' => $arField['FILE_TYPE']));
								}
							} else {
								$this->arResult['ERROR'][$arField['CODE']] = $checkMessage;
							}
						}
					}
				} else {
					if (strlen($arUploadFiles['name']) > 0) {
						$arUploadFile = array(
							"name" => $arUploadFiles['name'],
							"size" => $arUploadFiles['size'],
							"tmp_name" => $arUploadFiles['tmp_name'],
							"type" => $arUploadFiles['type']
						);

						$checkMessage = CFile::CheckFile(
							array_merge($arUploadFile, array("del" => $arField['CODE'] . "_del", "MODULE_ID" => "iblock")),
							0,
							false,
							$arField['FILE_TYPE']
						);

						if (mb_strlen($checkMessage) == 0) {
							$mimeType = mime_content_type($arUploadFile['tmp_name']);
							if (strstr($mimeType, "image/") || strstr($mimeType, "video/")) {
								$this->arResult['VALUES'][$arField['CODE']][] = $arUploadFile;
							} else {
								$this->arResult['ERROR'][$arField['CODE']] = Loc::getMessage('IBLOCK_FORM_FILES_MIME_ERROR', array('#FILE_TYPE#' => $arField['FILE_TYPE']));
							}
						} else {
							$this->arResult['ERROR'][$arField['CODE']] = $checkMessage;
						}
					}
				}
			}
		}

		return (count($this->arResult['ERROR']) == 0);
	}

	protected function saveUserRequest()
	{
		$el = new CIBlockElement;

		$newElementActive = $this->arParams['NEW_ELEMENT_ACTIVE'];
		if (strlen($newElementActive) <= 0) {
			$newElementActive = 'N';
		}

		$arRequest = [
			'IBLOCK_ID' => $this->arParams['IBLOCK_ID'],
			'ACTIVE' => $newElementActive,
			//'NAME' => Loc::getMessage('IBLOCK_FORM_REQUEST_TITLE', array('#DATE#' => date('d.m.Y'))),
			'NAME' => date('d.m.Y'),
			//'NAME' => $this->arResult['VALUES']['NAME'],
			'PROPERTY_VALUES' => $this->arResult['VALUES']
		];

		if (!$res = $el->Add($arRequest)) {
			$this->arResult['ERROR'] = ['NOT_SAVED' => $el->LAST_ERROR];
		} else {
			$this->arResult['SUCCESS'] = 'Y';
		}

		return $res;
	}

	protected function sendMail($arEventFields, $arFiles = [])
	{
		CEvent::Send($this->arParams['EVENT_NAME'], SITE_ID, $arEventFields, 'Y', '', $arFiles);
	}

	public function executeComponent()
	{
		$this->includeComponentLang('class.php');
		$this->checkParams();

		if (!Loader::includeModule('iblock') || !Loader::includeModule('asd.iblock'))
			return;

		$this->prepareDefaultVars();
		$this->prepareFormFields();
		$this->prepareFormAction();

		$request = Context::getCurrent()->getRequest();
		if ($request->isPost()) {
			$arPost = $request->getPostList();
			if (isset($arPost['SUBMIT_FORM']) && $arPost['SUBMIT_FORM'] == $this->arParams['FORM_CODE']) {
				$GLOBALS['APPLICATION']->RestartBuffer();
				if ($this->isValidForm($arPost)) {
					if ($elementId = $this->saveUserRequest()) {
						if (isset($this->arParams['EVENT_NAME'])) {
							$arFiles = [];

							$this->sendMail(
								$this->arResult['PROCESSED_VALUES'],
								$arFiles
							);
						}

						die(Json::encode(['SUCCESS' => Loc::getMessage('IBLOCK_FORM_SUCCESS_MESSAGE')]));
					}
				}

				$captchaError = '';
				if (strlen($this->arResult['ERROR']['CAPTCHA']) > 0) {
					$captchaError = 'Y';
				}
				die(Json::encode(['ERROR' => $this->arResult['ERROR'], 'CAPTCHA_ERROR' => $captchaError]));
			}
			//die(Json::encode(['SUBMIT_FORM' => $arPost['SUBMIT_FORM'], 'FORM_CODE' => $this->arParams['FORM_CODE']]));
		}

		if ($this->startResultCache(false)) {
			$arIblockFields = CASDiblockTools::GetIBUF($this->arParams['IBLOCK_ID']);
			$this->arResult['IBLOCK']['NAME'] = mb_strlen($this->arParams['CUSTOM_TITLE']) > 0 ? $this->arParams['CUSTOM_TITLE'] : CIBlock::GetArrayByID($this->arParams["IBLOCK_ID"], "NAME");
			$this->arResult['IBLOCK']['DESCRIPTION'] = mb_strlen($this->arParams['~CUSTOM_DESCRIPTION']) > 0 ? $this->arParams['~CUSTOM_DESCRIPTION'] : CIBlock::GetArrayByID($this->arParams["IBLOCK_ID"], "DESCRIPTION");
			$this->arResult['IBLOCK']['PICTURE'] = mb_strlen($this->arParams['CUSTOM_PICTURE']) > 0 ? $this->arParams['CUSTOM_PICTURE'] : CIBlock::GetArrayByID($this->arParams["IBLOCK_ID"], "PICTURE");
			$this->arResult['IBLOCK']['PHONE'] = mb_strlen($this->arParams['CUSTOM_PHONE']) > 0 ? $this->arParams['CUSTOM_PHONE'] : $arIblockFields['UF_PHONE'];

			$this->includeComponentTemplate();
		}
	}
}
