<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

use Bitrix\Main\Application;
use Bitrix\Rest\RestException;
use Bitrix\Main\Page\Asset;
use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\Engine\ActionFilter;
use Bitrix\Main\Loader;
use Bitrix\Main\Engine\Controller;
use Bitrix\Main\Context;
use Bitrix\Main\Mail\Event;

Loader::includeModule("iblock");

class CallBackForm extends \CBitrixComponent implements Controllerable
{

    public ?array $arErrorRows = [];
    public ?array $arTempParams = [];


    public function __construct($component = null)
    {
        parent::__construct($component);
    }


    public function executeComponent()
    {
        CJSCore::Init();
        CJSCore::Init(["jquery"]);

        $this->arTempParams = $this->arParams;

        if (!empty($this->arTempParams['USER_ID'])) {
            $this->includeComponentTemplate();
        }
    }


    /**
     * @param array $arPost
     * @return array|null
     */
    public function validationEmptyRows(array $arPost): ?array
    {
        if (!empty($arPost)) {
            $this->arTempParams['REQUIRED_FIELDS'] = [
                'review_text',
            ];

            $arRequiredFields = $this->arTempParams['REQUIRED_FIELDS'];

            foreach ($arRequiredFields as $keyRequired => $valueRequired) {
                if (empty(trim($arPost[strtolower($valueRequired)]))) {
                    $arEmptyRows[strtolower($valueRequired)] = strtolower($valueRequired);
                }
            }

            return $arEmptyRows;
        }
        return null;
    }


    /**
     * @param array $arPost
     * @return array|null
     */
    public function validationRightRows(array $arPost): ?array
    {
        foreach ($arPost as $keyPost => $valuePost) {
            if ($this->specialCharsValidation($valuePost)) {

                $valuePost = htmlspecialchars($valuePost);

                switch ($keyPost) {
                    case 'review_text':
                        /*if (
                            !preg_match("/^[a-zA-Z\p{Cyrillic}\s\-]+$/u", $valuePost)
                            
                            // Проверка на наличие emoji
                            //|| preg_match('/^[' . Indexis::unichr(0x1F300) . '-' . Indexis::unichr(0x1F5FF) . Indexis::unichr(0xE000) . '-' . Indexis::unichr(0xF8FF) . ']/u', $valuePost)
                        ) {
                            //$arNotRightValidationRows[strtolower($keyPost)] = $valuePost;
                            $pattern_2 = '/^[' . Indexis::unichr(0x1F300) . '-' . Indexis::unichr(0x1F5FF) . Indexis::unichr(0xE000) . '-' . Indexis::unichr(0xF8FF) . ']/u';
                            $res = preg_match($pattern_2, $valuePost, $matches);
                            $flag = !empty($matches);
                            if ($flag) {
                                $arNotRightValidationRows[strtolower($keyPost)] = $valuePost;
                            }
                        }*/
                        if (mb_strlen(trim($valuePost)) == 0) {
                            $arNotRightValidationRows[strtolower($keyPost)] = $valuePost;
                        }

                        /*
                        if (!preg_match("/^[a-zA-Z\p{Cyrillic}\s\-]+$/u", $valuePost)) {
                        $arNotRightValidationRows[strtolower($keyPost)] = $valuePost;
                        }
                        */

                        break;
                }
            }
        }

        return $arNotRightValidationRows;
    }

    /**
     * @param $inputValue
     * @return string|null
     */
    public function specialCharsValidation(string $inputValue): ?string
    {
        $inputValue = trim($inputValue);
        $inputValue = stripslashes($inputValue);
        $inputValue = htmlspecialchars($inputValue);

        if (!empty($inputValue)) {
            return $inputValue;
        }
        return null;
    }


    /**
     * @return array|false|null
     */
    public function executionSendFormReviewIblockAction()
    {
        $arPost = $this->request->getPostList()->toArray();

        foreach ($arPost['data']['dataForm'] as $keyPostTemp => $valuePostTemp) {
            $arPostTemp[$valuePostTemp['name']] = $valuePostTemp['value'];
        }

        if (!empty($arPostTemp)) {
            if (!empty($arNoValidEmptyRows = $this->validationEmptyRows($arPostTemp))) {
                $this->arErrorRows['name_input_errors'] = $arNoValidEmptyRows;
                $this->arErrorRows['status'] = 'error';
                $this->arErrorRows['type_error'] = 'empty';
                $this->arErrorRows['error_message'] = GetMessage('EMPTY_FIELD_ERROR');
            }

            if (!empty($this->arErrorRows)) {
                return $this->arErrorRows;
            }

            if (!empty($arTempNotRightValidationRows = $this->validationRightRows($arPostTemp))) {
                $this->arErrorRows['name_input_errors'] = $arTempNotRightValidationRows;
                $this->arErrorRows['status'] = 'error';
                $this->arErrorRows['type_error'] = 'no_valid';
                $this->arErrorRows['error_message'] = GetMessage('NO_VALID_FIELD_ERROR');
            }

            if (!empty($this->arErrorRows)) {
                return $this->arErrorRows;
            } else {
                return $this->addDataRowInIblock($arPostTemp);
            }
        }
        return false;
    }


    /**
     * @param array $arPostTemp
     * @return array
     */
    public function addDataRowInIblock(array $arPostTemp): array
    {
        $arFields = [
            'PREVIEW_TEXT' => $arPostTemp['review_text'],
            'USER_ID' => $arPostTemp['user_id'],
            'MOVIE_ID' => $arPostTemp['movie_id'],
        ];

        $rsUser = CUser::GetByID($arPostTemp['user_id']);
        $arUser = $rsUser->Fetch();

        // Конвертация emoji из PHP в HTML -->
        $arPostTemp['review_text'] = Indexis::encode_emoji($arPostTemp['review_text']);
        // <-- 

        $obElement = new CIBlockElement();
        $arFieldsAdd = [
            'IBLOCK_ID' => $arPostTemp['iblock_id'],
            'NAME' => $arUser['NAME'] . ' ' . $arUser['LAST_NAME'],
            'ACTIVE' => 'N',
            'PREVIEW_TEXT' => $arPostTemp['review_text'],
            'DATE_ACTIVE_FROM' => date('d.m.Y H:i:s'),
            'PROPERTY_VALUES' => [
                'USER_ID' => $arFields['USER_ID'],
                'MOVIE_ID' => $arFields['MOVIE_ID'],
            ],
        ];



        if ($idProduct = $obElement->Add($arFieldsAdd)) {
            $arPropertyValue = [$idProduct];
            CIBlockElement::SetPropertyValuesEx($arFields['MOVIE_ID'], false, ['REVIEWS' => $arPropertyValue]);

            $this->arErrorRows['success_message'] = GetMessage('SUCCESS_SEND_REVIEW');
            $this->arErrorRows['status'] = 'success';
        } else {
            $this->arErrorRows['status'] = 'error';
            $this->arErrorRows['status_add_element'] = $obElement->LAST_ERROR;
        }

        return $this->arErrorRows;
    }


    /**
     * @return array[][]
     */
    public function configureActions()
    {
        return [
            'executionSendFormReviewIblock' => [
                'prefilters' => [

                ],
            ]
        ];
    }


    /**
     * @param $arParams
     * @return mixed
     */
    public function onPrepareComponentParams($arParams)
    {
        return $arParams;
    }
}