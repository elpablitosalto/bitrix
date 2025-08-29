<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use \Bitrix\Highloadblock as HL;

\Bitrix\Main\Loader::includeModule('highloadblock');
\Bitrix\Main\Loader::includeModule('iblock');

$arResult['USER_ID'] = (int)$arParams['USER_ID'];

$bRedirect = false;

// Обработка отправки формы фильтра -->
$bSaveFilter = false;
$arSetFilterCodes = array();
if (!empty($_POST['set_filter'])) {
    $bRedirect = true;
    $bSaveFilter = true;
    $arResult['arFilter'] = array();

    // Тема -->
    if ($_POST['filter_type'] == 'topic') {
        $arSetFilterCodes[] = 'topic';
        $arResult['arFilter']['topic'] = array();
        foreach ($_POST['topic'] as $key => $val) {
            $arResult['arFilter']['topic'][] = $val;
        }
        if (empty($arResult['arFilter']['topic'])) {
            $arResult['arFilter']['topic'][] = 0;
        }
    }
    // <-- Тема

    // Скрывать изученное -->
    if ($_POST['filter_type'] == 'hide_show_learned') {
        $arSetFilterCodes[] = 'hidelearned';
        if (!empty($_POST['hide_show_learned'])) {
            $arResult['arFilter']['hidelearned'] = 'Y';
        } else {
            $arResult['arFilter']['hidelearned'] = 'N';
        }
    }
    // <-- Скрывать изученное

    // Спикер -->
    if ($_POST['filter_type'] == 'speaker') {
        $arSetFilterCodes[] = 'speaker';
        $arResult['arFilter']['speaker'] = $_POST['speaker'];
    }
    //vardump($_POST);
    // <-- Спикер


    // С расшифровкой -->
    if ($_POST['filter_type'] == 'with_transcript') {
        $arSetFilterCodes[] = 'with_transcript';
        if (!empty($_POST['with_transcript'])) {
            $arResult['arFilter']['with_transcript'] = 'Y';
        } else {
            $arResult['arFilter']['with_transcript'] = 'N';
        }
    }
    // <-- С расшифровкой
}
// <-- Обработка отправки формы фильтра


//фильтр по умолчанию
if ($arResult['USER_ID'] > 0 && !$bSaveFilter) {

    $arThemes = $updateUser = [];

    //первоначальные темы пользовтеля
    $arUser = \Bitrix\Main\UserTable::getList([
        'select' => ['UF_SPECIALITY', 'UF_SAVE_SPECIALITY_FILTER', 'UF_SAVE_QUIZ_FILTER'],
        'filter' => ['=ID' => $arResult['USER_ID']],
        'limit' => 1,
    ])->fetch();

    if (!$arUser["UF_SAVE_SPECIALITY_FILTER"]) {
        global $USER_FIELD_MANAGER;
        $arFields = $USER_FIELD_MANAGER->GetUserFields("USER");
        $obEnum = new CUserFieldEnum;
        $rsEnum = $obEnum->GetList(array(), array("ID" => $arUser["UF_SPECIALITY"]));
        if ($arEnum = $rsEnum->GetNext()) {
            //список тем из hl
            $obHighloadList = HL\HighloadBlockTable::getList(['filter' => ['=NAME' => 'Themes']])->fetch();
            $obHighloadEntity = HL\HighloadBlockTable::compileEntity($obHighloadList);
            $obHighloadClass = $obHighloadEntity->getDataClass();
            $obHighloadClassList = $obHighloadClass::getList(array('filter' => ['UF_SPECIALITY' => $arEnum["XML_ID"]], 'select' => array('ID', 'UF_SPECIALITY', 'UF_XML_ID')));
            while ($arHighloadList = $obHighloadClassList->Fetch()) {
                $arThemes[$arHighloadList["ID"]] = $arHighloadList["ID"];
            }
        }
        $updateUser["UF_SAVE_SPECIALITY_FILTER"] = true;
    }

    if (!$arUser["UF_SAVE_QUIZ_FILTER"]) {
        //результаты квиза
        $arSelect = array(
            "ID",
            "NAME",
            "PROPERTY_WORK",
            "PROPERTY_REASON",
            "PROPERTY_REASON2",
            "PROPERTY_REASON_RESULT",
            "PROPERTY_PACIENT_TYPE",
            "PROPERTY_THEMES",
            "PROPERTY_HOW_GET",
            "PROPERTY_MATERISLAS_DATE",
        );
        $arFilter = array(
            "IBLOCK_ID" => indexis::getIblockId("quiz", "content"),
            "ACTIVE_DATE" => "Y",
            "ACTIVE" => "Y",
            "CREATED_BY" => $arResult['USER_ID']
        );
        $res = CIBlockElement::GetList(array(), $arFilter, false, array("nTopCount" => 1), $arSelect);
        if ($arElement = $res->GetNext()) {
            $propsTables = [
                "PROPERTY_WORK_VALUE" => "Worktype",
                //"PROPERTY_REASON_VALUE" => "Spisokprichinusileniya",
                "PROPERTY_REASON2_VALUE" => "Reasoncompetetions",
                "PROPERTY_REASON_RESULT" => "Reasonresult",
                "PROPERTY_THEMES_VALUE" => "Quizthemes"
            ];

            foreach ($arElement as $propCode => $propVal) {
                if (isset($propsTables[$propCode]) && !empty($propVal)) {
                    $obHighloadList = HL\HighloadBlockTable::getList(['filter' => ['=NAME' => $propsTables[$propCode]]])->fetch();
                    $obHighloadEntity = HL\HighloadBlockTable::compileEntity($obHighloadList);
                    $obHighloadClass = $obHighloadEntity->getDataClass();
                    $limit = (is_array($propVal)) ? count($propVal) : 1;
                    $obHighloadClassList = $obHighloadClass::getList(array('filter' => ["UF_XML_ID" => $propVal], 'limit' => $limit, 'select' => array('*')));
                    while ($arHighloadList = $obHighloadClassList->Fetch()) {
                        foreach ($arHighloadList["UF_THEME"] as $themeId) {
                            $arThemes[$themeId] = $themeId;
                        }
                    }
                }
            }
            $updateUser["UF_SAVE_QUIZ_FILTER"] = true;
        }
    }

    if (!empty($updateUser)) {

        $bRedirect = true;
        $bSaveFilter = true;

        $user = new CUser;
        $user->Update($arResult['USER_ID'], $updateUser);

        if (intval($arResult['USER_ID']) > 0) {
            $arResult['arFilter'] = json_decode(Indexis::GetUserField('USER', $arResult['USER_ID'], 'UF_PERSONAL_FILTER'), true);
        } else {
            if (!empty($_COOKIE["arFilterCookie"])) {
                $arResult['arFilter'] = json_decode($_COOKIE["arFilterCookie"], true);
            }
        }
        if (!is_array($arResult['arFilter']))
            $arResult['arFilter'] = [];

        foreach ($arThemes as $themeID) {
            if (!is_array($arResult['arFilter']['topic']) || !in_array($themeID, $arResult['arFilter']['topic']))
                $arResult['arFilter']['topic'][] = $themeID;
        }
        $arSetFilterCodes = ['topic'];
    }
}

// Сохранение фильтра  -->
if ($bSaveFilter && $arParams['SAVE'] != 'N') {
    // в поле пользователя -->
    if (intval($arResult['USER_ID']) > 0) {
        $rsUser = CUser::GetByID($arResult['USER_ID']);
        $arUser = $rsUser->Fetch();
        $arFilterTmp = json_decode($arUser['UF_PERSONAL_FILTER'], true);
        if (empty($arFilterTmp)) {
            $arFilterTmp = array();
        }
        foreach ($arSetFilterCodes as $code) {
            $arFilterTmp[$code] = $arResult['arFilter'][$code];
        }
        $arResult['arFilter'] = $arFilterTmp;
        $strFilter = json_encode($arResult['arFilter']);
        Indexis::SetUserField('USER', $arResult['USER_ID'], 'UF_PERSONAL_FILTER', $strFilter);
    }
    // <-- в поле пользователя 

    // в куки -->
    else {
        $strFilter = json_encode($arResult['arFilter']);
        setcookie("arFilterCookie", $strFilter, (time() + 3600 * 24 * 365), "/");
    }
    // <-- в куки
}
// <-- Сохранение фильтра 

// Получим фильтр  -->
if (!$bSaveFilter && $arParams['GET_SAVE'] != 'N') {
    // из данных пользователя -->
    if (intval($arResult['USER_ID']) > 0) {
        $arResult['arFilter'] = json_decode(Indexis::GetUserField('USER', $arResult['USER_ID'], 'UF_PERSONAL_FILTER'), true);
    }
    // <-- из данных пользователя

    // из куки -->
    else {
        if (!empty($_COOKIE["arFilterCookie"])) {
            $arResult['arFilter'] = json_decode($_COOKIE["arFilterCookie"], true);
        }
    }
    // <-- из куки
}
// <-- Получим фильтр

// Редирект -->

// Вариант 1 -->
if (TRUE) {
    if ($bRedirect == true && $arParams['REDIRECT'] != 'N') {
        $redirectUrl = urldecode($_POST['redirect_url']);
        if (empty($redirectUrl)) {
            $redirectUrl = $_SERVER['REQUEST_URI'];
        }
        LocalRedirect($redirectUrl);
    }
}
// <-- Вариант 1

// Вариант 2 -->
else if (FALSE) {
    // Сформируем URL на основе выбранного фильтра -->
    $redirectUrl = '';
    if (!empty($arResult['arFilter'])) {
        $arUrlParams = array();
        if (!empty($arResult['arFilter']['topic'])) {
            $arUrlParams['ftopic'] = '';
            $ar = array();
            $str = '';
            foreach ($arResult['arFilter']['topic'] as $key => $val) {
                $ar[] = $val;
            }
            if (!empty($ar)) {
                $str .= implode('-', $ar);
                $arUrlParams['ftopic'] = $str;
            }
        }
        if (!empty($arResult['arFilter']['hidelearned'])) {
            $arUrlParams['fhidelearned'] = $arResult['arFilter']['hidelearned'];
        }

        if (!empty($arUrlParams)) {
            $str = http_build_query($arUrlParams);
            $ar = array();
            foreach ($arUrlParams as $key => $val) {
                $ar[] = $key;
            }
            $redirectUrl = $APPLICATION->GetCurPageParam($str, $ar);
        }

        // Определим, нужно ли делать редирект -->
        if ($bRedirect == false) {
            if (!empty($arUrlParams)) {
                foreach ($arUrlParams as $key => $val) {
                    if ($val != $_GET[$key]) {
                        $bRedirect = true;
                    }
                }
            }
        }
        // <-- Определим, нужно ли делать редирект
    }
    // <-- Сформируем URL на основе выбранного фильтра

    // Редирект -->
    if (strlen($redirectUrl) > 0 && $bRedirect == true) {
        LocalRedirect($redirectUrl);
    }
    // <-- Редирект
}
// <-- Вариант 2


// Переключатель Показывать изученное -->
if ($arResult['arFilter']['hidelearned'] == 'Y') {
    $arResult['hidelearned'] = 'Y';
} else {
    $arResult['hidelearned'] = 'N';
}
// <-- 

// Список тем -->
$arResult['ITEMS'] = array();
if (intval($arParams['HIBLOCK_ID']) > 0) {
    $entity_data_class = GetEntityDataClass($arParams['HIBLOCK_ID']);
    $filter = [];
    if (isset($arParams["THEMES"])) {
        $filter["UF_XML_ID"] = $arParams["THEMES"];
    } else {
        $filter["!UF_SHOW"] = false;
    }
    $rsData = $entity_data_class::getList(array(
        'select' => array('*'),
        'filter' => $filter,
        'order' => array('UF_NAME' => 'ASC'),
    ));
    while ($el = $rsData->fetch()) {
        //vardump($el);
        //if (intval($arResult['arFilter']['topic'][$el['ID']]) > 0) {
        $el['CHECKED'] = 'N';
        if (is_array($arResult['arFilter']['topic'])) {
            if (in_array($el['ID'], $arResult['arFilter']['topic'])) {
                $el['CHECKED'] = 'Y';
                $arResult['arFilterDirectory']['topic'][] = $el['UF_XML_ID'];
            }
        }
        $arResult['ITEMS'][$el['ID']] = $el;
    }
}
// <-- Список тем

// Сортировка -->
$arResult['ORDER'] = array(
    'SORT_BY1' => $_COOKIE['SORT_BY1'],
    'SORT_ORDER1' => $_COOKIE['SORT_ORDER1'],
);
// <-- Сортировка

// Спикеры -->
//vardump($arResult['arFilter']);
$arResult['arSpeakers'] = array();
$IBLOCK_ID = Indexis::getIblockId('speakers', 'content');
if (intval($IBLOCK_ID) > 0) {
    $arSelect = array("ID", "NAME");
    $arFilter = array("IBLOCK_ID" => $IBLOCK_ID, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
    $res = CIBlockElement::GetList(array('name' => 'asc'), $arFilter, false, false, $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $selected = $arResult['arFilter']['speaker'] == $arFields['ID'] ? 'Y' : 'N';
        $arResult['arSpeakers'][$arFields['ID']] = array(
            'NAME' => $arFields['NAME'],
            'SELECTED' => $selected,
        );
        //print_r($arFields);
    }
}
// <-- Спикеры

// action форм -->
$arResult['ACTION'] = $APPLICATION->GetCurPageParam("", array("prefilter"));
// <-- action форм

//vardump($arResult['ITEMS']);

// URL редиректа для форм -->
$arResult['REDIRECT_URL_TEMPLATE'] = $APPLICATION->GetCurPageParam("", array("prefilter"));
// <-- URL редиректа для форм

$arResult['arFilterResult'] = array(
    'arFilter' => $arResult['arFilter'],
    'arFilterDirectory' => $arResult['arFilterDirectory'],
    'ORDER' => $arResult['ORDER'],
    'arSpeakers' => $arResult['arSpeakers'],
);

//vardump($arResult);

$this->setResultCacheKeys(array(
    "ITEMS",
    "arFilterResult",
    "ACTION"
));
$this->includeComponentTemplate();

return $arResult['arFilterResult'];
